<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
		
		xhroGalderaID = new XMLHttpRequest();
		xhroGalderaID.onreadystatechange = function () {
			if ((xhroGalderaID.readyState==4)&&(xhroGalderaID.status==200)) { 
				var erantzuna = xhroGalderaID.responseText;
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
  <div id='page-wrap'>
	<header class='main' id='h1'>
      
      <span class="right" style="display:none;"><a href="logOut.php">LogOut</a> </span>
	<h2>Quiz: Crazy Questions</h2>
	<div>
		<?php
			$postaElektronikoa=$_GET["ePosta"];
			echo "<br>";
			include 'configEzarri.php';
			// Konexioa sortu
			$connection = new mysqli($servername, $username, $password, $dbname);
			// Konexioa Egiaztatu (Ondo dagoen edo ez)
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
			$connection->close();
		?>
	</br>
	</div>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutR.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Quizzes</a></span>
		<span><a href='credits.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Credits</a></span>
		<span><a href='addQuestion.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Add Question</a></span>
		<span><a href='handlingQuizes.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Handling Quizes</a></span>
		<span><a href='showQuestionsWithImage.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Show Question With Image</a></span>
		<span><a href='showXMLQuestions.php?ePosta=<?php
							$postaElektronikoa=$_GET["ePosta"];
							echo $postaElektronikoa;
													?>'>Show Questions with XML</a></span>
		<span><a href='logOut.php' onclick="return myFunction()" >Log Out</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
		Quizzes and credits will be displayed in this spot in future laboratories ...
		
	</div> 
	<div>
			<label for="id">Galderaren IDa sartu:</label>
			<input type="text" name="idGald" id="idGald" class="erantzuna"/>
			<br/><br/>
			<label for="botoia">&nbsp</label>
			<input id="botoia" type="submit" value="Bilatu" name="botoia" onclick="bilatu();">
	</div>
	<div id="idrekikoGaldera">
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>

</body>
</html>

