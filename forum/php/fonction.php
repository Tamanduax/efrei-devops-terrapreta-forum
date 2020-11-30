<?php
	function estCo(){
		if(!isset($_SESSION["utilisateur"])){
			header("location:accueil.php");
		}
	}
	function siCo(){
		echo"<div class='baniere'>";
		echo "<a href='accueil.php'><img class='logo' src='../image/logo fond.png'></a>
		<h1>Terrapreta</h1>
		<div class='menu'>";
		echo"<a href='../page/accueil.php'>Accueil</a>";
		if(isset($_SESSION["utilisateur"])){
			echo" <a href='../login/deco.php'>Déconnexion</a>";
			echo"<a href='../page/newMessage.php'>Nouveau topic</a>";
		}
		else{
			echo"<a href='../login/login.php'>Connexion</a>";
		}
		echo"</div></div>";
	}
	function newmessage($titre,$text,$file=null){
		$id=$_SESSION["utilisateur"];
		$i=null;
		include "../connexion.php";
		$req="INSERT INTO message (id_message,id_utilisateur,texte_message,img_message,titre_message)
			VALUE (null,$id,'$text','$file','$titre') ";
		if (mysqli_query($co, $req)) {
			return 0;
		}
		else {
			echo "Error: " . $req . "<br>" . mysqli_error($co);
			return 1;
		}
		mysqli_close($co);
	}
	function lastMessage(){
		$id=$_SESSION["utilisateur"];
		include "../connexion.php";
		$i=null;
		$req=mysqli_query($co,"
		SELECT *
		FROM message
		WHERE id_utilisateur=$id");
		$message=array();
		while($donnee=(mysqli_fetch_assoc($req))){
			$i=$donnee['id_message'];
		}
		return $i;
	}
	function messages(){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM message");
		$message=array();
		$i=0;
		while($donnee=(mysqli_fetch_assoc($req))){
			$message[$i][0]=$donnee["id_message"];
			$message[$i][1]=$donnee["id_utilisateur"];
			$message[$i][2]=$donnee["texte_message"];
			$message[$i][3]=$donnee["img_message"];
			$message[$i][4]=$donnee["titre_message"];
			$i++;
		}
		return $message;
	}
	function message($id){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM message
		WHERE id_message=$id");
		$message=array();
		while($donnee=(mysqli_fetch_assoc($req))){
			$message[0]=$donnee["id_message"];
			$message[1]=$donnee["id_utilisateur"];
			$message[2]=$donnee["texte_message"];
			$message[3]=$donnee["img_message"];
			$message[4]=$donnee["titre_message"];
		}
		return $message;
	}

	function infoLikeMessage($id){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM like_message
		WHERE id_message=$id");
		$res=array();
		$i=0;
		while($donnee=(mysqli_fetch_assoc($req))){
			$res[$i]["id_message"]=$donnee["id_message"];
			$res[$i]["id_utilisateur"]=$donnee["id_utilisateur"];
			$res[$i]["compteur_like"]=$donnee["compteur_like"];
			$i++;
		}
		return $res;
	}
	function likeMessage($id){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM like_message
		WHERE id_message=$id");
		$res=array();
		$i=0;
		while($donnee=(mysqli_fetch_assoc($req))){
			$i+=$donnee["compteur_like"];
		}
		return $i;
	}
	function commentaires($idMessage){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT * 
		FROM `commentaire` 
		WHERE `id_message`=$idMessage");
		$commentaire=array();
		$i=0;
		while($donnee=(mysqli_fetch_assoc($req))){
			$commentaire[$i][0]=$donnee["id_commentaire"];
			$commentaire[$i][1]=$donnee["id_utilisateur"];
			$commentaire[$i][2]=$donnee["texte_commentaire"];
			$commentaire[$i][3]=$donnee["id_message"];
			$i++;
		}
		if($i==0){
			$commentaire[$i][0]=0;
		}
			return $commentaire;
	}
	function ajouterCommentaire($texte,$message){
		$id=$_SESSION["utilisateur"];
		include "../connexion.php";
		$req="INSERT INTO commentaire (id_commentaire,id_utilisateur,texte_commentaire,id_message)
			VALUE (null,$id,'$texte',$message) ";
		if (mysqli_query($co, $req)) {
			echo "New record commentaire created successfully";
		}
		else {
			echo "Error: " . $req . "<br>" . mysqli_error($co);
	
		}
		mysqli_close($co);
	}
	function deleteCommentaire($commentaire){
		include "../connexion.php";
		$req="delete from commentaire WHERE id_commentaire=$commentaire";
		if (mysqli_query($co, $req)) {
			echo "New delete commentaire created successfully";
		}
		else {
			echo "Error: " . $req . "<br>" . mysqli_error($co);
	
		}
		mysqli_close($co);
	}
	
	function deleteTopic($topic){
		include "../connexion.php";
		$req="delete from message WHERE id_message=$topic";
		if (mysqli_query($co, $req)) {
			echo "New delete message created successfully";
		}
		else {
			echo "Error: " . $req . "<br>" . mysqli_error($co);
	
		}
		mysqli_close($co);
	}
	
	function likeCommentaire($commentaire,$like){
		$id=$_SESSION["utilisateur"];
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT * 
		FROM `like_commentaire` 
		WHERE `id_commentaire`=$commentaire
		AND id_utilisateur=$id");
		$likeCom=array();
		if(mysqli_num_rows($req)!=0){
			while($donnee=(mysqli_fetch_assoc($req))){
				$likeCom[0]=$donnee["id_utilisateur"];
				$likeCom[1]=$donnee["id_commentaire"];
				$likeCom[2]=$donnee["compteur_like"];
			}
			if($likeCom[2]==$like){
				$req="UPDATE like_commentaire SET compteur_like=0 WHERE id_utilisateur=$id AND id_commentaire=$commentaire";
			}
			else{
				$req="UPDATE like_commentaire SET compteur_like=$like WHERE id_utilisateur=$id AND id_commentaire=$commentaire";
			}
			if (mysqli_query($co, $req)) {
				echo "New update Texte created successfully";
				} 
				else {
					echo "Error: " . $req . "<br>" . mysqli_error($co);
				}
				mysqli_close($co);
		}
		else{
			$req="INSERT INTO like_commentaire (id_utilisateur,id_commentaire,compteur_like) VALUE ($id,$commentaire,$like) ";
			if (mysqli_query($co, $req)) {
				echo "New record commentaire created successfully";
			}
			else {
				echo "Error: " . $req . "<br>" . mysqli_error($co);
			}
			mysqli_close($co);
		}
	}

	function pushLikeMessage($idm){
		$id=$_SESSION["utilisateur"];
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT * 
		FROM `like_message` 
		WHERE `id_message`=$idm
		AND id_utilisateur=$id");
		$likeCom=array();
		if(mysqli_num_rows($req)!=0){
			while($donnee=(mysqli_fetch_assoc($req))){
				$likeCom[0]=$donnee["id_utilisateur"];
				$likeCom[1]=$donnee["id_message"];
				$likeCom[2]=$donnee["compteur_like"];
			}
			if($likeCom[2]==0){
				$req="UPDATE like_message SET compteur_like=1 WHERE id_utilisateur=$id AND id_message=$idm";
			}
			else{
				$req="UPDATE like_message SET compteur_like=0 WHERE id_utilisateur=$id AND id_message=$idm";
			}
			if (mysqli_query($co, $req)) {
				echo "New update like_message created successfully";
				} 
				else {
					echo "Error: " . $req . "<br>" . mysqli_error($co);
				}
				mysqli_close($co);
		}
		else{
			$req="INSERT INTO like_message (id_utilisateur,id_message,compteur_like) VALUE ($id,$idm,1) ";
			if (mysqli_query($co, $req)) {
				echo "New record commentaire created successfully";
			}
			else {
				echo "Error: " . $req . "<br>" . mysqli_error($co);
			}
			mysqli_close($co);
		}
	}
	function liked($commentaire){
		$id=$_SESSION["utilisateur"];
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT * 
		FROM `like_commentaire` 
		WHERE `id_commentaire`=$commentaire
		AND id_utilisateur=$id");
		$likeCom=array();
		if(mysqli_num_rows($req)!=0){
			while($donnee=(mysqli_fetch_assoc($req))){
				$likeCom[0]=$donnee["id_utilisateur"];
				$likeCom[1]=$donnee["id_commentaire"];
				$likeCom[2]=$donnee["compteur_like"];
			}
			return $likeCom[2];
		}
		else{
			return 0;
		}
	}
	function utilisateur($id){
		include "../connexion.php";
		$req=mysqli_query($co,"
		SELECT *
		FROM utilisateur
		WHERE id_utilisateur=$id");
		$message=array();
		while($donnee=(mysqli_fetch_assoc($req))){
			$message["id_utilisateur"]=$donnee["id_utilisateur"];
			$message["nom_utilisateur"]=$donnee["nom_utilisateur"];
			$message["prenom_utilisateur"]=$donnee["prenom_utilisateur"];
			$message["pseudo_utilisateur"]=$donnee["pseudo_utilisateur"];
			$message["pwd_utilisateur"]=$donnee["pwd_utilisateur"];
			$message["id_statut"]=$donnee["id_statut"];
			$message["mail_utilisateur"]=$donnee["mail_utilisateur"];
			$message["nb_like_utilisateur"]=$donnee["nb_like_utilisateur"];
		}
		return $message;
	}

	function chiffrement($var){
		$sel="salut a tous";
		$var=$sel.$var.$sel;
		$var=hash('sha512', $var);
		return $var;
	}

	function insertUtilisateur($nom,$pwd){
		include '../connexion.php';
		$req="INSERT INTO utilisateur(id_utilisateur, pseudo_utilisateur, pwd_utilisateur) VALUES (null,'$nom','$pwd')";
		if (mysqli_query($co, $req)) {
	    echo "utilisateur ajouté<br>";
		} 
		else {
	    echo "Error: " . $req . "<br>" . mysqli_error($co);
		}
		mysqli_close($co);
	}
?>