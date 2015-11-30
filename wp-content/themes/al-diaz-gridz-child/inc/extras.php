<?php
/**
 * @package al-diaz-theme
 */


function al_diaz_audio_render() {

    if( get_field( 'audio_url' ) ) {

        $attr = array(
            'src'      => get_field( 'audio_url' ),
            'loop'     => '',
            'autoplay' => '',
            'preload' => 'none'
        );
        echo wp_audio_shortcode( $attr );

    }
    return;

}

/**
 * Social Profile
 */
function al_diaz_social_links($type = "profile") {
    $social = array(
        "facebook" => array(
            "name" => "facebook", 
            "profile_url" => 'https://www.facebook.com/bomb01', 
            "icon" => "facebook"
        ),
        "feed" => array(
            "name" => "feed", 
            "profile_url" => get_bloginfo('rss2_url'), 
            "icon" => "feed"
        ), 
    );
    $output = '';
    foreach($social as $entry) {
        $output .= '<a id="social-'.$type.'-'.$entry['name'].'" class="social-'.$type.'" href="'.esc_url($entry['profile_url']).'"><span class="genericon-'.$entry['icon'].'"></span></a>';
    }
    echo $output;
}




?>