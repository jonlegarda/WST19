<?php
	
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	
	$ePosta = $_GET['ePosta'];
	
	$emaitza = $soapclient->call('egiaztatuE', array('x'=>$ePosta));

	echo $emaitza;

?>