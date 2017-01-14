<div class="footer-main">
    <div class="center-wrap clearfix">        
            <?php dynamic_sidebar('footer-3'); ?>
    </div>
</div>
<div class="footer-bottom">
    <div class="center-wrap clearfix">
        <?php dynamic_sidebar('footer-bottom'); ?>
    </div>
</div>

</div>
<?php
    /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
wp_footer();
?>
</body>
</html>