<?php 
include('Admin.Class.php');
   if (isset($_POST['ok']))
    {
    	//var_dump($_POST);var_dump($_FILES);die();
      $nom    = $_POST['nom'];
  	  $prenom = $_POST['prenom'];
  	  $login  = $_POST['login'];
  	  $pwd1   = $_POST['passwd1'];
  	  $pwd2   = $_POST['passwd2'];
  	  $id   = $_POST['id'];
  	  $role   ="user";
  	  if ($pwd1 != $pwd2)
  	   {
  	  	header('location:dashboard.php?key=error-passwd');die();
  	   }
  	  if(isset($_FILES['photo']) && !empty($_FILES['photo'])) //le cas ou nous avons la photo de l'etudiant
        {
          $ext_file = explode(".",$_FILES['photo']['name']) ; //  on extrait l'extension de la photo         
          if((preg_match("#jpeg|png|gif|jpg#i",$ext_file[count($ext_file) - 1]))) //Si la photo est au format jpg,jpeg, png ou gif 
          {
            $nom_img= rand(500,1000)."drmhtc.".$ext_file[count($ext_file) - 1];
            move_uploaded_file($_FILES['photo']['tmp_name'], "../admin251293/users/".$nom_img); // on deplace la photo
            $img = $nom_img;
          }
         else
        $img='img.jpg';
        }

        $user = new Admin();
        $user->Update($id,$nom,$prenom,$login,$img,$pwd1); 	
    }
 ?>