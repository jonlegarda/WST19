<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client('getQuestion.php?wsdl', true);
	echo "<script>console.log(222);</script>";
	$galdeID = $_GET["id"];
	
	$emaitza = $soapclient->call('getQuestion', array('x'=>$galdeID));
	echo $emaitza;
?>