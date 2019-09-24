<?php
class Post extends AppModel{

	public $belongsTo = array(
		'Category' => array(
			'CounterCache' => true
			)
		);
	public $hasAndBelongsToMany = array('Tag');
	public $hasMany = array('TagR');

 //beforeSave/beforeSavefield est une fonction qui se lance avant toutes les sauvegardes
	public function beforeSave($options = array()){
		if(
		  isset($this->data[$this->alias]['name']) && 
		  !isset($this->data[$this->alias]['slug'])
		  ){
			$this->data[$this->alias]['slug'] = strtolower(Inflector::slug(
			$this->data[$this->alias]['name'], '-'));
		}
	}
		public function afterFind($results, $primary = false){	
			foreach ($results as $k => $result) {
				if(
					isset($result[$this->alias]['id']) &&
					isset($result[$this->alias]['slug'])
					){
						$results[$k][$this->alias]['url'] = array(
							'controller'  => 'posts',
							'action'      => 'view',
							'id'          => $result[$this->alias]['id'],
							'slug'        => $result[$this->alias]['slug']
							);
			}
			return $results;
		}
	}
}