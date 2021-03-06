<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

?>

		<?php if ( ! is_front_page() ) : ?>
		</div><!-- .row -->
		<?php endif; ?>
	</div><!-- #content -->

	<?php get_sidebar( 'content-bottom' ); ?>

	<?php get_sidebar( 'call-to-action' );?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar( 'footer' ); ?>

		<div class="site-info site__section">
			<div class="row">
				<div class="medium-12 columns">
		    		<div class="medium-6 large-8 columns">
		    			<div class="site-credits">
		    				<?php echo get_theme_mod( 'publico_footer_text' ); ?>
				    	</div>
				    </div>
				    <div class="medium-6 large-4 columns">
				    	<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav class="site-social social-navigation medium-text-right" role="navigation" aria-label='<?php _e( 'Footer Social Links Menu', 'publico' ); ?>'>
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
				    </div>
	    		</div>
    		</div>
    	</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
