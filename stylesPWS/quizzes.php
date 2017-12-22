<?php
	session_start();
	if (isset($_POST['anonimoIzena'])) {
		include 'configEzarri.php';
		
		$connection = new mysqli($servername, $username, $password, $dbname);
		if ($connection->connect_error) { die("Connection failed: " . $connection->connect_error ); }
		
		$nickname = $_POST['anonimoIzena'];
		$trimNickname = trim($nickname);
		$sql = "SELECT Nick FROM quizzers;";
		$result = $connection->query($sql);
		$ondo = true;
		while ($row = $result->fetch_assoc()) {
			if ($row['Nick'] == $trimNickname) {
				echo "<script> alert('Erabiltzaile bat dagoeneko izen hori dauka, proba ezazu beste batekin.') </script>";
				$ondo = false;
			}
		}
		$sql2 = "SELECT Nick FROM users;";
		$result2 = $connection->query($sql2);
		$ondo2 = true;
		while ($row = $result2->fetch_assoc()) {
			if ($row['Nick'] == $trimNickname) {
				echo "<script> alert('Erabiltzaile bat dagoeneko izen hori dauka, proba ezazu beste batekin.') </script>";
				$ondo2 = false;
			}
		}
		if ($ondo && $ondo2) {
			$sql3 = "INSERT INTO quizzers (Nick, Ondo, Gaizki) VALUES ('$trimNickname','0','0')"; 
			$insert = $connection->query($sql3);
			$_SESSION["anonimoIzena"] = $trimNickname;
		} else {
			
		}
		$connection->close();
	}
?>
<!DOCTYPE html>
<html>
  <head>
  <style>
   </style>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
		
		function anonimokiSartu() {
			document.getElementById("botoi1").style.pointerEvents = "auto";
			document.getElementById("botoi2").style.pointerEvents = "auto";		
		}
		
		function myFunction() {
			var r=confirm("Ziur al zaude zure kontutik atera nahi duzula?");
			if (r==false){
				return false;
			} else {
				return true;
			}
		}
		
	</script>
  </head>
  <body>
  <div class="container-fluid">
	  <div id='page-wrap'>
		<header class='main' id='h1'>
		<span class="right" style="display:none;"><a href="logOut.php">Log Out</a> </span>
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
		</header>
		<nav class='main' id='n1' role='navigation'>
		<?php
				if (isset($_SESSION["kautotuta"])){
					if ($_SESSION["kautotuta"] == "irakaslea"){
						echo'<div class="row">';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" style="border-right: 1px solid #ccc;"><a class="btn-block" href="layoutR.php">Quizzes</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="reviewingQuizes.php">Review in Quizes</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" s ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
						echo'</div>';
					} else if ($_SESSION["kautotuta"] == "ikaslea"){
						echo '<div class="row">';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="layoutR.php">Quizzes</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="handlingQuizes.php">Handling Quizes</a></div>';
						echo '<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
						echo '</div>';
					}
				} else {
					echo '<div class="row" >';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Quizzes</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">Log In</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="signUp.php">SignUp</a></div>';
					echo '</div>';
				}
		?>
		</nav>
		<section class="main" id="s1">
		<h1>Quizzes</h1>
		<?php
			include 'configEzarri.php';
			if (isset($_SESSION["kautotuta"])){
				if($_SESSION["kautotuta"] == "ikaslea"){
					echo("<div>");
					$postaElektronikoa=$_SESSION["korreoa"];
					echo "<br>";
					$connection = new mysqli($servername, $username, $password, $dbname);
					if ($connection->connect_error) {
						die("Connection failed: " . $connection->connect_error);
					}
					$sql = "SELECT IrudiProfil FROM users WHERE PostaElektronikoa='$postaElektronikoa'";
					$result = $connection->	query($sql);
					if ($result->num_rows > 0) {
						echo "Posta: ". $postaElektronikoa;
						echo "<br>";
						$row = $result->fetch_assoc();
						echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['IrudiProfil'] ).'" width="100" height="75"/> ';	
					}
					echo("</div>");
					$connection->close();
				}
			} else {
				if (isset($_SESSION["anonimoIzena"])) {
					echo "Zure izena: ".$_SESSION["anonimoIzena"];
					echo "<br/>";
					echo "<br/>";
				} else {
					echo '<div>';
					echo '<h3>Idatz ezazu jolasteko nickname bat:</h3>';
					echo '<form id="formAnonimokiSartu" name="formAnonimokiSartu" action="quizzes.php" method="post" enctype="multipart/form-data" >';
					echo '<input type="text" name="anonimoIzena" id="anonimoIzena"/>';
					echo '<br/><br/>';
					echo '<label for="botoia">&nbsp</label>';
					echo '<input id="botoia" type="submit" value="Sartu" name="botoia"/>';
					echo '</form>';
					echo '</div>';
				}
			}
		?>
		<?php
			if (isset($_SESSION["kautotuta"])){
				echo ("<span align='center'>");
				echo '<span><a id="botoi1" class="specialButton2" href="onePlay.php">ONE-PLAY</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<span><a id="botoi2" class="specialButton2" href="playBySubject.php">PLAY BY SUBJECT</a></span>';
				echo ("</span> ");
			} else {
				if (isset($_SESSION["anonimoIzena"])){
					echo ("<span align='center'>");
					echo '<span><a id="botoi1" class="specialButton2" href="onePlay.php">ONE-PLAY</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					echo '<span><a id="botoi2" class="specialButton2" href="playBySubject.php">PLAY BY SUBJECT</a></span>';
					echo ("</span> ");
					include 'ranking.php';
					echo "<br/>";
				} else {
					echo ("<span align='center'>");
					echo '<span><a id="botoi1" class="specialButton" href="onePlay.php">ONE PLAY</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					echo '<span><a id="botoi2" class="specialButton" href="playBySubject.php">PLAY BY SUBJECT</a></span>';
					echo ("</span> ");
					echo ("<br/>");
					
				}
			}
		?>
		</section>
		<footer class='main' id='f1'>
			<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
			<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
		</footer>
	</div>
	</div>
</body>
</html>

