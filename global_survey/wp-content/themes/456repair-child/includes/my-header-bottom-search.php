<?php $navigation_search= ot_get_option('navigation_search');?>
<?php $navigation_search_type= ot_get_option('navigation_search_type');?>


	<?php if($navigation_search!="none"):?>
    <div class="header-search hidden-xs hidden-sm lpd-animated-link">
        <a class="search-icon" href="#"></a>
        <div class="search-dropdown">
        <div class="search-dropdown-full-widthxx">
        <div class="containerx">
			<?php if($navigation_search == "shop_search"){ ?>
				<form role="form" method="get" class="" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="hidden" name="post_type" value="product" />
				    <input type="text" class="form-control" id="s" name="s" placeholder="<?php _e( 'Enter Keyword', GETTEXT_DOMAIN ); ?>">
					<button type="submit" class="<?php if ($navigation_search_type!='type2') { ?>hide_____ special_search<?php }else{?>btn btn-primary<?php }?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/search.png" /><?php //_e( 'Search', GETTEXT_DOMAIN ); ?></button>
				</form>
			<?php } else {?>
				<form role="form" method="get" class="" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
				    <input type="text" class="form-control" id="s" name="s" placeholder="<?php _e( 'Enter Keyword', GETTEXT_DOMAIN ); ?>">
					<button type="submit" class="<?php if ($navigation_search_type!='type2') { ?>hide<?php }else{?>search-icon<?php }?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/search.png" /></button>
				</form>
			<?php }?>
        </div>
        </div>
        </div>
    </div>
    <?php endif; ?>