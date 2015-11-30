<?php
/**
 * @package al-diaz-theme
 */

# Add custom scripts and styles
add_action( 'wp_enqueue_scripts', 'al_diaz_theme_enqueue_scripts', 5 );
add_action( 'wp_enqueue_scripts', 'al_diaz_theme_enqueue_styles',  9 );

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function al_diaz_theme_enqueue_scripts() {

    // wp_register_script( 'al-diaz-child', trailingslashit( get_stylesheet_directory() ) . '/assets/scripts/main.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'al-diaz-child' );

    
}


/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function al_diaz_theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );

    wp_register_style( 'al-diaz-child', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/styles/style.min.css' );

    wp_enqueue_style( 'al-diaz-child' );

}

?>