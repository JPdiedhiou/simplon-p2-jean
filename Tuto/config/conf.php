<?php
class Conf{
        
static $debug = 1;

	static	$databases = array(

		'default' =>array(
			'host'     =>'localhost',
			'database' => 'tuto_mvc',
			'login'    => 'root',
			'password' => ''
			)

		);
}

Router::prefix('cockpit', 'admin');


Router::connect('/','posts/index');
Router::connect('cockpit','cockpit/posts/index');
Router::connect('post/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/*','posts/*');
