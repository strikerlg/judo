<?php
	$toReturn = array();
	require('config.php');
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if($mysqli->connect_error){
		die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
	}
	if(isset($_POST['name'])){
		$name = $_POST['name'];
		$weight = $_POST['weight'];
		$height = $_POST['weight'];
		$category = $_POST['category'];

		if(empty($name)){
			$toReturn['error'] = "Name is empty.";
		}
		else if(empty($weight)){
			$toReturn['error'] = "Weight is empty.";
		}
		else if(empty($height)){
			$toReturn['error'] = "Height is empty.";
		}
		else if(empty($category)){
			$toReturn['error'] = "Category is empty.";
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
			$sql = "INSERT INTO profiles (pid, name, weight, height, category) VALUES(" . $pid . ", '" . $name . "', " . $weight . ", " . $height . ", '". $category . "')";
			$result = $mysqli->query($sql);
			$toReturn['result'] = $result;
		}
	}
	else if(isset($_POST['pic'])){
		$pid = $_POST['pid'];
		$pic = $_POST['pic'];
		//do sql insert of pic where pid
		$sql = "UPDATE profiles SET pic = '" . $pic . "' WHERE pid = " . $pid;
		$result = $mysqli->query($sql);
		$toReturn['result'] = $result;
		$mysqli->close();
	}
	else if(isset($_POST['tableAll'])){
		//get all of them
		$sql = "SELECT name, weight, gender, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM profiles";
		$result = $mysqli->query($sql);
		$toReturn['rows'] = $result->fetch_all();
	}
	header('Content-Type: application/json');
	echo json_encode($toReturn);
?>