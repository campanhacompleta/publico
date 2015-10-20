<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Público
 */

get_header(); ?>

	<div class="large-12 columns">
		<div id="primary" class="content-area">
			<main id="main" class="site-main site__section" role="main">

				<section class="error-404 not-found">
					<header class="entry-header show-for-sr">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'publico' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p class="show-for-sr"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'publico' ); ?></p>

						<?php
							$is_categorized_blog = publico_categorized_blog();

							if ( $is_categorized_blog ) {
								$class="medium-3 columns";
							}
							else {
								$class="medium-4 columns";
							}

							// The arguments for the_widget()
							$args = array(
								'before_title' => '<h4 class="widget-title area__title">',
								'after_title'=> '</h4>',
								'before_widget'=> '<aside class="widget ' . $class . '">',
								'after_widget'=> '</aside>'
							);
						?>

						<?php get_search_form(); ?>

						<div class="row">
							<?php the_widget( 'WP_Widget_Recent_Posts', '', $args ); ?>

							<?php if ( $is_categorized_blog ) : // Only show the widget if site has multiple categories. ?>
							<aside class="widget widget_categories <?php echo $class; ?>">
								<h4 class="widget-title area__title"><?php esc_html_e( 'Most Used Categories', 'publico' ); ?></h4>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									) );
								?>
								</ul>
							</aside><!-- .widget -->
							<?php endif; ?>

							<?php the_widget( 'WP_Widget_Archives', 'dropdown=1', $args ); ?>

							<?php the_widget( 'WP_Widget_Tag_Cloud', '', $args ); ?>
						</div>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php get_footer(); ?>
