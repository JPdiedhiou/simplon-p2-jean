<?php 
session_start();
 if (isset($_SESSION['id']))
  {
   include('Header.Class.php');
   include('Body.Class.php');
   include('Footer.Class.php');
   include('adminContent.Class.php');

   $hd = new Header();
   $hd->getHeader();
   $bd = new Body();
   $content = new RunContent();
   $content->getContent();
   $bd->getBody();
   $ft = new Footer();
   $ft->getFooter();
  }
  else
  {
   header('location:index.php');
  }
   
 ?>