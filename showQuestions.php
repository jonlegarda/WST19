<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Quiz";

// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SELECT taula jasotzeko
$SQL_QUIZ = "SELECT * FROM Questions";

// Konexioa hartuta, Query-a egin eta emaitza array batean jaso
$emaitza = $connection->query($SQL_QUIZ);

// Taula bat definituko dugu;
echo '<table border=1><tr><th> ID </th><th> E-Maila </th><th> Galdera </th><th> Erantzun Zuzena </th><th> 
Erantzun Okerra 1 </th><th> Erantzun Okerra 2 </th><th> Erantzun Okerra 3 </th><th> Zailtasuna </th><th> Arloa </th></tr>';

if ($emaitza->num_rows > 0) {
	while ($row = $emaitza->fetch_assoc()) {
		echo '<tr><td>'.$row['ID'].'</td> <td>'. $row['PostaElektronikoa'].'</td><td>'.$row['Galdera'].'</td>
		<td>'.$row['ErantzunZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td>
		<td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['GalderaZailtasuna'].'</td><td>'.$row['GalderaArloa'].'</td></tr>';
	}
} else {
	echo "Errorea: Ez dira galderak aurkitu!";	
}

$connection->close();

 
?> 