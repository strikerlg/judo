<?php
	if(isset($_POST['title'])){
		$toReturn = [];
		//get all the variables from create event page
		$title = $_POST['title'];
		$org = $_POST['organization'];
		$categories = json_decode($_POST['categories']);
		$date = $_POST['date'];
		$desc = $_POST['description'];

		//generate random id for event
		$eventId = ord($title) . "" . rand(10000, 99999);

		//add event to database
		$mysqli = new mysqli("129.108.32.61", "ctis", "19691963", "judo");
		if($mysqli->connect_error){
			die('Connect Error (' . $mysqli->connect_errno . ') '
           	. $mysqli->connect_error);
		}
		$sql = "INSERT INTO events (evid, title, organization, date) VALUES(" . $eventId . ", '" . $title . "', '" . $org . "', '" . $date . "')";
		$result = $mysqli->query($sql);
		$toReturn['result'] = $result;

		//write files
		if($result){
			mkdir($eventId);
			$fjson = fopen($eventId . "/categories.json", "w");
			$ftext = fopen($eventId . "/description.txt", "w");
			fwrite($fjson, json_encode($categories));
			fwrite($ftext, $desc);
			fclose($fjson);
			fclose($ftext);
		}
			
		echo json_encode($toReturn);
	}
?>