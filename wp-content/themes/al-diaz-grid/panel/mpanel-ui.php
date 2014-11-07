<?php


function panel_options() { 

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1 ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	
$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save" type="submit" value="Save Changes" />    
	</div>'; 
?>
		
		
<div id="save-alert"></div>

<div class="mo-panel">

	<div class="mo-panel-tabs">
		<div class="logo"></div>
		<ul>
			<li class="tabs general"><a href="#tab1"><span></span>General Settings</a></li>
			<li class="tabs homepage"><a href="#tab2"><span></span>Layout settings</a></li>
			<li class="tabs header"><a href="#tab9"><span></span>Header Settings</a></li>
			<li class="tabs archives"><a href="#tab12"><span></span>Archives Settings</a></li>
			<li class="tabs article"><a href="#tab6"><span></span>Article Settings</a></li>
			<li class="tabs sidebars"><a href="#tab11"><span></span>Sidebars</a></li>
			<li class="tabs footer"><a href="#tab7"><span></span>Footer Settings</a></li>
			<li class="tabs banners"><a href="#tab8"><span></span>Banners Settings</a></li>
			<li class="tabs styling"><a href="#tab13"><span></span>Styling</a></li>
			<li class="tabs typography"><a href="#tab14"><span></span>Typography</a></li>
			<li class="tabs Social"><a href="#tab4"><span></span>Social Networking</a></li>
			<li class="tabs advanced"><a href="#tab10"><span></span>Advanced</a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->
	
	
	<div class="mo-panel-content">
	<form action="/" name="tie_form" id="tie_form">

	
		<div id="tab1" class="tabs-wrap">
			<h2>General Settings</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>Favicon</h3>
				<?php
					tie_options(
						array(	"name" => "Custom Favicon",
								"id" => "favicon",
								"type" => "upload"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Custom Gravatar</h3>
				
				<?php
					tie_options(
						array(	"name" => "Custom Gravatar",
								"id" => "gravatar",
								"type" => "upload"));
				?>
			</div>	
					
			<div class="tiepanel-item">
				<h3>Breadcrumbs Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Breadcrumbs ",
								"id" => "breadcrumbs",
								"type" => "checkbox")); 
					
					tie_options(
						array(	"name" => "Breadcrumbs Delimiter",
								"id" => "breadcrumbs_delimiter",
								"type" => "short-text"));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>LightBox Setting</h3>
				<?php
					tie_options(
						array(	"name" => "LightBox Style",
								"id" => "lightbox_style",
								"type" => "select",
								"options" => array( "light_rounded"=>"Light Rounded" ,
													"light_square"=>"Light Square" ,
													"dark_square"=>"Dark Square" ,
													"dark_rounded"=>"Dark Rounded" ,
													"pp_default"=>"Pretty Style" ,
													"facebook"=>"Facebook" )));
				?>
			</div>
						
			<div class="tiepanel-item">
				<h3>Header Code</h3>
				<div class="option-item">
					<small>The following code will add to the &lt;head&gt; tag. Useful if you need to add additional scripts such as CSS or JS.</small>
					<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Code</h3>
				<div class="option-item">
					<small>The following code will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to Javascript or tracking code.</small>

					<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		<div id="tab9" class="tabs-wrap">
			<h2>Header Settings</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>Logo</h3>
				<?php
					tie_options(
						array( 	"name" => "Logo Setting",
								"id" => "logo_setting",
								"type" => "radio",
								"options" => array( "logo"=>"Custom Image Logo" ,
													"title"=>"Display Site Title" )));
				?>
								
				<?php
					tie_options(
						array(	"name" => "Custom Logo Image",
								"id" => "logo",
								"help" => "Upload a logo image, or enter URL to an image if it is already uploaded. the theme default logo gets applied if the input field is left blank.",
								"type" => "upload"));
				?>

				<?php
					tie_options(
						array(	"name" => "Logo Margin Top",
								"id" => "logo_margin",
								"type" => "slider",
								"help" => "Input number to set the top space of the logo .",
								"unit" => "px",
								"max" => 100,
								"min" => 0 ));
				?>

			</div>
			

			<div class="tiepanel-item">
				<h3>Header Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Header Layout",
								"id" => "header_layout",
								"type" => "radio",
								"options" => array( "1"=>"Search - Logo - Social icons" ,
													"2"=>"Logo - Search - Social icons" )));

					tie_options(
						array(	"name" => "Fix Header while scrolling",
								"id" => "haeder_fix",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Transparent Header while scrolling",
								"id" => "haeder_transparent",
								"type" => "checkbox")); 			
				?>		
			</div>
			
			<div class="tiepanel-item">
				<h3>Welcome box settings</h3>
				<?php
					tie_options(
						array(	"name" => "Enable Welcome box",
								"id" => "welcome_box",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Display to",
								"id" => "welcome_display",
								"type" => "radio",
								"options" => array( "1"=>"Everyone" ,
													"2"=>"Eegistered users only" ,
													"3"=>"Guests only" )));
				?>
				
				<div class="option-item">
					<span class="label" style="margin-bottom: 10px; float:none;">Welcome box message</span>
					<textarea id="welcome_msg" name="tie_options[welcome_msg]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('welcome_msg'));  ?></textarea>				
					<small>Enter Text , Html or Shortcodes</small>
				</div>
			</div>								
		</div> <!-- Header Settings -->
		
		
		
		<div id="tab2" class="tabs-wrap">
			<h2>Layout Settings</h2> <?php echo $save ?>
		
			<div class="tiepanel-item">
				<h3>Layout Settings</h3>
				<?php
				
					tie_options(
						array( 	"name" => "Excerpt Length",
								"id" => "exc_length",
								"type" => "short-text"));
								
					tie_options(
						array( 	"name" => "Index and Archives displays",
								"id" => "on_home",
								"type" => "radio",
								"options" => array( "latest"=>"Blog Style" ,
													"grid"=>"Grid style" )));
				?>
				<div class="option-item" id="filter_cat-item">
					<span class="label">Exclude Categories from Homepage</span>
						<select multiple="multiple" name="tie_options[exc_home_cats][]" id="tie_filter_cat">
						<?php foreach ($categories as $key => $option) { ?>
							<option value="<?php echo $key ?>" <?php if ( @in_array( $key , tie_get_option('exc_home_cats') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>	
			
		<div id="Home_Builder">
			<div class="tiepanel-item">
				<h3>Grid Style Settings</h3>
				<?php
					tie_options(
						array( 	"name" => "Default width of posts",
								"id" => "post_width",
								"type" => "radio",
								"options" => array( "1"=>"Small" ,
													"2"=>"Medium" ,
													"3"=>"Large" )));
													
					tie_options(
						array( 	"name" => "Show Posts Meta",
								"id" => "show_meta",
								"type" => "checkbox"));	
								
					tie_options(
						array( 	"name" => "Show Comments",
								"id" => "show_comments",
								"type" => "checkbox"));	
	
					tie_options(
						array( 	"name" => "Number of Comments",
								"id" => "num_comments",
								"type" => "short-text"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Homepage Settings</h3>
				<?php
																					
					tie_options(
						array( 	"name" => "Enable Categories Filter",
								"id" => "enable_filter",
								"type" => "checkbox"));	
				
				?>
				
			</div>	
			


			
		</div>

		</div> <!-- Homepage Settings -->
		
	
		
		<div id="tab4" class="tabs-wrap">
			<h2>Social Networking</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>Custom Feed URL</h3>
							
				<?php						
					tie_options(
						array(	"name" => "Custom Feed URL",
								"id" => "rss_url",
								"help" => "e.g. http://feedburner.com/userid",
								"type" => "text"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Social Networking</h3>
				<p style="padding:10px; color:red;"> Don't forget http:// before link .</p>
							
				<?php						
					tie_options(
						array(	"name" => "Facebook URL",
								"id" => "social",
								"key" => "facebook",
								"type" => "arrayText"));

					tie_options(
						array(	"name" => "Twitter URL",
								"id" => "social",
								"key" => "twitter",
								"type" => "arrayText"));
								
					tie_options(
						array(	"name" => "Google+ URL",
								"id" => "social",
								"key" => "google_plus",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "MySpace URL",
								"id" => "social",
								"key" => "myspace",
								"type" => "arrayText"));
								
					tie_options(
						array(	"name" => "Instagram URL",
								"id" => "social",
								"key" => "instagram",
								"type" => "arrayText"));
								
					tie_options(
						array(	"name" => "PayPal URL",
								"id" => "social",
								"key" => "paypal",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "dribbble URL",
								"id" => "social",
								"key" => "dribbble",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "LinkedIn URL",
								"id" => "social",
								"key" => "linkedin",
								"type" => "arrayText"));
											
					tie_options(
						array(	"name" => "Flickr URL",
								"id" => "social",
								"key" => "flickr",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "Picasa Web URL",
								"id" => "social",
								"key" => "picasa",
								"type" => "arrayText"));
																								
					tie_options(
						array(	"name" => "YouTube URL",
								"id" => "social",
								"key" => "youtube",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "Vimeo URL",
								"id" => "social",
								"key" => "vimeo",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "ShareThis URL",
								"id" => "social",
								"key" => "sharethis",
								"type" => "arrayText"));
																												
					tie_options(
						array(	"name" => "Skype URL",
								"id" => "social",
								"key" => "skype",
								"type" => "arrayText"));
								
					tie_options(
						array(	"name" => "Spotify URL",
								"id" => "social",
								"key" => "spotify",
								"type" => "arrayText"));
																
																
					tie_options(
						array(	"name" => "Digg URL",
								"id" => "social",
								"key" => "digg",
								"type" => "arrayText"));
																
					tie_options(
						array(	"name" => "Reddit URL",
								"id" => "social",
								"key" => "reddit",
								"type" => "arrayText"));
																													
					tie_options(
						array(	"name" => "StumbleUpon  URL",
								"key" => "stumbleupon",
								"id" => "social",
								"type" => "arrayText"));
																
					tie_options(
						array(	"name" => "Tumblr URL",
								"id" => "social",
								"key" => "tumblr",
								"type" => "arrayText"));
																
					tie_options(
						array(	"name" => "Blogger URL",
								"id" => "social",
								"key" => "blogger",
								"type" => "arrayText"));
																
					tie_options(
						array(	"name" => "Wordpress URL",
								"id" => "social",
								"key" => "wordpress",
								"type" => "arrayText"));
																																		
					tie_options(
						array(	"name" => "Last.fm URL",
								"id" => "social",
								"key" => "lastfm",
								"type" => "arrayText"));
																				
					tie_options(
						array(	"name" => "Pinterest URL",
								"id" => "social",
								"key" => "Pinterest",
								"type" => "arrayText"));
								
					tie_options(
						array(	"name" => "Behance URL",
								"id" => "social",
								"key" => "behance",
								"type" => "arrayText"));
				?>
			</div>			
		</div><!-- Social Networking -->
		
		
		
				
		<div id="tab6" class="tab_content tabs-wrap">
			<h2>Article Settings</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>Standard Post Format Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Hide Featured Image from single page",
								"desc" => "",
								"id" => "standard_featured",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">

				<h3>Article Elements</h3>
				<?php

					tie_options(
						array(	"name" => "Post Author Box",
								"desc" => "",
								"id" => "post_authorbio",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Next/Prev Article",
								"desc" => "",
								"id" => "post_nav",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">

				<h3>Post Meta Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Post Meta :",
								"id" => "post_meta",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Author Meta",
								"id" => "post_author",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Date Meta",
								"id" => "post_date",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Categories Meta",
								"id" => "post_cats",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Views Meta",
								"id" => "post_views",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Likes Meta",
								"id" => "post_likes",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Comments Meta",
								"id" => "post_comments",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Tags Meta",
								"id" => "post_tags",
								"type" => "checkbox"));

								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>Share Post Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Share Post Buttons :",
								"id" => "share_post",
								"type" => "checkbox"));

				
					tie_options(
						array(	"name" => "Tweet Button",
								"id" => "share_tweet",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Twitter Username <small>(optional)</small>",
								"id" => "share_twitter_username",
								"type" => "text"));
						
					tie_options(
						array(	"name" => "Facebook Like Button",
								"id" => "share_facebook",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Google+ Button",
								"id" => "share_google",
								"type" => "checkbox"));
								
																
					tie_options(
						array(	"name" => "Linkedin Button",
								"id" => "share_linkdin",
								"type" => "checkbox"));
																					
					tie_options(
						array(	"name" => "StumbleUpon Button",
								"id" => "share_stumble",
								"type" => "checkbox"));
								
																			
					tie_options(
						array(	"name" => "Pinterest Button",
								"id" => "share_pinterest",
								"type" => "checkbox"));
								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>Related Posts Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Related Posts",
								"id" => "related",
								"type" => "checkbox")); 
								
					tie_options(
						array(	"name" => "Number of posts to show",
								"id" => "related_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "Query Type",
								"id" => "related_query",
								"options" => array( "category"=>"Category" ,
													"tag"=>"Tag",
													"author"=>"Author" ),
								"type" => "radio")); 
				?>
			</div>

			
			<div class="tiepanel-item">

				<h3>jQuery Comments Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Adding Comment Validation ",
								"id" => "comment_validation",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Article Settings -->
		
		
		<div id="tab7" class="tabs-wrap">
			<h2>Footer Settings</h2> <?php echo $save ?>

			<div class="tiepanel-item">

				<h3>Footer Elements</h3>
				<?php
					tie_options(
						array(	"name" => "'Go To Top' Icon",
								"id" => "footer_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Social Icons",
								"desc" => "",
								"id" => "footer_social",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Column layout</h3>
					<div class="option-item">

					<?php
						$checked = 'checked="checked"';
						$tie_footer_widgets = tie_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="tie-options">
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-1c" <?php if($tie_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-2c" <?php if($tie_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($tie_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($tie_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-3c" <?php if($tie_footer_widgets == 'footer-3c' || !$tie_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($tie_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($tie_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-4c" <?php if($tie_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-4c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="disable" <?php if($tie_footer_widgets == 'disable') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-no.png" /></a>
						</li>

					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Text One</h3>
				<div class="option-item">
					<textarea id="tie_footer_one" name="tie_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_one'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Text Two</h3>
				<div class="option-item">
					<textarea id="tie_footer_two" name="tie_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_two'));  ?></textarea>				
				</div>
			</div>

		</div><!-- Footer Settings -->

		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2>Banners Settings</h2> <?php echo $save ?>
			<div class="tiepanel-item">
				<h3>Top Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Top Banner",
								"id" => "banner_top",
								"type" => "checkbox")); 	
					tie_options(			
						array(	"name" => "Top Banner Image",
								"id" => "banner_top_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Top Banner Link",
								"id" => "banner_top_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_top_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_top_tab",
								"type" => "checkbox"));
								
					tie_options(					
						array(	"name" => "Adsense Code",
								"id" => "banner_top_adsense",
								"type" => "textarea")); 
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Bottom Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Bottom Banner",
								"id" => "banner_bottom",
								"type" => "checkbox")); 	
					tie_options(			
						array(	"name" => "Bottom Banner Image",
								"id" => "banner_bottom_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Bottom Banner Link",
								"id" => "banner_bottom_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_bottom_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_bottom_tab",
								"type" => "checkbox"));
								
					tie_options(					
						array(	"name" => "Adsense Code",
								"id" => "banner_bottom_adsense",
								"type" => "textarea")); 
				?>
			</div>
	
			<div class="tiepanel-item">
				<h3>Above Article Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Above Article Banner",
								"id" => "banner_above",
								"type" => "checkbox")); 	
					tie_options(			
						array(	"name" => "Above Article Banner Image",
								"id" => "banner_above_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Above Article Banner Link",
								"id" => "banner_above_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_above_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_above_tab",
								"type" => "checkbox"));
								
					tie_options(					
						array(	"name" => "Adsense Code",
								"id" => "banner_above_adsense",
								"type" => "textarea")); 
				?>
			</div>
	
			
			<div class="tiepanel-item">
				<h3>Below Article Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Below Article Banner",
								"id" => "banner_below",
								"type" => "checkbox")); 	
					tie_options(			
						array(	"name" => "Below Article Banner Image",
								"id" => "banner_below_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Below Article Banner Link",
								"id" => "banner_below_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_below_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_below_tab",
								"type" => "checkbox"));
								
					tie_options(					
						array(	"name" => "Adsense Code",
								"id" => "banner_below_adsense",
								"type" => "textarea")); 
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Between Posts in Home and Archives </h3>
				<?php
					tie_options(				
						array(	"name" => "Between Posts Banner",
								"id" => "banner_within_posts",
								"type" => "checkbox")); 	
													
					$posts_number = array();
					$max_number = get_option('posts_per_page');
					$posts_number[0] = ' ';
					for($i=1 ; $i<=$max_number ; $i++ ){
						$posts_number[] = $i;
					}
					tie_options(
						array(	"name" => "Number of Posts before ",
								"id" => "banner_within_posts_posts",
								"type" => "select",
								"options" => $posts_number));
						
					tie_options(				
						array(	"name" => "Display in first page only",
								"id" => "banner_within_posts_pos",
								"type" => "checkbox")); 
								
					tie_options(			
						array(	"name" => "Between Posts Banner Image",
								"id" => "banner_within_posts_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Between Posts Banner Link",
								"id" => "banner_within_posts_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_within_posts_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_within_posts_tab",
								"type" => "checkbox"));
													
					tie_options(					
						array(	"name" => "Adsense Code",
								"id" => "banner_within_posts_adsense",
								"type" => "textarea")); 
								
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Shortcode ADS</h3>
				<?php
					tie_options(				
						array(	"name" => "[ads1] Shortcode Banner",
								"id" => "ads1_shortcode",
								"type" => "textarea")); 
	
					tie_options(
						array(	"name" => "[ads2] Shortcode Banner",
								"id" => "ads2_shortcode",
								"type" => "textarea")); 
				?>
			</div>
		</div> <!-- Banners Settings -->
		
			

		<div id="tab11" class="tab_content tabs-wrap">
			<h2>Sidebars</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>Sidebar Position</h3>
				<div class="option-item">
					<?php
						$checked = 'checked="checked"';
						$tie_sidebar_pos = tie_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="tie-options">
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' || !$tie_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Add Sidebar</h3>
				<div class="option-item">
					<span class="label">Sidebar Name</span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="small_button" type="button" value="Add" />
					
					<ul id="sidebarsList">
					<?php $sidebars = tie_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="tiepanel-item">
				<h3>Custom Sidebars</h3>
				<?php
				
				$new_sidebars = array(''=> 'Default');
				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				tie_options(				
					array(	"name" => "Home Sidebar",
							"id" => "sidebar_home",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Single Page Sidebar",
							"id" => "sidebar_page",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Single Article Sidebar",
							"id" => "sidebar_post",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Archives Sidebar",
							"id" => "sidebar_archive",
							"type" => "select",
							"options" => $new_sidebars )); 				
				?>
			</div>
		</div> <!-- Sidebars -->
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2>Archives Settings</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>Category Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Category Description",
								"id" => "category_desc",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "category_rss",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Tag Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "tag_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Author Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Author Bio",
								"id" => "author_bio",
								"type" => "checkbox"));
				?>
				<?php
					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "author_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Search Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Search in Category IDs",
								"id" => "search_cats",
								"help" => "Use minus sign (-) to exclude categories. Example: (1,4,-7) = search only in Category 1 & 4, and exclude Category 7.",
								"type" => "text"));
				?>
				<?php
					tie_options(
						array(	"name" => "Exclude Pages in results",
								"id" => "search_exclude_pages",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Archives -->
				
				
		<div id="tab13" class="tab_content tabs-wrap">
			<h2>Styling</h2>	<?php echo $save ?>	
			<div class="tiepanel-item">

				<h3>Background Type</h3>
				<?php
					tie_options(
						array( 	"name" => "Background Type",
								"id" => "background_type",
								"type" => "radio",
								"options" => array( "pattern"=>"Pattern" ,
													"custom"=>"Custom Background" )));
				?>
			</div>

			<div class="tiepanel-item" id="pattern-settings">
				<h3>Choose Pattern</h3>
				
				<?php
					tie_options(
						array( 	"name" => "Background Color",
								"id" => "background_pattern_color",
								"type" => "color" ));
				?>
				
				<?php
					$checked = 'checked="checked"';
					$theme_pattern = tie_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="tie-options">
					<?php for($i=1 ; $i<=23 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="tie_background_pattern"  name="tie_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="tiepanel-item" id="bg_image_settings">
				<h3>Custom Background</h3>
				<?php
					tie_options(
						array(	"name" => "Custom Background",
								"id" => "background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Full Screen Background",
								"id" => "background_full",
								"type" => "checkbox"));
				?>

			</div>	
			<div class="tiepanel-item">
				<h3>Body Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Links Color",
								"id" => "links_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Links Decoration",
								"id" => "links_decoration",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "links_color_hover",
								"type" => "color"));

				
					tie_options(
						array(	"name" => "Links Decoration on mouse over",
								"id" => "links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
					
					tie_options(
						array(	"name" => "Scroll To Top Bacground",
								"id" => "scroll_to_top",
								"type" => "color"));

					tie_options(
						array(	"name" => "Filter Current Item Background",
								"id" => "filter_current",
								"type" => "color"));
				?>
			</div>

			
			<div class="tiepanel-item">
				<h3>Header Background</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "header_background",
								"type" => "background"));
								
					tie_options(
						array(	"name" => "Border Top Color",
								"id" => "hedaer_border_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Main Navigation Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "topbar_background",
								"type" => "background"));

					tie_options(
						array(	"name" => "Links Color",
								"id" => "topbar_links_color",
								"type" => "color"));

					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "topbar_links_color_hover",
								"type" => "color"));

					tie_options(
						array(	"name" => "Current Item Background",
								"id" => "current_background",
								"type" => "color"));

					tie_options(
						array(	"name" => "Current Item Border Top color",
								"id" => "current_border",
								"type" => "color"));

					tie_options(
						array(	"name" => "Current Item text color",
								"id" => "current_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Boxes and Widgets Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Boxes / Widgets Background ",
								"id" => "boxes_bg",
								"type" => "color"));
				?>		
			</div>
			<div class="tiepanel-item">
				<h3>Post Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Post Links Color",
								"id" => "post_links_color",
								"type" => "color"));
				
					tie_options(
						array(	"name" => "Post Links Decoration",
								"id" => "post_links_decoration",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				
					tie_options(
						array(	"name" => "Post Links Color on mouse over",
								"id" => "post_links_color_hover",
								"type" => "color"));
				
					tie_options(
						array(	"name" => "Post Links Decoration on mouse over",
								"id" => "post_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>Quote and link posts Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Quote / link block Background",
								"id" => "quote_bg",
								"type" => "color"));

					tie_options(
						array(	"name" => "Post Links Color",
								"id" => "quote_links_color",
								"type" => "color"));
			
					tie_options(
						array(	"name" => "Post Links Decoration",
								"id" => "quote_links_decoration",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
			
					tie_options(
						array(	"name" => "Post Links Color on mouse over",
								"id" => "quote_links_color_hover",
								"type" => "color"));
			
					tie_options(
						array(	"name" => "Post Links Decoration on mouse over",
								"id" => "quote_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>Footer Background</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "footer_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Footer Widget Title color",
								"id" => "footer_title_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color",
								"id" => "footer_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "footer_links_color_hover",
								"type" => "color"));
				?>
			</div>				
						
			<div class="tiepanel-item">
				<h3>Custom CSS</h3>	
				<div class="option-item">
					<p><strong>Global CSS :</strong></p>
					<textarea id="tie_css" name="tie_options[css]" style="width:100%" rows="7"><?php echo tie_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong>Tablets CSS :</strong> Width from 768px to 985px</p>
					<textarea id="tie_css" name="tie_options[css_tablets]" style="width:100%" rows="7"><?php echo tie_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>Wide Phones CSS :</strong> Width from 480px to 767px</p>
					<textarea id="tie_css" name="tie_options[css_wide_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>Phones CSS :</strong> Width from 320px to 479px</p>
					<textarea id="tie_css" name="tie_options[css_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- Styling -->

		<div id="tab14" class="tab_content tabs-wrap">
			<h2>Typography</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>Main Typography</h3>
				<?php
					tie_options(
						array( 	"name" => "General Typography",
								"id" => "typography_general",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "Main navigation",
								"id" => "typography_main_nav",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Page Title",
								"id" => "typography_page_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Single Post Title",
								"id" => "typography_post_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Post Meta",
								"id" => "typography_post_meta",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Post Entry , page Entry",
								"id" => "typography_post_entry",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Widgets Titles",
								"id" => "typography_widgets_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Footer Widgets Titles",
								"id" => "typography_footer_widgets_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Quote and Links posts",
								"id" => "typography_quote_link_text",
								"type" => "typography"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Post Headings</h3>
				<?php
					tie_options(
						array( 	"name" => "H1 Typography",
								"id" => "typography_post_h1",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "H2 Typography",
								"id" => "typography_post_h2",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "H3 Typography",
								"id" => "typography_post_h3",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "H4 Typography",
								"id" => "typography_post_h4",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "H5 Typography",
								"id" => "typography_post_h5",
								"type" => "typography"));
	
					tie_options(
						array( 	"name" => "H6 Typography",
								"id" => "typography_post_h6",
								"type" => "typography"));
	
				?>
			</div>
			
		</div> <!-- Typography -->
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2>Advanced Settings</h2>	<?php echo $save ?>	
		
			<div class="tiepanel-item">
				<h3>Disable the Responsiveness</h3>
				
				<?php
					tie_options(
						array(	"name" => "Disable Responsive",
								"id" => "disable_responsive",
								"type" => "checkbox"));
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Theme Updates</h3>
				<?php
					tie_options(
						array(	"name" => "Notify On Theme Updates",
								"id" => "notify_theme",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Worpress Login page Logo</h3>
				<?php
					tie_options(
						array(	"name" => "Worpress Login page Logo",
								"id" => "dashboard_logo",
								"type" => "upload"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="tiepanel-item">
				<h3>Export</h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="tiepanel-item">
				<h3>Import</h3>
				<div class="option-item">
					<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>
	
		</div> <!-- Advanced -->
		
		
		<div class="mo-footer">
			<?php echo $save; ?>
		</form>

			<form method="post">
				<div class="mpanel-reset">
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="Reset Settings" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div>

	</div><!-- .mo-panel-content -->
</div><!-- .mo-panel -->


<?php
}
?>