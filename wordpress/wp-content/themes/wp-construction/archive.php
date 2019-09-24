<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
 get_header(); ?>
<div class="page-heading" style="background-image:url('<?php echo esc_url( get_header_image() ); ?>')">
	<div class="page-heading-inner" >
			<div class="container">
			<div class="col-md-3">
				<?php if(have_posts()) { ?>
				<h3><?php if ( is_day() ) : 
					 esc_html_e( 'Daily Archives:', 'wp-construction' ) ?> <span> <?php echo esc_html(get_the_date()); ?></span> 
				<?php elseif ( is_month() ) : 
					 esc_html_e( 'Monthly Archives:', 'wp-construction' ) ?> <span> <?php echo esc_html(get_the_date( _x( 'F Y', 'monthly archives date format', 'wp-construction' ))); ?></span>
				<?php elseif ( is_year() ) : 
					 esc_html_e( 'Yearly Archives:', 'wp-construction' ) ?> <span> <?php echo esc_html(get_the_date( _x( 'Y', 'yearly archives date format', 'wp-construction' ))); ?></span>
				<?php else :
					esc_html_e( 'Archives', 'wp-construction' );
				endif; ?></h3>
				<?php }else{ ?>
				<h3><?php esc_html(the_archive_title()); ?> </h3> <?php } ?> 
			</div>
			</div>
	</div>
</div>
<!--blog-->
<div class="container-fluid">
	<div class="container">
		<div id="blog-half">
			<div class="col-md-8" id="post-<?php the_ID(); ?>">
				<?php if(have_posts()):
				while(have_posts()): the_post();
				get_template_part('post','content');
				endwhile; endif; ?>
					<div class="construction-pagination">
					<?php echo esc_html(the_posts_pagination( array( 'mid_size' => 2 ) )); ?>
					<div class="clearfix"></div>
					</div>
			</div>		
		<?php get_sidebar(); ?>	
		</div>	
	</div>
</div>
<?php get_footer(); ?>