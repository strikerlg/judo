<?php
session_start();
if (isset($_POST['submit'])){
	if ($_POST['username'] == "admin"){
		$_SESSION['admin'] = true;
	}
}
if(isset($_GET['logout'])){
	$_SESSION = [];
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

    <title>Judo</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="css/jquery.fileupload.css">
	<!-- date picker -->
    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Profile</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="profileForm">
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputName" placeholder="name" name="name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputHeight" class="col-sm-2 control-label">Height</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputHeight" placeholder="height" name="height">
								</div>
							</div>
							<div class="form-group">
								<label for="inputWeight" class="col-sm-2 control-label">Weight</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputWeight" placeholder="weight" name="weight">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCategory" class="col-sm-2 control-label">Sex</label>
								<div class="col-sm-10">
									<label class="radio-inline">
									  <input type="radio" name="sex" id="male-option" value="m" checked> Male
									</label>
									<label class="radio-inline">
									  <input type="radio" name="sex" id="female-option" value="f"> Female
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="inputCategory" class="col-sm-2 control-label">Club</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputClub" placeholder="club" name="club">
								</div>
							</div>
							<div class="form-group">
								<label for="datetimepicker1" class="col-sm-2 control-label">DOB</label>
								<div class="col-sm-10">
									<div class='input-group date' id='datetimepicker1'>
										<input type='text' class="form-control" name="birthdate" />
										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPicture" class="col-sm-2 control-label">Profile Photo</label>
								<div class="col-sm-10">
									<span class="btn btn-success fileinput-button">
								        <i class="glyphicon glyphicon-plus"></i>
								        <span>Select image...</span>
								        <!-- The file input field used as target for the file upload widget -->
								        <input id="upload" type="file" name="image">
								    </span>
								</div>
							</div>
							<div class="row" id="files">
								<div id="progress" class="progress" style="display: none;">
							        <div class="progress-bar progress-bar-success"></div>
							    </div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary" id="save">
							Save changes
						</button>
					</div>
				</div>
			</div>
		</div>

    <?php 
    if(isset($_SESSION['admin'])){
    	include('navbar2.php');
    }
	else{
		include('navbar.php');
	} 
	?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide " style="height: 100%;" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" ></li>
            <li data-target="#myCarousel" data-slide-to="2" ></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/slide1.png');"></div>
                <div class="carousel-caption">
                    <h2>Wrestling Tracker</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/slide2.png');"></div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/slide3.png');"></div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Quick Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Judo dojo
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> View athlete stats</h4>
                    </div>
                    <div class="panel-body">
                        <p>View the statistics of different athletes and their achievments. Can't find yourself in our records? Fill out our form to get started!</p>
                        <a href="people.php" class="btn btn-default">View athletes</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Form</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Follow Events</h4>
                    </div>
                    <div class="panel-body">
                        <p>View past event results and follow current events live with our modern bracket viewer!</p>
                        <a href="events.php" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i> View our Gallery</h4>
                    </div>
                    <div class="panel-body">
                        <p>All photos taken, available in one single place! Contact our administrators if you have pictures of your own and want them to be displayed.</p>
                        <a href="#" class="btn btn-default">Go to Gallery</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Gallery preview Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Gallery</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehopostld.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">post
                    <p>Copyright &copy; Your Website 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="js/jquery.ui.widget.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="js/jquery.fileupload.js"></script>
	<!-- moment -->
    <script src="js/moment.js"></script>
	<!--date picker -->
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    
    <!-- Script to do image uploads -->
    <script>
    $(document).ready(function(){
    	$('#datetimepicker1').datetimepicker({
    		'viewMode':'decades',
    		'minDate':"1960",
    		'maxDate':moment(),
    		'format':"Y-M-D"
    		});
    });
    $('#save').click(function(){
    	var formdata = new FormData($('form')[0]);
        formdata.append('insert', true);
        $.ajax({
        	'method':'post',
        	'url':'profileHandler.php',
        	'data':formdata,
        	'contentType': false,
        	'processData': false,
        	'success':function(responsedata){
        		$('#myModal').modal('hide');
        	}
        });
    });
	$('#myModal').on('hide.bs.modal', function(e){
		$('#inputName').val("");
		$('#inputHeight').val("");
		$('#inputWeight').val("");
		$('#inputCategory').val("");
		$('#inputClub').val("");
		$('#datetimepicker1').children('input').val("");
		$('#files').empty();
		$('#upload').siblings('span').text("Select image");
	});
	</script>

</body>

</html>
