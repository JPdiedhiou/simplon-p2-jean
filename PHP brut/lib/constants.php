<?php
//Permet de récuperer le chemin du dossier
define('WWW_ROOT',dirname(dirname(__FILE__)));
$directory = basename(WWW_ROOT);
$url = $_SERVER['REQUEST_URI'];
$url = explode('$directory', $_SERVER['REQUEST_URI']);

//Attention au cas particulier d'etre a la racine 

if (count($url)==1) {
	define('WEBROOT', '/');
}else{
	define('WEBROOT', $url['0'] . 'Portfolio_brut/');

}

define('IMAGES', WWW_ROOT . DIRECTORY_SEPARATOR . 'images');


