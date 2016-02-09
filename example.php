<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">

		<title>Welcome to CTIS</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/jquery.bracket.min.css" />

	</head>

	<body>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div id="minimal">
					<div class="demo"></div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
		<script type="text/javascript" src="js/jquery.bracket.min.js"></script>

		<script>
			var doubleEliminationData = {
				teams : [["Team 1", "Team 2"], ["Team 3", "Team 4"]],
				results : [
					[/* WINNER BRACKET */[[1, 2], [3, 4]], /* first and second matches of the first round */
					[[5, 6]] /* second round */
					], 
					[/* LOSER BRACKET */[[7, 8]], /* first round */
					[[9, 10]] /* second round */
					], 
					[/* FINALS */[[1, 12], [13, 14]], [[15, 16]] /* LB winner won first round so need a rematch */
					]
				]
			}
			
			function saveFn(data, userData) {
			    var json = jQuery.toJSON(data)
			    console.log(json);
			}
			$(function() {
				$('#minimal .demo').bracket({
					init : doubleEliminationData, /* data to initialize the bracket with */
					save: saveFn
				})
			})
		</script>
	</body>

</html>
