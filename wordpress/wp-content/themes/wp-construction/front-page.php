<?php 
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
get_header();
	if(is_page_template('assets/template-home.php')) 
	{
	get_template_part('assets/template','home'); 	
	} elseif(is_page()){
		get_template_part('page');
	} else {
		get_template_part('index');
	}
get_footer();
?>