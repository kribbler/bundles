WooCommerce Swipe plugin

Version:	2.9.1 / 10 July 2014
Copyright:	(c) 2012-2014, Optimizer Ltd.
Link:		http://www.swipehq.com/

 

REQUIREMENTS
---

* Swipe account
* Wordpress
* Wordpress WooCommerce plugin


INSTALLATION
---

1. Please install this plugin through the normal Wordpress installation process (Plugins -> Add New, then Search or Upload)
2. After successful installation it will appear in the list of Plugins as "Swipe Checkout for WooCommerce", make sure to Activate the plugin
3. Then configure Swipe, in the Plugins list, for Swipe Checkout, click on the Settings link, then add the following details 
	from your Swipe Merchant login under Settings -> API Credentials:
		Swipe Merchant ID
		Swipe API Key
		Swipe API Url
		Swipe Payment Page Url
4. All done, test it out, add some products to your cart and you will get the option to pay with Swipe.


NOTES
---
* WooCommerce must be configured to use a currency that your Swipe Merchant Account supports,
	see Settings -> API Credentials for a list of currencies your Merchant Account supports. And see WooCommerce -> Settings -> General -> Currency
	to see which currency WooCommerce is using.


CHANGE LOG
---

1.0
- First Public Release.

1.1
- Test Mode Compatibility.

1.2
- WC Version 2.0.3 Compatible
- Automatically Sets LPN and Callback URL

1.2.1
- Added Multi-currency Support

1.2.2
- SSL Handler

2.0.0
- Fixed potential issues for concurrent transactions
- Minor plugin enhancements

2.5.0
- Canadian merchant support
- Minor plugin enhancements

2.5.1
- Minor plugin enhancements

2.6.0 (igor)
- adding dynamic currency check
- cleanup

2.7.0
- Added test configuration button

2.7.1
- Bugfix for Plugins page

2.8.0
- Upgrade plugin to support WooCommerce 2.1

2.9.0
- Minor bug fixes

2.9.1
- Customer already entered email on shop checkout the email will automatically appear on SwipeHQ payment page.