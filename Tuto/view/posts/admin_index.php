<div class="page-header">
	<h1><?php echo $total; ?>Aticles</h1> 
</div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>En ligne ?</th>
			<th>Titre</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<<?php foreach ($posts as $k => $v): ?>
		<tr>
			<td><?php echo $v->id; ?></td>
			<td><span class="label <?php echo ($v->online == 1)?'success':'error';?>"><
			?php echo ($v->online == 1)?'En ligne':'Hors ligne';?></span></td>
			<td><?php echo $v->name; ?></td>
			<td>
			<a href="<?php echo Router::url('admin/posts/edit/'.$v->id) ; ?>">Editer</a>
			<a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?')"; 
			href="<?php echo Router::url('admin/posts/delete/'.$v->id) ; ?>">Supprimer</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<a href="<?php echo Router::url('admin/posts/edit'); ?>" 
class="primary btn">Ajouter un article</a>