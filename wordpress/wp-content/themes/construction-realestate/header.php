<?php
/**
 * The Header for our theme.
 * @package Construction Realestate
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'construction-realestate' ) ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="header">
  <div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','construction-realestate'); ?></a></div>
  <div class="top_headbar">
    <div class="socialbox">
      <?php if( get_theme_mod( 'construction_realestate_cont_facebook') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_facebook','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'construction_realestate_cont_twitter' ) != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_twitter','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'construction_realestate_google_plus') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_google_plus','' ) ); ?>"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'construction_realestate_pinterest') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_pinterest','' ) ); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_tumblr','' ) ); ?>"><i class="fab fa-tumblr" aria-hidden="true"></i></a>
      <?php } ?>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 logo_bar">
        <div class="logo">
          <?php if( has_custom_logo() ){ construction_realestate_the_custom_logo();
             }else{ ?>
            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?> 
              <p class="site-description"><?php echo esc_html($description); ?></p>       
          <?php endif; }?>       
        </div>     
      </div>
      <div class="col-lg-8 col-md-8 row contact">
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'construction_realestate_location','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-4 p-0">
                <img src="<?php echo esc_attr( get_template_directory_uri()) ?>/images/Location-Icon.png" alt="">
              </div>
              <div class="col-lg-10 col-md-8 p-0">
                <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_location','') ); ?></p>
                <p><?php echo esc_html( get_theme_mod('construction_realestate_location1','') ); ?></p>         
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'construction_realestate_time','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-4 p-0">
                <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Time-Icon.png" alt="">
              </div>
              <div class="col-lg-10 col-md-8 p-0">              
                <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_time','') ); ?></p>
                <p><?php echo esc_html( get_theme_mod('construction_realestate_time1','') ); ?></p>             
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'construction_realestate_number','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-4 p-0">
                <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Call-Icon.png" alt="">
              </div>
              <div class="col-lg-10 col-md-8 p-0">            
                <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?></p>
                <p><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?></p>        
              </div>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>

  <div class="menus">
    <div class="menubox header container">
      <div class="nav">
       <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
      </div>
    </div>
  </div>
</div><?php /** header **/ ?>