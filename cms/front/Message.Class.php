<?php 

   
   class Message
   {
   	
   	private $id;
   	private $titre;
   	private $corps;
   	private $nomauteur;
   	private $prenomauteur;
   	private $etat;

   	  public function Create($titre,$corps,$nomauteur,$prenomauteur,$etat)
   	   {
           include ('..\config.php');
           $insert = $bdd->prepare("INSERT INTO message(titre,corps,nomauteur,prenomauteur,etat)VALUES(?,?,?,?,?)");
           if ($insert->execute(array($titre,$corps,$nomauteur,$prenomauteur,$etat)))
            {
           	  header("location:dashboard.php?key=message-sent");
            }          
   	   }

   	 
   }

 ?>