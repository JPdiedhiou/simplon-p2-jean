<?php 
include('menu.Class.php');
if(isset($_POST['ok'])){
	
	$id=$_POST['id'];
	$libelle=$_POST['libelle'];
    $up= new Menu();
    $up->update($id, $libelle);
}
 ?>