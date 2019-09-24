<?php
include '../lib/includes.php';
/**
**LA SAUVEGARDE
**/

if (isset($_POST['name'])&& isset($_POST['slug'])) {
  checkCsrf();
  $slug= $_POST['slug'];
  //verification validité slug avec la fonction
  if (preg_match('/^[a-z\-0-9]+$/', $slug)) {
     $name= $db->quote($_POST['name']);
     $slug= $db->quote($_POST['slug']);
     $category_id= $db->quote($_POST['category_id']);
     $content= $db->quote($_POST['content']);
/**
*ON RECUPERE UNE REALISATION
**/
     if (isset($_GET['id'])) {
         $id=$db->quote($_GET['id']);
         $db->query("UPDATE works SET name=$name, slug= $slug, 
          content=$content, category_id=$category_id WHERE ID= $id");
     }
     else{
           $db->query("INSERT INTO works SET name=$name, slug= $slug, 
            content=$content, category_id =$category_id");
           $_GET['id'] = $db->lastInsertID();
     }
     setFlash('L\réalisation a bien été ajouté');
/**
*ENVOI DES IMAGES
**/
        $work_id=$db->quote($_GET['id']);
        $files = $_FILES['images'];
        $images = array();
//require '../lib/image.php';
        foreach ($files['tmp_name'] as $k => $v) {
            $image = array('name'=>$files['name'][$k], 'tmp_name' => $files['tmp_name'][$k]);
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        if(in_array($extension, array('jpg', 'png'))){
            $db->query("INSERT INTO images SET work_id=$work_id");
            $image_id = $db->lastInsertId();
            $image_name = image_id . '.' . $extension;
            move_uploaded_file($image['tmp_name'], IMAGES . '/works/' . $image_name);
            
/*resizeImage(IMAGES . '/works/' . $image_name, 150,150);*/

            $image_name =  $db->quote($image_name);
            $db->query("UPDATE images SET name=$image_name WHERE id= $image_id");
        }

        header('Location:work.php');
        die();
          }
          else{
            setFlash('Le slug n\est pas valide', 'danger');
          }
}

if (isset($_GET['id'])) {
  $id=$db->quote($_GET['id']);
  $select=$db->query("SELECT * FROM works WHERE id=$id");
  if ($select->rowcount == 0) {
    setFlash("IL n'y a pas de réalisation avec cet ID", 'danger');
    header('Location:work.php');
    die();
  }
  $_POST = $select->fetch();
}
/**
**ON RECUPERE LA LISTE DES CATEGORIES
**/
    $select = $db->query('SELECT id, name FROM categories ORDER BY name ASC');
    $categories = $select->fetchAll();
    $categories_list = array();
    foreach ($categories as $category) {
    $categories_list[$category['id']] = $category['name'];
}
/**
** SUPPRESSION D'UNE IMAGE
**/
if (isset($_GET['delete_image'])) {
  checkCsrf();
  $id = $db->quote($_GET['delete_image']);
  $select = $db->query("SELECT name, work_id FROM images WHERE id=$id");
  $image = $select->fetch();
  $images = (glob(IMAGES . '/works/' . pathinfo($image['name'], PATHINFO_FILENAME) . '_*x*.*'));
  if(is_array($images)){
    foreach ($images as $v) {
      unlink($v);
    }
  }
  unlink(IMAGES . '/works/' . $image['name']);
  $db->query("DELETE FROM images WHERE id=$id");
  setFlash("L'image a bien été supprimée");
  header('Location:work_edit.php?id=' . $image['work_id']);
  die();
}
/**
** MISE EN AVANT D'UNE IMAGE
**/
if (isset($_GET['highlight_image'])) {
  checkCsrf();
  $work_id=$db->quote($_GET['id']);
  $image_id=$db->quote($_GET['highlight_image']);
  $db->query("UPDATE works SET image_id=$image_id WHERE id=$work_id");
  setFlash("L'imgae a bien été bien mise en avant");
  header('Location:work_edit.php?id=' . $_GET['id']);
  die();
}

/**
**ON RECUPERE LA LISTE DES CATEGORIES 
**/
if (isset($_GET[id])){
  $work_id = $db->quote($_GET['id']);
  $select = $db->query("SELECT id, name FROM images WHERE work_id=$work_id");
  $images = $select->fetchAll();
}else{
  $image = array();
}

include '../partials/admin_header.php';
?>

<h1>Editer une réalisation</h1>

<div class="row">
  <form action="#" method="post" enctype="multipart/form-data">
  <div class="col-sm-8">
        <div class="form-group">
          <label for="name">Nom de la réalisation</label>
          <?= input('name'); ?>
        </div>
        <div class="form-group">
          <label for="slug">URL de la réalisation</label>
          <?= input('slug'); ?>
        </div>
        <div class="form-group">
          <label for="content">Contenu de la réalisation</label>
          <?= textarea('slug'); ?>
        </div>
        <div class="form-group">
          <label for="category_id">Catégorie</label>
          <?= select('category_id', $categories_list); ?>
        </div>
        <?= csrfInput(); ?>
        </div>
        <button type="submit" class="btn btn-default">Enregistrer</button>
  </div>
  <div class="col-sm-4">
    <?php foreach($images as $k => $image): ?>
     <p>
       <img src="<?= WEBROOT; ?>images/works/<?= $image['name']; ?>"
       width="100"><a href="?delete_image = <? $image['id']; ?>&<?= csrf();?>"oneclick="return 
       confirm('Sur?');">Supprimer</a>
       <a href="?highlight_image=<?= $image['id']; ?>& id=<?=$_GET['id']; ?><?= csrf();?>">Mettre à la une</a>
     </p>
    <?php endforeach ?>
</div>
    <div class="form-group">
      <input type="file" name="images[]">
      <input type="file" name="images[]" class="hidden" id="duplicate">
        <p>
      <a href="#" class="btn btn-success" id="duplicatebtn">Ajouter une image</a>
        </p>
    </div>
      </form>
</div>

      




<!--TOUT LE CONTENU DE CES 2 BALISES PHP EST STOCKE DANS $SCRIPT-->
<?php ob_start(); ?>
<script src="<?= WEBROOT; ?>js/tinymce/tinymce.min.js"></script>

<script>
(function ($){

$('#duplicatebtn').click(fucntion(e)){
  e.preventDefault();
  var $clone = $('#duplicate').clone().attr('id', '').removeClass('hidden');
  $('#duplicate').before($clone);
}


}(jQuery);
  
</script>

<?php $script=ob_get_clean() ; ?>

<?php include '../partials/footer.php';?>