<?php
	include "../php/fonction.php";
	if(isset($_POST['compte']) && isset($_POST['passwd'])){
		insertUtilisateur($_POST['compte'],chiffrement($_POST['passwd']));
		header("location:login.php");
	}
?>