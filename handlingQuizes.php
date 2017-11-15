<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Handling Quizes </title>
    <style>
        body {
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
        }
        .erantzuna{
            width: 350px;
        }
		
    </style>
</head>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
	
	var xhro1 = new XMLHttpRequest();
	var xhro2 = new XMLHttpRequest();
	var xhro3 = new XMLHttpRequest();
	var xhro4 = new XMLHttpRequest();
	
	xhro1.onreadystatechange = function () {
		if ((xhro1.readyState==4)&&(xhro1.status==200 )) { 
			document.getElementById("txertaketaOndo").innerHTML = xhro1.responseText;
			if(xhro1.responseText=="OK. Txertaketa DBan eta XMLan ondo burutu dira."){
				alert("iritxi da");
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
		var ePosta = "<?php echo "$_GET[ePosta]";?>";
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
<titulua>Galdera sortu:</titulua>
<p>(*) Karakterea duten hutsuneak derrigorrezkoak dira.</p>
<br/><br/>
<form  id="galderenF" name="galderenF"  action="" method="post">

	<label for="posta">Posta elektronikoa(*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna" value='<?php echo $_GET["ePosta"];?>' disabled />
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
    <label for="galderaZail">Galderaren zailtasuna(1-5)(*): </label>
    <input type="text" name="galderaZail" id="galderaZail"/>
    <br/><br/>
    <label for="galderaArloa">Galderaren arloa(*): </label>
    <input type="text" name="galderaArloa" id="galderaArloa"/>
    <br/><br/>
	<input type="button" id="txertatu" name="txertatu" value="Txertatu" onclick="galderaTxertatuXML()"/>
	<input type="button" id="ikusi" name="ikusi" value="Ikusi" onclick="galderakJaso()"/>
	<br/><br/>
	<a href="layoutR.php?ePosta=<?php echo $_GET["ePosta"]?>">ATZERA</a>
</form>
<br/>
<div id="nireGalderaKopurua">
</div>
<br/>
<div id="konektatuenKopurua">
</div>
<br/>
<div id="txertaketaOndo">
</div>
<br/>
<div id="galderak" name="galderak">
</div>
</body>
</html>
