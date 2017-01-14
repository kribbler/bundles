<?php
$args = array(
	'post_type'=>'press',
	'post_status'=>'publish',
	'posts_per_page'=>-1
);
query_posts( $args );
if(!empty($include_sh_press_stylesheets)):
?>
<style>
/*.press {
	width:820px;
	margin:auto;
}
.press .content {
	display:none;	
	color:#55b84e
}
.press .content p {
	margin-bottom:15px;	
}
.press .snippet {
	color:#aaa8a9;
}
.press > h2 {
	color:#0176c3;
	font-size:25px;
	text-transform:uppercase;
	font-weight:bolder;
	margin:60px 0px 50px 0px;
}
.press > h2.first {
	margin:20px 0px;
}
.press > div > div > div {
	border:1px dashed #4c99d1;
	padding:20px 30px;
		
}
.press > div > div {
	padding-bottom:15px;
	background:url(/images/bottompress.png) 50% 100% no-repeat;	
}
.press > div > div > div h3 {
	color:#0673c8;
	text-transform:uppercase;
	font-weight:bold;
	font-size:20px;
	position:relative;
	padding-right:20px;
}
.press > div > div > div h3 > span {
	color:#a8a8a8;
	font-weight:normal;
	font-size:18px;
}
.press > div > div > div h3 > span sup {
	text-transform:none;
	font-size:12px;	
}
.press > div > div > div h3 a.close {
	color:#a8a8a8;
	text-transform:none;
	position:absolute;
	right:0px;
	bottom:3px;
	font-weight:normal;
	font-size:12px;
	display:none;
	text-decoration:none;
}
.press > div a {
	font-style:italic;
	color:#007ac4;
	text-decoration:none;
}
.press .readmore {
	white-space:nowrap;	
}
.mediasize {
	float:left;
	width:268px;
	margin-right:18px;
}
.press .imgcont {
	width:470px;
	height:270px;
	overflow:hidden;
}
.inthepress #main {
	background-color:#fff;
	padding-bottom:180px;
}
.inthepress #main > div {
	background:url(/images/presshead.png) repeat-x 0px -35px;
}
.inthepress #main > div > div {
	background:url(/wp-content/themes/template/images/toppagenothome.png) 50% 40px no-repeat;
}
.presspage {
	height:105px;
	width:820px;
	margin:auto;
	font-size:19px;
	color:#0176c3;
	padding-left:7px;		
}
.presspage h1 {
	margin-left:-7px;	
}*/
</style>
<?php endif;?>

<div class="press no_top_margin">
<?php
$items=array();
$tax=array();
$slug=array();
$styles=array(
	'in-the-media'=>'media',
	'press-releases'=>'release'
);

while ( have_posts() ) {
	the_post();
	global $post;
	$terms=wp_get_post_terms($post->ID,'presstype');
	foreach ($terms as $a) {
		if (!isset($items[$a->term_id])) {
			$items[$a->term_id]=array();
			$tax[$a->term_id]=$a->name;
			$slug[$a->term_id]=$a->slug;
		}
		$items[$a->term_id][]=$post;
	}
}
wp_reset_query();
ksort($items);
$count=0;
foreach ($items as $k=>$q) {
	//echo '<h2',(($count==0) ? ' class="first"' : ''),'>',html($tax[$k]),'</h2>';
	echo '<div class="large_margin2 no_top_margin">';
	foreach ($q as $a) {
		echo '<div><div>';
		$a->youtube=get_post_meta($a->ID,'wp_press_youtube',true);
		$a->link=get_post_meta($a->ID,'wp_press_link',true);
		$f=(isset($slug[$k]) && function_exists('outputitem_'.$styles[$slug[$k]])) ? $styles[$slug[$k]] : 'release';
		call_user_func('outputitem_'.$f,$a);
		echo '</div></div>';
	}
	echo '</div>';
	echo '<hr />';
}
?>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-522a1adb515b4c87"></script>

<?php
function outputitem_media($post) {
	$style='';
	$im='';
	if (has_post_thumbnail($post->ID)) {
		$im=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$im=($im) ? $im[0] : '';
	}
	if ($post->youtube || $im)
		$style=' class="hasmedia mediasize"';
	echo '<div class="row-fluid">';
	echo '<div class="span6">';
	echo '<div',$style,'>';
	//echo '<h3>',$post->post_title,'<span><br/>',date('M d\<\s\u\p\>S\<\/\s\u\p\> Y',strtotime($post->post_date)),'</span><a href="#" class="close">Close</a></h3>';
	echo '<h3>',$post->post_title,'<span><br/>',date('M d\<\s\u\p\>S\<\/\s\u\p\> Y',strtotime($post->post_date)),'</span></h3>';
	echo '<div class="snippet">';
	echo snippet(tidystring($post->post_content),20),(strlen($post->post_content)>0) ? '... <br /><a href="#" class="readmore help_link">Read more...</a>' : '';
	echo '</div>';
	echo '<div class="content">';
	echo apply_filters('the_content', $post->post_content);
	echo '</div>';
	echo '<div class="links">';
	if ($post->youtube) {
		$l='http://www.youtube.com/watch?v='.$post->youtube;
		echo '<a href="',$link,'" target="_blank">',$link,'</a><br/>';	
	}
	if ($post->link) {
		$l=$post->link;
		echo '<a href="',$l,'" target="_blank">',$l,'</a><br/>';	
	}
	if (!empty($l)) {
		echo '<div class="addthis_toolbox addthis_default_style " addthis:url="',htmlq($l),'" addthis:title="',htmlq($post->post_title),'">
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_4"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
		</div>';
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '<div class="span6">';
	if ($post->youtube) {
		echo '<iframe class="media" width="470" height="270" src="//www.youtube.com/embed/',$post->youtube,'" frameborder="0" allowfullscreen></iframe>';	
	} elseif (!empty($im)) {
		if ($post->link)
			 echo '<a href="',$post->link,'" target="_blank">';
		echo '<div class="imgcont media"><img src="',$im,'" width="470px"/></div>';
		if ($post->link)
			echo '</a>';
	}
	echo '</div>';
	echo '</div>';
	echo '<div style="clear:both"></div>';
}
function outputitem_release($post) {
	echo '<h3>',$post->post_title,'<br /><span>',date('M d\<\s\u\p\>S\<\/\s\u\p\> Y',strtotime($post->post_date)),'</span><a href="#" style="display: none" class="close">Close</a></h3>';
	echo '<div class="snippet">';
	echo snippet(tidystring($post->post_content),20),(strlen($post->post_content)>0) ? '... <br /><a href="#" class="readmore help_link">Read more...</a>' : '';
	echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="content">';
	echo apply_filters('the_content', $post->post_content);
	echo '</div>';
}
?>
<script>
jQuery(document).ready(function($) {
	$('.readmore').click(function() {
		var p=$(this).parents('.press > div > div')
		$('.snippet,.media',p).hide();
		$('.close',p).show();
		$('.content',p).show();
		$('.hasmedia',p).removeClass('mediasize');
		return false;
	});
	$('.close').click(function() {
		var p=$(this).parents('div')
		$('.snippet,.media',p).show();
		$('.close',p).hide();
		$('.content',p).hide();
		$('.hasmedia',p).addClass('mediasize');
		return false;
	});
});
</script>