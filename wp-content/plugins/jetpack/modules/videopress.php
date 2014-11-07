<?php
/**
 * Module Name: VideoPress
 * Module Description: Upload and host video right on your site. (Subscription required.)
 * First Introduced: 2.5
 * Free: false
 * Requires Connection: Yes
 * Sort Order: 27
 * Module Tags: Photos and Videos
 */

function jetpack_load_videopress() {
	include dirname( __FILE__ ) . "/videopress/videopress.php";
}
jetpack_load_videopress();
