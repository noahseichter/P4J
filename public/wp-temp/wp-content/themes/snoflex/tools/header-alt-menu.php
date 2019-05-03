<?php				echo '<div id="subnavbar">';
					echo '<div id="subnavbarbackground">';

					$nav_menu = get_theme_mod('nav_menu_locations');			
					
					$immersion_redirect = '';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

					$bottomnavmini = ' style="display:none"';
					if (get_theme_mod('bottomnav-mini-logo') == 'Always Display') { $bottomnavmini = ''; }
					if (get_theme_mod('mini-logo')) { 
						echo "<ul id='show-mini-logo-bottom' $bottomnavmini >";
							echo '<a href="/'.$immersion_redirect.'"><li id="mini-logo-bottom" style="float:left;"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" />
							</li></a>
						</ul>';			
					}
					echo '<div id="menu-b-menu">';

						if ($nav_menu['header-menu-2'] == '') {
							wp_nav_menu( array('menu' => 'Bottom Menu', 'menu_class' => 'sf-menu alt-b') );
						} else { 
							wp_nav_menu( array('theme_location' => 'header-menu-2', 'menu_class' => 'sf-menu alt-b') );
						}

					echo '</div>';

							echo "<ul id='menu-more' class='sf-menu sf-js-enabled sf-shadow' style='display:none'>";
								echo '<li id="menu-more-item" style="float:left;"><a href="/" class="sf-with-ul">More<span class="sf-sub-indicator"> »</span></a>
								<ul id="add-more" class="sub-menu"></ul>
								</li>
							</ul>';			

					echo '</div>';
				echo '</div>';
				?><script type="text/javascript">
					$(document).ready(function() {
						resizeMenu();
					})
					$(window).load(function() {
						resizeMenu();
					})
					
					function resizeMenu() {
						var moreWidth = 0; var menubuffer = 0; var minilogo = 0;
						if ($('#menu-more').is(':visible')) { moreWidth = $('#menu-more').width(); }			

						<?php if (get_theme_mod('bottomnav-appearance') == 'Blocks') { ?>
							menubuffer = <?php echo rtrim(get_theme_mod('bottomnav-margin'), 'px'); ?>;
						<?php } ?>
						<?php if (get_theme_mod('mini-logo')) { ?>
							minilogo = $('#mini-logo-bottom').width();
						<?php } ?>

						if (($('#menu-b-menu').width() + minilogo + moreWidth + menubuffer) > ($(window).width() - 326)) 
						{ 
							$('.alt-b > li:last-child').addClass('sub-menu'); 
							$('.alt-b > li:last-child').appendTo('#add-more'); 
							if ($('#menu-more').is(':hidden')) { $('#menu-more').css({display: "block"}); }			
							resizeMenu(); 
						} 
						 
					}
					
					$(window).scroll(function() {
						resizeMenu();
					});
            		$( window ).resize(function() { 
             	   		if ($( window).width() > 980) { resizeMenu(); };
            		});   

 				</script><?php
