<?php
echo "<link rel='stylesheet' type='text/css' href='formato.css' />";
$xml=simplexml_load_file("questions.xml") or die("Error: Cannot create object");
echo '<table border=1><tr><th> Gaia </th><th> Galdera </th><th> Zailtasuna </th></tr>';
foreach($xml->children() as $item) {
		echo '<tr>'; 
		echo '<td>' .  $item['subject'] . '</td>';
		echo'<td>'.  $item->itemBody->p.'</td>';
		echo'<td>'.  $item['complexity'].'</td>';
		echo '</tr>';
} 


?> 
