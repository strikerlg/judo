<?php
    $event_template = '<div class="col-md-8">

                <!-- Event -->
                <h2>
                    <a href="#">Event Example</a>
                </h2>
                <p class="lead">
                    by <a href="#">Generic Organization</a>
                </p>
                <p><i class="fa fa-clock-o"></i> On August 28, 2013 at 10:00 PM</p>
                <hr>
                <a href="blog-post.html">
                    <img class="img-responsive img-hover" src="images/wrestling-tournament.png" alt="">
                </a>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <div class="btn-group" id="groupSelect" role="group" aria-label="...">
                    <button data-expanded="false" type="button" class="btn btn-primary" id="expandong">View Bracket <i class="fa fa-angle-right"></i></a>
                    
                </div>
                

                <hr>';
    $mysqli = new mysqli("129.108.32.61", "ctis", "19691963", "judo");
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
    <?php include('navbar.php'); ?>

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
                        echo '<div class="col-md-8">

                                <!-- Event -->
                                <h2>
                                    <a href="#">'. $row['title'] .'</a>
                                </h2>
                                <p class="lead">
                                    by <a href="#">'. $row['organization'] .'</a>
                                </p>
                                <p><i class="fa fa-clock-o"></i> On '. $row['date'] .'</p>
                                <hr>
                                <a href="blog-post.html">
                                    <img class="img-responsive img-hover" src="images/wrestling-tournament.png" alt="">
                                </a>
                                <hr>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                                <div class="btn-group" id="groupSelect" role="group" aria-label="...">
                                    <button data-expanded="false" type="button" class="btn btn-primary" id="expandong">View Bracket <i class="fa fa-angle-right"></i></a>
                                    
                                </div>
                                

                                <hr>';
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
    	$('#expandong').click(function(e){
    		var btn = $(this);
    		if (!btn.data("expanded")){
    			var newBtn = $('<a class="btn btn-primary" href="bracket.php?category=cadets">Cadets</a><a class="btn btn-primary" href="bracket.php?category=juniors">Juniors</a><a class="btn btn-primary" href="bracket.php?category=seniors">Seniors</a>');
    			newBtn.css('margin-left', '-110px');
    			newBtn.appendTo($('#groupSelect')).animate({'margin-left': '+=110'});
    			btn.find('i').prop('class','fa fa-angle-left');
    			btn.data('expanded', true);
    		}
    		else {
    			var siblings = btn.siblings()
    			siblings.each(function(key, value){
    				$(siblings[key]).remove();
    			});
    			btn.find('i').prop('class','fa fa-angle-right');
    			btn.data('expanded', false);
    		}
    		
    	});
    </script>

</body>

</html>
