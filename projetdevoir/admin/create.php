<form action="create.php" method="POST">
  <table>
    <tr><td>Nom:</td><td><input type="text" name="nom" required></td></tr>
    <tr><td>Prenom:</td><td><input type="text" name="prenom" required></td></tr>
    <tr><td>Date de Naissance:</td><td><input type="date" name="datenaiss" required></td></tr>
    <tr><td>Adresse:</td><td><input type="text" name="adresse" required></td></tr>
    <tr><td>Email:</td><td><input type="text" name="email" required></td></tr>
    <tr><td>Login:</td><td><input type="text" name="login" required></td></tr>
    <tr><td>Mot De Passe:</td><td><input type="password" name="motdepasse" required></td></tr>
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>
  <?php

  if(isset($_POST['ok']))
  {
  	include('user.php');
  	$user= new User();
  }

  if(isset($_GET['update'])){
  $iduser=$_GET['update'];
  $user= new User();
  $user->get_user($iduser);
}

if(isset($_GET['cle']))
{

  switch ($_GET['cle']) {
    case 'utilisateur':
      $user = new User();
      $user->Listuser();
      break;
      case 'utilisateur':
      include('create.php');
      break;

    
    default:
      # code...
      break;
  }
}
if(isset($_GET['update'])){
  $iduser=$_GET['update'];
  $user= new User();
  $user->get_user($iduser);
}
if(isset($_GET['delete'])){
  $iduser=$_GET['delete'];
  $user= new User();
  $user->Deleteuser($iduser);
}
  ?>