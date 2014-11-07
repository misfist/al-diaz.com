<?php
/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'tie_register' ); 
function tie_register() {

	## Register All Scripts
    wp_register_script( 'tie-scripts', get_template_directory_uri() . '/js/tie-scripts.js', array( 'jquery' ) );  
    wp_register_script( 'tie-tabs', get_template_directory_uri() . '/js/tabs.min.js', array( 'jquery' ) );  
    wp_register_script( 'tie-validation', get_template_directory_uri() . '/js/validation.js', array( 'jquery' ) );  

	## Register All Styles
	wp_register_style( 'page-template', get_template_directory_uri().'/css/page-template.css', array(), '', 'all' );

	## Get Global Scripts
	wp_enqueue_script( 'tie-scripts' );

	## Get Validation Script
	if( tie_get_option('comment_validation') && ( is_page() || is_single() ) && comments_open() )
		wp_enqueue_script( 'tie-validation' );
	
	## Get Page Template Styles
	if(  is_page() || is_404() ) wp_enqueue_style( 'page-template' );
	
	## For facebook & Google + share
	if(  is_page() || is_single() )	tie_og_image();  ?>
	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/selectivizr-min.js"></script>
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie8.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie7.css" />
<![endif]-->
<?php
}


/*-----------------------------------------------------------------------------------*/
# Enqueue Fonts From Google
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'tie_loadmore_var');
function tie_loadmore_var() {
 	global $wp_query , $page , $paged , $query_string ;
	if( empty($paged) ) $paged = 1;
	
	$width = tie_get_option( 'post_width' );
	if( $width == 2 ) $width = '330';
	elseif( $width == 3 ) $width = '495';
	else $width = '240';
	
	$prettyPhoto = tie_get_option( 'lightbox_style' );
	if( empty($prettyPhoto) ) $prettyPhoto = 'light_rounded';
	if( is_home() ) $isHome = ' , "isHome" : "1"' ;
	?>
<script type='text/javascript'>
/* <![CDATA[ */
var tie = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>","paged" : "<?php echo $paged ?>" ,"maxPages" : "<?php echo $wp_query->max_num_pages ?>","loading":"<?php _e('Loading...' , 'tie') ?>" , "width" : "<?php echo $width ?>" , "prettyPhoto" : "<?php echo $prettyPhoto ?>" , "query" : "<?php echo $query_string ?>" <?php echo $isHome ?> };
/* ]]> */
<?php if( is_rtl() ){ ?>
jQuery.Isotope.prototype._positionAbs = function( x, y ) {
  return { right: x, top: y };
};
var transforms = false;
<?php }else{ ?>
var transforms = true;
<?php } ?>
</script>
<?php
}

 
/*-----------------------------------------------------------------------------------*/
# Enqueue Fonts From Google
/*-----------------------------------------------------------------------------------*/
function tie_enqueue_font ( $got_font) {
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
			
		$font_name = $font_pieces[0];
		$font_name = str_replace (" ","+", $font_pieces[0] );
				
		$font_variants = $font_pieces[1];
		$font_variants = str_replace ("|",",", $font_pieces[1] );
				
		wp_enqueue_style( $font_name , 'http://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants );
	}
}


/*-----------------------------------------------------------------------------------*/
# Get Font Name
/*-----------------------------------------------------------------------------------*/
function tie_get_font ( $got_font ) {
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
		$font_name = $font_pieces[0];	
		return $font_name;
	}
}


/*-----------------------------------------------------------------------------------*/
# Typography Elements Array
/*-----------------------------------------------------------------------------------*/
$custom_typography = array(
	"body"								=>		"typography_general",
	".entry-quote h1, .entry-quote h2, .entry-link h1, .entry-link h2"		=>		"typography_quote_link_text",
	"#main-nav, #main-nav ul li a"		=>		"typography_main_nav",
	".page-title"						=>		"typography_page_title",
	".entry-title"						=> 		"typography_post_title",
	"p.post-meta, p.post-meta a"		=> 		"typography_post_meta",
	".single .entry , .page .entry"		=> 		"typography_post_entry",
	"h4.widget-top, h4.widget-top a"					=> 		"typography_widgets_title",
	".footer-widget-top h4, .footer-widget-top h4 a"	=> 		"typography_footer_widgets_title",
	".entry h1"				=> 		"typography_post_h1",
	".entry h2"				=> 		"typography_post_h2",
	".entry h3"				=> 		"typography_post_h3",
	".entry h4"				=> 		"typography_post_h4",
	".entry h5"				=> 		"typography_post_h5",
	".entry h6"				=> 		"typography_post_h6"
);
	
	
/*-----------------------------------------------------------------------------------*/
# Get Custom Typography
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'tie_typography');
function tie_typography(){
	global $custom_typography;

	foreach( $custom_typography as $selector => $value){
		$option = tie_get_option( $value );
		tie_enqueue_font( $option['font'] ) ;
	}
}


/*-----------------------------------------------------------------------------------*/
# Tie Wp Head
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'tie_wp_head');
function tie_wp_head() {
	global $custom_typography;
	
if( !tie_get_option( 'disable_responsive' ) ){?>	
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
	
	if(tie_get_option('theme_skin')): 	?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style-<?php echo tie_get_option('theme_skin') ?>.css" />
<?php endif; ?>
<?php echo "\n"; ?>
<style type="text/css" media="screen"> 
<?php echo "\n"; ?>
<?php if( tie_get_option('background_type') == 'pattern' ):
	if(tie_get_option('background_pattern') ): ?>
body {background: <?php echo tie_get_option('background_pattern_color') ?> url(<?php echo get_template_directory_uri(); ?>/images/patterns/<?php echo tie_get_option('background_pattern') ?>.png) center;}
	<?php endif; ?>
<?php elseif( tie_get_option('background_type') == 'custom' ):
	$bg = tie_get_option( 'background' ); 
	if( tie_get_option('background_full') ): ?>
.background-cover{<?php echo "\n"; ?>
	background-color:<?php echo $bg['color'] ?>;
	background-image : url('<?php echo $bg['img'] ?>') ;<?php echo "\n"; ?>
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale');<?php echo "\n"; ?>
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale')";<?php echo "\n"; ?>
}
<?php else: ?>
body{background:<?php echo $bg['color'] ?> url('<?php echo $bg['img'] ?>') <?php echo $bg['repeat'] ?> <?php echo $bg['attachment'] ?> <?php echo $bg['hor'] ?> <?php echo $bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php endif; ?>
<?php
foreach( $custom_typography as $selector => $value){
$option = tie_get_option( $value );
if( $option['font'] || $option['color'] || $option['size'] || $option['weight'] || $option['style'] ):
echo "\n".$selector."{\n"; ?>
<?php if($option['font'] )
	echo "	font-family: '". tie_get_font( $option['font']  )."';\n"?>
<?php if($option['color'] )
	echo "	color :". $option['color'].";\n"?>
<?php if($option['size'] )
	echo "	font-size : ".$option['size']."px;\n"?>
<?php if($option['weight'] )
	echo "	font-weight: ".$option['weight'].";\n"?>
<?php if($option['style'] )
	echo "	font-style: ". $option['style'].";\n"?>
}
<?php endif;
} ?>
<?php if( tie_get_option( 'links_color' ) || tie_get_option( 'links_decoration' )  ): ?>
a {
	<?php if( tie_get_option( 'links_color' ) ) echo 'color: '.tie_get_option( 'links_color' ).';'; ?>
	<?php if( tie_get_option( 'links_decoration' ) ) echo 'text-decoration: '.tie_get_option( 'links_decoration' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'links_color_hover' ) || tie_get_option( 'links_decoration_hover' )  ): ?>
a:hover {
	<?php if( tie_get_option( 'links_color_hover' ) ) echo 'color: '.tie_get_option( 'links_color_hover' ).';'; ?>
	<?php if( tie_get_option( 'links_decoration_hover' ) ) echo 'text-decoration: '.tie_get_option( 'links_decoration_hover' ).';'; ?>
}
<?php endif; ?>
<?php $header_bg = tie_get_option( 'header_background' ); 
if( !empty( $header_bg['img']) || !empty( $header_bg['color'] ) ): ?>
header {background:<?php echo $header_bg['color'] ?> url('<?php echo $header_bg['img'] ?>') <?php echo $header_bg['repeat'] ?> <?php echo $header_bg['attachment'] ?> <?php echo $header_bg['hor'] ?> <?php echo $header_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'hedaer_border_color' ) ): ?>
.header-bar {<?php if( tie_get_option( 'hedaer_border_color' ) ) echo 'border-top-color: '.tie_get_option( 'hedaer_border_color' ).';'; ?>}
<?php endif; ?>
<?php 
$topbar_bg = tie_get_option( 'topbar_background' ); 
if( !empty( $topbar_bg['img']) || !empty( $topbar_bg['color'] ) ): ?>
#main-nav , #main-nav ul ul {background:<?php echo $topbar_bg['color'] ?> url('<?php echo $topbar_bg['img'] ?>') <?php echo $topbar_bg['repeat'] ?> <?php echo $topbar_bg['attachment'] ?> <?php echo $topbar_bg['hor'] ?> <?php echo $topbar_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'topbar_links_color' ) ): ?>
#main-nav ul li a , #main-nav ul ul a {
	<?php if( tie_get_option( 'topbar_links_color' ) ) echo 'color: '.tie_get_option( 'topbar_links_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'topbar_links_color_hover' ) ): ?>
#main-nav ul li a:hover, #main-nav ul li:hover > a, #main-nav ul :hover > a  {
	<?php if( tie_get_option( 'topbar_links_color_hover' ) ) echo 'color: '.tie_get_option( 'topbar_links_color_hover' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'current_background' ) || tie_get_option( 'current_color' ) || tie_get_option( 'current_border' ) ): ?>
#main-nav ul li.current-menu-item a, #main-nav ul li.current-menu-item a:hover {
	<?php if( tie_get_option( 'current_background' ) ) echo 'background: '.tie_get_option( 'current_background' ).';'; ?>
	<?php if( tie_get_option( 'current_color' ) ) echo 'color: '.tie_get_option( 'current_color' ).';'; ?>
	<?php if( tie_get_option( 'current_border' ) ) echo 'border-top-color: '.tie_get_option( 'current_border' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'scroll_to_top' ) ): ?>
.scrollToTop {
	background-color: <?php echo tie_get_option( 'scroll_to_top' ) ?> ;
}
<?php endif; ?>
<?php if( tie_get_option( 'filter_current' ) ): ?>
#filters li.current a, #filters li a:hover {
	background-color: <?php echo tie_get_option( 'filter_current' ) ?> ;
}
<?php endif; ?>
<?php if( tie_get_option( 'boxes_bg' ) ): ?>
.item-list , .widget {<?php if( tie_get_option( 'boxes_bg' ) ) echo 'background: '.tie_get_option( 'boxes_bg' ).';'; ?>}
<?php endif; ?>

<?php if( tie_get_option( 'quote_bg' ) ): ?>
.entry-quote, .entry-link{ <?php if( tie_get_option( 'quote_bg' ) ) echo 'background: '.tie_get_option( 'quote_bg' ).';'; ?>}
<?php endif; ?>
<?php if( tie_get_option( 'quote_links_color' ) || tie_get_option( 'quote_links_decoration' )  ): ?>
.quote-link a , .link-url a, .entry-link a {
	<?php if( tie_get_option( 'quote_links_color' ) ) echo 'color: '.tie_get_option( 'quote_links_color' ).';'; ?>
	<?php if( tie_get_option( 'quote_links_decoration' ) ) echo 'text-decoration: '.tie_get_option( 'quote_links_decoration' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'quote_links_color_hover' ) || tie_get_option( 'quote_links_decoration_hover' )  ): ?>
.quote-link a:hover, .link-url a:hover, .entry-link a:hover {
	<?php if( tie_get_option( 'quote_links_color_hover' ) ) echo 'color: '.tie_get_option( 'quote_links_color_hover' ).';'; ?>
	<?php if( tie_get_option( 'quote_links_decoration_hover' ) ) echo 'text-decoration: '.tie_get_option( 'quote_links_decoration_hover' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'post_links_color' ) || tie_get_option( 'post_links_decoration' )  ): ?>
.post .entry a {
	<?php if( tie_get_option( 'post_links_color' ) ) echo 'color: '.tie_get_option( 'post_links_color' ).';'; ?>
	<?php if( tie_get_option( 'post_links_decoration' ) ) echo 'text-decoration: '.tie_get_option( 'post_links_decoration' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'post_links_color_hover' ) || tie_get_option( 'post_links_decoration_hover' )  ): ?>
.post .entry a:hover {
	<?php if( tie_get_option( 'post_links_color_hover' ) ) echo 'color: '.tie_get_option( 'post_links_color_hover' ).';'; ?>
	<?php if( tie_get_option( 'post_links_decoration_hover' ) ) echo 'text-decoration: '.tie_get_option( 'post_links_decoration_hover' ).';'; ?>
}
<?php endif; ?>
<?php $footer_bg = tie_get_option( 'footer_background' ); 
if( !empty( $footer_bg['img']) || !empty( $footer_bg['color'] ) ): ?>
footer {background:<?php echo $footer_bg['color'] ?> url('<?php echo $footer_bg['img'] ?>') <?php echo $footer_bg['repeat'] ?> <?php echo $footer_bg['attachment'] ?> <?php echo $footer_bg['hor'] ?> <?php echo $footer_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'footer_title_color' ) ): ?>
.footer-widget-top h3 {	<?php if( tie_get_option( 'footer_title_color' ) ) echo 'color: '.tie_get_option( 'footer_title_color' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'footer_links_color' ) ): ?>
footer a  {	<?php if( tie_get_option( 'footer_links_color' ) ) echo 'color: '.tie_get_option( 'footer_links_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'footer_links_color_hover' ) ): ?>
footer a:hover {<?php if( tie_get_option( 'footer_links_color_hover' ) ) echo 'color: '.tie_get_option( 'footer_links_color_hover' ).' !important;'; ?>
}
<?php endif; ?>
<?php echo htmlspecialchars_decode( tie_get_option('css') ) , "\n";?>
<?php if( tie_get_option('css_tablets') ) : ?>
@media only screen and (max-width: 985px) and (min-width: 768px){
<?php echo htmlspecialchars_decode( tie_get_option('css_tablets') ) , "\n";?>
}
<?php endif; ?>
<?php if( tie_get_option('css_wide_phones') ) : ?>
@media only screen and (max-width: 767px) and (min-width: 480px){
<?php echo htmlspecialchars_decode( tie_get_option('css_wide_phones') ) , "\n";?>
}
<?php endif; ?>
<?php if( tie_get_option('css_phones') ) : ?>
@media only screen and (max-width: 479px) and (min-width: 320px){
<?php echo htmlspecialchars_decode( tie_get_option('css_phones') ) , "\n";?>
}
<?php endif; ?>

</style> 

<?php
echo htmlspecialchars_decode( tie_get_option('header_code') ) , "\n";
}
?>