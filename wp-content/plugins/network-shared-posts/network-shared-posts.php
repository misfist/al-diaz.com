<?php
/*
Plugin Name: Network Shared Posts
Plugin URI: http://code-ext.com/blog/2012/07/30/network-shared-posts/
Description: Network Shared Posts plugin enables you to share posts over WP Multi Site network.  You can display on any blog in your network the posts selected by taxanomy from any other blogs including that blog itself. 
Version: 1.1.2
Author: Code Ext
Author URI: https://code-ext.com

Copyright 2012 Code Ext, Inc

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
	exit('Please don\'t access this file directly.');
}
############  SETUP  ####################
add_action("plugins_loaded","net_shared_posts_init");
add_shortcode('netsposts','netsposts_shortcode');

// Setup functions

function net_shared_posts_init()
{
	register_uninstall_hook(__FILE__, 'net_shared_posts_uninstall');
	wp_register_style( 'netspostscss', plugins_url('/net_shared_posts.css', __FILE__) );
	wp_enqueue_style( 'netspostscss' );
	load_plugin_textdomain('netsposts', false, basename( dirname( __FILE__ ) ) . '/language');
}

function net_shared_posts_uninstall()
{
	remove_shortcode('netsposts');
}

function netsposts_shortcode($atts)
{
	extract(shortcode_atts(array(
	'limit' => '',
	'days' => 0,
	'titles_only' => false,
	'wrap_start' => null,
	'wrap_end' => null,
	'thumbnail' => false,
	'post_type' => 'post',
	'include_blog' => null,
	'exclude_blog' => null,
	'taxonomy' => null,
	'paginate' => false,
	'pages' => null,
	'list' => '10',
	'excerpt_length' => 400,
	'auto_excerpt' => false,
	'show_author' => false,
	'full_text' => false,
	'size' => 'thumbnail',
	'image_class' => 'post-thumbnail',
	'date_format' => 'n/j/Y',
	'prev_next' => false,
	'end_size'     => '',
	'mid_size'  => '',
	'prev' => '&laquo; Previous',
	'next' =>  'Next &raquo;'
	), $atts));
	get_net_shared_posts($limit, $days, $titles_only, $wrap_start, $wrap_end, $thumbnail, $post_type, $include_blog, $exclude_blog, $taxonomy,$paginate, $pages, $list,  $excerpt_length, $auto_excerpt, $full_meta, $size, $image_class, $date_format, $full_text, $end_size, $mid_size, $prev, $next, $show_author);
}


########  OUTPUT FUNCTIONS  #################### 

function get_net_shared_posts($limit, $days, $titles_only, $wrap_start, $wrap_end,  $thumbnail, $post_type, $include_blog, $exclude_blog, $taxonomy, $paginate, $pages, $list,  $excerpt_length, $auto_excerpt, $full_meta, $size , $image_class, $date_format, $full_text, $end_size, $mid_size, $prev, $next, $show_author )
{
$titles_only = strtolower($titles_only) == 'true'? true: false;
$thumbnail = strtolower($thumbnail) == 'true'? true: false;
$paginate = strtolower($paginate) == 'true'? true: false;
$auto_excerpt = strtolower($auto_excerpt) == 'true'? true: false;
$show_author = strtolower($show_author) == 'true'? true: false;
$full_text = strtolower($full_text) == 'true'? true: false;
$prev_next = strtolower($prev_next) == 'true'? true: false;
	global $wpdb;
	global $table_prefix;
        if($limit) $limit = " LIMIT 0,$limit ";
	## Params for taxonomy
	if($cat)
	{
		if ($tag)
		{
			implode(',',$cat, $tag);
		}
		} else $cat = $tag;
	## Include blogs
	if($include_blog) {
	$include_arr = explode(",",$include_blog);
	$include = " AND (";
	foreach($include_arr as $included_blog)
	{
		$include .= " blog_id = $included_blog  OR";
	}
	$include = substr($include,0,strlen($include)-2);
	$include .= ")";
	} else {  if($exclude_blog)   {$exclude_arr = explode(",",$exclude_blog); foreach($exclude_arr as $exclude_blog)	{$exclude .= "AND blog_id != $exclude_blog  "; }}}
	$BlogsTable = $wpdb->base_prefix.'blogs';
	$blogs = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $BlogsTable WHERE
	public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0'
	$include $exclude"));
	## Getting posts
	$postdata = array();
	if ($blogs)
	{
		foreach ($blogs as $blog_id)
		{
			if( $blog_id == 1 )
			{
				$OptionsTable = $wpdb->base_prefix."options";
				$PostsTable = $wpdb->base_prefix."posts";
				$TermRelationshipTable = $wpdb->base_prefix."term_relationships";
				$TermTaxonomyTable = $wpdb->base_prefix."term_taxonomy";
				$TermsTable = $wpdb->base_prefix."terms";
			}
			else {
				$OptionsTableTable = $wpdb->base_prefix.$blog_id."_options";
				$PostsTable = $wpdb->base_prefix.$blog_id."_posts";
				$TermRelationshipTable = $wpdb->base_prefix.$blog_id."_term_relationships";
				$TermTaxonomyTable = $wpdb->base_prefix.$blog_id."_term_taxonomy";
				$TermsTable = $wpdb->base_prefix.$blog_id."_terms";
			}
			         if ($days > 0) 	$old = "AND $PostsTable.post_date >= DATE_SUB(CURRENT_DATE(), INTERVAL $days DAY)"; else $old = "";
	
			## Taxonomy
			if($taxonomy )
			{
				$categories = explode(',',$taxonomy);
				$cat_arr = array();
				foreach($categories as $category)
				{
					$cat_id = $wpdb->get_var($wpdb->prepare("SELECT term_id FROM $TermsTable WHERE slug = '$category' "));
					if($cat_id) $cat_arr[] = $cat_id;
				}
				$taxonomy_arr = array();
				foreach($cat_arr as $cat_id)
				{
					$tax_id = $wpdb->get_var($wpdb->prepare("SELECT term_taxonomy_id FROM $TermTaxonomyTable WHERE  term_id = $cat_id"));
					if($tax_id) $taxonomy_arr[] = $tax_id;
				}
			
			foreach($taxonomy_arr as $tax_id)
			{
				$post_ids = $wpdb->get_results($wpdb->prepare("SELECT object_id FROM $TermRelationshipTable WHERE term_taxonomy_id = $tax_id"), ARRAY_A);
				if( !empty($post_ids) )
				{
					foreach($post_ids as $key=>$object_id)
					{
						$ids .=  " $PostsTable.ID = ".$object_id['object_id']. ' OR';
					}
				}
			}}
 
			if ($ids) { $ids = ' AND  ('. substr($ids,0,strlen($ids)-2).')'; } else { if($taxonomy) $ids = ' AND  ID=null';}
			$the_post = $wpdb->get_results( $wpdb->prepare("SELECT $PostsTable.ID, $PostsTable.post_title, $PostsTable.post_excerpt, $PostsTable.post_content, $PostsTable.post_author, $PostsTable.post_date, $PostsTable.guid, $BlogsTable.blog_id 
			FROM $PostsTable, $BlogsTable WHERE $BlogsTable.blog_id  =  $blog_id  AND $PostsTable.post_status = 'publish' $ids  AND $PostsTable.post_type = '$post_type'  $old  $limit"), ARRAY_A);
			$postdata = array_merge_recursive($postdata, $the_post);
			$ids='';
		}
		}  
	usort($postdata, "custom_sort");
	if($paginate)
	{
		$page = get_query_var('paged');
		if(!$page)  $page = get_query_var('page');
		if(!$page)  $page = 1;
		$total_records = count($postdata);
		$total_pages = ceil($total_records/$list);
		$postdata = array_slice($postdata, ($page-1)*$list, $list);
	}

	## OUTPUT

	if($postdata)
	{
		echo '<div id="block-wrapper">';
			foreach($postdata as $key => $the_post)
			{
				 $blog_details = get_blog_details( $the_post['blog_id']);
			          $blog_name = $blog_details->blogname;
			          $blog_url = $blog_details->siteurl;	
				if($titles_only) $title_class = 'netsposts-titles-only'; else $title_class = 'netsposts-title';
				echo html_entity_decode($wrap_start).'<div class="netsposts-content"><span class="'.$title_class.'"><a href="'.$the_post['guid'].'">'.$the_post['post_title'].'</a></span>&nbsp;';
				if($titles_only == 'false')
				{
					$date = new DateTime(trim($the_post['post_date']));
					$date_post = $date->format($date_format);
					echo '<span class="netsposts-source"> '.__('Published','netsposts').' '.$date_post.' '.__('in','netsposts').'  <a href="'.$blog_url.'">'.$blog_name.'</a>';
					##  Full metadata
					if( $show_author)
					{
					echo ' ' . __('Author','netsposts'). ' ' . '<a href="'.$blog_url .'?author='.  $the_post['post_author'] .'">'. get_the_author_meta( 'display_name' , $the_post['post_author'] ) . ' </a>';
					}
					echo '</span>';
					if($thumbnail)
					{
						$width = explode('X',$size);
						$width = $width[0] + 10; 
						echo '<a href="'.$the_post['guid'].'">'.get_thumbnail_by_blog($the_post['blog_id'],$the_post['ID'],$size, $image_class).'</a><p class="netsposts-excerpt">';
						$the_post['post_content'] = preg_replace("/<img[^>]+\>/i", "", $the_post['post_content']);
					}
					if($auto_excerpt) $exerpt  = get_excerpt($excerpt_length, $the_post['post_content'], $the_post['guid']);
					else $exerpt  = $the_post['post_excerpt'];
					if($full_text) $text = $the_post['post_content']; else $text = $exerpt;
					echo strip_shortcodes( $text);
					echo '</p>';
				}
				echo '</div>';
				if($titles_only) echo "<br />";
				echo html_entity_decode($wrap_end);
			}
		echo '<div class="clear"></div>';
		if(($paginate) and ($total_pages>1))
		{
			echo '<div id="netsposts-paginate">';
			$big = 999999999;
			echo paginate_links( array(
	                  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	                   'format' => '?paged=%#%',
	                     'current' => $page,
	                     'total' => $total_pages,
			    'prev_text'    => __($prev),
                              'next_text'    => __($next),
			    'end_size'     => $end_size,
                               'mid_size'     =>  $mid_size
) );
			
			echo '</div>';
			
		}
		echo '</div>';
	}
}
##########################################################

function get_thumbnail_by_blog($blog_id=NULL,$post_id=NULL,$size='thumbnail',$image_class)
{
	if( !$blog_id  or !$post_id ) return;
	switch_to_blog($blog_id);
	$thumb_id = has_post_thumbnail( $post_id );
	if(!$thumb_id)
	{
		restore_current_blog(); return FALSE;
	}
	$blogdetails = get_blog_details( $blog_id );
	$size=explode(',',$size); 
	$attrs = array('class'=> $image_class);
	$thumbcode = str_replace( $current_blog->domain . $current_blog->path, $blogdetails->domain . $blogdetails->path, get_the_post_thumbnail(      $post_id, $size, $attrs ) );
	restore_current_blog();
	return $thumbcode;
}

function get_excerpt($length,$content,$permalink)
{
	if(!$length) return $content;
	else {
		$content = strip_tags($content);
		$content = substr($content, 0, $length);
		$words = explode(' ', $content);
		array_pop($words);
		$content = implode(' ', $words);
		return   $content.'... <a href="'.$permalink.'">   '.__('more','trans-nlp').'</a>';
	}
}

function custom_sort($a,$b)
{
	return $a['post_date']<$b['post_date'];
}

?>