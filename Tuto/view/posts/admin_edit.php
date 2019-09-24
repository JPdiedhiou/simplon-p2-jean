<div class="page-header">
<h1>Editer un article</h1>	
</div>


<form action="<?php echo Router::url('admin/posts/edit/'.$id); ?>" method="post">
<?php echo $this->Form->input('name','Titre'); ?>
<?php echo $this->Form->input('slug','Url'); ?>
<?php echo $this->Form->input('id','hidden'); ?>
<?php echo $this->Form->input('content','Contenu',array('type'=>'textarea',
'class'=>'xxlarge wysiwyg', 'row'=>5, 'cols'=>10)); ?>
<?php echo $this->Form->input('online','En ligne', array('type'=>'checkbox')); ?>
<div class="actions">
	<input type="submit" class="btn primary" value="Envoyer">
</div>
</form>


 <script type="text/javascript" src="<?php echo Router::webroot('js/tinymce/tinymce.min');?>
   "></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/bootstrap-colorpicker.js"></script>
<script type="text/javascript">
  tinymce.init({
    //General options
      selector: "specific_textareas",
      theme : "advanced",
      relative_urls : false,
      editor_selector : "wysiwyg",
      plugins: [
          "advlist autolink lists link unlink inlinepopups image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table contextmenu paste"
      ],

      //Theme options
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | strikethrought",
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing : true,

      //skin options
      skin : "o2k7",
      skin_variant : "silver",
      file_browser_callback : 'fileBrowser'
  });

    function fileBrowser(field_name, url, type, win){
    	if(type == 'file'){
    		var explorer = '<?php echo Router::url('admin/posts/tinymce'); ?>';
    	}else{
    		var explorer = '<?php echo Router::url('admin/medias/index/'.$id); ?>';
    	}
       tinyMVµCE.activeEditor.windowManager.open({
        file : explorer,
        title : 'Gallerie',
        width : 420,
        height : 400,
        resizable : 'yes',
        inline : 'yes'
        close_previous : 'no'
      },{
        window : 'win',
        input : field_name
      });
      return false;
    }
</script>
