<?php
	$xml = simplexml_load_file("questionsTransAuto.xml") or die("Error: Cannot create object");
	echo '<table border=1><tr><th> Gaia </th><th> Galdera </th><th> Zailtasuna </th></tr>';
	foreach($xml->children() as $item) {
		echo '<tr>'; 
		echo'<td>'.  $item->itemBody->p.'</td>';
		echo'<td>'.  $item['complexity'].'</td>';
		echo '<td>' .  $item['subject'] . '</td>';
		echo '<td>' .  $item->incorrectResponses->value . '</td>';
		echo '</tr>';
		
	} 
?> 