<?php

add_action( 'widgets_init', 'counter_widget_box' );
function counter_widget_box() {
	register_widget( 'counter_widget' );
}
class counter_widget extends WP_Widget {

	function counter_widget() {
		$widget_ops = array( 'classname' => 'counter-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'counter-widget' );
		$this->WP_Widget( 'counter-widget',theme_name .' - Social Counter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		$facebook_page = $instance['facebook'] ;
		$rss_id = $instance['rss'] ;
		$twitter_id =  $instance['twitter'] ;
		
		$counter = 0;
		if( $rss_id ) $counter ++ ;
		if( $twitter_id ) $counter ++ ;
		if( $facebook_page ) $counter ++ ;

		?>
		<div class="widget widget-counter col<?php echo $counter; ?>">
			<ul>
			<?php if( $rss_id ):
					//$rss = rss_count( $rss_id ); ?>
				<li class="rss-subscribers">
					<a href="<?php echo $rss_id ?>">
						<span><?php _e('Subscribe' , 'tie' ) ?><?php __('Subscribers' , 'tie' ) ?></span>
						<small><?php _e('To RSS Feed' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $twitter_id ):
					$twitter = followers_count( $twitter_id ); ?>
				<li class="twitter-followers">
					<a href="<?php echo $twitter['page_url'] ?>">
						<span><?php echo @number_format($twitter['followers_count']) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $facebook_page ):
					$facebook = facebook_fans( $facebook_page ); ?>
				<li class="facebook-fans">
					<a href="<?php echo $facebook_page ?>">
						<span><?php echo @number_format( $facebook ) ?></span>
						<small><?php _e('Fans' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			</ul>
		</div>
		
	<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['facebook'] = $new_instance['facebook'] ;
		$instance['rss'] =  $new_instance['rss'] ;
		$instance['twitter'] =  $new_instance['twitter'] ;
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>">Feed URL : </label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook Page URL : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter Username : </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" type="text" />
		</p>



	<?php
	}
}


?>