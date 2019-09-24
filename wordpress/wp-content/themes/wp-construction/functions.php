<?php 
/**
 * Wp-Construction functions and definitions
 *
 * 
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
require( get_template_directory() . '/assets/core/js-css.php' );
require( get_template_directory() . '/assets/core/custom/menu/construction_nav_walker.php' );
require( get_template_directory() . '/assets/core/custom/menu/default_menu_walker.php' );
require( get_template_directory() . '/assets/core/construction_comment.php' ); 
require( get_template_directory() . '/customizer.php' );   

/* widgets */
require( get_template_directory() . '/assets/core/custom/construction_recent_post.php' );
require( get_template_directory() . '/assets/core/custom/construction_follow.php' ); 

/*After Theme Setup*/
  add_action( 'after_setup_theme', 'wp_construction_head_setup' );   
  function wp_construction_head_setup()
  {
    // Load text domain for translation-ready
    load_theme_textdomain( 'construction', get_template_directory() . '/lang' );
  	/* for Woocommerce */
  	add_theme_support( 'woocommerce' );
  	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' ); //supports featured image
    $args = array('default-color' => '000000',);
    add_theme_support( 'custom-background', $args); 
    add_theme_support( 'customize-selective-refresh-widgets' );
    $defaults = array(
    'default-image'          => get_template_directory_uri().'/assets/img/pageheading.jpg',
    'flex-height'            => true,
    'flex-width'             => true,
    'uploads'                => true,
    'random-default'         => true,
    'header-text'            => true,
    'default-text-color'     => '#fff',
    'wp-head-callback'       => 'wp_construction_header_style',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
    );
	add_theme_support( 'custom-header', $defaults );
  
	add_theme_support( 'custom-logo', array(
						'height'      => 110,
						'width'       => 250,
						'flex-height' => true,
						'flex-width'  => true,
	) );
					
	add_image_size( 'wp-construction_blog_image', 570, 321 );
    add_theme_support( 'automatic-feed-links');
    add_theme_support( 'html5', array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) ); 
    /* for Menu */
    register_nav_menu( 'primary', __( 'Primary Menu', 'wp-construction' ) );   
  }

  add_action( 'widgets_init', 'wp_construction_widgets_init');
  function wp_construction_widgets_init() {
  /*sidebar*/
  register_sidebar( array(
      'name' => __( 'Sidebar', 'wp-construction' ),
      'id' => 'sidebar-primary',
      'description' => __( 'The primary widget area', 'wp-construction' ),
      'before_widget' => '<div id="%1$s" class="side-block %2$s">', 
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="side-heading">',
      'after_title'   => '</h4>',
    ) );
  register_sidebar( array(
      'name' => __( 'Footer Widget Area One', 'wp-construction' ),
      'id' => 'footer-widget-area1',
      'description' => __( 'footer widget area', 'wp-construction' ),
      'before_widget' => '<div class="footer-inner"><div id="%1$s" class="newserafooter_widget %2$s">',
      'after_widget' => '</div></div>',
      'before_title' => '<div class="col-md-12 footer-heading"><h3 class="wedgets-heading">',
      'after_title' => '</h3></div>',
    ) ); 
     register_sidebar( array(
      'name' => __( 'Footer Widget Area Two', 'wp-construction' ),
      'id' => 'footer-widget-area2',
      'before_widget' => '<div class="footer-inner"><div id="%1$s" class="newserafooter_widget %2$s">',
      'after_widget' => '</div></div>',
      'before_title' => '<div class="col-md-12 footer-heading"><h3 class="wedgets-heading">',
      'after_title' => '</h3></div>',
    ) ); 
     register_sidebar( array(
      'name' => __( 'Footer Widget Area Three', 'wp-construction' ),
      'id' => 'footer-widget-area3',
      'description' => __( 'footer widget area', 'wp-construction' ),
      'before_widget' => '<div class="footer-inner"><div id="%1$s" class="newserafooter_widget %2$s">',
      'after_widget' => '</div></div>',
      'before_title' => '<div class="col-md-12 footer-heading"><h3 class="wedgets-heading">',
      'after_title' => '</h3></div>',
    ) );           
  }
  
if ( ! function_exists( 'wp_construction_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see beautyspa_custom_header_setup().
 */
function wp_construction_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		span.site-title {
			position:absolute;
			clip: rect(1px 1px 1px 1px);
		}
		.logobrand-desktop p{
			position:absolute;
			clip: rect(1px 1px 1px 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		span.site-title, .logobrand-desktop p {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

function wp_construction_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Montserrat:400,700' );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'wp_construction_add_editor_styles' );

//comment-reply js //
function wp_construction_enqueue_comments_reply() {

    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        // Load comment-reply.js (into footer)
        wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
    }
}
add_action(  'wp_enqueue_scripts', 'wp_construction_enqueue_comments_reply' );

if ( ! isset( $content_width ) ) $content_width = 900;

if (!function_exists('wp_construction_category_Control')):
/**
 * Get all Categories
 */
function wp_construction_category_Control() {
    $args = array('fields' => 'ids');
    $categories = get_categories();
    $categories_list = array(
        '' => esc_html__('Select Category', 'wp-construction')
    );
    foreach ($categories as $category) {
        $categories_list['' . $category->term_id . ''] = $category->name;
    }
    return $categories_list;
}
endif;

if (is_admin()) {
	require_once('assets/core/admin/admin-themes.php');
}


/* Notice dismissable */

if ( is_admin() && isset($_GET['activated'])  && $pagenow == "themes.php" ) {
	add_action( 'admin_notices', 'construct_activation_notice' );
}
add_action( 'admin_notices', 'construct_activation_notice' );
function construct_activation_notice(){
	wp_enqueue_style('construct-font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('admin',  get_template_directory_uri() .'/assets/core/admin/admin-themes.css');
	$wl_th_info = wp_get_theme(); 
	$currentversion = str_replace('.','',(esc_html( $wl_th_info->get('Version') )));
	$isitdismissed = 'construct_notice_dismissed'.$currentversion;
	if ( !get_user_meta( get_current_user_id() , $isitdismissed ) ) { ?>
			<!---our-product-features--->	 
		<div class="notice notice-success">					
		<p class="notice-text">
		<?php $theme_info = wp_get_theme();
			  printf( esc_html__('Thank you for installing %1$s ¬ Version %2$s ,', 'wp-construction'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) );		
			  echo esc_html__( 'For More info  about Premium Products & offers, Do visit our welcome page.', 'wp-construction' ); ?>
		</p>
		<p class="notic-gif"><a class="pro" target="_self" href="<?php echo admin_url('/themes.php?page=wp-construction') ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/wlcm.gif"></a></p>
		<a class="dismiss" href="?-notice-dismissed<?php echo $currentversion;?>"><i class="fa fa-times" ></i></strong></a>
		</div>	
<?php } } 
function construct_notice_dismissed() {
	$wl_th_info = wp_get_theme(); 
	$currentversion = str_replace('.','',(esc_html( $wl_th_info->get('Version') )));
	$dismissurl = '-notice-dismissed'.$currentversion;
	$isitdismissed = 'construct_notice_dismissed'.$currentversion;
    $user_id = get_current_user_id();
    if ( isset( $_GET[$dismissurl] ) )
        add_user_meta( $user_id, $isitdismissed, 'true', true );
}
add_action( 'admin_init', 'construct_notice_dismissed' );
?>