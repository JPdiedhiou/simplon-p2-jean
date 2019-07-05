<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
?>
<div class="col-md-4">
	<div class="sidebar-block">
	<?php if ( is_active_sidebar( 'sidebar-primary' ) )
    { dynamic_sidebar( 'sidebar-primary' ); }else{ 
            $user = wp_get_current_user();
            $allowed_roles = array('editor', 'administrator', 'author');
            if( array_intersect($allowed_roles, $user->roles ) ) {  ?>
             <div class="empty_sidebar"><h4><?php esc_html_e('SideBar is Empty, Put widgets from widgets option','wp-construction'); ?></h4></div>
            <?php } 
         }
    ?>			
	</div>	
	<div class="clearfix"></div>	
</div>