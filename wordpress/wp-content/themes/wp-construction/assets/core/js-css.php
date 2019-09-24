<?php // Included CSS and JS file 
function wp_construction_theme_name_scripts() {
  // css files
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'wp_construction_Google_Fonts1', '//fonts.googleapis.com/css?family=Montserrat:400,700');
  wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/assets/css/bootstrap.min.css');
  wp_enqueue_style( 'wp_construction_mediaquery', get_template_directory_uri().'/assets/css/mediaquery.css'); 
  wp_enqueue_style( 'wp_construction_font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.css' );
  wp_enqueue_style( 'wp_construction_animate', get_template_directory_uri().'/assets/css/animate.css' );
  wp_enqueue_style( 'jquery-slicebox', get_template_directory_uri().'/assets/css/slicebox.css' ); 
  wp_enqueue_style( 'wp_construction_simplelightbox', get_template_directory_uri().'/assets/css/simplelightbox.css' ); 
  wp_enqueue_style( 'wp_construction_aboutus_style', get_template_directory_uri().'/assets/css/aboutus_style.css' );   

  // js files
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri().'/js/bootstrap.js' ); 
  wp_enqueue_script( 'jquery-slicebox-js', get_template_directory_uri().'/js/jquery.slicebox.js' ); 
  wp_enqueue_script( 'wp_construction_wow', get_template_directory_uri().'/js/wow.js' );
  wp_enqueue_script( 'wp_construction_mordermizr', get_template_directory_uri().'/js/modernizr.custom.79639.js' ); 
  wp_enqueue_script( 'jquery-ba-cond', get_template_directory_uri().'/js/jquery.ba-cond.min.js' );  
}
add_action( 'wp_enqueue_scripts', 'wp_construction_theme_name_scripts' );

add_action('wp_footer', 'wp_construction_footer_js');
function wp_construction_footer_js() {
	wp_enqueue_script( 'jquery-isotope', get_template_directory_uri().'/js/jquery.slitslider.js' );
	wp_enqueue_script( 'wp_construction_lightbox', get_template_directory_uri().'/js/simple-lightbox.js' );
	wp_enqueue_script( 'wp_construction_custom', get_template_directory_uri().'/js/custom.js' );	
}
?>