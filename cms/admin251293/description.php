<?php 
  include ('..\config.php');
   $requete = $bdd->query("SELECT * FROM description ");
   if ($ligne=$requete->fetch())
    {
    	echo "<div class=\"descrip-container\">";
   	   echo "<h2>".$ligne['titre1']."</h2>";
   	    echo "<div>";
   	     echo $ligne['para1'];
   	    echo "</div>";

   	    echo "<h2>".$ligne['titre2']."</h2>";
   	    echo "<div>";
   	     echo $ligne['para2'];
   	    echo "</div>";

   	    echo "<h2>".$ligne['titre3']."</h2>";
   	    echo "<div>";
   	     echo $ligne['para3'];
   	    echo "</div>";
   	    echo "</div>";
    }

 ?>