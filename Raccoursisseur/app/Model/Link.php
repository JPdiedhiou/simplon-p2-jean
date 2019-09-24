<?php
class Link extends AppModel{

	public $validate = array(
		'url' => array(

		'isEmpty' => array(
		'rule'    => 'notEmpty',
		'message' => 'Vous devez rentrez une URL'
			),
		'isURL' =>array(
		'rule'         => 'url',//or: array('ruleName', 'param1', 'param2' ...)
		'required'     => true,
		'allowEmpty'   => false,
		'message'      =>'Votre url n\'est pas valide'
			)
		
		)
	);
}