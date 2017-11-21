<?php
//nusoap.php klasea gehitzen dugu
//echo '<script>console.log("Your stuff here")</script>';
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//soap server motako objektua sortzen dugu //soap_server motako objektua sortzen dugu
$ns="http://localhost/wsjl/pasahitzaEgiaztatu.php?wsdl";
$server = new soap_server;
$server->configureWSDL('pasahitzaEgiaztatu',$ns);
$server->wsdl->schemaTargetNamespace =$ns;
$server->register('pasahitzaEgiaztatu',array('x'=>'xsd:string'),
	array('z'=>'xsd:string'),$ns);


function pasahitzaEgiaztatu($x){
	$file = file("toppasswords.txt");
	$aurkitua=false;
	foreach($file as $hitza){
	if (strstr($hitza,$x)){
		$aurkitua=true;
	}
}
	if($aurkitua){
		return "baliozkoa";
	}
	else{
		return "baliogabea";
	}
}
	
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
//nusoap klaseko service metodoari dei egiten diogu
$server->service($HTTP_RAW_POST_DATA);
?>