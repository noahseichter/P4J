<?php
/*
Template Name: Sports Center
*/

get_header(); 

if (get_option('ssno') == "ssno928462s") { 

$pagelink = get_page_link();

echo '<div id="content" class="sportspage">';
	echo '<div id="contentleft">';
		$schoolyear = ''; $o = ''; $archiveseason = '';
		$resetmonth = get_theme_mod('sports-reset');
		if ($resetmonth == '') $resetmonth = '07';

		$currentyear = date("Y"); 
		$currentmonth = date("m");  
		if ($currentmonth >= $resetmonth) {
			$spring = $currentyear + 1; 
			$seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; 
			$seasoncheck = "$fall" . "-" . "$currentyear";
		} 

		$today = date( 'Y-m-d', current_time( 'timestamp', 0 ) );		
		
		$sportpage = '';
		
		$list = sno_sport_list();
		
		if (isset($_GET['sport'])) $sportpage = $_GET['sport']; 
		
		if ( $sportpage != '' && !in_array(stripslashes($sportpage), $list)) $sportpage = '';
				
	//	$sportpage = str_replace('_', ' ', $sportpage);
		if (isset($_GET['schoolyear'])) $schoolyear = sanitize_title($_GET['schoolyear']);			
			
			if (strlen($schoolyear) != 9) { $schoolyear = $seasoncheck; }
		
		if ($schoolyear) {
			if ($schoolyear == $seasoncheck) { $archiveseason = ""; } else { $archiveseason = "true"; }
			$seasoncheck = $schoolyear;
			} else {
			$schoolyear = $seasoncheck;
			}

		if ($sportpage) { // beginning of page that renders for individual sport

			echo '<div id="sportspagewide">';
			
				

		 			$o .= '<div class="sportlist">';
					$o .= '<form name="jump2">';
					$o .= '<select class="sportsselect" name="menu2" onChange="location=document.jump2.menu2.options[document.jump2.menu2.selectedIndex].value;" value="GO">';
					$o .= '<option value="">Select a Different Sport</option>';
						foreach ($list as $sport) {
							$o .= '<option value="'. $pagelink .'?sport=' . rawurlencode($sport) . '">'. $sport .'</option>';	
														
						}
						
    			 	$o .= '</select>';
		    		$o .= '</form>';
		    		$o .= '</div>';

					echo $o;
		

		
			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS season ON(
				$wpdb->posts.ID = season.post_id
				AND season.meta_key = 'season'
				)
				JOIN $wpdb->postmeta AS sport ON(
				$wpdb->posts.ID = sport.post_id
				AND sport.meta_value = '$sportpage'
				)
				JOIN $wpdb->postmeta AS date ON(
				$wpdb->posts.ID = date.post_id
				AND date.meta_key = 'date'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY season.meta_value ASC
			";
			 			
 			$pageposts = $wpdb->get_results($querystr, OBJECT);
 			$sport_title = stripslashes($sportpage);
 			echo '<div class="seasonlist">';
			echo '<form name="jump3">';
			echo '<select name="menu3" onChange="location=document.jump3.menu3.options[document.jump3.menu3.selectedIndex].value;" value="GO">';
			echo '<option value="">Select a Different ' . $sport_title . ' Season</option>';

			$namecheck = "";
			if ($pageposts):

				foreach ($pageposts as $post):
					setup_postdata($post);
					$seasonlist = get_post_meta($post->ID, 'season', true); 
					if ($loopcheck == $seasonlist) {} else { 
                		echo '<option value="' . $pagelink . '?schoolyear=' . $seasonlist . '&sport=' . rawurlencode($sport_title) . '">' . $seasonlist . '</option>';
						$loopcheck = $seasonlist;
					} 
				endforeach;
			else : endif;
     		echo '</select>';
     		echo '</form></div><div class="clear"></div>';
		
		
			echo '<h3>' . $seasoncheck . ' ' . $sport_title . '</h3>';
			
			echo '<table class="schedule">';
    		echo '<thead>';
        	echo '<tr class="schedulehead sportsheading">';
            echo '<th class="tableindent">Date</th>';
           	if ($archiveseason == "") echo '<th></th>';
            echo '<th>Opponent</th>';
            if ($archiveseason == "") echo '<th>Location</th>';
            echo '<th class="tablecenter">Result</th>';
            echo '<th></th>';
            echo '<th class="tablecenter">W/L</th>';
        	echo '</tr>';
    		echo '</thead>';
    		echo '<tbody>';
					

 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS date ON(
				$wpdb->posts.ID = date.post_id
				AND date.meta_key = 'date'
				)
				JOIN $wpdb->postmeta AS sport ON(
				$wpdb->posts.ID = sport.post_id
				AND sport.meta_value = '$sportpage'
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
				foreach ($pageposts as $post):
					setup_postdata($post);
					$sport = ''; $date = ''; $time = ''; $opponent = ''; $location = ''; $storylink = ''; $ourscore = ''; $theirscore = '';

					$custom_fields = get_post_custom($post->ID);

					if (isset($custom_fields['sport'])) $sport = $custom_fields['sport'][0];
					if (isset($custom_fields['date'])) $date = $custom_fields['date'][0];
						$date = explode("-",$date); 
						$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
					if (isset($custom_fields['time'])) $time = $custom_fields['time'][0];
					if (isset($custom_fields['opponent'])) $opponent = substr($custom_fields['opponent'][0], 0, 26);
					if (isset($custom_fields['location'])) $location = substr($custom_fields['location'][0], 0, 20);
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
            		echo '<td class="tableindent">' . $date . '</td>';
					if ($archiveseason == "") { 
						echo '<td>';
						if ($result) {} else { echo $time; }
						echo '</td>';
						}
					echo '<td class="sportsone">' . $opponent . '</td>';
					if ($archiveseason == "") echo '<td class="sportsone">' . $location . '</td>';
					echo '<td class="tablecenter">' . $score;
						edit_post_link(' Edit', '', '');
						echo '</td>';
					echo '<td class="sportsone">';
						if ($storylink) echo '  <a href="' . $storylink . '">Story</a>';
						echo '</td>';
					echo '<td class="tablecenter">' . $result . '</td>';
					echo '</tr>';
					echo '<tr class="sportstwo ' . $rowstyle . '">';
						echo '<td class="tableindent" style="min-width:120px">' . $opponent . '</td>';
						if ($archiveseason == "") echo '<td style="min-width:120px">' . $location . '</td>';
						if ($storylink) {
						echo '<td style="min-width:80px">';
							 echo '  <a href="' . $storylink . '">Story</a>';
							echo '</td>';
						}
					echo '</tr>';
		
				endforeach;   
			else :
			endif;

			echo '</tbody>';
			echo '</table>';	
		
		echo '</div>';
		echo '</div>';
		echo '<div id="sidebar">';

// stories about team

			if ($archiveseason == "") {
			
				$querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS story_sport ON(
					$wpdb->posts.ID = story_sport.post_id
					AND story_sport.meta_key = 'story_sport'
					AND story_sport.meta_value = '$sportpage'
					)
					AND $wpdb->posts.post_status = 'publish'
					ORDER BY post_date DESC LIMIT 5
					";

	 			$pageposts = $wpdb->get_results($querystr, OBJECT);
				$count = 0;

			if ($pageposts):
				foreach ($pageposts as $post):

					$count++;
					if ($count == 1) {
						echo '<div class="clear"></div>';
						echo '<div class="widgetwrap"><div class="titlewrap">';
						echo '<div class="widgettitle">' . $sportpage . ' Stories</div></div>';
						echo '<div class="widgetbody">';
						echo '<ul>';
					}

					echo '<li class="sportslist">';
					echo '<p class="datetime">';
					the_time('F j, Y');
					echo '</p>';
					echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
					echo '</li>';				
					
				endforeach; 
			else : endif;

			if ($count >= 1) {
				echo '</ul>';
				echo '</div>';
				echo '<div class="widgetfooter"></div></div>';
				$count == 0;
			}


			}
			
// team roster

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
				AND roster_sport.meta_value = '$sportpage'
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

 			$roster_links = get_theme_mod('sports-roster-links');
 			$roster_link_target = '';
 			if ($roster_links == "Yes") $roster_link_target = ' target="_blank"';
 			

			if ($pageposts):
				foreach ($pageposts as $post):
				
					global $post; setup_postdata($post); 
					$custom_fields = get_post_custom($post->ID);
					$roster_name = ''; $roster_link = ''; $roster_jersey = ''; $roster_grade = ''; $roster_position = '';

					if (isset($custom_fields['roster_name'])) $roster_name = $custom_fields['roster_name'][0];
					if (isset($custom_fields['roster_link'])) $roster_link = $custom_fields['roster_link'][0];
					if (isset($custom_fields['roster_jersey'])) $roster_jersey = $custom_fields['roster_jersey'][0];
					if (isset($custom_fields['roster_grade'])) $roster_grade = $custom_fields['roster_grade'][0];
					if (isset($custom_fields['roster_position'])) $roster_position = $custom_fields['roster_position'][0];

				$count++;
				if ($count == 1) {

					echo '<div class="clear"></div>';
					echo '<div class="widgetwrap"><div class="titlewrap">';
					echo '<div class="widgettitle">' . $seasoncheck . ' Roster</div></div>';
					echo '<div class="widgetbody">';
				
					echo '<table class="sportssidebar">';
					echo '<thead>';
					echo '<tr class="sidebarhead">';
					echo '<th class="tablecenter">Jersey</th>';
					echo '<th>Name</th>';
					echo '<th class="tablecenter">Position</th>';
					echo '<th class="tablecenter">Grade</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

				}
				
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
						echo " <a href='$roster_link' target='_blank'>test(Profile)</a>";
					} 
					edit_post_link(' Edit', '', '');
					echo '</td>';
				echo '<td class="tablecenter">' . $roster_position . '</td>';
				echo '<td class="tablecenter">' . $roster_grade . '</td>';
				echo '</tr>';
				

				endforeach; 
			else : endif;

			if ($count >= 1) {
				echo '</tbody>';
				echo '</table>';	
				echo '</div>';
				echo '<div class="widgetfooter"></div></div>';
			}


// team conference standings

 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS conferencewins ON(
				$wpdb->posts.ID = conferencewins.post_id
				AND conferencewins.meta_key = 'conferencewins'
				)
				JOIN $wpdb->postmeta AS conferencelosses ON(
				$wpdb->posts.ID = conferencelosses.post_id
				AND conferencelosses.meta_key = 'conferencelosses'
				)
				JOIN $wpdb->postmeta AS sport ON(
				$wpdb->posts.ID = sport.post_id
				AND sport.meta_value = '$sportpage'
				)
				JOIN $wpdb->postmeta AS season ON(
				$wpdb->posts.ID = season.post_id
				AND season.meta_value = '$seasoncheck'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY CAST(conferencewins.meta_value AS UNSIGNED INTEGER ) DESC, 
				CAST(conferencelosses.meta_value AS UNSIGNED INTEGER ) ASC
				";
 
 			$pageposts = $wpdb->get_results($querystr, OBJECT);

			$count = 0; $footerkey = 0; 

			if ($pageposts):
				foreach ($pageposts as $post):
				
					setup_postdata($post); 
					$school = ''; $conferencewins = ''; $conferencelosses = ''; $conferenceties = ''; $totalwins = ''; $totallosses = ''; $totalties = ''; $staterank = '';
					$custom_fields = get_post_custom($post->ID);
						if (isset($custom_fields['conference'])) $conference = $custom_fields['conference'][0];

					if ($conference == "true") { 


						if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
						if (isset($custom_fields['conferencewins'])) $conferencewins = $custom_fields['conferencewins'][0];
						if (isset($custom_fields['conferencelosses'])) $conferencelosses = $custom_fields['conferencelosses'][0];
						if (isset($custom_fields['conference_ties'])) $conferenceties = $custom_fields['conference_ties'][0];
						if (isset($custom_fields['totalwins'])) $totalwins = $custom_fields['totalwins'][0];
						if (isset($custom_fields['totallosses'])) $totallosses = $custom_fields['totallosses'][0];
						if (isset($custom_fields['total_ties'])) $totalties = $custom_fields['total_ties'][0];

						
						$count++; if ($count == 1) {
             				echo '<div class="clear"></div>';
             				echo '<div class="widgetwrap"><div class="titlewrap">';
             				echo '<div class="widgettitle">Conference Standings</div>';
             				echo '</div><div class="widgetbody">';
             				echo '<table class="sportssidebar">';
							echo '<tr class="sidebarhead">';
             				echo '<td width=160 class="tableindent">Team</td>';
             				echo '<td width=70 class="tablecenter">Conference</td>';
             				echo '<td width=70 class="tablecenter">Overall</td>';
             				echo '</tr>';
							$footerkey = 5; 
						}

						echo '<tr class="rosterrow">';
						echo '<td class="tableindent">' . $school;
							edit_post_link(' Edit', '', '');
							echo '</td>';
						echo '<td class="tablecenter">' . $conferencewins . '-' . $conferencelosses;
							if ($conferenceties) echo '-' . $conferenceties;
							echo '</td>';
						echo '<td class="tablecenter">' . $totalwins . '-' . $totallosses;
							if ($totalties) echo '-' . $totalties;
							echo '</td>';
						echo '</tr>';
						
					 }
  
				endforeach; 
			else : endif;

			if ($footerkey == 5) echo '</table></div><div class="widgetfooter"></div></div>';
   
// team playoff standings

 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS totalwins ON(
				$wpdb->posts.ID = totalwins.post_id
				AND totalwins.meta_key = 'totalwins'
				)
				JOIN $wpdb->postmeta AS totallosses ON(
				$wpdb->posts.ID = totallosses.post_id
				AND totallosses.meta_key = 'totallosses'
				)
				JOIN $wpdb->postmeta AS sport ON(
				$wpdb->posts.ID = sport.post_id
				AND sport.meta_value = '$sportpage'
				)
				JOIN $wpdb->postmeta AS season ON(
				$wpdb->posts.ID = season.post_id
				AND season.meta_value = '$seasoncheck'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY CAST(totalwins.meta_value AS UNSIGNED INTEGER ) DESC, 
				CAST(totallosses.meta_value AS UNSIGNED INTEGER ) ASC
				";

			$pageposts = $wpdb->get_results($querystr, OBJECT);

			$count = 0; $footerkey = 0;
			
			if ($pageposts):
				foreach ($pageposts as $post):

					setup_postdata($post);
					$school = ''; $conferencewins = ''; $conferencelosses = ''; $conferenceties = ''; $totalwins = ''; $totallosses = ''; $totalties = ''; $staterank = '';
					
					$custom_fields = get_post_custom($post->ID);
						if (isset($custom_fields['section'])) $section = $custom_fields['section'][0];

					if ($section == "true") {

						if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
						if (isset($custom_fields['totalwins'])) $totalwins = $custom_fields['totalwins'][0];
						if (isset($custom_fields['totallosses'])) $totallosses = $custom_fields['totallosses'][0];
						if (isset($custom_fields['total_ties'])) $totalties = $custom_fields['total_ties'][0];

						$count++; if ($count == 1) {
             				echo '<div class="clear"></div>';
             				echo '<div class="widgetwrap"><div class="titlewrap">';
             				echo '<div class="widgettitle">Playoff Standings</div>';
             				echo '</div><div class="widgetbody">';
             				echo '<table class="sportssidebar">';
             				echo '<tr class="sidebarhead">';
             				echo '<td width=220 class="tableindent">Team</td>';
             				echo '<td width=80 class="tablecenter">Overall</td>';
             				echo '</tr>';
							$footerkey = 5;
						}

						echo '<tr class="rosterrow">';
						echo '<td class="tableindent">' . $school;
							edit_post_link(' Edit', '', '');
							echo '</td>';
						echo '<td class="tablecenter">' . $totalwins . '-' . $totallosses;
							if ($totalties) echo '-' . $totalties;
							echo '</td>';

						echo '</tr>';
					} 
  
				endforeach; 
			else : endif; 

			if ($footerkey == 5) echo '</table></div><div class="widgetfooter"></div></div>';
   
// team state rankings

			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS staterank ON(
				$wpdb->posts.ID = staterank.post_id
				AND staterank.meta_key = 'staterank'
				AND staterank.meta_value != ''
				)
				JOIN $wpdb->postmeta AS sport ON(
				$wpdb->posts.ID = sport.post_id
				AND sport.meta_value = '$sportpage'
				)
				JOIN $wpdb->postmeta AS season ON(
				$wpdb->posts.ID = season.post_id
				AND season.meta_value = '$seasoncheck'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY CAST(staterank.meta_value AS UNSIGNED INTEGER ) ASC
				";
			
			$pageposts = $wpdb->get_results($querystr, OBJECT);

			$count = 0; $footerkey = 0; 
			
			if ($pageposts): 
				foreach ($pageposts as $post):
					
					setup_postdata($post);
					$school = ''; $conferencewins = ''; $conferencelosses = ''; $conferenceties = ''; $totalwins = ''; $totallosses = ''; $totalties = ''; $staterank = '';
					
					$custom_fields = get_post_custom($post->ID);
						if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
						if (isset($custom_fields['staterank'])) $staterank = $custom_fields['staterank'][0];
									 
					$count++; if ($count == 1) { 
	
						echo '<div class="clear"></div>';
						echo '<div class="widgetwrap"><div class="titlewrap">';
						echo '<div class="widgettitle">State Rankings</div>';
						echo '</div><div class="widgetbody">';
						echo '<table class="sportssidebar">';
						echo '<tr class="sidebarhead">';
						echo '<td width=220 class="tableindent">Team</td>';
						echo '<td width=80 class="tablecenter">State Rank</td>';
						echo '</tr>';
						$footerkey = 5;
					}


					echo '<tr class="rosterrow">';
					echo '<td class="tableindent">' . $school;
						edit_post_link(' Edit', '', '');
						echo '</td>';

					echo '<td class="tablecenter">' . $staterank;
					echo '</tr>';

  				endforeach;  
			else : endif;

			if ($footerkey == 5) echo '</table></div><div class="widgetfooter"></div></div>';

		echo '</div>'; // end of sidebar for team page
		
		} else { // start of main sports center page
		
			if ((get_theme_mod('sports-stories-scrollbox') == "Display") && (get_theme_mod('sports-scrollbox-cat') != "-1")) include(TEMPLATEPATH . "/sports-stories-scrollbox.php"); 

			echo '<div class="clear"></div>';
			echo '<div id="sportspagewide">';
			//	print_r( sno_update_default_dates() );

				$list = sno_sport_list(); 

		 			$o .= '<div class="seasonlist">';
					$o .= '<form name="jump3">';
					$o .= '<select class="sportsselect" name="menu3" onChange="location=document.jump3.menu3.options[document.jump3.menu3.selectedIndex].value;" value="GO">';
					$o .= '<option value="">Select a Sport</option>';
						foreach ($list as $sport) {
							
							$o .= '<option value="'. $pagelink .'?sport=' . rawurlencode($sport) . '&schoolyear='. $seasoncheck .'">'. $sport .'</option>';	
														
						}
						
    			 	$o .= '</select>';
		    		$o .= '</form>';
		    		$o .= '</div>';

					echo $o;
					
					




			echo '<h3>Recent Results</h3>';
			echo '<table class="schedule">';
    		echo '<thead>';
        	echo '<tr class="schedulehead sportsheading">';
            echo '<th class="tableindent">Sport</th>';
            echo '<th>Date</th>';
            echo '<th class="sportsone">Opponent</th>';
            echo '<th class="sportsone tablecenter">Result</th>';
            echo '<th class="sportsone"></th>';
            echo '<th class="sportsone tablecenter">W/L</th>';
        	echo '</tr>';
    		echo '</thead>';
			echo '<tbody>';

			$count = 0;
			$maxcount = get_theme_mod('recent-results'); if ($maxcount == "") { $maxcount = 20; }

 				$querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS date ON(
					$wpdb->posts.ID = date.post_id
					AND date.meta_key = 'date'
					)
					JOIN $wpdb->postmeta AS season ON(
					$wpdb->posts.ID = season.post_id
					AND season.meta_value = '$seasoncheck'
					)
					JOIN $wpdb->postmeta AS ourscore ON(
					$wpdb->posts.ID = ourscore.post_id
					AND ourscore.meta_key = 'ourscore'
					AND ourscore.meta_value != ''
					)
					AND $wpdb->posts.post_status = 'publish'
					WHERE date.meta_value <= '$today'
					ORDER BY date.meta_value DESC LIMIT $maxcount
					";

 				$pageposts = $wpdb->get_results($querystr, OBJECT);

				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);
						$sport = ''; $date = ''; $time = ''; $opponent = ''; $location = ''; $storylink = ''; $ourscore = ''; $theirscore = '';
	
						$custom_fields = get_post_custom($post->ID);
							if (isset($custom_fields['sport'])) $sport = $custom_fields['sport'][0];
							if (isset($custom_fields['date'])) $date = $custom_fields['date'][0];
								$date = explode("-",$date); 
								$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
							if (isset($custom_fields['time'])) $time = $custom_fields['time'][0];
							if (isset($custom_fields['opponent'])) $opponent = substr($custom_fields['opponent'][0], 0, 26);
							if (isset($custom_fields['location'])) $location = substr($custom_fields['location'][0], 0, 20);
							if (isset($custom_fields['storylink'])) $storylink = $custom_fields['storylink'][0];
							if (isset($custom_fields['ourscore'])) $ourscore = $custom_fields['ourscore'][0];
							if (isset($custom_fields['theirscore'])) $theirscore = $custom_fields['theirscore'][0];
							if ($ourscore=="") { $score = ""; } 
								else if ($theirscore == "") { $score = $ourscore; } 
								else { $score = $ourscore . '-' . $theirscore; }
							if ($ourscore == "") {$result = "";} 
								else 
								{ if ($ourscore==$theirscore) { $result = "T"; } 
									else if (($theirscore=="") && ($ourscore!="")) { $result = ""; } 
									else if ($ourscore > $theirscore) { $result = "W";  } 
									else if ($ourscore < $theirscore) { $result = "L"; }
								}

     					echo '<tr class="rosterrow sportstoprow">';
        	    		echo '<td class="tableindent""><a href="' . $pagelink . '?sport=' . rawurlencode($sport) .'">' . $sport . '</a></td>';					
        	    		echo '<td class="hiddencell"></td>';
        	    		echo '<td>' . $date . '</td>';
        	    		echo '<td class="hiddencell"></td>';
						echo '<td class="sportsone">' . $opponent . '</td>';
						echo '<td class="tablecenter sportsone">' . $score;
							edit_post_link(' Edit', '', '');
							echo '</td>';
						echo '<td class="sportsone">';
							if ($storylink) echo '  <a href="' . $storylink . '">Story</a>';
							echo '</td>';
						echo '<td class="tablecenter sportsone">' . $result . '</td>';
						echo '</tr>';
						echo '<tr class="sportstwo">';
							echo '<td class="tableindent">' . $opponent . '</td>';
							echo '<td class="tablecenter">' . $score;
								edit_post_link(' Edit', '', '');
								echo '</td>';
							if ($storylink) {
								echo '<td style="min-width:80px">';
								echo '  <a href="' . $storylink . '">Story</a>';
								echo '</td>';
							}
							echo '<td class="tablecenter" style="min-width:50px">' . $result . '</td>';
						echo '</tr>';

					endforeach;  
				else : endif; 
	
				echo '<tr class="schedulehead sportsheading"><td class="tableindent" colspan=7>Click on any sport above to see a full schedule for that sport.</td></tr>';
				echo '</tbody>';
				echo '</table>';	


				if (is_user_logged_in()) {

					echo '<h3>Ready to be Updated -- Only Shows for Logged in Users</h3>';
					echo '<table class="schedule">';
		        	echo '<tr class="schedulehead sportsheading">';
					echo '<th class="tableindent">Sport</th>';
					echo '<th>Date</th>';
					echo '<th>Opponent</th>';
					echo '<th class="tablecenter">Result</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

 					$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS date ON(
						$wpdb->posts.ID = date.post_id
						AND date.meta_key = 'date'
						)
						JOIN $wpdb->postmeta AS opponent ON(
						$wpdb->posts.ID = opponent.post_id
						AND opponent.meta_key = 'opponent'
						)
						JOIN $wpdb->postmeta AS ourscore ON(
						$wpdb->posts.ID = ourscore.post_id
						AND ourscore.meta_key = 'ourscore'
						AND ourscore.meta_value = ''
						)
						AND $wpdb->posts.post_status = 'publish'
						WHERE date.meta_value <= '$today'
						ORDER BY date.meta_value ASC
						";

					$pageposts = $wpdb->get_results($querystr, OBJECT);

					if ($pageposts): 
						foreach ($pageposts as $post):
							
							setup_postdata($post);
							$sport = ''; $date = ''; $opponent = '';
							$custom_fields = get_post_custom($post->ID);
								if (isset($custom_fields['sport'])) $sport = $custom_fields['sport'][0];
								if (isset($custom_fields['date'])) $date = $custom_fields['date'][0]; 
									$date = explode("-",$date); 
									$date = date("D, M d",mktime(0,0,0,(int)$date[1],(int)$date[2],(int)$date[0]))."\n";
								if (isset($custom_fields['opponent'])) $opponent = substr($custom_fields['opponent'][0], 0, 26);

     						echo '<tr class="rosterrow">';
        		    		echo '<td class="tableindent"><a href="' . $pagelink . '?sport=' . rawurlencode($sport) .'">' . $sport . '</a></td>';
        	    			echo '<td>' . $date . '</td>';
							echo '<td>' . $opponent . '</td>';
							echo '<td class="tablecenter">';
								edit_post_link('Add Score', '', '');
								echo '</td>';
							echo '</tr>';

						endforeach; 
					else : endif;

					echo '</tbody>';
					echo '</table>';
				} 

				echo '<h3>Upcoming Games</h3>';
				echo '<table class="schedule">';
				echo '<thead>';
				echo '<tr class="schedulehead sportsheading">';
				echo '<th class="tableindent">Sport</th>';
				echo '<th>Date</th>';
				echo '<th>Time</th>';
				echo '<th>Opponent</th>';
				echo '<th>Location</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';

				$maxcount = get_theme_mod('upcoming-games'); if ($maxcount == "") { $maxcount = 20; }

				$querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS date ON(
					$wpdb->posts.ID = date.post_id
					AND date.meta_key = 'date'
					)
					JOIN $wpdb->postmeta AS opponent ON(
					$wpdb->posts.ID = opponent.post_id
					AND opponent.meta_key = 'opponent'
					)
					AND $wpdb->posts.post_status = 'publish'
					WHERE date.meta_value >= '$today'
					ORDER BY date.meta_value ASC LIMIT $maxcount
					";

				$pageposts = $wpdb->get_results($querystr, OBJECT);

				if ($pageposts): 
					foreach ($pageposts as $post):

						setup_postdata($post);
						$sport = ''; $date = ''; $time = ''; $opponent = ''; $location = ''; 

						$custom_fields = get_post_custom($post->ID);
							if (isset($custom_fields['sport'])) $sport = $custom_fields['sport'][0];
							if (isset($custom_fields['date'])) $date = $custom_fields['date'][0];
								$date = explode("-",$date); 
								$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
							if (isset($custom_fields['time'])) $time = $custom_fields['time'][0];
							if (isset($custom_fields['opponent'])) $opponent = substr($custom_fields['opponent'][0], 0, 26);
							if (isset($custom_fields['location'])) $location = substr($custom_fields['location'][0], 0, 20);

     					echo '<tr class="rosterrow sportstoprow">';
        		    	echo '<td class="tableindent"><a href="' . $pagelink . '?sport=' . rawurlencode($sport) .'">' . $sport . '</a></td>';
        	    		echo '<td>' . $date . '</td>';
        	    		echo '<td>' . $time . '</td>';
						echo '<td class="sportsone">' . $opponent . '</td>';
						echo '<td class="sportsone">' . $location;
							 edit_post_link('(Edit)', '', '');
							 echo '</td>';
						echo '</tr>';
						echo '<tr class="sportstwo">';
							echo '<td class="tableindent">' . $opponent . '</td>';
							echo '<td>' . $location;
								 edit_post_link('(Edit)', '', '');
								 echo '</td>';
						echo '</tr>';

					endforeach;  
				else : endif; 

				echo '<tr class="schedulehead sportsheading"><td class="tableindent" colspan=6>Click on any sport above to see a full schedule for that sport.</td></tr>';
				echo '</tbody>';
				echo '</table>';
				echo '</div>';
				
				echo '</div>';
		

			echo '<div id="sidebar">';
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar(6) ) : else : endif; 
			echo '</div>';

			}
	echo '<div class="clear"></div>';
	echo '</div>';

get_footer();

echo '</div>';

} else { 

echo '<div id="content">';
echo '<div id="contentleft">';
echo '<p>The Sports Center Add-On feature can be added to your site by filling out this <a href="http://www.schoolnewspapersonline.com/add-on-features/addons-upgrades/">order form</a>.</p>';
echo '</div>';
echo '</div>';
get_footer();

} ?>