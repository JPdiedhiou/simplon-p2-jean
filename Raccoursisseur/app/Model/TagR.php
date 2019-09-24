<?php
class TagR extends AppModel{

	public $userTable = 'posts_tags';
	public $belongsTo = array('Post', 'Tag');

}