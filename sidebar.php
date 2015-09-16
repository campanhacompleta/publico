<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>

<div class="medium-4 columns">
	<div id="secondary" class="widget-area widget-area--main site__section" role="complementary">
		<?php dynamic_sidebar( 'sidebar-main' ); ?>
	</div><!-- #secondary -->
</div>
