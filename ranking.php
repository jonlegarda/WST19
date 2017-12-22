<?php
	echo '<br/>';
	echo '<br/>';
	echo '<div align="center">';
	include "configEzarri.php";
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) { die("Connection failed: " . $connection->connect_error ); }
	
	$sql = "SELECT * FROM ALLUSERS ORDER BY Ondo DESC LIMIT 10";
	$result = $connection->query($sql);
		
	echo '<table align="center" width="400px" height="400px" border=1><tr align="center"><th align="center"> Posizioa </th><th align="center"> Nickname </th><th align="center"> Puntuazioa </th></tr>';
	$pos = 0;
	
	while ($row = $result->fetch_assoc()) {
		$pos = $pos+1;
		echo '<tr align="center">'; 
		echo '<td align="center">' . $pos . '</td>';
		echo '<td align="center">' . $row['Nick'] . '</td>';
		echo '<td align="center">' . $row['Ondo'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</div>';
?>