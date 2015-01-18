<?php 
/**
 * Template for displaying single portfolio view
 *
 * @package Mesh
 * @since  Mesh 1.0
 */

get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<div class="entry-content">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="portfolio-description">
				<?php the_content(); ?>

				<div class="post-navigation clearfix">
					<?php next_post_link('%link', '<span class="prev-post-link"><span class="special">&laquo;</span> Prev</span>'); ?>
					<?php previous_post_link('%link', '<span class="next-post-link">Next <span class="special">&raquo;</span></span>'); ?>
				</div>

			</div>

			<?php // <?php the_terms($post->ID, 'portfolio-type', '<div class="portfolio-types entry-meta">', '<br>', '</div>'); ?>

			


			<a id="show-hide-content" class="show-hide-content animated" href="#"><?php _e('Hide Content', 'zilla'); ?></a>
		<!--END .entry-content -->



		</div>

		<?php if( ! post_password_required($post->ID) ) { ?>
  
		<div class="portfolio-media">
			<?php
			$port_meta = get_metadata('post', $post->ID);

			// detemine which media to display
			$portfolio_display_gallery = ( array_key_exists('_zilla_portfolio_display_gallery', $port_meta) ) ? $port_meta['_zilla_portfolio_display_gallery'][0] : false;
			$portfolio_display_video = ( array_key_exists('_zilla_portfolio_display_video', $port_meta) ) ? $port_meta['_zilla_portfolio_display_video'][0] : false;
			$portfolio_display_audio = ( array_key_exists('_zilla_portfolio_display_audio', $port_meta) ) ? $port_meta['_zilla_portfolio_display_audio'][0] : false;

			if( $portfolio_display_gallery == 'on' ) {
				echo htmlspecialchars_decode( esc_html( zilla_gallery($post->ID, 'full', 'stacked') ) );
			}

			if( $portfolio_display_video == 'on' ) {
				$embed = ( array_key_exists('_zilla_video_embed_code', $port_meta) ) ? $port_meta['_zilla_video_embed_code'][0] : '';
				if( !empty( $embed ) ) {
					echo stripslashes( htmlspecialchars_decode( $embed ) );
				} else {
					zilla_media_player( $post->ID, '600', 'video' );
				}
			}

			if( $portfolio_display_audio == 'on' ) {
				zilla_media_player( $post->ID, '600', 'audio' );
			}
			?>

		<!--END .portfolio-media -->
		</div>
		<?php } // end password protection ?>

	</article>
<?php endwhile; endif; ?>
<!--END #primary -->
</div>

<?php get_footer(); ?>