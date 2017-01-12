
<?php
	
	require("functions.php");
	require("editFunctions.php");
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		updateToode(cleanInput($_POST["id"]), cleanInput($_POST["nimi"]), cleanInput($_POST["kaal"]), cleanInput($_POST["hind"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$t = getSingleToodeData($_GET["id"]);
	

	
	if(isset($_POST["delete"])) {
		
	}
	
	if(isset($_GET["delete"])){
 		
 		deleteToode($_GET["id"]);
 		
 		header("Location: data.php");
 		exit();
 	}
	
	
	
?>

<br><br>


<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_nimi" >Nimi</label><br>
	<input id="number_nimi" name="nimi" type="text" value="<?php echo $t->nimi;?>" ><br><br>
	<label for="number_kaal" >Kaal</label><br>
	<input id="number_kaal" name="kaal" type="text" value="<?php echo $t->kaal;?>" ><br><br>
	<label for="number_hind" >Hind</label><br>
	<input id="number_hind" name="hind" type="text" value="<?php echo $t->hind;?>" ><br><br>
  	
	
	<br><br>
  	
	<input type="submit" name="update" value="Salvesta"><br><br>
	<a href="data.php"> Tagasi </a>
  </form>
  <br><br>
  <a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>