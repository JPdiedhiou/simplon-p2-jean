<?php
include '../lib/includes.php';
include '../partials/admin_header.php';


/**
*SUPPRESSION 
**/
if (isset($_GET['delete'])){
  checkCsrf();
  $id = $db->quote($_GET['delete']);
  $db->query("DELETE FROM works WHERE id=$id");
  setFlash('La catégorie a bien été supprimée');
  header('Location:category.php');
  die();
}

/**
**works
**/

$select=$db->query("SELECT id, name, slug FROM works");
$works = $select->fetchAll();


?>

<h1>Mes réalisations</h1>
<p><a href="work_edit.php" class="btn btn-success">Ajouter une nouvelle réalisation</a></p>



<table class="tablet table-striped">
<thead>
  <tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody>
  <? foreach ($works as $category): ?>
  <tr>
    <td><?= $category['id'] ;?></td>
    <td><?= $category['name'] ;?></td>
    <td>
      <a href="work_edit.php?id = <?= $category['id'] ;?>&<?= csrf(); ?>"
       class="btn btn-default">Editer</a>
      <a href="?delete= <?= $category['id'] ;?>" class="btn btn-error"
       onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</a>
    </td>
  </tr>
</tbody>  
</table>

<?php include '../partials/footer.php';?>