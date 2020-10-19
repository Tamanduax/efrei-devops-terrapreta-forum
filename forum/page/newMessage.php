<?php
session_start();
 include "../php/fonction.php";
?>
<head>
  <title>Nouveau topic</title>
  <link rel="stylesheet" href="../style/style.css"> 
</head>
<body/>
<?php
	estCo();
	siCo();
?>
	<div class='topics' style='position:relative;top:50px;'><form action='#' method='post' enctype='multipart/form-data'>
		<div style='width:90%;left:5%;position:relative;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color:rgba(230,230,230,1);padding:0px 0px 20px 0px;margin-bottom:100px;border-radius: 15px 15px 0px 0px;'><h1 style='border-radius: 15px 15px 0px 0px;background-color: rgba(167,216,149,1);'><input style='border:0px;font-size:20px;width:30%;position:relative;left:50%;transform:translate(-50%,0%)'type='text' name='titre' placeholder='Titre' required='required'/></h1>
		<input style='position:relative;left:90%;transform:translate(-110%,300%);'type='file' name='file'/>
		<textarea style='display:block;width:50%;height:120px;resize:none;position:relative;left:10%;overflow:auto' name='text'placeholder='text' required='required'></textarea><br/>
		<input class='Snewtopic'type='submit' value='confirmer'/>
	</form></div>
<?php
	if(isset($_POST['titre'])&& isset($_POST['text'])){
		$path=null;
		if($_FILES['file']['error'] == 0){
			$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
			$imageName=$_SESSION["utilisateur"].$_POST["titre"];
			$path = "../file/{$imageName}.{$extension_upload}";
			$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$path);
			if ($resultat){
					echo "fichier enregistré";
				} 
				else {
					echo "Error: " . $req . "<br>" . mysqli_error($co);
				}
		}
		if(newmessage($_POST['titre'],$_POST['text'],$path)==0){
			$idMessage=lastMessage();
			if($idMessage!=null){
				header("location:message.php?message=$idMessage");
			}
		}
		else{
			echo "<div><p>Problème à la création du poste.</p></div>";
		}
	}
?>
</div>
<img class='fond' src="../image/baniere.png">