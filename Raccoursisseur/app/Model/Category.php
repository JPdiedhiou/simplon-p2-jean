<?php
class Category extends AppModel{

	public $hasMany = array(
		'Post'=> array(
		'dependent' => true
		));

}