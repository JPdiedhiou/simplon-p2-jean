<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title><?php echo isset($title_for_layout)?$title_for_layout:'Administration';?></title>
 
 <!--font-->

 <!--css-->
<link rel="stylesheet" href="../Tuto/webroot/css/boostrap.min.css">
<link rel="stylesheet" href="../Tuto/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../Tuto/css/bootstrap-colorpicker.css">
<link rel="stylesheet" href="../Tuto/css/bootstrap-overrides.css">
<link rel="stylesheet" href="../Tuto/webroot/css/style.css">


</head>

<!--contenu du site -->

<!--header-->
  <div class="topbar" style="position:statics">
  <div class="topbar-inner">
  <div class="container">
    
    <h3><a href="<?php echo Router::url('admin/posts/index'); ?>" 
    class="logo">Administration</a></h3>
      <ul class="nav">
          <li><a 
          href="<?php echo Router::url('admin/posts/index'); ?>">Articles
          </a></li>
          <li><a 
          href="<?php echo Router::url('admin/pages/index'); ?>">Pages
          </a></li>
          <li><a 
          href="<?php echo Router::url('/'); ?>">Voir le site
          </a></li>
          <li><a 
          href="<?php echo Router::url('users/logout'); ?>">Se déconnecter
          </a></li>
      </ul>
      </div>
    </div>
  </div>

      <div class="container" style="padding-top:60px;">
          <?php echo $this->Session->flash(); ?>
          <?php echo $content_for_layout; ?>
      </div>
</header>
 <!--end header-->

 <!--banniere-->
      <section class="container-fluid banner">
      
      <div class="ban">
        
        <img src="img/ban1.JPG" alt="banniere du site"/>

      </div>  
    <div class="inner-banner">
  
  <h1> Welcome in my Content Managing System! </h1>
  <button class="btn btn-custom"> Contactez moi </button>
      
    </div>
     </section>
<!--End banniere-->

<!--à propos-->
   <section class="container-fluid"> 
   
   <div class="container">
   <?php echo $content_for_layout; ?>
         <div class="row">
        <h2 id="apropos">A propos</h2>
        <hr class="separator">
    <article class="col-md-4 col-lg-4 col-xs-12 col-sm-12" >
      <h2> Etudes </h2>
    <p> 
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>


    </article>
    <article class="col-md-4 col-lg-4 col-xs-12 col-sm-12" >
      <h2> Experiences </h2>
    <p> 
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
      

   </article>
    <article class="col-md-4 col-lg-4 col-xs-12 col-sm-12" >
      <h2> Etudes </h2>
    <p> 
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>

    </article>
  </div>
</div>
      </section>
   <!--end à propos-->

   <!--portfolio-->
 <section class="container-fluid portfolio">
   <div class="container">

    <h2 id="portfolio">Mon Espace Perso</h2>
         <hr class="separator">

    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>

    <article class="col-md-3 col-lg-3 col-xs-12 col-sm-12 item-folio">
      
    </article>
   </div>

 </section>
   <!--End portfolio-->

   <script type="text/javascript" src="
   https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  
     <!--footer / contact-->

   <section class="container-fluid footer" >
  <div class="container">
    <div class="row">
    <h2 id="contact">Contactez-moi !</h2>
    <hr class="separator">
      <div class="span6">
        <form class="formulairecontact">
          <input id="name"  name="name" type="text" class="span3" placeholder="Name">

          <input id="email" name="email" type="email" class="span3" placeholder="Email">
                
                <div class="controls">
                  <textarea id="message" name="message" class="span6" placeholder="Votre Message SVP" rows="5"></textarea>
                </div>
       
       <div class="controls">

      <button id="contact-submit" type="btn btn-custom input-medium poll right">
      Envoyer
       </button>
        
       </div>

        </form>
      </div>
    </div>
    <p>
      Copyright (c) 2018 Copyright Jean_Pierre All Rights Reserved.
    </p>
</div>
   </section>
   <!--End footer -->
