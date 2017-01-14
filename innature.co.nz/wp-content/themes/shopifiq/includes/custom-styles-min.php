<style>
h1 { font-size: <?php echo get_option('heading1', '30'); ?>px; }
h2 { font-size: <?php echo get_option('heading2', '24'); ?>px; }
h3 { font-size: <?php echo get_option('heading3', '20'); ?>px; }
h4, .hentry h2 { font-size: <?php echo get_option('heading4', '14'); ?>px; }
h5 { font-size: <?php echo get_option('heading5', '12'); ?>px; }
<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?> body {direction: rtl;unicode-bidi: embed;} <?php endif; ?>
.announce-after, .quotes article, .testimonial, body, html, textarea  {
<?php if( get_option('font_type_1', 'Arial, Helvetica, sans-serif') ==  'Arial, Helvetica, sans-serif'): ?>
	font-family: <?php echo get_option('font_type_1', 'Arial, Helvetica, sans-serif'); ?>;
<?php else: ?>
	font-family: '<?php echo get_option('font_type_1', 'Arial, Helvetica, sans-serif'); ?>';
<?php endif; ?>
}
h1, h2, h3, h4, h5, nav a, .icon-strip a h2, .slider h2, .portfolio-content h3, .blog h2, .comment-number h4, .comment h4, .pricing-table-price {
	font-family: '<?php echo get_option('font_type_2', 'Open Sans'); ?>', Arial, sans-serif; font-weight: 700; font-style: normal;
}
h1.product_title {
	color: #fff;
}
.header-button, .single-page, .portfolio h3, .comments-number, .post-date-comments div .day-month, #comment-header, footer#site-footer h3.widget-title, .person h3, .statement-box button, .post-date-comments3 div .day-month, .tabs .tabs-menu li, .pricing-table-title, ul.products li.product .onsale {
	font-family: '<?php echo get_option('font_type_2', 'Open Sans'); ?>', Arial, sans-serif; font-weight: 600; font-style: normal;
}
nav ul li ul li a, .slider p, .breadcrumbs, .selected-filter, .blog footer, .comments-text, .tags-author, .comment-number h3, .comment-meta, .comment-reply-link, input[type="button"], .progress, .post-date-comments2, .quotes article span, .testimonial span, aside .tab.popular .post, .latest-post .subheading, div.product span.price, div.product p.price, #content div.product span.price, #content div.product p.pricediv.product span.price, div.product p.price, #content div.product span.price, #content div.product p.price   {
	font-family: '<?php echo get_option('font_type_2', 'Open Sans'); ?>', Arial, sans-serif; font-weight: 400; font-style: normal;
}
.slider h3 {
	font-family: '<?php echo get_option('font_type_2', 'Open Sans'); ?>', Arial, sans-serif; font-weight: 300; font-style: normal;
}
body, textarea, #s, a.icon p, .blog, .cat-item a, .sidebar-menu ul li a, aside .tweet_text, .comment p, .statement-box p, 
.quotes article, .testimonial, aside .tab.popular .post, aside .tab.recent .post, aside .tab.comments-widget .post, .accordion-h3  {
	color: <?php echo get_option('text_color', '#727272'); ?>;
}
h1, h2, h3, h4, h5, a.icon h3, .portfolio h3, .accordion-h3-selected, .blog h2, .breadcrumbs,
#filters a.selected-filter, .portfolio-pagination a.selected-link, ul.page-numbers li .current,  #filters a.selected-filter:hover, ul.products li.product .price, div.product span.price, div.product p.price, #content div.product span.price, #content div.product p.price   {
	color: <?php echo get_option('headings_color', '#719400'); ?> !important;
}
a, .header-button, .portfolio-content h3, section .blog footer span a, .sidebar-menu ul li a.selected-link,
.cat-item a:hover, .sidebar-menu ul li a:hover, aside .tweet_text a, aside .tweet a, .shop_table th, .amount, .total strong,
.featured-slider-outer.box a,
.featured-slider-outer.box .amount {
    color: <?php echo get_option('primary_color', '#719400'); ?>;
}
.megamenu .price ins, .megamenu .price ins span {
    color: <?php echo get_option('primary_color', '#719400'); ?> !important;
}
.megamenu .no-link > a {
	color: <?php echo get_option('primary_color', '#719400'); ?> !important;
}
.slider, .post-date-comments a, .post-date-comments3 a, .progress, .upper-menu, .upper-menu .social-icons a img, .upper-menu2, .post-date-comments a:before, .post-date-comments3 a:before, .comment-meta, .comment-meta:before, .pricing-table-price, footer#site-footer, span.onsale, ul.products li.product .onsale:before, .cart-wrapper .cart-contents, .product-image-holder-after, h1.product_title {
	background: <?php echo get_option('primary_color', '#719400'); ?> !important;
}
.slider {
	background-color: <?php echo get_option('primary_color', '#719400'); ?>;
}
.upper-menu:after, .upper-menu2:after {
	border-top: 6px solid <?php echo get_option('primary_color', '#719400'); ?>;
}
.social, .social-icons a img {
    background:  <?php echo get_option('copyright_back_color', '#628000'); ?>;
}
.upper-menu2 .social, .upper-menu2 .social-icons a img {
	background: <?php echo get_option('primary_color', '#719400'); ?>;
}
.social {
	color: <?php echo get_option('copyright_text_color', '#accf3a'); ?>;
}
.footer p, footer a, #site-footer .tweet_text, .upper-menu, .upper-menu2, #site-footer a, #site-footer .tweet a, #site-footer .tweet_text a {
	color: <?php echo get_option('footer_top_primary_color', '#dee8bc'); ?>;
}
footer#site-footer h3.widget-title, footer#site-footer a:hover, footer#site-footer .flickr-image, #site-footer .tweet_text, .announce-after, #site-footer .product_list_widget .amount, #site-footer .product_list_widget del .amount  {
	color: <?php echo get_option('footer_top_second_color', '#fff'); ?> !important;
}
nav li a {
	color: <?php echo get_option('menu_text_color', '#292929'); ?>;
}
nav li a:hover, nav ul ul li a:hover {
	color: <?php echo get_option('menu_text_color_hover', '#89b300'); ?> !important;
}
nav li.current_page_item a {
	color: <?php echo get_option('menu_text_color_selected', '#719400'); ?>;	
}
nav ul ul li.has-sub-menu:after {
	background: <?php echo get_option('menu_text_color_selected', '#719400'); ?>;
}
a:hover, a.icon:hover h3 {
    color: <?php echo get_option('hover_color', '#92bf00'); ?>;
}
.portfolio .portfolio-hover:after {
	border-color: <?php echo get_option('portfolio_secondary', '#5a7500'); ?> #fff #fff <?php echo get_option('portfolio_secondary', '#5a7500'); ?>;
}
.post-date-comments a:after, .post-date-comments3 a:after, .comment-meta:after {
	border-color: <?php echo get_option('portfolio_secondary', '#5a7500'); ?> transparent transparent <?php echo get_option('portfolio_secondary', '#5a7500'); ?>;
}
.cart-wrapper .cart-contents:after {
	<?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ): ?>
		border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?> !important; border-bottom: 8px solid #fff !important; border-left: 8px solid #fff !important; border-right: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?> !important;
	<?php else: ?>
		border-top: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 8px solid #fff; border-left: 8px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 8px solid #fff;
	<?php endif; ?>
}
ul.products li.product .onsale:after {
	border-top: 9px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-bottom: 9px solid transparent; border-left: 9px solid <?php echo get_option('portfolio_secondary', '#5a7500'); ?>; border-right: 9px solid transparent;
}
.portfolio .portfolio-hover .enlarge, .portfolio .portfolio-hover .open, .post-date-comments div, .post-date-comments3 div, .cart-wrapper .cart-contents:before, .product-image-holder .enlarge, .product-image-holder .open {
	background: <?php echo get_option('portfolio_secondary', '#5a7500'); ?>;
}
.portfolio .portfolio-hover {
	background: <?php echo get_option('portfolio_primary', '#719400'); ?>;
}
/* Button styles */
.button-style1, .statement-box button, .pricing-table-footer a, .buttons a, .add_to_cart_button, .product .button, table.cart td.actions .button.alt, #content table.cart td.actions .button.alt, #submit, .shipping_calculator .button, a.button.alt, button.button.alt, input.button.alt, #respond input#submit.alt, #content input.button.alt, .woocommerce-message .button, .widget_login input[type="submit"], #wpmem_login input[type="submit"], #wpmem_login input[type="submit"]:hover, #wpmem_reg input[type="submit"], #wpmem_reg input[type="submit"]:hover {
    color: <?php echo get_option('style_1_text', '#fff'); ?> !important; background: <?php echo get_option('style_1_bottom', '#719400'); ?>; background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo get_option('style_1_bottom', '#719400'); ?>), to(<?php echo get_option('style_1_top', '#89b300'); ?>)) !important; background: -webkit-linear-gradient(top, <?php echo get_option('style_1_top', '#89b300'); ?>, <?php echo get_option('style_1_bottom', '#719400'); ?>) !important; background: -moz-linear-gradient(top, <?php echo get_option('style_1_top', '#89b300'); ?>, <?php echo get_option('style_1_bottom', '#719400'); ?>) !important; background: -ms-linear-gradient(top, <?php echo get_option('style_1_top', '#89b300'); ?>, <?php echo get_option('style_1_bottom', '#719400'); ?>) !important; background: -o-linear-gradient(top, <?php echo get_option('style_1_top', '#89b300'); ?>, <?php echo get_option('style_1_bottom', '#719400'); ?>) !important; -ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=<?php echo get_option('style_1_top', '#89b300'); ?>, endColorstr=<?php echo get_option('style_1_bottom', '#719400'); ?>)" !important;
}

form.login .button input, form.register .button input {
	color: <?php echo get_option('style_1_text', '#fff'); ?> !important;
}

.statement-box button, .pricing-table-footer a {
	border-color: <?php echo get_option('style_1_top', '#89b300'); ?> <?php echo get_option('style_1_top', '#89b300'); ?> <?php echo get_option('style_1_bottom', '#719400'); ?> <?php echo get_option('style_1_top', '#89b300'); ?>;
}

.button-style2 {
    color: <?php echo get_option('style_2_text', '#fff'); ?> !important; background: <?php echo get_option('style_2_bottom', '#252525'); ?>; background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo get_option('style_2_bottom', '#252525'); ?>), to(<?php echo get_option('style_2_top', '#454545'); ?>)) !important;; background: -webkit-linear-gradient(top, <?php echo get_option('style_2_top', '#454545'); ?>, <?php echo get_option('style_2_bottom', '#252525'); ?>) !important; background: -moz-linear-gradient(top, <?php echo get_option('style_2_top', '#454545'); ?>, <?php echo get_option('style_2_bottom', '#252525'); ?>) !important; background: -ms-linear-gradient(top, <?php echo get_option('style_2_top', '#454545'); ?>, <?php echo get_option('style_2_bottom', '#252525'); ?>) !important; background: -o-linear-gradient(top, <?php echo get_option('style_2_top', '#454545'); ?>, <?php echo get_option('style_2_bottom', '#252525'); ?>) !important;; -ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=<?php echo get_option('style_2_top', '#454545'); ?>, endColorstr=<?php echo get_option('style_2_bottom', '#252525'); ?>)" !important;;
}

.button-style3, .coupon input[type="button"], .shop_table input[type="submit"] {
    color: <?php echo get_option('style_3_text', '#696969'); ?> !important; background: <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>; background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo get_option('style_3_bottom', '#d4d4d4'); ?>), to(<?php echo get_option('style_3_top', '#f0f0f0'); ?>)) !important; background: -webkit-linear-gradient(top, <?php echo get_option('style_3_top', '#f0f0f0'); ?>, <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>) !important; background: -moz-linear-gradient(top, <?php echo get_option('style_3_top', '#f0f0f0'); ?>, <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>) !important; background: -ms-linear-gradient(top, <?php echo get_option('style_3_top', '#f0f0f0'); ?>, <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>) !important; background: -o-linear-gradient(top, <?php echo get_option('style_3_top', '#f0f0f0'); ?>, <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>) !important;; -ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=<?php echo get_option('style_3_top', '#f0f0f0'); ?>, endColorstr=<?php echo get_option('style_3_bottom', '#d4d4d4'); ?>)" !important;;
}
a.icon .wrapper.default, a.icon .wrapper.circle, a.icon .wrapper.square, a.icon .wrapper.diamond{
   	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo get_option('icons_bottom', '#668500'); ?>), to(<?php echo get_option('icons_top', '#719400'); ?>)); background-image: -webkit-linear-gradient(top, <?php echo get_option('icons_top', '#719400'); ?>, <?php echo get_option('icons_bottom', '#668500'); ?>); background-image: -moz-linear-gradient(top, <?php echo get_option('icons_top', '#719400'); ?>, <?php echo get_option('icons_bottom', '#668500'); ?>); background-image: -ms-linear-gradient(top, <?php echo get_option('icons_top_hover', '#a0d100'); ?>, <?php echo get_option('icons_bottom_hover', '#83ab00'); ?>); -ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=<?php echo get_option('icons_top', '#0097ff'); ?>, endColorstr=<?php echo get_option('icons_bottom', '#006fbc'); ?>)";
}
.icon-hover {
   	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo get_option('icons_bottom_hover', '#83ab00'); ?>), to(<?php echo get_option('icons_top_hover', '#a0d100'); ?>)); background-image: -webkit-linear-gradient(top, <?php echo get_option('icons_top_hover', '#a0d100'); ?>, <?php echo get_option('icons_bottom_hover', '#83ab00'); ?>); background-image: -moz-linear-gradient(top, <?php echo get_option('icons_top_hover', '#a0d100'); ?>, <?php echo get_option('icons_bottom_hover', '#83ab00'); ?>); background-image: -ms-linear-gradient(top, <?php echo get_option('icons_top_hover', '#a0d100'); ?>, <?php echo get_option('icons_bottom_hover', '#83ab00'); ?>); -ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=<?php echo get_option('icons_top_hover', '#a0d100'); ?>, endColorstr=<?php echo get_option('icons_bottom_hover', '#83ab00'); ?>)"; background-image: -ms-linear-gradient(top, <?php echo get_option('icons_top', '#719400'); ?>, <?php echo get_option('icons_bottom', '#668500'); ?>);
}
</style>