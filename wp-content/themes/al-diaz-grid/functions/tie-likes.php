<?php
/*-----------------------------------------------------------------------------------*/
# Like Post  - Update Post Likes
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_nopriv_tie_like_post', 'tie_like_post');
add_action('wp_ajax_tie_like_post', 'tie_like_post');
function tie_like_post(){
	global $user_ID;
 	
	$postID = $_REQUEST['post'];
	
	if( is_numeric( $postID ) ){
		$count = get_post_meta($postID, 'tie_likes' , true);
		if( empty($count) || $count == '' ) $count = 0;
		
		$count++;
		if ( $user_ID ) {
			$user_liked = get_the_author_meta( 'liked', $user_ID  );
			$user_liked_posts = explode( ',' , $user_liked);

			if( empty($user_liked) ){
				update_user_meta( $user_ID, 'liked', $postID );
				update_post_meta( $postID, 'tie_likes', $count );
			}
			else{
				if( !in_array($postID , $user_liked_posts) ){
					update_post_meta( $postID, 'tie_likes', $count );
					$postID = $user_liked.','.$postID;
					update_user_meta( $user_ID , 'liked' , $postID );
				}
			}
		}else{
			$user_liked = $_COOKIE["tie_likes_".$postID];
			if( empty($user_liked) ){
				setcookie( 'tie_likes_'.$postID , $postID , time()+7776000 , '/');
				update_post_meta( $postID, 'tie_likes', $count );
			}
		}

		echo $count ;
	}
    die;
}

/*-----------------------------------------------------------------------------------*/
# Like Post  - Get Likes
/*-----------------------------------------------------------------------------------*/
function tie_post_likes(){
global $post , $user_ID; 
    $count = get_post_meta($post->ID, 'tie_likes', true);
	$active =  $liked = false ;
	if ( $user_ID ) {
		$user_liked = get_the_author_meta( 'liked' , $user_ID ) ;
		$user_liked_posts = explode( ',' , $user_liked);
		if( in_array( $post->ID , $user_liked_posts) ) $active = ' liked';
		$liked = __( 'You already like this' , 'tie');
	}
	else{
		$user_liked = $_COOKIE["tie_likes_".$post->ID] ;
		
		if( !empty($user_liked) ){
			$active = ' liked';
			$liked = __( 'You already like this' , 'tie');
		}
		
	}
?>
	<a href="#" class="tie-likes<?php echo $active; ?>" rel="<?php echo $post->ID ?>" title="<?php echo $liked; ?>">
    <?php if( empty($count) ) echo "0"; else  echo $count; ?>
	</a>
<?php
}
?>