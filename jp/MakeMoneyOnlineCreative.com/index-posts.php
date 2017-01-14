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
		'title' => 'Take Advantage of LinkedInFluence for Success',
		'short_description' => 'If at all there is something that you have to look out for in the world today, it has to be LinkedIn. The reason for this is that most of the business executives who you should know are on the social network. As a matter of fact, most of the Fortune 500 companies are on LinkedIn. Therefore the challenge is how to make sure that your profile is well poised and recognizable. This you can do by making use of LinkedInFluence.',
		'url' => 'take-advantage-of-linkedinfluence-for-success.html',
		'tags' => array(
			array('', '')
		),
		'thumb' => array(
			'src' => 'images/products/take-advantage-of-linkedinfluence-for-success_1.jpg',
			'title' => 'Take Advantage of LinkedInFluence for Success'
		),
		'inner_image' => array(
			'src' => 'images/products/take-advantage-of-linkedinfluence-for-success_2.jpg',
			'title' => 'Take Advantage of LinkedInFluence for Success'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'Take Advantage of LinkedInFluence for Success'
		),
		'sidebar_image' => array(
			'src' => 'images/products/take-advantage-of-linkedinfluence-for-success_sidebar.jpg',
			'title' => 'Take Advantage of LinkedInFluence for Success'
		),
		'like_image' => array(
			'src' => 'images/products/take-advantage-of-linkedinfluence-for-success_like.jpg',
			'title' => 'Take Advantage of LinkedInFluence for Success'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.linkedinfl.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/take-advantage-of-linkedinfluence-for-success.html') ),
	),

	1 => array(
		'title' => 'SEO Consultant in 90 Days Helps You Realize Your Dream of Becoming an Offline Consultant in a Very Big Way',
		'short_description' => 'How to start your own offline consulting business? This is one of the questions that are in the minds of many a people who want to start a business of their own. You can get your answer from the SEO consultant in 90 days program started by David James Ostiguy which is learning as well as educational program. Offline consulting has become one of the most sought after profession these days; you are able to provide your services to any offline industry. You will be providing your ideas at a cost and with the aid of SEO consultant in 90 days you will have quite a many companies as your clients.',
		'url' => 'seo-consultant-in-90-days-helps-you-realize-your-dream.html',
		'tags' => array(
			array('Seo Video Course', 'seo-video-course'), 
			array('Offline Consultant', 'offline-consultant'),
			array('Offline Marketing Consultant', 'offline-marketing-consultant')
		),
		'thumb' => array(
			'src' => 'images/products/seo-consultant-in-90-days-helps-you-realize-your-dream_1.jpg',
			'title' => 'SEO Consultant in 90 Days Helps You Realize Your Dream of Becoming an Offline Consultant in a Very Big Way',
		),
		'inner_image' => array(
			'src' => 'images/products/seo-consultant-in-90-days-helps-you-realize-your-dream_2.jpg',
			'title' => 'SEO Consultant in 90 Days Helps You Realize Your Dream of Becoming an Offline Consultant in a Very Big Way',
		),
		'sidebar_image' => array(
			'src' => 'images/products/seo-consultant-in-90-days-helps-you-realize-your-dream_sidebar.jpg',
			'title' => 'SEO Consultant in 90 Days Helps You Realize Your Dream of Becoming an Offline Consultant in a Very Big Way',
		),
		'like_image' => array(
			'src' => 'images/products/seo-consultant-in-90-days-helps-you-realize-your-dream_like.jpg',
			'title' => 'SEO Consultant in 90 Days Helps You Realize Your Dream of Becoming an Offline Consultant in a Very Big Way',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.roxyj42973.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/seo-consultant-in-90-days-helps-you-realize-your-dream.html') )
	),

	2 => array(
		'title' => 'Wealthy Through Google Sniper 2.0',
		'short_description' => 'Gaining wealth through the internet is a hot topic these days, with more and more people mastering the art of high tech search engine optimization, hoping to add several dollars to their bank account. Learning how to gain wealth through Google Sniper 2.0 can be complicated for the beginner, as with all computer techniques the beginner must first learn the techniques before applying the skills to a form of cash producing employment. Google sniper 2.0 is definitely worthy of the massive popularity it has received.',
		'url' => 'wealthy-through-google-sniper-2-0.html',
		'tags' => array(
			array('Pay Affiliates', 'pay-affiliates'), 
			array('Home Security Affiliate Program', 'home-security-affiliate-program'),
			array('Affiliate Program Software', 'affiliate-program-software')
		),
		'thumb' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_1.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0'
		),
		'inner_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_2.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0'
		),
		'sidebar_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_sidebar.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0'
		),
		'like_image' => array(
			'src' => 'images/products/wealthy-through-google-sniper-2-0_like.jpg',
			'title' => 'Wealthy Through Google Sniper 2.0'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.gsniper.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/wealthy-through-google-sniper-2-0.html') )
	),

	3 => array(
		'title' => 'Make use of Bring the Fresh',
		'short_description' => 'In as far as making money off the internet is concerned Bring The Fresh has to be one of the best ideas that ever existed. For people who have multiple websites in particular, this could mean raking in so much money by the end of the day. You can earn hundreds or even thousands of dollars by simply being able to get as much traffic to your site and then either selling off the website or keeping it as an income earner for yourself.',
		'url' => 'make-use-of-bring-the-fresh.html',
		'tags' => array(
			array('Search Engine Submitting', 'search-engine-submitting'), 
			array('Search Engine Submission Tips', 'search-engine-submission-tips'), 
			array('Search Engine Submission List', 'search-engine-submission-list')
		),
		'thumb' => array(
			'src' => 'images/products/make-use-of-bring-the-fresh_1.jpg',
			'title' => 'Make use of Bring the Fresh',
			array(
				array(
					'src' => 'images/products/make-use-of-bring-the-fresh_3.jpg',
					'title' => 'Make use of Bring the Fresh',
				),
				array(
					'src' => 'images/products/make-use-of-bring-the-fresh_4.jpg',
					'title' => 'Make use of Bring the Fresh',
				),
				array(
					'src' => 'images/products/make-use-of-bring-the-fresh_5.jpg',
					'title' => 'Make use of Bring the Fresh',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/make-use-of-bring-the-fresh_2.jpg',
			'title' => 'Make use of Bring the Fresh'
		),
		'sidebar_image' => array(
			'src' => 'images/products/make-use-of-bring-the-fresh_sidebar.jpg',
			'title' => 'Make use of Bring the Fresh'
		),
		'like_image' => array(
			'src' => 'images/products/make-use-of-bring-the-fresh_like.jpg',
			'title' => 'Make use of Bring the Fresh'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.bringfresh.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/make-use-of-bring-the-fresh.html') )
	),

	4 => array(
		'title' => 'Using Rankbuilder 2.0 for Niche Marketing Success', 
		'short_description' => 'Over the years a lot of people have taken to the internet in a bid to make sure that they get on the internet business bandwagon. However, in as much as this business is the in thing, there are so many challenges that people have had to deal with. As a result most people tend to give up in the long run thanks to failure to hit their targets. However, with the help of Rankbuilder 2.0 you can now rest assured that your online business investment will be a guaranteed success. There are lots of reasons why this is so. All you have to do is to be keen and get to learn the tricks about it.',
		'url' => 'using-rankbuilder-2-0-for-niche-marketing-success.html',
		'tags' => array(
			array('engine search submission', 'engine-search-submission'), 
			array('Cheap Search Engine Submission', 'cheap-search-engine-submission'), 
			array('Best Search Engine Submitter', 'best-search-engine-submitter'),
			array('Submit url to Search Engines', 'submit-url-to-search-engines'),
			array('Submit Your Blog to Search Engines', 'submit-your-blog-to-search-engines')
		),
		'thumb' => array(
			'src' => 'images/products/using-rankbuilder-2-0-for-niche-marketing-success_1.jpg',
			'title' => 'Using Rankbuilder 2.0 for Niche Marketing Success'
		),
		'inner_image' => array(
			'src' => 'images/products/using-rankbuilder-2-0-for-niche-marketing-success_2.jpg',
			'title' => 'Using Rankbuilder 2.0 for Niche Marketing Success'
		),
		'sidebar_image' => array(
			'src' => 'images/products/using-rankbuilder-2-0-for-niche-marketing-success_sidebar.jpg',
			'title' => 'Using Rankbuilder 2.0 for Niche Marketing Success'
		),
		'like_image' => array(
			'src' => 'images/products/using-rankbuilder-2-0-for-niche-marketing-success_like.jpg',
			'title' => 'Using Rankbuilder 2.0 for Niche Marketing Success'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.rankbuild.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/using-rankbuilder-2-0-for-niche-marketing-success.html') )
	),

	5 => array(
		'title' => 'Try your hands on Pageone Curator and Experience Internet Success',
		'short_description' => 'Using Pageone Curator is your one step towards being successful on the internet. There are so many reasons why so many people today are using this particular software. As a matter of fact, this software will offer you the success other people have made you pay so much for in the past. Considering the fact that you will be paying relatively so little from using this software, you can rest assured that by using it for your online business, you will be guaranteed success.',
		'url' => 'try-your-hands-on-pageone-curator-and-experience-internet-success.html',
		'tags' => array(
			array('', '')
		),
		'thumb' => array(
			'src' => 'images/products/try-your-hands-on-pageone-curator-and-experience-internet-success_1.jpg',
			'title' => 'Try your hands on Pageone Curator and Experience Internet Success'
		),
		'inner_image' => array(
			'src' => 'images/products/try-your-hands-on-pageone-curator-and-experience-internet-success_2.jpg',
			'title' => 'Try your hands on Pageone Curator and Experience Internet Success'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Try your hands on Pageone Curator and Experience Internet Success'
		),
		'sidebar_image' => array(
			'src' => 'images/products/try-your-hands-on-pageone-curator-and-experience-internet-success_sidebar.jpg',
			'title' => 'Try your hands on Pageone Curator and Experience Internet Success'
		),
		'like_image' => array(
			'src' => 'images/products/try-your-hands-on-pageone-curator-and-experience-internet-success_like.jpg',
			'title' => 'Try your hands on Pageone Curator and Experience Internet Success'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.p1curator.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/try-your-hands-on-pageone-curator-and-experience-internet-success.html') )
	),

	6 => array(
		'title' => 'Using the Upsell Equation for Success',
		'short_description' => 'Today there are so many people in the world who for one reason or the other have been able to get their businesses onto the internet platform. As a matter of fact it is important for you to note that The Upsell Equation is what your business needs to prosper. There are a number of things that you will get to learn in the event that you can get your hands on this particular program.',
		'url' => 'using-the-upsell-equation-for-success.html',
		'tags' => array(
			array('Average Equation', 'average-equation'), 
			array('Upsell Equation', 'upsell-equation'), 
			array('Equation', 'equation'),
			array('Internet Marketing', 'internet-marketing'), 
			array('The Upsell Equation', 'the-upsell-equation')
		),
		'thumb' => array(
			'src' => 'images/products/using-the-upsell-equation-for-success_1.jpg',
			'title' => 'Using the Upsell Equation for Success'
		),
		'inner_image' => array(
			'src' => 'images/products/using-the-upsell-equation-for-success_2.jpg',
			'title' => 'Using the Upsell Equation for Success'
		),
		'sidebar_image' => array(
			'src' => 'images/products/using-the-upsell-equation-for-success_sidebar.jpg',
			'title' => 'Using the Upsell Equation for Success'
		),
		'like_image' => array(
			'src' => 'images/products/using-the-upsell-equation-for-success_like.jpg',
			'title' => 'Using the Upsell Equation for Success'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.upselleq.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/using-the-upsell-equation-for-success.html') )
	)
);