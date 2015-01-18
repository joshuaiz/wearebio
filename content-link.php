<?php
/**
 * Template for display link format
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<?php $link = get_post_meta( $post->ID, '_zilla_link_url', true ); ?>

<?php if( !empty( $link ) ) { ?>
	<div class="post-media">
		<a href="<?php echo esc_url($link); ?>" target="_blank">
			<span><?php echo esc_url($link); ?></span>
			<?php if( is_singular('post') ) {
				the_post_thumbnail('full');
			} else {
				the_post_thumbnail(); 
			} ?>
		</a>
	</div>
<?php } ?>