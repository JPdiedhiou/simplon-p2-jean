<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title_for_layout; ?></title>
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
          <a class="brand" href="#">Royal 221</a>
            <ul class="nav nav-pills">
              <li class="active">
              <a href="#">Accueil</a></li>
              <li><a href="post.php">Nos Produits</a></li>
              <li><a href="#">A Propos de Nous</a></li>
            </ul>
          </div>
          </div>
  

    <div class="container">
    <p>&nbsp;</p>
    <div class='row'>
    <?= $this->fetch('content'); ?>
    </div>
      

    </div> <!-- /container -->

<?= $this->Html->script('http://');?>
<?= $this->Html->script('bootstrap'); ?>
<?= $this->fetch('script'); ?>
  </body>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="span4">
          <div class="widget">
            <h4>A propos de Nous</h4>
          <address>
          <strong>Royal 221, Inc.</strong><br>
          520 Cite Air France, Villa 26<br>
          Dakar, SENEGAL<br>
          <abbr title="Phone">Telephone:</abbr> (+221) 772339037
          </address>

          <address>
          <strong>Contacter Nous</strong><br>
          <a href="mailto:#">contact@royal221.com</a>
          </address>
          </div>
        </div>
        <div class="span4">
          <div class="widget">
            <h4>Nos Pages</h4>
            <ul class="nav nav-list regular">
              <li class="nav-header">More from us</li>
              <li><a href="#">Work for us</a></li>
              <li><a href="#">Creative process</a></li>
              <li><a href="#">Case study</a></li>
              <li class="nav-header">Quick links</li>
              <li><a href="#">...</a></li>
              <li><a href="#">Meet the team</a></li>
            </ul>
          </div>
        </div>
        <div class="span4">
          <div class="widget">
            <h4>Avoir les emails à jour</h4>
            <form class="form-horizontal" action="#" method="post">
              <fieldset>
                <p>
                  Sign up for email updates and we'll plant a tree for you through Trees for the Future.
                </p>

                <div class="input-prepend input-append">
                  <input class="span2" id="appendedPrependedInput" type="text" placeholder="Email">
                  <button class="btn btn-inverse" type="submit">Subscribe!</button>
                </div>
              </fieldset>
            </form>
            <ul class="social_small">
              <li class="facebook first"><a href="#" title="Facebook">Facebook</a></li>
              <li class="twitt"><a href="#" title="Twitter">Twitter</a></li>
              <li class="googleplus"><a href="#" title="google plus">Google+</a></li>
              <li class="flickr"><a href="#" title="flickr">Flickr</a></li>
              <li class="dribbble"><a href="#" title="Dribbble">Dribbble</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="verybottom">
      <div class="container">
        <div class="row">
          <div class="span6">
            <p>&copy; Royal 221 - All right reserved</p>
          </div>
          <div class="span6">
            <div class="pull-right">
              <div class="credits">
                <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Scaffold
                -->
                Designed by <a href="https://freedesigned.com/">Freedesigned_P</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </footer>
</html>
