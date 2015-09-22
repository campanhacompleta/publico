<?php
/**
 * The sidebar containing the `social engagement` widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-social-engagement' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area widget-area--social-engagement site__section" role="complementary">
	<div class="row">
		<div class="large-12 columns">
			<?php dynamic_sidebar( 'sidebar-social-engagement' ); ?>
		</div>
	</div>
</div><!-- #secondary -->