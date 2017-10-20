<?php 
//session_start();
include 'configEzarri.php';

// Konexioa sortu
$db = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
if(isset($_POST)){
	//if (!empty($_POST)){
	$postaElektronikoa = $_POST['posta'];
$erantzunZuzena = $_POST['erantzunZuzena'];
$galdera = $_POST['galderaTestua'];
$erantzunOkerra1 = $_POST['erantzunOkerra1'];
$erantzunOkerra2 = $_POST['erantzunOkerra2'];
$erantzunOkerra3 = $_POST['erantzunOkerra3'];
$galderaZail = $_POST['galderaZail'];
$galderaArloa = $_POST['galderaArloa'];
    $check = is_uploaded_file($_FILES["irudia"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['irudia']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
	}
	else{
		//$image=<img src=>;
		$imgContent=addslashes(file_get_contents('foto.bin'));

		
       // echo "Please select an image file to upload.";
    }
    
        
        $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
		$sql = "INSERT INTO questionswithimage (PostaElektronikoa, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa, Irudia) 
VALUES ('$postaElektronikoa', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$galderaZail', '$galderaArloa', '$imgContent')";
        $insert = $db->query($sql);
        if($insert){
            echo nl2br ("Galdera berria gordeta!\n");
	echo nl2br ("<a href = showQuestionswithImage.php >Ikusi dauden galdera guztiak.</a>\n");
	echo nl2br ("<a href = addQuestion.html >Txertatu beste galdera bat.</a>\n");
        }else{
            echo "Error: " . $sql . "<br>" . $db->error;
			echo "<a href = addQuestion.html >Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>";
			
        } 
    
}
else{
	echo "isset no funciona.";
}


/*$postaElektronikoa = $_POST['posta'];
$erantzunZuzena = $_POST['erantzunZuzena'];
$galdera = $_POST['galderaTestua'];
$erantzunOkerra1 = $_POST['erantzunOkerra1'];
$erantzunOkerra2 = $_POST['erantzunOkerra2'];
$erantzunOkerra3 = $_POST['erantzunOkerra3'];
$galderaZail = $_POST['galderaZail'];
$galderaArloa = $_POST['galderaArloa'];
$imgData =addslashes (file_get_contents($_FILES['irudia']));

$sql = "INSERT INTO questionswithimage (PostaElektronikoa, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa, Irudia) 
VALUES ('$postaElektronikoa', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$galderaZail', '$galderaArloa', '{$imgData}')";

if ($connection->query($sql) === TRUE) {
    echo nl2br ("Galdera berria gordeta!\n");
	echo nl2br ("<a href = showQuestions.php >Ikusi dauden galdera guztiak.</a>\n");
	echo nl2br ("<a href = addQuestion.html >Txertatu beste galdera bat.</a>\n");
	
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
	echo "<a href = addQuestion.html >Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>";
	
}

$connection->close();*/
/*https://www.codexworld.com/store-retrieve-image-from-database-mysql-php/*/
 
?> 
