<?php
/**
 * The front page template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Público
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="row">
				<section class="site-news site__section clearfix">
					<div class="medium-7 columns">
						<div class="site-news__main">
							<?php
							$do_not_repeat = 0;

							$noticias = new WP_Query( array (
								'posts_per_page' => 1,
								'ignore_sticky_posts' => true,
								'post__in' => get_option( 'sticky_posts' ),
								'tax_query' => array(
							        array(
							            'taxonomy' => 'post_format',
							            'field' => 'slug',
							            'terms'    => array( 'post-format-video' ),
										'operator' => 'NOT IN'
							        )
							    )
							) );

							if ( $noticias->have_posts() ) : while ( $noticias->have_posts() ) : $noticias->the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry--columns clear' ); ?>>
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="entry-image">
											<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'archive' ); ?></a>
										</div><!-- .entry-image -->
										<?php endif; ?>
									<header class="entry-header">
										<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<?php publico_posted_on(); ?>
									</header><!-- .entry-header -->

									<div class="entry-content">
										<?php the_excerpt(); ?>
									</div>
								</article><!-- #post-## -->

								<?php $do_not_repeat = $post->ID; ?>

							<?php endwhile; wp_reset_postdata(); endif; ?>
						</div>
					</div>
					<div class="medium-5 columns">
						<div class="site-news__aside">
							<?php
							$noticias_aside = new WP_Query( array (
								'posts_per_page' => 4,
								'ignore_sticky_posts' => true,
								'post__not_in' => array( $do_not_repeat ),
								'tax_query' => array(
							        array(
							            'taxonomy' => 'post_format',
							            'field' => 'slug',
							            'terms'    => array( 'post-format-video' ),
										'operator' => 'NOT IN'
							        )
							    )
							) );

							if ( $noticias_aside->have_posts() ) : while ( $noticias_aside->have_posts() ) : $noticias_aside->the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'flag clearfix' ); ?>>
									<div class="flag__image">
										<?php if ( has_post_thumbnail() ) : ?>
										<div class="entry-image">
											<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
										</div><!-- .entry-image -->
										<?php endif; ?>
									</div>

									<div class="flag__body flag__body--padded">
										<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									</div>
								</article><!-- #post-## -->

							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
							<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="button wide"><?php _e( 'Read other posts', 'publico' ); ?></a>
							<?php endif; ?>

						</div>
					</div>
				</section>
			</div>

			<?php get_sidebar( 'social-engagement' ); ?>

			<?php get_sidebar( 'content-secondary' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
