<?php
/**
 * @package al-diaz-theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
            if(is_single() || is_page()): the_title('<h1 class="entry-title single-title">', '</h1>');
            else: the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h1>');
            endif;
        ?>
        <?php if(!is_page()): ?>
        <div class="entry-meta">
            <?php the_time( get_option( 'date_format' ) ); ?>
            <?php gridz_comments_link(); ?>
            <?php gridz_utility_list(false,true,true,true,__('Posted in: ','al-diaz-theme'), __('Tagged in: ','al-diaz-theme')); ?>
        </div>
        <?php endif; ?>
    </header>
    <div class="entry-content">
        <?php if(is_single() || is_page()): ?>
            <?php if( 'image' == get_post_format() ) : ?>

                <?php gridz_featured_image( "full",false );?>

            <?php elseif( 'video' == get_post_format() ) : ?>

                <div class="featured-media">
                    <?php the_field( 'video_link' ); ?>
                </div> <!-- /featured-media -->

            <?php elseif( 'audio' == get_post_format() ) : ?>

                <?php al_diaz_audio_render(); ?>

            <?php elseif( 'link' == get_post_format() ) : ?>

                <div class="post-link">
                    <a href="<?php esc_url( the_field( 'link_url' ) ); ?>"><?php the_field( 'link_url' ) ?></a>
                </div> <!-- /post-link -->

            <?php else : ?>

                <?php the_content(__('Read more', 'al-diaz-theme')); ?>
                <?php wp_link_pages(array('before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>

            <?php endif; ?>

        <?php else : ?>
            <?php the_excerpt(); ?>
        <?php endif; ?>
    </div>
    <footer class="entry-footer">

        <?php if( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
        <?php if( function_exists( 'the_views' ) ) : ?>
            <a class="post-views-count"><i class="icon"></i> <?php the_views(); ?></a>
        <?php endif; ?>
        
    </footer>
</article>
<?php if(is_single()): ?>
    <?php gridz_post_nav(); ?>
<?php endif; ?>