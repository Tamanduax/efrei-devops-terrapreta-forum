 <!DOCTYPE html>
<html>

<head>
  <title>login page</title>
  <link rel="stylesheet" href="../style/style.css"> 
</head>
<body/>
<?php
include "../php/fonction.php";
siCo();
session_start();
	if(isset($_POST["login"])&&isset($_POST["password"])){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM utilisateur");
		$find=false;
		while($donnee=(mysqli_fetch_assoc($req))){
			if($donnee["pseudo_utilisateur"]==$_POST["login"]&&$donnee["pwd_utilisateur"]==chiffrement($_POST["password"])){
				$_SESSION["utilisateur"]=$donnee["id_utilisateur"];
				$find=true;
			}
		}
	}
	if(isset($_SESSION["utilisateur"])){
		header("location:../page/accueil.php");
	}
	
?>
<form class='Fconnexion'action="#" method="post">
	<p>Connexion</p>
	<input class='Iconnexion' type="text" required="required" name="login" placeholder="login"/>
	<input class='Iconnexion' type="password" required="required" name="password" placeholder="password"/>
	<input class='Sconnexion'type="submit"/>
	<a href='signin.php' style='position:absolute;left:15%;top:250px;'>Créer un compte</a>
</form>
<?php
	if(isset($find)){
		if($find==false){
			echo"<p class='error'> login ou mot de passe incorrect.</p>";
		}
	}
	
?>
<img class='fond' src="../image/baniere.png">
</body>
</html> 