<?php
add_action( 'wp_enqueue_scripts', 'mandy_theme_css',999);
function mandy_theme_css() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'theme-menu-style', get_template_directory_uri() . '/css/theme-menu.css' );
	wp_enqueue_style( 'default-css', get_stylesheet_directory_uri()."/css/default.css" );
	wp_enqueue_style( 'element-style', get_template_directory_uri() . '/css/element.css' );
	wp_enqueue_style( 'media-responsive', get_template_directory_uri() . '/css/media-responsive.css' );
	wp_dequeue_style('appointment-default',get_template_directory_uri() .'/css/default.css');
}

/*
	 * Let WordPress manage the document title.
	 */
function mandy_setup() {
   add_theme_support( 'title-tag' );
   require( get_stylesheet_directory() . '/functions/customizer/customizer-copyright.php' );
   load_theme_textdomain('mandy', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'mandy_setup' );

function mandy_default_data(){
	return array(
	// general settings
	'footer_copyright_text' => '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="designer">Mandy</a> by Webriti', 'mandy' ).'</p>',
	'footer_menu_bar_enabled' => '',
	'footer_social_media_enabled' => '',
	'footer_social_media_facebook_link' => '#',
	'footer_facebook_media_enabled' => 1,
	'footer_social_media_twitter_link' => '#',
	'footer_twitter_media_enabled'=>1,
	'footer_social_media_linkedin_link' => '#',
	'footer_linkedin_media_enabled'=>1,
	'footer_social_media_googleplus_link' => '#',
	'footer_googleplus_media_enabled' => 1,
	'footer_social_media_skype_link' => '#',
	'footer_skype_media_enabled' => 1,
	
	);
}
?>