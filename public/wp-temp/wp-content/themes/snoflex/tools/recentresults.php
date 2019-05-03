<?php

add_action('widgets_init', create_function('', "register_widget('sno_recent_results');"));
class sno_recent_results extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_recent_results',
			'description' => __( 'Add a list of recent results using your Sports Center add-on.' )
			);

		$control_ops = array(
			'id_base' => 'recentresults'
			);

		parent::__construct( 'recentresults', __( '(SNO) Recent Results' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);

				$widget = $this->id; $o = ''; $selectbox = ''; $select_styles = '';
				$random = mt_rand();

				$widget_width = sno_get_widget_width($widget_id);
				
				$sidebartest = get_option('sidebars_widgets'); 
				$columns = get_theme_mod('sno-layout'); 

				$pages = get_pages(array(
    				'meta_key' => '_wp_page_template',
   				 	'meta_value' => 'sportstemplate.php',
    				'showposts' => 1
				));
				foreach($pages as $page) $sportsurl = get_permalink($page->ID);

				if ($sidebartest["sidebar-2"]) foreach ($sidebartest["sidebar-2"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Main Column';
						}
				}


				if ($sidebartest["sidebar-3"]) foreach ($sidebartest["sidebar-3"] as $key => $value ) { 
					if ($widget == $value) {
						if ($columns == "Option 1") {
							$instance['sidebarname'] = 'Narrow';
						} else if ($columns == "Option 4") {
							$instance['sidebarname'] = 'Narrow';						
						}
					}
				}
				if ($sidebartest["sidebar-4"]) foreach ($sidebartest["sidebar-4"] as $key => $value ) { 
					if ($widget == $value) {
						if ($columns == "Option 2") {
							$instance['sidebarname'] = 'Narrow';						
						} else if ($columns == "Option 5") {
							$instance['sidebarname'] = 'Narrow';						
						}
					}
				}
		
			$customcolors=$instance['custom-colors']; $categoryslug = ''; $videotitle = ''; $categoryname = '';
			
				$select_styles = get_widget_title_size($instance['widget-style'], $instance['widget-header-size'], $customcolors);

					if ($instance['sport-selection'] == 'on' && $select_styles != 'Hide') {
						$list = sno_sport_list();
						$instance['title'] .= "<span style='float:right;$select_styles'>";
						$instance['title'] .= "<form name='jump$random'>";
						$instance['title'] .= "<select class='sportsselect' name='menu$random' onChange='location=document.jump$random.menu$random.options[document.jump$random.menu$random.selectedIndex].value;' value='GO'>";
						$instance['title'] .= '<option value="">Select a Sport</option>';
							foreach ($list as $sport) {
								$instance['title'] .= '<option value="'. $sportsurl .'?sport=' . rawurlencode($sport) . '">'. $sport .'</option>';	
							}
						
						$instance['title'] .= '</select>';
						$instance['title'] .= '</form>';
						$instance['title'] .= '</span>';
					}

				$shadow = '';
				if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
					$shadow = "box-shadow: none;";
				} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
					$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
				}
				$widgetwrap_style = " style='$shadow'";

			
			echo "<div class='widgetwrap sno-animate sno-$widget'$widgetwrap_style>";
			echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname); 
			
					if ($instance['sport-selection'] == 'on' && $select_styles == 'Hide') {
						$list = sno_sport_list();
						$sport_dropdown .= "<span style='float:right;margin-bottom:6px;margin-top:-3px;'>";
						$sport_dropdown .= "<form name='jump$random'>";
						$sport_dropdown .= "<select class='sportsselect' name='menu$random' onChange='location=document.jump$random.menu$random.options[document.jump$random.menu$random.selectedIndex].value;' value='GO'>";
						$sport_dropdown .= '<option value="">Select a Sport</option>';
							foreach ($list as $sport) {
								$sport_dropdown .= '<option value="'. $sportsurl .'?sport=' . rawurlencode($sport) . '">'. $sport .'</option>';	
							}
						
						$sport_dropdown .= '</select>';
						$sport_dropdown .= '</form>';
						$sport_dropdown .= '</span>';
						
						echo $sport_dropdown;
					}
			
			
			?>

				<?php $today = date( 'Y-m-d', current_time( 'timestamp', 0 ) ); ?>
				<?php $maxcount = $instance['sports-schedule']; if ($maxcount=="") { $maxcount = 5; } ?>
				<?php $currentyear = date("Y"); 
					$currentmonth = date("m");  

					$resetmonth = get_theme_mod('sports-reset');
					if ($resetmonth == '') $resetmonth = '07';
					
					if ($currentmonth >= $resetmonth) {
						$spring = $currentyear + 1; 
						$seasoncheck = "$currentyear" . "-" . "$spring"; 
					} else {
						$fall = $currentyear - 1; 
						$seasoncheck = "$fall" . "-" . "$currentyear";
					} 
				
				if (isset($instance['show-season']) && $instance['show-season'] == "on") {
	
					$sport = $instance['schedule-sport'];
					$sport = str_replace('&amp;', '&', $sport);
					$sport = addslashes($sport); 
					
					$o .= '<table class="schedule">';
    				$o .= '<thead>';
    		    	$o .= '<tr class="schedulehead sportsheading">';
        		    $o .= '<th class="tableindent">Date</th>';
        		    $o .= '<th>Opponent</th>';
        		    $o .= '<th>Result</th>';
        		    $o .= '<th class="tablecenter"></th>';
        			$o .= '</tr>';
    				$o .= '</thead>';
    				$o .= '<tbody>';
 			
 				global $wpdb; $querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS date ON(
						$wpdb->posts.ID = date.post_id
						AND date.meta_key = 'date'
						)
					JOIN $wpdb->postmeta AS sport ON(
						$wpdb->posts.ID = sport.post_id
						AND sport.meta_value = '$sport'
						)
					JOIN $wpdb->postmeta AS season ON(
						$wpdb->posts.ID = season.post_id
						AND season.meta_value = '$seasoncheck'
						)
					AND $wpdb->posts.post_status = 'publish'
					ORDER BY date.meta_value ASC
					"; $pageposts = $wpdb->get_results($querystr, OBJECT);
					
				if ($pageposts): 
				foreach ($pageposts as $post):
					setup_postdata($post);

					$sport = get_post_meta($post->ID, 'sport', true);
					$date = get_post_meta($post->ID, 'date', true); 
						$date = explode("-",$date); 
						$date = date("M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
					$opponent = substr(get_post_meta($post->ID, 'opponent', true), 0, 40);
					$storylink = get_post_meta($post->ID, 'storylink', true);
					$ourscore = get_post_meta($post->ID, 'ourscore', true); 
					$theirscore = get_post_meta($post->ID, 'theirscore', true);
						if ($ourscore=="") { $score = ""; } 
							else if ($theirscore == "") { $score = $ourscore; } 
							else { $score = $ourscore . '-' . $theirscore; }
						if ($ourscore == "") { $result = ""; $rowstyle = ' upcoming'; } 
							else { if ($ourscore==$theirscore) { $result = "T"; } 
								else if (($theirscore=="") && ($ourscore!="")) { $result = ""; } 
								else if ($ourscore > $theirscore) { $result = "W";  } 
								else if ($ourscore < $theirscore) { $result = "L"; }
							}
							
     				$o .= '<tr class="sportstoprow rosterrow ' . $rowstyle .'">';
            		$o .= '<td class="tableindent">' . $date . '</td>';
					$o .= '<td class="sportsone">' . substr($opponent, 0, 15);
						if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
						$o .= '</td>';
					$o .= '<td>' . $score;
						if ($storylink) $o .= ' <a href="' . $storylink . '">(Story)</a>';
						$o .= '</td>';
					$o .= '<td class="tablecenter">' . $result . '</td>';
					$o .= '</tr>';
		
				endforeach;   
				else :
				endif;

				$o .= '</tbody>';
				$o .= '</table>';
				$o .= '</div>';	
				
				echo $o;
					
					
					
					
				
				} else { ?>
				
				
				
				<table class="schedule" style="width:100%;margin-left:0px;padding-left:0px">
				<tbody style="border-top:1px solid #aaaaaa">
				<?php 
				$sport = $instance['schedule-sport'];
				if (($instance['schedule-sport'] == 'All Sports') || ($instance['schedule-sport'] == '')) {
					
				global $wpdb; $querystr = "
					SELECT * FROM $wpdb->posts 
					JOIN $wpdb->postmeta AS date ON(
						$wpdb->posts.ID = date.post_id 
						AND date.meta_key = 'date'
						)
					JOIN $wpdb->postmeta AS ourscore ON(
						$wpdb->posts.ID = ourscore.post_id
						AND ourscore.meta_key = 'ourscore'
						AND ourscore.meta_value != ''
					)
					AND $wpdb->posts.post_status = 'publish' 
					WHERE date.meta_value <= '$today'			
					ORDER BY date.meta_value DESC LIMIT $maxcount
					"; $pageposts = $wpdb->get_results($querystr, OBJECT);
					
				} else {

				global $wpdb; $querystr = "
					SELECT * FROM $wpdb->posts 
					JOIN $wpdb->postmeta AS date ON(
						$wpdb->posts.ID = date.post_id 
						AND date.meta_key = 'date'
						)
					JOIN $wpdb->postmeta AS sport ON(
						$wpdb->posts.ID = sport.post_id
						AND sport.meta_value = '$sport'
					)
					JOIN $wpdb->postmeta AS ourscore ON(
						$wpdb->posts.ID = ourscore.post_id
						AND ourscore.meta_key = 'ourscore'
						AND ourscore.meta_value != ''
					)
					AND $wpdb->posts.post_status = 'publish' 
					WHERE date.meta_value <= '$today'			
					ORDER BY date.meta_value DESC LIMIT $maxcount
					"; $pageposts = $wpdb->get_results($querystr, OBJECT);
				
				}	
				
				
					?>
					
					<?php global $post; $count=0;?>
 					<?php if ($pageposts): ?>
  					<?php foreach ($pageposts as $post): ?>
    					<?php setup_postdata($post); ?>
						<?php 	$sport=get_post_meta($post->ID, 'sport', true); 
								$teamlevel=get_post_meta($post->ID, 'teamlevel', true); 
								$dateraw=get_post_meta($post->ID, 'date', true); 
								$time=get_post_meta($post->ID, 'time', true); 
									$date = explode("-",$dateraw); 
									$finaldate = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
								$location=get_post_meta($post->ID, 'location', true); 
								$opponent=get_post_meta($post->ID, 'opponent', true);
									$opponent = substr($opponent, 0, 40);
									$location = substr($location, 0, 20);
								$ourscore = get_post_meta($post->ID, 'ourscore', true); 
								$theirscore = get_post_meta($post->ID, 'theirscore', true);
									if ($ourscore=="") { $score = ""; } 
										else if ($theirscore == "") { $score = $ourscore; } 
										else { $score = $ourscore . '-' . $theirscore; }
									if ($ourscore == "") { $result = ""; $rowstyle = ' upcoming'; } 
										else { if ($ourscore==$theirscore) { $result = "T"; } 
											else if (($theirscore=="") && ($ourscore!="")) { $result = ""; } 
											else if ($ourscore > $theirscore) { $result = "W";  } 
											else if ($ourscore < $theirscore) { $result = "L"; }
										}
						
						if ($instance['sidebarname'] == "Narrow") {
						echo "<p style='border-bottom:1px solid #aaaaaa;margin-bottom:5px;'><span style='font-weight:normal'>$finaldate</span><br /><a style='font-weight:normal' href='" . $sportsurl . "?sport=" . rawurlencode($sport) . "'>$sport</a> vs. $opponent<br />$score $result</p>";
					
					
					} else if ($instance['sidebarname'] == "Home Main Column") {
					

	    	 			echo "<tr class='rosterrow' style='border-bottom:1px solid #AAAAAA;background:#ffffff;'>
	 								<td style='text-indent:4px'>$finaldate</td>
	 								<td colspan=3><a href='" . $sportsurl . "?sport=" . rawurlencode($sport) . "'>$sport</a> vs. $opponent</td>
            						<td>$score</td><td>$result</td>
     							</tr>";

					} else { 
					
	    	 			echo "<tr class='rosterrow' style='border-bottom:none;font-weight:normal;background:#ffffff'>
            						<td style='text-indent:4px' colspan=3><a href='" . $sportsurl . "?sport=" . rawurlencode($sport) . "'>$sport</a> vs. $opponent</td>
     							</tr>
     							<tr class='rosterrow' style='border-bottom:1px solid #AAAAAA;background:#ffffff;'>
            						<td style='text-indent:4px'>$finaldate</td><td>$score $result</td>
     							</tr>";

					
					
					} ?>


  					<?php endforeach; ?>  
  					<?php else : ?>
 					<?php endif; ?>

				</tbody>
				</table>   
				
		<div class="widget-expander" style="padding-bottom:<?php echo $instance['widget-expander']; ?>"></div><div class="clear"></div>
			</div>

				<?php } ?> 
			
		<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
		<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
		<?php } ?>
		" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>

</div>
		
  	<?php } 
	function update($new_instance, $old_instance) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['sports-schedule'] = $new_instance['sports-schedule'];
		$instance['schedule-sport'] = $new_instance['schedule-sport'];
 		$instance['show-season'] = ( isset( $new_instance['show-season'] ) ? on : "" );  
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
 		$instance['sport-selection'] = ( isset( $new_instance['sport-selection'] ) ? "on" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

	function form($instance) { 
			$defaults = array( 'title' => 'Recent Results', 'sports-schedule' => '7', 'schedule-sport' => 'All Sports', 'widget-style'=>get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'sport-selection' => 'on', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetresults = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetresults)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;';
		
}
if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
			
		if (isset ($instance['box1']) && $instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if (isset ($instance['box2']) && $instance['box2'] == 'Closed') { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
		} 

			?>

<div class="hide_all"<?php echo $hide_all; ?>>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
		<p>
			<input type="text" id="<?php echo $this->get_field_id('sports-schedule'); ?>" name="<?php echo $this->get_field_name('sports-schedule'); ?>" value="<?php echo $instance['sports-schedule']; ?>" size="2" /> Games to Display
		</p>
        	<p>Which sport? 
        	
		 <?php $list = sno_sport_list(); ?>
			
				<select class="fullseason<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'schedule-sport' ); ?>" name="<?php echo $this->get_field_name( 'schedule-sport' ); ?>">
							<option value="All Sports" <?php if ( 'All Sports' == $instance['schedule-sport'] ) echo 'selected="selected"'; ?>>All Sports</option>
 				<?php	foreach ($list as $sport) {
							?><option value="<?php echo $sport; ?>" <?php if ( $sport == $instance['schedule-sport'] ) echo 'selected="selected"'; ?>><?php echo $sport; ?></option>; 
						<?php } ?>
				</select>
	
        	</p>	
        	
        	<div class="showfullseason<?php echo $random; ?>">
			<br />
			</div>

			<p>
				<input type="checkbox" <?php if ($instance['sport-selection'] == "on") echo 'checked'; ?> id="<?php echo $this->get_field_id( 'sport-selection' ); ?>" name="<?php echo $this->get_field_name( 'sport-selection' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'sport-selection' ); ?>">Show Sport Selection Dropdown</label>			
			</p>
			<br />
			
		<div class="widgetdivider"></div>
		
		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-style' ); ?>" name="<?php echo $this->get_field_name( 'widget-style' ); ?>">
				<option value="Style 1" <?php if ( 'Style 1' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 1</option>
				<option value="Style 2" <?php if ( 'Style 2' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 2</option>
				<option value="Style 3" <?php if ( 'Style 3' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 3</option>
				<option value="Style 4" <?php if ( 'Style 4' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 4</option>
				<option value="Style 5" <?php if ( 'Style 5' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 5</option>
				<option value="Style 6" <?php if ( 'Style 6' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 6</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Widget Style</label>
		</p>

		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-expander' ); ?>" name="<?php echo $this->get_field_name( 'widget-expander' ); ?>">
				<?php for ($i=0; $i<101; $i++) { ?>
					<?php $height = $i . 'px'; ?>
					<option value="<?php echo $height; ?>" <?php if ( $instance['widget-expander'] == $height ) echo 'selected="selected"'; ?>><?php echo $height; ?></option>
				<?php } ?>
			</select> Extend Widget Height
		</p>

		<p>
			<input class="customoptionscheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo 'checked'; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Activate Custom Design</label>			
		</p>





		<div class="customoptions<?php echo $random; ?>">
		<div class="widgetdivider"></div>
			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-gradient' ); ?>" name="<?php echo $this->get_field_name( 'widget-gradient' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Gradient</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Pattern</option>
				<option value="None" <?php if ( 'None' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>None</option>
			</select> Header Overlay<br />
			
			<?php $sno_id_base = $this->id_base; ?>
			<?php $selectid = 'widget-'.$sno_id_base.'-'.$number.'-widget-pattern'; ?>
			<?php $selectname = 'widget-'.$sno_id_base.'['.$number.']'; ?>
			<?php $value = $instance['widget-pattern']; ?>

			<div class="widgetheaderoptions<?php echo $random; ?>">
				<?php sno_widget_pattern_selectbox($selectid, $selectname, $value, 'widget-pattern'); ?> Pattern<br />
			</div>
			<br />
			<div class="widgetdivider"></div>


			<label style="display:block" for="<?php echo $this->get_field_id('header-color'); ?>">Header Color</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-color'); ?>" name="<?php echo $this->get_field_name('header-color'); ?>" value="<?php echo $instance['header-color']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('header-text'); ?>">Header Text</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-text'); ?>" name="<?php echo $this->get_field_name('header-text'); ?>" value="<?php echo $instance['header-text']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('widget-border'); ?>">Widget Border</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-border'); ?>" name="<?php echo $this->get_field_name('widget-border'); ?>" value="<?php echo $instance['widget-border']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('widget-background'); ?>">Widget Background</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-background'); ?>" name="<?php echo $this->get_field_name('widget-background'); ?>" value="<?php echo $instance['widget-background']; ?>" />

			
			<br /><br />
			
			<div class="widgetdivider"></div>

			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-header-size' ); ?>" name="<?php echo $this->get_field_name( 'widget-header-size' ); ?>">
				<option value="Small" <?php if ( 'Small' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Small</option>
				<option value="Medium" <?php if ( 'Medium' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Medium</option>
				<option value="Large" <?php if ( 'Large' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Large</option>
			</select> Header Text Size<br />
			
		<p class="style6options<?php echo $random; ?>">
			<input type="checkbox" <?php if ($instance['center-title'] == "on") echo checked; ?> id="<?php echo $this->get_field_id( 'center-title' ); ?>" name="<?php echo $this->get_field_name( 'center-title' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'center-title' ); ?>">Center Title</label>			
		</p>

			<br />
			

			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.my-color-picker').wpColorPicker();
			});
			jQuery('.my-color-picker').wpColorPicker();
			</script>
			
			<div class="widgetdivider"></div>

			<select id="<?php echo $this->get_field_id( 'border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Widget Border</label>

			<br />
			
		<div class="style2options<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'border-thickness2' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness2' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness2'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Header Bottom Border</label>
			
			<br />
		</div>
		<br />
		<div class="widgetdivider"></div>
		<div class="style2options<?php echo $random; ?>">

			

			<select id="<?php echo $this->get_field_id( 'widget-padding' ); ?>" name="<?php echo $this->get_field_name( 'widget-padding' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Body Padding
			
			<br />

		</div>
		<div class="style26options<?php echo $random; ?>">

			<select id="<?php echo $this->get_field_id( 'widget-indent' ); ?>" name="<?php echo $this->get_field_name( 'widget-indent' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Title Indent<br />

			<br />
		</div>

	</div>

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>
			 
	<?php if ($disable_js == '') { ?>
	
	<script type="text/javascript">
			jQuery('.checkbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.dividinglines<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.checkbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".dividinglines<?php echo $random; ?>").show();
			} else {
				jQuery(".dividinglines<?php echo $random; ?>").hide();
			}


    		jQuery(".displaystyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".displayoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".displaystyle<?php echo $random; ?>").val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").show() : jQuery(".displayoptions<?php echo $random; ?>").hide();
    		});

    		jQuery(".fullseason<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() != "All Sports") ? jQuery(".showfullseason<?php echo $random; ?>").slideDown('slow') : jQuery(".showfullseason<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".fullseason<?php echo $random; ?>").val() != "All Sports") ? jQuery(".showfullseason<?php echo $random; ?>").show() : jQuery(".showfullseason<?php echo $random; ?>").hide();


    		jQuery(".widgetstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").slideDown('slow') : jQuery(".style2options<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").slideUp('slow') : jQuery(".style6options<?php echo $random; ?>").slideDown('slow');
        		(jQuery(this).val() == "Style 2" || jQuery(this).val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").slideDown('slow') : jQuery(".style26options<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").show() : jQuery(".style2options<?php echo $random; ?>").hide();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").hide() : jQuery(".style6options<?php echo $random; ?>").show();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2" || jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").show() : jQuery(".style26options<?php echo $random; ?>").hide();

			jQuery('.customoptionscheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.customoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.customoptionscheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".customoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".customoptions<?php echo $random; ?>").hide();
			}

			jQuery('.threecolumncheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.threecolumn<?php echo $random; ?>').slideToggle('slow');
   		 		jQuery('.threecolumnhide<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumn<?php echo $random; ?>").hide();
			} else {
				jQuery(".threecolumn<?php echo $random; ?>").show();
			}

    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumnhide<?php echo $random; ?>").show();
			} else {
				jQuery(".threecolumnhide<?php echo $random; ?>").hide();
			}
			
			
			jQuery('.teaserselect<?php echo $random; ?>').change(function() {
   		 		jQuery('.teaseroptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.teaserselect<?php echo $random; ?>').prop('checked')) {
				jQuery(".teaseroptions<?php echo $random; ?>").show();
			} else {
				jQuery(".teaseroptions<?php echo $random; ?>").hide();
			}


			jQuery('.viewallcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewall<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewallcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewall<?php echo $random; ?>").show();
			} else {
				jQuery(".viewall<?php echo $random; ?>").hide();
			}
			
			jQuery('.viewalllinkcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewalllink<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewalllinkcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewalllink<?php echo $random; ?>").show();
			} else {
				jQuery(".viewalllink<?php echo $random; ?>").hide();
			}


    		jQuery(".widgetheader<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".widgetheaderoptions<?php echo $random; ?>").slideUp('slow');
    		});
 			(jQuery(".widgetheader<?php echo $random; ?>").val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").show() : jQuery(".widgetheaderoptions<?php echo $random; ?>").hide();


	</script>
	
	<?php } ?>
	</div>


		
	<?php 
	}

}
?>