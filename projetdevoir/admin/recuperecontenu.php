<form action="recuperecontenu.php" method="POST">
  <table>
    <tr><td>Titre:</td><td><input type="text" name="titre" required></td></tr>
    <tr><td>Corps:</td><td><input type="text" name="corps" required></td></tr>
    <tr><td>Auteur:</td><td><input type="text" name="auteur" required></td></tr>
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>
  <?php

  if(isset($_POST['ok']))
  {
  	include('contenu.class.php');
  	$cont= new Contenu();
    $titre=$_POST['titre'];
    $corps=$_POST['corps'];
    $auteur=$_POST['auteur'];
  	$cont->create($titre, $corps, $auteur);
  	}

  
  ?>