<?php
	global $user_ID  ;
	if( tie_get_option('welcome_box') &&
		 ( tie_get_option('welcome_display') == 1 ||
			( tie_get_option('welcome_display') == 2  && $user_ID )||
			( tie_get_option('welcome_display') == 3  && !$user_ID ) ) ): ?>
		<div class="welcome-message">
			<div class="taped"></div>
			<?php echo do_shortcode( htmlspecialchars_decode(stripslashes ( tie_get_option('welcome_msg') ) ) ) ?>
		</div>
<?php endif; ?>