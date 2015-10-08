<?php
/**
 * The sidebar containing the Call to Action widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-call-to-action' ) ) {
	return;
}
?>

<div class="widget-area widget-area--call-to-action site__section" role="complementary">
	<div class="row">
		<div class="large-12 columns">
			<?php dynamic_sidebar( 'sidebar-call-to-action' ); ?>
		</div>
	</div>
</div><!-- #secondary -->