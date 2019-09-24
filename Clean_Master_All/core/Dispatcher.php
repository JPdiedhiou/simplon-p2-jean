<?php 
/**
*Dispatcher
*Permet de charger le controller en fonction de la requete utilisateur
**/
	class Dispatcher{

		var $request;   //Objet Reques

		/**
		*Fonction principale du dispatcher
		*Charger le controller en focntion du routing
		**/
		function __construct(){
			$this->request = new Request();
			Router::parse($this->request->url,$this->request);
			$controller=$this->loadController();
			$action = $this->request->action;
			if($this->request->prefix){
				$action = $this->request->prefix.'_'.$action;
			}
			if(!in_array($action,array_diff(get_class_methods($controller), 
				get_class_methods('Controller')))){
				$this->error('Le controller'.$this->request->controller.'n\'a pas de methode'
				.$action);
			}
			call_user_func_array(array($controller,$action),$this->request->params);
			$controller->render($action);
		}

		/**
		*Permet de générer une page d'erreur en cas de problème au niveau du routing
		*(page inexistante)
		**/
		function error($message){
			header("HTTP/1.0 404 Not Found");
			$controller = new Controller($this->request);
			$controller->Session = new Session();
			$controller->e404($message);
			//$controller->set('message',$message);
			//$controller->render('/errors/404');
			
		}

		function loadController(){
			$name = ucfirst($this->request->controller).'Controller';
			$file = ROOT.DS.'controller'.DS.$name.'.php';
			if(!file_exists($file)){
				$this->error('Le controller'.$this->request->controller.'n\'existe pas');
			}
			require $file;
			$controller = new $name($this->request);

			return $controller;
		}
}