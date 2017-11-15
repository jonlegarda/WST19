<?php 

include 'configEzarri.php';
echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$eposta = $_GET["ePosta"];
// SELECT taula jasotzeko
$all = "SELECT * FROM questionswithimage";
$nire = "SELECT * FROM questionswithimage WHERE PostaElektronikoa = '".$eposta."'";

// Konexioa hartuta, Query-a egin eta emaitza array batean jaso
$emaitzaDenak = $connection->query($all);
$emaitzaNirea= $connection->query($nire);

/*$row1 = $emaitzaDenak->fetch_assoc();
$row2 = $emaitzaNirea->fetch_assoc();*/
$connection->close();
echo "$emaitzaNirea->num_rows" . "/" . "$emaitzaDenak->num_rows"; 

 
?> 