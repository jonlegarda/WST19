<?php
	
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client('http://localhost/wsjl/pasahitzaEgiaztatu.php?wsdl', true);
	
	$pasahitza = $_GET['pasahitza'];
	
	$emaitza = $soapclient->call('pasahitzaEgiaztatu', array('x'=>$pasahitza));

	echo $emaitza;

?>