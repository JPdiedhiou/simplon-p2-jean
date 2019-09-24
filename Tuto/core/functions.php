<?php 
	function debug($var){
		if(Conf::$debug>0){
			$debug = debug_backtrace();   //cette fonction permet de voir l'ensemble des chemin pour acceder aux diffrents fichiers de l'application
			echo '<p>&nbsp;></p><p><a href="#" onclick="$(this)
				.parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].
				'</strong> l.'.$debug[0]['line'].'</a></p>';
			echo '<ol style="display:none;">';
		foreach($debug as $k => $v){if($k>0){
			echo '<li><p><a href="#"><strong>'.$v['file'].
			'</strong> l.'.$v['line'].'</li>';
			}
		}
			echo '<ol>';
			echo '<pre>';
			print_r($var);
			echo '</pre>';
	}
}
		
?>