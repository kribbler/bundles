<?php 
	global $concept7_data; 
	global $post;
	$children = get_pages('child_of='.$post->ID);
?>
<div class="subpage-wrapper <?php if(empty( $post->post_parent ) && count( $children ) != 0) echo 'subpage-parent' ?>">
	<ul class="subpage-container <?php if($concept7_data['site_layout'] == 'white') echo 'container'; ?>">
        <?php 
			
			if(!empty( $post->post_parent )){
				function curPageURL() {
					$pageURL = 'http';
					if (isset($_SERVER["HTTPS"]) == "on") {$pageURL .= "s";}
					$pageURL .= "://";
					if ($_SERVER["SERVER_PORT"] != "80") {
					$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					} else {
					$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					}
					return $pageURL;
				}
				$mypages = get_pages( array( 'child_of' => $post->post_parent, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
				foreach( $mypages as $page ) {		
				?>
					<?php $link = get_permalink($page->ID);
					$current_page = curPageURL();
					$page_quantity = sizeof($mypages);
					$icon = get_post_meta( $page->ID, 'icon', true );
					?>
					<li class="subpage-content" style="width:<?php echo 100/$page_quantity ?>%;"><?php if($link == $current_page) echo '<span class="subpage-bg subpage-bg-left"></span><span class="subpage-bg subpage-bg-right"></span>'; ?><a href="<?php echo get_page_link( $page->ID ); ?>" <?php if($link == $current_page) echo 'class="subpage-active"'; ?>><i class="<?php echo $icon; ?>"></i><?php echo $page->post_title; ?></a></li>
				<?php
				}
			}elseif(empty( $post->post_parent ) && count( $children ) != 0){
				$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
				$i = 0;
				foreach( $mypages as $page ) {
					$page_quantity = sizeof($mypages);
					$icon = get_post_meta( $page->ID, 'icon', true );	
				?>
					<li class="subpage-content" style="width:<?php echo 1/$page_quantity*100 ?>%;"><?php if($i == 0 && $concept7_data['site_layout'] != 'white') echo '<span class="subpage-bg subpage-bg-center"></span>'; ?><a href="<?php echo get_page_link( $page->ID ); ?>"><i class="<?php echo $icon; ?>"></i><?php echo $page->post_title; ?></a></li>
				<?php
					$i++;
				}
			}
		?>
    </ul>
</div>