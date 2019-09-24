<?php 
class UsersController extends Controller{
	/**
	*Login
	**/
	function login(){
		if($thsi->request->data){
			$data = $this->request->data;
			$data->password = sha1($data->password);
			$this->loadModel('User');
			$user = $this->User->findFirst(array(
				'conditions' => array('login' => $data->login,
				'password' => $data->password
			)));
			if(!empty(user)){
				$this->Session->write('User', $user);
			}
			$this->request->data->password = '';
		}
		if($this->Session->isLogged()){
			if($this->Session->user('role') == 'admin'){
				$this->redirect('cockpit');
			}else{
				$this->redirect('');
			}
			
		}
	}

	/**
	*Logout
	**/
	function logout(){
		unset($_SESSION['User']);
		$this->Session->setFlash('Vous etes maintenant déconnecté');
		$this->redirect('/');
		//session_destroy(); cette fonction ne permet de pouvoir mettre un message d'alerte
	}
 }
