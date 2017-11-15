<?php 

if (isset($_POST['posta'])) {
	
	include 'configEzarri.php';

	// Konexioa sortu
	$connection = new mysqli($servername, $username, $password, $dbname);
	// Konexioa Egiaztatu (Ondo dagoen edo ez)
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	$postaElektronikoa = $_POST['posta'];
	$pasahitza = $_POST['pasahitza'];
	
	$sql = "SELECT * FROM users WHERE PostaElektronikoa='$postaElektronikoa' AND Pasahitza='$pasahitza'";
	$result = $connection->	query($sql);
	if (! ($result)) {
		echo "Error in the query". $result->error; 
	} else {
		$rows_cnt = $result->num_rows;
		$connection->close();
		if ($rows_cnt==1) {$rows_cnt=0;
			header ('Location: layoutR.php?ePosta='.$postaElektronikoa.'');
		} else 	{
			echo "<script> alert('Pasahitza ez da zuzena. Proba ezazu berriro.') </script>";
		}
	}
	
 }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log In</title>

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

        $.postaZuzena = function(){
            var balioa= $("#posta").val();
            if (balioa.match((/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/))){
                return true;
            } else {
                return false;
            }
        }
		
        $.biakBeteta = function(){		
			if ($("#posta").val().length>0 && $.postaZuzena()){
				if ($("#pasahitza").val().length>6){
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

<titulua>Log In</titulua>
<p>(*) Bi hutsuneak betetzea beharrezkoa da..</p>
<form  id="logIn" name="logIn"  action="logIn.php" method="post"  enctype="multipart/form-data"  >
    <label for="posta">Posta elektronikoa (*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna"/>
    <br/><br/>
    <label for="deitura">Pasahitza (*): </label>
    <input type="password" name="pasahitza"  class="erantzuna" id="deitura" height="2000px"/>
    <br/><br/>
	<input id="botoia" type="submit" value="Log In" name="botoia" width="350px" > &nbsp
</form>
<br/><br/>
<a href='signUp.php'>Ez daukazu konturik? Klikatu hemen.</a>
</body>
</body>
</html>

