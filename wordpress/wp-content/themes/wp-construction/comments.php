<?php 
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
 if ( post_password_required() ) : ?>
	<p><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'wp-construction' ); ?></p>
	<?php return; endif; 
     if ( have_comments() ) : ?>
	<div class="comment_section animate fadeInUp wow" data-anim-type="fadeInUp" data-anim-delay="600" style="visibility: visible; animation-name: fadeInUp;">
    <div class="section-titel2 margin-bottom-40">
        <h2 class="sction-cntfont-size"> <span><?php echo comments_number(); ?></span></h2>
    </div>
	
	<?php wp_list_comments( array( 'callback' => 'wp_construction_comment') ); 	
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'wp-construction' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wp-construction' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wp-construction' ) ); ?></div>
		</nav>
		<?php endif;  ?>
	</div>		
	<?php endif; 
	if ( comments_open() ) : 
	$commenter = wp_get_current_commenter();
	$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	?>
	<div class="construction-common-block-space" id="contact-form-1">
	<?php $fields=array(
		'author' => '<div class="form-group col-sm-6 animate " data-anim-type="fadeInUpLarge" data-anim-delay="400">
                            <div class="icon-addon addon-lg">
                                <input type="text" name="author" placeholder="'. __("Name","wp-construction") .'" class="form-control"  required />
                                <label for="user" class="fa fa-user" rel="tooltip" title="user"></label>
                            </div>
                        </div>',
		'email' => '<div class="form-group animate col-sm-6 " data-anim-type="fadeInUpLarge" data-anim-delay="400">
                        <div class="icon-addon addon-lg">
                            <input type="email" name="email" placeholder="'. __("Email","wp-construction") .'" class="form-control"  class="form-control" required />
                            <label for="email" class="fa fa-at" rel="tooltip" title="email"></label>
                        </div>
                    </div>',
		'url' => '<div class="form-group animate col-sm-12 " data-anim-type="fadeInUpLarge" data-anim-delay="400">
                            <div class="icon-addon addon-lg">
                                <input type="text" name="url" placeholder="'. __("Website","wp-construction") .'" class="form-control"  required />
                                <label for="phone" class="fa fa-volume-control-phone" rel="tooltip" title="Phone"></label>
                            </div>
                  </div>',
        'cookies' => '<div class="form-group animate col-sm-12 " data-anim-type="fadeInUpLarge" data-anim-delay="400">
        				<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                            '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.',"wp-construction" ) . '</label>
                        </p>
                      </div>',
	);
	function my_fields($fields) { 
		return $fields;
	}
	add_filter('wp_construction_comment_form_default_fields','my_fields');
		$defaults = array(
		'fields'=> apply_filters( 'wp_construction_comment_form_default_fields', $fields ),
			
		'comment_field' =>  '<div class="form-group animate " data-anim-type="fadeInUpLarge" data-anim-delay="400">
		                        <div class="icon-addon addon-lg">
		                            <textarea id="comment" name="comment" class="form-control" placeholder="'. __("Type Your Comment Here","wp-construction") .'" class="form-control" id="message" aria-required="true"></textarea>
		                            <label for="message" class="fa fa-envelope" rel="tooltip" title="message"></label>
		                        </div>
		                    </div>',
		'logged_in_as' => '<p class="logged-in-as">' . __( "Logged in as ",'wp-construction' ).'<a href="'. esc_url(admin_url( 'profile.php' )).'">'.$user_identity.'</a>'. '<a href="'. esc_url(wp_logout_url( get_permalink() )).'" title="Log out of this account">'.__(" Log out?",'wp-construction').'</a>' . '</p>',
		'title_reply_to' => /* translators: %s: Leave a Reply term */ esc_html__( 'Leave a Reply to %s','wp-construction'),
		'id_submit' => 'construction_send_button',
		'label_submit'=>__( 'Submit','wp-construction'),
		'comment_notes_before'=> '',
		'comment_notes_after'=>'',
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after' => '</h2>',
		'title_reply'=> '<h2 class="heading animate " data-anim-type="fadeInLeft" data-anim-delay="400">'.__('Leave a Comment','wp-construction').'</h2>',		
		'role_form'=> 'form',		
		);	
		comment_form($defaults); ?>				
</div>
<?php endif; // If registration required and not logged in ?>