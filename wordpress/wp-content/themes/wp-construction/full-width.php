<?php //Template Name: Full Width
get_header(); 
get_template_part('cover'); ?>
<!--blog-->
<div id="blog-full" class="container-fluid blog-full">
	<div class="container construction-common-block-space">
		<?php if( have_posts()) : while ( have_posts() ) : the_post(); ?>
		<div id="blog-half">
			<div class="col-md-12 col-xm-12">
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
							<?php the_content(); ?>
						</div>	
					</div>		
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
	</div>
</div>
<?php  get_footer(); ?>