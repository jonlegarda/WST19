<?php
session_start();
	function phpAlert($msg) {
				echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	if (isset($_POST['pasahitza1'])) {
		include "configEzarri.php";
		
		$postaElektronikoa = $_SESSION["k"];
		$pasahitzBerria = $_POST['pasahitza1'];
		
		$trimPasahitza = trim($pasahitzBerria);
		$enkripPasahitza = crypt($trimPasahitza, "wsLizasoLegardaEnkriptazioPasahitza");
		
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
		}
		$sql = "UPDATE users SET Pasahitza='$enkripPasahitza' WHERE PostaElektronikoa='$postaElektronikoa'";
		$result = $connection->query($sql);
		if (! ($result)) {
			echo "Error in the query". $result->error; 
		} else {
			phpAlert("Aldaketa ondo burutu da! Pasahitza berria duzu.");
			print "<meta http-equiv=Refresh content=\"0 ; url=layoutR.php\">"; 
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pasahitza aldatu</title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
       
       /* label {
            display: inline-block;
            float: left;
            clear: left;
            width: 300px;
            text-align: right;
        }

        input {
            display: inline-block;
            float: left;
            text-align: left;
        }
		p {
			width=300px; 
			style =text-align: left;
		}
        select {
            display: inline-block;
            float: left;
        }
        .erantzuna{
            width: 350px;
        }*/
		
    </style>
</head>


<body>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

<script>

	xhroPas = new XMLHttpRequest();
	
	xhroPas.onreadystatechange = function () {
		if ((xhroPas.readyState==4)&&(xhroPas.status==200)) { 
			var erantzuna = xhroPas.responseText;
			if (erantzuna == "baliozkoa") {
				document.getElementById("pasahitzaErakutsi").style.color = "red";
				document.getElementById("pasahitzaErakutsi").innerHTML = " Pasahitza ez da baliozkoa: segurtasun-maila urrikoa.";
			} else if (erantzuna == "baliogabea") {
				document.getElementById("pasahitzaErakutsi").style.color = "green";
				document.getElementById("pasahitzaErakutsi").innerHTML = " Pasahitza zuzena eta segurua.";

			} else {
				document.getElementById("pasahitzaErakutsi").style.color = "red";
				document.getElementById("pasahitzaErakutsi").innerHTML = xhroPas.responseText;
			}
		}
	}
	
	function PasahitzaEgiaztatu() {
		var pasahitza= $("#pasahitza1").val();
		xhroPas.open("GET", "pasahitzaWS.php?pasahitza="+pasahitza, true);
		xhroPas.send();
	}

	function egiaztatu(){
		if (!$("#pasahitza1").val().match(/^([^\s]{1,})$/)){
			window.alert("Pasahitzak ezin du hutsunerik izan.");
			return false;
		}
		if (!$("#pasahitza1").val().match(/^\S{6,500}/)){
			window.alert("Pasahitzak gutxienez 6 karaktere izan behar ditu.");
			return false;
		}
		if ($("#pasahitza1").val() != $("#pasahitza2").val()){
			 window.alert("Bi pasahitzak berdinak izan behar dira.");
			 return false;
		}
		return true;
	}

</script>
<div class="container-fluid">
	<div id='page-wrap'>
		<header class='main' id='h1'>
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
		</header>
		<nav class='main' id='n1' role='navigation'>
		<div class="row">
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">Login</a></div>
			<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="signUp.php">SignUp</a></div>
			</div>
		</nav>
		<section class="main" id="s1">
			<h1>Pasahitza aldatu</h1>
			<p>Idatz ezazu bi aldiz pasahitza berria eta ondoren, "aldatu" botoian klik egin ezazu.</p>
			<form  id="changePassword" name="changePassword"  action="changePassword_galdera.php" method="post"  enctype="multipart/form-data"  >
				<label for="ePosta">Zure Korreoa: </label>
				<input type="text" name="ePosta" id="ePosta"  value="<?php  echo $_SESSION["k"];?>" disabled class="erantzuna"/>
				<br/><br/>
				<label for="pasahitza1">Pasahitza (*): </label>
				<input type="password" name="pasahitza1" id="pasahitza1" class="erantzuna" onchange="PasahitzaEgiaztatu()"/>
				<div id="pasahitzaErakutsi"></div>
				<br/>
				<label for="pasahitza2">Pasahitza errepikatu (*): </label>
				<input type="password" name="pasahitza2" id="pasahitza2" class="erantzuna"/>
				<br/><br/>
				<input id="botoia" type="submit" value="Aldatu" name="botoia" width="350px" onsubmit="egiaztatu()" > &nbsp
			</form>
		</section>
		<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
		</div>
		</div>

</body>
</html>