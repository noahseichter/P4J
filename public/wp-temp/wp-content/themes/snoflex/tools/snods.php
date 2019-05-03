<?php

add_action('widgets_init', create_function('', "register_widget('sno_ds');"));
class sno_ds extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno-ds',
			'description' => __( 'Displays SNO Distinguished Sites Badges' )
			);

		$control_ops = array(
			'id_base' => 'snods'
			);

		parent::__construct( 'snods', __( '(SNO) Distinguished Sites Badges' ), $widget_ops, $control_ops ) ;

	}


	function widget($args, $instance) {
		extract($args); $widget = $this->id; 

			$audience_engagement = get_option('audience_engagement_status');
			$continuous_coverage = get_option('continuous_coverage_status');
			$multimedia = get_option('multimedia_status');
			$site_excellence = get_option('site_excellence_status');
			$story_page_excellence = get_option('story_page_excellence_status');
			
		//	echo $continuous_coverage . ' test';
					
			$transient = get_transient( 'snods_widget_bestofsno' );			  
			if( empty( $transient ) ) {
				global $wpdb; $bos_table = $wpdb->prefix . "bestofsno";	
				$best_of_sno = count( $wpdb->get_results( "SELECT id FROM $bos_table WHERE status = 'accepted'")) >= 3 ? "accepted" : "in progress" ;
				update_option('best_of_sno_status', $best_of_sno);
				set_transient( 'snods_widget_bestofsno', '1', HOUR_IN_SECONDS );
			}
			$best_of_sno = get_option('best_of_sno_status');
			if (	$audience_engagement == 'accepted' && 
					$continuous_coverage == 'accepted' && 
					$multimedia == 'accepted' && 
					$site_excellence == 'accepted' && 
					$story_page_excellence == 'accepted' && 
					$best_of_sno == 'accepted' ) 
			{ $sno_ds = "on"; } else { $sno_ds = "off"; }
				

			
			$options = get_option('sno_analytics_options');
			if (	$audience_engagement == 'accepted' || 
					$continuous_coverage == 'accepted' || 
					$multimedia == 'accepted' || 
					$site_excellence == 'accepted' || 
					$story_page_excellence == 'accepted' || 
					$best_of_sno == 'accepted' )
			{
		
				$widget = $this->id; $sidebartest = get_option('sidebars_widgets'); 
				$columns = get_theme_mod('sno-layout'); $widget_size = '';
				
				$widget_area_info = sno_get_widget_width($widget);				
				
				if ($widget_area_info[0] == "Full-Width" || $widget_area_info[0] == "Main Column") {
					$widget_size = "Wide";
				} else if ($widget_area_info[0] == "Narrow" && $widget_area_info[1] < 250) {
					$widget_size = "Narrow";
				} else {
					$widget_size = "Normal";
				}
					

				$icon_style = '';$image_style = '';
				if ($widget_size == "Wide" && $instance['widget-badges'] == "SNO DS Banner Only") {
					$image_style = "height: 129px; margin: 0 auto;";
				} else if ($widget_size == "Wide") {
					$icon_style = "width:16.665%;float:left;border:none;padding:none;";
					$image_style = "height: 129px;";
				} else if ($widget_size == "Narrow") {
					$icon_style = "width:33.33%;float:left;border:none;padding:none;";
					$image_style = "width:99.99%;";
				} else {
					$icon_style = "width:16.67%;float:left;border:none;padding:none;";
					$image_style = "width:100%;";
				}
				
				$wide_css = '';
				
				if ($instance['widget-badges'] == "SNO DS Banner Only" && $widget_size == "Wide") {
					$wide_css = ' style="float:unset;"';	
				} 

				if ($sno_ds == 'on') {
					if ($widget_size == "Wide") {
						echo "<div class='snods_winner_circle_wide'$wide_css><a target='_blank' href='http://customers.snosites.com/recognition-program/'><img class='snods_winner' src='/wp-content/themes/snoflex/images/sno_ds_winner_new.png' style='$image_style display:block;'/></a></div>";
					} else {
						echo "<div class='snods_winner_circle'><a target='_blank' href='http://customers.snosites.com/recognition-program/'><img src='/wp-content/themes/snoflex/images/sno_ds_winner_new.png' style='$image_style'/></a></div>";
					}
				}

				if ($sno_ds != 'on') {
					echo "<div class='snods_header'><a target='_blank' href='http://customers.snosites.com/recognition-program/'>SNO Distinguished Sites Badges</a></div>";
					echo '<div class="snods_badge_top"></div>';
				}
			
			if ($instance['widget-badges'] != "SNO DS Banner Only") { 
				if ($widget_size == "Wide" && $sno_ds == 'on') { echo "<div class='snods_icon_area_wide'>"; } else { echo '<div class="snods_icon_area">'; }
	
				if ($instance['widget-badges'] == 'Icons') {
									
	
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#continuous'><div class='snods_badge_icon_only snods_coverage' style='$icon_style'>";
						if ($continuous_coverage == 'accepted') {
							echo "<i class='snods_icon_only fa fa-refresh'></i>";
						} 
					echo "</div></a>";
								
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#site'><div class='snods_badge_icon_only snods_site' style='$icon_style'>";
						if ($site_excellence == 'accepted') {
							echo "<i class='snods_icon_only dashicons dashicons-awards'></i>";
						}
					echo "</div></a>"; 
					
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#story'><div class='snods_badge_icon_only snods_story' style='$icon_style'>";
						if ($story_page_excellence == 'accepted') {
							echo "<i class='snods_icon_only dashicons dashicons-welcome-widgets-menus'></i>";
						}
					echo "</div></a>"; 
	
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#writing'><div class='snods_badge_icon_only snods_writing' style='$icon_style'>";
						if ($best_of_sno == 'accepted') {
							echo "<i class='snods_icon_only fa fa-trophy'></i>";
						} 
					echo "</div></a>";
	
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#multimedia'><div class='snods_badge_icon_only snods_media' style='$icon_style'>";
						if ($multimedia == 'accepted') {
							echo "<i class='snods_icon_only dashicons dashicons-format-video'></i>";
						} 
					echo "</div></a>";
	
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#engagement'><div class='snods_badge_icon_only snods_audience' style='$icon_style'>";
						if ($audience_engagement == 'accepted') {
							echo "<i class='snods_icon_only dashicons dashicons-dashboard'></i>";
						}
					echo "</div></a>";
					
				} else if ($instance['widget-badges'] == 'Titles and Icons') {
	
					
					if ($continuous_coverage == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#continuous'><div class='snods_badge snods_coverage'>";
							echo '<div class="snods_title"><p>Continuous Coverage</p></div>';
							echo '<div class="snods_icon"><i class="snods_coverage_icon fa fa-refresh"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
					if ($site_excellence == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#site'><div class='snods_badge snods_site'>";
							echo '<div class="snods_title"><p>Site Excellence</p></div>';
							echo '<div class="snods_icon"><i class="snods_site_icon dashicons dashicons-awards"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
					if ($story_page_excellence == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#story'><div class='snods_badge snods_story'>";
							echo '<div class="snods_title"><p>Story Page Excellence</p></div>';
							echo '<div class="snods_icon"><i class="snods_story_icon dashicons dashicons-welcome-widgets-menus"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
					if ($best_of_sno == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#writing'><div class='snods_badge snods_writing'>";
							echo '<div class="snods_title"><p>Excellence in Writing</div>';
							echo '<div class="snods_icon"><i class="snods_writing_icon fa fa-trophy"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
					if ($multimedia == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#multimedia'><div class='snods_badge snods_media'>";
							echo '<div class="snods_title"><p>Multimedia Excellence</div>';
							echo '<div class="snods_icon"><i class="snods_media_icon dashicons dashicons-format-video"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
					if ($audience_engagement == 'accepted') {
						echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#engagement'><div class='snods_badge snods_audience'>";
							echo '<div class="snods_title"><p>Audience Engagement</div>';
							echo '<div class="snods_icon"><i class="snods_audience_icon dashicons dashicons-dashboard"></i></div>';
						echo '<div class="clear"></div></div></a>';
					}
	
				
				}
	
				echo '<div class="clear"></div>';
				echo '</div>';
			}
				
				echo '<div style="margin-bottom:15px;" class="clear"></div>';
		} // end check to see if badges are active
	}

	function update($new_instance, $old_instance) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = 'SNO Distinguished Sites Awards';
		$instance['widget-color-scheme'] = $new_instance['widget-color-scheme'];
		$instance['widget-badges'] = $new_instance['widget-badges'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
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
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

	function form($instance) { 
			$defaults = array( 'title' => 'Email Updates', 'text' => 'Enter your email address below to receive our daily email updates.', 'widget-style' => get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetds = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetds)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}
if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here

?>
<div class="hide_all"<?php echo $hide_all; ?>>

<?php 
			$audience_engagement = get_option('audience_engagement_status');
			$continuous_coverage = get_option('continuous_coverage_status');
			$multimedia = get_option('multimedia_status');
			$site_excellence = get_option('site_excellence_status');
			$story_page_excellence = get_option('story_page_excellence_status');
			$best_of_sno = get_option('best_of_sno_status');

			if (	$audience_engagement == 'accepted' && 
					$continuous_coverage == 'accepted' && 
					$multimedia == 'accepted' && 
					$site_excellence == 'accepted' && 
					$story_page_excellence == 'accepted' && 
					$best_of_sno == 'accepted' ) 
			{ $sno_ds = "on"; } else { $sno_ds = "off"; }


?>	


		<?php if ($sno_ds == 'on') {
			echo '<p>Congratulations! ' . get_bloginfo('name') . ' is a SNO Distinguished Site! This widget will display your badges and Distinguished Site banner.</p>';
		} else { ?>
		<p>This widget will display any badges you've earned in the SNO Distinguished Sites Program for the current school year.</p>
		<p><b>You've earned the following badges:</b></p>
		<ul style="margin-left:30px;">
		<?php 
			if ($site_excellence == "accepted") echo '<li>Site Excellence Badge</li>';
			if ($story_page_excellence == "accepted") echo '<li>Story Page Excellence Badge</li>';
			if ($multimedia == "accepted") echo '<li>Multimedia Excellence Badge</li>';
			if ($continuous_coverage == "accepted") echo '<li>Continuous Coverage Excellence Badge</li>';
			if ($audience_engagement == "accepted") echo '<li>Audience Engagement Badge</li>';
			if ($best_of_sno == "accepted") echo '<li>Excellence in Writing Badge</li>';
		?>
		</ul>
			
		<p><b>Click the links below to submit for more badges.</b></p>
		<ul style="margin-left:30px;">
		<?php 
			if ($site_excellence != "accepted") echo '<li><a target="_blank" href="wp-admin/admin.php?page=ds_story_page_excellence">Site Excellence Badge</a></li>';
			if ($story_page_excellence != "accepted") echo '<li><a target="_blank" href="/wp-admin/admin.php?page=ds_site_excellence">Story Page Excellence Badge</a></li>';
			if ($multimedia != "accepted") echo '<li><a target="_blank" href="/wp-admin/admin.php?page=ds_multimedia">Multimedia Excellence Badge</a></li>';
			if ($continuous_coverage != "accepted") echo '<li><a target="_blank" href="/wp-admin/admin.php?page=ds_continuous_coverage">Continuous Coverage Badge</a></li>';
			if ($audience_engagement != "accepted") echo '<li><a target="_blank" href="/wp-admin/admin.php?page=ds_engagement">Audience Engagement Badge</a></li>';
			if ($best_of_sno != "accepted") echo '<li><a target="_blank" href="/wp-admin/admin.php?page=bos_dashboard">Excellence in Writing Badge</a></li>';
		?>
		</ul>
		<?php } ?>

		<div class="widgetdivider"></div>

			<select id="<?php echo $this->get_field_id( 'widget-badges' ); ?>" name="<?php echo $this->get_field_name( 'widget-badges' ); ?>">
				<option value="Titles and Icons" <?php if ( 'Titles and Icons' == $instance['widget-badges'] ) echo 'selected="selected"'; ?>>Titles and Icons</option>
				<option value="Icons" <?php if ( 'Icons' == $instance['widget-badges'] ) echo 'selected="selected"'; ?>>Icons</option>
				
				<?php if ($sno_ds == "on") { ?>
					<option value="SNO DS Banner Only" <?php if ( 'SNO DS Banner Only' == $instance['widget-badges'] ) echo 'selected="selected"'; ?>>SNO DS Banner Only</option>
				<?php } ?>
			</select> Badge Display<br /><br />

		<div class="widgetdivider"></div>
		
	<?php 
	
	echo '</div>';
	}

}
?>