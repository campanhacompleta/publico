<?php
/**
 * The sidebar containing the `content secondary` widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-content-secondary' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area widget-area--content-secondary site__section" role="complementary">
	<div class="row">
		<div class="large-12 columns">
			<?php dynamic_sidebar( 'sidebar-content-secondary' ); ?>
		</div>
	</div>
</div><!-- #secondary -->