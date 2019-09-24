<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php do_action( 'construction_realestate_above_slider' ); ?>

<?php /** slider section **/ ?>
<?php if( get_theme_mod('construction_realestate_slider_hide_show') != ''){ ?>
 <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $pages = array();
            for ( $count = 1; $count <=3; $count++ ) {
              $mod = intval( get_theme_mod( 'construction_realestate_slider' . $count ));
              if ( 'page-none-selected' != $mod ) {
                $pages[] = $mod;
              }
            }
            if( !empty($pages) ) :
            $args = array(
                'post_type' => 'page',
                'post__in' => $pages,
                'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
            <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                      <h2><?php the_title();?></h2>
                      <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_realestate_string_limit_words( $excerpt,20 ) ); ?></p> 
                  </div>
                  <div class="slide-button">
                    <a class="read-more" href="<?php echo esc_url( get_permalink() );?>"><?php esc_html_e( 'Know More','construction-realestate' ); ?></a>
                  </div> 
                </div>
            </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="far fa-arrow-alt-circle-left"></i></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="far fa-arrow-alt-circle-right"></i></span>
        </a>
      </div>  
      <div class="clearfix"></div>
 </section> 
<?php }?>

<?php do_action( 'construction_realestate_below_slider' ); ?>

<?php /** About Us section **/ ?>
<?php if( get_theme_mod('construction_realestate_sec_title') != '' || get_theme_mod( 'construction_realestate_about_post_setting' )!= ''){ ?>
  <section id="about">
    <div class="container">
      <?php if( get_theme_mod('construction_realestate_sec_title') != ''){ ?>
        <h3><?php echo esc_html(get_theme_mod('construction_realestate_sec_title','')); ?></h3>
      <?php }?>
      <?php
      $postData =  get_theme_mod('construction_realestate_about_post_setting');
          if($postData){
            $args = array( 'name' => esc_html($postData ,'construction-realestate'));
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="mainbox">
            <h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title();?></a></h4>
            <p><?php the_excerpt(); ?></p>
            <div class="clearfix"></div>
          </div>
        <?php endwhile; 
        wp_reset_postdata();?>
        <?php else : ?>
           <div class="no-postfound"></div>
         <?php
        endif;} ?>
        <div class="clearfix"></div>
    </div> 
  </section>
<?php }?>

<?php do_action( 'construction_realestate_below_about' ); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>