<?php

require("functions.php");

if ( isset($_POST["nimi"]) && 
		isset($_POST["kaal"]) &&
		isset($_POST["hind"]) && 
		!empty($_POST["nimi"]) && 
		!empty($_POST["kaal"]) &&
		!empty($_POST["hind"])
	  ) {
		  
		saveToode(cleanInput($_POST["nimi"]), cleanInput($_POST["kaal"]), cleanInput($_POST["hind"]));
		
	}

	$toodeData = getAlltoode();

?> 

<div class="container">

<h1>Lisa toode</h1>
<form method="POST">

<label>Toode nimetus</label><br>
	<input name="nimi" type="text">
	<br><br>

<label>Toode kaal</label><br>
	<input name="kaal" type="text">
	<br><br>

<label>Toode hind</label><br>
	<input name="hind" type="text">
	<br><br>
	
<input type="submit" value="Salvesta">
</form>


<?php 
	
	
	
	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>nimi</th>";
		$html .= "<th>kaal</th>";
		$html .= "<th>hind</th>";
	$html .= "</tr>";
	
	
	foreach($toodeData as $t){
		
		
		$html .= "<tr>";
			$html .= "<td>".$t->id."</td>";
			$html .= "<td>".$t->nimi."</td>";
			$html .= "<td>".$t->kaal."</td>";
			$html .= "<td>".$t->hind."</td>";
			$html .= "<td><a href='edit.php?id=".$t->id."'>Muuta</a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
