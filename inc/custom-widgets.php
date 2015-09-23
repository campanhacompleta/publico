<?php
/**
 * Core class used to implement a Publico_Widget_Video widget.
 *
 */
function publico_register_widgets() {
	register_widget( 'Publico_Widget_Video' );
}
add_action( 'widgets_init', 'publico_register_widgets' );

/**
 * Widget API: Publico_Widget_Video class
 *
 */

/**
 * Core class used to implement a Publico_Widget_Video widget.
 *
 * @uses publico_the_first_embed()
 * @see WP_Widget
 */
class Publico_Widget_Video extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_featured_video', 'description' => __( "Feature a video from post format Video") );
		parent::__construct('publico-featured-video', __('Featured Video'), $widget_ops);
		$this->alt_option_name = 'widget_featured_video';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_featured_video', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Featured Video' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		/**
		 * Filter the arguments for the Featured Video widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the Featured Video.
		 */

		$video = new WP_Query( array (
			'posts_per_page' => 1,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-video' ),
				),
			)
		) );

		if ($video->have_posts()) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php while ( $video->have_posts() ) : $video->the_post(); ?>
			<article id="post-<?php the_ID(); ?>">
				<header class="entry-header">
					<div class="entry-video">
						<?php publico_the_first_embed( $post->ID ); ?>
					</div>
				</header><!-- .entry-header -->
		<?php endwhile; ?>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_featured_video', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_featured_video']) )
			delete_option('widget_featured_video');

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete('widget_featured_video', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
<?php
	}
}