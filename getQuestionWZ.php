<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client('http://localhost/wsjl/getQuestion.php?wsdl', true);
	
	$galdeID = $_GET["id"];
	
	$emaitza = $soapclient->call('getQuestion', array('x'=>$galdeID));
	echo $emaitza;
?>