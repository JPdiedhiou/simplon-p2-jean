<!DOCTYPE html>
<html>
<head>
	<title>Content Managment System</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<meta charset="utf-8">
	<script type="text/javascript" href="js/jquery-1.12.1.min.js"></script>
</head>
<body>
 <div class="bkgr"></div>

<div class="Mymodal">
     <div class="trait-2">
      Information de votre base de donnée
    </div>
     <fieldset>
     <legend>Entrez les informations ci-dessous</legend>
     	<form action="init.php" method="POST" id="initform">
     		Nom d'hote<p>
     		<input type="text" name="host" value="localhost" placeholder="le nom d'hote" required></p>
     		Nom d'utilisateur
     		<p><input type="text" name="user" placeholder=" nom d'utilisateur" required></p>
     		Mot de passe
     		<p><input type="password" name="password" placeholder="Mot de passe" ></p>
     		Nom de la base de donnée
     		<p><input type="text" name="base" placeholder="nom de la base de donnee" required></p>
     		<p><input type="submit" value="valider" name="ok"></p>
     	</form>
     </fieldset>
     
</div>

 
</body>
</html>