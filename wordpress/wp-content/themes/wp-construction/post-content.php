	<div class="clearfix blog-content <?php post_class(); ?>">
		<div class="col-md-12">				
			<a href="<?php esc_url(the_permalink());  ?>"><h3><?php the_title(); ?></h3>	</a>					
		</div>
		<div class="col-md-12">
		<div class="blog-image gallery">
			<?php $data= array('class' =>'img-responsive '); the_post_thumbnail('', $data); ?>
			<div class="blog-overlay">
				<div class="post-date">
					<?php echo esc_html(get_the_date()); ?>
				</div>
				<div class="post-by">
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php esc_html(the_author()); ?></a>
					<a href="<?php esc_url(the_permalink()); ?>">
					<i class="fa fa-wechat" aria-hidden="true"></i>&nbsp; 
					<?php $pid = get_the_ID(); $args = array('post_id' => $pid,'count' => true ); $comments = get_comments($args); esc_html($comments); ?> <?php esc_html_e('Comments','wp-construction'); ?></a>
				</div>
				<div class="post-view">
					<a href="<?php esc_url(the_permalink());  ?>" class="big"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="<?php esc_url(the_post_thumbnail_url()); ?>" class="big_light_box"><i class="fa fa-search" aria-hidden="true"></i></a>
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
			<?php } the_excerpt(); 
			    wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'wp-construction'),
                    'after' => '</div>',
                )); ?>
			<a class="readmore" href="<?php esc_url(the_permalink());  ?>"><?php esc_html_e('Read More','wp-construction'); ?></a>	
		</div>			
	</div>