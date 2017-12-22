<?php

	function phpAlert($msg) {
				echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	include "configEzarri.php";
	if (isset($_POST['posta'])) {
		
		$postaElektronikoaTO = $_POST['posta'];
		
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
		}
		$sql = "SELECT * FROM users WHERE PostaElektronikoa='$postaElektronikoaTO'";
		$korreoa = $connection->query($sql);
		if (! ($korreoa)) {
			echo "Error in the query". $korreoa->error; 
		} else {
			$rows_cnt = $korreoa->num_rows;
			$connection->close();
			if ($rows_cnt==1) {
				$titulua = "Pasahitza aldatzeko zerbitzua - Crazy Questions";
				$mezua = "Kaixo, $postaElektronikoaTO! Pasahitza aldatzeko eskatu diguzu.
					Horretarako, bi pausu bete beharko dituzu. Lehenik eta behin, behean agertzen den estekan klikatu. 
					Ondoren, pasahitz berria bi aldiz idatzi eta aldatuta izango duzu.
					<a href='changePassword.php?posta=$postaElektronikoaTO'>Esteka</a> Mila esker!";
				$goiburua = 'From: crazyquestions@ws.com' . "\r\n" .
				'Reply-To: jonlegarda002@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				mail($postaElektronikoaTO, $titulua, $mezua, $goiburua);
				phpAlert("Korreora bidali zaizu pasahitza aldatzeko esteka.");
			} else {
				phpAlert("Barkatu baina korreo hori erregistratuta ez dago.");
			}
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

    $(document).ready(function(){

    })

</script>

<titulua>Pasahitza ahaztuta?</titulua>
<p>Posta elektronikoa idatzi eta zure korreora pasahitza aldatzeko esteka iritsiko zaizu.</p>
<form  id="forgetPassword" name="forgetPassword"  action="forgetPassword.php" method="post"  enctype="multipart/form-data"  >
    <label for="posta">Posta elektronikoa (*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna"/>
    <br/><br/>
	<input id="botoia" type="submit" value="Aldatu Pasahitza" name="botoia" width="350px" > &nbsp
</form>
<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
</body>
</body>
</html>