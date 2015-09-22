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
			
			<section class="site-news site__section">
				<div class="medium-7 columns">
					<div class="site-news__main">
						<?php
						$noticias = new WP_Query( array ( 'posts_per_page' => 1, 'ignore_sticky_posts' => true ) );
						
						if ( $noticias->have_posts() ) : while ( $noticias->have_posts() ) : $noticias->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry--columns clear' ); ?>>
								<header class="entry-header">
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="entry-image">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'archive' ); ?></a>
									</div><!-- .entry-image -->
									<?php endif; ?>
									
									<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

									<?php publico_posted_on(); ?>
								</header><!-- .entry-header -->

								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div>
							</article><!-- #post-## -->

						<?php endwhile; endif; ?>
					</div>
				</div>
				<div class="medium-5 columns">
					<div class="site-news__aside">
						<?php
						$noticias = new WP_Query( array ( 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );
						
						if ( $noticias->have_posts() ) : while ( $noticias->have_posts() ) : $noticias->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'flag clearfix' ); ?>>
								<div class="flag__image">
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="entry-image">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
									</div><!-- .entry-image -->
									<?php endif; ?>
								</div>

								<div class="flag__body">
									<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								</div>
							</article><!-- #post-## -->

						<?php endwhile; endif; ?>

						<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="button wide">Ver outras notícias</a>
					</div>
				</div>
			</section>

			<section class="site-extras site__section">
				<div class="large-7 columns">
					<div class="site-extras--video">
						<h4 class="section__title">Vídeo</h4>
						<?php
						$video = new WP_Query( array (
							'posts_per_page' => 1,
							'ignore_sticky_posts' => true,
							'tax_query' => array(
								array(
									'taxonomy' => 'post_format',
									'field'    => 'slug',
									'terms'    => array( 'post-format-video' ),
								),
							)
						) );

						if ( $video->have_posts() ) :
							while ( $video->have_posts() ) : $video->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry--columns clear' ); ?>>
								<header class="entry-header">

									<?php publico_the_first_embed( $post->ID ); ?>

									<div class="entry-video">
										<?php echo $fist_embedded; ?>
									</div><!-- .entry-video -->

								</header><!-- .entry-header -->

								<div class="entry-content">
									<?php //the_content(); ?>
								</div>
							</article>

						<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>
				
				<div class="large-5 columns">
					<div class="site-extras--events">
						<h4 class="section__title">Agenda</h4>
						<ul>
							<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas quia consectetur, culpa illum? Necessitatibus asperiores libero deleniti facere laudantium eligendi vitae doloribus cumque maxime praesentium est fugiat error, ullam excepturi!</li>
							<li>Illo, expedita, nesciunt! Perspiciatis veritatis quaerat culpa, saepe obcaecati ducimus. Veritatis officia, pariatur, ad voluptatem excepturi doloribus commodi perspiciatis nemo molestiae asperiores libero facilis vel? Facilis nihil esse rem deserunt.</li>
							<li>Vero repellat porro, laborum adipisci tenetur quibusdam sapiente veritatis at dicta blanditiis, laboriosam doloribus nobis, sint officiis, odio ipsum laudantium corporis numquam velit voluptates quo neque obcaecati? Fugit, facilis, voluptatum?</li>
							
						</ul>
					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
