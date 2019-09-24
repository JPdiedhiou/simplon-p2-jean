<?php 

   
   class Message
   {
   	
   	private $id;
   	private $titre;
   	private $corps;
   	private $nomauteur;
   	private $prenomauteur;
   	private $etat;

   	  public function Read($id)
       {
        include('..\config.php');
         $demande = $bdd->query("SELECT * FROM message WHERE id = $id ");
          if ($reponse = $demande->fetch())
           {
             echo "<h2 id='contact-h2'> Message </h2>";
             echo "<div id='message-reader'> <i class=\"icon-envelope-alt\"></i>";
             echo " Par :<span id='sender'>".$reponse['nomauteur']." ".$reponse['prenomauteur']."</span>";
                     echo "<div id='message-body'> <i>";
                        echo $reponse['corps'];
                     echo "</i></div id='message-body'>";
                     echo "<a href=dashboard.php?del-msg=".$reponse['id'].">Supprimer</a>";
             echo "</div>";
           }
        
       }
       public function Delete($id)
       {
        include('..\config.php');
        
       }

      public function Listing()
      {

        include('..\config.php');
        $demande=$bdd->query("SELECT * FROM message WHERE etat=1"); //var_dump($demande);die();
         echo "<table id=\"article-table\">";
         echo "<th><input type='submit' value='Supprimer' name='delete'></th>";
         echo "<th>Lire </th>";
         echo "<th>ID </th>";
         echo "<th>TITRE </th>";
         echo "<th>Nom Auteur </th>";
         echo "<th>Prenom Auteurth </th>";
         echo "<th>Etat</th>";

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
            echo "<td><a href=dashboard.php?read-msg=".$reponse['id'].">Lire</a></td>";
            echo "<td>".$reponse['id']."</td>";
            echo "<td>".$reponse['titre']."</td>";
            echo "<td>".$reponse['nomauteur']."</td>";
            echo "<td>".$reponse['prenomauteur']."</td>";
            echo "<td>".$reponse['etat']."</td>";
           echo "</tr>"; $cpt++;
        }
         echo "</form>";
        echo "</table>";
                
      }
      public function AllMessage()
      {
        include('..\config.php');
        $demande=$bdd->query("SELECT * FROM message"); //var_dump($demande);die();
         echo "<table id=\"article-table\">";
         echo "<th><input type='submit' value='Supprimer' name='delete'></th>";
         echo "<th>Lire </th>";
         echo "<th>ID </th>";
         echo "<th>TITRE </th>";
         echo "<th>Nom Auteur </th>";
         echo "<th>Prenom Auteurth </th>";
         echo "<th>Etat</th>";

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
            echo "<td><a href=dashboard.php?read-msg=".$reponse['id'].">Lire</a></td>";
            echo "<td>".$reponse['id']."</td>";
            echo "<td>".$reponse['titre']."</td>";
            echo "<td>".$reponse['nomauteur']."</td>";
            echo "<td>".$reponse['prenomauteur']."</td>";
            echo "<td>".$reponse['etat']."</td>";
           echo "</tr>"; $cpt++;
        }
         echo "</form>";
        echo "</table>";
      }
      public function Update($id)
      {  
        include('..\config.php');
        $up=$bdd->exec("UPDATE message SET etat=0 WHERE id=$id");

      }

   	 
   }

 ?>
 