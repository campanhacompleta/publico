<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'publico' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="row site__section vertical-align--bottom">

			<div class="medium-3 columns">
				<div class="site-branding">
					<?php
					    $logo = get_theme_mod( 'publico_logo' );
					    if ( isset( $logo ) && ! empty( $logo ) ) : ?>
				            <a href="<?php echo home_url( '/' ); ?>" rel="home">
				                <img class="site-logo" src="<?php echo $logo; ?>" alt="<?php bloginfo ( 'name' ); ?>" />
				            </a>
					    <?php
					    endif;
				    ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div><!-- .site-branding -->
			</div>
			<div class="medium-9 columns">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i>&nbsp;<?php esc_html_e( 'Menu', 'publico' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => 0 ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
		<?php if ( is_front_page() && get_header_image() ) : ?>
			<div class="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
		<?php endif; // End header image check. ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content site__section">

		<?php publico_the_page_header(); ?>

		<?php if ( ! is_front_page() ) : ?>
		<div class="row">
		<?php endif; ?>
