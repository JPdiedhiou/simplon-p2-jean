<?php
class PostsController extends AppController{

	function index(){

		/*$this->Post->save(array(
			'name' => 'Un nouveau Pull-over',
			'content'=> 'Royal 221 la fierté Sénégalaise'));

		$this->Post->create();
		$this->Post->save(array(
			'name'=>'Un nouveau T-shirt',
			'slug'=>'un-nouveau-tshirt'));*/
		//$posts=$this->Post->find('all');
		$posts=$this->Post->TagR->find('all');
		debug($posts);
		$this->set(compact('posts'));
	}
}