<?php
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 700px) and (min-device-width: 600px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
	<h2>CREDITS</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	
			<?php
	if(isset($_SESSION["kautotuta"])){
		if ($_SESSION["kautotuta"] == "irakaslea"){
			echo '<span><a href="layoutR.php">Quizzes</a></span>';
			echo '<span><a href="layoutR.php">Home</a></span>';
			echo '<span><a href="reviewingQuizes.php">Review in Quizes</a></span>';
			echo '<span><a href="logOut.php" onclick="return myFunction()" >Log Out</a></span>';
		}
		else if($_SESSION["kautotuta"] == "ikaslea"){
			echo '<span><a href="layoutR.php">Quizzes</a></span>';
				echo '<span><a href="layoutR.php">Home</a></span>';
			echo '<span><a href="handlingQuizes.php">Handling Quizes</a></span>';
			echo '<span><a href="logOut.php" onclick="return myFunction()" >Log Out</a></span>';
		}
	}
	else{
		echo '<span><a href="layoutR.php">Quizzes</a></span>';
			echo '<span><a href="layoutR.php">Home</a></span>';
		echo '<span><a href="logIn.php">LogIn</a></span>';
		echo '<span><a href="signUp.php">SignUp</a></span>';
	}
		?>
		</nav>
    <section class="main" id="s1">
    
	
	<div>
    <br>
	This game authors are <strong>Manex Lizaso Alcibar</strong> and <strong>Jon Legarda Gonzalez</strong>.<br><br>
    <img src="http://www.sc.ehu.es/jiwlucap/fiss.jpg" align="middle" id="inforIrudi" width="150"><br>
    Speciality in Software Engineering.<br>
    Faculty of Computering in Donostia-San Sebastian (Gipuzkoa).<br>
    UPV-EHU: University of the Basque Country.<br>
    <br>
    <a href="layoutR.php">
<img src="https://images.roadtrafficsigns.com/img/lg/K/go-back-arrow-sign-k-0138-r.png" align="middle" alt="" width="42" height="42" border="0"><br>
</a>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>

	</footer>
</div>
</body>
</html>
