<?php
/**
 * Display the portfolio content for the portfolio template
 * 
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<div id="primary" role="main">

<?php
if( post_password_required() ) {
	echo get_the_password_form();
} else {
	$args = array(
		'post_type' => 'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => -1
	);

	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		echo '<div id="portfolio-feed" class="portfolio-feed">';

		while( $query->have_posts() ) : $query->the_post(); 

			$terms = get_the_terms( $post->ID, 'portfolio-type' ); 
			$class = '';
			if( !empty( $terms ) ) {
				foreach( $terms as $term ) {
					$class .= ' portfolio-type-' . $term->slug;
				}
				$class = trim($class);
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
				<a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
					<div class="post-media">
						<?php the_post_thumbnail('portfolio-thumb'); ?>
					</div>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</a>
			</article>
		
		<?php endwhile; 

		echo '<!--END .portfolio-feed -->';
		echo '</div>';

	endif;
} ?>
</div>