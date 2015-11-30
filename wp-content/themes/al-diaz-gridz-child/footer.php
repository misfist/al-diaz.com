<?php
/**
 * @package al-diaz-theme
 */
?>
    </div> <!-- End of content wrapper -->
</div> <!-- End of content -->
<footer id="footer">
    <div class="wrapper">
        <?php if(!is_404()) get_sidebar('footer'); ?>
        <div id="footer-credits">
            <i class="fa fa-copyright fa-rotate-180"></i> <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
        </div>
    </div>
</footer>
<a id="scroll-up" href="javascript:void(0)"><span class="genericon-uparrow"></span></a>
<?php wp_footer(); ?>
</body>
</html>