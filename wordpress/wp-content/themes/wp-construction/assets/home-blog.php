<!--Latest Blog-->
<div id="blog1" <?php if(get_theme_mod('slider_home')!="1") { ?> style="padding-top:166px !important;" <?php } ?>>
<div class="container-fluid construction-lb">	
	<div class="container construction-common-block-space <?php if(!get_theme_mod('slider_home')){ ?>no_slider<?php } ?>">
		<div class="row">
		<div class="col-md-12 construction-common-block-desc">
			<div class="block-heading">
				<h1><?php echo esc_html(get_theme_mod('construction_blog_title','Our Blogs')); ?></h1>
				<p><?php echo esc_html(get_theme_mod('construction_blog_desc','Lorem Ipsum is simply dummy text of the printing and typesetting industry.')); ?></p>
			</div>				
		</div>
		<div class="clearfix construction-lb-block load_more_blogs">
			<?php 
			$post_data= array('post_type' => 'post','posts_per_page'=>get_theme_mod('construction_blog_no'),'post__not_in' => get_option( 'sticky_posts' ),'cat'=>get_theme_mod('construction_blog_cat')); 
            $post_data = new WP_Query( $post_data );
            if( $post_data->have_posts() ){ $count=1;
            while ( $post_data->have_posts() ) : $post_data->the_post(); ?>
			<div class="col-md-6 blog-content">
				<?php if(has_post_thumbnail() ){  $default=array('class' => "img-responsive "); the_post_thumbnail('wp-construction_blog_image',$default); } ?> 
				<span class="lb"></span>
				<div class="blog-inner" <?php if(has_post_thumbnail()==''){ echo 'style="margin-top: 40px;"'; } ?>>
					<h3><a href="<?php esc_url(the_permalink()); ?>" title=""><?php the_title(); ?></a></h3>
					<?php echo esc_html(substr(get_the_excerpt(),0,get_theme_mod('excerpt_blog',55))); ?>
					<a href="<?php esc_url(the_permalink()); ?>" class="blog-readmore"><?php esc_html_e('Read More','wp-construction'); ?></a>
				</div>
				<span class="rb"></span>
			</div>	
			<?php if($count%2==0){ echo '<div class="col-md-12 col-sm-12 col-xs-12 spacer_blog_div"></div>'; }  $count++; endwhile; } else { ?>
			<div class="col-md-6 blog-content">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/blog 1.png" class="img-responsive" alt="blog image" />
				<span class="lb"></span>
				<div class="blog-inner">
					<h3><?php esc_html_e('Construction Planning','wp-construction'); ?></h3>
					<p>
						<?php esc_html_e('The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.','wp-construction'); ?>						
					</p>
					<a href="#" class="blog-readmore"><?php esc_html_e('Read More','wp-construction'); ?></a>
				</div>
				<span class="rb"></span>
			</div>
			<div class="col-md-6 blog-content">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/blog 2.png" class="img-responsive" alt="blog image" />
				<span class="lb"></span>
				<div class="blog-inner">
					<h3><?php esc_html_e('Construction Planning','wp-construction'); ?></h3>
					<p>
						<?php esc_html_e('The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.','wp-construction'); ?>
					</p>
					<a href="#" class="blog-readmore"><?php esc_html_e('Read More','wp-construction'); ?></a>
				</div>
				<span class="rb"></span>
			</div>	
			<?php } ?>
		</div>
	</div>
	</div>
</div>
</div>