<?php 
 
  class Header
  {
  
     public function getHeader()
     {
     
  ?>
     	<!DOCTYPE html>
				<html>
				<head>
					<title> DASHBOARD </title>
					<meta charset="utf-8">
					<link rel="stylesheet" type="text/css" href="css/dashboard.css">
					<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
				</head>
				<body>
				   <header>
				    <ul>
				     <?php 
				         include('..\config.php');
				         $cpt =0;
				         $req2 = $bdd->query("SELECT * FROM message WHERE etat=1");
				         while ($ligne=$req2->fetch())
				          {
				         	$cpt++;
				          }
                         $demande = $bdd->query("SELECT * FROM menu");
                         while ($reponse = $demande->fetch())
		                   {
		                   	  if ($reponse['libelle']=='Inscription')
		                   	   {
		                   	  	  if (!isset($_SESSION['login']))
		                   	  	   {
		                   	  	  	echo "<li><a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";
		                   	  	   }
		                   	   }
		                   	   elseif ($reponse['libelle']=='Contact') 
		                   	   {
		                   	   	echo "<li><i class=\"icon-envelope-alt\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">Message <span id='cpt'>$cpt </span></a></li>";
		                   	   }
		                   	   else
		                   	   {
		                   	    switch ($reponse['libelle'])
			                   	   	 {
			                   	   		case 'Accueil':echo " 
			                   	   		     <li><i class=\"icon-home\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";		
			                   	   			break;
			                   	   		case 'Liste-article':echo "
			                   	   		     <li> <i class=\"icon-table\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";		
			                   	   			break;
			                   	   		case 'Publier-article':echo "
			                   	   		     <li> <i class=\"icon-plus-sign\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";		
			                   	   			break;

			                   	   		case 'Nouveau-menu':echo "
			                   	   		     <li> <i class=\"icon-plus-sign\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";		
			                   	   			break;

			                   	   		case 'Mon-compte':echo " 
			                   	   		     <li><i class=\"icon-user\"></i> <a href=dashboard.php?key=".$reponse['libelle'].">".$reponse['libelle']."</a> </li>";		
			                   	   			break;
			                   	   		
			                   	   		case 'Inscription':echo " 
			                   	   		     <li><i class=\"icon-signin\"></i> <a href=dashboard.php?key=".$reponse['libelle']." >".$reponse['libelle']."</a> </li>";		
			                   	   			break;
			                   	   		}
		                   	   }
		                     
		                   }

				      ?>
				   	 	<li><i class="icon-signout"></i>  <a href="dashboard.php?key=logout">Deconnexion</a> </li>
				   	 	<li>  <span id="user"><?php echo $_SESSION['nom']; ?></span> </li>
				   	 </ul>
				   	
				   	  
				   </header>
				   <div class="container">
<?php
     }	
  
  }
 ?>