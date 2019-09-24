<?php get_header(); ?>
<div class="page-heading">
	<div class="page-heading-inner">
		<div class="container">
		<div class="col-md-3">
			<h3><?php global $wp; $current_url = (add_query_arg(array(),$wp->request)); echo esc_html($current_url); ?></h3> 
		</div>
		<div class="col-md-5 pull-right">
			<?php woocommerce_breadcrumb(); ?>
		</div>
		</div>
	</div>
</div>
<!--blog-->
<div class="container-fluid">
	<div class="container">
		<div id="blog-half" class="woocommerce_content_single_page">
			<div class="col-md-12" id="post-<?php the_ID(); ?>">
				<?php woocommerce_content(); ?>
			</div>		
		</div>	
	</div>
</div>
<?php get_footer(); ?>