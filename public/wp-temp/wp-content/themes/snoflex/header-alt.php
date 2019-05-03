<?php

echo '<div id="alt_wrap">';
	$nav_menu = get_theme_mod('nav_menu_locations');
	$socialbottom = ''; $immersion_redirect = '';
	if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';
	
	if (is_archive()) { $cat_id = get_query_var('cat'); } else { $cat_id = ''; }

	if (is_home() && get_theme_mod('storybar-home') == "Top Edge") sno_get_teaserbar( $home='home' );

	if (get_theme_mod('altheader-top') == "Menu A") {
		echo '<div id="topbarborder" class="topbarborder">';
		echo '<div class="navbarwrap">';
			echo '<div class="navbarcontainer">';
			echo '<div id="navbar">';
				echo '<div id="navbarbackground">';

					$topnavmini = ' style="display:none"';
					if (get_theme_mod('topnav-mini-logo') == 'Always Display') { $topnavmini = ''; }
					if (get_theme_mod('mini-logo')) { 
						echo "<ul id='show-mini-logo-top' $topnavmini >";
							echo '<a href="/'.$immersion_redirect.'"><li id="mini-logo-top" style="float:left;"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" />
							</li></a>
						</ul>';			
					}

					echo '<div id="menu-a-menu">';
					
					if ($nav_menu['header-menu'] == '') {
						wp_nav_menu( array('menu' => 'Top Menu', 'menu_class' => 'sf-menu alt-a') );
					} else { 
						wp_nav_menu( array('theme_location' => 'header-menu', 'menu_class' => 'sf-menu alt-a') );
					}
					echo '</div>';

							echo "<ul id='menu-more-a' class='sf-menu sf-js-enabled sf-shadow' style='display:none'>";
								echo '<li id="menu-more-item-a" style="float:left;"><a href="/" class="sf-with-ul">More<span class="sf-sub-indicator"> »</span></a>
								<ul id="add-more-a" class="sub-menu"></ul>
								</li>
							</ul>';			


				echo '</div>';
			echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="clear"></div>';

				?><script type="text/javascript">
					$(document).ready(function() {
						resizeMenuA();
					})
					$(window).load(function() {
						resizeMenuA();
					})
					
					function resizeMenuA() {
						var moreWidthTop = 0; var menubufferTop = 0; var minilogoTop = 0;
						if ($('#menu-more-a').is(':visible')) { moreWidthTop = $('#menu-more-a').width(); }		
						<?php if (get_theme_mod('topnav-appearance') == 'Blocks') { ?>
							menubufferTop = <?php echo rtrim(get_theme_mod('topnav-margin'), 'px'); ?>;
						<?php } ?>
						<?php if (get_theme_mod('mini-logo')) { ?>
							minilogoTop = $('#mini-logo-top').width();
						<?php } ?>
						if (($('#menu-a-menu').width() + minilogoTop + moreWidthTop + menubufferTop) > ($(window).width() - 2) && ($(window).width() > 980)) 
						{ 
							$('.alt-a > li:last-child').addClass('sub-menu'); 
							$('.alt-a > li:last-child').appendTo('#add-more-a'); 
							if ($('#menu-more-a').is(':hidden')) { $('#menu-more-a').css({display: "block"}); }			
							resizeMenuA(); 
						} 
						 
					}
					
					$(window).scroll(function() {
						resizeMenuA();
					});

            		$( window ).resize(function() { 
             	   		if ($( window).width() > 980) { resizeMenuA(); };
            		});   

			</script><?php


	} else if (get_theme_mod('altheader-top') == "Search & Social Icons") {
		echo '<div id="topbarborder" class="topbarborder">';
			echo '<div class="altheader-top-wrap">';
		
				echo '<div class="altheader-top">';
	
					include(TEMPLATEPATH . "/tools/header-alt-social.php");
	
				echo '</div>';
	
			echo '</div>';
		echo '</div>';
	} else if (get_theme_mod('altheader-top') == "Breaking News Ticker") {
		echo '<div id="topbarborder" class="topbarborder">';
			include(TEMPLATEPATH."/tools/breakingnews.php");
		echo '</div>';
	}
	echo '<div class="clear"></div>';
	
	if (is_home() && get_theme_mod('storybar-home') == "Above Header") sno_get_teaserbar( $home='home' );

	echo '<div id="altheader">'; 
		echo '<div id="altheader-left-main" class="altheader-left hidethis">';
			

				echo '<div class="altheader-menu">';
				
    		    	echo '<div class="alt_mobile_menu_icon">';
       		 			echo '<div class="mobile_menu_icon_bar"></div>';
       		 			echo '<div class="mobile_menu_icon_bar"></div>';
       					echo '<div class="mobile_menu_icon_bar"></div>';
       					echo '<div class="mobile_menu_text">MENU</div>';
       				echo '</div>';
        			        								
				echo '</div>';
				

			echo '<div class="altheader-logo">';
				if ($cat_id && get_theme_mod("cat-header-$cat_id") == 'on' && get_theme_mod("cat-$cat_id-header") != '') {
					echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<img src="' . get_theme_mod("cat-$cat_id-header") . '" alt="' . get_bloginfo('description') . '" />';
					echo '</a>'; 
				} else if (get_theme_mod('header-image-small') && get_theme_mod('header_blog_title') == 'Image') { 					
					echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<img src="' . get_theme_mod('header-image-small') . '" alt="' . get_bloginfo('description') . '" />';
					echo '</a>';
				} else if (get_theme_mod('header-image-medium') && get_theme_mod('header_blog_title') == 'Image') { 					
					echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<img src="' . get_theme_mod('header-image-medium') . '" alt="' . get_bloginfo('description') . '" />';
					echo '</a>';
				} else if (get_theme_mod('header-image') && get_theme_mod('header_blog_title') == 'Image') { 					
					echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<img src="' . get_theme_mod('header-image') . '" alt="' . get_bloginfo('description') . '" />';
					echo '</a>';
				} else {
					echo '<h1><a href="' . get_option('home') . $immersion_redirect . '">' . get_bloginfo('name') . '</a></h1>';
				}


			echo '</div>';
			

		echo '</div>';
		
		
		echo '<div class="altheader-right">';

			if (get_theme_mod('altheader-right') == '3') {
			
				echo '<div id="altheader-leaderboard-wrap">';

				echo '<div class="altheader-leaderboard">';
		
					if (get_theme_mod('leaderad-type')=="Static Image") { 
	
				 		$leaderurl=get_theme_mod('leader-url'); $leaderimage=get_theme_mod('leader-image'); 
		 				if ($leaderurl) echo '<a target="_blank" href="'.$leaderurl.'">'; 
		 				if ($leaderimage) echo '<img src="'.$leaderimage.'" />'; 
		 				if ($leaderurl) echo '</a>'; 
	
		 			} else if (get_theme_mod('leaderad-type')=="Ad Tag") { 		
	
				 		echo get_theme_mod('openx-code'); 
	
	 				} else if (get_theme_mod('leaderad-type')=="SNO Ad Rotate") { 
	 			
						$ad_args = array(
							'is_widget'		=> 0,
							'group_ids'		=> array( '0' => get_option('sno_ar_leaderboard_main') ),
							'num_ads'		=> 1,
							'num_columns'	=> 1
						);
		
						if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );
	 
	 				}
	 			echo '</div>';
				
				echo '<div class="altheader-leaderboard-small">';
	 				if (get_theme_mod('leaderad-type-right')=="Static Image") { 
	
			 			$leaderurlright=get_theme_mod('leader-url-right'); $leaderimageright=get_theme_mod('leader-image-right'); 
						 if ($leaderurlright) echo '<a target="_blank" href="'.$leaderurlright.'">'; 
						 if ($leaderimageright) echo '<img src="'.$leaderimageright.'" />'; 
						 if ($leaderurlright) echo '</a>'; 
	
			 		} else if (get_theme_mod('leaderad-type-right')=="Ad Tag") { 		
	
				 		echo get_theme_mod('openx-code-right'); 

	 				} else if (get_theme_mod('leaderad-type-right')=="SNO Ad Rotate") { 
	 			
						$ad_args = array(
							'is_widget'		=> 0,
							'group_ids'		=> array( '0' => get_option('sno_ar_leaderboard_small') ),
							'num_ads'		=> 1,
							'num_columns'	=> 1
						);
						if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );

	 				} 
				echo '</div>';
				
				echo '</div>';
							
			} else {

				echo '<div class="altheader-bar1">';

					if (get_theme_mod('altheader-right') == '2') {
				
						if (get_theme_mod('altheader-top') != "Breaking News Ticker") include(TEMPLATEPATH . "/tools/breakingnews.php");
				
					} else if (get_theme_mod('altheader-right') == '1') {
						
							if (get_theme_mod('altheader-top') != "Search & Social Icons") {
								echo '<div class="altheader-right-social">';
									include(TEMPLATEPATH . "/tools/header-alt-social.php");
								echo '</div>';
							}
			
					}

				echo '</div>';

				echo '<div class="altheader-bar2">';
			
					if (get_theme_mod('altheader-right-bottom') == '1') {
				
						include(TEMPLATEPATH . "/tools/header-alt-menu.php");
				
					} else if (get_theme_mod('altheader-right-bottom') == '2') {
				
						if (get_theme_mod('altheader-top') != "Breaking News Ticker" && get_theme_mod('altheader-right') != '2') include(TEMPLATEPATH . "/tools/breakingnews.php");
			
					} else if (get_theme_mod('altheader-right-bottom') == '3') {
						
						if (get_theme_mod('altheader-top') != "Search & Social Icons" && get_theme_mod('altheader-right') != '1') {
							echo '<div class="altheader-right-social">';
								 include(TEMPLATEPATH . "/tools/header-alt-social.php");
							echo '</div>';
							$socialbottom = '1';
						}
					}
			
				echo '</div>';

				}
						
		echo '</div>';

	echo '</div>';
	
	if (is_home() && get_theme_mod('storybar-home') == "Below Header") sno_get_teaserbar( $home='home' );
	if (is_home() && get_theme_mod('storybar-home') == "Below Nav Bars") sno_get_teaserbar( $home='home' );

	echo '<div id="fullwrap" style="position:relative;">';
	if (get_theme_mod('extra-column') == 'Display') echo '<div id="outerbackgroundwrap">';

		echo '<div id="altheader-searchbox">';
			
				echo '<ul class="slidemenu mobile-menu">';

					echo '<div class="altheader-left menu-altheader">';
			
					//	if (get_theme_mod('altheader-left') != 'Display') {

							echo '<div class="altheader-menu">';
		
					//			if (get_theme_mod('altheader-left') == 'Display') {
		
    					    		echo '<div class="alt_mobile_menu_icon">';
      			 			 			echo '<div class="mobile_menu_icon_bar"></div>';
      			 			 			echo '<div class="mobile_menu_icon_bar"></div>';
       				 					echo '<div class="mobile_menu_icon_bar"></div>';
        								echo '<div class="mobile_menu_text">MENU</div>';
        							echo '</div>';
        			
        			//			}
        								
							echo '</div>';
				
					//	}

						echo '<div class="altheader-logo altheader-logo-menu">';

							if (get_theme_mod('header-image-small') && get_theme_mod('header_blog_title') == 'Image') { 
								echo '<a href="' . get_option('home') . '">';
									echo '<img src="' . get_theme_mod('header-image-small') . '" alt="' . get_bloginfo('description') . '" />';
								echo '</a>';
							} else if (get_theme_mod('header-image-medium') && get_theme_mod('header_blog_title') == 'Image') { 					
								echo '<a href="' . get_option('home') . '">';
									echo '<img src="' . get_theme_mod('header-image-medium') . '" alt="' . get_bloginfo('description') . '" />';
								echo '</a>';
							} else if (get_theme_mod('header-image') && get_theme_mod('header_blog_title') == 'Image') { 					
								echo '<a href="' . get_option('home') . '">';
									echo '<img src="' . get_theme_mod('header-image') . '" alt="' . get_bloginfo('description') . '" />';
								echo '</a>';
							} else {
								echo '<h1><a href="' . get_option('home') . '">' . get_bloginfo('name') . '</a></h1>';
							}


						echo '</div>';
				

					echo '</div>';
		



					echo '<div class="clear"></div>';
						echo '<div class="border-spacer"></div>';
						echo '<li class="mobile-search">';


								?><form method="get" id="searchform-alt3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label for="s-alt3" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
									<input type="text" class="field" name="s" id="s-alt3" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
									<input type="submit" class="submit" name="submit" id="searchsubmit-alt3" style="display:none;" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
								</form><?php

						echo '</li>';
					echo '<div class="clear"></div>';

					$nav_menu = get_theme_mod('nav_menu_locations');

					if ($nav_menu['mobile-menu'] == '') {
						$menu_name = 'header-menu-2';
					} else { 
						$menu_name = 'mobile-menu';
					}
					
					wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'mobile-menu' ) );	
    				
				echo '</ul>';
			
			
			
			
		echo '</div>';
			?><script type="text/javascript">
    			$(".alt_mobile_menu_icon").click(function(){
				    $("#altheader-searchbox").toggle('slow');
				    $("body").toggleClass('noscroll');
						var $leftcolumn = $('.innerbackground');
							var homeLeft = $leftcolumn.offset().left;
					$("#footer").animate({ marginLeft: homeLeft + "px"}); 
					
				});  
				
								if ($('.slidemenu').is(":visible")) {
									$('.hidethis').css({ visibility: "hidden" });
									$('#altheader-searchbox').css({ zIndex: "1001"});
								} else {
									$('.hidethis').css({ visibility: "visible" });
									$('#altheader-searchbox').css({ zIndex: "99"});
								}


    		</script><?php 


			?><script type="text/javascript">
			<?php $detect = new SNO_Mobile_Detect; ?>
			<?php if (get_theme_mod('altheader-stick') == 'Half' && !$detect->isMobile() && !$detect->isTablet() ) { ?>
				$(function(){
  					$('.altheader-logo').data('size','big');
				});
				
				var menuTopPadding = $('.alt_mobile_menu_icon').css( "padding-top" );
				<?php $menupadding = 4; $aibt = get_theme_mod('altheader-icons-border-thickness'); if ($aibt != '0px' && ($socialbottom == 1)) {
					$aibt = rtrim($aibt,'px');$menupadding = $aibt + 4;
				} ?>
				var logoHeight = $('.altheader-logo img').height();
				var logoWidth = $('.altheader-logo img').width();

				$(window).scroll(function(){
				
					// get distance of top of header
					
					var headerTop = $('#altheader').position().top;

					<?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('altheader-top') == 'Menu A') { ?>
	
						headerTop -= $('#altheader').position().top;

					<?php } ?>

					var headerHeightFull = $('#altheader').height();
					var headerHeightHalf = $('.altheader-bar2').height();
					var headerHeightTop = $('.altheader-bar1').height();
					
  					if($(document).scrollTop() > headerTop)
					{
   						if($('.altheader-logo').data('size') == 'big')
    					{
        					$('.altheader-logo').data('size','small');
        					$('.altheader-logo img').stop().animate({
            					<?php if (get_theme_mod('altheader-logo-force') == 'Yes' && get_theme_mod('altheader-left') == 'Display') { ?>
									width: '125px',
            						height: headerHeightHalf + 'px',
								<?php } else if (get_theme_mod('altheader-logo-force') == 'Yes') { ?>
									width: '162px',
            						height: headerHeightHalf + 'px',
								<?php } else { ?>
            						height: headerHeightHalf + 'px',
								<?php } ?>
            					<?php if (get_theme_mod('altheader-logo-force') == 'Yes' && get_theme_mod('altheader-left') == 'Display') { ?>
									marginLeft: '62px',
								<?php } else if (get_theme_mod('altheader-logo-force') == 'Yes') { ?>
									marginLeft: '81px',
								<?php } ?>
        					},600);
        					$('.altheader-left').stop().animate({
            					height: headerHeightHalf + 'px',
            					marginTop: headerHeightTop + 'px'
        					},600);
        					$('.alt_mobile_menu_icon').stop().animate({
            					paddingTop: <?php echo $menupadding; ?> + 'px'
        					},600);
        					$('.mobile_menu_text').stop().animate({
            					height:'0px'
        					},600);
        					$('#altheader-searchbox').stop().css({
            					top:'-40px'
        					},600);
        					$('.altheader-logo h1').stop().css({
            					marginTop:'4px'
        					},600);
        					$('#altheader-searchbox').stop().css({ "zIndex": 100 });
        					
        					

    					}
					}
					else
  					{
    					if($('.altheader-logo').data('size') == 'small')
      					{
       						$('.altheader-logo').data('size','big');
        					$('.altheader-logo img').stop().animate({
            					<?php if (get_theme_mod('altheader-logo-force') == 'Yes' && get_theme_mod('altheader-left') == 'Display') { ?>
									width: '250px',
            						height: headerHeightFull + 'px',
								<?php } else if (get_theme_mod('altheader-logo-force') == 'Yes') { ?>
									width: '325px',
            						height: headerHeightFull + 'px',
            					<?php } else { ?>
            						height: logoHeight + 'px',
            					<?php } ?>
            					<?php if (get_theme_mod('altheader-logo-force') == 'Yes' && get_theme_mod('altheader-left') == 'Display') { ?>
									marginLeft: '0px',
								<?php } else if (get_theme_mod('altheader-logo-force') == 'Yes') { ?>
									marginLeft: '0px',
								<?php } ?>
        					},600);
        					$('.altheader-left').stop().animate({
            					height: headerHeightFull + 'px',
            					marginTop:'0px'
        					},600);
        					$('.alt_mobile_menu_icon').stop().animate({
            					paddingTop: menuTopPadding,
        					},600);
        					$('.mobile_menu_text').stop().animate({
            					height:'14px'
        					},600);
        					$('#altheader-searchbox').stop().css({
            					top:'0px'
        					},600);
        					$('.altheader-logo h1').stop().css({
            					marginTop:'20px'
        					},600);
        					//$('#altheader-searchbox').css({ "zIndex": 50 });
      					}  
  					}
				});            	
				<?php if (!$detect->isMobile()) { ?>
					$(document).ready(function() {

						var wpadminbar = $('#wpadminbar').outerHeight();
						if (wpadminbar == null) { var wpadminbar = 0; }
						wpadminbar -= $('.altheader-bar1').height();

						<?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('altheader-top') == 'Menu A') { ?>
							var wpadminbar = $('#wpadminbar').outerHeight();
							if (wpadminbar == null) { var wpadminbar = 0; }
							wpadminbar = wpadminbar +$('#altheader').position().top - $('.altheader-bar1').height();
												
						<?php } ?>

						<?php if (get_theme_mod('altheader-top') == 'Off') { ?>
							<?php $topborder = rtrim(get_theme_mod('topedge-thickness'),'px'); ?>
										
							wpadminbar -= <?php echo $topborder; ?>;
										
						<?php } ?>

						$('#altheader').scrollToFixed({
							marginTop: wpadminbar,
							zIndex:500,
	           			});
          			});
          		
          		<?php } ?>
          		
			<?php } ?>
			
			</script><?php	
	echo '<div class="innerbackgroundwrap">';

	if ((is_home() && get_theme_mod('extra-column') == 'Display' && is_active_sidebar(10)) || sno_display_extra_column() == 'True' ) {
		echo '<div id="extracolumn" style="display:none">';
			echo '<div class="extracolumn-padding">';
			
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar(10) ) : else : endif;
			echo '</div>';
		echo '</div>';


				?><script type="text/javascript">
					$(document).ready(function() {
						var $leftcolumn = $('.innerbackground');
							var homeLeft = $leftcolumn.offset().left;
						$("#extracolumn").width(homeLeft - 15);    				
						$("#extracolumn").show();
					});
					$(window).load(function() {
						var $leftcolumn = $('.innerbackground');
							var homeLeft = $leftcolumn.offset().left;
						if ($(window).width() > 1210) {
							$("#altheader-searchbox").width(homeLeft - 15);
						}
						var footerDistance = $('#footer').offset().top;

						<?php $footerborder = get_theme_mod('main-thickness'); if ($footerborder != '0px') { 
							$footeradjust = rtrim ($footerborder, 'px'); ?> 
							footerDistance -= <?php echo $footeradjust; ?>;
						<?php } ?>

						var $ec = $('#extracolumn');  
							var bottomEC = $ec.position().top + $ec.outerHeight(true);
						footerDistance = footerDistance.toFixed(0);
						var scrollLimit = footerDistance - bottomEC + 15;
						var windowHeight = window.innerHeight;
						var MenuScrollLimit = footerDistance - windowHeight;
						var headerHeight = 0;

						<?php if (get_theme_mod('altheader-stick') == 'Activate') { ?>
	
							headerHeight += $('#altheader').outerHeight();

						<?php } ?>
						<?php if (get_theme_mod('altheader-stick') == 'Half') { ?>
						
							headerHeight += $('#altheader').outerHeight();
							headerHeight -= $('.altheader-bar1').outerHeight();

						<?php } ?>

						<?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('altheader-top') == 'Menu A') { ?>
	
							headerHeight += $('.navbarwrap').outerHeight();

						<?php } ?>

						<?php if (is_admin_bar_showing()) { ?>
	
							if ($('#wpadminbar').is(":visible")) {
								headerHeight += $('#wpadminbar').outerHeight();
							}
						<?php } ?>
						<?php if (get_theme_mod('extra-column-stick') == 'Yes') { ?>
							$('#extracolumn').scrollToFixed({
								top: 0,
								limit: scrollLimit,
								marginTop: headerHeight,
								zIndex:50,
								removeOffsets: true,
								unfixed: function() { $('#extracolumn').width($leftcolumn.offset().left - 15); },
								spacerClass: 'scrollspacer'
	            			});
						<?php } ?>
						});
					
					$(document).ready(function() {
						<?php if (get_theme_mod('altheader-top') != 'Off') { ?>
						
							var topMenu = $('#topbarborder').outerHeight();
							$('.slidemenu').css({ marginTop: topMenu });
							
						<?php } else { ?>
						
							var topMenu = $('#altheader-left-main').position().top;
							$('.slidemenu').css({ marginTop: topMenu });

						<?php } ?>
						<?php if (get_theme_mod('altheader-stick') != "Activate" && get_theme_mod('altheader-stick') != "Half") { ?>
							$(window).scroll(function () {
								if ($(this).scrollTop() > 0 && $('.slidemenu').is(":visible")) {
									$('.hidethis').css({ visibility: "hidden" });
								} else {
									$('.hidethis').css({ visibility: "visible" });
								}
							});
						<?php } ?>
						
						<?php if (get_theme_mod('altheader-stick') == "Activate" || get_theme_mod('altheader-stick') == "Half") { ?>
							
							
    						$(".alt_mobile_menu_icon").click(function(){
								var windowTop		= $(window).scrollTop();
    							var elementOffset 	= $('#altheader-left-main').offset().top;
    							var distance      	= (elementOffset - windowTop);

								<?php if (is_admin_bar_showing()) { ?>
									if ($('#wpadminbar').is(":visible")) {
										distance -= $('#wpadminbar').outerHeight();
									}
								<?php } ?>
								
								$('.slidemenu').css({marginTop: distance });
					
							});  
				
							var originalHeaderDistance = $('#altheader-left-main').offset().top;
								<?php if (is_admin_bar_showing()) { ?>
									if ($('#wpadminbar').is(":visible")) {
										originalHeaderDistance -= $('#wpadminbar').outerHeight();
									}
								<?php } ?>


							var scrollDistance = $('#altheader-left-main').position().top - $(this).scrollTop();
							if (scrollDistance < 0) scrollDistance = 0;
							$('.slidemenu').css({ marginTop: scrollDistance });

							$(window).scroll(function () {
								if ($(this).scrollTop() >= 0 && $('.slidemenu').is(":visible")) {
									
									var scrollDistance = $('#altheader-left-main').position().top;
															
									scrollDistance -= $(this).scrollTop();


									<?php if (get_theme_mod('altheader-top') == 'Off') { ?>
										<?php $topborder = rtrim(get_theme_mod('topedge-thickness'),'px'); ?>
										
										scrollDistance = <?php echo $topborder; ?>;
																			
									<?php } ?>

									if (scrollDistance < 0) scrollDistance = 0;

									<?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('altheader-top') == 'Menu A') { ?>

										scrollDistance = originalHeaderDistance;
										
										
									<?php } ?>

									$('.slidemenu').css({ marginTop: scrollDistance })
								} 
							});
								
							if ($(window).scrollTop() == 0 && $('.slidemenu').is(":visible")) {
								var scrollAdjust = $('#altheader-left-main').position().top;
								$('.slidemenu').css({ marginTop: scrollAdjust })
							} 


						<?php } ?>
						
					});		

					$(document).ready(function() {
		
							$(window).resize(function(){
								var homeLeft = $('.innerbackground').offset().left;
								$("#extracolumn").width(homeLeft - 15); 
								if ($(this).width() > 1210) {
									$("#altheader-searchbox").width(homeLeft - 15); 
								} else if ($(this).width() < 980) {
									$('#altheader-searchbox').css({ paddingTop: 2 });

									$("#altheader-searchbox").width(325);
								}		
							});
					})

    	        function resizeHeight() {
                	var heights = window.innerHeight;
     				var header = $("#altheader").height();
     				var heightoffset = heights - header;
                //	document.getElementById("extracolumn").style.height = heightoffset -45 + "px";
                	document.getElementById("altheader-searchbox").style.height = heights + "px";
            	}
            	$(function() {
            		resizeHeight();
            		window.onresize = function() {
                		resizeHeight();
            		};
            	})   
            	
			
  	 			</script><?php
 
    }	
    
	echo '<div class="innerbackground">';
	
	if (get_theme_mod('altheader-right') == '3') {
		echo '<div class="mobile-leaderboard" style="display:none;">';
					if (get_theme_mod('leaderad-type')=="Static Image") { 
	
				 		$leaderurl=get_theme_mod('leader-url'); $leaderimage=get_theme_mod('leader-image'); 
		 				if ($leaderurl) echo '<a target="_blank" href="'.$leaderurl.'">'; 
		 				if ($leaderimage) echo '<img src="'.$leaderimage.'" />'; 
		 				if ($leaderurl) echo '</a>'; 
	
		 			} else if (get_theme_mod('leaderad-type')=="Ad Tag") { 		
	
				 		echo get_theme_mod('openx-code'); 
	
	 				} else if (get_theme_mod('leaderad-type')=="SNO Ad Rotate") { 
	 			
						$ad_args = array(
							'is_widget'		=> 0,
							'group_ids'		=> array( '0' => get_option('sno_ar_leaderboard_main') ),
							'num_ads'		=> 1,
							'num_columns'	=> 1
						);
		
						if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );
	 
	 				}
		echo '</div>';
	}
	


?>