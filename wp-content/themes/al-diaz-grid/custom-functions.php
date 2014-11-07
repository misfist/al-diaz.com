<?php

/*-----------------------------------------------------------------------------------*/
# HomePage Taxonomy Filter
/*-----------------------------------------------------------------------------------*/

function tie_taxonomy_filter($taxonomy='category', $enable='disable', $exclude='') { 

	// Is filter enabled and grid display selected OR is function called with enabled?
	if( (tie_get_option( 'enable_filter' ) && tie_get_option( 'on_home' ) == 'grid') || $enable == 'enable' ) { ?>

	<ul id="filters">
	  <li class="current all-items"><a href="#" data-filter="*"><?php _e( 'All' , 'tie' ) ?></a></li>

		<?php
		// Categories and Tags
		if($taxonomy == 'all') { ?>

			<?php
			// Check for excluded categories
			$exc_home_cats = tie_get_option( 'exc_home_cats' );
			if($exc_home_cats) {
				$comma_cats_separated = @implode(",", $exc_home_cats );
			}

			// Get categories
			$categories = get_categories('exclude='.$comma_cats_separated);

			// Display categories
			foreach($categories as $category) { ?>

				<li><a href="#" data-filter=".cat_<?php echo $category->term_id ?>"><?php echo $category->name ?></a></li>

			<?php } ?>

			<?php
			// Get tags
			$tags = get_tags('exclude='.$exclude); 

			// Display tags
			foreach($tags as $tag) { ?>

				<li><a href="#" data-filter=".tag-<?php echo $tag->slug ?>"><?php echo $tag->name ?></a></li>

			<?php } ?>

		<?php }

		// Tags only
		elseif($taxonomy == 'tag') { ?>

			<?php
			// Get tags
			$tags = get_tags('exclude='.$exclude); 

			// Display tags
			foreach($tags as $tag) { ?>

			<li><a href="#" data-filter=".tag-<?php echo $tag->slug ?>"><?php echo $tag->name ?></a></li>

			<?php } ?>

		<?php } 

		// Categories only
		else { ?>

			<?php
			// Check for excluded categories
			$exc_home_cats = tie_get_option( 'exc_home_cats' );
			if($exc_home_cats) {
				$comma_cats_separated = @implode(",", $exc_home_cats );
			}

			// Get categories
			$categories = get_categories('exclude='.$comma_cats_separated);

			// Display categories
			foreach($categories as $category) { ?>

				<li><a href="#" data-filter=".cat_<?php echo $category->term_id ?>"><?php echo $category->name ?></a></li>

			<?php } ?>

		<?php } ?>

	</ul>

	<?php } ?>

<?php } 

?>