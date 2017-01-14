<?php
global $sidebar_choice;

?>
<div class="sidebar-content"> 
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar_choice) ) : ?>
<?php endif; ?>
</div>
