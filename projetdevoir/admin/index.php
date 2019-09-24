<html>
<head>
	<title>Acceuil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style1.css">

</head>
<body>
<header>
	<?php 
	include("..\config.php");
	$requete=$bdd->query("SELECT * FROM menu ");
	
	echo"<ul>";

	while ($ligne=$requete->fetch()) {
          echo"<li><a href=index.php?cle=".$ligne['libelle']."> ".$ligne['libelle']."</a></li> ";
		
	}
	echo"<li><a href=index.php?cle=utilisateur>Utilisateur</a></li> ";
	echo"<li><a href=index.php?cle=Nouveau-contenu>Contenu</a></li> ";
	echo"</ul>";

	 ?>

</header>
<div class="contenu">
<?php 
include_once('contenumenu.php');
include_once('contenuuserclass.php');
include_once('contenucontenu.php');
include_once('contenu.class.php');


?>

</div>
</body>
</html>