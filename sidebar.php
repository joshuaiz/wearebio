<?php 
/**
 * Template for displaying the sidebar
 *
 * @package Mesh
 * @since Mesh 1.0
 */

zilla_sidebar_before(); ?>
<!--BEGIN #sidebar .aside-->
<div id="sidebar" class="aside" role="complementary">

	<?php 
	zilla_sidebar_start();

	/* Widgetised Area */ 
	if( is_active_sidebar( 'sidebar-main' ) ) {
		dynamic_sidebar( 'sidebar-main' );
	}

	zilla_sidebar_end();
	?>

<!--END #sidebar .aside-->
</div>
<?php zilla_sidebar_after(); ?>