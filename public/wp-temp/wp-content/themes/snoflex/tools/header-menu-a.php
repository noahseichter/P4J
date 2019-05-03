<?php
		echo '<div class="navbarwrap">';
			echo '<div class="navbarcontainer">';
			echo '<div id="navbar">';
				echo '<div id="navbarbackground">';
					$nav_menu = get_theme_mod('nav_menu_locations');

					$immersion_redirect = '';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

					$topnavmini = ' style="display:none"';
					if (get_theme_mod('topnav-mini-logo') == 'Always Display') { $topnavmini = ''; }
					if (get_theme_mod('mini-logo')) { 
						echo "<ul id='show-mini-logo-top' $topnavmini >";
							echo '<a href="/'.$immersion_redirect.'"><li id="mini-logo-top" style="float:left;"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" />
							</li></a>
						</ul>';			
					}
					echo '<div id="menu-a-menu"><nav aria-label="Secondary Menu">';
				
					if ($nav_menu['header-menu'] == '') {
						wp_nav_menu( array('menu' => 'Top Menu', 'menu_class' => 'sf-menu sno-top-menu') );
					} else { 
						wp_nav_menu( array('theme_location' => 'header-menu', 'menu_class' => 'sf-menu sno-top-menu') );
					}
					echo '</nav></div>';
							
							echo "<ul id='menu-more-top' class='sf-menu sf-js-enabled sf-shadow' style='display:none'>";
								echo '<li id="menu-more-item-top" style="float:left;"><a href="/" class="sf-with-ul">More<span class="sf-sub-indicator"> »</span></a>
								<ul id="add-more-top" class="sub-menu"></ul>
								</li>
							</ul>';			

				echo '</div>';
			echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="clear"></div>';

				if (get_theme_mod('topnav-align') == 'center') { ?>
					<script type="text/javascript">
						$('#navbar').addClass('navbarloading');
						$(window).load(function(){
							<?php 	$menu_width = get_theme_mod('content-width'); 
									if ($menu_width == '') $menu_width = 980;
							?>
							<?php if (get_theme_mod('header-alt') != "Display") { ?>
								var MenuTopWidth = <?php echo $menu_width; ?>;
							<?php } else { ?>
								var MenuTopWidth = $('#navbarbackground').width();
							<?php } ?>
							var top_margin_adjustment = 0;
							var dropdown_adjustment = $("#menu-a-menu ul > li > ul").length * 15; // width of carat added by Superfish
							<?php if (get_theme_mod('topnav-appearance') == "Blocks") { ?>
								top_margin_adjustment = parseInt($('ul.sno-top-menu > li > a').css('marginRight').slice(0,-2));
								$('#menu-a-menu ul > li:first-of-type').css('paddingLeft', top_margin_adjustment)
							<?php } ?>
							var top_center_width = $('#menu-a-menu').width() + dropdown_adjustment + 1;
							if (top_center_width > MenuTopWidth) top_center_width = MenuTopWidth;
							$('#menu-a-menu').width(top_center_width);
							$('#menu-a-menu').css('margin', '0 auto');
							$('#menu-a-menu').css('float', 'none');
							$('#navbar').removeClass('navbarloading');
						});
					</script>
				<?php } else { ?>

					<script type="text/javascript">
						$('#navbar').css("overflow-y", "hidden");
						$(window).load(function() {
							if ($( window).width() < 980) { return; }	
							resizeMenuTop();
						})
						<?php if (get_theme_mod('topnav-align') == 'right') { ?>
							$('#menu-more-top').insertBefore('#menu-a-menu')
						<?php } ?>
						
						function resizeMenuTop() {
							
							if ($( window).width() < 980) { return; }
	
							var moreWidthTop = 0; var menubufferTop = 0; var minilogoTop = 0;
	
							if ($('#menu-more-top').is(':visible')) { moreWidthTop = $('#menu-more-top').width(); }			
							<?php if (get_theme_mod('topnav-appearance') == 'Blocks') { ?>
								menubufferTop = <?php echo rtrim(get_theme_mod('topnav-margin'), 'px'); ?>;
							<?php } ?>
							<?php if (get_theme_mod('mini-logo')) { ?>
								minilogoTop = $('#mini-logo-top').width();
							<?php } ?>
							<?php 	$menu_width = get_theme_mod('content-width'); 
									if ($menu_width == '') $menu_width = 980;
									$menu_width -= 10;
							?>
							<?php if (get_theme_mod('header-alt') != "Display") { ?>
								var MenuTopWidth = <?php echo $menu_width; ?>;
							<?php } else { ?>
								var MenuTopWidth = $('#navbarbackground').width() - 10;
							<?php } ?>
								var browserWidth = $(window).width();
								if (browserWidth < MenuTopWidth) MenuTopWidth = browserWidth;
								
							
							if ($('#menu-a-menu').width() + menubufferTop + minilogoTop + moreWidthTop >= MenuTopWidth) 
							{ 
								$('.sno-top-menu > li:last-child').addClass('sub-menu'); 
								$('.sno-top-menu > li:last-child').appendTo('#add-more-top'); 
								if ($('#menu-more-top').is(':hidden')) { $('#menu-more-top').css({display: "block"}); }			
								if ($('#menu-a-menu').width() + menubufferTop + minilogoTop + moreWidthTop > MenuTopWidth) {
									resizeMenuTop(); 
								} else {
									$('#navbar').css("overflow-y", "unset");
									resizeMenuTop(); 
								}
							} else {
								$('#navbar').css("overflow-y", "unset");								
							}
							 
						}
	            		$( window ).resize(function() { 
	             	   		if ($( window).width() > 980) { resizeMenuTop(); };
	            		});   
	 				</script>
	 			<?php } ?>