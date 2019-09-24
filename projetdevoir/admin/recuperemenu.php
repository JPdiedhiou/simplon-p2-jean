<form action="recupere.php" method="POST">
  <table>
    <tr><td>Libelle:</td><td><input type="text" name="libelle" required></td></tr>
    
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>
  <?php

  if(isset($_POST['ok']))
  {
  	include('menu.Class.php');
  	$menu= new Menu();
  	$libelle=$_POST['libelle'];
  	$menu->create($libelle);
  	}

  
  ?>