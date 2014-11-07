<?php get_header(); ?>

<div id="content">
	<?php tie_categories_filter(); ?>
	<div id="grid">
	<?php get_template_part( 'loop', 'index' );	?>
	</div><!-- .grid /-->
	<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
</div><!-- .content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>