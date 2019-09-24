<?php include("User.Class.php");  ?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="..\css/font-awesome.css">
<div class="bkgr"></div>
<div class="Mymodal">
   <div class="trait-2">
       Inscription
    </div> <br>
 <fieldset>
<form action="subscription.php" method="POST" enctype="multipart/form-data" id="initform">
   <p><input type="text" name="nom"    placeholder="Votre nom" required></p>
   <p><input type="text" name="prenom" placeholder="Votre prenom" required></p>
   <p><input type="text" name="login"  placeholder="Nom d'utilisateur" required></p>
   <p><input type="password" name="passwd1" placeholder="Votre mot de passe" required></p>
   <p><input type="password" name="passwd2" placeholder="Confirmez otre mot de passe" required></p>
   <p>Photo &nbsp; &nbsp;<input type="file" name="photo"></p>
   <p><input type="submit" name="ok" value="Inscription"></p>
	
</form>
<?php 
  if (isset($_POST['ok']))
    {
  	  $nom    = $_POST['nom'];
  	  $prenom = $_POST['prenom'];
  	  $login  = $_POST['login'];
  	  $pwd1   = $_POST['passwd1'];
  	  $pwd2   = $_POST['passwd2'];
  	  $role   ="user";
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

        $user = new User();
        $user->Create($nom,$prenom,$login,$img,$pwd1,$role);
  	  
    }
 ?>
</div>

