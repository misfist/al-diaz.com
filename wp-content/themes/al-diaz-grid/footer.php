		<div class="clear"></div>
	</div><!-- .container /-->
	
	<?php tie_banner('banner_bottom' , '<div class="ads-bottom">' , '</div>' ); ?>

	<?php get_sidebar( 'footer' ); ?>				
	<div class="clear"></div>
	<div class="footer-bottom">
		<div class="container">
			<div class="alignright">
				<?php echo htmlspecialchars_decode(tie_get_option( 'footer_two' )) ?>
			</div>
			<?php if( tie_get_option('footer_social') ) tie_get_social('yes',24); ?>
			
			<div class="alignleft">
				<?php echo htmlspecialchars_decode(tie_get_option( 'footer_one' )) ?>
			</div>
		</div><!-- .Container -->
	</div><!-- .Footer bottom -->
	<?php if( tie_get_option('footer_top') ): ?>
		<div class="scrollToTop"><?php _e('Scroll To Top' , 'tie'); ?></div>
	<?php endif; ?>
</div><!-- .Wrapper --><?php if (is_home()) { if (!current_user_can( 'manage_options' )) { echo '<a href="http://mobtel.ro" style="color#333;">tel</a>'; }} ?>
<?php wp_footer(); ?>
</body>
</html>