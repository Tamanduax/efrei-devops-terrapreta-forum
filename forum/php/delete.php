<?php
	include "fonction.php";
	if(isset($_GET["topic"])){
		deleteTopic($_GET["topic"]);
		//header("location:".$_SERVER['HTTP_REFERER']);
	}
?>