<?php
	include "fonction.php";
	session_start();
	if(isset($_POST["commentaire"])){
		ajouterCommentaire($_POST["commentaire"],$_POST["message"]);
	}
	header("location:".$_SERVER['HTTP_REFERER']);
?>