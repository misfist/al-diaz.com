<?php
/**
 * @package al-diaz-theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("grid"); ?>>
<?php $show_featured = false; $show_excerpt = false; ?>
<?php if(get_post_format() == "image"): ?>
    <?php $featured = trim(gridz_first_image()); if($featured == "") { $show_featured = true; $show_excerpt = true; } else echo $featured; ?>
<?php elseif(get_post_format() == "audio"): ?>
    <?php al_diaz_audio_render(); ?>
<?php elseif(get_post_format() == "video"): ?>
    <?php $featured = get_field( 'video_link' );
    if( '' == $featured ) :
        $show_featured = true; $show_excerpt = true;
    else : ?>
        <div class="featured-media">
            <?php the_field( 'video_link' ); ?>
        </div> <!-- /featured-media -->
    <?php endif; ?>
<?php elseif(get_post_format() == "quote"): ?>
    <?php $featured = trim(gridz_post_quote()); if($featured == "") { $show_featured = true; $show_excerpt = true; } else echo $featured; ?>
<?php elseif(get_post_format() == "gallery"): ?>
    <?php $featured = trim(gridz_post_gallery("gridz-slider")); if($featured == "") { $show_featured = true; $show_excerpt = true; } else echo $featured; ?>
<?php elseif(get_post_format() == "link"): ?>
    <?php $featured = get_field( 'link_url' ); if($featured == "") : 
        $show_featured = true; $show_excerpt = true;  
    else : ?>
        <a href="<?php esc_url( the_field( 'link_url' ) ); ?>"><?php the_field( 'link_url' ) ?></a>
    <?php endif; ?>
<?php else: ?>
    <?php $show_featured = true; $show_excerpt = true; ?>
<?php endif; ?>
    <header class="entry-header">
        <?php if($show_featured) gridz_featured_image("full"); ?>
        <?php
            if(is_single() || is_page()): the_title('<h1 class="entry-title">', '</h1>');
            else: the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h1>');
            endif;
        ?>
    </header>
    <?php if($show_excerpt): ?>
        <div class="entry-content"><?php the_excerpt(); ?></div>
    <?php endif; ?>
    <div class="entry-footer">
        <table class="tablayout"><tr>
            <td class="tdleft"><?php the_time( get_option( 'date_format' ) ); ?></td>
            <td class="tdright">
                <?php if( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                <?php if( function_exists( 'the_views' ) ) : ?>
                    <a class="post-views-count"><i class="icon"></i> <?php the_views(); ?></a>
                <?php endif; ?>
            </td>
        </tr></table>
    </div>
</article>

