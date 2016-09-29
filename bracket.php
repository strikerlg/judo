<?php
    session_start();
    $nav = file_get_contents('navbar.php');
    $evid = $_GET['event'];
    $category = $_GET['category'];
    $title = "Tournament Name";
    if(isset($_SESSION['admin'])){
        $nav = file_get_contents('navbar2.php');
    }
    require('config.php');
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if($mysqli->connect_error){
        die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    }
    $sql = "SELECT * FROM events WHERE evid = " . $evid;
    $result = $mysqli->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $title = $row['title'];
    }
    $sql = "SELECT name FROM profiles";
    $result = $mysqli->query($sql);
    $autocomplete = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($autocomplete, $row['name']);
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Bracket -->
    <link rel="stylesheet" type="text/css" href="css/jquery.bracket.min.css" />

    <!-- Jquery ui -->
    <link href="css/jquery-ui.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php echo $nav ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title ?>
                    <small><?php echo $category; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Tournament</li>
                    <li>
                        <div class="btn-group groupSelect" role="group" aria-label="...">
                            <button data-expanded="false" type="button" class="btn btn-primary" id="expandong" data-eventId=<?php echo '"' . $evid . '"';?>>Other Brackets <i class="fa fa-angle-right"></i></a>
                        </div>
                    </li>
                </ol>
                
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="jumbotron" style="background:rgb(228, 246, 221) !important">
                    
                </div>
            </div>

        </div>

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

    <!-- jquery ui -->
    <script src="js/jquery-ui.js"></script>
    
    <!-- bracket -->
    <script type="text/javascript" src="js/jquery.bracket.min.js"></script>
    
    <script>
    
        var eventId = <?php echo $evid; ?>;
        var cat = <?php echo $category; ?>;
		var saveData = {};
		function getBracket(){
			$.post('events/eventHandler.php', {'getBracket': true, 'eventid': eventId, 'catid': cat}).done(function(data){
	            var container = $('.jumbotron');
	            container.bracket({
	                init: data,
	                <?php if(isset($_SESSION['admin'])) echo "save: saveFn,"; ?>
	                decorator: {edit: editFn, render: acRenderFn}
	            });
	        });
		}
		getBracket();
		setInterval(function(){
			getBracket();
		}, 20000);
        var acdata = <?php echo json_encode($autocomplete); ?>;
        function editFn(container, data, doneCb){
            var input = $('<input type="text">');
            input.val(data);
            input.autocomplete({source: acdata});
            input.blur(function() { doneCb(input.val()) });
            input.keyup(function(e) { if ((e.keyCode||e.which)===13) input.blur() });
            container.html(input);
            input.focus();
        }
        function acRenderFn(container, data, score) {
            container.append(data);        }
		function saveFn(data, userData) {
		  var json = JSON.stringify(data);
		  console.log(json);
          $.post('events/jsonHandler.php', {request: "update", eventid: eventId, maincategory: cat, subcategory: subCat, newBracket: json});
		}
        //code for the bracket selector:
        var topCat_data;
        var topCat_target;
        var lowCat_data;
        var lowCat_target;
        $('#expandong').click(function(e){
            var $btn = $(this);
            if(e.target != topCat_target && !$btn.data("expanded")){
                $.post('events/eventHandler.php', {'expandong': true, eventid: $btn.data('eventid')}).done(function(categories){
                    var $ul = $(e.target).closest('.groupSelect').find('.topCat').siblings();
                    $ul.children().remove();
                    categories.categories.forEach(function(e, i){
                    	$ul.append('<li><a class="subCat" href="bracket.php?event='+e[0]+'&category='+e[2]+'">'+e[1]+'</a></li>');
                    })
                });
                topCat_target = e.target;
            }
    		if (!$btn.data("expanded")){
                if($btn.siblings().length < 1){
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
                    $btn.siblings().show();
                }

    			$btn.find('i').prop('class','fa fa-angle-left');
    			$btn.data('expanded', true);
    		}
    		else {
    			var siblings = $btn.siblings()
    			siblings.each(function(key, value){
    				$(siblings[key]).hide();
    			});
    			$btn.find('i').prop('class','fa fa-angle-right');
    			$btn.data('expanded', false);
    		}

    	});
    </script>

</body>

</html>
