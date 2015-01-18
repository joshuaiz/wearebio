<?php
/**
 * Create the General Settings section
 */

add_action('admin_init', 'zilla_general_settings');
function zilla_general_settings(){
	$general_settings['description'] = 'Control and configure the general setup of your theme. Upload your preferred logo, setup your feeds and insert your analytics tracking code.';
								
	$general_settings[] = array(
		'title' => __('Plain Text Logo', 'zilla'),
		'desc' => __('Check this box to enable a plain text logo rather than upload an image. Will use your site name.', 'zilla'),
		'type' => 'checkbox',
		'id' => 'general_text_logo'
	);
						
	$general_settings[] = array(
		'title' => __('Custom Logo Upload', 'zilla'),
		'desc' => __('Upload a logo for your theme.', 'zilla'),
		'type' => 'file',
		'id' => 'general_custom_logo',
		'val' => 'Upload Image'
	);
	
	$general_settings[] = array(
		'title' => __('Display site description below logo', 'zilla'),
		'desc' => __('Shall the site description be shown below the logo.', 'zilla'),
		'type' => 'checkbox',
		'id' => 'general_display_description'
	);

	$general_settings[] = array(
		'title' => __('Custom Favicon Upload', 'zilla'),
		'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'zilla'),
		'type' => 'file',
		'id' => 'general_custom_favicon',
		'val' => 'Upload Image'
	);
						
	$general_settings[] = array(
		'title' => __('Contact Form Email Address', 'zilla'),
		'desc' => __('Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.', 'zilla'),
		'type' => 'text',
		'id' => 'general_contact_email'
	);
								
	zilla_add_framework_page( 'General Settings', $general_settings, 5 );
}


/**
 * Output the favicon
 */
function zilla_custom_favicon(){
	$zilla_values = get_option( 'zilla_framework_values' );
	if( array_key_exists( 'general_custom_favicon', $zilla_values ) && $zilla_values['general_custom_favicon'] != '' )
		echo '<link rel="shortcut icon" href="'. $zilla_values['general_custom_favicon'] .'" />' . "\n";
}
add_action( 'wp_head', 'zilla_custom_favicon' );

?>