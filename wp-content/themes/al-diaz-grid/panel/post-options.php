<?php
add_action("admin_init", "tie_posts_init");
function tie_posts_init(){
	add_meta_box("tie_format_gallery_options", theme_name ." - Gallery Options", "tie_format_gallery_options", "post", "normal", "high");
	add_meta_box("tie_format_link_options", theme_name ." - Link Options", "tie_format_link_options", "post", "normal", "high");
	add_meta_box("tie_format_quote_options", theme_name ." - Quote Options", "tie_format_quote_options", "post", "normal", "high");
	add_meta_box("tie_format_video_options", theme_name ." - Video Options", "tie_format_video_options", "post", "normal", "high");
	add_meta_box("tie_format_audio_options", theme_name ." - Audio Options", "tie_format_audio_options", "post", "normal", "high");

	add_meta_box("global_post_options", theme_name ." - Post Options", "global_post_options", "post", "normal", "high");
}

function tie_format_gallery_options(){
	global $post ;
	
	$custom = get_post_custom($post->ID);
	$gallery = unserialize( $custom["post_gallery"][0] );
	
	wp_enqueue_script( 'tie-admin-slider' );  
	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
		
  ?>
  <script>
  jQuery(document).ready(function() {
  
	jQuery(function() {
		jQuery( "#tie-gallery-items" ).sortable({placeholder: "ui-state-highlight"});
	});

	function custom_gallery_uploader(field) {
		var button = "#upload_"+field;
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			tie_set_gallery_img(field);
			return false;
		});

	}
	function tie_set_gallery_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined') // Bug fix By Fouad Badawy
				imgurl = jQuery(html).attr('src');
			
			
			classes = jQuery('img', html).attr('class');
			if(typeof classes != 'undefined')
				id = classes.replace(/(.*?)wp-image-/, '');
			
			if(typeof classes == 'undefined'){ // Bug fix By Fouad Badawy
				classes = jQuery(html).attr('class');
				if(typeof classes != 'undefined')
					id = classes.replace(/(.*?)wp-image-/, '');
			}
				
			jQuery('#tie-gallery-items').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="gallery-img"><img src="'+imgurl+'" alt=""><input id="custom_gallery['+ nextCell +'][id]" name="custom_gallery['+ nextCell +'][id]" value="'+id+'" type="hidden" /><a class="del-cat"></a></div></li>');
			nextCell ++ ;
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
	custom_gallery_uploader("add_slide");
	
});

  </script>
   <input id="upload_add_slide" type="button" class="mpanel-save" value="Add New image">
	<ul id="tie-gallery-items">
	<?php
	if( $gallery ){
	$i=0;
	foreach( $gallery as $slide ):
		$i++; ?>
		<li id="listItem_<?php echo $i ?>"  class="ui-state-default">
			<div class="gallery-img"><?php echo wp_get_attachment_image( $slide['id'] , 'thumbnail' );  ?>
				<input id="custom_gallery[<?php echo $i ?>][id]" name="custom_gallery[<?php echo $i ?>][id]" value="<?php  echo $slide['id']  ?>" type="hidden" />
				<a class="del-cat"></a>
			</div>
		</li>
	<?php endforeach; 
	}else{
		//echo ' <br /> Use the button above to add images !';
	}?>
	</ul>
	<script> var nextCell = <?php echo $i+1 ?> ;</script>
	
<?php
}

function tie_format_link_options(){
	global $post ;
	
	tie_post_options(				
		array(	"name" => "Link url - with http:// ",
				"id" => "tie_link_url",
				"type" => "text"));
}

function tie_format_quote_options(){
	global $post ;
	
	tie_post_options(				
		array(	"name" => "Quote Author",
				"id" => "tie_quote_author",
				"type" => "text"));

	tie_post_options(				
		array(	"name" => "Quote Author Link",
				"id" => "tie_quote_link",
				"type" => "text"));
				
	tie_post_options(				
		array(	"name" => "The Quote",
				"id" => "tie_quote_text",
				"type" => "textarea"));

}

function tie_format_video_options(){
	global $post ;?>


		<?php
		tie_post_options(				
			array(	"name" => "Embed Code",
					"id" => "tie_embed_code",
					"type" => "textarea"));

		tie_post_options(				
			array(	"name" => "Youtube / Vimeo Video Url",
					"id" => "tie_video_url",
					"type" => "text"));
		?>

<?php						
}

function tie_format_audio_options(){
	global $post ;

	tie_post_options(				
			array(	"name" => "Mp3 file Url",
					"id" => "tie_audio_mp3",
					"type" => "text"));

		tie_post_options(				
			array(	"name" => "M4A file Url",
					"id" => "tie_audio_m4a",
					"type" => "text"));
					
					
		tie_post_options(				
			array(	"name" => "OGA file Url :",
					"id" => "tie_audio_oga",
					"type" => "text"));
}


function global_post_options(){
	global $post ;
	$get_meta = get_post_custom($post->ID);
	$tie_sidebar_pos = $get_meta["tie_sidebar_pos"][0];
?>
		
		<div class="tiepanel-item">
			<h3>Sidebar Options</h3>
			<div class="option-item">
				<?php
					$checked = 'checked="checked"';
				?>
				<ul id="sidebar-position-options" class="tie-options">
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="default" <?php if($tie_sidebar_pos == 'default' || !$tie_sidebar_pos ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-default.png" /></a>
					</li>						<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
					</li>
					<li>
						<input id="tie_sidebar_pos"  name="tie_sidebar_pos" type="radio" value="full" <?php if($tie_sidebar_pos == 'full') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-no.png" /></a>
					</li>
				</ul>
			</div>
			<?php
			$sidebars = tie_get_option( 'sidebars' ) ;
			$new_sidebars = array(''=> 'Default');
			if($sidebars){
				foreach ($sidebars as $sidebar) {
					$new_sidebars[$sidebar] = $sidebar;
				}
			}
					
			tie_post_options(				
				array(	"name" => "Choose Sidebar",
						"id" => "tie_sidebar_post",
						"type" => "select",
						"options" => $new_sidebars ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>General Options</h3>
			<?php	

			tie_post_options(				
				array(	"name" => "Hide Post Meta",
						"id" => "tie_hide_meta",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "Yes" ,
											"no" => "No")));

			tie_post_options(				
				array(	"name" => "Hide Author Information",
						"id" => "tie_hide_author",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "Yes" ,
											"no" => "No")));
											
			tie_post_options(				
				array(	"name" => "Hide Share Buttons",
						"id" => "tie_hide_share",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "Yes" ,
											"no" => "No")));
											
			tie_post_options(				
				array(	"name" => "Hide Related Posts",
						"id" => "tie_hide_related",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "Yes" ,
											"no" => "No")));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3>Banners Options</h3>
			<?php	
			tie_post_options(				
				array(	"name" => "Hide Above Banner",
						"id" => "tie_hide_above",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "Custom Above Banner",
						"id" => "tie_banner_above",
						"type" => "textarea"));

			tie_post_options(				
				array(	"name" => "Hide Below Banner",
						"id" => "tie_hide_below",
						"type" => "checkbox"));

			tie_post_options(				
				array(	"name" => "Custom Below Banner",
						"id" => "tie_banner_below",
						"type" => "textarea"));
			?>
		</div>
  <?php
}


add_action('save_post', 'tie_save_post');
function tie_save_post(){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

 	$custom_meta_fields = array(
		'tie_link_url',
		'tie_link_url',
		'tie_video_url',
		'tie_embed_code',
		'tie_audio_mp3',
		'tie_audio_m4a',
		'tie_audio_oga',
		'tie_quote_author',
		'tie_quote_link',
		'tie_quote_text',
		'tie_hide_meta',
		'tie_hide_author',
		'tie_hide_share',
		'tie_hide_related',
		'tie_sidebar_pos',
		'tie_sidebar_post',
		'tie_hide_above',
		'tie_banner_above',
		'tie_hide_below',
		'tie_banner_below');
	foreach( $custom_meta_fields as $custom_meta_field ){
	
		if(isset($_POST[$custom_meta_field]) )
			update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])) );
		else
			delete_post_meta($post->ID, $custom_meta_field);
	}
	
	if( $_POST['custom_gallery'] && $_POST['custom_gallery'] != "" ){
		update_post_meta($post->ID, 'post_gallery' , $_POST['custom_gallery']);		
	}
	else{ 
		delete_post_meta($post->ID, 'post_gallery' );
	}
}




/*********************************************************/

function tie_post_options($value){
	global $post;
?>

	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
		$id = $value['id'];
		$get_meta = get_post_custom($post->ID);
		
		if( isset( $get_meta[$id][0] ) )
			$current_value = $get_meta[$id][0];
			
	switch ( $value['type'] ) {
	
		case 'text': ?>
			<input  name="<?php echo $value['id']; ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo $current_value ?>" />
		<?php 
		break;

		case 'checkbox':
			if( !empty( $current_value ) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input type="checkbox" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'select':
		?>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( $current_value == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left; width:430px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php echo $current_value  ?></textarea>
		<?php
		break;
	} ?>
	</div>
<?php
}
?>