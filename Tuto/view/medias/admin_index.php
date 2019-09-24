<table>
	<thead>
		<tr>
			<th></th>
			<th>Titre</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<<?php foreach ($images as $k => $v): ?>
		<tr>
			<td>
				<a href="#" onclick="FileBrowserDialogue.sendURL('<?php echo Router::webroot
				('img/'.$v->file); ?>')">
				<img src="<?php echo Router::webroot('img/'.$v->file); ?>"height="100">
				</a>
			</td>
			<td><?php echo $v->name; ?></td>
			<td>
			<a onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')"; 
			href="<?php echo Router::url('admin/medias/delete/'.$v->id) ; ?>">Supprimer</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<div class="page-header">
	<h1>Ajouter une image</h1>
</div>

<form action="<?php echo Router::url('admin/medias/index/'.$post_id); ?>"
	method="post" enctype = "multipart/form-data">
	<?php echo $this->Form->input('file', 'Image', array('type'=>'file')); ?>
	<?php echo $this->Form->input('name', 'Titre'); ?>
	<div class="action">
		<input type="submit" name="envoyer" value="Envoyer" class="btn primary">
	</div>
</form>

<script type="text/javascript" src="<?php echo Router::webroot('js/tinymce/tinymce.min');?>
   "></script>
<script type="text/javascript">
	var FileBrowserDialogue = {
		init : function(){
			//
		}
		sendURL:function(URL){
			var win = tinyMCEPopup.getWindowArg("window");

			//
			win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

			//
			if(typeof(win.ImageDialog) != "undefined"){
				//
				if(win.ImageDialog.getImageData)
					win.ImageDialog.getImageData();

				//
				if(win.ImageDialog.showPreviewImage)
					win.ImageDialog.showPreviewImage(URL);
			}
			//close popup window
			tinyMCEPopup.close();
		}
  tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script>