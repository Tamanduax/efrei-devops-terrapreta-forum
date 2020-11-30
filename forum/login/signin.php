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
?>
<form action='creationcompte.php' method='post'>
	<input type='text' name='compte' placeholder='nom de compte...'>
	<input type='password' name='passwd' placeholder='mot de passe'>
	<input type='submit' value='Confirmer'>
</form>