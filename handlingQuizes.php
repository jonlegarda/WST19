<?php
	include "segurtasunaIkaslea.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Handling Quizes </title>
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
			width:300px; 
			text-align: left;
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

	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
	
	var xhro1 = new XMLHttpRequest();
	var xhro2 = new XMLHttpRequest();
	var xhro3 = new XMLHttpRequest();
	var xhro4 = new XMLHttpRequest();
	
	xhro1.onreadystatechange = function () {
		if ((xhro1.readyState==4)&&(xhro1.status==200 )) { 
			document.getElementById("txertaketaOndo").innerHTML = xhro1.responseText;
			if (xhro1.responseText=="OK. Txertaketa DBan eta XMLan ondo burutu dira."){
				document.getElementById("galderenF").reset();
			}
		}
	}
	
	xhro2.onreadystatechange = function () {
		if ((xhro2.readyState==4)&&(xhro2.status==200 )) { 	
			document.getElementById("galderak").innerHTML = xhro2.responseText;
		}
	}
	
	xhro3.onreadystatechange = function(){
		if ((xhro3.readyState==4)&&(xhro3.status==200)){
			var emaitza3 = xhro3.responseText;
			document.getElementById("nireGalderaKopurua").innerHTML = "Nire Galderak/Galderak guztira: " + emaitza3;
		}
	}
			
	xhro4.onreadystatechange = function(){
		if ((xhro4.readyState==4)&&(xhro4.status==200)){
			var emaitza4 = xhro4.responseText;
			document.getElementById("konektatuenKopurua").innerHTML = "Unean konektatutako erabiltzaile kopurua: " + emaitza4;
		}
	}
	window.onload = function() {
		galderaKop();
		onlineKopurua(1);
		setInterval(onlineKopurua, 2000);
		setInterval(galderaKop, 20000);
	}
	window.onbeforeunload  = function() {
		onlineKopurua(2);
	}
	window.onhaschange = function() {
		onlineKopurua(2);
	}
	window.onpagehide = function() {
		onlineKopurua(2);
	}
	
	function galderaTxertatuXML() {
		if ($.denakBeteta()) {
                if ($.postaZuzena()) {
                    if ($("#galderaZail").val().match(/^[1-5]$/)){
                        if ($("#galderaTestua").val().length>=10){
							
							var trimPostaElektronikoa = $("#posta").val();
							var trimGalderaTestua = $("#galderaTestua").val();
							var trimErantzunZuzena = $("#erantzunZuzena").val();
							var trimErantzunOkerra1 = $("#erantzunOkerra1").val();
							var trimErantzunOkerra2 = $("#erantzunOkerra2").val();
							var trimErantzunOkerra3 = $("#erantzunOkerra3").val();
							var trimGalderaZail = $("#galderaZail").val();
							var trimGalderaArloa = $("#galderaArloa").val();
							
							xhro1.open("POST","addQuestionAJAX.php", true);
										xhro1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							
							xhro1.send("ePosta=" + trimPostaElektronikoa + "&galderaTestua=" + trimGalderaTestua + "&erantzunZuzena=" + trimErantzunZuzena 
									+ "&erantzunOkerra1=" + trimErantzunOkerra1 + "&erantzunOkerra2=" + trimErantzunOkerra2 
									+ "&erantzunOkerra3=" + trimErantzunOkerra3 + "&galderaZail=" + trimGalderaZail + "&galderaArloa=" + trimGalderaArloa);
								
                        } else {
                            window.alert("Galderak gutxienez 10 karakterekoa izan behar du.");
                        }
                    } else {
                        window.alert("Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.");
                    }
                } else {
                    window.alert("Posta Elektonikoa okerra da.");
                }
        } else {
            window.alert("Datu guztiak bete behar dira.");
		}
	}
	
	function galderakJaso() {
		if ($("#ikusi").val()== "Ikusi"){
		xhro2.open("GET", "showQuestionsAJAX.php", true);
		xhro2.send();
		$("#ikusi").val("Ezkutatu");
		}else{
			$("#ikusi").val("Ikusi");
			$("#galderak").empty();
		}
	}					

	function galderaKop() {
		var ePosta = "<?php
		$postaElektronikoa=$_SESSION["korreoa"];
		echo $postaElektronikoa;?>";
		xhro3.open("GET", "galderaKopurua.php?ePosta="+ePosta, true);
		xhro3.send();
	}
	function onlineKopurua(kont) {
		xhro4.open("GET", "online.php?kont="+kont, true);
		console.log("online.php?kont="+kont);
		xhro4.send();
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
            if (($("#posta").val().length>0) &&($("#galderaTestua").val().length>0)&&($("#erantzunZuzena").val().length>0)&&($("#erantzunOkerra1").val().length>0)
                &&($("#erantzunOkerra2").val().length>0)&($("#erantzunOkerra3").val().length>0)&($("#galderaZail").val().length>0) &($("#galderaArloa").val().length>0)){
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
		<div class="col-sm-3" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>
		<div class="col-sm-3" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>
		<div class="col-sm-3" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>
		<div class="col-sm-3" ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>
		</div>
	</nav>
	<section class="main" id="s1">
		<h1>Galdera Sortu</h1>
		</br>
		<p><?php if(isset($_SESSION["kautotuta"])){
			$postaElektronikoa=$_SESSION["korreoa"];
			echo 'Posta:  ' . $postaElektronikoa;
		}else{
			echo 'anonimoa';
		}
		?></p>
		</br>
		<p>(*) Karakterea duten hutsuneak derrigorrezkoak dira.</p>
		<br/><br/>
		<form  id="galderenF" name="galderenF"  action="" method="post">

			<label for="posta">Posta elektronikoa(*): </label>
			<input type="text" name="posta" id="posta" class="erantzuna" value='<?php echo $_SESSION["korreoa"];?>' disabled />
			<br/><br/>
			<label for="galderaTestua">Galderaren testua(*): </label>
			<input type="text" name="galderaTestua"  class="erantzuna" id="galderaTestua" height="2000px"/>
			<br/><br/>
			<label for="erantzunZuzena">Erantzun zuzena(*): </label>
			<input type="text" name="erantzunZuzena" class="erantzuna" id="erantzunZuzena" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra1">Erantzun okerra1(*): </label>
			<input type="text" name="erantzunOkerra1" class="erantzuna" id="erantzunOkerra1" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra2">Erantzun okerra2(*): </label>
			<input type="text" name="erantzunOkerra2" class="erantzuna" id="erantzunOkerra2" width="600px"/>
			<br/><br/>
			<label for="erantzunOkerra3">Erantzun okerra3(*): </label>
			<input type="text" name="erantzunOkerra3" class="erantzuna" id="erantzunOkerra3" width="600px"/>
			<br/><br/>
			<label for="galderaZail">Zailtasuna (1-5)(*): </label>
			<input type="text" name="galderaZail" id="galderaZail"/>
			<br/><br/>
			<label for="galderaArloa">Galderaren arloa(*): </label>
			<input type="text" name="galderaArloa" id="galderaArloa"/>
			<br/><br/>
			<input type="button" id="txertatu" name="txertatu" value="Txertatu" onClick="galderaTxertatuXML()"/>
			<input type="button" id="ikusi" name="ikusi" value="Ikusi" onClick="galderakJaso()"/>
			<br/>
		</form>
		</section>
		<section class="main" id="s1">
		<div id="nireGalderaKopurua">
		</div>
		<div id="konektatuenKopurua">
		</div>
		<div id="txertaketaOndo">
		</div>
		<div id="galderak" name="galderak">
		</div>
		</section>
	
	<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
	</div>
	</div>
</body>
</html>
