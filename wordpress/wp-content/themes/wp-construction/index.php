<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
get_header(); 
get_template_part('cover'); ?>
<div class="container-fluid">
	<div class="container">
		<div id="blog-half">
			<div class="col-md-8" id="post-<?php the_ID(); ?>">
				    <?php if(have_posts()): while(have_posts()): the_post(); get_template_part('post','content'); endwhile; endif; ?>
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