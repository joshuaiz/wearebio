<?php
/**
 * Create the Styling Options section
 */

add_action('admin_init', 'zilla_styling_options');
function zilla_styling_options(){
		
	$styling_options['description'] = __('Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your overall layout and inserting any custom CSS necessary.', 'zilla');
	
	$styling_options[] = array(
		'title' => __('Accent Color', 'zilla'),
		'desc' => __('Select a custom color accent', 'zilla'),
		'type' => 'color',
		'id' => 'style_accent_color',
		'val' => '#f23e2f'
	);

	$styling_options[] = array(
		'title' => __('Custom CSS', 'zilla'),
		'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'zilla'),
		'type' => 'textarea',
		'id' => 'style_custom_css'
	);
                                
    zilla_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/**
 * Output the theme style
 */
function zilla_theme_style(){
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_stylesheet', $zilla_values ) && $zilla_values['style_stylesheet'] != '' )
		echo '<link rel="stylesheet" id="colour_switch" media="all" href="'. get_template_directory_uri() .'/css/'. $zilla_values['style_stylesheet'] .'" />' . "\n";
}
add_action( 'wp_head', 'zilla_theme_style' );


/**
 * Output main layout
 */
function zilla_style_main_layout($classes) {
	$zilla_values = get_option( 'zilla_framework_values' );
	$layout = 'layout-2cr';
	if( array_key_exists( 'style_main_layout', $zilla_values ) && $zilla_values['style_main_layout'] != '' ){
		$layout = $zilla_values['style_main_layout'];
	}
	$classes[] = $layout;
	return $classes;
}
add_filter( 'body_class', 'zilla_style_main_layout' );


/**
 * Output the custom CSS
 */
function zilla_custom_css($content) {
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_custom_css', $zilla_values ) && $zilla_values['style_custom_css'] != '' ){
    	$content .= '/* Custom CSS */' . "\n";
        $content .= stripslashes($zilla_values['style_custom_css']);
        $content .= "\n\n";
    }
    return $content;
    
}
add_filter( 'zilla_custom_styles', 'zilla_custom_css' );

/**
 * Output the custom accent color
 */
function zilla_accent_color($content) {
	$zilla_values = get_option( 'zilla_framework_values' );

	if( array_key_exists( 'style_accent_color', $zilla_values ) && $zilla_values['style_accent_color'] != '') {
		$color = $zilla_values['style_accent_color'];

		if( !empty($color) && $color != '#f23e2f' ) {
			$rgba = zilla_hex2rgba( $color, '0.9' );
			$content .= "/* Custom Accent Color */\n\n";

			$content .= "a,\n#logo:hover,\n.entry-title a:hover,\nbutton:hover,\ninput[type='submit']:hover,\ninput[type='submit']:focus,\ninput[type='button']:hover,\ninput[type='reset']:hover,\n#commentform .required,\n.page-navigation .nav-previous a:hover,\n.page-navigation .nav-next a:hover,\n#footer a,\nwidget .current-cat > a,\n.widget .current-menu-item > a,\n.widget ul a:hover,\n.widget ul a.active-filter,\n.mobile-menu a:hover,\n.mobile-menu .current-cat > a,\n.mobile-menu .current-menu-item > a,\n.mobile-menu .current_page_item > a,\n.mobile-menu ul a:hover,\n#footer .zilla-tweet-widget .twitter-time-stamp:hover { color: $color; }\n\n";

			$content .= ".post-media a,\n.post-media .zilla-slide-prev:hover,\n.post-media .zilla-slide-next:hover,\n.portfolio-feed .portfolio > a,\n#toggle-footer { background-color: $color; }\n\n";

			$content .= ".zilla-gallery .slide-caption,\n.single-portfolio .entry-content { background-color: rgba($rgba); }\n\n";
		}
	}

	return $content;
}
add_action( 'zilla_custom_styles', 'zilla_accent_color' );

/**
 * Helper function to convert hexcode to rgb
 *
 * @since Mesh 1.0
 *
 * @param string $hex
 * @param string $alpha
 * @return string $rgba
 */
function zilla_hex2rgba($hex, $alpha) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgba = array($r, $g, $b, $alpha);
	return implode(",", $rgba); // returns the rgb values separated by commas
	// return $rgba; // returns an array with the rgb values
}
?>