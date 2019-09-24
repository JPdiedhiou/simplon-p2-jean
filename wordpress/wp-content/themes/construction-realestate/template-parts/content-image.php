<?php
/**
 * The template part for displaying image post
 * @package Construction Realestate
 * @subpackage construction_realestate
 * @since 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>    
  <h3 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>
  <i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
  <div class="box-image">
    <?php 
      if(has_post_thumbnail()) { 
        the_post_thumbnail(); 
      }
    ?>
  </div>
  <div class="new-text">
    <?php the_excerpt();?>
  </div>  
  <div class="cat-box">
    <i class="fas fa-folder-open"></i>
    <?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?>
  </div>
  <div class="clearfix"></div>
</div>