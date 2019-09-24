<?php include ('../lib/debug.php'); ?>

 <footer>
     <ul>
         <li><h2>Sitemap</h2></li>
         <li><a href="#">Accueil</a></li>
         <li><a href="#">Equipes</a></li>
         <li><a href="#">Services</a></li>
         <li><a href="#">Produits</a></li>
         <li><a href="#">Contacts</a></li>
     </ul>
     <ul>
         <li><h2>Sociaux</h2></li>
         <li><span class="facebook social"></span><a href="#">Facebook</a></li>
         <li><span class="twitter social"></span><a href="#">Twitter</a></li>
         <li><span class="google social"></span><a href="#">Google+</a></li>
         <li><span class="linkind social"></span><a href="#">Linkind</a></li>
     </ul>
     <ul>
         <li><h2>Contact</h2></li>
         <li>12 rue Albert 75 000 - Paris</li>
         <li>Tél : 02 00 00 00 00</li>
         <li><a href="mailto:sevice@votresite.com">sevice@votresite.com</a></li>
         <li><a href="www.votresite.com">www.votresite.com</a></li>
     </ul>
    <div id="copyright">
        &copy; 2012 créezvotresite.com, Tous droits réservés
        <div>
            <a href="#">Mentions légales</a> | Propulsé par DevAndClick
        </div>
    </div>
</footer> 
<!-- Core Javascript=====================-->
<!-- Placed at the end of the document so the page load faster -->
<script src="<?= WEBROOT ; ?>js/jquery.js"></script>
<script src="<?= WEBROOT ; ?>js/tinymce/jquery.tinymce.min.js"></script>
<?php if (isset($script)): ?><?= $script; ?><?php endif; ?>

</body>
</html>