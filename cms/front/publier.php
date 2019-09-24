<fieldset>
<legend>Rediger un nouveau article</legend>
  <form action="publier.php" method="POST" enctype="multipart/form-data" id="update-article-form">
  	Titre de l'article :
  	<p> <input type="text" name="titre" placeholder="Titre court" required> </p>
  	Text de l'article :
  	<p> <textarea name="corps" required></textarea> </p>
  
    <p> <input type="file" name="photo"> </p>
  	<p><input type="submit" name="ok"></p>
  </form>
</fieldset>
<?php 
   
  
    if (isset($_POST['ok']))
     {
       session_start(); 
       include('Article.Class.php');
        
       $titre = $_POST['titre'];	
       $corps = $_POST['corps'];	
       $auteur = $_SESSION['id'];  
       $nom = $_SESSION['nom'];  
       $prenom = $_SESSION['prenom'];  

       //var_dump($_FILES['photo']);die();
       if(isset($_FILES['photo']) && !empty($_FILES['photo'])) //le cas ou nous avons la photo de l'etudiant
        {
           $ext_file = explode(".",$_FILES['photo']['name']) ; //  on extrait l'extension de la photo 
          
          if((preg_match("#jpeg|png|gif|jpg#i",$ext_file[count($ext_file) - 1]))) //Si la photo est au format jpg,jpeg, png ou gif 
          {
            $nom_img= rand(10,500).".".$ext_file[count($ext_file) - 1];
            move_uploaded_file($_FILES['photo']['tmp_name'], "../admin251293/images/".$nom_img); // on deplace la photo
            $img = $nom_img;
          }
         else
        $img='avatar.png';
        }
        
       $art = new Article();
       $art->Create($titre,$corps,$img,$nom,$prenom,$auteur);
     }


 ?>