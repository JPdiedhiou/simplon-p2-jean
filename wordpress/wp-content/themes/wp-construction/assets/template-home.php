<?php //Template Name: Home
get_header();
if(get_theme_mod('slider_home','1')=="1"){
	get_template_part('assets/home','slider');
}
if(get_theme_mod('blog_home','1')=="1"){
get_template_part('assets/home','blog');
}
get_footer();
?>