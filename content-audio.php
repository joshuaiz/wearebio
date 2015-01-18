<?php
/**
 * Template for display audio post media
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<div class="post-media">
	<?php zilla_media_player( $post->ID, 600, 'audio' ); ?>
</div>