<?php
$youtube=get_post_meta($post->ID,'wp_press_youtube',true);
$link=get_post_meta($post->ID,'wp_press_link',true);
?>
<p class="description">YouTube ID</p>
<input type="text" id="wp_press_youtube" name="wp_press_youtube" value="<?php echo htmlq($youtube); ?>" style="width:100%" size="120"/>

<p class="description">Link</p>
<input type="text" id="wp_press_link" name="wp_press_link" value="<?php echo htmlq($link); ?>" style="width:100%" size="120"/>





