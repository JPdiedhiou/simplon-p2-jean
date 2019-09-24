<!DOCTYPE html>
<html>
<head>
	<title> Authentification </title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
   <?php 
       include("FormLogin.Class.php");
       $logform = new FormLogin();
       $logform->LoginForm();
       if (isset($_GET['key']) and isset($_GET['key'])=='delete-config-file')
        {
       	  unlink('..\init.php');
        }
    ?>
</body>
</html>