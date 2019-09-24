<?php 
$auth = 0 ; 
include 'lib/includes.php';
include 'lib/db.php';
include '/lib/image.php';

	$condition='';
	$category=false;
if(isset($_GET['category'])){
	$slug = $db->quote($_GET['category']);
	$select = $db->query("SELECT * FROM categories WHERE slug=$slug");

if(!isset($_GET['category'])){
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:' . WEBROOT);
	die();
	}
	$category = $select->fetch();
	$condition = "WHERE works.category_id={$category['id']}";
}
$works = $db->query("
SELECT works.name, works.id, works.slug, images.name as image_name 
FROM works 
LEFT JOIN images ON images.id = works.image_id
$condition
")->fetchAll();

$categorie = $db->query("SELECT slug, name FROM categories")->fetchAll();

if ($category) {
  	$title = "Mes réalisations {$category['name']}";
    }else{
  	$title="Bienvenue sur mon portfolio";
    }

include 'partials/header.php'; 
?>
<!--STRUCTURE DE PRESENTATION-->
<!--<?= Form::input('lol');?>
<?= Session::input('lol');?>
<?= Auth::input('lol');?>-->

<h1><?= $title; ?></h1>

<div class="row">
<div class="col-sm-8">

<div class="row">
	<?php foreach ($works as $k => $work); ?>
		<div class="col-sm-3">
		<a href="<?= WEBROOT; ?>realisation/<?= $work['slug']; ?>">
		<img src="<?= WEBROOT; ?>  images/works/<?= resizedName($work['image_name'], 150,150); ?>" alt=' '>
		<h2><?= $work['name']; ?></h2>
		</a>
    </div>

</div>
</div>
</div>

<div class="col-sm-4">
	<ul>
		<?php foreach($categories as $category): ?>
			<li>
				<a href="<?= WEBROOT; ?> categorie/<?=$category['slug'] ;?>">
				<?= $category['name']; ?>
				</a>
			</li>
		<?php endforeach ?>
		<li></li>
	</ul>
</div>
<!--$select est le nom de la variable lancement requete
 $select=$db->query('SELECT * FROM "nom_de_table"');
 var_dump($select->fetch());  -->

<?php include 'lib/debug.php'; ?>
<?php include 'partials/footer.php'; ?>


 