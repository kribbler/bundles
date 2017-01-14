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
		'title' => 'How to Beat the Debt Collectors',
		'short_description' => 'At last there is a publication which is on the side of those who owe money. Beat The Debt Collector Ez Forms gives you the means to fight back, with every chance of winning.',
		'url' => 'how-to-beat-the-debt-collectors.html',
		'tags' => array(
			array('Debt', 'debt'),
			array('Lawyer', 'lawyer'),
			array('Lawyers', 'lawyers'),
			array('Debt Problems', 'debt-problems'),
			array('Debt Collector', 'debt-collector'),
			array('Chasing Debts', 'chasing-debts'),
		),
		'thumb' => array(
			'src' => 'images/products/how-to-beat-the-debt-collectors_1.jpg',
			'title' => 'How to Beat the Debt Collectors'
		),
		'inner_image' => array(
			'src' => 'images/products/how-to-beat-the-debt-collectors_2.jpg',
			'title' => 'How to Beat the Debt Collectors'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'How to Beat the Debt Collectors'
		),
		'sidebar_image' => array(
			'src' => 'images/products/how-to-beat-the-debt-collectors_sidebar.jpg',
			'title' => 'How to Beat the Debt Collectors'
		),
		'like_image' => array(
			'src' => 'images/products/how-to-beat-the-debt-collectors_like.jpg',
			'title' => 'How to Beat the Debt Collectors'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.jjoswal.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/how-to-beat-the-debt-collectors.html') ),
	),

	1 => array(
		'title' => 'No More Midnight Money Sweats is the Leading Guide to Getting Debt Free',
		'short_description' => 'It is made very easy for you to build up head scratching amounts of debt in today\'s credit market. The question is, what do you do about it when the payments become onerous, even unsustainable. No More Midnight Money Sweats has the answer for you',
		'url' => 'no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free.html',
		'tags' => array(
			array('Debt', 'debt'),
			array('Debt Free', 'debt-free'),
			array('No More Midnight Money Sweats', 'no-more-midnight-money-sweats'),
			array('Money Sweats', 'money-sweats'),
			array('Midnight Money', 'midnight-money'),
			array('About Finance', 'about-finance')
		),
		'thumb' => array(
			'src' => 'images/products/no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free_1.jpg',
			'title' => 'No More Midnight Money Sweats is the Leading Guide to Getting Debt Free',
		),
		'inner_image' => array(
			'src' => 'images/products/no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free_2.jpg',
			'title' => 'No More Midnight Money Sweats is the Leading Guide to Getting Debt Free',
		),
		'sidebar_image' => array(
			'src' => 'images/products/no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free_sidebar.jpg',
			'title' => 'No More Midnight Money Sweats is the Leading Guide to Getting Debt Free',
		),
		'like_image' => array(
			'src' => 'images/products/no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free_like.jpg',
			'title' => 'No More Midnight Money Sweats is the Leading Guide to Getting Debt Free',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.debtcrushr.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/no-more-midnight-money-sweats-is-the-leading-guide-to-getting-debt-free.html') )
	),

	2 => array(
		'title' => 'Discover a New View on Debt in What does the Bible Say About Debt',
		'short_description' => 'Written by Stephen Allen, a man who believes in enjoying life as well as working hard, presents a new view of debt in his ebook What does the Bible say about debt. The book highlights what is wrong with most people\'s idea of debt, and what the bible says about it.',
		'url' => 'discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt.html',
		'tags' => array(
			array('Debt', 'debt'),
			array('Win Money', 'win-money'),
			array('What Does the Bible Say About Debt', 'what-does-the-bible-say-about-debt'),
			array('Investing Money', 'investing-money'),
			array('Invest Money', 'invest-money'),
			array('Win More Money', 'win-more-money')
		),
		'thumb' => array(
			'src' => 'images/products/discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt_1.jpg',
			'title' => 'Discover a New View on Debt in What does the Bible Say About Debt'
		),
		'inner_image' => array(
			'src' => 'images/products/discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt_2.jpg',
			'title' => 'Discover a New View on Debt in What does the Bible Say About Debt'
		),
		'sidebar_image' => array(
			'src' => 'images/products/discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt_sidebar.jpg',
			'title' => 'Discover a New View on Debt in What does the Bible Say About Debt'
		),
		'like_image' => array(
			'src' => 'images/products/discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt_like.jpg',
			'title' => 'Discover a New View on Debt in What does the Bible Say About Debt'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.mycoach.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/discover-a-new-view-on-debt-in-what-does-the-bible-say-about-debt.html') )
	),

	3 => array(
		'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation',
		'short_description' => 'In difficult financial times many people turn to self employment or business start up to rebuild their income, but how do you choose a profitable business in hard economic times? 5Step System - Debt Negotiation could have the answer. Start a business helping people negotiate their way out of debt problems. There will be a big customer base looking for your help and you will genuinely be helping people.',
		'url' => 'build-a-business-for-the-future-with-the-5-step-system-debt-negotiation.html',
		'tags' => array(
			array('Debt Negotiation', 'debt-negotiation'),
			array('Negotiate Debt', 'negotiate-debt'),
			array('5 Step System Debt Negotiation', '5-step-system-debt-negotiation'),
			array('Set Up Business', 'set-up-business'),
			array('Shortcut the Business Start Up', 'shortcut-the-business-start-up'),
			array('Best Negotiation Strategies', 'best-negotiation-strategies'), 
		),
		'thumb' => array(
			'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_1.jpg',
			'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation',
			array(
				array(
					'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_3.jpg',
					'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation',
				),
				array(
					'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_4.jpg',
					'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation',
				),
				array(
					'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_5.jpg',
					'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_2.jpg',
			'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation'
		),
		'sidebar_image' => array(
			'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_sidebar.jpg',
			'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation'
		),
		'like_image' => array(
			'src' => 'images/products/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation_like.jpg',
			'title' => 'Build a Business for the Future with the 5 Step System - Debt Negotiation'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.KJBlock.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/build-a-business-for-the-future-with-the-5-step-system-debt-negotiation.html') )
	),

	4 => array(
		'title' => 'Keep Your Home with Home Foreclosure Survival Tactics', 
		'short_description' => 'Being faced with foreclosure is a frightening prospect for most people. Home Foreclosure Survival Tactics shows how to stop the process dead in under twenty minutes.',
		'url' => 'keep-your-home-with-home-foreclosure-survival-tactics.html',
		'tags' => array(
			array('Foreclosure Process', 'foreclosure-process'),
			array('Home Foreclosure', 'home-foreclosure'), 
			array('Stop Home Foreclosure', 'stop-home-foreclosure'),
			array('Avoid Home Foreclosure', 'avoid-home-foreclosure'),
			array('How to Stop Foreclosure', 'how-to-stop-foreclosure'),
			array('Stopping Foreclosure', 'stopping-foreclosure'),
		),
		'thumb' => array(
			'src' => 'images/products/keep-your-home-with-home-foreclosure-survival-tactics_1.jpg',
			'title' => 'Keep Your Home with Home Foreclosure Survival Tactics'
		),
		'inner_image' => array(
			'src' => 'images/products/keep-your-home-with-home-foreclosure-survival-tactics_2.jpg',
			'title' => 'Keep Your Home with Home Foreclosure Survival Tactics'
		),
		'sidebar_image' => array(
			'src' => 'images/products/keep-your-home-with-home-foreclosure-survival-tactics_sidebar.jpg',
			'title' => 'Keep Your Home with Home Foreclosure Survival Tactics'
		),
		'like_image' => array(
			'src' => 'images/products/keep-your-home-with-home-foreclosure-survival-tactics_like.jpg',
			'title' => 'Keep Your Home with Home Foreclosure Survival Tactics'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.prosafe.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/keep-your-home-with-home-foreclosure-survival-tactics.html') )
	),

	5 => array(
		'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair',
		'short_description' => 'The 7 Weeks to 700- Legal Credit Repair program can guarantee you of an instantaneous credit repair. Within days, you will have your poor credit score raised to excellent. This can sometimes be lowered to hours. You don’t have to lose your privileges of getting a car grants or mortgage just because the credit score is not favorable. Seek the help of 7 Weeks to 700- Legal Credit Repair and you will be into it in a matter of no time. A good credit score will guarantee you of a good life which is why you have to use 7 Weeks to 700- Legal Credit Repair. ',
		'url' => 'understanding-the-7-weeks-to-700-legal-credit-repair.html',
		'tags' => array(
			array('Credit Repair', 'credit-repair'),
			array('Credit Repair Tips', 'credit-repair-tips'),
			array('Legal Credit Repair', 'legal-credit-repair'),
			array('Credit Repair Program', 'credit-repair-program'),
			array('Repair Credit Score', 'repair-credit-score'),
			array('Credit Repair Programs', 'credit-repair-programs'),
		),
		'thumb' => array(
			'src' => 'images/products/understanding-the-7-weeks-to-700-legal-credit-repair_1.jpg',
			'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair'
		),
		'inner_image' => array(
			'src' => 'images/products/understanding-the-7-weeks-to-700-legal-credit-repair_2.jpg',
			'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair'
		),
		'sidebar_image' => array(
			'src' => 'images/products/understanding-the-7-weeks-to-700-legal-credit-repair_sidebar.jpg',
			'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair'
		),
		'like_image' => array(
			'src' => 'images/products/understanding-the-7-weeks-to-700-legal-credit-repair_like.jpg',
			'title' => 'Understanding the 7 Weeks to 700- Legal Credit Repair'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.7weeks700.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/understanding-the-7-weeks-to-700-legal-credit-repair.html') )
	),
/*
	6 => array(
		'title' => 'Make Professional Beats with Your PC or Mac',
		'short_description' => 'You can make your own beats regardless of the level of skill you have with the DUBturbo software. If you are in love with music and you would like to make your own beats without having to go through the hustle of production houses, you can download the DUBturbo software from their website. The software allows you to make the best beats with a professional touch as it has all the features that you would need to make professional beats with. The DUBturbo software also comes handy with tutorials where you can learn how to make good high quality beats for your music.',
		'url' => 'make-professional-beats-with-your-pc-or-mac.html',
		'tags' => array(
			array('Beat Production Software Download', 'beat-production-software-download'),
			array('Beat Making Tutorials', 'beat-making-tutorials'),
			array('Hot to Produce Beats', 'hot-to-produce-beats'),
			array('Hip Hop Beatz', 'hip-hop-beatz'),
			array('Make Your Own Hip Hop Beat', 'make-your-own-hip-hop-beat'),
		),
		'thumb' => array(
			'src' => 'images/products/make-professional-beats-with-your-pc-or-mac_1.jpg',
			'title' => 'Make Professional Beats with Your PC or Mac'
		),
		'inner_image' => array(
			'src' => 'images/products/make-professional-beats-with-your-pc-or-mac_2.jpg',
			'title' => 'Make Professional Beats with Your PC or Mac'
		),
		'sidebar_image' => array(
			'src' => 'images/products/make-professional-beats-with-your-pc-or-mac_sidebar.jpg',
			'title' => 'Make Professional Beats with Your PC or Mac'
		),
		'like_image' => array(
			'src' => 'images/products/make-professional-beats-with-your-pc-or-mac_like.jpg',
			'title' => 'Make Professional Beats with Your PC or Mac'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.mmm2000.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/make-professional-beats-with-your-pc-or-mac.html') )
	)

*/
);