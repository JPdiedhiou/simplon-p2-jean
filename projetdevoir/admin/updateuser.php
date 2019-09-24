<?php 
include('user.Class.php');
if(isset($_POST['ok'])){
	
	$id=$_POST['id'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$login=$_POST['login'];
	$password=$_POST['password'];
    $up= new User();
    $up->update($id, $nom, $prenom, $login, $password);
}
 ?>