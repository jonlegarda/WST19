<?php
	echo ("<h2> Datu-Basean dauden galderak: </h2>");
	echo ("<br/>");
	$xml = simplexml_load_file('questions.xml') or die("Error: Cannot create object");
	echo ('<div align="center">');
	echo '<table  align="center" border=1><tr><th> Galdera </th><th> Zailtasuna </th><th> Gaia </th></tr>';
	foreach($xml->children() as $item) {
		echo '<tr>'; 
		echo'<td>'.  $item->itemBody->p.'</td>';
		echo'<td>'.  $item['complexity'].'</td>';
		echo '<td>' .  $item['subject'] . '</td>';
		echo '</tr>';	
	}
	echo '</table>';
	echo ('</div>');
?>