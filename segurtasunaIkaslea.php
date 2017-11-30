<?php
	session_start();
	if(isset($_SESSION["kautotuta"])){
		if ($_SESSION["kautotuta"] == "ikaslea") {
			
		} else if ($_SESSION["kautotuta"] == "irakaslea") {
			header("Location: layoutR.php");
	} 
	}
	else {
		header("Location: layoutR.php");
	}
?>