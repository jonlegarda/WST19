<?php
	session_start();
include 'configEzarri.php';

// Konexioa sortu
$connection = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SELECT taula jasotzeko
$SQL_QUIZ = "SELECT * FROM questionswithimage";

// Konexioa hartuta, Query-a egin eta emaitza array batean jaso
$emaitza = $connection->query($SQL_QUIZ);
// Taula bat definituko dugu;
	if(!isset($_SESSION["zenbakiak"])){
				$_SESSION["zenbakiak"]=array();
				if ($emaitza->num_rows > 0) {
					while ($row = $emaitza->fetch_assoc()) {
						array_push($_SESSION["zenbakiak"],$row['ID']);
								
											
					}
				}
		shuffle($_SESSION["zenbakiak"]);
		$_SESSION["zenbakiak"]= array_values($_SESSION["zenbakiak"]);
	}
	if(isset($_SESSION["unekoGaldera"])){
		$_SESSION["unekoGaldera"]=$_SESSION["unekoGaldera"]+1;
	}
	else{
		$_SESSION["unekoGaldera"]=0;
	}
	//print_r($_SESSION["zenbakiak"]);
	$emaitza = $connection->query($SQL_QUIZ);
	//uneko galdera bektoretik ateratzen ez dela egiaztatu.
	//echo $_SESSION["unekoGaldera"];
	if($_SESSION["unekoGaldera"]<$emaitza->num_rows){
		if ($emaitza->num_rows > 0) {
			while ($row = $emaitza->fetch_assoc()) {
					if($row['ID']==$_SESSION["zenbakiak"][$_SESSION["unekoGaldera"]]){
						$_SESSION["galderaZuzena"]=$row['ErantzunZuzena'];
						echo $row['Galdera'] . "<br>";
						$ans = array($row['ErantzunZuzena'],$row['ErantzunOkerra1'],$row['ErantzunOkerra2'],$row['ErantzunOkerra3']);
						shuffle($ans);
						foreach ($ans as $choice) {
							echo "<input type='radio' class='radioBtnClass' value= ".$choice." id= 'ans' name='ans'>".$choice."</input><br>";
						} 
						unset($choice);
									}
			}
		} else {
			echo "Errorea: Ez dira galderak aurkitu!";	
		}
		
	}
	else{
			echo "jadanik galdera guztiak agortu dituzu";
		}

$connection->close();

 
	echo ('</div>');
?>


