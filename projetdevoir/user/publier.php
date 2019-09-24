
  <form action="publier.php" method="POST">
  	Titre de l'article :
  	<p> <input type="text" name="titre" placeholder="Titre court" required> </p>
  	Text de l'article :
  	<p> <textarea name="corps" required></textarea> </p>
  	<p><input type="submit" name="ok"></p>
  </form>

<?php 
   
  
    if (isset($_POST['ok']))
     {
       session_start(); 
       include('contenu.class.php');
         include('acceuil.php');
      
       $titre = $_POST['titre'];	
       $corps = $_POST['corps'];	
       $auteur = $_SESSION['auteur'];  
       $art = new Contenu();
       $art->Create($titre,$corps,$auteur);
     }


 ?>