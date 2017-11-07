<?php
	//echo "<link rel='stylesheet' type='text/css' href='formato.css' />";
	$xml = simplexml_load_file("questionsTransAuto.xml") or die("Error: Cannot create object");
	echo '<table border=1><tr><th> Gaia </th><th> Galdera </th><th> Zailtasuna </th></tr>';
	foreach($xml->children() as $item) {
			/*echo "Galdera: ";
			echo $item->itemBody->p . "<br> ";
			echo "Erantzun zuzena: <br>";
			echo $item->correctResponse->value . "<br> ";
			echo "Erantzun okerra: <br>";
			echo $item->incorrectResponses->value[0] . "<br> ";
			echo $item->incorrectResponses->value[1] . "<br> ";
			echo $item->incorrectResponses->value[2] . "<br> ";
			echo "Zailtasuna: <br>";
			echo $item['complexity'] . "<br> ";
			echo "Gaia: <br>";
			echo $item['subject'] . "<br>";*/
			//echo '<tr><td>' echo ."fg".'</td> <td>' "fdg". '</td><td>'echo ."fdg".'</td></tr>';
			echo '<tr>'; 
			echo'<td>'.  $item->itemBody->p.'</td>';
			echo'<td>'.  $item['complexity'].'</td>';
			echo '<td>' .  $item['subject'] . '</td>';
			echo '<td>' .  $item->incorrectResponses->value . '</td>';
			
			
		  echo '</tr>';
		
} 


?> 