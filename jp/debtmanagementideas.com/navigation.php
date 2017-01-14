    <!--NAVIGATION SECTION START-->
    <div class="cp-navigation-section">
      <nav class="navbar navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <strong class="cp-logo-style-1"><a href="./"><em>D</em>&nbsp;ebt Management<br />&nbsp;&nbsp;Ideas</a></strong> </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul id="nav" class="navbar-nav">
				<li><a href="./">Home</a></li>
				<?php foreach ($menu_links as $menu){ ?>
				<li><a href="#"><?php echo $menu['title']; ?></a>
					<ul>
						<?php foreach ($menu['posts'] as $id) { ?>
							<li><a href="<?php echo $posts[$id]['url'];?>"><?php echo $posts[$id]['title'];?></a></li>	
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
          </div>
        </div>
      </nav>
    </div>
    <!--NAVIGATION SECTION START--> 