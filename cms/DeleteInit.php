  <meta charset="utf-8">
  <style type="text/css">
  body
  {
  	background: darkgrey;
  }
    .container
    {
    	height:250px;
    	width: 20%;
    	text-align: center;
    	margin-left: 38%;
    	background: white;
    	padding-top: 10px;
    }
    img
    {
    	display: block;
    	float: left;
    	width: 250px;
    	height: 200px;
    }
    a
    {
    	display: inline-block;
    	font-weight: bolder;
    	font-size: 20px;
    }
    h3
    {
    	margin-left: 2%;
    	background: white;
    	text-align: center;
    }
  </style>
  <h3>Vous devez supprimer le fichier d'installation pour raison de securité</h3>
  <div class="container">
  	 <?php 
       echo "
             <img src=\"error.jpg\">
            <a href=\"DeleteInit.php?key=delete-Init-file\">Supprimez</a>";
            if (isset($_GET['key']) and $_GET['key']=='delete-Init-file')
             {
               unlink('init.php');
               header('location:admin251293/index.php');
             }
     ?>
  </div>
  
