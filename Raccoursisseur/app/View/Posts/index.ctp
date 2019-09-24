<?php foreach ($posts as $k => $post): ?>
	<h1><?= $post['Post']['name']; ?></h1>
	<p><?= $post['Post']['content'] ; ?></p>

	 <p><?= $this->Html->link('Lire la suite', array(
	'controller'=>'posts',
	'action'=> 'view',
	'id'=>$post['Post']['id'],
	'slug'=>$post['Post']['slug'])); ?></p> 

	<!-- <p><?= $this->Html->link('Lire la suite', $post['Post']['url']); ?></p> -->
<?php endforeach ?>