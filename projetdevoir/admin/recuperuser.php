<form action="recuperuser.php" method="POST">
  <table>
    <tr><td>Nom:</td><td><input type="text" name="nom" required></td></tr>
    <tr><td>Prenom:</td><td><input type="text" name="prenom" required></td></tr>
    <tr><td>Login:</td><td><input type="text" name="login" required></td></tr>
    <tr><td>Password:</td><td><input type="password" name="password" required></td></tr>
    
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>
  <?php

  if(isset($_POST['ok']))
  {
  	include('user.class.php');
  	$user= new User();
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $login=$_POST['login'];
  	$password=$_POST['password'];
  	$user->create($nom, $prenom, $login, $password);
  	}

  
  ?>