<?php 

if (isset($_POST['posta'])) {
	
	include 'configEzarri.php';
	
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	$postaElektronikoa = $_POST['posta'];
	$pasahitza = $_POST['pasahitza'];
	
	$enkriptatuPasahitza = crypt($pasahitza, "wsLizasoLegardaEnkriptazioPasahitza");
	$trimPasahitza= trim($pasahitza);
	$trimPostaElektronikoa= trim($postaElektronikoa);
	
	if(strlen($trimPostaElektronikoa)<1 || strlen($trimPasahitza)<6){
		echo "<script> alert('zelai guztiak bete behar dira, pasahitzak gutxienez 6 karaktere izan behar ditu.') </script>";
	}
	else if(!preg_match("/^(.){1,}@ehu\.es/", trim($postaElektronikoa)) && !preg_match("/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/", trim($postaElektronikoa))){
		echo "<script> alert('korreoaren formatua ez da egokia.') </script>";
	}else{
		$sql = "SELECT * FROM users WHERE PostaElektronikoa='$postaElektronikoa' AND Pasahitza='$enkriptatuPasahitza'";
		$result = $connection->	query($sql);
		if (!($result)) {
			echo "Error in the query". $result->error; 
		} else {
			session_start();
			$rows_cnt = $result->num_rows;
			$connection->close();
			if ($rows_cnt==1) {
				if(isset($_SESSION["$postaElektronikoa"])){
					if($_SESSION["$postaElektronikoa"]>2){
						echo "<script> alert('Jada saiakera gehiegi egin dituzu.') </script>";
				}
					else {
						$rows_cnt=0;
				
						if (preg_match("/^(.){1,}@ehu\.es/", trim($postaElektronikoa))) {
							$irakaslea = true;
							
						} else {
							$irakaslea = false;	
						}
						if ($irakaslea) {
							$_SESSION["kautotuta"] = "irakaslea";
							$_SESSION["korreoa"]= trim($postaElektronikoa);
							header ('Location: layoutR.php');
						} else {
							$_SESSION["kautotuta"] = "ikaslea";
							$_SESSION["korreoa"]= $postaElektronikoa;
							header ('Location: layoutR.php');
						}
					}
				}
				else{
					$_SESSION["$postaElektronikoa"]=0;
					$rows_cnt=0;
				
						if (preg_match("/^(.){1,}@ehu\.es/", trim($postaElektronikoa))) {
							$irakaslea = true;
							
						} else {
							$irakaslea = false;
							
						}
						if ($irakaslea) {
							$_SESSION["kautotuta"] = "irakaslea";
							$_SESSION["korreoa"]= trim($postaElektronikoa);
							header ('Location: layoutR.php');
						} else {
							$_SESSION["kautotuta"] = "ikaslea";
							$_SESSION["korreoa"]= $postaElektronikoa;
							header ('Location: layoutR.php');
						}
			}
			} else {
				if (isset($_SESSION["$postaElektronikoa"])){
					if ($_SESSION["$postaElektronikoa"]>2){
						echo "<script> alert('Jada saiakera gehiegi egin dituzu.') </script>";
				} else {
						$_SESSION["$postaElektronikoa"]= $_SESSION["$postaElektronikoa"] +1;
						echo "<script> alert('Pasahitza ez da zuzena. Proba ezazu berriro.') </script>";					
					}
				} else {
					$_SESSION["$postaElektronikoa"]=1;
					echo "<script> alert('Pasahitza ez da zuzena. Proba ezazu berriro.') </script>";
				}	
			}
	 }
	}
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log In</title>
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

        $.postaZuzena = function(){
            var balioa= $("#posta").val();
            if (balioa.match((/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/)) || balioa.match(/^(.){1,}@ehu\.es$/)){
                return true;
            } else {
                return false;
            }
        }
		
        $.biakBeteta = function(){		
			if ($("#posta").val().length>0 && $.postaZuzena()){
				if ($("#pasahitza").val().length>5){
					return true;
				} else {
					window.alert("Pasahitza ez da egokia.");
					return false;
				}
            } else {
				window.alert("Posta ez da egokia.");
                return false;
            }
        }

        $("#logIn").submit(function()  {
            if ($.biakBeteta()) {
			} else {
			}
        })
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
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="quizzes.php">Quizzes</a></div>
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="credits.php">Credits</a></div>
		<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="logIn.php">Log In</a></div>
		<div class="col-sm-2 col-sm-push-1"><a class="btn-block" href="signUp.php"  >Sign Up</a></div>
	</div>
	</nav>
	<section class="main" id="s1">
	<h1>Log In</h1>
	<br/>
	<p>(*) Bi hutsuneak betetzea beharrezkoa da..</p>
	<form  id="logIn" name="logIn"  action="logIn.php" method="post"  enctype="multipart/form-data"  >
		<label for="posta">Posta elektronikoa (*): </label>
		<input type="text" name="posta" id="posta" class="erantzuna"/>
		<br/><br/>
		<label for="deitura">Pasahitza (*): </label>
		<input type="password" name="pasahitza"  class="erantzuna" id="pasahitza" height="2000px"/>
		<br/><br/>
		<input id="botoia" type="submit" value="Log In" name="botoia" width="350px" > &nbsp
	</form>
	<br/><br/>
	<a href="forgetPassword_galdera.php">Pasahitza ahaztu duzu?</a>
	<br/><br/>
	<a href='signUp.php'>Ez daukazu konturik? Klikatu hemen.</a>
	</section>
	<footer class='main' id='f1'>
				<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
				<a href='https://github.com/jonlegarda/WST19'>Link GITHUB</a>
			</footer>
</div>
</div>

</body>
</html>

