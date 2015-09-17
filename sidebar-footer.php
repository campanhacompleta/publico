<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Público
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<div id="quaternary" class="widget-area widget-area--footer site__section" role="complementary">
	<div class="row">
		<div class="large-12 columns">		
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		</div>
	</div>
</div><!-- .widget-area--footer -->

