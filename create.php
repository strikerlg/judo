<?php
$src = '"http://placehold.it/1200x300"';
session_start();
$toReturn = array();
if(isset($_SESSION['admin']) AND isset($_GET['edit'])){
	$toReturn['mode'] = "edit";
    require('config.php');
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if($mysqli->connect_error){
        die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }
    $sql = "SELECT * FROM events WHERE evid = " . $_GET['eventid'];
    $result = $mysqli->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $toReturn['title'] = $row['title'];
        $toReturn['organization'] = $row['organization'];
        $toReturn['date'] = $row['date'];
        $toReturn['description'] = file_get_contents('events/'.$_GET['eventid'].'/description.txt');
		$toReturn['id'] = $_GET['eventid'];
        $src = '"images/events/files/' . str_replace("%20"," ",$row['pic']) . '"';
    }
}
else if(isset($_SESSION['admin'])){
	//case where new event?
	$toReturn['mode'] = "new";
}
else{
	header('Location: index.php');
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

    <!-- Navigation -->
    <?php include('navbar2.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">New Event</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Create Event</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Image Header -->
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" id="img-upload" src=<?php echo $src; ?> alt="">
            </div>
        </div>
        <input id="upload" type="file" name="files[]" style="display: none;">
        <!-- /.row -->

        <!-- Service Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Properties</h2>
            </div>
            <div class="col-lg-12">

                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-pencil"></i> Event Name</a>
                    </li>
                    <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-list"></i> Categories</a>
                    </li>
                    <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-clock-o"></i> Date &amp; Time</a>
                    </li>
                    <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-ellipsis-v"></i> Description</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                        <h4>Event Name</h4>
                        <form>
                        	<div class="form-group">
                        		<label for="title">Event Title:</label>
                        		<input type="text" class="form-control" id="title" />
                        	</div>
                        	<div class="form-group">
                        		<label for="org">Organization:</label>
                        		<input type="text" class="form-control" id="org" />
                        	</div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="service-two">
                        <h4>Categories</h4>
                        <div class="row">
                        	<table class="table table-condensed" id="athletes">
                        		<thead>
                        			<td>Name</td>
                        			<td>Weight</td>
                        			<td>Gender</td>
                        			<td>Age</td>
                        		</thead>
                        		<tbody id="table-content">
                        			<tr id="catdefault" class="info nodrop nodrag"><td colspan="4">Default Category</td></tr>
                        		</tbody>
                        	</table>
                        </div>
                        <form>
                        	<div class="form-group">
                        		<label for="numCat">Number of Filters:</label>
                                <input class="form-control" type="number" id="numCat" min="1" value="1"/>
                        	</div>
                        	<div class="form-group" id="catNames">
                        		<div class="row"><div class="input-group">
                                    <input type="text" data-targetcol="catdefault" class="form-control category" value="Default Category"/>
                                    <div class="input-group-btn">
                                        <button aria-expanded="false" class="btn btn-default" type="button">
                                            Category
                                        </button>
                                    </div>
                                </div></div>
                        	</div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="service-three">
							<h4>Date &amp; Time</h4>
							<div class="container">
								<div class="row">
									<div class='col-sm-6'>
										<div class="form-group">
											<div class='input-group date' id='datetimepicker1'>
												<input type='text' class="form-control" />
												<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    <div class="tab-pane fade" id="service-four">
                        <h4>Description</h4>
                        <textarea class="form-control" placeholder="description..." rows="3" id="description"></textarea>
                    </div>
                </div>

            </div>
        </div>

        <hr>
        <!-- TODO: remove delete if its a new event? -->
        <a href="#" id="delete" class="btn btn-danger btn-lg pull-left">Delete</a>
        <a href="#" id="save" class="btn btn-primary btn-lg pull-right">Save</a>
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

    <!-- moment -->
    <script src="js/moment.js"></script>

    <!--date picker -->
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="js/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="js/jquery.fileupload.js"></script>
    <!-- drag table -->
    <script src="https://cdn.jsdelivr.net/jquery.tablednd/0.8/jquery.tablednd.0.8.min.js"></script>

    <script>
        var metaData = <?php echo json_encode($toReturn); ?>;
        var generated = false;
        var brackets = {};
        $(document).ready(function(){
        	$.post('profileHandler.php', {'tableAll': true}, function(data){
						if(data.hasOwnProperty('rows')){
							data.rows.forEach(function(item, index){
	        			$('#table-content').append($('<tr id="row'+index+'"><td>'+item[0]+'</td><td>'+item[1]+'</td><td>'+item[2]+'</td><td>'+item[3]+'</td></tr>'));
	        		});
						}
        	}).done(function(){
        		$('#athletes').tableDnD({'hierarchyLevel': 3});
        	});
            if(metaData.mode == "edit"){
                //values here
                var categories = [];
                $.getJSON('events/' + metaData.id + '/categories.json', function(data){
                    categories = data;

                }).done(function(){
                    $('#title').val(metaData.title);
                    $('#org').val(metaData.organization);
                    $('#datetimepicker1').datetimepicker();
                    $('#datetimepicker1').data("DateTimePicker").date(moment(metaData.date));
                    $('#description').val(metaData.description);
                    $('#numCat').val(categories.length).change();
                    console.log(categories);
                    $('#catNames').children().each(function(i, data){
                        $(data).find('.input-group').find('input').val(categories[i].title);
                        var options = $(data).find('.input-group').find('.input-group-btn').find('.scrollable-menu').children();
                        $(options[categories[i].children.length]).find('a').click();
                        var subOptions = $(this).find('.col-md-offset-1').find('.input-group').children('input');
                        for(var j = 0; j < categories[i].children.length; j++){
                            $(subOptions[j]).val(categories[i].children[j]);
                        }
                    });
                    //$('#catNames').children();
                });

            }
            else{
            	$('#datetimepicker1').datetimepicker();
    			$('#datetimepicker1').data("DateTimePicker").minDate(new Date());
            }
        });
        var eventId;
        var holder = "<div class=\"row\"><div class=\"input-group\">"+
                                    "<input type=\"text\" data-targetcol=\"0\" class=\"form-control category\"/>" +
                                    "<div class=\"input-group-btn\">"+
                                        "<button aria-expanded=\"false\" class=\"btn btn-default\" type=\"button\">"+
                                            "Category"+
                                        "</button>"+
                                    "</div>"+
                                "</div></div>";
        var holder2 = "<div class=\"col-md-offset-1\"><div class=\"input-group\">"+
                                    "<span class=\"input-group-addon\" id=\"subcat1\">Subcategorie Name:</span>" +
                                    "<input type=\"text\" aria-label=\"Text input with segmented button dropdown\" aria-describedby=\"subcat1\" class=\"form-control\"/>" +
                                "</div></div>";
        $('#catNames').delegate('input', 'keyup', function(e){
        	$('#'+$(this).data('targetcol')).find('td:first').text($(this).val());
        });
        $('#catNames').delegate('.add-subcat', 'click', function(e){
            e.preventDefault();
            var sub = parseInt($(this).text());
            $(this).parent().parent().parent().parent().siblings('.col-md-offset-1').remove();
            for(var i = 0; i < sub; i++){
                $(holder2).animate('fade', 1000).appendTo($(this).parent().parent().parent().parent().parent());
            }
            console.log(sub);
        });

    	var placehold = ["Second Category", "Third Category", "Fourth Category", "Fith Category"]
    	$('#numCat').change(function(e){
            e.preventDefault();
    		var num = $('#numCat').val();
    		$('#catNames').children().not(':first').remove();
    		$('#athletes .added').remove();
    		for(var i = 0; i < num-1; i++){
    			$('<tr id="cat'+i+'" class="nodrag info added"><td>Category Name Here</td><td></td><td></td><td></td></tr>').insertAfter('#athletes .nodrop');
    			var $tmp =$(holder);
    			$tmp.find('input').data('targetcol', 'cat'+i);
    			$tmp.animate('fade', 2000).appendTo('#catNames');
    		}
    	});


    $('#img-upload').click(function(e){
        $('#upload').trigger('click');
    });
    $('#upload').click(function(){
        $('#progress').show();
    })
    $('#delete').click(function(e){
        e.preventDefault();
        if(metaData.mode == 'edit'){
            $.post('events/eventHandler.php', {delete: true, eventid: metaData.id}, function(data){
                if(data){
                    window.location = 'events.php';
                }
            });
        }
        else
            window.location = 'events.php';


    });
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = 'images/events/';
        var pid;
        $('#upload').fileupload({
            url: url,
            dataType: 'json',
            add: function(e, data){
                console.log(data.files[0].name);
                data.context = $('#save');
                data.context.click(function (e) {
                    e.preventDefault();
                    data.context.text('Uploading...').replaceAll($(this));
                    data.submit();
                });
            },
            done: function (e, data) {
                var pic;
                $.each(data.result.files, function (index, file) {
                    pic = file.name;
                });
                var title = $('#title').val();
                var org = $('#org').val();
                var date = $('#datetimepicker1').data("DateTimePicker").date()
                var desc = $('#description').val();
                var firstCats = $('#catNames').children();

                var category_settings = [];
                firstCats.each(function(i){
                    var curr_sub = $(this);
                    console.log(curr_sub);
                    var obj = {title: curr_sub.find('input').val(), children: []};
                    //category_settings["category_" + i]["title"] = curr_sub.find('input').val();
                    if(curr_sub.children().length > 1){
                        curr_sub.children('.col-md-offset-1').each(function(j){
                            obj.children.push($(this).find('input').val());
                        });
                    }
                    category_settings.push(obj);
                });
                var post = {generated: generate, edit: metaData.mode == 'edit'? true: false , categories: JSON.stringify(category_settings), title: title, organization: org, date: date.format("YYYY-MM-DD HH:mm:ss"), pic: pic, description: desc};
                if(generate){
                	post.brackets = JSON.stringify(brackets);
                }
                if(metaData.mode == 'edit'){
                    post = {evnetid: metaData.id ,edit: true, categories: JSON.stringify(category_settings), title: title, organization: org, date: date.format("YYYY-MM-DD HH:mm:ss"), pic: pic, description: desc};
                }
                $.post('events/eventHandler.php', post, function(data2){
                    console.log(data2);
                    eventId = data2.eventId;
                    if(data2.hasOwnProperty('success')){
                		$('#save').text('Saved');
		                setTimeout(function(){
		                    window.location= 'events.php';
		                }, 2000);
		            }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
            },
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(jpe?g)$/i
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
    </script>

</body>

</html>
