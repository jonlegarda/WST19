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

    $(document).ready(function(){

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
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>
			<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">Login</a></div>
			<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="signUp.php">SignUp</a></div>
			</div>
		</nav>
		<section class="main" id="s1">
			<h1>Pasahitza ahaztuta?</h1>
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
		</section>
		<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
	</div>
</div>
</body>
</html>