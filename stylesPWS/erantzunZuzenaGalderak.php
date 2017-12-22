<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include 'configEzarri.php';
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_SESSION["kautotuta"])){
	$postaElektronikoa=$_SESSION["korreoa"];
		$sql = "SELECT Nick FROM users WHERE PostaElektronikoa='$postaElektronikoa'";
		$result = $connection->	query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$deitura =$row['Nick'];	
		}
		$SQL_QUIZ = "UPDATE users set Ondo= Ondo+1 where Nick='$deitura' ";
		$SQL_QUIZ2 = "UPDATE users SET Gaizki=Gaizki+1 where Nick='$deitura'";
}
else{
	$deitura=$_SESSION["anonimoIzena"];
	$SQL_QUIZ = "UPDATE quizzers set Ondo= Ondo+1 where Nick='$deitura' ";
		$SQL_QUIZ2 = "UPDATE quizzers SET Gaizki=Gaizki+1 where Nick='$deitura'";
}

if($_SESSION["galderaKop"]==1){
	$erantzuna1= $_GET["erantzuna1"];
	if($erantzuna1==$_SESSION["galderaZuzena1"]){
	echo "1.  erantzuna zuzena da";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "1. erantzuna ez da zuzena";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
}
if($_SESSION["galderaKop"]==2){
	$erantzuna1= $_GET["erantzuna1"];
	$erantzuna2= $_GET["erantzuna2"];
	if($erantzuna1==$_SESSION["galderaZuzena1"]){
	echo "1.  erantzuna zuzena da</br>";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "1. erantzuna ez da zuzena</br>";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
	if($erantzuna2==$_SESSION["galderaZuzena2"]){
	echo "2.  erantzuna zuzena da</br>";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "2. erantzuna ez da zuzena</br>";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
}
if($_SESSION["galderaKop"]==3){
	$erantzuna1= $_GET["erantzuna1"];
	$erantzuna2= $_GET["erantzuna2"];
	$erantzuna3= $_GET["erantzuna3"];
	if($erantzuna1==$_SESSION["galderaZuzena1"]){
	echo "1.  erantzuna zuzena da</br>";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "1. erantzuna ez da zuzena</br>";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
	if($erantzuna2==$_SESSION["galderaZuzena2"]){
	echo "2.  erantzuna zuzena da</br>";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "2. erantzuna ez da zuzena</br>";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
	if($erantzuna3==$_SESSION["galderaZuzena3"]){
	echo "3.  erantzuna zuzena da";
	$emaitza = $connection->query($SQL_QUIZ);
	}
	else{
		echo "3. erantzuna ez da zuzena";
		$emaitza = $connection->query($SQL_QUIZ2);
	}
	
}
$connection->close();

?>