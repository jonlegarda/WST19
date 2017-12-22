<?php
session_start();
include 'configEzarri.php';
$erantzuna= $_GET["erantzuna"];
// Konexioa sortu
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
		$SQL_QUIZ = "UPDATE users SET Ondo=Ondo+1 where Nick='$deitura'";
		$SQL_QUIZ2 = "UPDATE users SET Gaizki=Gaizki+1 where Nick='$deitura'";
}
else{
	$deitura=$_SESSION["anonimoIzena"];
	$SQL_QUIZ = "UPDATE quizzers SET Ondo=Ondo+1 where Nick='$deitura'";
	$SQL_QUIZ2 = "UPDATE quizzers SET Gaizki=Gaizki+1 where Nick='$deitura'";
	
}
echo $deitura;


$erantzuna2= $_SESSION["galderaZuzena"];
if($erantzuna==$erantzuna2){
	echo "zure erantzuna zuzena da";
	$emaitza = $connection->query($SQL_QUIZ);
}
else{
	echo "zure erantzuna ez da zuzena";
	$emaitza = $connection->query($SQL_QUIZ2);
}
$connection->close();

?>