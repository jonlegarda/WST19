<?php
	session_start();
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
		
		xhroGalderaID = new XMLHttpRequest();
		xhroGalderaID.onreadystatechange = function () {
			if ((xhroGalderaID.readyState==4)&&(xhroGalderaID.status==200)) { 
				var erantzuna = xhroGalderaID.responseText;
				console.log(111);
				document.getElementById("idrekikoGaldera").style.color = "blue";
				document.getElementById("idrekikoGaldera").align = "center";
				document.getElementById("idrekikoGaldera").innerHTML = xhroGalderaID.responseText;
			} 
		}
		function bilatu() {			
			var id = $("#idGald").val();
			xhroGalderaID.open("GET", "getQuestionWZ.php?id="+id, true);
			xhroGalderaID.send();
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
		  
		<span class="right" style="display:none;"><a href="logOut.php">LogOut</a> </span>
		
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
	
		
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
				echo '<div class="row">';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="handlingQuizes.php">Handling Quizes</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
				echo '</div>';
			}
		}
		else{
			echo '<div class="row" >';
			echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
			echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
			echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>';
			echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">Log In</a></div>';
			echo '<div class="col-sm-2 col-sm-push-1" ><a class="btn-block" href="signUp.php">SignUp</a></div>';
			echo '</div>';
		}
			?>
		</nav>
		<section class="main" id="s1">
		<h1>Home</h1>
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
			}
		?>
		<div>
			Welcome to Crazy Questions!<br/>
			Have fun and good luck!
		</div> 
		<div>
		<?php
			if(isset($_SESSION["kautotuta"])){
			echo '<div>';
					echo '<label for="id">Galderaren IDa sartu:</label>';
					echo '<input type="text" name="idGald" id="idGald" class="erantzuna"/>';
					echo '<br/><br/>';
					echo '<label for="botoia">&nbsp</label>';
					echo '<input id="botoia" type="submit" value="Bilatu" name="botoia" onclick="bilatu();">';
			echo '</div>';
			}
		?>
		</div>
		<div id="idrekikoGaldera">
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

