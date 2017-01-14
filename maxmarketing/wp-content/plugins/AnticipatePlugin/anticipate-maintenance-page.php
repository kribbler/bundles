<?php
    global $ET_Anticipate;
    if ( isset($_POST['anticipate_email']) ) $ET_Anticipate->add_email( $_POST['anticipate_email'] );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Max Marketing  |  New Site Coming Soon!</title>

	<link rel="stylesheet" type="text/css" href="<?php echo $ET_Anticipate->location_folder ; ?>/css/style.css" />

	<!--[if lt IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo $ET_Anticipate->location_folder ; ?>/css/ie6style.css" />
		<script type="text/javascript" src="<?php echo $ET_Anticipate->location_folder ; ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script type="text/javascript">DD_belatedPNG.fix('img#logo, #anticipate-top-shadow, #anticipate-center-highlight, #anticipate-overlay, #anticipate-piece, #anticipate-social-icons img');</script>
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo $ET_Anticipate->location_folder ; ?>/css/ie7style.css" />
	<![endif]-->
	<?php wp_head(); ?>
</head>
<style>

@import url(http://fonts.googleapis.com/css?family=Roboto+Slab);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro);

a { color: #fff; text-decoration: none; }

a:hover { text-decoration: none; }

.contact-container { margin-left: auto;
    margin-right: auto;
    margin-top: 135px;
    max-width: 759px;
    width: 80%; }

.contact { float: left; }

#two.contact { background-image: url("http://maxmarketing.co.nz/wp-content/uploads/2014/08/socialslice_r1_c1.png");
    background-position: left center;
    background-repeat: no-repeat;
    color: #fff;
    padding: 15px 15px 15px 36px;
	font-size: 18px; }

#three.contact { background-image: url("http://maxmarketing.co.nz/wp-content/uploads/2014/08/socialslice_r1_c3.png");
    background-position: left center;
    background-repeat: no-repeat;
    color: #fff;
    padding: 15px 15px 15px 36px;
	font-size: 18px; }
	
.services-container { width: 90%; max-width: 900px; margin-left: auto; margin-right: auto; margin-top: 2%; }	
.services { float: left; margin-right: 1%; width: 24%; text-align: center; font-size: 15px; color: #fff; font-family: 'Source Sans Pro', sans-serif; }
.services:last-child { margin-right: 0px; }
.services .title { color: #fff;
    font-size: 18px;
    margin-top: 5%;
	font-family: 'Roboto Slab', serif;
	margin-bottom: 7%; }
	
@media only screen and (max-width: 799px) and (min-width: 535px) {
	.services { width: 48%; margin-right: 2%; margin-bottom: 5%; }
}

@media only screen and (max-width: 534px) {
	.services { width: 90%; margin-left: auto; margin-right: auto; margin-bottom: 8%; }
}
</style>

<body style="background-image: url('http://maxmarketing.co.nz/wp-content/uploads/2014/08/bg.png'); background-repeat: repeat; font-family: 'Roboto Slab', serif;">
<div style="width: 100%; max-width: 1315px; background-image: url('http://maxmarketing.co.nz/wp-content/uploads/2014/08/bgfeature.png'); background-position: center top; background-repeat: no-repeat; min-height: 678px; margin-left: auto; margin-right: auto; padding-top: 35px;">
<div style="width: 95%; max-width: 462px; margin-left: auto; margin-right: auto;"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/logo.png" style="width: 100%;"></div>
<div class="contact-container"><div class="contact" id="one"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/getintouch.png" /></div>
<div class="contact" id="two">09 476 1921</div>
<div class="contact" id="three"><a href="mailto:louise@maxmarketing.co.nz" target="_blank">louise@maxmarketing.co.nz</a></div></div>
<div style="clear: both;"></div>
<div class="services-container"><div class="services" id="one"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/serviceone.png" width="145" /><div class="title">Effective small business marketing strategies</div>Getting started, or getting busy, its important to get all the help you can when working for yourself.</div>
<div class="services" id="two"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/servicetwo.png" width="145" /><div class="title">Outsourced marketing  for growing businesses</div>If you’ve been in business for a while, you’ll know how important it is to get the marketing plan right. </div>
<div class="services" id="three"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/servicethree.png" width="145" /><div class="title">Local Franchise marketing</div>Helping franchisees translate that national campaign into local enquiries and $$$</div>
<div class="services" id="four"><img src="http://maxmarketing.co.nz/wp-content/uploads/2014/08/servicefour.png" width="145" /><div class="title">GM support & Business coaching</div>Special projects or sounding boards; our experts can add some bench-strength to your team and assist with driving growth.</div></div>
</div>
</body>
</html>