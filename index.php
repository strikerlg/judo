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

    <title>Wrestling</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="css/jquery.fileupload.css">

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
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputName" placeholder="name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputHeight" class="col-sm-2 control-label">Height</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputHeight" placeholder="height">
								</div>
							</div>
							<div class="form-group">
								<label for="inputWeight" class="col-sm-2 control-label">Weight</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputWeight" placeholder="weight">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCategory" class="col-sm-2 control-label">Category</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputCategory" placeholder="category">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPicture" class="col-sm-2 control-label">Profile Photo</label>
								<div class="col-sm-10">
									<span class="btn btn-success fileinput-button">
								        <i class="glyphicon glyphicon-plus"></i>
								        <span>Select files...</span>
								        <!-- The file input field used as target for the file upload widget -->
								        <input id="upload" type="file" name="files[]" multiple>
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
						<button type="button" class="btn btn-primary" id="save">
							Save changes
						</button>
					</div>
				</div>
			</div>
		</div>

    <?php if(isset($_SESSION['admin'])){
    	include('navbar2.php');
    }
	else{
		include('navbar.php');
	} 
	?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/wrestle.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Wrestling Tracker</h2>
                </div>
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
                    Welcome to Modern Wrestling
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> View wrestler stats</h4>
                    </div>
                    <div class="panel-body">
                        <p>View the statistics of different wrestlers and their achievments. Can't find yourself in our records? Fill out our form to get started!</p>
                        <a href="people.php" class="btn btn-default">View Wrestlers</a>
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
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
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
    
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="js/jquery.ui.widget.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="js/jquery.fileupload.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    
    <!-- Script to do image uploads -->
    <script>
    $('#upload').click(function(){
    	$('#progress').show();
    })
	/*jslint unparam: true */
	/*global window, $ */
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = 'images/uploads/';
	    $('#upload').fileupload({
	        url: url,
	        dataType: 'json',
	        add: function(e, data){
	        	data.context = $('#save');
	        	data.context.click(function () {
                    data.context.text('Uploading...').replaceAll($(this));
                    data.submit();
                });
	        },
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
	                $('<p/>').text(file.name).appendTo('#files');
	            });
	            $('#save').text('Saved');
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        },
	        maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>

</body>

</html>
