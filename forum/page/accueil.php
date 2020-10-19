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
<body>
	<?php
		siCo();
	?>
<?php
	$message=messages();
	$i=0;
	echo"<div id='topics' class='topics'>";
	foreach($message as $value){
		echo"<div class='topic'><a class='topics'href='message.php?message=".$value[0]."'>
				<h1>".$value[4]."</h1>
				<div>
					<p class='testtopic' style='font-family:sans-serif;font-size:1.2em;color:rgba(0,50,0,0.8)'>".$value[2]."</p><br>
					<p style='font-family:sans-serif;color:rgba(0,50,0,0.8);text-indent:15px;font-size:1em;'><i style='margin-right:5px;' class='fas fa-reply'></i>".utilisateur($value[1])["pseudo_utilisateur"]."</p>
				</div>";
			echo"</a>
				<p class='infotopic'>
					<a href='../php/likeMessage.php?message=".$value[0]."'>
						<i style='margin-right:0px;'class='far fa-thumbs-up'></i>
					</a>".likeMessage($value[0])."
					<i style='margin-right:5px; margin-left:15px;'class='fas fa-comment-alt'></i>".count(commentaires($value[0]));
					if(isset($_SESSION["utilisateur"])){
						if($_SESSION["utilisateur"]==$value[1]){
							echo"<a class='deletebutton' href='../php/delete.php?topic=".$value[0]."'>delete</a>";
						}
					}
				echo"</p></div>
			<br/>";
	}
	echo"</div>";
?>
	<script type="text/javascript">
function getMousePosition(event)
{
	var e = event || window.event;
	var scroll = new Array((document.documentElement && document.documentElement.scrollLeft) || window.pageXOffset || self.pageXOffset || document.body.scrollLeft,(document.documentElement && document.documentElement.scrollTop) || window.pageYOffset || self.pageYOffset || document.body.scrollTop);;
	return new Array(e.clientX + scroll[0] - document.body.clientLeft,e.clientY + scroll[1] - document.body.clientTop);
}
</script>
<div id='img'class='background'><img id='imgabouger'src='../image/background2.jpg'/></div>
<div style='position:fixed;overflow: hidden;top:0px;z-index: 3;width:100%;height:100%'id='background'class='background'></div>
<script type="text/javascript">
var mouseInfo = document.getElementById('background');
var mouseInfo2=document.getElementById('topics');
mouseInfo2.onmousemove = function(event){
	var image = document.getElementById('imgabouger');
	var mousePosition = getMousePosition(event);
	var top=image.style.top;
	var left=image.style.left;
	var hauteurfenetre=mouseInfo.getBoundingClientRect().top + window.scrollY;
	var hauteur=mouseInfo.clientHeight ;
	var largeur=mouseInfo.clientWidth ;
	mousePosition[0]=(mousePosition[0]-largeur/2)/20;
	mousePosition[1]=((mousePosition[1]-hauteurfenetre)-hauteur/2)/10;
	image.style.left=mousePosition[0];
	image.style.top=mousePosition[1];
};
mouseInfo.onmousemove = function(event){
	var image = document.getElementById('imgabouger');
	var mousePosition = getMousePosition(event);
	var top=image.style.top;
	var left=image.style.left;
	var hauteurfenetre=mouseInfo.getBoundingClientRect().top + window.scrollY;
	var hauteur=mouseInfo.clientHeight ;
	var largeur=mouseInfo.clientWidth ;
	mousePosition[0]=(mousePosition[0]-largeur/2)/20;
	mousePosition[1]=((mousePosition[1]-hauteurfenetre)-hauteur/2)/10;
	image.style.left=mousePosition[0];
	image.style.top=mousePosition[1];
};
</script>
