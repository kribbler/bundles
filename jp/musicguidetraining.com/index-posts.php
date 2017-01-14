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
		'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product',
		'short_description' => 'Guitar lessons can be obtained in a variety of ways. However, it has been established that among these multitude of ways to learn, online guitar lessons provide the most effective and economical way to getting started with guitar playing. The Jamorama learn guitar product has been the natural choice for a great number of online guitar learning students. ',
		'url' => 'learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product.html',
		'tags' => array(
			array('Learn Lead Guitar Free', 'learn-lead-guitar-free'),
			array('Learn Lead Guitar', 'learn-lead-guitar'),
			array('Learn Jazz Guitar', 'learn-jazz-guitar'),
			array('Learn How to Read Guitar Tab', 'learn-how-to-read-guitar-tab'),
			array('Online Guitar Lesson', 'online-guitar-lesson')
		),
		'thumb' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_1.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product'
		),
		'inner_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_2.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product'
		),
		'sidebar_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_sidebar.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product'
		),
		'like_image' => array(
			'src' => 'images/products/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product_like.jpg',
			'title' => 'Learn To Strum Your Guitar Like a Pro with Jamorama Learn Guitar Product'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.jamorama.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/learn-to-strum-your-guitar-like-a-pro-with-jamorama-learn-guitar-product.html') ),
	),

	1 => array(
		'title' => 'You can sing like a professional with Singorama',
		'short_description' => 'Modern people are crazy about singing and it is earnest desire of everyone to become a famous singer. If you are also one of these people then don’t get worried because your dream is going to come true with singorama. It is complete guide about singing perfectly and provides you complete assistance in this regard. It guides you about the vocal rang, timing and rhythm. These are the things that are very important for singing in a perfect way. You can enjoy a great fun with singorama.',
		'url' => 'you-can-sing-like-a-professional-with-singorama.html',
		'tags' => array(
			array('Learning Singing', 'learning-singing'),
			array('Vocal Classes', 'vocal-classes'),
			array('Learning to Sing in Tune', 'learning-to-sing-in-tune'),
			array('Free Voice Lessons', 'free-voice-lessons'),
			array('How to Learn to Sing Better', 'how-to-learn-to-sing-better'),
		),
		'thumb' => array(
			'src' => 'images/products/you-can-sing-like-a-professional-with-singorama_1.jpg',
			'title' => 'You can sing like a professional with Singorama',
		),
		'inner_image' => array(
			'src' => 'images/products/you-can-sing-like-a-professional-with-singorama_2.jpg',
			'title' => 'You can sing like a professional with Singorama',
		),
		'sidebar_image' => array(
			'src' => 'images/products/you-can-sing-like-a-professional-with-singorama_sidebar.jpg',
			'title' => 'You can sing like a professional with Singorama',
		),
		'like_image' => array(
			'src' => 'images/products/you-can-sing-like-a-professional-with-singorama_like.jpg',
			'title' => 'You can sing like a professional with Singorama',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.singorama.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/you-can-sing-like-a-professional-with-singorama.html') )
	),

	2 => array(
		'title' => 'Learning piano is trouble-free with Pianoforall',
		'short_description' => 'Pianoforall is the most effective and convenient way to learn piano. Playing piano is very fantastic feeling and it provides you a great entertainment. If you want to become soul of parties then pianoforall should be your first priority. Most of the people cannot learn playing piano because they cannot go outside their home due to some important reasons. Pianoforall is ideal for such people because it helps you in learning the efficient piano skills without going out of your home.',
		'url' => 'learning-piano-is-trouble-free-with-pianoforall.html',
		'tags' => array(
			array('Piano Lessons', 'piano-lessons'),
			array('Piano For All', 'piano-for-all'),
			array('Learn Perfect Piano Skills', 'learn-perfect-piano-skills'),
			array('Piano Learners', 'piano-learners'),
			array('Playing Music', 'playing-music'),
		),
		'thumb' => array(
			'src' => 'images/products/learning-piano-is-trouble-free-with-pianoforall_1.jpg',
			'title' => 'Learning piano is trouble-free with Pianoforall'
		),
		'inner_image' => array(
			'src' => 'images/products/learning-piano-is-trouble-free-with-pianoforall_2.jpg',
			'title' => 'Learning piano is trouble-free with Pianoforall'
		),
		'sidebar_image' => array(
			'src' => 'images/products/learning-piano-is-trouble-free-with-pianoforall_sidebar.jpg',
			'title' => 'Learning piano is trouble-free with Pianoforall'
		),
		'like_image' => array(
			'src' => 'images/products/learning-piano-is-trouble-free-with-pianoforall_like.jpg',
			'title' => 'Learning piano is trouble-free with Pianoforall'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.piano4all.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/learning-piano-is-trouble-free-with-pianoforall.html') )
	),

	3 => array(
		'title' => 'Learn Piano from Home with Rocket Piano',
		'short_description' => 'Rocket Piano works for anyone who likes to take up piano lessons. The site caters from the absolute beginner from young to adult and to anyone who does not have the time to take up practical lessons in their busy schedules. Playing the piano is an art and it is important to focus the mind and be devoted to the lessons if you need to become a skilled piano player. Rocket piano is dedicated in optimizing this aim and have accordingly designed an online piano course to suit the diverse needs of their piano lesson seeking customers.',
		'url' => 'learn-piano-from-home-with-rocket-piano.html',
		'tags' => array(
			array('Pianos', 'pianos'), 
			array('Piano Music', 'piano-music'), 
			array('Rocket Piano', 'rocket-piano'), 
			array('Rocket Piano Review', 'rocket-piano-review'), 
			array('How to Play Riano', 'how-to-play-piano'), 
		),
		'thumb' => array(
			'src' => 'images/products/learn-piano-from-home-with-rocket-piano_1.jpg',
			'title' => 'Learn Piano from Home with Rocket Piano',
			array(
				array(
					'src' => 'images/products/learn-piano-from-home-with-rocket-piano_3.jpg',
					'title' => 'Learn Piano from Home with Rocket Piano',
				),
				array(
					'src' => 'images/products/learn-piano-from-home-with-rocket-piano_4.jpg',
					'title' => 'Learn Piano from Home with Rocket Piano',
				),
				array(
					'src' => 'images/products/learn-piano-from-home-with-rocket-piano_5.jpg',
					'title' => 'Learn Piano from Home with Rocket Piano',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/learn-piano-from-home-with-rocket-piano_2.jpg',
			'title' => 'Learn Piano from Home with Rocket Piano'
		),
		'sidebar_image' => array(
			'src' => 'images/products/learn-piano-from-home-with-rocket-piano_sidebar.jpg',
			'title' => 'Learn Piano from Home with Rocket Piano'
		),
		'like_image' => array(
			'src' => 'images/products/learn-piano-from-home-with-rocket-piano_like.jpg',
			'title' => 'Learn Piano from Home with Rocket Piano'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.rpiano.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/learn-piano-from-home-with-rocket-piano.html') )
	),

	4 => array(
		'title' => 'Violin master pro – a complete violin playing guide with fantastic features', 
		'short_description' => 'Violin is an important musical instrument and music is incomplete without adding the beautiful sound of this particular musical instrument. It is not very easy to job to play violin because even the great professionals cannot play it perfectly. But thanks to violin master pro because this fantastic program helps in playing violin in an awesome way. It is a royal musical instrument and gives a fantastic relaxing sound to the hearer. Violin master pro can tell you about the important secrets of playing violin.',
		'url' => 'violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features.html',
		'tags' => array(
			array('learn to play violin', 'learn-to-play-violin'),
			array('master the violin immediately', 'master-the-violin-immediately'),
			array('100 video lessons by the master', '100-video-lessons-by-the-master'),
			array('violinmasterprocom', 'violinmasterprocom'),
			array('violin lessons', 'violin-lessons'),
		),
		'thumb' => array(
			'src' => 'images/products/violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features_1.jpg',
			'title' => 'Violin master pro – a complete violin playing guide with fantastic features'
		),
		'inner_image' => array(
			'src' => 'images/products/violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features_2.jpg',
			'title' => 'Violin master pro – a complete violin playing guide with fantastic features'
		),
		'sidebar_image' => array(
			'src' => 'images/products/violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features_sidebar.jpg',
			'title' => 'Violin master pro – a complete violin playing guide with fantastic features'
		),
		'like_image' => array(
			'src' => 'images/products/violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features_like.jpg',
			'title' => 'Violin master pro – a complete violin playing guide with fantastic features'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.violinmas.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/violin-master-pro-a-complete-violin-playing-guide-with-fantastic-features.html') )
	),

	5 => array(
		'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer',
		'short_description' => 'Are you looking to create tantalizing hip hop, rap or other beats with your own computer? If your quest is for an affordable and comprehensive beat making software, this review on Sonic Producer will provide the answers to your questions. Most online beat making software has disappointed a great number of creators simply because they are not up to the mark. A significant volume of reviews on Sonic Producer indicates to the contrary.',
		'url' => 'the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer.html',
		'tags' => array(
			array('Beat Machine', 'beat-machine'),
			array('Make Music Online', 'make-music-online'),
			array('Music Maker Software', 'music-maker-software'),
			array('Produce Music Software', 'produce-music-software'),
			array('Make Beats with Software', 'make-beats-with-software'),
		),
		'thumb' => array(
			'src' => 'images/products/the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer_1.jpg',
			'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer'
		),
		'inner_image' => array(
			'src' => 'images/products/the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer_2.jpg',
			'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer'
		),
		'sidebar_image' => array(
			'src' => 'images/products/the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer_sidebar.jpg',
			'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer'
		),
		'like_image' => array(
			'src' => 'images/products/the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer_like.jpg',
			'title' => 'The Long Awaited Answer to Ultimate Beat Making Software Sonic Producer'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.sonicpro.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/the-long-awaited-answer-to-ultimate-beat-making-software-sonic-producer.html') )
	),

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
);