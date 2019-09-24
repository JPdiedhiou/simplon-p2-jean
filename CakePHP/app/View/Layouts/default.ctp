<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Royal 221</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!--link href="../css/bootstrap.css" rel="stylesheet"-->
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <?= $this->Html->css('bootstrap'); ?>
    <?= $this->Html->css('bootstrap-responsive'); ?>
    <?= $this->fetch('css'); ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#"><?= $this->fetch('title'); ?></a>
          </div>
          </div>

    <div class="container">

    <?= $this->fetch('content'); ?>
      

    </div> <!-- /container -->

<?= $this->Html->script('http://');?>
<?= $this->Html->script('bootstrap'); ?>
<?= $this->fetch('script'); ?>
  </body>
</html>
