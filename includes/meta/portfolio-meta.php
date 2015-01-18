<?php

/**
 * Create the Portfolio meta boxes
 */
 
add_action('add_meta_boxes', 'zilla_metabox_portfolio');
function zilla_metabox_portfolio(){
    
    /* Create a settings metabox -----------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-portfolio-settings',
		'title' =>  __('Portfolio Settings', 'zilla'),
		'description' => __('Input basic settings for this portfolio.', 'zilla'),
		'page' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' =>  __('Display Gallery', 'zilla'),
				'desc' => __('Shall the gallery be displayed?', 'zilla'),
				'id' => '_zilla_portfolio_display_gallery',
				'type' => 'checkbox',
				'std' => 'on'
			),
			array(
				'name' =>  __('Display Audio', 'zilla'),
				'desc' => __('Shall the video be displayed?', 'zilla'),
				'id' => '_zilla_portfolio_display_audio',
				'type' => 'checkbox',
				'std' => 'off'
			),
			array(
				'name' =>  __('Display Video', 'zilla'),
				'desc' => __('Shall the video be displayed?', 'zilla'),
				'id' => '_zilla_portfolio_display_video',
				'type' => 'checkbox',
				'std' => 'off'
			)
		)
	);
    zilla_add_meta_box( $meta_box );
	
	/* Create an image metabox -------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-portfolio-gallery',
		'title' =>  __('Gallery Settings', 'zilla'),
		'description' => __('Set up your gallery. All images attached to this portfolio will be included in the gallery.', 'zilla'),
		'page' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' =>  __('Upload Images', 'zilla'),
				'desc' => __('Click to upload images.', 'zilla'),
				'id' => '_zilla_gallery_upload',
				'type' => 'images',
				'std' => __('Upload Images', 'zilla')
			)
		)
	);
    zilla_add_meta_box( $meta_box );
    
    /* Create a video metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-portfolio-video',
		'title' => __('Video Settings', 'zilla'),
		'description' => __('These settings enable you to embed videos into your portfolio pages.', 'zilla'),
		'page' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
				'name' => __('Video Height', 'zilla'),
				'desc' => __('The video height (e.g. 500). Base the height value on width of 600px.', 'zilla'),
				'id' => '_zilla_video_height',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('M4V File URL', 'zilla'),
				'desc' => __('The URL to the .m4v video file', 'zilla'),
				'id' => '_zilla_video_m4v',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('OGV File URL', 'zilla'),
				'desc' => __('The URL to the .ogv video file', 'zilla'),
				'id' => '_zilla_video_ogv',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('Poster Image', 'zilla'),
				'desc' => __('The preview image.', 'zilla'),
				'id' => '_zilla_video_poster_url',
				'type' => 'file',
				'std' => ''
			),
			array(
				'name' => __('Embedded Code', 'zilla'),
				'desc' => __('If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 600px with any height.<br><br> This field will override the above.', 'zilla'),
				'id' => '_zilla_video_embed_code',
				'type' => 'textarea',
				'std' => ''
			)
		)
	);
	zilla_add_meta_box( $meta_box );
	
	/* Create an audio metabox ------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-portfolio-audio',
		'title' =>  __('Audio Settings', 'zilla'),
		'description' => __('These settings enable you to embed audio into your portfolio pages.', 'zilla'),
		'page' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
				'name' => __('MP3 File URL', 'zilla'),
				'desc' => __('The URL to the .mp3 audio file', 'zilla'),
				'id' => '_zilla_audio_mp3',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('OGA File URL', 'zilla'),
				'desc' => __('The URL to the .oga, .ogg audio file', 'zilla'),
				'id' => '_zilla_audio_ogg',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('Poster Image', 'zilla'),
				'desc' => __('The preview image for this audio track', 'zilla'),
				'id' => '_zilla_audio_poster_url',
				'type' => 'file',
				'std' => ''
			),
			array( 
				'name' => __('Poster Image Height', 'zilla'),
				'desc' => __('The height of the poster image. Base the height value on width of 600px.', 'zilla'),
				'id' => '_zilla_audio_height',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	zilla_add_meta_box( $meta_box );
}