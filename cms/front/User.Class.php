<?php 
    /**
    * 
    */
    class User
    {
    	
    	public function Create($nom,$prenom,$login,$img,$pwd,$role)
    	{
    		 include ('..\config.php');
    		 $insert = $bdd->prepare("INSERT INTO user(nom,prenom,login,photo,password,role) VALUES(?,?,?,?,?,?)");
              if ($insert-> execute(array($nom,$prenom,$login,$img,$pwd,$role)))
                       {
                         header("location:index.php");                          
                       }
    	}

    	public function Read($id)
    	{
            include ('..\config.php');
            $demande = $bdd->query("SELECT * FROM user WHERE id=$id");
              while ($reponse = $demande->fetch())
               {
                 echo "<div class=\"user-info\">";
                    echo "<h3> Vos Informations </h3> ";
                    echo "<img src=\"..\admin251293/users/".$reponse['photo']."\" id=\"user-picture\">";
                    echo "<p> <span>Nom  :</span> ".ucfirst($reponse['nom'])."</p>";
                    echo "<p><span>Prenom :</span> ".ucfirst($reponse['prenom'])."</p>";
                    echo "<p><span>Login :</span> ".ucfirst($reponse['login'])."</p>";
                   
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
                          </span> <br>";
                           echo "<a href=\"dashboard.php?update-user=".$reponse['id']." \"> Modifier mon compte </a>";
                 echo "</div>";
               }
              
    	}
        
        public function Update()
    	{
          
    	}
        
        public function Delete()
    	{

    	}

    	public function Listing()
    	{

    	}


    }
 ?>
 