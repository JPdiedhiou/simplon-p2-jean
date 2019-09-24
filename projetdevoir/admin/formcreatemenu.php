<form action="formcreatemenu.php" method="POST">
  <table>
    <tr><td>Titre:</td><td><input type="text" name="libelle" required></td></tr>
    
    <tr><td><input type="submit" value="envoyer" name="ok"></td><td><input type="reset" value="annuler"></td></tr>
  </table>
  </form>

  <?php 
include('menu.Class.php');
if(isset($_POST['ok'])){
	
	
	$libelle=$_POST['libelle'];
    $creat= new Menu();
    $creat->create($libelle);
}
 ?>