<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Público
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function publico_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'publico_body_classes' );

/**
 * Loop through sidebar widgets and add some custom classes
 * 
 * @link http://colourstheme.com/2015/03/add-class-to-first-and-last-widget/ Reference #1
 * @link https://gist.github.com/slobodan/6156076 Reference #2
 */
function publico_add_widget_custom_classes() {
    global $wp_registered_sidebars, $wp_registered_widgets;
 
    // Find those widgets
    $sidebars = wp_get_sidebars_widgets();
 
    if ( empty( $sidebars ) ) {
        return;
    }
 
    // Loop through each widget and add new classes
    foreach ( $sidebars as $sidebar_id => $widgets ) {
        if ( empty ( $widgets ) || 'sidebar-main' == $sidebar_id ) {
        	continue;
        }
 
        // Get the number of widgets on the sidebar
        $number_of_widgets = count( $widgets );
        
        foreach ( $widgets as $i => $widget_id ) {

        	// Widget order
        	$wp_registered_widgets[$widget_id]['classname'] .= ' widget-order-' . ( $i + 1 ) . ' ' . $sidebar_id;
        	
        	// Widget Area count
        	$wp_registered_widgets[$widget_id]['classname'] .= ' widget-count-' . $number_of_widgets;
 
 		// Add first widget class
 		if ( 0 == $i ) {
 			$wp_registered_widgets[$widget_id]['classname'] .= ' widget-first';
 		}
 
 		// Add last widget class
 		if ( $number_of_widgets == ( $i + 1 ) ) {
 			$wp_registered_widgets[$widget_id]['classname'] .= ' widget-last';
 		}
 		
 		// Add specific widget classes
 		if ( $number_of_widgets % 4 == 0 || $number_of_widgets > 6 ) { 
 			// Four widgets er row if there are exactly four or more than six
 			$wp_registered_widgets[$widget_id]['classname'] .= ' medium-3';
 		} elseif ( $number_of_widgets >= 3 ) {
 			// Three widgets per row if there's three or more widgets 
 			$wp_registered_widgets[$widget_id]['classname'] .= ' medium-4';
 		} elseif ( 2 == $number_of_widgets ) { 
 			// Otherwise show two widgets per row, but with a special layout design for Content Secondary Widget Area ('sidebar-content-secondary')
 			if ( $sidebar_id == 'sidebar-content-secondary' && ( 0 == $i ) ) {
 				$wp_registered_widgets[$widget_id]['classname'] .= ' medium-8';
 			}
 			elseif ( $number_of_widgets == ( $i + 1 ) ) {
 				$wp_registered_widgets[$widget_id]['classname'] .= ' medium-4';
 			}
 			else {
 				$wp_registered_widgets[$widget_id]['classname'] .= ' medium-6';
 			}
 		}
 		
 		// Add Foundation columns
 		$wp_registered_widgets[$widget_id]['classname'] .= ' columns';
        }
    }
}
add_action( 'init', 'publico_add_widget_custom_classes' );

/**
 * Add Foundation classes to edit post link
 * 
 * @param $output The old class
 * @return $output The new classes
 */
function publico_add_edit_post_link_classes( $output ) {
    $output = str_replace( 'class="post-edit-link"', 'class="post-edit-link button small"', $output  );
    return $output;
}
add_filter( 'edit_post_link', 'publico_add_edit_post_link_classes' );

/**
 * Adds a callback function for 'wp_list_comments()'
 *
 * @since 1.0.0
 */
function publico_wp_list_comments_callback( $comment, $args, $depth ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '' ); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body flag">
                <footer class="comment-meta">
                    <div class="flag__image">
                        <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    </div>
                    <div class="flag__body">
                        <div class="comment-author vcard">
                            <?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
                        </div><!-- .comment-author -->

                        <div class="comment-metadata">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>" class="time-link">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .comment-metadata -->

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                        <?php endif; ?>
                    </div><!-- .flag__body -->
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <?php
                comment_reply_link( array_merge( $args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply">',
                    'after'     => '</div>'
                ) ) );
                ?>
            </article><!-- .comment-body -->
<?php
}
