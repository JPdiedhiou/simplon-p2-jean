<h1>Racourcir un lien</h1>

<?= $this->Form->create('Link'); ?>
	<?= $this->Form->input('url', array('label'=>'Votre lien', 'placeholder'=>'http://monlien.com')); ?>
<?= $this->Form->end('Racourcir le lien'); ?>