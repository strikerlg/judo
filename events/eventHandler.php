<?php
	require('../config.php');
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if($mysqli->connect_error){
		die('Connect Error (' . $mysqli->connect_errno . ') '
       	. $mysqli->connect_error);
	}
	if(isset($_POST['delete'])){
		$sql = "DELETE FROM events WHERE evid = " . $_POST['eventid'];
		$result = $mysqli->query($sql);
		echo result;
	}
	if(isset($_POST['edit'])){
		if($_POST['edit'] == 'true'){
			$toReturn = [];
			//get all the variables from create event page
			$title = $_POST['title'];
			$org = $_POST['organization'];
			$categories = json_decode($_POST['categories'], true);
			$date = $_POST['date'];
			$desc = $_POST['description'];
			$pic = $_POST['pic'];

			//generate random id for event
			$eventId = $_POST['evnetid'];
			//add event to database
			$sql = "UPDATE events SET title = '" . $title . "', organization = '" . $org . "', date = '" . $date . "', pic = '". $pic ."' WHERE evid = " . $eventId;
			$result = $mysqli->query($sql);
			$toReturn['result'] = $result;
			$toReturn['sql'] = $sql;

			//write files
			if($result){
				$fjson = fopen($eventId . "/categories.json", "w");
				$ftext = fopen($eventId . "/description.txt", "w");
				fwrite($fjson, json_encode($categories));
				fwrite($ftext, $desc);
				fclose($fjson);
				fclose($ftext);

				$bracket = (object)array('teams' => array(), 'results' => array());
				for($i = 0; $i < count($categories); $i++){
					$cat_dir = $eventId . "/" . $categories[$i]['title'];
					if(!is_dir($cat_dir))
						mkdir($cat_dir);
					for($j = 0; $j < count($categories[$i]['children']); $j++){
						$fbracket = fopen($cat_dir . "/" . $categories[$i]['children'][$j] . ".json" , "w");
						fwrite($fbracket, json_encode($bracket));
						fclose($fbracket);
					}
				}
			}
				
			echo json_encode($toReturn);
		}
		else{
			$toReturn = [];
			//get all the variables from create event page
			$title = $_POST['title'];
			$org = $_POST['organization'];
			$categories = json_decode($_POST['categories'], true);
			$date = $_POST['date'];
			$desc = $_POST['description'];
			$pic = $_POST['pic'];

			//generate random id for event
			$eventId = ord($title) . "" . rand(10000, 99999);
			$toReturn['evid'] = $eventId;
			//add event to database
			$sql = "INSERT INTO events (evid, title, organization, date, pic) VALUES(" . $eventId . ", '" . $title . "', '" . $org . "', '" . $date . "', '". $pic ."')";
			$result = $mysqli->query($sql);
			$toReturn['result'] = $result;
			$toReturn['sql'] = $sql;

			//write files
			if($result){
				mkdir($eventId);
				$fjson = fopen($eventId . "/categories.json", "w");
				$ftext = fopen($eventId . "/description.txt", "w");
				fwrite($fjson, json_encode($categories));
				fwrite($ftext, $desc);
				fclose($fjson);
				fclose($ftext);

				$bracket = (object)array('teams' => array(), 'results' => array());
				for($i = 0; $i < count($categories); $i++){
					$cat_dir = $eventId . "/" . $categories[$i]['title'];
					mkdir($cat_dir);
					for($j = 0; $j < count($categories[$i]['children']); $j++){
						$fbracket = fopen($cat_dir . "/" . $categories[$i]['children'][$j] . ".json" , "w");
						fwrite($fbracket, json_encode($bracket));
						fclose($fbracket);
					}
					if(count($categories[$i]['children'])== 0){
						$fbracket = fopen($cat_dir . "/default.json" , "w");
						fwrite($fbracket, json_encode($bracket));
						fclose($fbracket);
					}
				}
			}
				
			echo json_encode($toReturn);
		}
		
	}
	else if(isset($_POST['generate'])){
		//TODO: get the weights of the wrestlers and generate categories
		$sql = "SELECT * FROM profiles";
		$result = $mysqli->query($sql);
		$toReturn = array(array('title'=>'Test', 'children'=>array()));
		header('Content-Type: application/json');
		echo json_encode($toReturn);
	}
?>