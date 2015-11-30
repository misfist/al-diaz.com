<?php 

/**
 * Al Diaz Custom Fields
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


if( function_exists('acf_add_local_field_group') ) {

    acf_add_local_field_group( array(
        'key' => 'group_565bbd3be131b',
        'title' => 'Link Format',
        'fields' => array(
            array (
                'key' => 'field_565bbd4b06875',
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'Enter Link URL',
            ),
        ),
        'location' => array(
            array (
                array (
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'link',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'revisions',
            1 => 'author',
            2 => 'page_attributes',
            3 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_565bbd8663ee7',
        'title' => 'Video Format',
        'fields' => array(
            array (
                'key' => 'field_565bbd9aa210c',
                'label' => 'Video URL',
                'name' => 'video_url',
                'type' => 'oembed',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'width' => '',
                'height' => '',
            ),
        ),
        'location' => array(
            array (
                array (
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'video',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'custom_fields',
            1 => 'revisions',
            2 => 'author',
            3 => 'page_attributes',
            4 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_565bec06b0d4e',
        'title' => 'Audio Format',
        'fields' => array(
            array(
                'key' => 'field_565bec1751cdb',
                'label' => 'Audio URL',
                'name' => 'audio_url',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'audio',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'revisions',
            1 => 'author',
            2 => 'page_attributes',
            3 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    ));


}


?>