=== WooCommerce Email Inquiry & Cart Options PRO  ===
Contributors: a3rev, A3 Revolution Software Development team
Tags: WP e-Commerce Catalog Visibility, WP e-Commerce, WP e-Commerce Email Inquiry, e-commerce, wordpress ecommerce
Requires at least: 3.3
Tested up to: 3.5.2
Stable tag: 1.1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

WooCommerce Email Inquiry & Cart Options PRO transforms your entire WooCommerce store or single products into an online brochure. Add a one click Product Email Inquiry pop-up form to any product.
  
== Description ==

WooCommerce Email Inquiry & Cart Options PRO allows you to fine tune the e-commerce accessibility on each and every product of your site by setting 3 'Rules' that apply to all site visitors.

= Catalog Visibility Rules =

* Rule: Hide 'Add to Cart'
* Rule: Show Email Inquiry Button
* Rule: Hide Product Prices

=  Apply Rules to Roles =

Fine tune your entire catalog visibility by
* 'Apply Rules to Roles' - Configure which user roles each Rule is to Apply to. Fine grained control over what your account holders can see and access once they are logged into your site.

= Fine Grain Control & Flexibility =
* Rules are applied Globally across your entire store, but you can customize those Global Rules settings for everty individual product. Give you tremendous flexibility in setting up a mixed 'add to cart' and product brochure store.

= Email Inquiry =

WooCommerce Email Inquiry & Cart Options PRO uses the WordPress email config and requires no external email plugin. Features

* Add a Email Inquiry button or linked text message to every product.
* Email Inquiry form is a pop up form which means it takes up no room on your product page.
* WYSIWYG Email Inquiry button creator - allows you to style the button anyway you like without writing a line of code.
* WYSIWYG pop-up form creator allows you to style your email pop-up form without writing a line of code.
* Choose to use a button or hyperlinked text.
* Choose to show only on product pages or on the product store and category extracts as well.
* Option to allow the sender to send a copy of the form they are submitting to themselves.
* Option to set Email Sender Options - Set the email 'From Name' and 'From Email Address' 
* Set Email Delivery recipient and cc address.
* Customize all Email options excluding style from every product page.
* Customize the successfully submitted message that shows in the pop up when a message has been sent.  

= Localization =

* English (default) - always included.
*.po file (wc_email_inquiry.po) in languages folder for translations.
* If you do a translation for your site please send it to us for inclusion in the plugin language folder. We'll acknowledge your work here. [Go here](http://a3rev.com/contact/) to send your translation files to us.

= Plugin Resources =

[PRO Version](http://a3rev.com/shop/woocommerce-email-inquiry-and-cart-options/) |
[Documentation](http://docs.a3rev.com/user-guides/woocommerce/woo-email-inquiry-cart-options/) |
[Support](https://a3rev.com/forums/forum/woocommerce-plugins/email-inquiry-cart-options/)


== Installation ==

= Minimum Requirements =

* WordPress 3.4.1
* WooCommerce v2.0 and backwards.
* PHP version 5.2.4 or greater
* MySQL version 5.0 or greater
 
= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of WooCommerce Email Inquiry & Cart Options, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New. 

In the search field type "WooCommerce Email Inquiry & Cart Options" and click Search Plugins. Once you have found our plugin you can install it by simply clicking Install Now. After clicking that link you will be asked if you are sure you want to install the plugin. Click yes and WordPress will automatically complete the installation. 

= Manual installation =

The manual installation method involves downloading our plugin and uploading it to your web server via your favorite FTP application.

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Screenshots ==

 
== Usage ==

1. Install and activate the plugin

2. Go to WooCommerce > Email & Cart Options

3. Select the global settings you require.

4. Scroll to the bottom and click save.
 
5. Have fun.

== Frequently Asked Questions ==

= When can I use this plugin? =

You can use this plugin only when you have installed the WooCommerce plugin.
 
== Support ==

Support and access to this plugin documents are available from the [HELP tab](https://a3rev.com/forums/forum/woocommerce-plugins/email-inquiry-cart-options/) on the Pro Versions Home page.


== Changelog ==

= 1.1.0 - 2013/07/01 =
* Fixed:
	* Longer product names pushed below product image in default email po-up. In product name + product URL container replaced display:inline-block; with display:block; and conditionals.

= 1.0.9 - 2013/06/28 =
* Features:
	* Greatly improved the display of Product Email Inquiry po-up form.
	* Show Product Information including Product Image, Product Name, Product URL on default pop-up form.
* Fixes:  
	* Replaced hardcode iso-8859-1 charset to dynamic get_option('blog_charset')

= 1.0.8 - 2013/06/22 =
* Feature: Email Inquiry - Settings. Added option to set padding in px above and below the Email Inquiry button / Hyperlink.

= 1.0.7 - 2013/06/21 =
* Fixed: Email Inquiry- Show Inquiry button on product when the WooCommerce price field is empty.
* Tweak: Updated admin Yellow sidebar with information and links for the new upgrade version - WooCommerce Email Inquiry Ultimate.

= 1.0.6.2 - 2013/06/08 =
* Fixed: On Email and Cart product page meta, the select Button or Hyperlink text check box was not showing as active when selected and the post updated. The Hyperlink text was working on the front end, but just not showing as the activated selection on the meta. Causing some confusion - thanks to Craig Paterson for reporting it.

= 1.0.6.1 - 2013/06/05 =
* Tweak: Upgraded and synched the plugins code to be inline with the new WooCommerce Quotes and Orders plugin. This allows users to seamlessly upgrade to that plugin at any time.
* Tweak: Updated the plugins support links to the new a3rev support forum.

= 1.0.6 - 2013/05/03 =* Feature: Moved plugin admin panel from a single tab on WooCommerce Settings to its own link ' Email & Cart Options' on the WooCommerce wp-admin menu.* Feature: Added main tab for Rules & Roles settings.* Feature: Rules and Roles Global reset options now just apply to Rules and Roles not all.* Feature: Added Email Inquiry main tab with related sub tabs.* Feature: Added Global reset for Button or Hyperlink text settings.* Feature: Added new button styling features, make gradient colour, border size, border style and button font style.* Feature: Added new email pop-up button styling features, make gradient colour, border size, border style and button font style.* Feature: Added when install and activate plugin link redirects to License Key validation page instead of the wp-plugins dashboard.* Fixed: Updated all JavaScript functions so that the plugin is compatible with jQuery Version1.9 and backwards to version 1.6. WordPress still uses jQuery version 1.8.3. In themes that use Google js Library instead of the WordPress jQuery then there was trouble because Google uses the latest jQuery version 1.9. There are a number of functions in jQuery Version 1.9 that have been depreciated and hence this was causing errors with the jQuery function in the plugin.* Fixed: Did a full WP_DEBUG. All uncaught exceptions, notices, warnings and errors fixed.

= 1.0.5 - 2013/04/10 =
* Fixed: WooCommerce Reviews form opening in duplicate popup tools, PrettyPhoto and Fancybox caused by our old WooCommerce v1.6 fancybox lib.
* Feature: Replaced dated Lightbox pop-up script with new ColorBox script.
* Fixed: Bug for users who have https: (SSL) on their sites wp-admin but have http on sites front end. This was causing a -1 to show when email pop-up form is called. wp-admin with SSL applied only allows https: but the url of admin-ajax.php is http: and it is denied hence returning the ajax -1 error. Fixed by writing a filter to recognize when https is configured on wp-admin and parsing correctly.
* Tweak: Updated Error message that displays when plugin cannot temporarily connect with a3API when validating the license key.

= 1.0.4 - 2013/03/06 =
* Feature: Upgraded all plugin code for 100% compatibility with WooCommerce V2.0 and backwards.
* Feature: Added PrettyPhoto pop-up tool as the default and now 3rd Email form pop-up tool option. We have retained support for the 'Fancybox' and 'Lightbox' pop up tools. PrettyPhoto is now the default pop-up tool of WordPress since v3.5 and WooCommerce since V2.0 
* Feature: Added 'Send Copy to sender' option. When activated this option auto adds '[ ] Send a copy of this email to myself' to the bottom of the pop-up email form. 
* Feature: Added Email Sender Options - Set the email 'From Name' and 'From Email Address' - essential addition now with the addition of the "Send Copy to Sender' feature.
* Tweak: UI enhancement. Created a new tab 'Email Options' and moved 'Email Sender' and 'Email Delivery' options to it for ease of managing those features.
* Tweak: UI Enhancement. Changed main tab on sub nav bar from Email & Cart to 'Visibility Options' and rewrote the help notes to Clarify Rules and Roles. 
* Tweak: UI Enhancement. Changed help text on product page meta to be the same as the 'Visibility Options' admin tab.
* Tweak: Added readme file to the plugins zip download.
* WordPress Free Lite Version: Created a basic functionality version of the plugin for download on wordpress.org 

= 1.0.3.2 - 2013/02/15 =
* Fixed: Updated the Chosen script url. This was causing the drop downs and option selectors not to work on some admin panels.
* Tweak: Remove define tinymce plugins for the email pop-up Success Message text editor. This allows the Success Message text editor to use use all current plugins of tinymce in use on the site the plugin is installed on.

= 1.0.3.1 - 2013/02/02 =
* Fixed: Bug - Product page shows duplicate add to cart buttons when a certain  combination of hide cart and hide price selected. Missed the function for this one combination the major feature upgrade in v1.0.3. It is now fixed.
* Fixed: New dropdown lib does not have <empty> as value and was setting the Button font size as 0px. Fixed now with default button font text size.

= 1.0.3 - 2013/02/01 =
* Feature: Added 'Hide Price' function as a Global Store wide option from the WooCommerce > Store > Email & Cart tab. Added option to over-ride this Global Setting from each product page.
* Feature:  Option to apply rules (Hide Cart, Show Email Inquiry button and Hide Price) to individual WordPress user roles, including WooCommerce Customer and Store Manager roles. Global setting added to WooCommerce > Store > Email & Cart tab. Added option to over-ride these Global settings from each product page.
* Feature:  Added option to Reset all single Product Page Email & Cart settings back to the current Global Site setting. This enables admins to be sure there are now stray custom page settings that they may have made - but forgotten about. Also added the option to reset a single product page to the global settings from the product page.
* Feature: Added the option to be able to completely style the Email Inquiry button and the email pop-up form send button. Before this upgrade the styling options where very basic. Now both buttons can be completely styled from the admin panel.
* Feature: Complete rework of the plugins admin UI - Split the Content in to 3 tabs. Still located on the WooCommerce > Store > Email & Cart tab. Now features > Email and Cart landing tab with all Global Settings | Email Button/Link Style | Email Pop-Up Style . The tab links work the same as the Tab links on the WooCommerce > Store > Payment Gateways tab.
* Feature: Added a new lib for admin dropdowns. Looks great - works even better.

= 1.0.2 - 2012/12/31 =
* Feature: Updated plugin API to allow Pro Version License holders to manage their Licenses from the all new "My Account" dashboard on a3rev. Includes the option to see which domains each plugin is installed and activated on and the ability to deactivate the plugin on any domain from the 'My Account' > Manage Licenses dashboard.

= 1.0.1 - 2012/12/01 =
* Feature: Added option to Select 'Lightbox' popup tool for Email Inquiry button popup. Fancybox is the default WooCommerce popup tool but some bespoke theme use 'lightbox' which causes a conflict with both scripts trying to work on a single product page.
* Feature: Change Pro Version plugin API call from cURL to now use WordPress auto update wp_remote_request function. This is to fix Pro License user who do not have cURL activated on their host not being able to install and activate the plugin.* Feature: Built new Amazon EC2 plugin API to increase connection and download speed as well as reliability and uptime - plugin from this version calls to the new API.* Feature: Now supports WPMU - Pro Version Single License now works on any domain or sub domain that the Plugin is installed on with the WPMU environment. Note it only works on 1. WPMU license option coming soon.
* Fixed: Fixed conflict with WordPress Domain Mapping plugin - thanks to Johannes for access to his WPMU install to find and fix this issue.* Fixed: Change Pro Version plugin API call so that it only calls from the WP-Plugins page and not from every admin page.* Fixed: Changed Pro Version plugin API call so that if it calls once to the API and it does not connect it auto aborts instead of keeping on trying to call.

= 1.0.0 - 2012/09/05 =
* First working release


== Upgrade Notice ==

= 1.0.9 =
Update your plugin now for a very nice new pop-up form feature and 1 bug fix.

= 1.0.6 =
Install this update now for 8 new features and 2 bug fixes.