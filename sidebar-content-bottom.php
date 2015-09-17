<?php
/**
 * The sidebar containing the `content bottom` widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-content-bottom' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area widget-area--content-bottom site__section" role="complementary">
	<div class="row">
		<div class="large-12 columns">
			<?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
		</div>
	</div>
</div><!-- #secondary -->