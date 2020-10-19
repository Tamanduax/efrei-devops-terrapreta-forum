<?php
	session_start();
	unset($_SESSION["utilisateur"]);
	header("location:".$_SERVER['HTTP_REFERER']);
?>