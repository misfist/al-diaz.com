<?php 

/**
 * Al Diaz Custom Functions
 *
 * @author    Pea
 * @license   GPL-2.0+
 * @link      http://misfist.com
 * @since     1.0.0
 * @package   Al_Diaz_Custom
 *
 * @wordpress-plugin
 * Plugin Name:       Al Diaz Custom Functions
 * Plugin URI:        
 * Description:       Adds custom functions to the site
 * Version:           1.0.0
 * Author:            Pea
 * Author URI:        http://misfist.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       al_diaz_custom
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* ---------------------------------- *
 * Constants
 * ---------------------------------- */

if ( !defined( 'AL_DIAZ_CUSTOM_PLUGIN_DIR' ) ) {
    define( 'AL_DIAZ_CUSTOM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( !defined( 'AL_DIAZ_CUSTOM_PLUGIN_URL' ) ) {
    define( 'AL_DIAZ_CUSTOM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Include files
include_once( AL_DIAZ_CUSTOM_PLUGIN_DIR . '/inc/al-diaz-custom-fields.php' );


?>