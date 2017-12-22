<?php
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Credits</title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
  </head>
	<body>
	<div class="container-fluid">
		<div id='page-wrap'>
			<header class='main' id='h1'>
			  <span class="right" style="display:none;"><a href="/logout">Log Out</a> </span>
			  <h1><a  href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
			</header>
			<nav class='main' id='n1' role='navigation'>
			
					<?php
			if(isset($_SESSION["kautotuta"])){
				if ($_SESSION["kautotuta"] == "irakaslea"){
				echo'<div class="row">';
				echo '<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
				echo '<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" style="border-right: 1px solid #ccc;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
				echo '<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="reviewingQuizes.php">Reviewing Quizzes</a></div>';
				echo '<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="removeQuestion.php">Remove Questions</a></div>';
				echo '<div class="col-sm-2" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>';
				echo '<div class="col-sm-2" s ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
				echo'</div>';
				}
				else if($_SESSION["kautotuta"] == "ikaslea"){
					echo'<div class="row">';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #ccc;"><a class="btn-block" href="layoutR.php">Home</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #ccc;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #ccc;"><a class="btn-block" href="handlingQuizes.php">Handling Quizes</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>';
					echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #ccc;"><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
					echo '</div>';
				}
			} else {
				echo'<div class="row">';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">LogIn</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="signUp.php">SignUp</a></div>';
				echo '</div>';
			}
				?>
				</nav>
			<section class="main" id="s1">
			<!--<p><?php if(isset($_SESSION["kautotuta"])){
				$postaElektronikoa=$_SESSION["korreoa"];
				echo 'Posta:  ' . $postaElektronikoa;
			}
			?></p>-->
			<div>
			<h1>Credits</h1>
			<br/>
			This game authors are <strong>Manex Lizaso Alcibar</strong> and <strong>Jon Legarda Gonzalez</strong>.<br><br>
			<a href="https://www.ehu.eus/es/web/informatika-fakultatea"><img src="http://www.sc.ehu.es/jiwlucap/fiss.jpg" align="middle" id="inforIrudi" width="150"></a><br>
			Speciality in Software Engineering.<br>
			Faculty of Computering in Donostia-San Sebastian (Gipuzkoa).<br>
			UPV-EHU: University of the Basque Country.<br>
			<br>
			<a href="layoutR.php">
			<img src="https://www.shareicon.net/data/512x512/2015/11/19/674400_home_512x512.png" align="middle" alt="" width="42" height="42" border="0"><br>
		</a>
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
