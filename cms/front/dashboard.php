<?php 
   include('Header.Class.php');
   include('Body.Class.php');
   include('Footer.Class.php');
   include('UserContent.Class.php');

   $hd = new Header();
   $hd->getHeader();
   $bd = new Body();
   $content = new RunContent();
   $content->getContent();
   $bd->getBody();
   $ft = new Footer();
   $ft->getFooter();
 ?>