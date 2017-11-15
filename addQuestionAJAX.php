<?php 
//session_start();
include 'configEzarri.php';

// Konexioa sortu
	$db = new mysqli($servername, $username, $password, $dbname);
// Konexioa Egiaztatu (Ondo dagoen edo ez)
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
	if (isset($_POST)){
		


		$postaElektronikoa = $_POST['ePosta'];
		$galdera = $_POST['galderaTestua'];
		$erantzunZuzena = $_POST['erantzunZuzena'];	
		$erantzunOkerra1 = $_POST['erantzunOkerra1'];
		$erantzunOkerra2 = $_POST['erantzunOkerra2'];
		$erantzunOkerra3 = $_POST['erantzunOkerra3'];
		$galderaZail = $_POST['galderaZail'];
		$galderaArloa = $_POST['galderaArloa'];
		
			$imgContent=addslashes(file_get_contents('foto.bin'));
	
		
		$trimPostaElektronikoa = trim($postaElektronikoa);
		$trimGaldera = trim($galdera);
		$trimErantzunZuzena = trim($erantzunZuzena);
		$trimErantzunOkerra1 = trim($erantzunOkerra1);
		$trimErantzunOkerra2 = trim($erantzunOkerra2);
		$trimErantzunOkerra3 = trim($erantzunOkerra3);
		$trimGalderaZail = trim($galderaZail);
		$trimGalderaArloa = trim($galderaArloa);
		
		preg_match('/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/', $trimPostaElektronikoa, $matchesEmail);
		preg_match('/^.+$/', $trimGaldera, $matchesGaldera);
		preg_match('/^.+$/', $trimErantzunZuzena, $matchesErantzunZuzena);
		preg_match('/^.+$/', $trimErantzunOkerra1, $matchesErantzunOkerra1);
		preg_match('/^.+$/', $trimErantzunOkerra2, $matchesErantzunOkerra2);
		preg_match('/^.+$/', $trimErantzunOkerra3, $matchesErantzunOkerra3);
		preg_match('/^.+$/', $trimGalderaZail, $matchesGalderaZail);
		preg_match('/^.+$/', $trimGalderaArloa, $matchesGalderaArloa);
		
		if ($matchesEmail && $matchesGaldera && $matchesErantzunZuzena && $matchesErantzunOkerra1 &&
				$matchesErantzunOkerra2 && $matchesErantzunOkerra3 && $matchesGalderaZail && $matchesGalderaArloa && strlen($trimGaldera)>9) {
				

				
				//Insert image content into database
			$sql = "INSERT INTO questionswithimage (PostaElektronikoa, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa, Irudia) 
						VALUES ('$postaElektronikoa', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$galderaZail', '$galderaArloa', '$imgContent')";
			$insert = $db->query($sql);
		
			$xml = simplexml_load_file('questions.xml');
			
			if ($insert) {
				
				$assesmentItemXML = $xml->addChild('assessmentItem');
				
				$assesmentItemXML->addAttribute('complexity', $galderaZail);
				$assesmentItemXML->addAttribute('subject', $galderaArloa);
				
				$itemBodyXML = $assesmentItemXML->addChild('itemBody');
				$itemBody_p_XML = $itemBodyXML->addChild('p', $galdera);
				
				$correctResponseXML = $assesmentItemXML->addChild('correctResponse', $erantzunZuzena);
				
				$incorrectResponsesXML = $assesmentItemXML->addChild('incorrectResponses');
				
				$incorrectResponses_values_XML = $incorrectResponsesXML->addChild('value', $erantzunOkerra1);
				$incorrectResponses_values_XML = $incorrectResponsesXML->addChild('value', $erantzunOkerra2);
				$incorrectResponses_values_XML = $incorrectResponsesXML->addChild('value', $erantzunOkerra3);
			
				$xml->asXML('questions.xml');
				
				echo "OK. Txertaketa DBan eta XMLan ondo burutu dira.";
				/*echo nl2br ("Galdera berria gordeta!\n");
				echo nl2br ("<a href = showQuestionsWithImage.php?ePosta=$postaElektronikoa >Ikusi dauden galdera guztiak.</a>\n");
				echo nl2br ("\n\n");
				echo nl2br ("<a href = showXMLQuestions.php?ePosta=$postaElektronikoa > Ikusi dauden galdera guztiak XML fitxategian. </a>\n");
				echo nl2br ("\n\n");
				echo nl2br ("<a href = showQuestionsAJAX.php?ePosta=$postaElektronikoa > Ikusi dauden galdera guztiak AJAX bidez. </a>\n");
				echo nl2br ("\n\n");
				echo nl2br ("<a href = handlingQuizes.php?ePosta=$postaElektronikoa >Txertatu beste galdera bat.</a>\n");
				echo nl2br ("<a href = layoutR.php?ePosta=$postaElektronikoa >Menu nagusira joan.</a>\n");*/
				
			} else {
				echo "ERROREA. Txertaketa gaizki burutu da.";
				/*echo "Error: " . $sql . "<br>" . $db->error;
				echo nl2br ("\n");
				echo ("Errorea: galderak.xml-en ezin izan da galdera txertatu.\n");
				echo ("<a href = handlingQuizes.php?ePosta=$postaElektronikoa >Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>");*/
			} 
		} else {
			/*echo nl2br ("Errorea! Sartutako zelai guztiak ez dira egoki bete.\n");
			echo nl2br ("Zerbitzaria konturatu da akats horretaz. Kontuz, aldatu beharko duzu!\n");
			echo nl2br ("<a href = handlingQuizes.php?ePosta=$postaElektronikoa >Saiatu berriro galdera ezartzen.</a>\n");*/
		}
	} else {
		echo "isset no funciona.";
	}


?>