<?php
	$pic = "cage.jpg";
	$weight = "0.0";
	$height = "0.0";
	$name = "Nicolas Cage";
	$category = "Human";
	session_start();
	$id = $_GET['id'];
	$mysql = new mysqli("localhost", "root", "1969", "judo");
    if($mysql->connect_error){
        die('Connect Error (' . $mysql->connect_errno . ') '. $mysql->connect_error);
    }
    $sql = "SELECT * FROM profiles WHERE pid = " . $id;
    $conn = $mysql->query($sql);
    if($conn->num_rows > 0){
    	$row = $conn->fetch_assoc();
		$pic = $row['pic'];
		$weight = $row['weight'];
		$height = $row['height'];
		$name = $row['name'];
		$category = $row['category'];
    }
    $mysql->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<?php
	 if(isset($_SESSION['admin'])){
    	include('navbar2.php');
    }
	else{
		include('navbar.php');
	}
	?>

    <!-- Full Width Image Header -->
    <header class="header-image" style="background: url('images/wrestler.jpg') no-repeat center center scroll;">
        <div class="headline">
            <div class="container">
                <h1>Athlete</h1>
                <h2><?php echo $name; ?></h2>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive pull-right" src=<?php echo "\"images/profile/files/" . $pic . "\""; ?> style="height: 700px">
            <h2 class="featurette-heading"><?php echo $name; ?>
                <span class="text-muted">Will Catch Your Eye</span>
            </h2>
            <h4>Height:</h4>
            <p><?php echo $height; ?></p>
            <h4>Weight:</h4>
            <p><?php echo $weight; ?></p>
            <h4>Category:</h4>
            <p><?php echo $category; ?></p>
            <h4>Matches:</h4>
            <p>0</p>
            <h4>Wins:</h4>
            <p>0</p>
        </div>

        <hr class="featurette-divider">
        <div class="row">
        	<div class="col-md-6 col-md-offset-3 text-center">
        		<a class="btn btn-danger" id="delete" href="#">Delete user</a>
        	</div>
        </div>

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
    	$("#delete").click(function(e){
    		e.preventDefault();
    		$.ajax({
		    url: 'http://localhost/judo/images/profile/index.php?file=Reyes%2C%20Gerardo.jpg',
		    type: 'DELETE',
		    success: function(result) {
		        // Do something with the result
		      
		    }
});
    	});
    </script>
</body>

</html>
