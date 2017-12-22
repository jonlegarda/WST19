<?php
//fghjghhjgbj
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$ns = "localhost/wsjl/getQuestion.php?wsdl";
$server = new soap_server;

$server->configureWSDL('getQuestion', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
$server->register('getQuestion', array('x'=>'xsd:int'), array('y'=>'xsd:string'), $ns);

function getQuestion($x){
	include 'configEzarri.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	$SQL_QUIZ = "SELECT * FROM questionswithimage WHERE ID=$x";
	$emaitza = $connection->query($SQL_QUIZ);
	if ($emaitza->num_rows > 0) {
		while ($row = $emaitza->fetch_assoc()) {
			$erantzuna = '<table style="width:60%"  border="1px solid blue"  border-collapse="collapse" text-align="center"><tr text-align="center"> <th> Galdera </th><th> Erantzuna </th><th> Zailtasuna </th></tr><tr text-align="center"><td text-align="center"> '.$row['Galdera'].' </td><td> '.$row['ErantzunZuzena'].' </td><td> '.$row['GalderaZailtasuna'].' </td></tr> </table>';
			return $erantzuna;
		}
	} else {
		$erantzuna = "Ooops! Ez dago id horrekin galderarik erregistratuta.";
		return $erantzuna;
	}
	
}


if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>