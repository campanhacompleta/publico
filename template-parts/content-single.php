<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Público
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title show-for-sr">', '</h1>' ); ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-image">
				<?php the_post_thumbnail( 'large' ); ?>
			</div><!-- .entry-image -->
		<?php endif; ?>
		<div class="entry-meta">
			<?php publico_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'publico' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php publico_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

