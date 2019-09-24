<h1>Bravo</h1>

<p>Votre lien a bien été racourci</p>

<p>
	<a href='<?= $this->Html->url(array('action'=>'view', 'id'=>$id)); ?>'class='button'>
	<?= $this->Html->url(array('action'=>'view', 'id'=>$id), true); ?>
	</a>
</p>