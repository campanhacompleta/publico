<?php
/**
 * Público Theme Customizer.
 *
 * @package Público
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function publico_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Branding section
    $wp_customize->add_section( 'publico_branding', array(
        'title'    => __( 'Branding', 'publico' ),
        'priority' => 30,
    ) );
    
    // Branding section: logo uploader
    $wp_customize->add_setting( 'publico_logo', array(
        'capability'  => 'edit_theme_options',
        'sanitize_callback' => 'publico_get_customizer_logo_size',
    ) );
        
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'publico_logo', array(
        'label'     => __( 'Logo', 'publico' ),
        'section'   => 'publico_branding',
        'settings'  => 'publico_logo',
        //'context'   => 'publico-custom-logo'
    ) ) );

    // Footer section
    $wp_customize->add_section( 'publico_footer', array(
        'title'    => __( 'Footer', 'publico' ),
        'priority' => 30,
    ) );
    
    // Footer section: text
    $wp_customize->add_setting( 'publico_footer_text', array(
        'capability'    => 'edit_theme_options',
        'default'       => __( 'Proudly powered by WordPress', 'publico' ),
        'sanitize_callback' => 'publico_sanitize_footer_text',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'publico_footer_text_control',
            array(
                'label'          => __( 'Footer text', 'publico' ),
                'section'        => 'publico_footer',
                'settings'       => 'publico_footer_text',
            )
        )
    );
}
add_action( 'customize_register', 'publico_customize_register' );

/**
 * Get 'publico_logo' ID and use it to define the default logo size
 * 
 * @param  string $value The attachment guid, which is the full imagem URL
 * @return string $value The new image size for 'publico_logo'
 */
function publico_get_customizer_logo_size( $value ) {
    global $wpdb;
	if(!empty( $value) )
	{
	    if ( ! is_numeric( $value ) ) {
	        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid = %s ORDER BY post_date DESC LIMIT 1;", $value ) );
	        if ( ! is_wp_error( $attachment_id ) && wp_attachment_is_image( $attachment_id ) )
	            $value = $attachment_id;
	    }
	
	    $image_attributes = wp_get_attachment_image_src( $value, 'medium' );
	    $value = $image_attributes[0];
	}
    return $value;
}

/**
 * Sanitize Footer Text
 * 
 * @param  string $value The string
 * @return string $value The new string
 *
 * @uses strip_tags
 */
function publico_sanitize_footer_text( $value ) {
    return strip_tags( $value, '<br><br/><em><strong>');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function publico_customize_preview_js() {
	wp_enqueue_script( 'publico_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'publico_customize_preview_js' );
