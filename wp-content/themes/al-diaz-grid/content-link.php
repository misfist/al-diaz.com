<div class="entry-link">
<?php $link_url = get_post_meta($post->ID, 'tie_link_url', true);  ?>
<?php if ( !is_singular() ) { ?>
	<h2 class="entry-title"><a href="<?php echo $link_url; ?>"><?php the_title(); ?></a></h2>
<?php } else { ?>
    <h1 class="entry-title"><a href="<?php echo $link_url; ?>"><?php the_title(); ?></a></h1>
<?php } ?>

<?php if( !empty($link_url) ): ?>
	<span class="link-url">
		<a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a>
	</span>
<?php endif; ?>
	
</div>

<?php if( is_singular() ) { ?>
	<div class="entry">
		<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
	</div>
<?php } ?>
