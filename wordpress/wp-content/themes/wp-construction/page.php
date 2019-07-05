<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
<!--blog-->
<div id="blog-full" class="container-fluid blog-full">
	<div class="container construction-common-block-space">
		<?php if( have_posts()) : while ( have_posts() ) : the_post(); ?>
		<div id="blog-half">
			<div class="col-md-8">
				<div class="clearfix blog-content">
					<div class="col-md-12">				
						<h3><?php the_title(); ?></h3>						
					</div>
					<div class="col-md-12">
						<div class="blog-image">
							<?php $data= array('class' =>'img-responsive ');
							the_post_thumbnail('', $data); ?>
						</div>								
					</div>	
					<div class="col-md-12">
						<div class="page_content-single tags">
							<?php the_content(); 
							wp_link_pages(array(
								'before' => '<div class="page-links">' . esc_html__('Pages:', 'wp-construction'),
								'after' => '</div>',
							)); ?>
						</div>	
					</div>		
				</div>
			</div>
		</div>
	  <?php  get_sidebar(); ?>
	<?php endwhile; endif; ?>
	</div>
</div>
<?php  get_footer(); ?>