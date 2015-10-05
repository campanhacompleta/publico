<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Público
 */

get_header(); ?>

	<div class="large-12 columns">
		<div id="primary" class="content-area">
			<main id="main" class="site-main site__section" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title show-for-sr">', '</h1>' ); ?>
						<div class="entry-meta show-for-sr">
							<?php echo publico_get_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<div class="row">
							<div class="medium-6 columns">
								<?php do_action( 'parlamentar_the_top_info' ); ?>
							</div>
							<div class="medium-6 columns">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="entry-image">
										<?php the_post_thumbnail(); ?>
									</div><!-- .entry-image -->
								<?php endif; ?>
							</div>
						</div>

						<div class="row">
							<div class="large-6 columns">
								<?php do_action( 'parlamentar_the_biography' ); ?>
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'publico' ),
										'after'  => '</div>',
									) );
								?>
							</div>
							<div class="large-6 columns">
								<?php do_action( 'parlamentar_the_transparency_info' ); ?>
							</div>
						</div>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php publico_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->

			<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php get_footer(); ?>
