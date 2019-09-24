<?php 

  
  class RunContent
  {
  	
  	public function getContent()
  	{
      include('Article.Class.php');
      if (isset($_GET['key']))
       { 
      	  if ($_GET['key']=='Accueil')
            {
              
              $art = new Article();
              $art->ListArticle();
            }
      	  elseif ($_GET['key']=='Liste-article') 
            {
              
              $art = new Article();
              $art->ListArticle();
            }
            elseif ($_GET['key']=='Contact') 
            {
              include 'Message.Class.php';
              $msg = new Message();
              $msg->Listing();
            }
            elseif ($_GET['key']=='all-msg') 
            {
              include 'Message.Class.php';
              $msg = new Message();
              $msg->AllMessage();
            }
            elseif ($_GET['key']=='user-list') 
            {
              include('Admin.Class.php');
              $user = new Admin();
              $user->ListUser();
            }
          
      	  elseif ($_GET['key']=='Publier-article') {include('publier.php');}
          elseif ($_GET['key']=='error-passwd') 
            {
              echo "les mots de passe ne sont pas identiques";
            }
      	  elseif ($_GET['key']=='Mon-compte') 
            {
              include('Admin.Class.php');
              $user = new Admin();
              $user->Read($_SESSION['id']);
            }
      	  elseif ($_GET['key']=='logout') 
      	  	{
      	  		session_destroy();
      	  		session_unset();
      	  		header("location:index.php");
      	  	}

       } 
       elseif (isset($_GET['update-user']))
            {
              $role = $_GET['update-user'];
               include ('Admin.Class.php');
               $admin = new Admin();
               $admin->GetAdmin($role);
            }

       if (isset($_GET['update']))
        {
          $id = $_GET['update'];//var_dump($id);die();
          $art = new Article();
          $art->GetArticle($id);
        }
        elseif (isset($_GET['read']))
         {
          $id = $_GET['read'];//var_dump($id);die();
          $art = new Article();
          $art->read($id);
         }
         elseif (isset($_GET['read-msg']))
         {

          include 'Message.Class.php';
          $id = $_GET['read-msg'];
          $msg = new Message();
          $msg->Update($id);
          $msg->Read($id);
         }
         
        
  	}
  	
  }

 ?>