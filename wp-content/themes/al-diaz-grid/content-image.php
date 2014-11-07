<?php if( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
<div class="post-media">
	<a href="<?php echo get_large_thumb() ?>" rel="prettyPhoto"><?php tie_thumb( tie_post_width() ); ?></a>
</div>
<?php } ?>

<?php if( is_singular() ) { ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php tie_include( 'post-meta' ); // Get Post Meta template ?>	
	<div class="entry">
		<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
	</div>
<?php } ?>