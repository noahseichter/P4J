<div class="topnavwrap">
	<div id="topnavbar">
			
			<div class="search-spacer"></div>

			<div class="topnavbarleft social-classic">
				<?php sno_display_icons(); ?>
			</div>

			<div class="topnavbarcenter">
        <?php if (get_theme_mod('show-date') == "Show" ) { ?>
            <script src="<?php bloginfo('template_url'); ?>/javascript/date.js" type="text/javascript"></script>
        <?php } ?>
			</div>
	
			<div class="topnavbarright">
				<?php sno_display_search(); ?>
			</div>
	</div>
	<div class="clear"></div>
</div>