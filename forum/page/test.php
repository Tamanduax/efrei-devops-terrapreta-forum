<?php
	include "../connexion.php";
	$req=mysqli_query($co,"
	SELECT *
	FROM utilisateur
	WHERE id_utilisateur=1");
		while($donnee=(mysqli_fetch_assoc($req))){
			$pseudoAdmin=$donnee["pseudo_utilisateur"];
			$pwdAdmin=$donnee["pwd_utilisateur"];
			$mailAdmin=$donnee["mail_utilisateur"];
		}
	echo $pseudoAdmin." ".$pwdAdmin." ".$mailAdmin;
?>