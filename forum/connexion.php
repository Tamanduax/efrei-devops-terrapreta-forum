<?php
	include "../config.php";
	ob_start();
	$co = mysqli_connect($host , $user , $passwd, $bdd)  or die("erreur de connexion");
	mysqli_query($co,"SET NAMES UTF8");
?>