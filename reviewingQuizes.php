<?php

	include "segurtasunaIrakaslea.php";
	include "configEzarri.php";
	
	if (isset($_POST['galderaTestua'])){
		$id = $_POST['id'];
		$galdera = $_POST['galderaTestua'];
		$erantzunZuzena = $_POST['erantzunZuzena'];	
		$erantzunOkerra1 = $_POST['erantzunOkerra1'];
		$erantzunOkerra2 = $_POST['erantzunOkerra2'];
		$erantzunOkerra3 = $_POST['erantzunOkerra3'];
		$galderaZail = $_POST['galderaZail'];
		$galderaArloa = $_POST['galderaArloa'];
		
		$trimGaldera = trim($galdera);
		$trimErantzunZuzena = trim($erantzunZuzena);
		$trimErantzunOkerra1 = trim($erantzunOkerra1);
		$trimErantzunOkerra2 = trim($erantzunOkerra2);
		$trimErantzunOkerra3 = trim($erantzunOkerra3);
		$trimGalderaZail = trim($galderaZail);
		$trimGalderaArloa = trim($galderaArloa);

		preg_match('/^.+$/', $trimGaldera, $matchesGaldera);
		preg_match('/^.+$/', $trimErantzunZuzena, $matchesErantzunZuzena);
		preg_match('/^.+$/', $trimErantzunOkerra1, $matchesErantzunOkerra1);
		preg_match('/^.+$/', $trimErantzunOkerra2, $matchesErantzunOkerra2);
		preg_match('/^.+$/', $trimErantzunOkerra3, $matchesErantzunOkerra3);
		preg_match('/^.+$/', $trimGalderaZail, $matchesGalderaZail);
		preg_match('/^.+$/', $trimGalderaArloa, $matchesGalderaArloa);
		
		if ($matchesGaldera && $matchesErantzunZuzena && $matchesErantzunOkerra1 &&
			$matchesErantzunOkerra2 && $matchesErantzunOkerra3 && $matchesGalderaZail && $matchesGalderaArloa && strlen($trimGaldera)>9) {
			$connection = new mysqli($servername, $username, $password, $dbname);
			if ($connection->connect_error) {
				die("Connection failed: " . $db->connect_error);
			}
			$sql = "UPDATE questionswithimage SET Galdera='$trimGaldera', ErantzunZuzena='$trimErantzunZuzena', ErantzunOkerra1='$trimErantzunOkerra1',
			ErantzunOkerra2='$trimErantzunOkerra2', ErantzunOkerra3='$trimErantzunOkerra3', GalderaZailtasuna='$trimGalderaZail', 
			GalderaArloa='$trimGalderaArloa' WHERE ID='$id'";
			$update = $connection->query($sql);
			$connection->close();
		} else {
			echo nl2br ("Errorea! Sartutako zelai guztiak ez dira egoki bete.\n");
			echo nl2br ("Zerbitzaria konturatu da akats horretaz. Kontuz, aldatu beharko duzu!\n");
			echo nl2br ("<a href = addQuestion.html >Saiatu berriro galdera ezartzen.</a>\n");
		}
	}
?>

<!DOCTYPE html>
<html>
  <head>
	<style>
		#divScroll {
			overflow:scroll;
			width: 1000px;
			height: 150px;
		}
	</style>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
		
		var xhroGalderakKargatu = new XMLHttpRequest();	
		
		xhroGalderakKargatu.onreadystatechange = function(){
			if ((xhroGalderakKargatu.readyState==4)&&(xhroGalderakKargatu.status==200)){
				var emaitza = xhroGalderakKargatu.responseText;
				document.getElementById("divScroll").innerHTML = emaitza;
			}
		}
		
		window.onload = function() {
			galderakKargatu();
			setInterval(galderakKargatu, 20000);
		}
		
		function galderakKargatu() {
			xhroGalderakKargatu.open("GET", "chargeQuestions.php", true);
			xhroGalderakKargatu.send();
		}
		
		var xhroAldatzekoaKargatu = new XMLHttpRequest();	
		xhroAldatzekoaKargatu.onreadystatechange = function(){
			if ((xhroAldatzekoaKargatu.readyState==4)&&(xhroAldatzekoaKargatu.status==200)){
				var emaitza = xhroAldatzekoaKargatu.responseText;
				if (emaitza == "errorea") {
					document.getElementById("galderaAldatzekoFormularioa").style.display = "none";
					alert("Barkatu, ID horri dagokion galderarik ez dago.");
				} else {
					document.getElementById("galderaAldatzekoFormularioa").style.display = "block";
					hutsuneakBete(emaitza);
				}
			}
		}
		
		function hutsuneakBete(emaitza) {
			var emaitzaBektore = emaitza.split("$");
			document.getElementById("id").value = emaitzaBektore[0]; 
			document.getElementById("galderaTestua").value = emaitzaBektore[2];
			document.getElementById("erantzunZuzena").value = emaitzaBektore[3];
			document.getElementById("erantzunOkerra1").value = emaitzaBektore[4];
			document.getElementById("erantzunOkerra2").value = emaitzaBektore[5];
			document.getElementById("erantzunOkerra3").value = emaitzaBektore[6];
			document.getElementById("galderaZail").value = emaitzaBektore[7];
			document.getElementById("galderaArloa").value = emaitzaBektore[8];
		}	
			
		function aldatu() {
			if ($("#idGald").val().trim().match(/^[0-9]{1,}$/)) {
				var id = $("#idGald").val();
				xhroAldatzekoaKargatu.open("GET", "changeQuestionGet.php?id="+id, true);
				xhroAldatzekoaKargatu.send();
			} else {
				document.getElementById("galderaAldatzekoFormularioa").style.display = "none";
				alert("IDa Zenbaki bat izan behar da!");
			}
		}

		function myFunction() {
			var r=confirm("Ziur al zaude zure kontutik atera nahi duzula?");
			if (r==false){
				return false;
			} else {
				return true;
			}
		}
		
		$(document).ready(function(){

			$.denakBeteta = function(){
				if ((($("#galderaTestua").val().length>0)&&($("#erantzunZuzena").val().length>0)&&($("#erantzunOkerra1").val().length>0)
					&&($("#erantzunOkerra2").val().length>0)&&($("#erantzunOkerra3").val().length>0)&&($("#galderaZail").val().length>0)
					&&($("#galderaArloa").val().length>0))){
					return true;
				} else {
					return false;
				}
			}
			
			$('#galderaAldatzekoFormularioa').submit(function()  {
				if ($.denakBeteta()) {
						if ($("#galderaZail").val().match(/^[1-5]$/)){
							if ($("#galderaTestua").val().length>=10){
								return true;
							} else {
								window.alert("Galderak gutxienez 10 karakterekoa izan behar da.");
								return false;
							}
						} else {
							window.alert("Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.");
							return false;
						}
				} else {
					window.alert("Datu guztiak bete behar dira.");
					return false;
				}
			})
		})
		
	</script>
  </head>
  <body>
  <div class="container-fluid">
	<div id='page-wrap'>
	<header class='main' id='h1'>
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
	</header>
	<nav class='main' id='n1' role='navigation'>
	<div class="row">
		<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>
		<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>
		<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="reviewingQuizes.php">Reviewing Quizzes</a></div>
		<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="removeQuestion.php">Remove Question</a></div>
		<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>
		<div class="col-sm-2" ><a class="btn-block" href="logOut.php">Log out</a></div>
		</div>
	</nav>
	<section class="main" id="s1">
	<h1>Reviewing Quizzes</h1>
	<p><?php
			$postaElektronikoa=$_SESSION["korreoa"];
			echo 'Posta:  ' . $postaElektronikoa;
		?></p>
	<div id="divScroll" >
	</div> 
	
	<div>
		<label for="id">Galderaren IDa sartu:</label>
		<input type="text" name="idGald" id="idGald" class="erantzuna"/>
		<br/><br/>
		<label for="botoia">&nbsp</label>
		<input id="botoia" type="submit" value="Aldatu" name="botoia" onclick="aldatu()">
	</div>
	
	<div id="formularioaDiv">
			<form  id="galderaAldatzekoFormularioa" name="galderaAldatzekoFormularioa" style="display: none" action="reviewingQuizes.php" method="post"  enctype="multipart/form-data" target="_blank">
			<input type="hidden" id="id" name="id"/>
			<label for="galderaTestua">Galderaren testua: </label>
			<input type="text" name="galderaTestua"  class="erantzuna" id="galderaTestua" height="2000px"/>
			<br/><br/>
			<label for="erantzunZuzena">Erantzun zuzena: </label>
			<input type="text" name="erantzunZuzena" class="erantzuna" id="erantzunZuzena" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra1">Erantzun okerra1: </label>
			<input type="text" name="erantzunOkerra1" class="erantzuna" id="erantzunOkerra1" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra2">Erantzun okerra2: </label>
			<input type="text" name="erantzunOkerra2" class="erantzuna" id="erantzunOkerra2" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra3">Erantzun okerra3: </label>
			<input type="text" name="erantzunOkerra3" class="erantzuna" id="erantzunOkerra3" width="600px"/>
			<br/><br/>
			<label for="galderaZail">Galderaren zailtasuna(1-5): </label>
			<input type="text" name="galderaZail" id="galderaZail"/>
			<br/><br/>
			<label for="galderaArloa">Galderaren arloa: </label>
			<input type="text" name="galderaArloa" id="galderaArloa"/>
			<br/><br/>
			<label for="botoia">&nbsp</label>
			<input id="botoia" type="submit" value="Bidali" name="botoia" > &nbsp
			<input type="reset" value="Borratu" id="reset"><br><br>
		</div >
	</form>
    </section>
	<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
</div>
</div>
</div>
</body>
</html>

