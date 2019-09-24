<?php error_reporting(E_ALL & ~E_NOTICE);
	add_action( 'widgets_init','wp_construction_follow_widget_contact');
   function wp_construction_follow_widget_contact() { return   register_widget( 'wp_construction_follow_widget' ); }
/**
* Adds footer contact  widget.
*/
class wp_construction_follow_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wp_construction_follow_widget', // Base ID
			__('Follow And Subscribe..!!', 'wp-construction'), // Name
			array( 'description' => __( 'Follow and share widget', 'wp-construction' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$facebook = apply_filters( 'facebook', $instance['facebook'] );
		$twitter = apply_filters( 'twitter', $instance['twitter'] );
		$linkdin = apply_filters( 'linkdin', $instance['linkdin'] );
		$google = apply_filters( 'google', $instance['google'] );	
		$youtube = apply_filters( 'youtube', $instance['youtube'] );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$facebook = apply_filters( 'facebook', $facebook, $instance, $this->id_base );
		$twitter = apply_filters( 'twitter', $twitter, $instance, $this->id_base );
		$linkdin = apply_filters( 'linkdin', $linkdin, $instance, $this->id_base );
		$google = apply_filters( 'google', $google, $instance, $this->id_base );
		$youtube = apply_filters( 'youtube', $youtube, $instance, $this->id_base );
		
		// before and after widget arguments are defined by themes
		echo wp_kses_post($args['before_widget']);
		if ( ! empty( $title ) )
		echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']); 
		
		?>
		<ul class="side-links">
	        <?php if($facebook) { ?><li><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	        <?php }  if($twitter) { ?><li><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	        <?php }  if($google) { ?><li><a href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	        <?php }  if($linkdin) { ?><li><a href="<?php echo esc_url($linkdin); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	        <?php }  if($youtube) { ?><li><a href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
	        <?php } ?>
	    </ul>
		<?php		
		echo wp_kses_post($args['after_widget']); // end of footer usefull links widget		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] )  && isset( $instance[ 'facebook' ] ) && isset( $instance[ 'youtube' ] )  && isset( $instance[ 'twitter' ] ) && isset( $instance[ 'google' ] ) && isset( $instance[ 'linkdin' ] ) ) {
		$title = $instance[ 'title' ];
		$facebook = $instance[ 'facebook' ];
		$twitter = $instance[ 'twitter' ];	
		$google = $instance[ 'google' ];	
		$linkdin = $instance[ 'linkdin' ];	
		$youtube = $instance[ 'youtube' ];	
		}
		else {
		$title = __( 'FOLLOW & SUBSCRIBE', 'wp-construction' );
		}				
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title); ?>" />
		</p>
		<p>	
		<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e( 'Facebook:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e( 'Twitter:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</p>		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'google' )); ?>"><?php esc_html_e( 'Google Plus:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" type="text" value="<?php echo esc_attr($google ); ?>" />
		</p>		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'linkdin' )); ?>"><?php esc_html_e( 'Linkdin:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkdin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkdin' )); ?>" type="text" value="<?php echo esc_attr($linkdin); ?>" />
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e( 'Youtube:','wp-construction' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
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
                                'facebook' => '',
                                'twitter'  => '',
                                'google' => '',
                                'linkdin'  => '',
                                'youtube' => '',
                                'text'   => '',
                                'filter' => false, // For back-compat.
                                'visual' => null, // Must be explicitly defined.
	                        )
	                );
	                $instance = $old_instance;
	                $instance['title'] = sanitize_text_field( $new_instance['title'] );
	                 $instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
	                 $instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
	                 $instance['google'] = sanitize_text_field( $new_instance['google'] );
	                 $instance['linkdin'] = sanitize_text_field( $new_instance['linkdin'] );
	                 $instance['youtube'] = sanitize_text_field( $new_instance['youtube'] );
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