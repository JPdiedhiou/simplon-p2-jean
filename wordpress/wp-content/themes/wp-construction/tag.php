<?php 
/**
 * The template for displaying Tags Posts
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
			<h3><?php $title = '<span>' . the_archive_title( '', false ) . '</span>'; echo esc_html($title); ?></h3> 
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