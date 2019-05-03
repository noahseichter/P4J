<?php

	echo '<div id="extracolumnwrap" style="position:relative">';
		echo '<div id="extracolumninnerwrap">';
	
		echo '<div id="extracolumn" style="display:none;float:left;">';
			echo '<div class="extracolumn-padding">';
			
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar(10) ) : else : endif;
			echo '</div>';
		echo '</div>';
	
				?><script type="text/javascript">
					$(document).ready(function() {
						var $leftcolumn = $('#wrap');
							var homeLeft = $leftcolumn.offset().left;
						$("#extracolumn").width(homeLeft - 15);    				
						$("#extracolumn").show();
					});
					$(window).load(function() {
						var $leftcolumn = $('#wrap');
							var homeLeft = $leftcolumn.offset().left;
						$("#extracolumn").width(homeLeft - 15);  
						
						var footerDistance = $('#footer').offset().top + $('#footer').outerHeight();
						
						var $ec = $('#extracolumn');  
							var bottomEC = $ec.outerHeight(true);
						footerDistance = footerDistance.toFixed(0);
						var scrollLimit = footerDistance - bottomEC + 30;
						
						
						var windowHeight = window.innerHeight;
						var headerHeight = 0;
						
						<?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') == 'Top Edge') { ?>
	
							headerHeight += $('.navbarwrap').outerHeight();

						<?php } ?>


						<?php if (is_admin_bar_showing()) { ?>
	
							if ($('#wpadminbar').is(":visible")) {
								headerHeight += $('#wpadminbar').outerHeight();
							}
						<?php } ?>
						<?php if (get_theme_mod('extra-column-stick') == 'Yes' && get_theme_mod('header-alt') != 'Display') { ?>
							$('#extracolumn').scrollToFixed({
								top: 0,
								limit: scrollLimit,
								marginTop: headerHeight,
								zIndex:5,
								removeOffsets: true,
								unfixed: function() { $('#extracolumn').width($leftcolumn.offset().left - 15); },
								spacerClass: 'scrollspacer'
	            			});
						<?php } ?>
						});
					

					$(document).ready(function() {
		
							$(window).resize(function(){
								var homeLeft = $('#wrap').offset().left;
								$("#extracolumn").width(homeLeft - 15); 
							});
					})

            	
			
  	 			</script><?php
	