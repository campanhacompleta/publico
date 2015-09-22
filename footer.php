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

		</div><!-- .row -->
	</div><!-- #content -->

	<?php get_sidebar( 'content-bottom' ); ?>

	<?php
		if ( ! ( is_front_page() ) ) {
			publico_the_newsletter();
		}
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar( 'footer' ); ?>
		
		<div class="site-info site__section">
			<div class="row">
				<div class="medium-12 columns">
		    		<div class="medium-6 columns">
		    			<div class="site-credits">
				    		<strong>PRJ</strong> &bull; Licença para uso do material
				    	</div>
				    </div>
				    <div class="medium-6 columns">
				    	<div class="site-social medium-text-right">
				    		<a href="#">Facebook</a>
				    		<a href="#">Twitter</a>
				    		<a href="#">Instagram</a>
				    		<a href="#">RSS</a>
				    	</div>
				    </div>
	    		</div>
    		</div>
    	</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
