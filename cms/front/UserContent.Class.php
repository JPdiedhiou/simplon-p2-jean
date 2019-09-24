<?php 

  
  class RunContent
  {
  	
  	public function getContent()
  	{
      include('Article.Class.php');
      
      	  if (isset($_GET['key']) and $_GET['key']=='Accueil')
            {
              echo "<h2 id='contact-h2'> Accueil</h2>";
              $art = new Article();
              $art->ListArticle();
            }
      	  elseif (isset($_GET['key']) and$_GET['key']=='Liste-article') 
            {
              echo "<h2 id='contact-h2'> A LA UNE </h2>";
              $art = new Article();
              $art->ListArticle();
            }
            elseif (isset($_GET['key']) and $_GET['key']=='Contact') 
            {
               echo "<h2 id='contact-h2'>Pour nous contacter </h2>";
              include('FormMessage.php');
            }
          elseif (isset($_GET['key']) and$_GET['key']=='Mon-compte') 
            {
              echo "<h2 id='contact-h2'> VOTRE COMPTE </h2>";
              include('User.Class.php');
              $user = new User();
              $user->Read($_SESSION['id']);
            }
      	  elseif (isset($_GET['key']) and $_GET['key']=='Publier-article')
           {
            echo "<h2 id='contact-h2'> POUR PUBLIER </h2>";
            include('publier.php');
           }
      	  elseif (isset($_GET['key']) and$_GET['key']=='logout') 
      	  	{
      	  		session_destroy();
      	  		session_unset();
      	  		header("location:index.php");
      	  	} 
        elseif (isset($_GET['read']))
         {
          $id = $_GET['read'];//var_dump($id);die();
          $art = new Article();
          $art->read($id);
         }
         else
         {
           echo "<h2 id='contact-h2'> WELCOME </h2>";
           $art = new Article();
           $art->ListArticle();
         }
        
  	}
  	
  }

 ?>