<?php 
add_action( 'widgets_init','wp_construction_recent_works_2'); 
   function wp_construction_recent_works_2() { return   register_widget( 'wp_construction_recent_works_2' ); }

/**
 * Adds widget for recent Post in footer.
 */
class wp_construction_recent_works_2 extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wp_construction_recent_works_2', // Base ID
			__('Construction Recent Posts With Category', 'wp-construction'), // Name
			array( 'description' => __( 'To Display Recent Posts by Category on your sites', 'wp-construction' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number_of_posts = apply_filters( 'number_of_posts', $instance['number_of_posts'] );
		$cat = apply_filters( 'cat', $instance['cat'] );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number_of_posts = apply_filters( 'number_of_posts', $number_of_posts, $instance, $this->id_base );
		$cat = apply_filters( 'cat', $cat, $instance, $this->id_base );

		if($number_of_posts=='') { $number_of_posts = 5; }
		if($cat=='') { $cat = 'default'; }
		
		// before and after widget arguments are defined by themes
		echo wp_kses_post($args['before_widget']);
		if ( ! empty( $title ) )
		echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);	

		if($cat=='default')
		{
			$loop = new WP_Query(array( 'post_type' => 'post', 'showposts' => $number_of_posts ));
		}
		else {
		$loop = new WP_Query(array( 'post_type' => 'post','category_name' => $cat, 'showposts' => $number_of_posts ));
		}
			if( $loop->have_posts() ) : ?>					
				<?php while ( $loop->have_posts() ) : $loop->the_post();?>	
					<div class="media latest-post">
                        <div class="time">
                            <a href="#">
                                <span class="month"><?php echo esc_html(get_the_date( 'M' )); ?></span>
                                <span class="date"><?php echo esc_html(get_the_date( 'd' )); ?></span>
                            </a>
                        </div>
                        <div class="media-body">
                            <span><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></span>
                            <br>
                            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php the_author(); ?></a>
                        </div>
                    </div>
					<?php endwhile; ?>
				<?php endif; ?>		
		<?php		
		echo wp_kses_post($args['after_widget']); 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] )  && isset( $instance[ 'number_of_posts' ] )  && isset( $instance[ 'cat' ] )) {
			$title = $instance[ 'title' ];
			$cat = $instance[ 'cat' ];
			$number_of_posts = $instance[ 'number_of_posts' ];
		}
		else {
			$title = __( 'Recent Post', 'wp-construction' );
			$number_of_posts = 4;
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'number_of_posts' )); ?>"><?php esc_html_e( 'Number of pages to show:','wp-construction' ); ?></label> 
		<input size="3" maxlength="2"id="<?php echo esc_attr($this->get_field_id( 'number_of_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_of_posts' )); ?>" type="text" value="<?php echo esc_attr( $number_of_posts ); ?>" />
		</p>	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'cat' )); ?>"><?php esc_html_e( 'Select Category:','wp-construction' ); ?></label> 			
		<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cat' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat' )); ?>">
		<?php $categories = get_categories( array('orderby' => 'name') ); ?>
		<option value="default" selected="default">Select Category</option>
        <?php foreach ( $categories as $category ) { ?>
		<option value="<?php echo esc_attr($category->slug); ?>" <?php selected($cat, $category->name ); ?> ><?php echo esc_html($category->name); ?></option>	
		<?php } ?>
		</select>
		</p>	
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		  $new_instance = wp_parse_args(
                       $new_instance, array(
                                'title'  => '',
                                'cat' => '',
                                'number_of_posts'  => '',
                                'text'   => '',
                                'filter' => false, // For back-compat.
                                'visual' => null, // Must be explicitly defined.
	                        )
	                );
	                $instance = $old_instance;
	                $instance['title'] = sanitize_text_field( $new_instance['title'] );
	                 $instance['cat'] = sanitize_text_field( $new_instance['cat'] );
	                 $instance['number_of_posts'] = sanitize_text_field( $new_instance['number_of_posts'] );
	                if ( current_user_can( 'unfiltered_html' ) ) {
                        $instance['text'] = $new_instance['text'];
	                } else {
                        $instance['text'] = wp_kses_post( $new_instance['text'] );
	                }

	                $instance['filter'] = ! empty( $new_instance['filter'] );
	
	                // Upgrade 4.8.0 format.
	                if ( isset( $old_instance['filter'] ) && 'content' === $old_instance['filter'] ) {
	                        $instance['visual'] = true;
	                }
	                if ( 'content' === $new_instance['filter'] ) {
	                        $instance['visual'] = true;
	                }
	
	                if ( isset( $new_instance['visual'] ) ) {
	                        $instance['visual'] = ! empty( $new_instance['visual'] );
	                }
	
	                // Filter is always true in visual mode.
	                if ( ! empty( $instance['visual'] ) ) {
	                        $instance['filter'] = true;
	                }
	                return $instance;
	}
}
?>