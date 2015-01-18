<?php
/**
 * Template for display gallery post media
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<?php 
$layout = get_post_meta( $post->ID, '_zilla_gallery_layout', true); 
if( is_singular('post') ) {
	$image_size = 'full';
} else {
	$image_size = 'post-thumbnail';
	$layout = 'slideshow'; // show slideshows all index pages
}
$gallery_content = zilla_gallery($post->ID, $image_size, $layout);

if( !empty( $gallery_content) ) {
?>

<div class="post-media">
	<?php echo htmlspecialchars_decode( esc_html($gallery_content) ); ?>
</div>

<?php } ?>