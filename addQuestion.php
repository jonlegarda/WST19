<?php 

include 'configEzarri.php';

// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$postaElektronikoa = $_POST['posta'];
$erantzunZuzena = $_POST['erantzunZuzena'];
$galdera = $_POST['galderaTestua'];
$erantzunOkerra1 = $_POST['erantzunOkerra1'];
$erantzunOkerra2 = $_POST['erantzunOkerra2'];
$erantzunOkerra3 = $_POST['erantzunOkerra3'];
$galderaZail = $_POST['galderaZail'];
$galderaArloa = $_POST['galderaArloa'];
//$irudia = $_POST['irudia']

$sql = "INSERT INTO Questions (PostaElektronikoa, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa) 
VALUES ('$postaElektronikoa', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$galderaZail', '$galderaArloa')";

if ($connection->query($sql) === TRUE) {
    echo nl2br ("Galdera berria gordeta!\n");
	echo nl2br ("<a href = showQuestions.php >Ikusi dauden galdera guztiak.</a>\n");
	echo nl2br ("<a href = addQuestion.html >Txertatu beste galdera bat.</a>\n");
	
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
	echo "<a href = addQuestion.html >Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>";
	
}

$connection->close();

 
?> 