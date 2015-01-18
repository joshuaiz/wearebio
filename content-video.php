<?php
/**
 * Template for display video post media
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<div class="post-media">
	<?php
		$embed = get_post_meta( $post->ID, '_zilla_video_embed_code', true );
		if( !empty( $embed ) ) {
			echo stripslashes( htmlspecialchars_decode( $embed ) );
		} else {
			zilla_media_player( $post->ID, 600, 'video' );
		} 
		?>
</div>