<?php 
$auth = 0 ; 
include 'lib/includes.php';
include '/lib/image.php';

if (!isset($_GET['slug'])) {
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:index.php');
	die();
}
$slug= $db->quote($_GET['slug']);
$select = $db->query("SELECT * FROM works WHERE slug=$slug");
if ($select->rowCount() == 0) {
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:index.php');
	die();
}
$work = $select->fetch();
$work_id=$work['id'];

$select = $db->query("SELECT * FROM images WHERE work_id=$work_id");
$images= $select->fetch();
$title = $work['name'];

include 'partials/header.php'; 
?>

<h1><?= $work['name']; ?></h1>

<? $work['content']?>

<?php foreach ($images as $k => $image) ?>
    <p>
	<img src="<?= WEBROOT; ?>/images/works/<?= $image['name']; ?>" width="100%">
	<p>
<?php endforeach ?>

	<div class="row">
		<?php foreach ($works as $k => $work) ?>
			<div class="col-sm-3">
			<a href="view.php?id=<?= $work['id']; ?>">
			<img src="<?= WEBROOT; ?>images/works/<?= ($work['image_name'], 150,150); ?>" alt="">
				<h2><?= $work['name']; ?></h2>
			</a>
			</div>
		<?= endforeach ?>
	</div>


<!--$select est le nom de la variable lancement requete
 $select=$db->query('SELECT * FROM "nom_de_table"');
 var_dump($select->fetch());  -->

<?php include 'lib/debug.php'; ?>
<?php include 'partials/footer.php'; ?>


  <div id="slideshow">
       <ul id="slide">
           <li><img src="images/slideshow/01.jpg" width="775" height="295" alt="01"></li>
           <li><img src="images/slideshow/02.jpg" width="775" height="295" alt="02"></li>
           <li><img src="images/slideshow/03.jpg" width="775" height="295" alt="03"></li>
       </ul>
       <ul id="item">
           <li><a href="#1"></a></li>
           <li><a href="#2"></a></li>
           <li><a href="#3"></a></li>
       </ul>
   </div>
<div id="main">
 <div class="bloc">
     <img src="images/thumbnails/01.png" width="274" height="141" alt="01">
     <h1>lorem ipsum dolor</h1>
     <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
         Repellat, ea consequatur possimus quidem iure mollitia 
         laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.voluptatem sapiente eum harum culpa esse cumque! 
     </p>
     <a href="#">Lire la suite</a>
 </div>
 <div class="bloc">
     <img src="images/thumbnails/02.png" width="274" height="141" alt="01">
     <h1>lorem ipsum dolor</h1>
     <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
         Repellat, ea consequatur possimus quidem iure mollitia 
         laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.voluptatem sapiente eum harum culpa esse cumque! 
     </p>
     <a href="#">Lire la suite</a>
 </div>
 <div class="bloc">
     <img src="images/thumbnails/03.png" width="274" height="141" alt="01">
     <h1>lorem ipsum dolor</h1>
     <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
         Repellat, ea consequatur possimus quidem iure mollitia 
         laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.laudantium libero quod! Nesciunt, culpa, voluptatibus! 
         Eaque, voluptatem sapiente eum harum culpa esse cumque! 
         Fuga.voluptatem sapiente eum harum culpa esse cumque! 
     </p>
     <a href="#">Lire la suite</a>
 </div>
</div>
    </body>
</html>