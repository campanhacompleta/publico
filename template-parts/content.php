<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Público
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header flag flag--colored">
		<div class="flag__image">
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-image">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
			</div><!-- .entry-image -->
			<?php endif; ?>
		</div>

		<div class="flag__body flag__body--padded">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php publico_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php publico_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
