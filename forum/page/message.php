<?php
	session_start();
	include "../php/fonction.php";
?>
<head>
  <title>Accueil</title>
  <link rel="shortcut icon" href="../image/logo fond.png">
  <link rel="stylesheet" href="../style/style.css"> 
  <script src="https://kit.fontawesome.com/ef04878243.js" crossorigin="anonymous"></script>
</head>
<?php
	siCo();
	if(isset($_GET["message"])){
		$message=message($_GET["message"]);
		$utilisateur=utilisateur($message[1]);
		$commentaire=commentaires($_GET["message"]);
		if(isset($commentaire[0][1])){
			$nb=count(commentaires($message[0]));
		}
		else{
			$nb=0;
		}
		echo"<div class='topics'>";
			echo"<div style='width:90%;left:5%;position:relative;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color:rgba(230,230,230,0.8);padding:0px 0px 20px 0px;margin-bottom:100px;border-radius: 15px 15px 0px 0px;'><h1 style='border-radius: 15px 15px 0px 0px;'>".$message[4]."</h1>
				<div>
					<p class='testtopic'style='font-family:sans-serif;font-size:1.2em;color:rgba(0,50,0,0.8)'><i style='margin-right:5px;' class='fas fa-reply'></i> ".$utilisateur["pseudo_utilisateur"]."</p>
					<img src='".$message[3]."'/>
					<p class='testtopic' >".$message[2]."</p>
				</div>
			<br/>";
			echo"<p class='infotopic' style='left:80%'>
					<a href='../php/likeMessage.php?message=".$message[0]."'>
						<i style='margin-right:0px;'class='far fa-thumbs-up'></i>
					</a>".likeMessage($message[0])."
					<i style='margin-right:5px; margin-left:15px;'class='fas fa-comment-alt'></i>".$nb;
					if(isset($_SESSION["utilisateur"])){
						if($_SESSION["utilisateur"]==$message[1]){
							echo"<a class='deletebutton' href='../php/delete.php?topic=".$message[0]."'>delete</a>";
						}
					}
				echo"</p></div>";
		if(isset($commentaire[0][1])){
			foreach($commentaire as $value){
				$utilisateur=utilisateur($value[1]);
			echo"<div class='topic commentdiv'><p class='comment'><b><i style='margin-right:5px;' class='fas fa-reply'></i>".$utilisateur["pseudo_utilisateur"].":</b><br/><i>".$value[2]."</i></p>";
			if(isset($_SESSION["utilisateur"])){
				$like=liked($value[0]);
				if($like==1){
					$tlike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(50,150,50);'class='far fa-thumbs-up'></i>";
					$tdislike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(50,80,50);'class='far fa-thumbs-down'></i>";
				}
				else if($like==0){
					$tlike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(50,80,50);'class='far fa-thumbs-up'></i>";
					$tdislike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(50,80,50);'class='far fa-thumbs-down'></i>";
				}
				else{
					$tlike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(50,80,50);'class='far fa-thumbs-up'></i>";
					$tdislike="<i style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:3px;margin-right:0px;color:rgb(200,50,50);'class='far fa-thumbs-down'></i>";
				}
				echo"<a href='../php/likeCom.php?commentaire=".$value[0]."&like=1'>$tlike</a> ";
				echo"<a href='../php/likeCom.php?commentaire=".$value[0]."&like=-1'>$tdislike</a>";
				if($_SESSION["utilisateur"]==$value[1]){
					echo"<a style='text-decoration:none;color:rgba(0,50,0,0.8);' class='deletebutton' href='../php/deleteCommentaire.php?commentaire=".$value[0]."'>Delete</a>";
				}
			}
			echo"</div>";
		}
		}
		if(isset($_SESSION["utilisateur"])){
		echo "<form method='post' action='../php/ajouterCommentaire.php'>
			<input type='hidden' name='message' value='".$_GET["message"]."'/>
			<textarea class='textareacomment' required name='commentaire' placeholder='message' required='required'></textarea>
			<input class='textareacomment' type='submit'/>
			</form>";
		}
	}
	else{
		echo"<p class='error'>pas de message</p>";
	}
?>
</div>
<img class='fond' src="../image/baniere.png">