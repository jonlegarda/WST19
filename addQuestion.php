<?php
$postaElektronikoa=$_GET["ePosta"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add question </title>

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
    function previewFile() {
        var preview = document.querySelector('img');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
		$("#irudiBistaratua").show();
    }
	function deleteIrudiBistaratua() {
		$("#irudiBistaratua").hide();
	}	
	
    $(document).ready(function(){

        $.postaZuzena = function(){
            var balioa= $("#posta").val();
            if (balioa.match((/^[a-zA-Z]{2,20}[0-9]{3}@ikasle\.ehu\.((eus)|(es))$/))){
                return true;
            } else {
                return false;
            }
        }
        $.denakBeteta = function(){
            if (($("#posta").val().length>0) &&($("#galderaTestua").val().length>0)&&($("#erantzunZuzena").val().length>0)&&($("#erantzunOkerra1").val().length>0)
                &&($("#erantzunOkerra2").val().length>0)&($("#erantzunOkerra3").val().length>0)&($("#galderaZail").val().length>0) &($("#galderaArloa").val().length>0)){
                return true;
            } else {
                return false;
            }
        }
        $('#galderenF').submit(function()  {
            if ($.denakBeteta()) {
                if ($.postaZuzena()) {
                    if ($("#galderaZail").val().match(/^[1-5]$/)){
                        if ($("#galderaTestua").val().length>=10){
                            return true;
                        } else {
                            window.alert("Galderak gutxienez 10 karakterekoa izan behar du.");
                            return false;
                        }
                    } else {
                        window.alert("Zailtasunak zenbaki osoa izan behar du eta 1-5 artekoa.");
                        return false;
                    }
                } else {
                    window.alert("Posta Elektonikoa okerra da.");
                    return false;
                }
            } else {
                window.alert("Datu guztiak bete behar dira.");
                return false;
            }
        })
    })
	</script>
<titulua>Galdera sortu:</titulua>
<p>(*) Karakterea duten hutsuneak derrigorrezkoak dira.</p>
<form  id="galderenF" name="galderenF"  action="addQuestionwithImage.php?ePosta=<?php $postaElektronikoa=$_GET["ePosta"];
echo $postaElektronikoa;?>" method="post"  enctype="multipart/form-data" target="_blank">
    <label for="posta">Posta elektronikoa(*): </label>
    <input type="text" name="posta" id="posta" class="erantzuna" value='<?php echo $postaElektronikoa;?>'/>
    <br/><br/>
    <label for="galderaTestua">Galderaren testua(*): </label>
    <input type="text" name="galderaTestua"  class="erantzuna" id="galderaTestua" height="2000px"/>
    <br/><br/>
    <label for="erantzunZuzena">Erantzun zuzena(*): </label>
    <input type="text" name="erantzunZuzena" class="erantzuna" id="erantzunZuzena" width="600px"/>
    <br/><br/>
    <label for="erantzunOkerra1">Erantzun okerra1(*): </label>
    <input type="text" name="erantzunOkerra1" class="erantzuna" id="erantzunOkerra1" width="600px"/>
    <br/><br/>
    <label for="erantzunOkerra2">Erantzun okerra2(*): </label>
    <input type="text" name="erantzunOkerra2" class="erantzuna" id="erantzunOkerra2" width="600px"/>
    <br/><br/>
    <label for="erantzunOkerra3">Erantzun okerra3(*): </label>
    <input type="text" name="erantzunOkerra3" class="erantzuna" id="erantzunOkerra3" width="600px"/>
    <br/><br/>
    <label for="galderaZail">Galderaren zailtasuna(1-5)(*): </label>
    <input type="text" name="galderaZail" id="galderaZail"/>
    <br/><br/>
    <label for="galderaArloa">Galderaren arloa(*): </label>
    <input type="text" name="galderaArloa" id="galderaArloa"/>
    <br/><br/>
    <label for="irudia">Irudia(hautazkoa): </label>
    <input type="file" name="irudia" id="irudia" onchange="previewFile()" >
    <br/><br/>
	<label for="botoia">&nbsp</label>
    <input id="botoia" type="submit" value="Bidali" name="botoia" > &nbsp
    <input type="reset" value="Borratu" id="reset" onclick="deleteIrudiBistaratua()"><br><br>
</form>
<img src="" id="irudiBistaratua" width="200" style="display: none;">
</body>
</html>
