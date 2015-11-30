<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying search forms
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>
<form method="get" class="search-form clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="hidden"><?php _e( 'Search for:', 'sampression' ); ?></label>
    <input type="text" value="<?php the_search_query(); ?>" name="s" class="search-field text-field" placeholder="<?php _e( 'search by keyword', 'sampression' ); ?>" />
    <input type="submit" class="search-submit" value="<?php _e( 'Search', 'sampression' ); ?>" />
</form>