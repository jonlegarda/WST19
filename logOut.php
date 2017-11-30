<?php
	include ("segurtasuna.php");
	session_destroy();
	header ('Location: layoutR.php');
	echo "<script> alert('Agur! Hurrengora arte!') </script>";
?>