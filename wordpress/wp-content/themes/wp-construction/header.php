<?php 
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
?>
<!DOCTYPE html>
 <!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />
        <meta charset="UTF-8"> 
        <?php wp_head(); ?>
    </head>
    <body <?php if(get_theme_mod('construction_box_layout')!= '1') { body_class('boxed'); } else body_class(); ?> >
        <div class="skin_layout_div">
<header>
<div id="header-1" class="construction-header-section">
            <div class="constuction-header collapse navbar-collapse" id="add" >              
                <div class="line container">
				<div class="col-md-12">
                  <?php if(get_theme_mod('construction_phone')!='') { ?>
                    <div class="col-lg-3 col-md-4">
                        <div class="constuction-header-box construction_phone">
                            <i class="fa fa-volume-control-phone"></i>&nbsp;
                            <span><?php echo esc_html(get_theme_mod('construction_phone')); ?></span>
                        </div>
                    </div>
                    <?php } if(get_theme_mod('construction_address')!='') { ?>
                    <div class="col-lg-6 col-md-4">
                        <div class="constuction-header-box construction_address">
                            <i class="fa fa-location-arrow"></i>&nbsp;
                            <span><?php echo esc_html(get_theme_mod('construction_address')); ?></span>
                        </div>
                    </div>
                    <?php } if(get_theme_mod('construction_email')!='') { ?>
                    <div class="col-lg-3 col-md-4 ">
                        <div class="constuction-header-box construction_email">
                            <i class="fa fa-envelope-o"></i>&nbsp;
                            <span><?php echo esc_html(get_theme_mod('construction_email')); ?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>         
                </div>         
                <div class="constuction-header-block-2">
                    <div class="container" >
					<div class="col-md-12">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 " >
                    
                            <div class="logobrand-desktop">
                              <?php 
							  $custom_logo_id = get_theme_mod( 'custom_logo' );
							  $image = wp_get_attachment_image_src( $custom_logo_id,'full' ); 
							  if(has_custom_logo()) { ?>
                              <a class="mynavbar-brand logoo" href="<?php echo esc_url(home_url()); ?>">
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>" class="my"
                                style="height: <?php echo esc_attr(get_theme_mod('construction_logo_heigth','102')); ?>px;
                                width: <?php echo esc_attr(get_theme_mod('construction_logo_width','230')); ?>px; " />
                              </a> 
                              <?php }else{ ?>
                              <a class="mynavbar-brand" href="<?php echo esc_url(home_url()); ?>">
                                <span class="site-title"><?php echo esc_html(get_bloginfo('name')); ?></span>
                                <p><?php echo esc_html(bloginfo('description')); ?></p>
                              </a>
                              <?php } ?>
                              </div>                      
                        </div>                      
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 header-social" >
                            <!-- <a href="#" id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Login <i class="fa fa-sign-in"></i></a> -->
                            <?php if(get_theme_mod('header_social')){ ?>
                            <ul class="social-icons">
                                <?php if(get_theme_mod('twitter_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('twitter_link')); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php } if(get_theme_mod('facebook_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('facebook_link')); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php } if(get_theme_mod('linkedin_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('linkedin_link')); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php } if(get_theme_mod('youtube_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('youtube_link')); ?>"><i class="fa fa-youtube"></i></a></li>
                                <?php } if(get_theme_mod('google_plus')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('google_plus')); ?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php } if(get_theme_mod('rss_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('rss_link')); ?>"><i class="fa fa-rss"></i></a></li>
                                <?php } if(get_theme_mod('flicker_link')) { ?>
                                <li><a href="<?php echo esc_url(get_theme_mod('flicker_link')); ?>"><i class="fa fa-flickr"></i></a></li>
                                <?php } ?>                             
                            </ul>
                            <?php } ?>
                            <!-- <a href="#" class="cart"><i class="fa fa-shopping-cart"></i><span class="super">1</span></a> -->
                        </div>
                        <?php if(get_theme_mod('construction_search_box')!=''){ ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 home_toop_search">
                            <?php ?>
                            <?php get_template_part('searchform');
                             ?>        
                        </div> 
                        <?php } ?> 
                    </div>
                    </div>
                </div>  
                <?php  ?>          
                <div class="clearfix"></div>
            </div>          
<nav class="navbar navbar-default menu " <?php if(get_theme_mod('construction_sticky_head','1')==1){ ?> data-spy="affix" data-offset-top="195" <?php } ?>>
    <div class="text-center"><button type="button" class="navbar-toggle add_toggle" data-toggle="collapse" data-target="#add">
        <span>      
        </span>
    </button></div>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only"><?php esc_html_e('Toggle navigation','wp-construction'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>     
      <div class="logobrand-mobile">
          <?php 
		  $custom_logo_id = get_theme_mod( 'custom_logo' );
		  $image = wp_get_attachment_image_src( $custom_logo_id,'full' );
		  if(has_custom_logo()) { ?>
          <a class="mynavbar-brand logoo" href="<?php echo esc_url(home_url()); ?>">
            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" class="my"
            style="height: <?php echo esc_attr(get_theme_mod('construction_logo_heigth','102')); ?>px;
            width: <?php echo esc_attr(get_theme_mod('construction_logo_width','230')); ?>px; " />
          </a> 
          <?php }else{ ?>
          <a class="mynavbar-brand" href="<?php echo esc_url(home_url()); ?>">
            <span class="site-title"><?php echo esc_html(get_bloginfo('name')); ?></span>
            <p><?php echo esc_html(bloginfo('description')); ?></p>
          </a>
          <?php } ?>    
      </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_class' => 'nav navbar-nav navbar-right',
          'fallback_cb' => 'wp_construction_fallback_page_menu',
          'walker' => new wp_construction_nav_walker(),
          )
          );  ?>
    </div><!-- /.navbar-collapse --> </div>
  </div><!-- /.container-fluid -->
</nav>
</div>
</header>       
<!--</div>--><!--container fluid-->