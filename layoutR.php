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
	<script>
		function myFunction() {
		var r=confirm("Ziur al zaude zure kontutik atera nahi duzula?");
		if (r==false){
			return false;
		}
		else{
			return true;
		}
		
		}
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      
      <span class="right" style="display:none;"><a href="logOut.php">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutR.php'>Home</a></span>
		<span><a href='layoutR.php'>Quizzes</a></span>
		<span><a href='credits.html'>Credits</a></span>
		<span><a href='addQuestion.php?ePosta=<?php
$postaElektronikoa=$_GET["ePosta"];
echo $postaElektronikoa;
?>'>Add Question</a></span>
		<span><a href='showQuestionswithImage.php?ePosta=<?php
$postaElektronikoa=$_GET["ePosta"];
echo $postaElektronikoa;
?>'>Show Question With Image</a></span>
		<span><a href='logOut.php' onclick="return myFunction()" >Log Out</a></span>
	</nav>
    <section class="main" id="s1">
    
	
	
	<div>
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>

</body>
</html>
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
		$row = $result->fetch_assoc();
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['IrudiProfil'] ).'" width="200" height="150"/> ';
	} else {
		echo "<br>";
		echo "Posta: ". $postaElektronikoa;
		
	}
	$connection->close();

?>
