<?php
	include "fonction.php";
	session_start();
	if(isset($_GET["commentaire"])){
		deleteCommentaire($_GET["commentaire"]);
	}
	header("location:".$_SERVER['HTTP_REFERER']);
?>