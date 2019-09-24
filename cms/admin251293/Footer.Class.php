<?php 
   
   class Footer
   {
   	
	   	public function getFooter()
	   	{
	   		echo "<nav>";
	   		   echo "<img src=\"images/hitech.png\">";
	   		   echo "<ul>";
                echo "<li><i class=\"icon-table\"></i> <a href=\"dashboard.php?key=user-list\"> Liste des Utilisateurs</a> </li>";
                echo "<li> <i class=\"icon-table\"></i><a href=\"dashboard.php?key=all-msg\"> Tous les messages</a> </li>";
                echo "<li> <a href=\"\"> Lien</a> </li>";
                echo "<li> <a href=\"\"> Lien</a> </li>";
	   		   echo "</ul>";
	   		echo "</nav>";
	   		echo "</div>";
	   		echo "<footer>";
	   		  echo " <ul>
				   	 	<li> <a href=\"dashboard.php?key=Accueil\">Accueil</a> </li>
				   	 	<li> <a href=\"dashboard.php?key=list\">Liste des articles</a> </li>
				   	 	<li> <a href=\"dashboard.php?key=publier\">Publier un article</a> </li>
				   	 	<li> <a href=\"dashboard.php?key=Modif-compte\">Modifier mon compte</a> </li>
				   	 </ul>";
	   		echo "</footer>";
	   	}
   }

 ?>
 