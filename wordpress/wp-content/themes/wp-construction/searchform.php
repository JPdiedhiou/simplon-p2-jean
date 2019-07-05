<?php 
/**
 * Template for displaying search forms in Theme
 *
 * @package WordPress
 * @subpackage wp-construction
 * @since  0.52
 * @version 0.53
 */
?>
<form class="header-search search_open animated zoomIn pull-right" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<button type="submit"  class="header-button"><i class="fa fa-search"></i></button>
	<input type="text" class="form-control header-input"  name="s" id="s" />
</form>