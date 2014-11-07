<?php 
if( !is_singular() ) { ?>
	<div class="post-media standard-img">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>"><?php tie_thumb( tie_post_width() ); ?></a>
	</div>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
	<p class="post-date">
		<?php the_time(get_option('date_format')); ?>
	</p>
	<div class="entry">
		<p><?php echo get_the_excerpt() ?>
		<a class="more-link" href="<?php the_permalink() ?>"><?php _e( 'Read More &raquo;', 'tie' ) ?></a></p>
	</div>
<?php } else { ?>
	<?php if( !tie_get_option( 'standard_featured' ) ): ?>
	<div class="post-media standard-img">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>"><?php tie_thumb( tie_post_width() ); ?></a>
	</div>
	<?php endif; ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
	<?php tie_include( 'post-meta' ); // Get Post Meta template ?>	
	<div class="entry">
		<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
	</div>
<?php } ?>