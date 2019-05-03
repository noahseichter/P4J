<?php 
get_header();

echo '<div id="content" class="searchpageresults">';

    echo '<div id="contentleft">';
    
        echo '<div class="postarea searchpage archivepage">';

    $search_query = get_search_query(); 
            
	if (get_option('ssno') == "ssno928462s") { 
        
                
        $sports_results = array_filter(sno_search_sports_results($search_query));
                        
		if (!empty($sports_results)) {
       
			$currentyear = date("Y"); $currentmonth = date("m"); $resetmonth = get_theme_mod('staff-reset');
			if ($resetmonth == '') $resetmonth = '07';

			if ($currentmonth >= $resetmonth) {
				$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
			} else {
				$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
			} 
		
        foreach ($sports_results as $sport): 

			$sport = str_replace('&amp;', '&', $sport);
			$sport = addslashes($sport); 
			
				
        
					
			global $wpdb;
 			$querystr = "
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
				";

 			$pageposts = $wpdb->get_results($querystr, OBJECT);

			if ($pageposts): 

				echo '<div class="sno-animate searchresult-profile" style="background: #fff;">';
					echo "<div class='profile'>$seasoncheck " . stripslashes($sport) . " Schedule</div>";
				
					echo '<table class="schedule">';
    				echo '<thead>';
        			echo '<tr class="schedulehead sportsheading">';
        		    echo '<th class="tableindent">Date</th>';
        		    echo '<th>Opponent</th>';
        		    echo '<th>Location</th>';
        		    echo '<th class="tablecenter">Result</th>';
        		    echo '<th></th>';
        		    echo '<th class="tablecenter">W/L</th>';
        			echo '</tr>';
    				echo '</thead>';
    				echo '<tbody>';

				foreach ($pageposts as $post):
					setup_postdata($post);
					$custom_fields = get_post_custom($post->ID);

					if (isset($custom_fields['sport'])) $sport = $custom_fields['sport'][0];
					if (isset($custom_fields['date'])) $date = $custom_fields['date'][0];
						$date = explode("-",$date); 
						$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
					if (isset($custom_fields['time'])) $time = $custom_fields['time'][0];
					if (isset($custom_fields['opponent'])) $opponent = $custom_fields['opponent'][0];
					if (isset($custom_fields['location'])) $location = $custom_fields['location'][0];
					if (isset($custom_fields['storylink'])) $storylink = $custom_fields['storylink'][0];
					if (isset($custom_fields['ourscore'])) $ourscore = $custom_fields['ourscore'][0];
					if (isset($custom_fields['theirscore'])) $theirscore = $custom_fields['theirscore'][0];
						if ($ourscore=="") { $score = ""; } 
							else if ($theirscore == "") { $score = $ourscore; } 
							else { $score = $ourscore . '-' . $theirscore; }
						if ($ourscore == "") { $result = ""; $rowstyle = ' upcoming'; } 
							else { if ($ourscore==$theirscore) { $result = "T"; } 
								else if (($theirscore=="") && ($ourscore!="")) { $result = ""; } 
								else if ($ourscore > $theirscore) { $result = "W";  } 
								else if ($ourscore < $theirscore) { $result = "L"; }
							}
							
     				echo '<tr class="sportstoprow rosterrow ' . $rowstyle .'">';
            		echo '<td class="tableindent">' . $date;
            			if ($result && $time != '') {} else { echo " ($time)"; }
            			echo '</td>';
					echo '<td class="sportsone">' . $opponent . '</td>';
					echo '<td class="sportsone">' . $location . '</td>';
					echo '<td class="tablecenter">' . $score;
						edit_post_link(' Edit', '', '');
						echo '</td>';
					echo '<td class="sportsone">';
						if ($storylink) echo '  <a href="' . $storylink . '">Read Story</a>';
						echo '</td>';
					echo '<td class="tablecenter">' . $result . '</td>';
					echo '</tr>';
     				echo "<tr class='sportstwo rosterrow $rowstyle'>";
						echo '<td class="tableindent" style="min-width:120px">' . $opponent . '</td>';
						echo '<td class="tablecenter">' . $location . '</td>';
						if ($storylink) {
						echo '<td class="tablecenter">';
							 echo '  <a href="' . $storylink . '">Read Story</a>';
							echo '</td>';
						} else {
							echo '<td></td>';
						}
					echo '</tr>';
		
				endforeach;   

			echo '</tbody>';
			echo '</table>';	
			echo '<div class="clear"></div>';
			echo '</div>';

			else : endif;
			wp_reset_query();

			$sport = addslashes($sport); 

  			// add the sports roster if it exists

			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS roster_jersey ON(
				$wpdb->posts.ID = roster_jersey.post_id
				AND roster_jersey.meta_key = 'roster_jersey'
				)
				JOIN $wpdb->postmeta AS roster_name ON(
				$wpdb->posts.ID = roster_name.post_id
				AND roster_name.meta_key = 'roster_name'
				)
				JOIN $wpdb->postmeta AS roster_sport ON(
				$wpdb->posts.ID = roster_sport.post_id
				AND roster_sport.meta_value = '$sport'
				)
				JOIN $wpdb->postmeta AS roster_season ON(
				$wpdb->posts.ID = roster_season.post_id
				AND roster_season.meta_value = '$seasoncheck'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY CAST(roster_jersey.meta_value AS UNSIGNED INTEGER ) ASC,
				roster_name.meta_value ASC
				";

 			$pageposts = $wpdb->get_results($querystr, OBJECT);
			$count = 0;

			if ($pageposts):
			
				echo '<div class="sno-animate searchresult-profile" style="background: #fff;">';
					echo "<div class='profile'>$seasoncheck " . stripslashes($sport) . " Roster</div>";
				
			echo '<table class="schedule">';
    		echo '<thead>';
        	echo '<tr class="schedulehead sportsheading">';
            echo '<th class="tablecenter">Number</th>';
            echo '<th>Name</th>';
            echo '<th class="tablecenter">Position</th>';
            echo '<th class="tablecenter">Grade</th>';
        	echo '</tr>';
    		echo '</thead>';
    		echo '<tbody>';
			
				foreach ($pageposts as $post):
				
					global $post; setup_postdata($post); 
					$custom_fields = get_post_custom($post->ID);

					if (isset($custom_fields['roster_name'])) $roster_name = $custom_fields['roster_name'][0];
					if (isset($custom_fields['roster_link'])) $roster_link = $custom_fields['roster_link'][0];
					if (isset($custom_fields['roster_jersey'])) $roster_jersey = $custom_fields['roster_jersey'][0];
					if (isset($custom_fields['roster_grade'])) $roster_grade = $custom_fields['roster_grade'][0];
					if (isset($custom_fields['roster_position'])) $roster_position = $custom_fields['roster_position'][0];

     			echo '<tr class="rosterrow">';
            	echo '<td class="tablecenter">' . $roster_jersey . '</td>';
				echo '<td>';
					if ( term_exists( $roster_name, 'post_tag' ) ) {
						$ketag = "";
						$ketag[] = get_term_by( 'name', $roster_name, 'post_tag', ARRAY_A ); 
						foreach($ketag[0] as $key => $value) { 
							if ($key == "term_id") $tagID = $value; 
						}
						echo ' <a href="' . get_tag_link($tagID) . '">' . $roster_name . '</a>';
					} else {
						echo $roster_name;
					}
					if ($roster_link) {
						echo ' <a href="' . $roster_link . '">(Profile)</a>';
					} 
					edit_post_link(' Edit', '', '');
					echo '</td>';
				echo '<td class="tablecenter">' . $roster_position . '</td>';
				echo '<td class="tablecenter">' . $roster_grade . '</td>';
				echo '</tr>';
				

				endforeach; 

				echo '</tbody>';
				echo '</table>';	
				echo '</div>';


			else : endif;
			wp_reset_query();

  			endforeach;
        
        	}
        }
                
            if (have_posts()) : while (have_posts()) : the_post(); 
                        

				$custom_fields = get_post_custom($post->ID);
					$sno_teaser = ''; $imageid = ''; $audio = ''; $video = ''; $profile_name = ''; $schoolyear = ''; $breakingnewsheadline = ''; $sport = ''; $customlink = ''; 
					if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['audio'])) $audio = $custom_fields['audio'][0];
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_teaser'])) $sno_teaser = $custom_fields['sno_teaser'][0];
					if (isset($custom_fields['name'])) $profile_name = $custom_fields['name'][0];
					if (isset($custom_fields['schoolyear'])) $schoolyear = $custom_fields['schoolyear'][0];
					if (isset($custom_fields['breakingnewsheadline'])) $breakingnewsheadline = $custom_fields['breakingnewsheadline'][0];
					if (isset($custom_fields['sport'])) $breakingnewsheadline = $custom_fields['sport'][0];
					if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
					if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
					
			if ($breakingnewsheadline || $sport) {

			} else if ($profile_name) {
				$pagelink = sno_staff_profile_link();
				$realname = $profile_name;
				$content = '';
				$profile_name = str_replace( "'", "''", $profile_name );
				
				echo '<div class="sno-animate searchresult-profile">';
					echo '<div class="profile">Staff Profile</div>';
	                if (has_post_thumbnail()) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
						echo '<a href="' . $pagelink . '?writer=' . $realname . '"><img src="' . $image[0] . '" class="categoryimage" alt="' . get_the_title() . '" /></a>'; 
					}		
					echo '<br /><br />';
					echo '<h2 class="searchheadline"><a href="' . $pagelink . '?writer=' . $realname . '">' . get_the_title() . '</a></h2>'; 
					$schoolyear = unserialize($schoolyear);	$staffyears = '';		
					foreach ($schoolyear as $year) {
						if ($staffyears) $staffyears .= ', ';
						$staffyears .= $year;
					} 
					echo $staffyears; 
					edit_post_link('(Edit)', ' &bull; ', ''); 
					
					the_content_limit(300, "Read more &raquo;");

					echo '<div class="clear"></div>';
					
					
				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS credit ON( $wpdb->posts.ID = credit.post_id AND credit.meta_value = '$profile_name' AND credit.meta_key != 'name' AND credit.meta_key != 'roster_name')
						WHERE ($wpdb->posts.post_status = 'publish'
						OR $wpdb->posts.post_status = 'inherit')
						AND ($wpdb->posts.post_type = 'post'
						OR $wpdb->posts.post_type = 'attachment')
						ORDER BY post_date DESC
						";
		 	$pageposts = $wpdb->get_results($querystr, OBJECT);
		
				if ($pageposts): 
					
			
					foreach ($pageposts as $profilepost):
						setup_postdata($profilepost);
						$lfstoryid = ''; $lfcheck = '';
						$gridstoryid = ''; $gridcheck = '';
								
						if (get_post_field('post_type', $profilepost->ID) == "attachment") {
			
							$storyid = get_post_field('post_parent', $profilepost->ID); 
	
							if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
								$lfstoryid = get_post_meta($storyid, 'sno_longform_list', true);
							}				

							if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
								$gridstoryid = get_post_meta($storyid, 'sno_grid_list', true);
							}				
							
						} else {
			
							$storyid = $profilepost->ID; 

							if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
								$lfcheck = get_post_meta($profilepost->ID, 'sno_longform_list', true);
								if ($lfcheck != '') $lfstoryid = $lfcheck; 
								
							}				

							if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
								$gridcheck = get_post_meta($profilepost->ID, 'sno_grid_list', true);
								if ($gridcheck != '') $gridstoryid = $gridcheck; 
								
							}				

						}
						
						if ($lfstoryid) {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$lfstoryid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($profilepost->ID, 'photographer', true) == $realname) {
								$content[$lfstoryid]['photographer'] = get_post_meta($profilepost->ID, 'photographer', true);
							}
							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$lfstoryid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$lfstoryid]['id'] = $lfstoryid;
								$content[$lfstoryid]['date'] = get_the_time( 'Y-m-d', $lfstoryid );
								
						} else if ($gridstoryid) {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$gridstoryid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($profilepost->ID, 'photographer', true) == $realname) {
								$content[$gridstoryid]['photographer'] = get_post_meta($profilepost->ID, 'photographer', true);
							}
							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$gridstoryid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$gridstoryid]['id'] = $gridstoryid;
								$content[$gridstoryid]['date'] = get_the_time( 'Y-m-d', $gridstoryid );

						} else {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$storyid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($profilepost->ID, 'photographer', true) == $realname) {
								$content[$storyid]['photographer'] = get_post_meta($profilepost->ID, 'photographer', true);
							}
							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$storyid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$storyid]['id'] = $storyid;
								$content[$storyid]['date'] = get_the_time('Y-m-d', $storyid);
						}
						
						
						endforeach; 
		
					else : endif; 

					echo '<table class="schedule"><tbody>';
						
						$i = 0; $profilecount = 0;
						foreach ($content as $story) {
    						if($i > 7) break;
    							$open = 'off'; $type = ''; $profilecount++;
								if ( isset ($story['writer']) && is_array($story['writer'])) {
									foreach ($story['writer'] as $writer) {
										if (trim(strtolower($writer)) == strtolower($realname)) { $type = 'Story'; $open = 'on'; }
									}
								}
								if ( isset ( $story['photographer'] ) && trim(strtolower($story['photographer'])) == strtolower($realname)) {
									if ($open == 'on') $type .= '/'; 
									$type .= 'Photo'; $open = 'on'; $photoduplicate = 'on';
								}
								if ( isset ($story['videographer']) && is_array($story['videographer'])) { 
									foreach ($story['videographer'] as $videographer) {
										if (trim(strtolower($videographer)) == strtolower($realname)) { 
											if ($open == 'on') $type .= '/';
											$type .= 'Video'; $open = 'on'; 
										}
									}
								}
								$date = explode("-",$story['date']); 
								if (isset ($date[1])) $date = date("M d, Y",mktime(0,0,0,$date[1],$date[2],$date[0]));
							
							$status = get_post_status($story['id']);
							if ($status == 'publish') {
								$i++;
								echo '<tr class="staffstoryrow">'; 
									echo '<td class="tableindent staffdate">' . $date . '</td><td> ';
									echo '<div class="staffprofilelist"><a href="' . get_permalink($story['id']) . '">' . get_the_title($story['id']) . '</a> (' . $type . ')</div>';
									echo '</td>';
								echo '</tr>';
							
							}
						}
						
						if ($i > 7) {
								echo '<tr class="staffstoryrow">'; 
									echo '<td class="tableindent staffdate" colspan="2">';
									echo "<div class='staffprofilelist'><a href='$pagelink?writer=$realname'>View More by $realname</a></div>";
									echo '</td>';
								echo '</tr>';
						}
						
						?><script type="text/javascript">
							$(document).ready(function() {
								$('tr.staffstoryrow').click(function() {
       				 			var href = $(this).find("a").attr("href");
        						if(href) {
            						window.location = href;
        							}
   								});
							});
						</script><?php

					echo '</tbody></table>';

// end list of stories in staff profile

					echo '<div class="clear"></div>';
					
				echo '</div>';
			
			} else {
				echo '<div class="searchresult sno-animate">';
				echo '<h2 class="searchheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 

                if (has_post_thumbnail()) {
									$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
									echo '<a href="' . $storylink . '"><img src="' . $image[0] . '" class="categoryimage" alt="' . get_the_title() . '" /></a>'; 
				}					
				
				if (isset($video) && $video) { 
						$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						echo '<div class="archivevideowrap"><div class="embedcontainer">' . $video . '</div></div>';
				} 
			
				echo '<p>';
					$byline = snowriter(); if ($byline) echo $byline . '<br />';
					echo get_sno_timestamp(); 
					edit_post_link('(Edit)', ' &bull; ', ''); 
               		if (function_exists('the_views')) { 
               			echo ' &bull; '; 
               			the_views(); 
               		} 
					echo '<br />Filed under ';
					the_category(', '); 
				echo '</p>'; 

		        if ($sno_teaser) { 
		           	echo '<p>' . $sno_teaser . '</p>'; 
				} else {
					the_content_limit(300, "");
				}
				
				echo '<div class="clear"></div>'; 

				if ((isset($audioplayer) && $audioplayer == "") && ($audio)) { 
					$audioplayer = "[audio src=" . $audio . "]";
					echo '<div class="audiobox">';
					echo do_shortcode($audioplayer); 
					echo '</div>';
				}

				echo '<div class="postmeta2">';
					the_tags('<p><span class="tags">Tags: ', ', ', '</span></p>'); 
				echo '</div>';
				echo '</div>';
			}
			
			endwhile; else: echo '<p>Sorry, no stories matched your criteria.</p>'; endif; 
			
			echo '<p>';
				if(function_exists('wp_paginate')) { wp_paginate(); } else { posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));}
			echo '</p>';
			
		echo '</div>';
				
	echo '</div>';
	
include(TEMPLATEPATH."/sidebar.php");
		
echo '<div class="clear"></div>';
echo '</div>';

get_footer(); 
?>