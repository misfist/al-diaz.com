<div class="entry-quote">
<?php
	$get_meta = get_post_custom($post->ID);

    $quote = '&#8220; '.htmlspecialchars_decode ($get_meta['tie_quote_text'][0]).' &#8221;';
    $quote_author = $get_meta['tie_quote_author'][0];
    $quote_link = $get_meta['tie_quote_link'][0];

    if( !is_singular() ) { ?>
        
        <h2 class="entry-title"><?php echo $quote; ?></h2>
        
    <?php } else { ?>
        
        <h1 class="entry-title"><?php echo $quote; ?></h1>
        
    <?php } ?>

	<?php if( !empty($quote_author) ): ?>
    <span class="quote-link">
	<?php if( !empty($quote_link) ) echo'<a href="'.$quote_link .'">'; ?>
		 - <?php echo $quote_author ?> -
	<?php if( !empty($quote_link) ) echo'</a>'; ?>
	</span>
	<?php endif; ?>
</div>  
    
<?php if( is_singular() ) { ?>
	<div class="entry">
		<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
	</div>
<?php } ?>