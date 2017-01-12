<?php

require("../../config.php");

session_start();


function saveToode ($nimi, $kaal, $hind) {
		
		$database = "if16_juri";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO pood (nimi, kaal, hind) VALUES (?, ?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("sss", $nimi, $kaal, $hind);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}

function getAlltoode() {
		
		$database = "if16_juri";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("
			SELECT id, nimi, kaal, hind
			FROM pood
			WHERE deleted is NULL
		");
		echo $mysqli->error;
		
		$stmt->bind_result($id, $nimi, $kaal, $hind);
		$stmt->execute();
		
		
		
		$result = array();
		
		
		while ($stmt->fetch()) {
			
			
			$toode = new StdClass();
			//var_dump($toode);
			$toode->id = $id;
			$toode->nimi = $nimi;
			$toode->kaal = $kaal;
			$toode->hind = $hind;
			
			//var_dump($toode);
			
			array_push($result, $toode);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	}

	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	

	function deleteToode($id){
     	
         $database = "if16_juri";
 
 	
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("UPDATE pood SET deleted=NOW() WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i",$id);
 		
 		
 		if($stmt->execute()){
 			
 			echo "kustutamine õnnestus!";
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 	}
	
	
	
?>