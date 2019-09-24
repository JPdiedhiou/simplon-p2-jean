<?php
/**
 * The template part for displaying slider
 *
 * @package Logistic Transport
 * @subpackage logistic_transport
 * @since Logistic Transport 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="services-box">    
    <div class="service-image">
      <?php
        if ( ! is_single() ) {

          // If not a single post, highlight the audio file.
          if ( ! empty( $audio ) ) {
            foreach ( $audio as $audio_html ) {
              echo '<div class="entry-audio">';
                echo $audio_html;
              echo '</div><!-- .entry-audio -->';
            }
          };

        };
      ?>
    </div>
    <h2><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <div class="lower-box">
      <div class="metabox">
        <i class="fas fa-user"></i><span class="entry-author"> <?php the_author(); ?></span>
        <i class="fas fa-comments"></i><span class="entry-comments"> <?php comments_number( __('0 Comments','logistic-transport'), __('0 Comments','logistic-transport'), __('% Comments','logistic-transport') ); ?></span>
      </div>
      <p><?php the_excerpt();?></p>
      <div class="read-btn">
        <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'logistic-transport' ); ?>"><?php esc_html_e('Read More','logistic-transport'); ?>
        </a>
      </div>
    </div>
  </div>
  <hr>
</div>