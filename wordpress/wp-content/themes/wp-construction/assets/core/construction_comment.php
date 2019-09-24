 <?php  // code for comment
  if ( ! function_exists( 'wp_construction_comment' ) ) :
  function wp_construction_comment( $commentt, $args, $depth ) 
  {
  $GLOBALS['commentt'] = $commentt;
  //get theme data
  global $comment_data;
  //translations
  $leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
  __('Reply','wp-construction'); ?>
  	<div class="media comment_box" id="comment-<?php comment_ID(); ?>">
     <a class="pull_left_comment" href="#">
        <?php $argss =array('class' => 'comment_img');
         echo get_avatar($commentt,$size = '130',$argss); ?>
     </a>
      <div class="media-body">
        <div class="comment_detail">
					<h4 class="comment_detail_title"><?php if($commentt->comment_author_url!='') { ?> <a href="<?php echo esc_url( $commentt->comment_author_url); ?>"><?php } ?> <?php comment_author();?> <?php if($commentt->comment_author_url!='') { ?> </a><?php } ?></h4>
            <span class="comment_date">
              <?php if ( ('d M  y') == get_option( 'date_format' ) ) : comment_date('F j, Y'); else : comment_date(); endif; ?>
            </span>
          <p><?php comment_text(); ?></p>
          <div class="reply">
            <span><i class="fa fa-calendar" aria-hidden="true"></i><?php comment_date(); ?></span>
            <a href="#"><i class="fa fa-reply" aria-hidden="true"></i><?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a>
          </div>
          <?php if ( $commentt->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wp-construction' ); ?></em>
        <br/>
      <?php endif; ?>
			</div>  
		</div>
  </div>
  <?php } endif; ?>