<form action="formcreateuser.php" method="POST">
  <table>
    <tr><td>Nom:</td><td><input type="text" name="nom" required></td></tr>
     <tr><td>Prenom:</td><td><input type="text" name="prenom" required></td></tr>
      <tr><td>Login:</td><td><input type="text" name="login" required></td></tr>
       <tr><td>Password:</td><td><input type="text" name="password" required></td></tr>
       <tr><td>Role:</td><td><input type="text" name="role" required></td></tr>
    
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>

  <?php 
include_once('user.class.php');
if(isset($_POST['ok'])){
	
	
	$nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $login=$_POST['login'];
  $password=$_POST['password'];
  $role=$_POST['role'];
  
    $creat= new User();
    $creat->create($nom, $prenom, $login, $password, $role);
}
 ?>