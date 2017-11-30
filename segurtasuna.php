<?php
	session_start();
	if(isset($_SESSION["kautotuta"])){
		if ($_SESSION["kautotuta"] == "ikaslea") {
			
		} else if ($_SESSION["kautotuta"] == "irakaslea") {
		
	} 
	}
	else {
		header("Location: layoutR.php");
	}
?>