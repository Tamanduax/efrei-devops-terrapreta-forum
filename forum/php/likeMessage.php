<?php
	session_start();
	include "fonction.php";
	pushLikeMessage($_GET["message"]);
	header("location:".$_SERVER['HTTP_REFERER']);
?>