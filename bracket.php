<?php
    session_start();
    $nav = file_get_contents('navbar.php');
    $evid = $_GET['evid'];
    $category = $_GET['category'];
    $subcat = $_GET['subcategory'];
    $title = "Tournament Name";
    if(isset($_SESSION['admin'])){
        $nav = file_get_contents('navbar2.php');
    }
    $mysqli = new mysqli("129.108.32.61", "ctis", "19691963", "judo");
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
        var cat = <?php echo '"'.$category.'"'; ?>;
        var subCat = <?php echo '"'.$subcat.'"'; ?>;
		var saveData = {};
        $.getJSON('events/' + eventId + '/' + cat + '/' + subCat + ".json", function(data){
            saveData = data;
        }).done(function(){
            var container = $('.jumbotron');
            container.bracket({
                init: saveData,
                <?php if(isset($_SESSION['admin'])) echo "save: saveFn,"; ?>
                userData: "save.php",
                decorator: {edit: editFn, render: acRenderFn}
            });
        });
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
		  /* You probably want to do something like this
		  jQuery.ajax("rest/"+userData, {contentType: 'application/json',
		                                dataType: 'json',
		                                type: 'post',
		                                data: json})
		  */
		}
        /*
    	$(function(){
    		var container = $('.jumbotron');
    		container.bracket({
    			init: saveData,
    			<?php if(isset($_SESSION['admin'])) echo "save: saveFn,"; ?>
    			userData: "save.php"
    		});
    	})//*/
    </script>

</body>

</html>
