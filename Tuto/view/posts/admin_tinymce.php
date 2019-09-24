<ul>
	<?php foreach ($posts as $k => $v): ?>

		<li><a href="#" onclick="FileBrowserDialogue.sendURL('<?php echo Router::url
				($v->type.'s/view/id:'.$v->id '/slug:'.$v->slug); ?>') "><?php echo ucfirst($v->type); ?> : <?php echo $v->name; ?></a></li>
	<?php endforeach; ?>
</ul>


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