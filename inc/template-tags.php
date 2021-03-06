<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Público
 */

if ( ! function_exists( 'publico_the_page_header' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function publico_the_page_header() {
	global $post;

	if ( is_front_page() ) {
		return;
	}

	if ( have_posts() ) :

		if ( is_singular() ) {
			while ( have_posts() ) : the_post();
				$page_header_content = '<h1 class="entry-title page-title">' . get_the_title( $post->ID ) . '</h1>';

				if ( is_single() && 'post' == get_post_type() ) {
					$page_header_content .= '<div class="entry-meta">' . publico_get_posted_on() . '</div><!-- .entry-meta -->';
				}
				elseif ( is_page() ) {
					if ( has_excerpt() ) {
						$page_header_content .= '<div class="page-description taxonomy-description">' . get_the_excerpt() . '</div>';
					}
				}
			endwhile;
		}
		elseif ( is_search() ) {
			$page_header_content = '<h1 class="page-title">' . sprintf( esc_html__( 'Search Results for: %s', 'publico' ), '<span>' . get_search_query() ) . '</span></h1>';
		}
		else {

			if ( is_home() && get_option( 'page_for_posts' ) ) {
				$page_header_content = '<h1 class="entry-title page-title">' . get_page( get_option( 'page_for_posts' ) )->post_title . '</h1>';

				$excerpt = get_page( get_option( 'page_for_posts' ) )->post_excerpt;

				if ( ! empty( $excerpt ) ) {
					$page_header_content .= '<div class="page-description taxonomy-description">' . $excerpt . '</div>';
				}
			}
			else {
				$page_header_content = '<h1 class="page-title">' . get_the_archive_title() . '</h1>';
				$description = get_the_archive_description();

			    if ( $description ) {
			        $page_header_content .= '<div class="page-description taxonomy-description">' . $description . '</div>';
			    }
			}
		}

		echo '<header class="page-header site__section" aria-hidden="true"><div class="row"><div class="large-12 columns">';
		echo $page_header_content;
		echo '</div></div></header><!-- .page-header -->';

	else :
		echo '<header class="page-header site__section" aria-hidden="true"><div class="row"><div class="large-12 columns">';
		echo '<h1 class="page-title">' . esc_html__( 'Oops! That page can&rsquo;t be found.', 'publico' ) . '</h1>';
		echo '<div class="page-description taxonomy-description">';
		echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'publico' );
		echo '</div>';
		echo '</div></div></header><!-- .page-header -->';

	endif;
}
endif;

if ( ! function_exists( 'publico_get_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function publico_get_posted_on() {
	global $post;

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'publico' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'publico' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	return '<span class="posted-on">' . $posted_on . '</span><span class="byline screen-reader-text"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'publico_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function publico_posted_on() {
	echo publico_get_posted_on();
}
endif;

if ( ! function_exists( 'publico_the_first_embed' ) ) :
/**
 * Prints HTML with the first embed inside the post content
 *
 * @uses get_media_embedded_in_content()
 * @link http://wordpress.stackexchange.com/questions/175793/get-first-video-from-the-post-both-embed-and-video-shortcodes
 */
function publico_the_first_embed( $post_id ) {
    $post = get_post( $post_id );

    // Get the content, apply filters and execute shortcodes
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content );

    if ( ! empty ( $embeds ) ) {
    	// The first item of the array is the first embedded media in the content
		$first_embed = $embeds[0];
		echo $first_embed;
   	}
}
endif;

if ( ! function_exists( 'publico_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function publico_entry_footer() {
	publico_entry_share();

	edit_post_link( esc_html__( 'Edit', 'publico' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function publico_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'publico_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'publico_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so publico_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so publico_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'publico_entry_share' ) ) :
/**
 * Prints HTML with share buttons
 */
function publico_entry_share() {

	$permalink = wp_get_shortlink();
	?>
	<div class="entry-share">
		<h4 class="area__title"><?php _e( 'Compartilhe', 'publico' ); ?></h4>
		<ul class="share-list">
			<li class="share__item">
				<a href="https://twitter.com/home?status=<?php echo $permalink; ?>" target="_blank" class="share-link share-link--twitter">Twitter</a>
			</li>
			<li class="share__item">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>" target="_blank" class="share-link share-link--facebook">Facebook</a>
			</li>
			<li class="share__item">
				<a href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" class="share-link share-link--googleplus">Google+</a>
			</li>
		</ul>
	</div>
	<?php
}
endif;

/**
 * Flush out the transients used in publico_categorized_blog.
 */
function publico_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'publico_categories' );
}
add_action( 'edit_category', 'publico_category_transient_flusher' );
add_action( 'save_post',     'publico_category_transient_flusher' );
