<!--Home slider 1-->
 <div id="slider-1" class="construction-carousel">
 	<?php if(get_theme_mod('construction_slide_image_1')!='' || get_theme_mod('construction_slide_image_2')!='' || get_theme_mod('construction_slide_image_3')!=''){ ?>
 		     <div id="slider" class="sl-slider-wrapper">
				<div class="sl-slider">	
					<?php $array=array('data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2"',
	                  	'data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5',
	                  	'data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1"');
	                $k = array_rand($array);
	                $v = $array[$k]; 	
	                $j='0';
	                for ($i=1; $i<4; $i++) { 
	                if(get_theme_mod('construction_slide_image_'.$i)){ $j++ ?>
					<div class="sl-slide" data-orientation="<?php if($i%2==0){ echo 'horizontal'; } else { echo 'vertical'; } ?>"  <?php echo esc_attr($v); ?>>
						<div class="sl-slide-inner">
							<div class="bg-img bg-img-<?php echo esc_attr($i); ?>" style="background-image: url(<?php echo esc_url(get_theme_mod('construction_slide_image_'.$i)); ?>);"></div>
							<div class="container slider-blockquote slider_<?php echo esc_attr($i); ?>">
								<?php if(get_theme_mod('construction_slide_title_'.$i)){ ?>
								<h2 class="title"><?php echo esc_html(get_theme_mod('construction_slide_title_'.$i)); ?></h2>
								<?php } if(get_theme_mod('slide_desc_'.$i)){ ?>
								<blockquote><p><?php echo esc_html(get_theme_mod('slide_desc_'.$i)); ?></p></blockquote>
								<?php } if(get_theme_mod('construction_slide_link_'.$i)){  ?>
								<div class="col-md-12 slider-btn-start">
									<a href="<?php echo esc_url(get_theme_mod('construction_slide_link_'.$i));  ?>" class="slider-btn"><?php echo esc_html(get_theme_mod('construction_buttun_text-'.$i)); ?></a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } } ?>				
				</div>
				<?php if($j>1){ ?>
				<nav id="nav-arrows" class="nav-arrows">
					<span class="nav-arrow-prev"><?php esc_html_e('Previous','wp-construction'); ?></span>
					<span class="nav-arrow-next"><?php esc_html_e('Next','wp-construction'); ?></span>
				</nav>
				<?php } ?>
			</div>
 		<?php }else{ ?>
	     <div id="slider" class="sl-slider-wrapper">
				<div class="sl-slider">					
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
						<div class="sl-slide-inner">
							<div class="bg-img bg-img-1"></div>
							<div class="container slider-blockquote">
								<h2><?php esc_html_e('A bene placito.','wp-construction'); ?></h2>
								<blockquote><p><?php esc_html_e('You have just dined, and however scrupulously the slaughterhouse is concealed in the graceful distance of miles, there is complicity.','wp-construction'); ?></p></blockquote>
								<div class="col-md-12 slider-btn-start">
									<a href="#" class="slider-btn"><?php esc_html_e('Read More','wp-construction'); ?></a>
								</div>
							</div>
						</div>
					</div>				
					<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
						<div class="sl-slide-inner">
							<div class="bg-img bg-img-2"></div>		
								<div class="container slider-blockquote">
									<h2><?php esc_html_e('A bene placito.','wp-construction'); ?></h2>
									<blockquote><p><?php esc_html_e('You have just dined, and however scrupulously the slaughterhouse is concealed in the graceful distance of miles, there is complicity.','wp-construction'); ?></p></blockquote>
									<div class="col-md-12 slider-btn-start">
									<a href="#" class="slider-btn"><?php esc_html_e('Read More','wp-construction'); ?></a>
								</div>
							</div>
						</div>
					</div>									
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
						<div class="sl-slide-inner">
							<div class="bg-img bg-img-3"></div>
							<div class="container slider-blockquote">
								<h2><?php esc_html_e('A bene placito.','wp-construction'); ?></h2>
								<blockquote><p><?php esc_html_e('You have just dined, and however scrupulously the slaughterhouse is concealed in the graceful distance of miles, there is complicity.','wp-construction'); ?></p></blockquote>
								<div class="col-md-12 slider-btn-start">
									<a href="#" class="slider-btn"><?php esc_html_e('Read More','wp-construction'); ?></a>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<nav id="nav-arrows" class="nav-arrows">
					<span class="nav-arrow-prev"><?php esc_html_e('Previous','wp-construction'); ?></span>
					<span class="nav-arrow-next"><?php esc_html_e('Next','wp-construction'); ?></span>
				</nav>
			</div>
		<?php } ?>
	</div>
<div class="clearfix">  </div>