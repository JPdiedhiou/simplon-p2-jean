<fieldset>
<legend>Pour nous contacter</legend>
  <form action="FormMessage.php" method="POST" id="update-article-form">
  	Titre du Message :
  	<p> <input type="text" name="titre" placeholder="Titre du message" required> </p>
  	Text de l'article :
  	<p> <textarea name="corps" placeholder="Votre message" required></textarea> </p>
  
  	<p><input type="submit" name="ok"></p>
  </form>
</fieldset>
<?php 
   
  
    if (isset($_POST['ok']))
     {
       session_start(); 
       include('Message.Class.php');
        
       $titre = $_POST['titre'];	
       $corps = $_POST['corps'];	
       $etat  = 1; 
       $nom   = $_SESSION['nom'];  
       $prenom = $_SESSION['prenom'];  

       $msg = new Message();
       $msg->Create($titre,$corps,$nom,$prenom,$etat);
     }


 ?>