<?php

	function phpAlert($msg) {
				echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	include "configEzarri.php";
	if (isset($_POST['posta'])) {
		
		$postaElektronikoa = $_POST['posta'];
		$nickname = $_POST['nickname'];
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
		}
		$sql = "SELECT * FROM users WHERE PostaElektronikoa='$postaElektronikoa' AND Nick='$nickname'";
		$korreoa = $connection->query($sql);
		if (! ($korreoa)) {
			echo "Error in the query". $korreoa->error; 
		} else {
			$rows_cnt = $korreoa->num_rows;
			$connection->close();
			if ($rows_cnt==1) {
				session_start();
				$_SESSION["k"]=$postaElektronikoa;
				phpAlert("Zuzenak dira posta elektronikoa eta nickname-a.");
				print "<meta http-equiv=Refresh content=\"0 ; url=changePassword_galdera.php\">"; 
			} else {
				phpAlert("Posta elektronikoa eta nickname-a ez dute koinziditzen.");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pasahitza aldatu</title>

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
<p>Posta elektronikoa idatzi eta zure nickname.</p>
<form  id="forgetPassword" name="forgetPassword"  action="forgetPassword_galdera.php" method="post"  enctype="multipart/form-data"  >
    <label for="posta">Posta elektronikoa (*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna"/>
    <br/><br/>
	<label for="nickname">Nickname (*): </label>
    <input type="text" name="nickname" id="nickname" class="erantzuna"/>
    <br/><br/>
	<input id="botoia" type="submit" value="Aldatu Pasahitza" name="botoia" width="350px" > &nbsp
</form>
</body>
</body>
</html>