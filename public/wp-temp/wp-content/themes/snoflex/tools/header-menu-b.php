<?php
	$nav_menu = get_theme_mod('nav_menu_locations');
	
			echo '<div class="bottom-menu">';
			echo '<div class="subnavbarwrap">';
				echo '<div class="subnavbarcontainer">';
				echo '<div id="subnavbar">';
				echo '<div id="subnavbarbackground">';

					
					$immersion_redirect = '';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

					if (get_option('qsno') == "qsno785643q") {
						echo '<ul class="sf-menu quicklook">
							<li id="menuanchor" class="openanchor" style="background: #fff !important;"><a id="quicklabel" href="#" onclick="return false" style="margin-right:6px!important;">Quick Look</a>
							</li>
						</ul>';			
					}
					
					$bottomnavmini = ' style="display:none"';
					if (get_theme_mod('bottomnav-mini-logo') == 'Always Display') { $bottomnavmini = ''; }
					if (get_theme_mod('mini-logo')) { 
						echo "<ul id='show-mini-logo-bottom' $bottomnavmini >";
							echo '<a href="/'.$immersion_redirect.'"><li id="mini-logo-bottom" style="float:left;"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" />
							</li></a>
						</ul>';			
					}
					echo '<div id="menu-b-menu"><nav aria-label="Main Menu">';
					if ($nav_menu['header-menu-2'] != "0" && $nav_menu['header-menu-2'] != "") {
						wp_nav_menu( array('theme_location' => 'header-menu-2', 'menu_class' => 'sf-menu sno-bottom-menu', 'walker' => new Aria_Walker_Nav_Menu(), 'items_wrap' => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',) );
					} else { 
						wp_nav_menu( array('menu' => 'Bottom Menu', 'menu_class' => 'sf-menu sno-bottom-menu', 'walker' => new Aria_Walker_Nav_Menu(), 'items_wrap' => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',) );
					}
					
					echo '</nav></div>';
					
					echo "<ul id='menu-more-bottom' class='sf-menu sf-js-enabled sf-shadow' style='display:none'>";
						echo '<li id="menu-more-item-bottom" style="float:left;"><a href="/" class="sf-with-ul">More<span class="sf-sub-indicator"> »</span></a>
						<ul id="add-more-bottom" class="sub-menu"></ul>
						</li>
					</ul>';			

				echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="clear"></div>';

				if (get_theme_mod('bottomnav-align') == 'center') { ?>
					<script type="text/javascript">
						$('#subnavbar').addClass('subnavbarloading');
						$(window).load(function(){
							<?php 	$bottom_menu_width = get_theme_mod('content-width'); 
									if ($bottom_menu_width == '') $bottom_menu_width = 980;
							?>
							<?php if (get_theme_mod('header-alt') != "Display") { ?>
								var MenuBottomWidth = <?php echo $bottom_menu_width; ?>;
							<?php } else { ?>
								var MenuBottomWidth = $('#subnavbarbackground').width();
							<?php } ?>
							var bottom_margin_adjustment = 0;
							var dropdown_adjustment = $("#menu-a-menu ul > li > ul").length * 15; // width of carat added by Superfish
							<?php if (get_theme_mod('bottomnav-appearance') == "Blocks") { ?>
								bottom_margin_adjustment = parseInt($('ul.sno-bottom-menu > li > a').css('marginRight').slice(0,-2));
								$('#menu-b-menu ul > li:first-of-type').css('paddingLeft', '<?php echo get_theme_mod('bottomnav-margin'); ?>');
							<?php } ?>
							var center_width = $('#menu-b-menu').width() + dropdown_adjustment + 1;
							if (center_width > MenuBottomWidth) center_width = MenuBottomWidth;
							$('#menu-b-menu').width(center_width);
							$('#menu-b-menu').css('margin', '0 auto');
							$('#menu-b-menu').css('float', 'none');
							$('#subnavbar').removeClass('subnavbarloading');
						});
					</script>
				<?php } else { ?>
					<script type="text/javascript">
						$('#subnavbar').css("overflow-y", "hidden");
						$(window).load(function() {
							if ($( window).width() < 980) { return; }
							resizeMenuBottom();
						})
						
						function resizeMenuBottom() {
							if ($( window).width() < 980) { return; }
							var moreWidth = 0; var menubuffer = 0; var minilogo = 0;
							if ($('#menu-more-bottom').is(':visible')) { moreWidth = $('#menu-more-bottom').width(); }			
							<?php if (get_theme_mod('bottomnav-appearance') == 'Blocks') { ?>
								menubuffer = <?php echo rtrim(get_theme_mod('bottomnav-margin'), 'px'); ?>;
							<?php } ?>
							<?php if (get_theme_mod('mini-logo')) { ?>
								minilogo = $('#mini-logo-bottom').width();
							<?php } ?>
							<?php 	$menu_width = get_theme_mod('content-width'); 
									if ($menu_width == '') $menu_width = 980;
									$menu_width -= 10;
							?>
							<?php if (get_theme_mod('header-alt') != "Display") { ?>
								var MenuBottomWidth = <?php echo $menu_width; ?>;
							<?php } else { ?>
								var MenuBottomWidth = $('#subnavbarbackground').width() - 10;
							<?php } ?>
								var browserWidth = $(window).width();
								if (browserWidth < MenuBottomWidth) MenuBottomWidth = browserWidth;

							if (($('#menu-b-menu').width() + menubuffer + minilogo + moreWidth) >= MenuBottomWidth) 
							{ 
								$('.sno-bottom-menu > li:last-child').addClass('sub-menu'); 
								$('.sno-bottom-menu > li:last-child').appendTo('#add-more-bottom'); 
								if ($('#menu-more-bottom').is(':hidden')) { $('#menu-more-bottom').css({display: "block"}); }			
								if (($('#menu-b-menu').width() + menubuffer + minilogo + moreWidth) > MenuBottomWidth) {
									resizeMenuBottom(); 
								} else {
									$('#subnavbar').css("overflow-y", "unset");
									resizeMenuBottom(); 
								}
							} else {
								$('#subnavbar').css("overflow-y", "unset");
							} 							 
						}
	            		$( window ).resize(function() { 
	             	   		if ($( window).width() > 980) { resizeMenuBottom(); };
	            		});   
	 				</script>
	 			
	 			<?php } ?>
	 				
