<?php
/**
 * @package gridz
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title>
        <?php
            global $page, $paged, $gridz_options;
            wp_title();
        ?>
    </title>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header">
    <div class="wrapper">
        <?php gridz_site_logo(); ?>
        <div class="site-info">
            <?php gridz_site_info(); ?>
        </div>
        <div class="site-social">
            <?php gridz_social_links(); ?>
            <a href="javascript:void(0)" id="search-button"><span class="genericon-search"></span></a>
            <?php get_search_form(); ?>
        </div>
    </div>
</header>
<nav id="navigation">
    <div class="wrapper">
        <?php wp_nav_menu(array('theme_location' => 'primary', 'container_class' => 'primary-menu clearfix')); ?>
    </div>
</nav>
<?php gridz_responsive_menu(); ?>
<div id="content"<?php gridz_content_class(); ?>>
    <div class="wrapper">