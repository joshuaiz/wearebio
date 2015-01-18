<?php
/**
 * Template for displaying the footer widget areas
 *
 * @package Mesh
 * @since Mesh 1.0
 */


if( is_active_sidebar( 'footer-column' ) || is_active_sidebar( 'footer-column-2' ) || is_active_sidebar( 'footer-column-3' ) || is_active_sidebar( 'footer-column-4' ) ) { ?>

	<?php zilla_footer_before(); ?>
	<!-- BEGIN #footer -->
	<footer id="footer" class="clearfix">
	<?php zilla_footer_start(); ?>

		<a href="#" id="toggle-footer"><?php _e('Expand/Collapse Footer', 'zilla'); ?></a>

		<div id="footer-inner" class="footer-inner clearfix">
		<?php 	

			if( is_active_sidebar( 'footer-column' ) ) {
				echo '<div class="footer-column">';
					dynamic_sidebar( 'footer-column' );
				echo '</div>';
			}

			if( is_active_sidebar( 'footer-column-2' ) ) {
				echo '<div class="footer-column">';
					dynamic_sidebar( 'footer-column-2' );
				echo '</div>';
			}

			if( is_active_sidebar( 'footer-column-3' ) ) {
				echo '<div class="footer-column footer-column-3">';
					dynamic_sidebar( 'footer-column-3' );
				echo '</div>';
			}

			if( is_active_sidebar( 'footer-column-4' ) ) {
				echo '<div class="footer-column">';
					dynamic_sidebar( 'footer-column-4' );
				echo '</div>';
			}
		?>
		</div>

	<?php zilla_footer_end(); ?>
	<!-- END #footer -->
	</footer>
	<?php zilla_footer_after(); ?>

<?php }