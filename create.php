<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

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
                <img class="img-responsive" src="http://placehold.it/1200x300" alt="">
            </div>
        </div>
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
                        <form>
                        	<div class="form-group">
                        		<label for="numCat">Number of Filters:</label>
                                <input class="form-control" type="number" id="numCat"/>
                        	</div>
                        	<div class="form-group" id="catNames">
                        		<label for="firstName">Category Names:</label>
                                <div class="row">
                                    <div class="input-group" id="firstCat">
                                        <input type="text" aria-label="Text input with segmented button dropdown" aria-describedby="subcat1" class="form-control"/>
                                        <div class="input-group-btn">
                                            <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                                Subcategories: <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu scrollable-menu">
                                                <li><a href="#" class="add-subcat">0</a></li>
                                                <li><a href="#" class="add-subcat">1</a></li>
                                                <li><a href="#" class="add-subcat">2</a></li>
                                                <li><a href="#" class="add-subcat">3</a></li>
                                                <li><a href="#" class="add-subcat">4</a></li>
                                                <li><a href="#" class="add-subcat">5</a></li>
                                                <li><a href="#" class="add-subcat">6</a></li>
                                                <li><a href="#" class="add-subcat">7</a></li>
                                                <li><a href="#" class="add-subcat">8</a></li>
                                                <li><a href="#" class="add-subcat">9</a></li>
                                                <li><a href="#" class="add-subcat">10</a></li>
                                                <li><a href="#" class="add-subcat">11</a></li>
                                                <li><a href="#" class="add-subcat">12</a></li>
                                                <li><a href="#" class="add-subcat">13</a></li>
                                                <li><a href="#" class="add-subcat">14</a></li>
                                                <li><a href="#" class="add-subcat">15</a></li>
                                                <li><a href="#" class="add-subcat">16</a></li>
                                                <li><a href="#" class="add-subcat">17</a></li>
                                                <li><a href="#" class="add-subcat">18</a></li>
                                                <li><a href="#" class="add-subcat">19</a></li>
                                                <li><a href="#" class="add-subcat">20</a></li>
                                                <li><a href="#" class="add-subcat">21</a></li>
                                                <li><a href="#" class="add-subcat">22</a></li>
                                                <li><a href="#" class="add-subcat">23</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
                        <form>
                        	<textarea class="form-control" placeholder="description..." rows="3" id="description"></textarea>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Service List -->
        <!--
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Summary</h2>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-tree fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Categories</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-car fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Date &amp; Time</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-support fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Description</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-database fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Four</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-bomb fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Five</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-bank fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Six</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Seven</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-space-shuttle fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Eight</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-recycle fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Service Nine</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo itaque ipsum sit harum.</p>
                    </div>
                </div>
            </div>
        </div>
        -->
        <!-- /.row -->

        <hr>
        
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
    
    <script>
        var holder = "<div class=\"row\"><div class=\"input-group\">"+
                                    "<input type=\"text\" aria-label=\"Text input with segmented button dropdown\" aria-describedby=\"subcat1\" class=\"form-control\"/>" +
                                    "<div class=\"input-group-btn\">"+
                                        "<button aria-expanded=\"false\" aria-haspopup=\"true\" data-toggle=\"dropdown\" class=\"btn btn-default dropdown-toggle\" type=\"button\">"+
                                            "Subcategories: <span class=\"caret\"></span>"+
                                            "<span class=\"sr-only\">Toggle Dropdown</span>"+
                                        "</button>"+
                                        "<ul class=\"dropdown-menu\">"+
                                            "<li><a href=\"#\" class=\"add-subcat\">0</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">1</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">2</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">3</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">4</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">5</a></li>"+
                                            "<li><a href=\"#\" class=\"add-subcat\">6</a></li>"+
                                        "</ul>"+
                                    "</div>"+
                                "</div></div>";
        var holder2 = "<div class=\"col-md-offset-1\"><div class=\"input-group\">"+
                                    "<span class=\"input-group-addon\" id=\"subcat1\">Subcategorie Name:</span>" +
                                    "<input type=\"text\" aria-label=\"Text input with segmented button dropdown\" aria-describedby=\"subcat1\" class=\"form-control\"/>" +
                                "</div></div>";
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
    		$('#firstCat').parent().siblings().remove();
    		for(var i = 0; i < num - 1; i++){
    			$(holder).animate('fade', 2000).appendTo('#catNames');
    		}
    	});
    	$('#datetimepicker1').datetimepicker();
    	$('#datetimepicker1').data("DateTimePicker").minDate(new Date());
        $('#save').click(function(e){
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
            $.post('eventHandler.php', {categories: JSON.stringify(category_settings), title: title, organization: org, date: date.format("YYYY-MM-DD HH:mm:ss"), description: desc}, function(data){
                console.log(data);
            })
            /*add extra forwardslash to eneble debugging
            console.log(JSON.stringify(category_settings));
            console.log(title);
            console.log(org);
            console.log(date.format("YYYY-MM-DD HH:mm:ss"));
            console.log(desc);
            //*/
        });
    </script>

</body>

</html>
