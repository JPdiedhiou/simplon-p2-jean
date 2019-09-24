<?php 
  if (isset($_POST['ok']))
   {
      $host =$_POST['host'];
      $user =$_POST['user'];
      $password =$_POST['password'];
      $base =$_POST['base'];
      $table ="article" ;
     
        try 
        {
           $bdd = new PDO("mysql:host=$host;dbname=$base","$user",""); 
           if ($bdd)
            {
           	  $sql ="CREATE TABLE IF NOT EXISTS `article` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `titre` varchar(255) NOT NULL,
					  `corps` text NOT NULL,
            `img` varchar(255) NOT NULL,
            `nomauteur` varchar(255) NOT NULL,
            `prenomauteur` varchar(255) NOT NULL,
					  `auteur` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

					CREATE TABLE IF NOT EXISTS `user` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `nom` varchar(255) NOT NULL,
					  `prenom` varchar(255) NOT NULL,
            `login` varchar(255) NOT NULL,
					  `photo` varchar(255) NOT NULL,
					  `password` varchar(255) NOT NULL,
					  `role` varchar(20) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
           CREATE TABLE IF NOT EXISTS `menu` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `libelle` varchar(50) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

          CREATE TABLE IF NOT EXISTS `message` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `titre` varchar(255) NOT NULL,
            `corps` text NOT NULL,
            `nomauteur` varchar(255) NOT NULL,
            `prenomauteur` varchar(255) NOT NULL,
            `etat` int(11) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
          CREATE TABLE IF NOT EXISTS `description` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `titre1` varchar(255) NOT NULL,
            `para1` text NOT NULL,
            `titre2` varchar(255) NOT NULL,
            `para2` text NOT NULL,
            `titre3` varchar(255) NOT NULL,
            `para3` text NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ; ";
                    if(!$bdd->prepare($sql)->execute())
                    {echo "<p id=\"tb-crete-error\">Error 404 !!!! </p>";}
              $insert = $bdd->prepare("INSERT INTO user(nom,prenom,login,photo,password,role) VALUES(?,?,?,?,?,?)");
              $insert-> execute(array('mowen','cleopas','admin','img.jpg','admin','admin'));

              $insert0 = $bdd->prepare("INSERT INTO user(nom,prenom,login,photo,password,role) VALUES(?,?,?,?,?,?)");
              $insert0-> execute(array('user', 'user','user','img.jpg','user','user'));      
              
              $insert1 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert1-> execute(array('Accueil'));
              $insert2 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert2-> execute(array('Liste-article'));
              $insert3 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert3-> execute(array('Publier-article'));
              $insert7 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert7-> execute(array('Nouveau-menu'));
              $insert4 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert4-> execute(array('Mon-compte'));
              $insert5 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert5-> execute(array('Contact'));

              $insert6 = $bdd->prepare("INSERT INTO menu(libelle) VALUES(?)");
              $insert6-> execute(array('Inscription'));

              $insert7 = $bdd->prepare("INSERT INTO description(`titre1`, `para1`, `titre2`, `para2`, `titre3`, `para3`) VALUES(?,?,?,?,?,?)");
              $insert7-> execute(array('Lorem ipsum dolor sit amet, consectetur', 'tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur', 'tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur', 'tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nuis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.'));
              

            }
               
        $opened = fopen('config.php', 'w');
       //pour eviter des pb avec les guillets j'ai segmenté le text en plusieurs variables
        $chaine1 = '<?php 
                      try{
                      $bdd= new PDO(\'mysql:host='.$host;
        $chaine2 = ";dbname=$base',";
        $chaine3 = "'root',";
        $chaine4 = "'');}";
        $chaine5 = 'catch (PDOException $e) {die($e->getMessage());} ';
        $chaine6 = '?>';
        $ch = '"';  
        $ch2 = '";'; 
           
        
        $concate = $chaine1.$chaine2.$chaine3.$chaine4.$chaine5.$chaine6;    
        //var_dump($concate);die();  
   	    fwrite($opened, $concate);
        header("location:DeleteInit.php");

        } catch (Exception $e) 
        {
          echo "Error 404 !";	
        }

   }
 ?>
