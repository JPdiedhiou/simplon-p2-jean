<?php 
   
   class Footer
   {
   	
	   	public function getFooter()
	   	{
	   		echo "<nav>";
	   		   echo "<img src=\"images/ht.jpg\">";
	   		   echo "<ul>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
	   		   echo "</ul>";
	   		echo "</nav>";

	   		echo "<nav>";
	   		   echo "<img src=\"images/image3.jpg\">";
	   		   echo "<ul>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
                echo "<li><i class=\"icon-arrow-right\"></i> <a href=\"\"> Lien</a> </li>";
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
 