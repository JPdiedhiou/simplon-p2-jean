<?php 
  
  /**
  * 
  */
  class FormLogin
  {
  	  public function LoginForm()
  	  {
        echo "<div class=\"bkgr\"></div>";
         echo "<div class=\"Mymodal\">
               <div class=\"trait-2\">
                Authentification
              </div> <br>" ;
         echo "<fieldset>";
       
          echo "<form action=\"actionLogin.php\" method=\"POST\" id=\"initform\">";
            echo "<p> <input type=\"text\" name=\"login\" placeholder=\"Login\" required> </p>";
            echo "<p> <input type=\"password\" name=\"password\" placeholder=\"Password\" required> </p>";
            echo "<p> <input type=\"submit\" name=\"ok\" value=\"Login\" > </p>";
          echo "</form>";
         echo "</fieldset>";
          
         echo "</div>";


        
  	  }
   }

 ?>