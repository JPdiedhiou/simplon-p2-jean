<?php 
include_once('user.class.php');
if(isset($_GET['cle']))
{
	switch ($_GET['cle']) {
		case 'utilisateur':
			$utilisateur = new User();
			$utilisateur->Listuser();
			break;
			case 'Nouveau-user':
			include('formcreateuser.php');
			break;

		
		default:
			# code...
			break;
	}
}
if(isset($_GET['update'])){
	$id=$_GET['update'];
	$user= new User();
	$user->get_user($id);
}
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$user= new User();
	$user->Deleteuser($id);
}
 ?>
