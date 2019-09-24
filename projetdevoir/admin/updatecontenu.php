<?php 
include_once('contenu.class.php');
if(isset($_POST['ok'])){
	
	$id=$_POST['id'];
	$titre=$_POST['titre'];
	$corps=$_POST['corps'];
	$auteur=$_POST['auteur'];
    $up= new Contenu();
    $up->update($id, $titre; $corps, $auteur);
}
 ?>