<?php
session_start();
ini_set('session.gc_maxlifetime', 60*60*24*7);
ini_set('session.cookie_lifetime', 60*60*24*7);
if( !function_exists( 'clickbankReplacer' ) ){
	$_arrTitleName=str_replace('.html','', explode('-',@$_GET['product']) );
	$_affilateId=@$_SESSION['affilate'];
	end( $_arrTitleName );
	if( prev( $_arrTitleName ) == 'z' ){
		$_affilateId=array_pop($_arrTitleName);
		array_pop($_arrTitleName);
	}else{
		$_affilateId='';
	}
	@$_GET['product']=implode('-',$_arrTitleName).'.html';
	if( !empty($_affilateId) && ( !isset($_SESSION['flg_'.$_affilateId]) || $_SESSION['affilate']!=$_affilateId ) ){
		if( in_array( $_affilateId, explode(':',@file_get_contents( './cbids.txt' ) ) ) ){
			$_SESSION['affilate']=$_affilateId;
			$_SESSION['flg_'.$_SESSION['affilate']]=true;
		}else{
			unset( $_SESSION['affilate'] );
		}
	}
	function clickbankReplacer( $buffer ) {
		if( strpos( $buffer, '.hop.clickbank.net' ) && isset($_SESSION['affilate']) && $_SESSION['flg_'.$_SESSION['affilate']] ){
			return preg_replace( '|//([a-zA-Z0-9]+).([a-zA-Z0-9]+).hop.clickbank.net|im', '//'.$_SESSION['affilate'].'.${2}.hop.clickbank.net', $buffer);
		}
		return $buffer;
	}
}

$posts = array(
	0 => array(
		'title' => 'Affilorama- Affiliate Marketing Made Easy',
		'short_description' => 'Marketing any new product or service is the basis of success for any company or corporation. Many companies that are just starting out need a guide that will offer them the tools necessary to market their new products or services effectively. Finding resources to assist with the many details that can evolve from an affiliate marketing campaign can become stressful, especially to new business owners. New business owners can learn marketing techniques and skills through today’s technology, by incorporating affiliate marketing training, tools and software.',
		'url' => 'affilorama-affiliate-marketing-made-easy.html',
		'tags' => array(
			array('Affiliate Marketing', 'affiliate-marketing'), 
			array('Carlton Sheets', 'carlton-sheets'),
			array('Advertising On The Internet', 'advertising-on-the-internet')
		),
		'thumb' => array(
			'src' => 'images/products/affilorama-affiliate-marketing-made-easy_1.jpg',
			'title' => 'Affilorama- Affiliate Marketing Made Easy'
		),
		'inner_image' => array(
			'src' => 'images/products/affilorama-affiliate-marketing-made-easy_2.jpg',
			'title' => 'Affilorama- Affiliate Marketing Made Easy'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'Affilorama- Affiliate Marketing Made Easy'
		),
		'sidebar_image' => array(
			'src' => 'images/products/affilorama-affiliate-marketing-made-easy_sidebar.jpg',
			'title' => 'Affilorama- Affiliate Marketing Made Easy'
		),
		'like_image' => array(
			'src' => 'images/products/affilorama-affiliate-marketing-made-easy_like.jpg',
			'title' => 'Affilorama- Affiliate Marketing Made Easy'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.affilorama.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/affilorama-affiliate-marketing-made-easy.html') ),
	),

	1 => array(
		'title' => 'Wealthy Through Google Sniper 2.0',
		'short_description' => 'Gaining wealth through the internet is a hot topic these days, with more and more people mastering the art of high tech search engine optimization, hoping to add several dollars to their bank account. Learning how to gain wealth through Google Sniper 2.0 can be complicated for the beginner, as with all computer techniques the beginner must first learn the techniques before applying the skills to a form of cash producing employment. Google sniper 2.0 is definitely worthy of the massive popularity it has received.',
		'url' => 'wealthy-through-google-sniper-2-0.html',
		'tags' => array(
			array('Fitness', 'fitness'), 
			array('Diet', 'diet')
		),
		'thumb' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_1.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0',
		),
		'inner_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_2.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0',
		),
		'sidebar_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_sidebar.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0',
		),
		'like_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_like.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.gsniper.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/wealthy-through-google-sniper-2-0.html') )
	),

	2 => array(
		'title' => 'CB PAssive Income 3.0',
		'short_description' => 'There are hundreds of affiliate marketing software and methods found on the internet today. Sadly not many of them are result-oriented and are only concerned in ripping off a few bucks from unwary customers. CB Passive Income 3.0 is worth taking a look at as it promises to deliver results and the package contains practical and verified methods and tools. Read this review on CB Passive Income if you are a dedicated affiliate or someone looking to make good money out of internet marketing methods.',
		'url' => 'cb-pAssive-income-3-0.html',
		'tags' => array(
			array('Affiliate Internet Marketing', 'affiliate-internet-marketing'), 
			array('Affiliate Marketing For Dummies', 'affiliate-marketing-for-dummies'),
			array('Affiliate Marketing Classes', 'affiliate-marketing-classes')
		),
		'thumb' => array(
			'src' => 'images/products/cb-pAssive-income-3-0_1.jpg',
			'title' => 'CB PAssive Income 3.0'
		),
		'inner_image' => array(
			'src' => 'images/products/cb-pAssive-income-3-0_2.jpg',
			'title' => 'CB PAssive Income 3.0'
		),
		'sidebar_image' => array(
			'src' => 'images/products/cb-pAssive-income-3-0_sidebar.jpg',
			'title' => 'CB PAssive Income 3.0'
		),
		'like_image' => array(
			'src' => 'images/products/cb-pAssive-income-3-0_like.jpg',
			'title' => 'CB PAssive Income 3.0'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.cbpassive.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/cb-pAssive-income-3-0.html') )
	),

	3 => array(
		'title' => 'Profit Bank by Millionaire Society',
		'short_description' => 'Many people are searching for a way to obtain wealth, using the internet. Adding techniques that promise quick riches seem to come and go; as new more advanced technology becomes available; that offer the best product on the market for gaining wealth online. Although there are get rich quick schemes offering wealth at the end of the day, simply by clicking a few buttons on a computer but; no one has ever been able to accumulate the masses of wealth being promised.',
		'url' => 'profit-bank-by-millionaire-society.html',
		'tags' => array(
			array('Online Community', 'online-community'), 
			array('Learn Online Business', 'learn-online-business'), 
			array('Affiliate Marketing', 'affiliate-marketing')
		),
		'thumb' => array(
			'src' => 'images/products/profit-bank-by-millionaire-society_1.jpg',
			'title' => 'Profit Bank by Millionaire Society',
			array(
				array(
					'src' => 'images/products/profit-bank-by-millionaire-society_3.jpg',
					'title' => 'Profit Bank by Millionaire Society',
				),
				array(
					'src' => 'images/products/profit-bank-by-millionaire-society_4.jpg',
					'title' => 'Profit Bank by Millionaire Society',
				),
				array(
					'src' => 'images/products/profit-bank-by-millionaire-society_5.jpg',
					'title' => 'Profit Bank by Millionaire Society',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/profit-bank-by-millionaire-society_2.jpg',
			'title' => 'Profit Bank by Millionaire Society'
		),
		'sidebar_image' => array(
			'src' => 'images/products/profit-bank-by-millionaire-society_sidebar.jpg',
			'title' => 'Profit Bank by Millionaire Society'
		),
		'like_image' => array(
			'src' => 'images/products/profit-bank-by-millionaire-society_like.jpg',
			'title' => 'Profit Bank by Millionaire Society'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.msocietypb.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/profit-bank-by-millionaire-society.html') )
	),

	4 => array(
		'title' => 'Viral Traffic Optimizer 2.0 Offers Business Growth', 
		'short_description' => 'Marketing that is built on internet techniques and marketing software programs, is the most effective type of marketing. By incorporating the skills and techniques with applications such as, search engine optimization; on-line businesses are flourishing. Business in today’s high tech world involves adding as many tools as possible to aid in effective marketing campaigns. Technology has grown to involve many marketing alternatives such as, the viral traffic optimizer 2.0, software; that has further enhanced our methods of marketing.',
		'url' => 'viral-traffic-optimizer-2-0-offers-business-growth.html',
		'tags' => array(
			array('Online Make Money', 'online-make-money'), 
			array('To Make Big Money', 'to-make-big-money'), 
			array('Affiliate Program Product', 'affiliate-program-product')
		),
		'thumb' => array(
			'src' => 'images/products/viral-traffic-optimizer-2-0-offers-business-growth_1.jpg',
			'title' => 'Viral Traffic Optimizer 2.0 Offers Business Growth'
		),
		'inner_image' => array(
			'src' => 'images/products/viral-traffic-optimizer-2-0-offers-business-growth_2.jpg',
			'title' => 'Viral Traffic Optimizer 2.0 Offers Business Growth'
		),
		'sidebar_image' => array(
			'src' => 'images/products/viral-traffic-optimizer-2-0-offers-business-growth_sidebar.jpg',
			'title' => 'Viral Traffic Optimizer 2.0 Offers Business Growth'
		),
		'like_image' => array(
			'src' => 'images/products/viral-traffic-optimizer-2-0-offers-business-growth_like.jpg',
			'title' => 'Viral Traffic Optimizer 2.0 Offers Business Growth'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.viralto.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/viral-traffic-optimizer-2-0-offers-business-growth.html') )
	),

	5 => array(
		'title' => 'Earning Money with Mobile Pages Made Easy',
		'short_description' => 'Marketing is changing as more and more businesses lean on technology for their marketing needs. Companies have been using the internet for marketing for years, and have discovered the same technology that works on the internet is also available to them via mobile phone. With mobile marketing at your fingertips you can check on your business where ever you go. Taking marketing to a whole new level is incorporated when using my mobile money pages.',
		'url' => 'earning-money-with-mobile-pages-made-easy.html',
		'tags' => array(
			array('To Make Extra Money', 'to-make-extra-money'), 
			array('Pay Per Click', 'pay-per-click'), 
			array('Affiliate Marketing Partnership', 'affiliate-marketing-partnership')
		),
		'thumb' => array(
			'src' => 'images/products/earning-money-with-mobile-pages-made-easy_1.jpg',
			'title' => 'Earning Money with Mobile Pages Made Easy'
		),
		'inner_image' => array(
			'src' => 'images/products/earning-money-with-mobile-pages-made-easy_2.jpg',
			'title' => 'Earning Money with Mobile Pages Made Easy'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Earning Money with Mobile Pages Made Easy'
		),
		'sidebar_image' => array(
			'src' => 'images/products/earning-money-with-mobile-pages-made-easy_sidebar.jpg',
			'title' => 'Earning Money with Mobile Pages Made Easy'
		),
		'like_image' => array(
			'src' => 'images/products/earning-money-with-mobile-pages-made-easy_like.jpg',
			'title' => 'Earning Money with Mobile Pages Made Easy'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.mymobilemp.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/earning-money-with-mobile-pages-made-easy.html') )
	),
/*
	6 => array(
		'title' => 'Lose Weight by Using the Xtreme Fat Loss Diet',
		'short_description' => 'There are so many people who are always looking for ways to lose weight and they have ended up trying some of the outdated methods or have been trying some of the scams that are always in the internet. The Xtreme Fat Loss Diet is a guide that is well illustrated and does not have any fictional stories that cannot be achieved in the given time. It contains facts that can be scientifically proven to make sure that you lose weight in the least time possible. The Xtreme Fat Loss Diet ensures that what you are eating makes a difference in your body and also to your health system. The product is a good method of fast weight loss.',
		'url' => 'lose-weight-by-using-the-xtreme-fat-loss-diet.html',
		'tags' => array(
			array('Weight Loss', 'weight-loss'), 
			array('Healthy Food', 'healthy-food'), 
			array('Welness', 'welness')
		),
		'thumb' => array(
			'src' => 'images/products/lose-weight-by-using-the-xtreme-fat-loss-diet2.jpg',
			'title' => 'Lose Weight by Using the Xtreme Fat Loss Diet'
		),
		'inner_image' => array(
			'src' => 'images/products/lose-weight-by-using-the-xtreme-fat-loss-diet.jpg',
			'title' => 'Lose Weight by Using the Xtreme Fat Loss Diet'
		),
		'sidebar_image' => array(
			'src' => 'images/products/sidebar/lose-weight-by-using-the-xtreme-fat-loss-diet.jpg',
			'title' => 'Lose Weight by Using the Xtreme Fat Loss Diet'
		),
		'like_image' => array(
			'src' => 'images/products/lose-weight-by-using-the-xtreme-fat-loss-diet-like.jpg',
			'title' => 'Lose Weight by Using the Xtreme Fat Loss Diet'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.xfatloss.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/lose-weight-by-using-the-xtreme-fat-loss-diet.html') )
	)
*/
);