<?php
	session_start();
	if(isset($_SESSION["kautotuta"])){
		if ($_SESSION["kautotuta"] == "ikaslea") {
			header("Location: layoutR.php");
			
		} else if ($_SESSION["kautotuta"] == "irakaslea") {
		
	} 
	}
	else {
		header("Location: layoutR.php");
	}
?>