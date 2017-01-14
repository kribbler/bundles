<form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
		<label class="screen-reader-text" for="s">Search for:</label>
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search">
		<input type="submit" id="searchsubmit" value="" style="display: block;">
	</div>
</form>