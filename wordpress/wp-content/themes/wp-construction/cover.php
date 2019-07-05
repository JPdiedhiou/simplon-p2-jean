<div class="page-heading" style="background-image:url('<?php echo esc_url( get_header_image() ); ?>')">
	<div class="page-heading-inner">
		<div class="container">
		<div class="col-md-6">
			<?php if(is_home()) { ?>
			<h3><?php single_post_title(); ?></h3>
			<?php }else{ ?>
			<h3 class="text-uppercase"><?php the_title(); ?> </h3> <?php } ?>
		</div>
		</div>
	</div>
</div>