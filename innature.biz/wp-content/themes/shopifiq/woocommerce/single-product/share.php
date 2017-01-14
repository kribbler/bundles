<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div class="box">
    
    <!-- ShareThis elements -->

    <div class="share-this">

        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
    
    </div>

    <!-- ShareThis Scripts -->

    <script type="text/javascript">var switchTo5x=false;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-79f4387c-3a8c-7231-9a0c-f92b327ca6c4", doNotHash: false, doNotCopy: true, hashAddressBar: false});</script>

    
</div>
<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>