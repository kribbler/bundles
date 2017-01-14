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
		'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank',
		'short_description' => 'Media Traffic Meltdown is a new innovative program that provides users with everything they need from generating traffic to earning money from their websites. The program will provides users with ultra secret traffic tips, and strategies, which send unstoppable waves of aimed traffic ranking in more than 30 thousand dollar in one single month. With this program, users do not concern about skills about Google, PPC, SEO, MSN, and CPV. In addition, this program will coach learners the ways to find out how to make huge income online with enormous loads of server crushing traffic beginning.  Besides, the authors claim that Media Traffic Meltdown will help learners bring huge windfalls of traffic as well as cash sales with under a half of hour a day. In addition, they do not need a list, product, a website, JV buddies or even any previous experience whatsoever.',
		'url' => 'media-traffic-meltdown-the-media-buying-course-on-clickbank.html',
		'tags' => array(
			array('Traffic', 'traffic'), 
			array('Traffic Meltdown', 'traffic-meltdown'),
			array('Generate Traffic', 'generate-traffic')
		),
		'thumb' => array(
			'src' => 'images/products/media-traffic-meltdown-the-media-buying-course-on-clickbank_1.jpg',
			'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank'
		),
		'inner_image' => array(
			'src' => 'images/products/media-traffic-meltdown-the-media-buying-course-on-clickbank_2.jpg',
			'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank'
		),
		'sidebar_image' => array(
			'src' => 'images/products/media-traffic-meltdown-the-media-buying-course-on-clickbank_sidebar.jpg',
			'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank'
		),
		'like_image' => array(
			'src' => 'images/products/media-traffic-meltdown-the-media-buying-course-on-clickbank_like.jpg',
			'title' => 'Media Traffic Meltdown, The Media Buying Course On Clickbank'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.anprofit.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/media-traffic-meltdown-the-media-buying-course-on-clickbank.html') ),
	),

	1 => array(
		'title' => 'Reviewing Traffic Travis Free SEO and PPC Software',
		'short_description' => 'Traffic Travis Free SEO and PPC Software is new software that is highly recommended for attracting traffic to a website. It makes it easier whenever there are needs to have more traffic drawn to a website. There are many editions of this software in the market which means you have lots of choices for consideration. Just choose the one that best suits your SEO needs satisfaction.<br />Comparing Traffic Travis Free SEO and PPC Software with other link building software programs, it is easy to use and enjoyable. There is high traffic guarantee to your website within short periods of time with Traffic Travis Free SEO and PPC Software.',
		'url' => 'reviewing-traffic-travis-free-seo-and-ppc-software.html',
		'tags' => array(
			array('Environment', 'environment'), 
			array('Optimization', 'optimization'),
			array('Seo Tools', 'seo-tools')
		),
		'thumb' => array(
			'src' => 'images/products/reviewing-traffic-travis-free-seo-and-ppc-software_1.jpg',
			'title' => 'Reviewing Traffic Travis Free SEO and PPC Software',
		),
		'inner_image' => array(
			'src' => 'images/products/reviewing-traffic-travis-free-seo-and-ppc-software_2.jpg',
			'title' => 'Reviewing Traffic Travis Free SEO and PPC Software',
		),
		'sidebar_image' => array(
			'src' => 'images/products/reviewing-traffic-travis-free-seo-and-ppc-software_sidebar.jpg',
			'title' => 'Reviewing Traffic Travis Free SEO and PPC Software',
		),
		'like_image' => array(
			'src' => 'images/products/reviewing-traffic-travis-free-seo-and-ppc-software_like.jpg',
			'title' => 'Reviewing Traffic Travis Free SEO and PPC Software',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.traffict.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/reviewing-traffic-travis-free-seo-and-ppc-software.html') )
	),

	2 => array(
		'title' => 'Getting the Best with Magic Submitter by Alexander Krulik',
		'short_description' => 'Magic submitter is one of the finest back link software capable of guaranteeing online dominance to any website. If you use the software to back link your site, it will within no time become one of the top searches on the search engines. Use Magic Submitter by Alexander Krulik today in case you want your website to appear first when searched on Google and other applicable search engines. Your site will get quality traffic through increased visitors courtesy of its autopilot technology. It might be blogs, articles, press releases or video files; magic submitter will spin all that and submit to multiple sites.',
		'url' => 'getting-the-best-with-magic-submitter-by-alexander-krulik.html',
		'tags' => array(
			array('back link software', 'back-link-software'), 
			array('Online Dominance', 'online-dominance')
		),
		'thumb' => array(
			'src' => 'images/products/getting-the-best-with-magic-submitter-by-alexander-krulik_1.jpg',
			'title' => 'Getting the Best with Magic Submitter by Alexander Krulik'
		),
		'inner_image' => array(
			'src' => 'images/products/getting-the-best-with-magic-submitter-by-alexander-krulik_2.jpg',
			'title' => 'Getting the Best with Magic Submitter by Alexander Krulik'
		),
		'sidebar_image' => array(
			'src' => 'images/products/getting-the-best-with-magic-submitter-by-alexander-krulik_sidebar.jpg',
			'title' => 'Getting the Best with Magic Submitter by Alexander Krulik'
		),
		'like_image' => array(
			'src' => 'images/products/getting-the-best-with-magic-submitter-by-alexander-krulik_like.jpg',
			'title' => 'Getting the Best with Magic Submitter by Alexander Krulik'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.msubmitter.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/getting-the-best-with-magic-submitter-by-alexander-krulik.html') )
	),

	3 => array(
		'title' => 'Get More Traffic to Your Page through FBInfluence',
		'short_description' => 'Successful marketing on social media depends on many things. However, the most important of them all is to perfect the art of driving traffic to your web page. There are so many people who have tried lots of alternatives, but most of them usually come up short in the long run. However, thanks to FBInfluence so many people are reaping the benefits of internet marketing and ramping up the revenues from their websites. This therefore is the ultimate solution to your social media marketing needs that you have been waiting for.',
		'url' => 'get-more-traffic-to-your-page-through-fbinfluence.html',
		'tags' => array(
			array('Successful Marketing', 'Successful-marketing'), 
			array('Driving Traffic', 'driving-traffic')
		),
		'thumb' => array(
			'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_1.jpg',
			'title' => 'Get More Traffic to Your Page through FBInfluence',
			array(
				array(
					'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_3.jpg',
					'title' => 'Get More Traffic to Your Page through FBInfluence',
				),
				array(
					'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_4.jpg',
					'title' => 'Get More Traffic to Your Page through FBInfluence',
				),
				array(
					'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_5.jpg',
					'title' => 'Get More Traffic to Your Page through FBInfluence',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_2.jpg',
			'title' => 'Get More Traffic to Your Page through FBInfluence'
		),
		'sidebar_image' => array(
			'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_sidebar.jpg',
			'title' => 'Get More Traffic to Your Page through FBInfluence'
		),
		'like_image' => array(
			'src' => 'images/products/get-more-traffic-to-your-page-through-fbinfluence_like.jpg',
			'title' => 'Get More Traffic to Your Page through FBInfluence'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.fbinfl.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/get-more-traffic-to-your-page-through-fbinfluence.html') )
	),

	4 => array(
		'title' => 'Generating Web Traffic with Seolinkvine', 
		'short_description' => 'Seolinkvine is well suitable to attract one-way links to your website anytime you want to generate traffic. Its effectiveness is instantaneous as your site will rank high among others as soon as you are through back linking with Seolinkvine. You must be aware of the fact that drawing quality traffic to an online site is one of the toughest tasks to accomplish. However, Seolinkvine can make everything easy for you. Never quit before you have tried it out and gotten the right end results. Read through this article to know about all the things that Seolinkvine is capable of doing for you.',
		'url' => 'generating-web-traffic-with-seolinkvine.html',
		'tags' => array(
			array('Seo Software', 'seo-software'), 
			array('Optimization', 'optimization'), 
			array('Seo', 'seo')
		),
		'thumb' => array(
			'src' => 'images/products/generating-web-traffic-with-seolinkvine_1.jpg',
			'title' => 'Generating Web Traffic with Seolinkvine'
		),
		'inner_image' => array(
			'src' => 'images/products/generating-web-traffic-with-seolinkvine_2.jpg',
			'title' => 'Generating Web Traffic with Seolinkvine'
		),
		'sidebar_image' => array(
			'src' => 'images/products/generating-web-traffic-with-seolinkvine_sidebar.jpg',
			'title' => 'Generating Web Traffic with Seolinkvine'
		),
		'like_image' => array(
			'src' => 'images/products/generating-web-traffic-with-seolinkvine_like.jpg',
			'title' => 'Generating Web Traffic with Seolinkvine'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.seolv.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/generating-web-traffic-with-seolinkvine.html') )
	),

	5 => array(
		'title' => 'Backlink Beast- Important Things to Know',
		'short_description' => 'Backlink Beast is a top site ranking tool that you will have the opportunity to use. It will be very critical for any website to use this tool because competition for high ranking on search engines has been heightened. Backlink Beast will be the right solution to dealing with all your concerns on whether SEO optimization really works or it’s a fuss. In this article, you will get to learn a lot of things about the software including its merits and demerits. After all that, you will be well positioned to make informed choices on whether Backlink Beast suits your SEO needs satisfaction.',
		'url' => 'backlink-beast-important-things-to-know.html',
		'tags' => array(
			array('Seo', 'seo'), 
			array('Software', 'software'), 
			array('Optimization', 'optimization')
		),
		'thumb' => array(
			'src' => 'images/products/backlink-beast-important-things-to-know_1.jpg',
			'title' => 'Backlink Beast- Important Things to Know'
		),
		'inner_image' => array(
			'src' => 'images/products/backlink-beast-important-things-to-know_2.jpg',
			'title' => 'Backlink Beast- Important Things to Know'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Backlink Beast- Important Things to Know'
		),
		'sidebar_image' => array(
			'src' => 'images/products/backlink-beast-important-things-to-know_sidebar.jpg',
			'title' => 'Backlink Beast- Important Things to Know'
		),
		'like_image' => array(
			'src' => 'images/products/backlink-beast-important-things-to-know_like.jpg',
			'title' => 'Backlink Beast- Important Things to Know'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.backbeast.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/backlink-beast-important-things-to-know.html') )
	),

	6 => array(
		'title' => 'Traffic Empires to Build Your Own Online Money Making Empire',
		'short_description' => 'As the word suggest, Traffic Empires is a great tool for developing and maintaining genuine and target traffic in a website. If you have a website with little or no traffic to generate the targeted income here is an efficient tool that will get you going on the correct path and show where you have gone wrong. Read the Traffic Empires review to find out how you can boost traffic in a website and generate outstanding income as a result. ',
		'url' => 'traffic-empires-to-build-your-own-online-money-making-empire.html',
		'tags' => array(
			array('Site Traffic', 'site-traffic'), 
			array('Increase Traffic', 'increase-traffic'), 
			array('Web Traffic', 'web-traffic')
		),
		'thumb' => array(
			'src' => 'images/products/traffic-empires-to-build-your-own-online-money-making-empire_1.jpg',
			'title' => 'Traffic Empires to Build Your Own Online Money Making Empire'
		),
		'inner_image' => array(
			'src' => 'images/products/traffic-empires-to-build-your-own-online-money-making-empire_2.jpg',
			'title' => 'Traffic Empires to Build Your Own Online Money Making Empire'
		),
		'sidebar_image' => array(
			'src' => 'images/products/traffic-empires-to-build-your-own-online-money-making-empire_sidebar.jpg',
			'title' => 'Traffic Empires to Build Your Own Online Money Making Empire'
		),
		'like_image' => array(
			'src' => 'images/products/traffic-empires-to-build-your-own-online-money-making-empire_like.jpg',
			'title' => 'Traffic Empires to Build Your Own Online Money Making Empire'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.mediatraf.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/traffic-empires-to-build-your-own-online-money-making-empire.html') )
	)
);