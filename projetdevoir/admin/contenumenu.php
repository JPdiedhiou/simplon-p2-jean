<?php 
include('menu.class.php');
if(isset($_GET['cle']))
{
	switch ($_GET['cle']) {
		case 'Menu':
			$menu = new Menu();
			$menu->Listmenu();
			break;
			case 'Nouveau-Menu':
			include('formcreatemenu.php');
			break;
			case 'Deconnexion':
			session_destroy();
			header("location:login.php");
			break;
		
		default:
			# code...
			break;
	}
}
if(isset($_GET['update'])){
	$id=$_GET['update'];
	$menu= new Menu();
	$menu->get_menu($id);
}
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$menu= new Menu();
	$menu->Deletemenu($id);
}
 ?>
