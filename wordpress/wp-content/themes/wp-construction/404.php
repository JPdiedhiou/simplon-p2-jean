<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
get_header(); ?>
<div class="page-heading" style="background-image:url('<?php echo esc_url( get_header_image() ); ?>')">
	<div class="page-heading-inner" >
        <div class="page-heading-inner">
    		<div class="container">
    		<div class="col-md-6">
    			<h3 class="error_title"><?php esc_html_e('404 Error - Page Not Found','wp-construction'); ?></h3>
    		</div>
    		</div>
        </div>
	</div>
</div>
<div class="">
    <div class="clearfix blog-content error-page">
        <div class="col-md-6">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/404 ERROR2.png" alt="digger" class="img-responsive" />
        </div>
        <div class="col-md-6">
            <h2><?php esc_html_e('404','wp-construction'); ?></h2>
            <span><?php esc_html_e('PAGE NOT FOUND','wp-construction'); ?></span>
            <p><?php esc_html_e('The page you are looking for is not available','wp-construction'); ?></p>
            <a href="<?php echo esc_url(home_url()); ?>" class="readmore-2"><?php esc_html_e('Go To Home Page','wp-construction'); ?></a>
        </div>
    </div>
</div>
<?php  get_footer(); ?>

