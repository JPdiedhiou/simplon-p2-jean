<?php 
include('Article.Class.php');
  if (isset($_POST['ok']))
   {
   	 $id =$_POST['id'];
   	 $titre =$_POST['titre'];
   	 $corps =$_POST['corps'];
  	 $art=new Article();
  	 $art->Update($id,$titre,$corps);

   }
 ?>