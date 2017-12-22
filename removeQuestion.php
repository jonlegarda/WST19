<?php
	function phpAlert($msg) {
				echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	//include "segurtasunaIrakaslea.php";
	include "configEzarri.php";
	if (isset($_POST['idBorratzekoa'])){
		$id = $_POST["idBorratzekoa"];
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
		$sql = "DELETE from questionswithimage WHERE ID='$id'";
		$delete = $connection->query($sql);
		$connection->close();
	}
?>

<!DOCTYPE html>
<html>
  <head>
	<style>
		#divScroll {
			overflow:scroll;
			width: 1200px;
			height: 300px;
		}
	</style>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Remove Question</title>
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
		
		var xhroBorratzekoaKargatu = new XMLHttpRequest();	
		xhroBorratzekoaKargatu.onreadystatechange = function(){
			if ((xhroBorratzekoaKargatu.readyState==4)&&(xhroBorratzekoaKargatu.status==200)){
				var emaitza = xhroBorratzekoaKargatu.responseText;
				if (emaitza == "errorea") {
					document.getElementById("galderaBorratzekoFormularioa").style.display = "none";
					alert("Barkatu, ID horri dagokion galderarik ez dago.");
				} else {
					document.getElementById("galderaBorratzekoFormularioa").style.display = "block";
					hutsuneakBete(emaitza);
				}
			}
		}
		
		function hutsuneakBete(emaitza) {
			var emaitzaBektore = emaitza.split("$");
			document.getElementById("idBorratzekoa").value = emaitzaBektore[0]; 
			document.getElementById("galderaTestua").value = emaitzaBektore[2];
			document.getElementById("erantzunZuzena").value = emaitzaBektore[3];
			document.getElementById("erantzunOkerra1").value = emaitzaBektore[4];
			document.getElementById("erantzunOkerra2").value = emaitzaBektore[5];
			document.getElementById("erantzunOkerra3").value = emaitzaBektore[6];
			document.getElementById("galderaZail").value = emaitzaBektore[7];
			document.getElementById("galderaArloa").value = emaitzaBektore[8];
		}	
			
		function erakutsi() {
			if ($("#idGald").val().trim().match(/^[0-9]{1,}$/)) {
				var id = $("#idGald").val();
				xhroBorratzekoaKargatu.open("GET", "changeQuestionGet.php?id="+id, true);
				xhroBorratzekoaKargatu.send();
			} else {
				document.getElementById("galderaBorratzekoFormularioa").style.display = "block";
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
			return true;
		})
		
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      
     <span class="right" style="display:none;"><a href="logOut.php">Log Out</a> </span>
	<h2>Quiz: Crazy Questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	<div class="row">
		<div class="col-sm-2" style="border-right: 2px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>
		<div class="col-sm-2" style="border-right: 2px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>
		<div class="col-sm-2" style="border-right: 2px solid #C5DEC2;" ><a class="btn-block" href="reviewingQuizes.php">Reviewing Quizzes</a></div>
		<div class="col-sm-2" style="border-right: 2px solid #C5DEC2;" ><a class="btn-block" href="removeQuestion.php">Remove Question</a></div>
		<div class="col-sm-2" style="border-right: 2px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>
		<div class="col-sm-2" ><a class="btn-block" href="logOut.php">Log out</a></div>
		</div>
	</nav>
    <section class="main" id="s1">
    <div align="center">
	<div id="divScroll" align="center"> </div> 
	</div>
	<div>
		<label for="id">Galderaren IDa sartu:</label>
		<input type="text" name="idGald" id="idGald" class="erantzuna"/>
		<br/><br/>
		<label for="botoia">&nbsp</label>
		<input id="botoia" type="submit" value="Bilatu" name="botoia" onClick="erakutsi()">
	</div>
	
	<div id="formularioaDiv">
		<form  id="galderaBorratzekoFormularioa" name="galderaBorratzekoFormularioa" style="display: none" action="removeQuestion.php" method="post"  enctype="multipart/form-data">
			<label for="idBorratzekoa">Galderaren IDa:</label>
			<input type="text" name="idBorratzekoa" id="idBorratzekoa" class="erantzuna" />
			<br/><br/>
			<label for="galderaTestua">Galderaren testua: </label>
			<input type="text" name="galderaTestua"  class="erantzuna" id="galderaTestua" height="2000px" disabled />
			<br/><br/>
			<label for="erantzunZuzena">Erantzun zuzena: </label>
			<input type="text" name="erantzunZuzena" class="erantzuna" id="erantzunZuzena" width="600px" disabled />
			<br/><br/>
			<label for="erantzunOkerra1">Erantzun okerra1: </label>
			<input type="text" name="erantzunOkerra1" class="erantzuna" id="erantzunOkerra1" width="600px" disabled />
			<br/><br/>
			<label for="erantzunOkerra2">Erantzun okerra2: </label>
			<input type="text" name="erantzunOkerra2" class="erantzuna" id="erantzunOkerra2" width="600px" disabled />
			<br/><br/>
			<label for="erantzunOkerra3">Erantzun okerra3: </label>
			<input type="text" name="erantzunOkerra3" class="erantzuna" id="erantzunOkerra3" width="600px" disabled />
			<br/><br/>
			<label for="galderaZail">Galderaren zailtasuna(1-5): </label>
			<input type="text" name="galderaZail" id="galderaZail" disabled />
			<br/><br/>
			<label for="galderaArloa">Galderaren arloa: </label>
			<input type="text" name="galderaArloa" id="galderaArloa" disabled />
			<br/><br/>
			<label for="botoia">&nbsp</label>
			<input id="botoia" type="submit" value="Borratu" name="botoia"> &nbsp
		</form>

	</div >
    </section>
	<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
</div>

</body>
</html>