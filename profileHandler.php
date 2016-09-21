<?php
	$toReturn = array();
	require('config.php');
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if($mysqli->connect_error){
		die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['insert'])){
			$toReturn['error'] = array();

			$name = $_POST['name'];
			$weight = $_POST['weight'];
			$height = $_POST['weight'];
			$club = $_POST['club'];
			$birthdate = $_POST['birthdate'];
			$sex = $_POST['sex'];
			if(empty($name)){
				$toReturn['error'][] = "Name is empty.";
			}
			else if(empty($weight)){
				$toReturn['error'][] = "Weight is empty.";
			}
			else if(empty($height)){
				$toReturn['error'][] = "Height is empty.";
			}
			else if(empty($club)){
				$toReturn['error'][] = "Category is empty.";
			}
			else if(!is_numeric($height)){
				$toReturn['error'][] = "Invalid height.";
			}
			elseif(!is_numeric($weight)){
				$toReturn['error'][] = "Invalid weight.";
			}
			else{
				if(isset($_FILES['image'])){
					//handle the image here
					if($_FILES['image']['error'][0] == UPLOAD_ERR_OK){
						//case where image was recieved correctly
						if(preg_match("/image\/(jpe?g|png|gif|bmp)/", $_FILES['image']['type']) == 1){
							//it is indeed an image
							$tmp_name = $_FILES['image']['tmp_name'];
							$picname = $_FILES['image']['name'];
							if(move_uploaded_file($tmp_name, "images/profile/files/$picname")){
								include 'utils.php';
								makeThumbnails($picname, "images/profile/files");
								$pid = ord($name) . "" . rand(1000, 9999);
								$toReturn['success'] = "No errors";
								$toReturn['pid'] = $pid;
								$sql = "INSERT INTO profiles (pid, name, weight, height, club, gender, birthdate, pic) VALUES($pid, '$name', $weight, $height, '$club', '$sex', '$birthdate', '$picname')";
								$result = $mysqli->query($sql);
								$toReturn['result'] = $result;
								$toReturn['sql'] = $sql;
							}
							else{
								$toReturn['error'][] = "could not move file";
							}
						}
						else{
							$toReturn['error'][] = "file was not image it was" . $_FILES['image']['type'];
						}
					}
					else{
						$toReturn['error'][] = "image was not uploaded correctly";
					}
				}
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
			$sql = "SELECT name, club, weight, gender, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM profiles ORDER BY weight, age";
			$result = $mysqli->query($sql);
			$toReturn['rows'] = $result->fetch_all();
		}
	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
		$_DELETE = array();
		parse_str(file_get_contents('php://input'), $_DELETE);
		if(isset($_DELETE['profile'])){
			$id = $_DELETE['profile'];
			$sql = "SELECT pic FROM profiles WHERE pid = $id";
			$result = $mysqli->query($sql);
			if($result->num_rows > 0){
				$pic = $result->fetch_row()[0];
				if(unlink("images/profile/files/$pic")){
					unlink("images/profile/files/thumbnail/$pic");
					$sql = "DELETE FROM profiles WHERE pid = $id";
					$toReturn['deleted'] = $mysqli->query($sql);
				}
			}
		}
	}
	header('Content-Type: application/json');
	echo json_encode($toReturn);
?>
