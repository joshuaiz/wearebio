<?php
/**
 * Template for display image post media
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<?php if( has_post_thumbnail() ) { ?>
	<div class="post-media">
		<?php if( !is_singular() ) { ?>
			<a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zilla' ), the_title_attribute( 'echo=0' ) ) ); ?>" href="<?php the_permalink(); ?>" href="<?php the_permalink(); ?>"><span><?php _e('Continue Reading', 'zilla'); ?></span>
				<?php the_post_thumbnail(); ?>
			</a>
		<?php } else {
			the_post_thumbnail('full');
		} ?>
	</div>
<?php } ?>