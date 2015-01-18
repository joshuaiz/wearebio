<?php
/**
 * Template for display quote format special content
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<?php 
$quote = get_post_meta( $post->ID, '_zilla_quote_quote', true ); 
$quote_author = get_post_meta( $post->ID, '_zilla_quote_author', true );

if( !empty($quote) ) {
?>

<div class="post-media">
	<?php if( !is_single() ) { ?>
	<a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zilla' ), the_title_attribute( 'echo=0' ) ) ); ?>" href="<?php the_permalink(); ?>" href="<?php the_permalink(); ?>">
	<?php } ?>
		<blockquote>
			<?php echo stripslashes( esc_html($quote) ); ?>
			<?php if( !empty($quote_author) ) { ?>
				<footer><?php echo stripslashes( esc_html($quote_author) ); ?></footer>
			<?php } ?>
		</blockquote>

		<?php if( is_singular('post') ) {
			the_post_thumbnail('full');
		} else {
			the_post_thumbnail(); 
		} ?>
	<?php if( !is_single() ) { ?>
	</a>
	<?php } ?>
</div>

<?php } ?>