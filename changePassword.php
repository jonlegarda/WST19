<?php
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	if (isset($_POST['pasahitza1'])) {
		include "configEzarri.php";
		$postaElektronikoa = $_GET['posta'];
		
		$pasahitzBerria = $_POST['pasahitza1'];
		$trimPasahitza = trim($pasahitzBerria);
		$enkripPasahitza = crypt($trimPasahitza, "wsLizasoLegardaEnkriptazioPasahitza");
		
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
		}
		$sql = "UPDATE users SET Pasahitza=$enkripPasahitza WHERE PostaElektronikoa=$postaElektronikoa";
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


<body>

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

<titulua>Pasahitza aldatu</titulua>
<p>Idatz ezazu bi aldiz pasahitza berria eta ondoren, "aldatu" botoian klik egin ezazu.</p>
<form  id="changePassword" name="changePassword"  action="changePassword.php?posta=<?php echo $_GET['posta'];?>" method="post"  enctype="multipart/form-data"  >
    <label for="ePosta">Zure Korreoa: </label>
    <input type="text" name="ePosta" id="ePosta"  value="<?php echo $_GET['posta']; ?>" disabled class="erantzuna"/>
	<br/><br/>
	<label for="pasahitza1">Pasahitza (*): </label>
    <input type="text" name="pasahitza1" id="pasahitza1" class="erantzuna"/>
	<div id="pasahitzaErakutsi"></div>
    <br/><br/>
	<label for="pasahitza2">Pasahitza errepikatu (*): </label>
    <input type="text" name="pasahitza2" id="pasahitza2" class="erantzuna"/>
    <br/><br/>
	<input id="botoia" type="submit" value="Aldatu" name="botoia" width="350px" onsubmit="egiaztatu()" > &nbsp
</form>
</body>
</body>
</html>