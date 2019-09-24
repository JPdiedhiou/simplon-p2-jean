<?php 
  
  class Article
  {
  	/** creqtion d'un article**/
  	public function Create($titre,$corps,$img,$nom,$prenom,$auteur)
  	{
      include('..\config.php');
      $demande = $bdd->prepare("INSERT INTO article(titre,corps,img,nomauteur,prenomauteur,auteur) VALUES(?,?,?,?,?,?)");
      try {
      	    $demande->execute(array($titre,$corps,$img,$nom,$prenom,$auteur));
      	    header("location:dashboard.php?key=Post-ok");
          } 
         catch (Exception $e) {echo $e;}
      
  	}


     /** Lecture d'un article **/
    public function read($id)
    {
      include('..\config.php');
        $demande=$bdd->query("SELECT * FROM article WHERE  id=$id "); //var_dump($demande);die();
        if( $reponse = $demande->fetch() )
        {
            echo "<div class=\"reader\">";
              echo "<span id='title'>".$reponse['titre']."</span>";
              echo "<article>";
               echo "<img src=../admin251293/images/".$reponse['img'].">";
                     echo $reponse['corps'];
              echo "</article>";
             
              echo "<a href=dashboard.php?update=$id>Modifier</a> &nbsp;&nbsp;&nbsp;";
              echo "<a href=dashboard.php?delete=$id>Supprimer</a>";
            echo "</div>";
        }
    }


     /** Mise a jour d'un article **/
  	public function Update($id,$titre,$corps)
  	{
      include('..\config.php');
        try 
        { 
          $bdd->exec("UPDATE article SET titre=".$titre.",corps=".$corps.", WHERE id = $id");
          header("location:dashboard.php?key=Update-success");
        }
        catch (Exception $e) 
        {
          echo $e;  
        }
       

  	}

    /** recuperation d'un article pour mise a jour **/
  	public function GetArticle($id)
  	{
  		include('..\config.php');
        $demande=$bdd->query("SELECT * FROM article WHERE id='$id' ");
    		while( $reponse = $demande->fetch() )
    		{
            echo "<fieldset>";
            echo "<legend>Modification d'article </legend>";
    		     echo "<form action='3OfCrud.php' method='POST' id='update-article-form'>";
    		        echo "<p> <input type='hidden' name='id' value=".$reponse['id']." > </p>";
    		        echo "<p> <input type='text' name='titre' value=".$reponse['titre']." placeholder='titre' required> </p>";
                echo "<textarea name='corps' placeholder='Nouveau text ici' required>";
    		        echo "</textarea>";
    		        echo "</textarea>";
    		        echo '<p> <input type=submit name="ok"> </p>';
    		     echo '</form>';
            echo "</fieldset>";
    		}
  	}
    
    /** Liste des articles dans un tableau **/
    public function ListArticle()
     {
        include('..\config.php');
         $demande=$bdd->query("SELECT * FROM article "); //var_dump($demande);die();
         echo "<table id=\"article-table\">";
         echo "<th><input type='submit' value='Supprimer' name='delete'></th>";
         echo "<th>Lire </th>";
         echo "<th>ID </th>";
         echo "<th>TITRE </th>";
         echo "<th>Nom Auteur </th>";
         echo "<th>Prenom Auteurth </th>";

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
            echo "<td><a href=dashboard.php?read=".$reponse['id'].">Lire</a></td>";
            echo "<td>".$reponse['id']."</td>";
            echo "<td>".$reponse['titre']."</td>";
            echo "<td>".$reponse['nomauteur']."</td>";
            echo "<td>".$reponse['prenomauteur']."</td>";
           echo "</tr>"; $cpt++;
        }
         echo "</form>";
        echo "</table>";
     }
    
    /** Suppression d'un article dans la base **/
    public function Delete($id)
     {
       include('..\config.php');
       $bdd->exec("DELETE FROM article WHERE id=$id");
     }
  	
  	
  }

 ?>