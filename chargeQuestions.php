<?php
	include 'configEzarri.php';

	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	$SQL_QUIZ = "SELECT * FROM questionswithimage";
	$emaitza = $connection->query($SQL_QUIZ);
	echo "<br>";
	echo '<table border=1><tr><th> ID </th><th> Egilea </th><th> Galdera </th><th> Erantzun Zuzena </th><th> 
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