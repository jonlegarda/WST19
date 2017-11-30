<?php 
include "segurtasuna.php";
include 'configEzarri.php';

// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SELECT taula jasotzeko
$SQL_QUIZ = "SELECT * FROM questionswithimage";

// Konexioa hartuta, Query-a egin eta emaitza array batean jaso
$emaitza = $connection->query($SQL_QUIZ);

$postaElektronikoa=$_SESSION["korreoa"];
echo "Posta: ". $postaElektronikoa;
echo "<br>";
// Erakutsiko dugu beste lekuetara joateko estekak
echo "<a href = handlingQuizes.php>Beste galdera igo.</a>";
echo "<br>";
echo "<a href = layoutR.php>Menura itzuli.</a>";
echo "<br>";
// Taula bat definituko dugu;
echo '<table border=1><tr><th> ID </th><th> E-Maila </th><th> Galdera </th><th> Erantzun Zuzena </th><th> 
Erantzun Okerra 1 </th><th> Erantzun Okerra 2 </th><th> Erantzun Okerra 3 </th><th> Zailtasuna </th><th> Arloa </th><th> Irudia </th></tr>';

if ($emaitza->num_rows > 0) {
	while ($row = $emaitza->fetch_assoc()) {
		echo '<tr><td>'.$row['ID'].'</td> <td>'. $row['PostaElektronikoa'].'</td><td>'.$row['Galdera'].'</td>
		<td>'.$row['ErantzunZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td>
		<td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['GalderaZailtasuna'].'</td><td>'.$row['GalderaArloa'].'</td>
		<td>'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['Irudia'] ).'" width="200" height="150"/> '.'</td></tr>';
	}
} else {
	echo "Errorea: Ez dira galderak aurkitu!";	
}

$connection->close();

 
?> 