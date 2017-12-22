<?php

	session_start();
include 'configEzarri.php';

$gaia=$_GET["gaia"];
$aldatuta=false;
if(isset($_SESSION["gaia"])){
	if($gaia!=$_SESSION["gaia"]){
		$_SESSION["gaia"]=$_GET["gaia"];
		$aldatuta=true;
	}
}
else{
	$_SESSION["gaia"]=$_GET["gaia"];
}
// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SELECT taula jasotzeko
$SQL_QUIZ = "SELECT * FROM questionswithimage where GalderaArloa='$gaia'";

// Konexioa hartuta, Query-a egin eta emaitza array batean jaso
$emaitza = $connection->query($SQL_QUIZ);
// Taula bat definituko dugu;
	if(!isset($_SESSION["zenbakiak"]) || $aldatuta){
				$_SESSION["zenbakiak"]=array();
				if ($emaitza->num_rows > 0) {
					while ($row = $emaitza->fetch_assoc()) {
						array_push($_SESSION["zenbakiak"],$row['ID']);					
					}
				}
		shuffle($_SESSION["zenbakiak"]);
		$_SESSION["zenbakiak"]= array_values($_SESSION["zenbakiak"]);
		$_SESSION["unekoGaldera"]=0;
	}
	if(!isset($_SESSION["unekoGaldera"])){
		$_SESSION["unekoGaldera"]=0;
		$_SESSION["galderaKop"]=0;
	}
	//print_r($_SESSION["zenbakiak"]);
	
	$emaitza = $connection->query($SQL_QUIZ);
	//uneko galdera bektoretik ateratzen ez dela egiaztatu.
	
	if($_SESSION["unekoGaldera"]<$emaitza->num_rows){
		if ($emaitza->num_rows > 0) {
			while ($row = $emaitza->fetch_assoc()) {
					if($row['ID']==$_SESSION["zenbakiak"][$_SESSION["unekoGaldera"]]){
						$_SESSION["galderaZuzena1"]=$row['ErantzunZuzena'];
						echo $row['Galdera'] . "<br>";
						$ans = array($row['ErantzunZuzena'],$row['ErantzunOkerra1'],$row['ErantzunOkerra2'],$row['ErantzunOkerra3']);
						shuffle($ans);
						foreach ($ans as $choice) {
							echo "<input type='radio' class='radioBtnClass' value= ".$choice." id= 'ans' name='ans'>".$choice."</input><br>";
						} 
						unset($choice);
						
									}
			}
			$_SESSION["unekoGaldera"]=$_SESSION["unekoGaldera"]+1;
			$_SESSION["galderaKop"]=1;
		} else {
			echo "Errorea: Ez dira galderak aurkitu!";	
		}
		
	}
	else{
			echo "jadanik galdera guztiak agortu dituzu";
		}
	$emaitza = $connection->query($SQL_QUIZ);
	if($_SESSION["unekoGaldera"]<$emaitza->num_rows){
		if ($emaitza->num_rows > 0) {
			while ($row = $emaitza->fetch_assoc()) {
					if($row['ID']==$_SESSION["zenbakiak"][$_SESSION["unekoGaldera"]]){
						$_SESSION["galderaZuzena2"]=$row['ErantzunZuzena'];
						echo $row['Galdera'] . "<br>";
						$ans = array($row['ErantzunZuzena'],$row['ErantzunOkerra1'],$row['ErantzunOkerra2'],$row['ErantzunOkerra3']);
						shuffle($ans);
						foreach ($ans as $choice) {
							echo "<input type='radio' class='radioBtnClass2' value= ".$choice." id= 'ans2' name='ans2'>".$choice."</input><br>";
						} 
						unset($choice);
									}
			}
			$_SESSION["unekoGaldera"]=$_SESSION["unekoGaldera"]+1;
			$_SESSION["galderaKop"]=2;
		} else {
			echo "Errorea: Ez dira galderak aurkitu!";	
		}
	}
	$emaitza = $connection->query($SQL_QUIZ);
	if($_SESSION["unekoGaldera"]<$emaitza->num_rows){
		if ($emaitza->num_rows > 0) {
			while ($row = $emaitza->fetch_assoc()) {
					if($row['ID']==$_SESSION["zenbakiak"][$_SESSION["unekoGaldera"]]){
						$_SESSION["galderaZuzena3"]=$row['ErantzunZuzena'];
						echo $row['Galdera'] . "<br>";
						$ans = array($row['ErantzunZuzena'],$row['ErantzunOkerra1'],$row['ErantzunOkerra2'],$row['ErantzunOkerra3']);
						shuffle($ans);
						foreach ($ans as $choice) {
							echo "<input type='radio' class='radioBtnClass3' value= ".$choice." id= 'ans3' name='ans3'>".$choice."</input><br>";
						} 
						unset($choice);
									}
			}
			$_SESSION["unekoGaldera"]=$_SESSION["unekoGaldera"]+1;
		$_SESSION["galderaKop"]=3;
		} 
	
	}

$connection->close();
