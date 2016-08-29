<?php

    session_start();
    $nav = file_get_contents('navbar.php');
    if(isset($_SESSION['admin'])){
        $nav = file_get_contents('navbar2.php');
    }
   
    require('config.php');
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if($mysqli->connect_error){
        die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    }
    $sql = "SELECT * FROM events";
    $result = $mysqli->query($sql);
    $numResults = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Events</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php echo $nav; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Events
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Events</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-8">

                <?php
                    while($row = $result->fetch_assoc()){
                        $desc = file_get_contents('events/' . $row['evid']. '/description.txt');
                        if(isset($_SESSION['admin'])){
                            echo '
                                <!-- Event -->
                                <h2>
                                    <a href="#">'. $row['title'] .'</a>
                                </h2>
                                <p class="lead">
                                    by <a href="#">'. $row['organization'] .'</a>
                                </p>
                                <p><i class="fa fa-clock-o"></i> On '. $row['date'] .'</p>
                                <hr>
                                <img class="img-responsive img-hover" src="images/events/files/'. $row['pic'] .'" height-"300" width="1200" alt="">
                                <hr>
                                <p>'. $desc .'</p>
                                <div class="btn-group groupSelect" role="group" aria-label="...">
                                    <button data-expanded="false" type="button" class="btn btn-primary expandong" data-eventId="'. $row['evid'] .'">View Bracket <i class="fa fa-angle-right"></i></button>
                                </div>
                                <div class="btn-group groupSelect" role="group" aria-label="...">
                                    <button type="button" class="btn btn-warning edit" data-eventId="'. $row['evid'] .'">Edit</button>
                                </div>
                                <hr>';
                        }
                        else{
                             echo '
                                <!-- Event -->
                                <h2>
                                    <a href="#">'. $row['title'] .'</a>
                                </h2>
                                <p class="lead">
                                    by <a href="#">'. $row['organization'] .'</a>
                                </p>
                                <p><i class="fa fa-clock-o"></i> On '. $row['date'] .'</p>
                                <hr>
                                <img class="img-responsive img-hover" src="images/events/files/'. $row['pic'] .'" height-"300" width="1200" alt="">
                                <hr>
                                <p>'. $desc .'</p>
                                <div class="btn-group groupSelect" role="group" aria-label="...">
                                    <button data-expanded="false" type="button" class="btn btn-primary expandong" data-eventId="'. $row['evid'] .'">View Bracket <i class="fa fa-angle-right"></i></a>
                                </div>
                                <hr>';
                        }
                       
                    }
                ?>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        var topCat_data;
        var topCat_target;
        var lowCat_data;
        var lowCat_target;
    	$('.expandong').click(function(e){
            var btn = $(this);
            if(e.target != topCat_target){
                $.post('events/jsonHandler.php', {category: 'first', eventid: btn.data('eventid')}, function(data){
                    topCat_data = data;
                }).done(function(){
                    var ul = $(e.target).closest('.groupSelect').find('.topCat').siblings();
                    ul.children().remove();
                    ul.append(topCat_data);
                });
                topCat_target = e.target;
            }
    		if (!btn.data("expanded")){
                if(btn.siblings().length < 1){
                    var newBtn = $('<div class="dropdown pull-left">' +
                                    '<button class="btn btn-primary dropdown-toggle topCat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                            'Category <span class="caret"></span>' +
                                        '</button>' +
                                        '<ul class="dropdown-menu">' +
                                            '<li>Loading...</li>' +
                                        '</ul>' +
                                    '</div>');
                    newBtn.css('margin-left', '-110px');
                    newBtn.appendTo($(this).parent('.groupSelect')).animate({'margin-left': '+=110'});
                }
                else{
                    btn.siblings().show();
                }
    			
    			btn.find('i').prop('class','fa fa-angle-left');
    			btn.data('expanded', true);
    		}
    		else {
    			var siblings = btn.siblings()
    			siblings.each(function(key, value){
    				$(siblings[key]).hide();
    			});
    			btn.find('i').prop('class','fa fa-angle-right');
    			btn.data('expanded', false);
    		}
    		
    	});

        $('.edit').click(function(e){
            var eventid = $(this).data('eventid');
            window.location = 'create.php?edit=true&eventid=' + eventid;
        });
        $('.groupSelect').delegate('.subCat', 'click', function(e){
            e.preventDefault();
            var btn = $(this).parent().parent().parent().find('button');
            btn .text($(this).text());

            if(e.target != lowCat_target){
                $.post('events/jsonHandler.php', {category: 'second', eventid: btn.parent().siblings('.expandong').data('eventid'), subCat: btn.text()}, function(data){
                    lowCat_data = data;
                }).done(function(){
                    var ul = $(e.target).closest('.groupSelect').find('.lowCat').siblings();
                    ul.children().remove();
                    ul.append(lowCat_data);
                    $('.go').bind('click', function(e){
                        e.preventDefault();
                        var location = 'bracket.php?subcategory=' + $(this).text();
                        location += "&category=" + $(this).closest('.dropdown').siblings('.dropdown').find('.topCat').text();
                        location += "&evid=" + $(this).closest('.dropdown').siblings('.expandong').data('eventid');
                        window.location = location;

                    });
                });
                lowCat_target = e.target;
            }
            if(btn.parent().siblings().length < 2){
                var newBtn = $('<div class="dropdown pull-left">' +
                                '<button class="btn btn-primary dropdown-toggle lowCat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                        'Category <span class="caret"></span>' +
                                    '</button>' +
                                    '<ul class="dropdown-menu">' +
                                        '<li>Loading...</li>' +
                                    '</ul>' +
                                '</div>');
                newBtn.css('margin-left', '-110px');
                newBtn.appendTo(btn.parent().parent('.groupSelect')).animate({'margin-left': '+=110'});
            }
            
        });
    </script>

</body>

</html>
