<?php 
/**
 * The template to display our 404 page
 * 
 * @package Mesh
 * @since Mesh 1.0
 */
get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">

	<!--BEGIN #post-0-->
	<article id="post-0" <?php post_class() ?>>
		
		<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h1>
		
		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<p><?php _e("Sorry, but you are looking for something that isn't here.", 'zilla') ?></p>
		<!--END .entry-content-->
		</div>
		
	<!--END #post-0-->
	</article>
	
<!--END #primary -->
</div>

<?php get_footer(); ?>