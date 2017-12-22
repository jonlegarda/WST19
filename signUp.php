<?php 

	if (isset($_POST['pasahitza'])) {
		include 'configEzarri.php';
		// Konexioa sortu

		$balioztuta = true;
		
		if ($balioztuta) {
			$connection = new mysqli($servername, $username, $password, $dbname);
			// Konexioa Egiaztatu (Ondo dagoen edo ez)
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
			}
			function phpAlert($msg) {
				echo '<script type="text/javascript">alert("' . $msg . '")</script>';
			}
				$postaElektronikoa = $_POST['posta'];
				$deitura = $_POST['deitura'];
				$nick = $_POST['nick'];
				$pasahitza = $_POST['pasahitza'];
				$pasahitza2 = $_POST['pasahitza2'];
				$check = is_uploaded_file($_FILES["irudiProfil"]["tmp_name"]);
				$trimPostaElektronikoa= trim($postaElektronikoa);
				$trimDeitura= trim($deitura);
				$trimNick= trim($nick);
				$trimPasahitza= trim($pasahitza);
				$trimPasahitza2= trim($pasahitza2);
				if(!preg_match("/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/", $trimPostaElektronikoa)){
					echo "<script> alert('pasahitzaren formatua ez da egokia.') </script>";
				}
				else if(!preg_match("/^([A-Z]([a-z]+)\s[A-Z]([a-z]+)\s?)+/", $trimDeitura)){
					echo "<script> alert('deitura ez da egokia.') </script>";
				}
				else if(!preg_match("/^([^\s]{1,})$/", $trimNick)){
					echo "<script> alert('goitizenak hitz bakarra izan behar du.') </script>";
				}
				else if(!preg_match("/^([^\s]{1,})$/", $trimPasahitza)){
					echo "<script> alert('pasahitzak ezin du hutsunerik izan.') </script>";
				}
				else if(!preg_match("/^([^\s]{6,})$/", $trimPasahitza)){
					echo "<script> alert('pasahitzak gutxienez 6 karaktere izan behar ditu.') </script>";
				}
				else if($trimPasahitza2 != $trimPasahitza){
					echo "<script> alert('pasahitzak bersdinak izan behar dira.') </script>";
				}else{
					if ($check !== false){
								$image = $_FILES['irudiProfil']['tmp_name'];
								$imgContent = addslashes(file_get_contents($image));
					} else {
								$imgContent = addslashes(file_get_contents('erabiltzailea.bin'));
					}

					$trimPostaElektronikoa = trim($postaElektronikoa);
					$trimDeitura = trim($deitura);
					$trimNick = trim($nick);
					$trimPasahitza = trim($pasahitza);		
					$enkripPasahitza = crypt($trimPasahitza, "wsLizasoLegardaEnkriptazioPasahitza");
					$sql = "INSERT INTO users (PostaElektronikoa, Deitura, Nick, Pasahitza, IrudiProfil) 
							VALUES ('$trimPostaElektronikoa', '$trimDeitura', '$trimNick','$enkripPasahitza','$imgContent')";
					$insert = $connection->query($sql);
					if ($insert) {
						phpAlert ("Erabiltzaile berria sortu da!");
						print "<meta http-equiv=Refresh content=\"0 ; url=layoutR.php\">"; 
					} else {
						phpAlert( "Posta elektroniko hori jadanik erabilita dago! Saiatu beste posta kontu batekin.");
					}
				}
			
		$connection->close();
			
		}else {
			phpAlert("Barkatu, CrazyQuestions-en logeatzeko");
		}
	}

	
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign Up </title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
      /*body {
           background-color: cadetblue;
        }
        titulua{
            font-style: italic;
            font-size: 40px;
            color: navy;
        }
        label {
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
        }*/
		
    </style>
</head>


<body>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" language="javascript">

	xhroMatr = new XMLHttpRequest();
	xhroPas = new XMLHttpRequest();
	
	xhroPas.onreadystatechange = function () {
		if ((xhroPas.readyState==4)&&(xhroPas.status==200)) { 
			var erantzuna = xhroPas.responseText;
		    console.log(erantzuna);
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
		var pasahitza= $("#pasahitza").val();
		xhroPas.open("GET", "pasahitzaWS.php?pasahitza="+pasahitza, true);
		xhroPas.send();
	}
	xhroMatr.onreadystatechange = function () {
		if ((xhroMatr.readyState==4)&&(xhroMatr.status==200 )) { 
			var erantzuna = xhroMatr.responseText;
			console.log(erantzuna);
			if (erantzuna == "BAI") {
				document.getElementById("matrikulatutaWSn").style.color = "green";
				document.getElementById("matrikulatutaWSn").innerHTML = " Korreoa zuzena da (Web Sistema ikasgaian matrikulatuta zaude).";
			} else if (erantzuna == "EZ") {
				document.getElementById("matrikulatutaWSn").style.color = "red";
				document.getElementById("matrikulatutaWSn").innerHTML = " Barkatu, baina korreo hori ez dago Web Sistemak ikasgaian matrikulatuta.";
			} else {
				document.getElementById("matrikulatutaWSn").style.color = "red";
				document.getElementById("matrikulatutaWSn").innerHTML = " Errorea WS Zerbitzuarekin.";
			}
		}
	}
	
	function matrikulatutaWS() {
		var posta= $("#posta").val();
		xhroMatr.open("GET", "matrikulatutaWS.php?ePosta="+posta, true);
		xhroMatr.send();
	}
	
    function previewFile() {
        var preview = document.querySelector('img');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
		$("#irudiBistaratua").show();
    }
	
	function deleteIrudiBistaratua() {
		$("#irudiBistaratua").hide();
	}
	
	function egiaztatu(){
		if ($.denakBeteta()) {
			var trimEmail= $("#posta").val().trim();
			var trimDeitura= $("#deitura").val().trim();
			var trimNick= $("#nick").val().trim();
                if(	!trimEmail.match(/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/)){
					window.alert("korreoak ez du egitura egokia");
					return false;
				}
				if(!trimDeitura.match(/^([A-Z]([a-z]+)\s[A-Z]([a-z]+)\s?)+/)){
					window.alert("Deitura oker dago.");
					return false;
				}
				if(!trimNick.match(/^([^\s]{1,})$/)){
					window.alert("Goitizenak hitz bakarra izan behar du ");
					return false;
				}
				if(!$("#pasahitza").val().match(/^([^\s]{1,})$/)){
					window.alert("Pasahitzak ezin du hutsunerik izan");
					return false;
				}
				if(!$("#pasahitza").val().match(/^\S{6,500}/)){
					window.alert("Pasahitzak gutxienez 6 karaktere izan behar ditu");
					return false;
				}
				 if ($("#pasahitza").val() != $("#pasahitza2").val()){
					 window.alert("bi pasahitzak berdinak izan behar dira");
					 return false;
				 }
				 return true;
				
            } else {
                window.alert("Kontuz! Datu guztiak bete behar dira.");
                return false;
            }
			return true;
	}
    $(document).ready(function(){

        $.postaZuzena = function(){
            var balioa= $("#posta").val();
            if (balioa.match((/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/))){
                return true;
            } else {
                return false;
            }
        }
        $.denakBeteta = function(){		
			if (($("#posta").val().length>0) &&($("#deitura").val().length>0)&&($("#nick").val().length>0)
				&&($("#pasahitza").val().length>0)&&($("#pasahitza2").val().length>0)){
                return true;
            } else {
                return false;
            }
        }
    })

	</script>
	<div class="container-fluid">
	<div id='page-wrap'>
		<header class='main' id='h1'>
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
	</header>
	<nav class='main' id='n1' role='navigation'>
	<div class="row">
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="logIn.php">Log In</a></div>
		<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="signUp.php"  >Sign Up</a></div>
		</div>
	</nav>
	<section class="main" id="s1">
		<h1>Sign Up</h1>
		<br/>
		<p>(*) Karakterea duten hutsuneak derrigorrezkoak dira.</p>
		<div align="center">
			<form  id="signUp" name="signUp"  action="" method="post" onsubmit="return egiaztatu(this)" enctype="multipart/form-data">
				<label for="posta">Posta elektronikoa (*): </label> &nbsp; &nbsp;
				<input type="text" name="posta" id="posta" onChange="matrikulatutaWS()" class="hutsuneak"/>
				<div id="matrikulatutaWSn"></div>
				<br/>
				<label for="deitura">Deitura (*): </label> &nbsp; &nbsp;
				<input type="text" name="deitura" id="deitura" class="hutsuneak"/>
				<br/><br/>
				<label for="nick">Nick(*): </label>
				<input type="text" name="nick" id="nick" class="hutsuneak"/>
				<br/><br/>
				<label for="pasahitza">Pasahitza (*): </label> &nbsp; &nbsp;
				<input type="password" name="pasahitza" id="pasahitza" class="hutsuneak" onChange="PasahitzaEgiaztatu()"/>
				<br/><br/>
				<label for="pasahitza2">Pasahitza errepikatu (*): </label> &nbsp; &nbsp;
				<input type="password" name="pasahitza2" id="pasahitza2" class="hutsuneak"/>
				<div id="pasahitzaErakutsi"></div>
				<br/>
				<label for="irudiProfil">Irudia (hautazkoa): </label> &nbsp; &nbsp;
				<input type="file" name="irudiProfil" id="irudiProfil" onchange="previewFile()" >
				<br/><br/>
				<input type="submit" id="botoia" value="Sign Up" name="botoia" onsubmit="egiaztatu()" > &nbsp
				<input type="reset" value="Borratu" id="reset" ><br><br>
			</form>
		</a>
		<img src="" id="irudiBistaratua" width="220px" style="display: none;">
		</section>
		<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
		</div>
		</div>
</body>
</html>