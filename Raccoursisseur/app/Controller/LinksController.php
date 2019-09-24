<?php
class LinksController extends AppController{

	public function add(){
		if($this->request->is('post')){
		$link=$this->Link->findByUrl($this->request->data['Link']['url']);

		if(empty($link)){
			//$this->Link->create(array('url'=>$this->request->data['Link']['url']));
			$this->Link->create($this->request->data, true);

			if($this->Link->save(null, true, array('url'))){
			$id=$this->Link->id;
			$this->set(compact('id'));
			$this->render('add-success');
		  }
		}else{
		
			//$this->set('id',$id);
			$id = $link['Link']['id'];
			$this->set(compact('id'));
			$this->render('add-success');
		}
	}
}
	//Cette fonction permet la redirection vers un lien voulu
	public function view($id){
			$link=$this->Link->findById($id);
			if(empty($link)){
			throw new NotFoundException();
			}
			return $this->redirect($link['Link']['url'], 301);
	}

	/*public function test($param1, $param2){
		debug($this->request->params);
	}*/
	public function admin_index(){
			$links= $this->Link->find('all');
			$this->set(compact('links'));
		}
	}