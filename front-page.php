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
			</div>

			<?php get_sidebar( 'social-engagement' ); ?>

			<div class="row">
				<section class="site-extras site__section clearfix">
					<div class="large-7 columns">
						<div class="site-extras--video">
							<h4 class="area__title">Vídeo</h4>
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
							<h4 class="area__title">Agenda</h4>
							<ul>
								<li><a href="#" title="">II Seminário Internacional</a><ul><li>22/09/2015 - 24/09/2015</li><li>Recife</li></ul></li>
								<li><a href="#" title="">9° Congresso Brasileiro</a><ul><li>28/09/2015 - 01/10/2015</li><li>Belém</li></ul></li>
								<li><a href="#" title="">29° Encontro Nacional de Políticas Públicas </a><ul><li>28/09/2015 - 01/10/2015</li><li>Rio de Janeiro</li></ul></li>
								<li class="all-events-link"><a href="#" class="button wide" title="todos os eventos">Ver todos os eventos</a></li>
							</ul>
						</div>
					</div>
				</section>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
