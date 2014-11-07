<div class="post-media">
	<?php tie_vedio() ?>
</div>
<?php 
	if( !is_singular() ) { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		<p class="post-date"><?php the_time(get_option('date_format')); ?></p>

	<?php } else { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php tie_include( 'post-meta' ); // Get Post Meta template ?>	
	<?php } ?>

<?php if( is_singular() ) { ?>
	<div class="entry">
		<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
	</div>
<?php } ?>