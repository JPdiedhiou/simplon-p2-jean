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
<body>
   <?php echo $this->Session->flash(); ?>
   <?php echo $content_for_layout; ?>
  </body>
</html>