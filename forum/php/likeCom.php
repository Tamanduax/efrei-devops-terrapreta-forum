<?php
	session_start();
	include "fonction.php";
	likeCommentaire($_GET["commentaire"],$_GET["like"]);
	header("location:".$_SERVER['HTTP_REFERER']);
?>