<?php 
include_once('contenu.class.php');
if(isset($_GET['cle']))
{
	switch ($_GET['cle']) {
		case 'cont':
			$cont = new Contenu();
			$cont->Listcontenu();
			break;
			case 'Nouveau-contenu':
			include_once('formcreatecontenu.php');
			break;

		
		default:
			# code...
			break;
	}
}
if(isset($_GET['update'])){
	$id=$_GET['update'];
	$cont= new Contenu();
	$cont->get_contenu($id);
}
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$cont= new Contenu();
	$cont->Deletecontenu($id);
}
 ?>
