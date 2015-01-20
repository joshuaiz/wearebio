<?php 
/**
 * Template for displaying the head content
 * 
 * @package Mesh
 * @since Mesh 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!-- BEGIN html -->
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="utf8_unicode_ci">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<![endif]-->
	<?php zilla_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- RSS & Pingbacks -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<script type="text/javascript" src="http://fast.fonts.com/jsapi/6f7e8107-6b57-4dd5-9bda-0e556a64bfaf.js"></script>

	<?php wp_head(); ?>
	<?php zilla_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
<?php zilla_body_start(); ?>

	<!-- BEGIN #container -->
	<div id="container" class="container">

		<?php zilla_header_before(); ?>
		<!-- BEGIN #header -->
		<header id="header" class="header col">
			<div id="header-inner" class="header-inner">
			<?php zilla_header_start(); ?>

			<!-- BEGIN site-intro -->
			<div class="site-intro">
				<a id="logo" href="<?php echo home_url(); ?>">
				we<span>are</span>bio<span class="period">.</span>
				</a>

				<?php $bloginfo = get_bloginfo( 'description', 'raw' ); ?>
				<p class="tagline"><?php echo $bloginfo; ?></p>

			
			<!-- END .site-intro -->
			</div>

			<?php if( has_nav_menu( 'mobile-menu' ) ) {
				wp_nav_menu( array( 
					'theme_location' => 'mobile-menu',
					'menu_id' => 'mobile-menu',
					'menu_class' => 'mobile-menu',
					'container' => ''
				) ); 
			} ?>

			<?php get_sidebar(); ?>

			<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>">BioDesign</a>. All rights reserved.</p>
			
			

			<?php zilla_header_end(); ?>
			<!--END .header-inner -->
			</div>
		<!--END #header-->
		</header>
		<?php zilla_header_after(); ?>

		<!--BEGIN #content -->
		<div id="content" class="content col">
		<?php zilla_content_start(); ?>