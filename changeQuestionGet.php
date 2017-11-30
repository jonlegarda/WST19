<?php
	include 'configEzarri.php';

	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	$id = $_GET["id"];
	$SQL_QUIZ = "SELECT * FROM questionswithimage WHERE ID=$id";
	$emaitza = $connection->query($SQL_QUIZ);
	if ($emaitza->num_rows>0) {
		while ($row = $emaitza->fetch_assoc()) {
			echo ''.$row['ID'].'$'. $row['PostaElektronikoa'].'$'.$row['Galdera'].'$'.$row['ErantzunZuzena'].'$'.$row['ErantzunOkerra1'].'$'.$row['ErantzunOkerra2'].'
				$'.$row['ErantzunOkerra3'].'$'.$row['GalderaZailtasuna'].'$'.$row['GalderaArloa'].'';
		}
	} else {
		echo "errorea";	
	}
	$connection->close(); 
?>