<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything untill Primary Navigation
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>
<!doctype html>
<!--[if IE 6 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<?php		
		/** sampression hooks **/
		// Metas
		do_action( 'sampression_meta' );
		// Title
		do_action( 'sampression_title' );
		// Favicons
		do_action( 'sampression_favicon' );
		// CSS
		do_action( 'sampression_styles' );
		// Custom header styles
		do_action('sampression_custom_header_style');
		// Links
		do_action( 'sampression_links' );
		
		wp_head();
	?>
</head>

<body <?php body_class('top'); ?>>
<header id="header">
  <div class="container">
    <div class="columns nine">
	
			<?php
            if(get_option('opt_sam_use_logo') == 'no' && get_option('opt_sam_logo')) {
						do_action('sampression_logo');
				} else {
			?>
			
			<div class="logo-txt">
			  <h1 class="site-title" id="site-title">
			  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			  <?php bloginfo( 'name' ); ?>
			  </a>
			  </h1>
			  <h2 id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
        <?php } ?>
    </div>
    <div class="columns seven">
      <nav id="top-nav">
        <?php
		//Check if the Custom Navigation is available
		if ( has_nav_menu('top-menu') ) {
			wp_nav_menu( array (
				'theme_location'    => 'top-menu',
				'container'         => '',
				'menu_class'        => 'top-menu clearfix',
				'depth'             => 0, // set to 1 to disable dropdowns
				'fallback_cb'       => false
			));
		} else {
		// Otherwise list the Pages
			 ?>
			<ul class="top-menu clearfix">
				<?php wp_list_pages('title_li=&depth=0'); ?>
			</ul>
			<?php
		} ?>
      </nav><!-- #top-nav-->
	  <div id="top-nav-mobile">
				
				
	  </div> 
      <!-- #top-nav-mobile-->
      <div id="interaction-sec" class="clearfix <?php echo getnoofclass(); ?>">
        <?php get_search_form(); ?>
     
       <ul class="sm-top">
       <?php // Being Social 
	   //Facebook
	    if( get_option( 'opt_get_facebook' ) !=''){ ?>
          <li class="sm-top-fb"><a href="<?php echo stripslashes(get_option( 'opt_get_facebook' )); ?>" target="_blank">Facebook</a></li>
       <?php }
		// Twitter
	   if( get_option( 'opt_get_twitter' ) !='') {
	    ?>
          <li class="sm-top-tw"><a href="<?php echo stripslashes(get_option( 'opt_get_twitter') ); ?>" target="_blank">Twitter</a></li>
         <?php }
		// Google plus 
	   if( get_option( 'opt_get_gplus' ) !='') {
	    ?>
          <li class="sm-top-gplus"><a href="<?php echo stripslashes(get_option( 'opt_get_gplus') ); ?>" target="_blank">Google Plus</a></li>
          <?php } 
		// Youtube
		if( get_option( 'opt_get_youtube' ) !='' ) {
	    ?>
          <li class="sm-top-youtube"><a href="<?php echo stripslashes(get_option( 'opt_get_youtube') ); ?>" target="_blank">YouTube</a></li>
          <?php } ?> 
       </ul>
        <!-- .sm-top --> 
      </div>
      <!-- #interaction-sec -->
    </div>
	<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
  </div>
</header>
<!-- #header -->
<?php if(is_home()): ?>
<span id="primary-nav-scroll"></span>
<nav id="primary-nav">
  <div class="container">
  <a href="#" id="btn-nav-opt">show/hide</a>
  <div class="columns sixteen">
    <div class="nav-label"><?php _e('Filter By:','sampression'); ?></div>
	
    <ul class="nav-listing clearfix" id="filter">
        <li><a href="#" class="active selected" data-filter="*" data-group="all"><span></span><?php _e('Show All','sampression'); ?></a></li>
        <?php
		/*to exclude some categories */ 
		$args = array( 'hide_empty' => 1);
		$categories = get_categories($args);
        foreach($categories as $category):
        ?>
        <li><a href="#" data-filter=".<?php echo $category->slug; ?>" data-group="<?php echo $category->slug; ?>" id="<?php echo $category->slug; ?>"><span></span><?php echo $category->name; ?></a></li>
        <?php
        endforeach;
        ?>
    </ul>
       
    <!-- Check Viewport: If the normal design couldn't fit with viewport, the Categories will appear via CSS with Select Menu form -->
	 
                <?php
        $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        if ($iPod || $iPhone || $iPad) {
            ?>

            <select id="get-cat-ios">
                <option value="<?php echo esc_url(home_url('/')); ?>"><?php _e('Show All', 'sampression'); ?></option>
                <?php
                foreach ($categories as $category):
                    ?>
                    <option value="<?php echo get_term_link($category->slug, 'category'); ?>"><?php echo $category->name; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
            <?php
        } else{
            
            ?>
        <select name="get-cats" id="get-cats" >         
            <option value="all">Show all</option>
                    <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->slug;
                        ?>"><?php echo $category->name; ?></option>         <?php endforeach;
                    ?>     </select> 
        <?php } ?>
    </div>
  </div>
</nav>
<!-- #primary-nav -->
<?php endif; ?>
<div id="content-wrapper">
<div class="container">