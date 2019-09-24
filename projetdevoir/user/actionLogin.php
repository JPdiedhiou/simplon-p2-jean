<?php 
 include("..\config.php");
 $compteur=0;
   if (isset($_POST['ok']))
              {

                $login = $_POST['login'];
                $password = $_POST['password'];
                $demande = $bdd->query(" SELECT * FROM user");
                  while ($reponse = $demande->fetch())
                   {
                      if ($reponse['login']=="$login" && $reponse['password']=="$password" && $reponse['login']=='user')
                       {
                         session_start();
                         $_SESSION['nom'] = $reponse['nom'];
                         $_SESSION['prenom'] = $reponse['prenom'];
                         $_SESSION['id']  =$reponse['id'];
                         $_SESSION['login']  =$reponse['login'];
                         
                           $compteur++;
                           var_dump($compteur);

                       }
                     }
                 if($compteur==0){
                  header("location:index.php");
                  echo"L'utilisateur n'existe pas";
                  
                 }
              
              
 }


 ?>


 