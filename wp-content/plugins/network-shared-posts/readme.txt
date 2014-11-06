=== Network Shared Posts ===  

Contributors: Code Ext
Donate link: : http://code-ext.com/blog/2012/07/30/network-shared-posts/
Tags: network global posts, network posts, global posts, multisite posts, shared posts.
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Installation ==

1. Upload `network-shared-posts' folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Description ==

With Network Shared Posts plugin  you can share posts over WP Multi Site network. You can display  the posts from all blogs in your network on any blog. You can select blogs to display posts from. <br />
This plugin is very useful for multi level network. For example city.state.country.com :  <br />
 ’state’ level site can collect posts from ‘city‘ level sites and/or its own posts, 
 ‘country‘ level site can collect posts from ‘state‘ level sites  and/or  ’city‘ level sites  and/or  its own posts.<br />
You can specify categories and tags. All posts will be shown in the latest date order no matter from what blog they were taken. You can specify how old (in days) the collected posts may be. Also you can specify how many posts should be displayed from each blog. You can set thumbnails image size  and style or disable  thumbnails at all.  You can adjust CSS styles editing CSS file.

== Screenshots ==
1. Network Shared Posts in demo action
2. Admin Tool for short code (extended version only
3. Network Shared Posts Ext  (extended version) in demo action (you can put custom menu on the left, content in 2 or more columns, custom title)

== Frequently Asked Questions ==

= How to use Network Shared Posts ? = 
Craete post or page and put a short code [netsposts ] with desired arguments into your page content .<br />
Example: [netsposts  include_blog=’1,2,5′ days=’30′  taxonomy=’news’ titles_only=false  show_author=true  thumbnail=true   size=’90,90′  image_class=’ alignleft’    auto_excerpt=true   excerpt_length=500   show_author=true paginate=true   list=5]

= What short code arguments can I use ? = 
You can get the full list of short code arguments on plugin's web site http://code-ext.com/blog/2012/07/30/network-shared-posts/   
<br />

= What other options can I get ? = 
With Network Shared Posts Ext (extended version)  you can :<br />
1. remove page title or change its style<br />
2. put your own title in content area.<br />
2. display a menu on the left site of content.<br />
3. display posts in multi column layout.<br />
4. use admin page to create a short code without need to look up blog id in database.

== Changelog ==
=1.1.0 = <br />
 Added 'exclude_blog' argument <br />
The pagination was enchanced with native WordPress pagination. <br />
 Added argument for pagination: 'end_size', 'mid_size', 'prev', 'next', 'prev_next' <br />
=1.1.1=<br />
Bug fixed.<br />
=1.1.2=<br />
auuthor link  fixed.<br />
image and '..more' links  fixed.<br />
taxonomy fix<br />
Type of boolean arguments were sat<br />
Some html issues when titles_only in use were fixed<br />
prev_next ettribute was missed. Fixed.

== Upgrade Notice ==
= 1.1.2=
Important update. Few bugs were fixed.