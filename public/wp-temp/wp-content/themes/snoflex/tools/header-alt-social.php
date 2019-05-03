<?php			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				if ( is_plugin_active( 'menu-icons/menu-icons.php' ) ) {
				
        			echo '<div class="alt-header-social-bar">';
        				if (get_theme_mod('rss-icon') != "Hide") {
        					echo '<a target="_blank" href="' . get_bloginfo('rss_url') . '"><div class="alt-header-social social-border sno-rss dashicons dashicons-rss"></div>';
        				}
        				
						if (get_theme_mod('email-rss') == "Show") {
							$feedoption = get_theme_mod('feedburner'); 
							$options = get_option('sno_analytics_options'); $feedadmin = $options['sno_site_feedburner_code'];
							if ($feedoption) { $feedburner = $feedoption; } else if ($feedadmin) { $feedburner = $feedadmin; }
							if (isset($feedburner)&&$feedburner) { ?>
        					<a onclick="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" href="#"><div class="alt-header-social social-border sno-email dashicons dashicons-email-alt"></div></a>
							<?php }
						}
						
        				$reddit = get_theme_mod('reddit'); if ($reddit) { 
        					echo '<a target="_blank" href="' . $reddit . '">
        						<div class="alt-header-social-fa social-border sno-reddit genericon genericon-reddit"></div>
        					</a>';
        				}
        				
        				$flickr = get_theme_mod('flickr'); if ($flickr) { 
	        				echo '<a target="_blank" href="' . $flickr . '">
	        					<div class="alt-header-social-fa social-border sno-flickr fa fa-flickr"></div>
	        				</a>';
	        			}
        				$vimeo = get_theme_mod('vimeo'); if ($vimeo) { 
        					echo '<a target="_blank" href="' . $vimeo . '">
        						<div class="alt-header-social-fa social-border sno-vimeo fa fa-vimeo"></div>
        					</a>';
        				}

        				$youtube = get_theme_mod('youtube'); if ($youtube) { 
        					echo '<a target="_blank" href="' . $youtube . '">
        						<div class="alt-header-social-fa social-border sno-youtube fa fa-youtube"></div>
        					</a>';
        				}

        				$snapchat = get_theme_mod('snapchat'); if ($snapchat) { 
        					echo '<a target="_blank" href="https://www.snapchat.com/add/' . $snapchat . '">
        						<div class="alt-header-social-fa social-border sno-snapchat fa fa-snapchat-ghost"></div>
        					</a>';
        				}

        				$schooltube = get_theme_mod('schooltube'); if ($schooltube) { 
        					echo '<a target="_blank" href="' . $schooltube . '">
        						<div class="alt-header-social-fa social-border sno-schooltube dashicons dashicons-format-video"></div>
        					</a>';
        				}
        				
        				$googleplus = get_theme_mod('googleplus'); if ($googleplus) { 
	        				echo '<a target="_blank" href="' . $googleplus . '">
	        					<div class="alt-header-social-fa social-border sno-google-plus fa fa-google-plus"></div>
	        				</a>';
    					}
    					
        				$soundcloud = get_theme_mod('soundcloud'); if ($soundcloud) {
        					echo '<a target="_blank" href="' . $soundcloud . '">
        						<div class="alt-header-social-fa social-border sno-soundcloud fa fa-soundcloud"></div>
        					</a>';
        				}
        				
        				$vine = get_theme_mod('vine'); if ($vine) {
	        				echo '<a target="_blank" href="' . $vine . '">
	        					<div class="alt-header-social-fa social-border sno-vine fa fa-vine"></div>
	        				</a>';
    					}
    					
        				$tumblr = get_theme_mod('tumblr'); if ($tumblr) {
        					echo '<a target="_blank" href="' . $tumblr . '">
        						<div class="alt-header-social-fa social-border sno-tumblr fa fa-tumblr"></div>
        					</a>';
        				}
        				
        				$pinterest = get_theme_mod('pinterest'); if ($pinterest) {
        					echo '<a target="_blank" href="' . $pinterest . '">
        						<div class="alt-header-social-fa social-border sno-pinterest fa fa-pinterest"></div>
        					</a>';
        				}

        				$instagram = get_theme_mod('instagram'); if ($instagram) {
        					echo '<a target="_blank" href="' . $instagram . '">
        						<div class="alt-header-social-fa social-border sno-instagram fa fa-instagram"></div>
        					</a>';
        				}
        				
        				$twitter = get_theme_mod('twitter'); if ($twitter) {
        					echo '<a target="_blank" href="' . $twitter . '">
        						<div class="alt-header-social social-border sno-twitter dashicons dashicons-twitter"></div>
        					</a>';
        				}
        				
        				$facebook = get_theme_mod('facebook'); if ($facebook) {
        					echo '<a target="_blank" href="' . $facebook . '">
        						<div class="alt-header-social social-border sno-facebook dashicons dashicons-facebook-alt"></div>
        					</a>';
        				}
        				
        				echo '<div class="alt-header-social-spacer"></div>';

					echo '</div>';
						echo '<div id="sno-search-wrap">';
							?><form method="get" id="searchform-alt2" action="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
					     	echo '<div id="sno-search" class="alt-header-social sno-search fa fa-search"></div>';
					     	echo '<div style="position:relative;line-height:30px;" class="alt-header-social">';
					     			echo '<div id="expandable-search-box">';

											?><label for="s-alt2" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
											<input type="text" class="field" name="s" id="s-alt2" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
											<input type="submit" class="submit" name="submit" id="searchsubmit-alt2" style="display:none" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
											<button type="submit" id="sno-search-button" class="alt-header-social sno-search fa fa-search"></button>
<?php
									echo '</div>';
							echo '</div>';
							echo '<div class="alt-header-search-bar">';
							echo '</div>';
							echo '</form>';
						echo '</div>';
				} 

				?><script type="text/javascript">
					$(window).load(function() {
					
						resizeSearch();

					})
					$(window).resize(function() {
						resizeSearch();
					});

					function resizeSearch() {
						<?php if (get_theme_mod('altheader-top') == 'Search & Social Icons') { ?>
							var leftEdge = jQuery('.alt-header-search-bar').width();
						<?php } else { ?>
							var leftEdge = jQuery('#altheader-left-main').width();
						<?php } ?>
						var rightEdge = jQuery('.sno-search').offset().left;
						rightEdge = rightEdge.toFixed(0);
						var searchWidth = rightEdge - leftEdge;
						<?php $aibt = get_theme_mod('altheader-icons-border-thickness'); if ($aibt != '0px') { $aibt = rtrim($aibt,'px');?>
						var searchAdjust = <?php echo $aibt; ?>;
						searchWidth = searchWidth - searchAdjust;
						<?php } ?>
						jQuery("#expandable-search-box").width(searchWidth);    				
						 

					}

    				jQuery("input#s-alt").focus(function(){
    					document.getElementById("s-alt2").style.backgroundColor="#ddd";
    					document.getElementById("s-alt2").style.color="#444";
    					document.getElementById("sno-search-button").style.backgroundColor="#ddd";
    					document.getElementById("sno-search-button").style.color="#444";
    					jQuery('#sno-search').hide();
    					if($('#sno-search-button').is(':hidden')) {
    						var searchWidth = jQuery('#expandable-search-box').width();
    						jQuery('.altheader-right #expandable-search-box').width(searchWidth + 40);
    						jQuery('.altheader-top #expandable-search-box').width(searchWidth + 30);
    					}
    					jQuery('#sno-search-button').show();
					});

					jQuery("#sno-search").click(function(){
    					document.getElementById("sno-search-button").style.backgroundColor="#ddd";
    					document.getElementById("sno-search-button").style.color="#444";
    					jQuery('#s-alt2').focus();
					});
					
					if ($('#sno-search').offset().left < 405) { 
						$('#sno-search-wrap').hide();
						$('.altheader-right-social').css({ background: "<?php echo get_theme_mod('altheader-icons-border'); ?>" });
					}
					
    			</script> 