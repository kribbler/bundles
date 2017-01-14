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
		'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve',
		'short_description' => 'The Lasting Happiness And Success Formula is an excellent guide to accomplish happiness and success. The Lasting Happiness And Success Formula would stimulate that single most essential ingredient that would reformat the buyer’s cellular memory so he can enjoy an everlasting happiness and success. If you whole-heartedly apply the principles of this system, your life can change and you will discover a newborn emotion of inner peace and worth within yourself. The Lasting Happiness And Success Formula will make you realize your true worth.',
		'url' => 'the-lasting-happiness-and-success-formula-live-the-life-you-deserve.html',
		'tags' => array(
			array('Reprogram Your Cellular Memory', 'reprogram-your-cellular-memory'),
			array('Future Life Vision', 'future-life-vision'),
			array('Shaping Your Future', 'shaping-your-future'),
			array('Cellular Memory', 'cellular-memory'),
			array('Become Successful', 'become-successful'),
			array('Achieve Wealth', 'achieve-wealth'),
		),
		'thumb' => array(
			'src' => 'images/products/the-lasting-happiness-and-success-formula-live-the-life-you-deserve_1.jpg',
			'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve'
		),
		'inner_image' => array(
			'src' => 'images/products/the-lasting-happiness-and-success-formula-live-the-life-you-deserve_2.jpg',
			'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve'
		),
		'sidebar_image' => array(
			'src' => 'images/products/the-lasting-happiness-and-success-formula-live-the-life-you-deserve_sidebar.jpg',
			'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve'
		),
		'like_image' => array(
			'src' => 'images/products/the-lasting-happiness-and-success-formula-live-the-life-you-deserve_like.jpg',
			'title' => 'The Lasting Happiness and Success Formula – Live the Life You Deserve'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.successhap.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/the-lasting-happiness-and-success-formula-live-the-life-you-deserve.html') ),
	),

	/*1 => array(
		'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		'short_description' => 'Guitar lessons can be obtained in a variety of ways. However, it has been established that among these multitude of ways to learn, online guitar lessons provide the most effective and economical way to getting started with guitar playing. The Jamorama learn guitar product has been the natural choice for a great number of online guitar learning students. ',
		'url' => 'learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product.html',
		'tags' => array(
			array('Learn Lead Guitar free', 'learn-lead-guitar-free'),
			array('Learn Lead Guitar', 'learn-lead-guitar'),
			array('Learn Jazz Guitar', 'learn-jazz-guitar'),
			array('Learn How to Read Guitar Tab', 'learn-how-to-read-guitar-tab'),
			array('Learn How to Read Guitar Music', 'learn-how-to-read-guitar-music'),
			array('Learn How to Play Guitar Chord', 'learn-how-to-play-guitar-chord')
		),
		'thumb' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_1.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		),
		'inner_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_2.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		),
		'sidebar_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_sidebar.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		),
		'like_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_like.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.jamorama.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product.html') )
	),*/

	2 => array(
		'title' => 'An Impact of the Super Mind Evaluation System',
		'short_description' => 'As you may well be aware of The Super Mind Evaluation System, it is undoubtedly a very fundamental part of our daily activities. We need the mind in order to transition through the day without having a nervous breakdown. The brain is quite necessary for the careful articulation of our daily activities. So what comes to your mind when you hear or you think about the super mind evaluation system?',
		'url' => 'an-impact-of-the-super-mind-evaluation-system.html',
		'tags' => array(
			array('Brain Power', 'brain-power'),
			array('Brain Evolution System', 'brain-evolution-system'),
			array('Super Mind', 'super-mind'),
			array('Super Mind Power', 'super-mind-power'),
			array('Super Mind Power System', 'super-mind-power-system'),
			array('Brain Evolution System Review', 'brain-evolution-system-review')
		),
		'thumb' => array(
			'src' => 'images/products/an-impact-of-the-super-mind-evaluation-system_1.jpg',
			'title' => 'An Impact of the Super Mind Evaluation System'
		),
		'inner_image' => array(
			'src' => 'images/products/an-impact-of-the-super-mind-evaluation-system_2.jpg',
			'title' => 'An Impact of the Super Mind Evaluation System'
		),
		'sidebar_image' => array(
			'src' => 'images/products/an-impact-of-the-super-mind-evaluation-system_sidebar.jpg',
			'title' => 'An Impact of the Super Mind Evaluation System'
		),
		'like_image' => array(
			'src' => 'images/products/an-impact-of-the-super-mind-evaluation-system_like.jpg',
			'title' => 'An Impact of the Super Mind Evaluation System'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.legster.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/an-impact-of-the-super-mind-evaluation-system.html') )
	),

	3 => array(
		'title' => 'Tapping the Hidden Power of Your Subconscious',
		'short_description' => 'Our brain is probably the most complex organ in our bodies yet so little is known about it. What we do know is that it controls most of our daily actions and decisions at a conscious level. However it uses only 10% of its capacity in doing these tasks. The other 90% remains unutilized. Imagine what you can achieve if you are able to tap into your subconscious mind and utilize 100% of your brain\'s capacity? The results would be unbelievable. Mind Secrets Exposed 2.0 guides you towards utilizing this hidden potential which is present in each one of us with real life examples of people who have harnessed the power of their subconscious mind to achieve miraculous results in life from creating wealth to beating cancer!',
		'url' => 'tapping-the-hidden-power-of-your-subconscious.html',
		'tags' => array(
			array('Achieve Impossible Results', 'achieve-impossible-results'),
			array('Capacity of the Subconscious Mind', 'capacity-of-the-subconscious-mind'),
			array('Unlock Brain', 'unlock-brain'),
			array('Unlock Your Brain', 'unlock-your-brain'),
			array('Curing Cancer Without Medication', 'curing-cancer-without-medication'),
			array('Secrets of the Brain', 'secrets-of-the-brain'), 
		),
		'thumb' => array(
			'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_1.jpg',
			'title' => 'Tapping the Hidden Power of Your Subconscious',
			array(
				array(
					'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_3.jpg',
					'title' => 'Tapping the Hidden Power of Your Subconscious',
				),
				array(
					'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_4.jpg',
					'title' => 'Tapping the Hidden Power of Your Subconscious',
				),
				array(
					'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_5.jpg',
					'title' => 'Tapping the Hidden Power of Your Subconscious',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_2.jpg',
			'title' => 'Tapping the Hidden Power of Your Subconscious'
		),
		'sidebar_image' => array(
			'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_sidebar.jpg',
			'title' => 'Tapping the Hidden Power of Your Subconscious'
		),
		'like_image' => array(
			'src' => 'images/products/tapping-the-hidden-power-of-your-subconscious_like.jpg',
			'title' => 'Tapping the Hidden Power of Your Subconscious'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.mentis.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/tapping-the-hidden-power-of-your-subconscious.html') )
	),

	4 => array(
		'title' => 'Discover the Secrets of the Universal Laws with Revolutioniz', 
		'short_description' => 'It is scientifically proven that what we perceive as reality is actually frequencies or wavelengths. Our senses can perceive only 4% of the matter in the Universe. The remaining 96% remains invisible to our senses. However this 96% is governed by laws known as Universal Laws. Revolutioniz helps you to understand these laws and use them to your advantage. You can benefit immensely with these Universal laws. Understanding these Universal laws is the key to lead a rewarding and prosperous life.',
		'url' => 'discover-the-secrets-of-the-universal-laws-with-revolutioniz.html',
		'tags' => array(
			
		),
		'thumb' => array(
			'src' => 'images/products/discover-the-secrets-of-the-universal-laws-with-revolutioniz_1.jpg',
			'title' => 'Discover the Secrets of the Universal Laws with Revolutioniz'
		),
		'inner_image' => array(
			'src' => 'images/products/discover-the-secrets-of-the-universal-laws-with-revolutioniz_2.jpg',
			'title' => 'Discover the Secrets of the Universal Laws with Revolutioniz'
		),
		'sidebar_image' => array(
			'src' => 'images/products/discover-the-secrets-of-the-universal-laws-with-revolutioniz_sidebar.jpg',
			'title' => 'Discover the Secrets of the Universal Laws with Revolutioniz'
		),
		'like_image' => array(
			'src' => 'images/products/discover-the-secrets-of-the-universal-laws-with-revolutioniz_like.jpg',
			'title' => 'Discover the Secrets of the Universal Laws with Revolutioniz'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.rvltioniz.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/discover-the-secrets-of-the-universal-laws-with-revolutioniz.html') )
	),

	5 => array(
		'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough',
		'short_description' => 'Blushing Breakthrough is an ebook designed for all those who blush a lot on almost everything. The Author, Jim Baker, himself was a victim of continuous blushing but he overcame it and now is ready to share his secrets with you. Blushing Breakthrough will solve your blushing trouble so that you can talk to somebody without becoming all read and not look awkward while attending a social gathering. This is an extremely effective book and 100 percent satisfaction is guaranteed.',
		'url' => 'resolve-your-regular-blushing-problem-with-blushing-breakthrough.html',
		'tags' => array(
			array('Stop Your Blushing', 'stop-your-blushing'),
			array('Controlling Blush', 'controlling-blush'),
			array('Reasons of Blushing', 'reasons-of-blushing'),
			array('Try to Control Blushing', 'try-to-control-blushing'),
			array('Control Blushing', 'control-blushing'),
			array('Blushing Breakthrough', 'blushing-breakthrough'),
		),
		'thumb' => array(
			'src' => 'images/products/resolve-your-regular-blushing-problem-with-blushing-breakthrough_1.jpg',
			'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough'
		),
		'inner_image' => array(
			'src' => 'images/products/resolve-your-regular-blushing-problem-with-blushing-breakthrough_2.jpg',
			'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough'
		),
		'sidebar_image' => array(
			'src' => 'images/products/resolve-your-regular-blushing-problem-with-blushing-breakthrough_sidebar.jpg',
			'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough'
		),
		'like_image' => array(
			'src' => 'images/products/resolve-your-regular-blushing-problem-with-blushing-breakthrough_like.jpg',
			'title' => 'Resolve Your Regular Blushing Problem with Blushing Breakthrough'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.noblush.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/resolve-your-regular-blushing-problem-with-blushing-breakthrough.html') )
	),

	6 => array(
		'title' => 'Using Public Speaking Crush it to Achieve Success',
		'short_description' => 'There are so many people in the world today who are looking for that one solution that will guide them through their life as public speakers. In the event that you happen to be one of them, be sure that you get your hands on the Public Speaking Crush It guide to successful public speaking. This has been touted as the perfect alternative solution to getting to hire an expensive coach. Going by the number of people who have successfully managed to use this particular guide, you can be sure it will be a hit for you.',
		'url' => 'using-public-speaking-crush-it-to-achieve-success.html',
		'tags' => array(
			array('Public Speaking Crush It', 'public-speaking-crush-it'),
			array('How to Go About Public Speaking', 'how-to-go-about-public-speaking'),
			array('Public Speaking Art', 'public-speaking-art'),
			array('Learn Public Speaking', 'learn-public-speaking'),
			array('Elements of Public Speaking', 'elements-of-public-speaking'),
			array('Public Speaking Prowess', 'public-speaking-prowess'),
		),
		'thumb' => array(
			'src' => 'images/products/using-public-speaking-crush-it-to-achieve-success_1.jpg',
			'title' => 'Using Public Speaking Crush it to Achieve Success'
		),
		'inner_image' => array(
			'src' => 'images/products/using-public-speaking-crush-it-to-achieve-success_2.jpg',
			'title' => 'Using Public Speaking Crush it to Achieve Success'
		),
		'sidebar_image' => array(
			'src' => 'images/products/using-public-speaking-crush-it-to-achieve-success_sidebar.jpg',
			'title' => 'Using Public Speaking Crush it to Achieve Success'
		),
		'like_image' => array(
			'src' => 'images/products/using-public-speaking-crush-it-to-achieve-success_like.jpg',
			'title' => 'Using Public Speaking Crush it to Achieve Success'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.publicsp.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/using-public-speaking-crush-it-to-achieve-success.html') )
	)

);