<?php
	
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client('https://wsjonlegarda.000webhostapp.com/lab7/pasahitzaEgiaztatu.php?wsdl', true);
	
	$pasahitza = $_GET['pasahitza'];
	
	$emaitza = $soapclient->call('pasahitzaEgiaztatu', array('x'=>$pasahitza));

	echo $emaitza;

?>