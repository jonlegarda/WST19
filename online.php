<?php
	$xml = simplexml_load_file('counter.xml');
	
	if ($_GET['kont'] == 1) {
		$xml->p = $xml->p +1;
	} else if ($_GET['kont'] == 2) {
		$xml->p = $xml->p -1;
	}	
	$xml->asXML('counter.xml');
	echo $xml->p;
	echo "<br>"
?>