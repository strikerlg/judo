<?php
	if(isset($_POST['category'])){
		if($_POST['category'] === "first"){
			$evid = $_POST['eventid'];
			$file = file_get_contents($evid . '/categories.json');
			$categories = json_decode($file, true);
			$data = "";
			for($i = 0; $i < count($categories); $i++){
				$data = $data . "<li><a class=\"subCat\" href=\"#\">". $categories[$i]['title'] ."</a></li>\n";
			}
			echo $data;
		}
		else if($_POST['category'] === "second"){
			$evid = $_POST['eventid'];
			$file = file_get_contents($evid . '/categories.json');
			$categories = json_decode($file, true);
			$subcategory = $_POST['subCat'];
			$data = "";
			$index;
			for($i = 0; $i < count($categories); $i++){
				if($categories[$i]['title'] === $subcategory){
					$index = $i;
					break;
				}
			}
			if(count($categories[$index]['children']) > 0){
				for($i = 0; $i < count($categories[$index]['children']); $i++){
					$data = $data . "<li><a class=\"go\" href=\"#\">". $categories[$index]['children'][$i] ."</a></li>\n";
				}
			}
			else
				$data = "<li><a class=\"go\" href=\"#\">Go!</a></li>";
			
			echo $data;
		}
	}
	else if(isset($_POST['updateBracket'])){
		$evid = $_POST['eventid'];
		$catid = $_POST['catid'];
		$json = json_decode($_POST['newBracket']);

		$fjson = fopen("brackets/$evid-$catid.json" , "w");
		fwrite($fjson, json_encode($json));
		fclose($fjson);
		echo "Wrote file succesfully";
	}
?>