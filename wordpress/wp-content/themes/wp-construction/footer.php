<?php /**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
?>
 <div class="construction-footer footer-1">
        <div class="footer-background"></div>
        <div class="footer-box">
            <div class="container">
            	<div class="footer_widget_area">
            		<div class="col-md-4 col-sm-6">
            			<?php if ( is_active_sidebar( 'footer-widget-area1' ) ){ dynamic_sidebar( 'footer-widget-area1' ); } ?>
            		</div>
                	<div class="col-md-4 col-sm-6">
						<?php if ( is_active_sidebar( 'footer-widget-area2' ) ){ dynamic_sidebar( 'footer-widget-area2' ); } ?>
					</div>
					<div class="col-md-4 col-sm-6">
						<?php if ( is_active_sidebar( 'footer-widget-area3' ) ){ dynamic_sidebar( 'footer-widget-area3' ); } ?>	
					</div>
                <div class="footer-bottom-border col-md-12"></div>
                <div class="clearfix"></div>
                </div>
                <div class="col-md-12 ">
                <div class="copyright text-center">
                    <p class=""><i class="fa fa-copyright"></i> <?php echo esc_html(get_theme_mod('construction_footer_customization','Powered by WordPress'),'wp-construction'); ?> <i class="fa fa-heart"></i><a href="<?php echo esc_url(get_theme_mod('construction_deve_link','')); ?>"> <?php echo esc_html(get_theme_mod('construction_develop_by',''),'wp-construction'); ?></a></p>
                    <?php if(get_theme_mod('footer_social')){ ?>
                    <ul class="cont-socia-linkl">
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
				 </div>		
			  </div>
            </div>
        </div>
      </div>
        <!--constructionfooter row-->
        <progress value="0"></progress>
        <div id="scroll-up">
            <a href="#" title="Go Top" class="construction_scrollup" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
        </div>
        <?php wp_footer(); ?>	
	</body>
</html>