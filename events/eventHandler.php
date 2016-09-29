<?php
	require('../config.php');
	function rrmdir($src) {
	    $dir = opendir($src);
	    while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' )) {
	            $full = $src . '/' . $file;
	            if ( is_dir($full) ) {
	                rrmdir($full);
	            }
	            else {
	                unlink($full);
	            }
	        }
	    }
	    closedir($dir);
	    rmdir($src);
	}
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if($mysqli->connect_error){
		die('Connect Error (' . $mysqli->connect_errno . ') '
       	. $mysqli->connect_error);
	}
	if(isset($_POST['delete'])){
		$sql = "DELETE FROM events WHERE evid = " . $_POST['eventid'];
		$result = $mysqli->query($sql);
		//del dir
		rrmdir($_POST['eventid']."");
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
				for($i = 1; $i <= count($categories); $i++){
					$sql = "INSERT INTO categories VALUES($eventId, '". $categories[$i]['title'] . "', $i)";
					if($mysqli->query($sql)){
						$participants = $categories[$i]['participants'];
						for($j = 0; $j < count($participants); $j++){
							$sql = "INSERT INTO participants VALUES($i, '". $participants[$j]['name'] ."', ". $participants[$j]['id'].", $eventId)";
							if(!$result){
								echo "An error occured";
								exit();
							}
						}
					}
				}
				/*
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
				}*/
			}
				
			echo json_encode($toReturn);
		}
		else{
			//new event?
			$toReturn = [];
			//get all the variables from create event page
			$title = $_POST['title'];
			$org = $_POST['organization'];
			$categories = json_decode($_POST['categories'], true);
			$date = $_POST['date'];
			$desc = $_POST['description'];
			$pic = $_POST['pic'];
			if(isset($_POST['generated']) AND $_POST['generated']){
				$brackets = json_decode($_POST['brackets'], true);
			}

			//generate random id for event
			$eventId = ord($title) . "" . rand(10000, 99999);
			$toReturn['evid'] = $eventId;
			//add event to database
			$sql = "INSERT INTO events (evid, title, organization, date, pic, description) VALUES(" . $eventId . ", '" . $title . "', '" . $org . "', '" . $date . "', '". $pic ."', '$desc')";
			$result = $mysqli->query($sql);
			$toReturn['result'] = $result;
			$toReturn['sql'] = $sql;

			//write files
			if($result){
				for($i = 1; $i <= count($categories); $i++){
					$sql = "INSERT INTO categories VALUES($eventId, '". $categories[$i-1]['title'] . "', $i)";
					if($mysqli->query($sql)){
						$toReturn['status'] = "Entered for participants";
						$participants = $categories[$i-1]['participants'];
						for($j = 0; $j < count($participants); $j++){
							$sql = "INSERT INTO participants VALUES($i, '". $participants[$j]['name'] ."', ". $participants[$j]['id'].", $eventId)";
							$result = $mysqli->query($sql);
							if(!$result){
								echo "An error occured";
								exit();
							}
						}
					}
				}
				$toReturn['success'] = true;
			}
				
			echo json_encode($toReturn);
		}
		
	}
	else if(isset($_POST['expandong'])){
		$evid = $_POST['eventid'];
		$sql = "SELECT * FROM categories WHERE evid = $evid";
		$result = $mysqli->query($sql);
		if($result){
			$categories = $result->fetch_all();
			$toReturn['categories'] = $categories;
		}
		header('Content-Type: application/json');
		echo json_encode($toReturn);
	}
	else if(isset($_POST['getBracket'])){
		//get bracket
		$eventid = $_POST['eventid'];
		$catid = $_POST['catid'];
		$sql = "SELECT participant FROM judo.participants WHERE catevid = $eventid AND catid = $catid";
		$result = $mysqli->query($sql);
		if($result){
			$names = $result->fetch_all();
			$num_teams = 1;
			for($j = 1; $j*2 <= $result->num_rows; $j *=2){
				$num_teams = $j;
			}
			$teams = array();
			$results = array();
			for($j = 1; $j <= $num_teams; $j++){
				if(2*$j <= $result->num_rows){
					array_push($teams, array($names[2*$j-2][0], $names[2*$j-1][0]));
				}
				else if(2*$j-1 == $result->num_rows){
					array_push($teams, array($names[2*$j-2][0], "bye"));
				}
				else{
					array_push($teams, array("bye", "bye"));
				}
			}
			$toReturn = array('teams'=>$teams, "results"=>$results);
			header('Content-Type: application/json');
			echo json_encode($toReturn);
		}
	}
	else if(isset($_POST['generate'])){
		$sql = "SELECT MAX(weight), MIN(weight) FROM profiles";
		$result = $mysqli->query($sql);
		$maxMin = $result->fetch_all();
		$difference = $maxMin[0][0] - $maxMin[0][1];
		$step = $difference / 4;
		$toReturn['categories'] = array();
		$toReturn['brackets'] = array();
		//generate the categories for the event
		for($i = $maxMin[0][1]; $i < $maxMin[0][0]; $i += $step){
			$title = $i . " to " . ($i+$step);
			array_push($toReturn['categories'], array('title'=>$title, 'children'=>array()));
			$sql = "SELECT name FROM profiles WHERE weight BETWEEN $i and ".($i+$step);
			$result = $mysqli->query($sql);
			$names = $result->fetch_all();
			$num_teams = 1;
			for($j = 1; $j*2 <= $result->num_rows; $j *=2){
				$num_teams = $j;
			}
			$teams = array();
			$results = array();
			for($j = 1; $j <= $num_teams; $j++){
				if(2*$j <= $result->num_rows){
					array_push($teams, array($names[2*$j-2][0], $names[2*$j-1][0]));
				}
				else if(2*$j-1 == $result->num_rows){
					array_push($teams, array($names[2*$j-2][0], "bye"));
				}
				else{
					array_push($teams, array("bye", "bye"));
				}
			}
			$toReturn['brackets'][$title] = array('teams'=>$teams, "results"=>$results);
		}
		header('Content-Type: application/json');
		echo json_encode($toReturn);
	}
?>