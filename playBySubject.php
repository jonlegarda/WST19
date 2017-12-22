<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Handling Quizes </title>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
	

	var xhro2 = new XMLHttpRequest();
	var xhro1 = new XMLHttpRequest();
	xhro2.onreadystatechange = function () {
		if ((xhro2.readyState==4)&&(xhro2.status==200 )) { 	
			document.getElementById("galderak").innerHTML = xhro2.responseText;
		}
	};
	xhro1.onreadystatechange = function () {
		if ((xhro1.readyState==4)&&(xhro1.status==200 )) { 	
			document.getElementById("erantzuna").innerHTML = xhro1.responseText;
		}
	};
	function egiaztatu(){
		/*
		($("input[type='radio'].radioBtnClass2:checked").val()!=undefined)&&
		($("input[type='radio'].radioBtnClass3:checked").val()!=undefined)*/
		if(($("input[type='radio'].radioBtnClass:checked").val()!=undefined) ){
			var radioValue =$("input[type='radio'].radioBtnClass:checked")[0].value;
            if ($("input[type='radio'].radioBtnClass2:checked").val() != undefined) {
                var radioValue2 = $("input[type='radio'].radioBtnClass2:checked")[0].value;
                if ($("input[type='radio'].radioBtnClass3:checked").val() != undefined) {
					var radioValue3 = $("input[type='radio'].radioBtnClass3:checked")[0].value;
					console.log(radioValue3);
					console.log(radioValue2);
                    xhro1.open("GET", "erantzunZuzenaGalderak.php?erantzuna1=" + radioValue+"&erantzuna2=" + radioValue2+ "&erantzuna3=" + radioValue3, true);
					xhro1.send();
                }
                else {
                    
                    xhro1.open("GET", "erantzunZuzenaGalderak.php?erantzuna1=" + radioValue+
                    "&erantzuna2=" + radioValue2, true);
                    xhro1.send();
                }
            }
            else {
                xhro1.open("GET", "erantzunZuzenaGalderak.php?erantzuna1=" + radioValue, true);
                xhro1.send();
            }
			document.getElementById("egiaztatu").disabled= true;
        }
		else{
			document.getElementById("erantzuna").innerHTML= "Egiaztatzeko galdera guztiak aukeratu behar dituzu! ";
		}
	}
	
	function galderakJaso() {
		var gaia= $("#gaia").val();
		if(gaia!=""){
		document.getElementById("erantzuna").innerHTML="";
		
		document.getElementById("egiaztatu").disabled= false;
		document.getElementById("ikusi").value= "Hurrengo Galderak";
		xhro2.open("GET", "showPlayBySubject.php?gaia="+gaia, true);
		xhro2.send();	
		}
		else{
			document.getElementById("erantzuna").innerHTML="Gai bat aukeratu behar duzu.";
		}
	}			
</script>
<body>
<div class="container-fluid">
	<div id='page-wrap'>
		<header class='main' id='h1'>
		<h1><a href="layoutR.php" class="btn-block">Quiz: Crazy Questions</a></h1>
	</header>
	<nav class='main' id='n1' role='navigation'>
	<?php
		if(isset($_SESSION["kautotuta"])){
			if ($_SESSION["kautotuta"] == "irakaslea"){
				echo'<div class="row">';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="layoutR.php">Home</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" style="border-right: 1px solid #ccc;"><a class="btn-block" href="quizzes.php">Quizzes</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;"><a class="btn-block" href="credits.php">Credits</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" style="border-right: 3px solid #C5DEC2;" ><a class="btn-block" href="reviewingQuizes.php">Review in Quizes</a></div>';
				echo '<div class="col-sm-2 col-sm-push-1" s ><a class="btn-block" href="logOut.php" onclick="return myFunction()" >Log Out</a></div>';
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
		<input type="button" id="ikusi" name="ikusi" value="Galderak Ikusi" onClick="galderakJaso()" style="width: 160px"/>
		<input type="button" id="egiaztatu" name="egiaztatu" value="Egiaztatu" onClick="egiaztatu()"  style="width: 160px" disabled/>
		</br>
		Gaia: <input type="text" name="gaia" id="gaia" />
		
		<div id="galderak" >
		</div>
		<div id="erantzuna" >
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