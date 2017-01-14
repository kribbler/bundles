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
		'title' => 'Solve All Your Problems with Quantum Confidence Program',
		'short_description' => 'Quantum Confidence is an excellent audio program designed to let you accomplish your true potential in health, finances and relationship. It tells you the root cause of the problems which you are facing so that you can master your own mind in order to further enhance your life’s quality. It will teach you to remove doubts and restore confidence as to stimulate your brain capacity and power. Quantum Confidence will let you improve the image you have of yourself and thus, solve a lot of problem.',
		'url' => 'solve-all-your-problems-with-quantum-confidence-program.html',
		'tags' => array(
			array('Hyponsis', 'hyponsis'), 
			array('Brainwave Entertainment', 'brainwave-entertainment'),
			array('Morry Method', 'morry-method'),
			array('Quantum Confidence', 'quantum-confidence'),
			array('Strengthen Confidence', 'strengthen-confidence')
		),
		'thumb' => array(
			'src' => 'images/products/solve-all-your-problems-with-quantum-confidence-program_1.jpg',
			'title' => 'Solve All Your Problems with Quantum Confidence Program'
		),
		'inner_image' => array(
			'src' => 'images/products/solve-all-your-problems-with-quantum-confidence-program_2.jpg',
			'title' => 'Solve All Your Problems with Quantum Confidence Program'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/banner_5_53a07d7f5c49c_468x60.jpg',
			//'title' => 'Solve All Your Problems with Quantum Confidence Program'
		),
		'sidebar_image' => array(
			'src' => 'images/products/solve-all-your-problems-with-quantum-confidence-program_sidebar.jpg',
			'title' => 'Solve All Your Problems with Quantum Confidence Program'
		),
		'like_image' => array(
			'src' => 'images/products/solve-all-your-problems-with-quantum-confidence-program_like.jpg',
			'title' => 'Solve All Your Problems with Quantum Confidence Program'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.quantumcon.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/solve-all-your-problems-with-quantum-confidence-program.html') ),
	),

	1 => array(
		'title' => 'Curing Your Panic Attacks with the Charles Linden Method',
		'short_description' => 'Having Anxiety, Panic Attacks, Obsessive Compulsive Disorder or Phobias can be, at times, debilitating, humiliating and disabling. If you have experienced any of these disorders before, you have probably tried to cure them, to no avail. Panic Disorders like these can sometimes feel impossible to cure. However, this is certainly not the case. With the help of the Linden Method, you will be able to cure your panic attacks, agoraphobia and anxiety within no time at all. The Linden Method is a tried and proven way to cure your Panic Attacks.',
		'url' => 'curing-your-panic-attacks-with-the-charles-linden-method.html',
		'tags' => array(
			array('Agoraphobia Treatment', 'agoraphobia-treatment'), 
			array('Agoraphobia Cure', 'agoraphobia-cure'),
			array('Ocd Treatment', 'ocd-treatment'),
			array('Anxiety Attacks', 'anxiety-attacks'),
			array('Anxiety Cure', 'anxiety-cure')
		),
		'thumb' => array(
			'src' => 'images/products/curing-your-panic-attacks-with-the-charles-linden-method_1.jpg',
			'title' => 'Curing Your Panic Attacks with the Charles Linden Method',
		),
		'inner_image' => array(
			'src' => 'images/products/curing-your-panic-attacks-with-the-charles-linden-method_2.jpg',
			'title' => 'Curing Your Panic Attacks with the Charles Linden Method',
		),
		'sidebar_image' => array(
			'src' => 'images/products/curing-your-panic-attacks-with-the-charles-linden-method_sidebar.jpg',
			'title' => 'Curing Your Panic Attacks with the Charles Linden Method',
		),
		'like_image' => array(
			'src' => 'images/products/curing-your-panic-attacks-with-the-charles-linden-method_like.jpg',
			'title' => 'Curing Your Panic Attacks with the Charles Linden Method',
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.charleslin.hop.clickbank.net' ),
		'content' => clickbankReplacer( file_get_contents('templates/curing-your-panic-attacks-with-the-charles-linden-method.html') )
	),

	2 => array(
		'title' => 'Are You Shy or Suffering from Social Anxiety? Try the Shyness and Social Anxiety System',
		'short_description' => 'There is always that individual in the crowd that is quiet, with their head constantly facing the ground due to suffering from shyness and social anxiety. This is the kind of individual that is abnormally shy. In most cases, such a character is accompanied by a high level of insecurity as well as social anxiety. Such an individual is said to be suffering from what is known as the ‘shyness disorder’ that normally leads to depression. However, The Shyness and Social Anxiety System can help you if you are one such individual. This is a book that is basically dedicated at providing support to such individuals.',
		'url' => 'are-you-shy-or-suffering-from-social-anxiety.html',
		'tags' => array(
			array('Shyness', 'shyness'), 
			array('Panic Disorder', 'panic-disorder'),
			array('Anxiety', 'anxiety'),
			array('Social Anxiety Cures', 'social-anxiety-cures'),
			array('Cure Social Anxiety', 'cure-social-anxiety')
		),
		'thumb' => array(
			'src' => 'images/products/are-you-shy-or-suffering-from-social-anxiety_1.jpg',
			'title' => 'Are You Shy or Suffering from Social Anxiety? Try the Shyness and Social Anxiety System'
		),
		'inner_image' => array(
			'src' => 'images/products/are-you-shy-or-suffering-from-social-anxiety_2.jpg',
			'title' => 'Are You Shy or Suffering from Social Anxiety? Try the Shyness and Social Anxiety System'
		),
		'sidebar_image' => array(
			'src' => 'images/products/are-you-shy-or-suffering-from-social-anxiety_sidebar.jpg',
			'title' => 'Are You Shy or Suffering from Social Anxiety? Try the Shyness and Social Anxiety System'
		),
		'like_image' => array(
			'src' => 'images/products/are-you-shy-or-suffering-from-social-anxiety_like.jpg',
			'title' => 'Are You Shy or Suffering from Social Anxiety? Try the Shyness and Social Anxiety System'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.darekw.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/are-you-shy-or-suffering-from-social-anxiety.html') )
	),

	3 => array(
		'title' => 'The Perfect Counter Attack Program for Panic Attacks',
		'short_description' => 'The Panic Puzzle or what is commonly known as panic attacks is a common thing that though highly neglected by many, could result in tragic events that we do not anticipate. How panic attacks begin still remains a mystery and being that we are all human beings with different feelings and emotions, how our bodies and our brains react to such information once registered in our minds is yet to be discovered. The good news about the panic puzzle is that we can manage to control and regulate how frequently we get these attacks and the only way possible is by simply staying calm and relaxed as possible at all times.',
		'url' => 'the-perfect-counter-attack-program-for-panic-attacks.html',
		'tags' => array(
			array('Fear', 'fear'), 
			array('Anxiety', 'anxiety'), 
			array('Depression', 'depression'),
			array('Agoraphobia Panic Attacks', 'agoraphobia-panic-attacks'), 
			array('Anxiety Herbs', 'anxiety-herbs')
		),
		'thumb' => array(
			'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_1.jpg',
			'title' => 'The Perfect Counter Attack Program for Panic Attacks',
			array(
				array(
					'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_3.jpg',
					'title' => 'The Perfect Counter Attack Program for Panic Attacks',
				),
				array(
					'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_4.jpg',
					'title' => 'The Perfect Counter Attack Program for Panic Attacks',
				),
				array(
					'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_5.jpg',
					'title' => 'The Perfect Counter Attack Program for Panic Attacks',
				)
			)
		),
		'inner_image' => array(
			'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_2.jpg',
			'title' => 'The Perfect Counter Attack Program for Panic Attacks'
		),
		'sidebar_image' => array(
			'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_sidebar.jpg',
			'title' => 'The Perfect Counter Attack Program for Panic Attacks'
		),
		'like_image' => array(
			'src' => 'images/products/the-perfect-counter-attack-program-for-panic-attacks_like.jpg',
			'title' => 'The Perfect Counter Attack Program for Panic Attacks'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.endpanic.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/the-perfect-counter-attack-program-for-panic-attacks.html') )
	),

	4 => array(
		'title' => 'An Impact of the Super Mind Evaluation System', 
		'short_description' => 'As you may well be aware of The Super Mind Evaluation System, it is undoubtedly a very fundamental part of our daily activities. We need the mind in order to transition through the day without having a nervous breakdown. The brain is quite necessary for the careful articulation of our daily activities. So what comes to your mind when you hear or you think about the super mind evaluation system?',
		'url' => 'an-impact-of-the-super-mind-evaluation-system.html',
		'tags' => array(
			array('Brain Power', 'brain-power'), 
			array('Brain Evolution System', 'brain-evolution-system'), 
			array('Super Mind', 'super-mind'),
			array('Mind Control Method', 'mind-control-method'),
			array('Real Mind Power', 'real-mind-power')
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

	5 => array(
		'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries',
		'short_description' => 'If you are a sufferer of an Anxiety Disorder, or a severe phobia such as agoraphobia, you will know how debilitating such a disorder can be. You are restricted to your own home, unable to make social contact and can be afraid of even the most conventional situations. Because of this, you have probably sought out many solutions to your problem, and the very fact that you are still reading this implies that you have not. However, Panic Miracle could be the end to your debilitating worries.',
		'url' => 'panic-miracle-could-be-the-end-to-your-debilitating-worries.html',
		'tags' => array(
			array('Ocd Treatment', 'ocd-treatment'), 
			array('Panic Attacks Cure', 'panic-attacks-cure'), 
			array('Anxiety Cure', 'anxiety-cure'),
			array('Agoraphobia Cure', 'agoraphobia-cure'),
			array('Ocd Treatment', 'ocd-treatment')
		),
		'thumb' => array(
			'src' => 'images/products/panic-miracle-could-be-the-end-to-your-debilitating-worries_1.jpg',
			'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries'
		),
		'inner_image' => array(
			'src' => 'images/products/panic-miracle-could-be-the-end-to-your-debilitating-worries_2.jpg',
			'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries'
		),
		'bottom_image' => array(
			//'src' => 'images/paleo/lose-weight-and-increase-your-muscles-with-burn-the-fat2.jpg',
			//'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries'
		),
		'sidebar_image' => array(
			'src' => 'images/products/panic-miracle-could-be-the-end-to-your-debilitating-worries_sidebar.jpg',
			'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries'
		),
		'like_image' => array(
			'src' => 'images/products/panic-miracle-could-be-the-end-to-your-debilitating-worries_like.jpg',
			'title' => 'Panic Miracle Could Be the End to Your Debilitating Worries'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.anxiety7.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/panic-miracle-could-be-the-end-to-your-debilitating-worries.html') )
	),

	6 => array(
		'title' => 'Change Your Life with Conversation Confidence',
		'short_description' => 'Conversation Confidence is an ebook designed for all those who do not have much confident in themselves and feel awkward when they are among people, especially the ones they don’t know well. This book guarantees to boost up your self confidence so that you can sit and talk among people as comfortably as others do. Conversation Confidence will also give you tips on how you can be the most one of the most attractive people in a group. It can fully change your social life.',
		'url' => 'change-your-life-with-conversation-confidence.html',
		'tags' => array(
			array('Renovate Confidence', 'renovate-confidence'), 
			array('Developing Confidence While Conversing', 'developing-confidence-while-conversing'), 
			array('Developing Confidence', 'developing-confidence'),
			array('Gain Confidence', 'gain-confidence'),
			array('Person Confidence', 'person-confidence')
		),
		'thumb' => array(
			'src' => 'images/products/change-your-life-with-conversation-confidence_1.jpg',
			'title' => 'Change Your Life with Conversation Confidence'
		),
		'inner_image' => array(
			'src' => 'images/products/change-your-life-with-conversation-confidence_2.jpg',
			'title' => 'Change Your Life with Conversation Confidence'
		),
		'sidebar_image' => array(
			'src' => 'images/products/change-your-life-with-conversation-confidence_sidebar.jpg',
			'title' => 'Change Your Life with Conversation Confidence'
		),
		'like_image' => array(
			'src' => 'images/products/change-your-life-with-conversation-confidence_like.jpg',
			'title' => 'Change Your Life with Conversation Confidence'
		),
		'thumb_link' => clickbankReplacer( 'http://ethiccash.eduardez.hop.clickbank.net/' ),
		'content' => clickbankReplacer( file_get_contents('templates/change-your-life-with-conversation-confidence.html') )
	)
);