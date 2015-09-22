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

	if ( is_singular() ) {
		$page_header_content = '<h1 class="entry-title page-title">' . get_the_title( $post->ID ) . '</h1>';
	}
	elseif ( is_search() ) {
		$page_header_content = '<h1 class="page-title">' . sprintf( esc_html__( 'Search Results for: %s', 'publico' ), '<span>' . get_search_query() ) . '</span></h1>';
	}
	else {
		$page_header_content = '<h1 class="page-title">' . get_the_archive_title() . '</h1>';
		$description = get_the_archive_description();

	    if ( $description ) {
	        $page_header_content .= '<div class="page-description taxonomy-description">' . $description . '</div>';
	    }
	}
	
	echo '<header class="page-header site__section" aria-hidden="true"><div class="row"><div class="large-12 columns">';
	echo $page_header_content;
	echo '</div></div></header><!-- .page-header -->';
}
endif;

if ( ! function_exists( 'publico_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function publico_posted_on() {
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

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'publico_the_newsletter' ) ) :
/**
 * Prints HTML with the newsletter form
 */
function publico_the_newsletter() {
	
	echo '<div class="site-newsletter site__section"><div class="row">';
	echo '
	<div class="sendpress-signup-form">
			<h4 class="area__title">Cadastre-se</h4>
			<form id="sendpress_signup" method="POST" class="sendpress-signup">
									
				<div id="form-wrap">
					<div class="medium-4 columns">
					<p name="firstname">
						<input type="text" class="sp_firstname" orig="Nome" value="" placeholder="Nome" name="sp_firstname">
					</p>
					</div>
					<div class="medium-4 columns">
					<p name="email">
						<input type="text" class="sp_email" orig="E-Mail" value="" placeholder="Email" name="sp_email">
					</p>
					</div>
					<div class="medium-4 columns">
					<p class="submit">
						<input value="Cadastrar" class="sendpress-submit button small wide" type="submit" id="submit" name="submit">
					</p>
					</div>
				</div>
			</form>
		</div>';
	echo '</div></div>';

}
endif;

if ( ! function_exists( 'publico_the_first_embed' ) ) :
/**
 * Prints HTML with the first embed inside the post content
 *
 * @uses get_media_embedded_in_content()
 */
function publico_the_first_embed( $post_id ) {
    $post = get_post( $post_id );

    // Get the content, apply filters and execute shortcodes
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content );

    if( ! empty ( $embeds ) ) {
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
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'publico' ) );
		if ( $categories_list && publico_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'publico' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'publico' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'publico' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'publico' ), esc_html__( '1 Comment', 'publico' ), esc_html__( '% Comments', 'publico' ) );
		echo '</span>';
	}

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
