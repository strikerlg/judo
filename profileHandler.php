<?php
	header('Content-Type: application/json');
	$toReturn = array();
	if(isset($_POST['name'])){
		$name = $_POST['name'];
		$weight = $_POST['weight'];
		$height = $_POST['weight'];

		if(empty($name)){
			$toReturn['error'] = "Name is empty.";
		}
		else if(empty($weight)){
			$toReturn['error'] = "Weight is empty.";
		}
		else if(empty($height)){
			$toReturn['error'] = "Height is empty.";
		}
		else if(!is_numeric($height)){
			$toReturn['error'] = "Invalid height.";
		}
		elseif(!is_numeric($weight)){
			$toReturn['error'] = "Invalid weight.";
		}
		else{
			$pid = ord($name) . "" . rand(1000, 9999);
			$toReturn['success'] = "No errors";
			$toReturn['pid'] = $pid;
			$mysqli = new mysqli("129.108.32.61", "ctis", "19691963", "judo");
			if($mysqli->connect_error){
				die('Connect Error (' . $mysqli->connect_errno . ') '
            	. $mysqli->connect_error);
			}
			$sql = "INSERT INTO profiles (pid, name, weight, height) VALUES(" . $pid . ", '" . $name . "', " . $weight . ", " . $height . ")";
			$result = $mysqli->query($sql);
			$toReturn['result'] = $result;
		}
	}
	else if(isset($_POST['pic'])){
		$pid = $_POST['pid'];
		$pic = $_POST['pic'];
		//do sql insert of pic where pid
		$mysqli = new mysqli("129.108.32.61", "ctis", "19691963", "judo");
		if($mysqli->connect_error){
			die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
		}
		$sql = "UPDATE profiles SET pic = '" . $pic . "' WHERE pid = " . $pid;
		$result = $mysqli->query($sql);
		$toReturn['result'] = $result;
		$mysqli->close();
	}
	
	echo json_encode($toReturn);
?>