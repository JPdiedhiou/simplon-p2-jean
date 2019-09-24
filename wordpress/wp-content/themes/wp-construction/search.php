<?php 
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
  get_header(); ?>
<div class="page-heading" style="background-image:url('<?php echo esc_url( get_header_image() ); ?>')">
	<div class="page-heading-inner">
			<div class="container">
			<div class="col-md-3">
			<?php if(have_posts()) { ?>
			<h3><?php esc_html_e( 'Search Results for:', 'wp-construction' ); ?>
			<span><?php echo esc_html(get_search_query()); ?></span></h3>
			<?php } else { ?>
			<h3><?php the_title(); ?> </h3> <?php } ?>
			</div>
			<?php rewind_posts(); ?>
			</div>
	</div>
</div>
<!--blog-->
<div class="container-fluid">
	<div class="container">
		<div id="blog-half">
			<div class="col-md-8" id="post-<?php the_ID(); ?>">
				<?php if(have_posts()){
				while(have_posts()): the_post();
				if(get_post_type(get_the_ID())=='post')
				{
				get_template_part('searchpost');
				}
				if(get_post_type(get_the_ID())=='page')
				{ ?>
				<div class="clearfix blog-content">
					<div class="col-md-12">				
						<a href="<?php esc_url(the_permalink()); ?>"><h3><?php the_title(); ?></h3></a>						
					</div>
					<div class="col-md-12">
						<div class="blog-image">
							<?php $data= array('class' =>'img-responsive ');
							the_post_thumbnail('', $data); ?>
						</div>								
					</div>	
					<div class="col-md-12">
						<div class="page_content-single tags">
							<?php the_excerpt(); ?>
						</div>	
					</div>		
				</div>
				<?php } endwhile; } else { ?>
				<div class="col-md-12 no-content-found">
					<p><?php esc_html_e('No Content Found','wp-construction'); ?></p>
				</div>
				<?php } ?>
				<div class="construction-pagination">
					<?php echo esc_html(the_posts_pagination( array( 'mid_size' => 2 ) )); ?>
					<div class="clearfix"></div>
				</div>
			</div>		
		<?php get_sidebar(); ?>	
		</div>	
	</div>
</div>
<?php  get_footer(); ?>