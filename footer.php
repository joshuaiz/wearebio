<?php
/**
 * Template for displaying the footer
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

		<?php zilla_content_end(); ?>
		<!-- END #content -->
		</div>

	<!-- END #container.container -->
	</div> 

	<?php get_sidebar( 'footer' ); ?>

	<script>
	

	jQuery(document).ready(function($){

		$('.col').matchHeight();
	});	
	</script>


	<!-- Theme Hook -->
	<?php wp_footer(); ?>

	<script>
	jQuery(document).ready(function($){
		$('.no-fouc').removeClass('no-fouc');
	});
	</script>
	<?php zilla_body_end(); ?>

<!--END body-->
</body>
<!--END html-->
</html>