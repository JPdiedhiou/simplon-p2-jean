<?php 
  
  /**
  * 
  */
  class Admin
  {
  	
  		public function Read($id)
    	{
            include ('..\config.php');
            $demande = $bdd->query("SELECT * FROM user WHERE role='admin'");
              while ($reponse = $demande->fetch())
               {
                 echo "<div class=\"user-info\">";
                    echo "<h3> Vos Informations </h3> ";
                    echo "<img src=\"..\admin251293/users/".$reponse['photo']."\" id=\"user-picture\">";
                    echo "<p> <span>Nom  :</span> ".ucfirst($reponse['nom'])."</p>";
                    echo "<p><span>Prenom :</span> ".ucfirst($reponse['prenom'])."</p>";
                    echo "<p><span>Login :</span> ".ucfirst($reponse['login'])."</p>";
                    echo "<a href=\"dashboard.php?update-user=".$reponse['role']." \"> Modifier mon compte </a><br>";
                    echo "<span id='description'>
                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              							 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              							 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              							 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              							 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              							 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              							 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              							 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              							 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              							 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              							 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              							 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </span>";
                 echo "</div>";
               }
              
    	}
      public function Update($id,$nom,$prenom,$login,$img,$pwd)
      {
         include ('..\config.php');
         try {
                    $update=$bdd->exec("UPDATE user SET nom=\"$nom\", prenom=\"$prenom\", login=\"$login\", photo=\"$img\", password=\"$pwd\" WHERE id=$id");
                    header('location:dashboard.php?admin-updated');

         } catch (Exception $e) {
           echo $e;
         }
         
      }

      public function GetAdmin($role)
      {
         include ('..\config.php');
            $demande = $bdd->query("SELECT * FROM user WHERE role='admin'");

             echo "<form action=\"updateAdmin.php\" method=\"POST\" enctype=\"multipart/form-data\" id=\"update-admin-form\">";
               echo"<h3>Modification des informatios </h3>";
              while ($reponse = $demande->fetch())
               {    
                echo"<p><input type=\"hidden\" name=\"id\" value=".$reponse['id']."   required></p>";
                echo"<p><input type=\"text\" name=\"nom\" value=".$reponse['nom']."   required></p>";
                echo"<p><input type=\"text\" name=\"prenom\" value=".$reponse['prenom']." required></p>";
                echo"<p><input type=\"text\" name=\"login\" value=".$reponse['login']." required></p>";
                echo"<p><input type=\"text\" name=\"passwd1\" value=".$reponse['password']." required></p>";
                echo"<p><input type=\"text\" name=\"passwd2\" value=".$reponse['password']." required></p>";
                echo"<p>Photo &nbsp; &nbsp;<input type=\"file\" name=\"photo\"></p>";
                echo"<p><input type=\"submit\" name=\"ok\" value=\"Inscription\"></p>";                               
               }
             echo "</form>";
      }
    public function ListUser()
     {
        include('..\config.php');
         $demande=$bdd->query("SELECT * FROM user "); //var_dump($demande);die();
         echo "<table id=\"article-table\">";
         echo "<th><input type='submit' value='Supprimer' name='delete'></th>";
         echo "<th>ID </th>";
         echo "<th>Nom Auteur </th>";
         echo "<th>Prenom Auteurth </th>";
         echo "<th>Login</th>";
         echo "<th>Photo</th>";

         echo "<form action=\"\" method=\"\">";
         $cpt =1;
        while( $reponse = $demande->fetch() )
        {
          if (($cpt % 2) == 0)
           {
            $class = 'couleurtr1';
          }else{
            $class = 'couleurtr2';
          }
           echo "<tr class=".$class.">";
            echo "<td><input type='checkbox' value=".$reponse['id']."></td>";
            echo "<td>".$reponse['id']."</td>";
            echo "<td>".$reponse['nom']."</td>";
            echo "<td>".$reponse['prenom']."</td>";
            echo "<td>".$reponse['login']."</td>";
            echo "<td><img src=users/".$reponse['photo']."></td>";
           echo "</tr>"; $cpt++;
        }
         echo "</form>";
        echo "</table>";
     }
  }

 ?>
 