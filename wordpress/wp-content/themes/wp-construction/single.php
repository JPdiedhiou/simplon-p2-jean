<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */

get_header(); 
get_template_part('cover'); ?>
<!--blog-->
<div class="container-fluid">
	<div class="container">
		<div id="blog-half">
			<?php if ( have_posts()) : while ( have_posts() ) : the_post(); ?>
			<div class="col-md-8">
				<div class="clearfix blog-content"  <?php post_class(); ?>>
					<?php $current_pid = get_the_ID(); ?>
					<div class="col-md-12">				
						<h3><?php the_title(); ?></h3>						
					</div>
					<div class="col-md-12">
					<div class="blog-image gallery">
						<?php $data= array('class' =>'img-responsive ');
										the_post_thumbnail('', $data); ?>
						<div class="blog-overlay">
							<div class="post-date">
								<?php echo esc_html(get_the_date()); ?>
							</div>
							<div class="post-by">
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php esc_html(the_author()); ?></a>
								<a href="#"><i class="fa fa-wechat" aria-hidden="true"></i>&nbsp; 
								<?php $pid = get_the_ID(); $args = array('post_id' => $pid,'count' => true ); $comments = get_comments($args); echo esc_html($comments); ?><?php esc_html_e('Comments','wp-construction'); ?></a>
							</div>
							<div class="post-view">
								<a href="<?php echo esc_url(the_permalink()); ?>" class="big"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="<?php echo esc_url(the_post_thumbnail_url()); ?>" class="big_light_box"><i class="fa fa-search" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>	
						<?php if(get_the_tag_list() != '') { ?>			
							<div class="tags">
								<span>
									<?php esc_html_e('TAGS:','wp-construction'); ?>
								</span>
								<?php the_tags( '<ul><li> <li>', '</li><li>', '</li></ul>' ); ?>
							</div>
						<?php } if(get_the_category_list() != ''){ ?>		
							<div class="categories">
								<span>
								<?php esc_html_e('CATEGORIES:','wp-construction'); ?>
								</span>
								<?php the_category(); ?>
							</div>	
						<?php } the_content(); ?>			
					</div>			
				</div>
				<div class="clear-fix"></div>
					<div class="row blog-single-btns">
						<div class="control-arrow construction-common-block-space col-sm-12">		
							<div class="col-sm-4  col-xs-6 pull-left">
								<?php previous_post_link( '%link', __( 'Previous Article', 'wp-construction' ), true ); ?>
							</div>
							<div class="col-sm-4 col-xs-6 pull-right">							
							<?php next_post_link( '%link', __( 'Next Article', 'wp-construction' ), true ); ?>
							</div>
						</div>
					</div>
					<?php  wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'wp-construction'),
                    'after' => '</div>',
					)); ?>
					<div class="clearfix"></div>
					
				<div class="side-block">
					<h4 class="side-heading"><?php esc_html_e('LATEST POSTS','wp-construction'); ?></h4>
					<div class="row">
					<?php $post_data= array('post_type' => 'post','posts_per_page'=> 4,'ignore_sticky_posts' => 1,'post__not_in' => array($current_pid)); 
					$post_data = new WP_Query( $post_data );
					if( $post_data->have_posts() ){  $count=1;
					while ( $post_data->have_posts() ) : $post_data->the_post(); ?>
						<div class="col-sm-6 latest-post ">
							<div class="time">
								<a href="#">
									<span class="month"><?php echo esc_html(get_the_date( 'M' )); ?></span>
									<span class="date"><?php echo esc_html(get_the_date( 'd' )); ?></span>
								</a>
							</div>
							<div class="media-body">
								<h4><b><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></b></h4>
								<?php the_excerpt();  ?>
							</div>
						</div>
					<?php if($count%2==0){ echo '<div class="col-md-12 col-sm-12 col-xs-12 "></div>'; }  $count++; endwhile; } wp_reset_postdata(); ?>
					</div>
				</div>
			<!-- comments box -->
			<?php comments_template( '', true ); ?>
			</div>		
	  <?php get_sidebar(); endwhile; endif; ?>		
		</div>	
	</div>
</div>
<?php  get_footer(); ?>