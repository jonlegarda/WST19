<?php 

	if (isset($_POST['pasahitza'])) {
	include 'configEzarri.php';

	// Konexioa sortu
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
			$check = is_uploaded_file($_FILES["irudiProfil"]["tmp_name"]);

			if ($check !== false){
						$image = $_FILES['irudiProfil']['tmp_name'];
						$imgContent = addslashes(file_get_contents($image));
			} else {
						$imgContent=addslashes(file_get_contents('erabiltzailea.bin'));
			}

			$trimPostaElektronikoa = trim($postaElektronikoa);
			$trimDeitura = trim($deitura);
			$trimNick = trim($nick);
			$trimPasahitza = trim($pasahitza);
			
			$sql = "INSERT INTO users (PostaElektronikoa, Deitura, Nick, Pasahitza, IrudiProfil) 
					VALUES ('$trimPostaElektronikoa', '$trimDeitura', '$trimNick','$trimPasahitza','$imgContent')";

			$insert = $connection->query($sql);
			if ($insert) {
				phpAlert ("Erabiltzaile berria sortu da!");
				print "<meta http-equiv=Refresh content=\"0 ; url=layoutR.php?ePosta=$postaElektronikoa\">"; 
			} else {
				phpAlert( "Posta elektroniko hori iada erabilita dago! Saiatu beste posta kontu batekin.");
			} 
				
			
	$connection->close();
	}

	
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign Up </title>

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
<titulua>Sign Up</titulua>
<p>(*) Karakterea duten hutsuneak derrigorrezkoak dira.</p>
<form  id="signUp" name="signUp"  action="" method="post" onsubmit="return egiaztatu(this)" enctype="multipart/form-data" >
    <label for="posta">Posta elektronikoa(*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna"/>
    <br/><br/>
    <label for="deitura">Deitura (bi izen gutxienez eta lehen letra handia)(*): </label>
    <input type="text" name="deitura"  class="erantzuna" id="deitura" height="2000px"/>
    <br/><br/>
    <label for="nick">Nick(*): </label>
    <input type="text" name="nick" class="erantzuna" id="nick" width="600px"/>
    <br/><br/>
    <label for="pasahitza">Pasahitza(*): </label>
    <input type="password" name="pasahitza" class="erantzuna" id="pasahitza" width="600px"/>
    <br/><br/>
    <label for="pasahitza2">Pasahitza errepikatu(*): </label>
    <input type="password" name="pasahitza2" class="erantzuna" id="pasahitza2" width="600px"/>
    <br/><br/>
	<label for="irudiProfil">Irudia(hautazkoa): </label>
    <input type="file" name="irudiProfil" id="irudiProfil" onchange="previewFile()" >
    <br/><br/>
	<label for="botoia">&nbsp</label>
    <input type="submit" id="botoia" value="Sign Up" name="botoia" onsubmit="egiaztatu()" > &nbsp
    <input type="reset" value="Borratu" id="reset" ><br><br>
</form>
<img src="" id="irudiBistaratua" width="200" style="display: none;">
</body>
</body>
</html>

