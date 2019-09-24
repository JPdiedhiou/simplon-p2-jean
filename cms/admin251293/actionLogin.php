<?php 
 include("..\config.php");
   if (isset($_POST['ok']))
              {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $demande = $bdd->query(" SELECT * FROM user");
                  while ($reponse = $demande->fetch())
                   {
                      if ($reponse['login']==$login && $reponse['password']==$password && $reponse['login']=='admin')
                       {
                         session_start();
                         $_SESSION['nom'] = $reponse['nom'];
                         $_SESSION['prenom'] = $reponse['prenom'];
                         $_SESSION['id']  =$reponse['id'];
                         $_SESSION['login']  =$reponse['login'];
                         header("location:dashboard.php");                          
                       }
                   }
              }

 ?>