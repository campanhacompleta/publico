<?php
/**
 * Template Name: Full Width Page
 * 
 * A page template that has no sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Público
 */

get_header(); ?>

	<div class="large-12 columns">
		<div id="primary" class="content-area">
			<main id="main" class="site-main site__section" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php get_footer(); ?>
