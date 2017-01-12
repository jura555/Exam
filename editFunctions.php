<?php

	require_once("../../config.php");
	
	function getSingleToodeData($edit_id){
    
        $database = "if16_juri";

		
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT nimi, kaal, hind FROM pood WHERE id=?");
		 
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($nimi, $kaal, $hind);
		$stmt->execute();
		
		
		$toode = new Stdclass();
		
		
		if($stmt->fetch()){
			
			$toode->nimi = $nimi;
			$toode->kaal = $kaal;
			$toode->hind = $hind;
			
			
		}else{
			
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $toode;
		
	}


	function updateToode($id, $nimi, $kaal, $hind){
    	
        $database = "if16_juri";

		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE pood SET nimi=?, kaal=?, hind=? WHERE id=? AND deleted is NULL");
		echo $mysqli->error;
		$stmt->bind_param("sssi", $nimi, $kaal, $hind, $id);
		echo $mysqli->error;
		
		if($stmt->execute()){
			
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	?>