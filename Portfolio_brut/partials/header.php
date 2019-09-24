 <!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title)? $title: 'Mon portfolio'; ?></title>
        <meta http-equiv="Content-type" content="text/html"; charset="UTF-8">
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?= WEBROOT; ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?= WEBROOT; ?>css/mobile.css" rel="stylesheet" type="text/css" media="screen and (max-device-width: 320px)"  />
        <script src="js/jquery-2.1.1.min.js" type="text/javascript" /></script>
        <script src="js/main.js" type="text/javascript" /></script>
    </head>
<body>
<div id="content">
<header>
   <div id="identite">
       <div id="logo"><a href="<?= WEBROOT; ?>"></a></div>
       <h1>Votre logo</h1>
       <h2>Votre slogan ici</h2>
   </div>
   <nav>
       <ul>
           <li>
               <a href="#" class="selected">Accueil</a>

           </li>
           <li>
               <a href="#">Equipe</a>
           </li>
           <li>
               <a href="#">Services</a>
           </li>
           <li>
               <a href="#">produits</a>
           </li>
           <li>
               <a href="#">Contacts</a>
           </li>
       </ul>
    </nav>
</header> 
</div>
</body>
<?= flash(); ?>