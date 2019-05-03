<?php

function sno_json_api_prepare_post( $post_response, $post, $context) {

/*	if (has_post_thumbnail($post['ID'])) {
		$post_response['do_api_action']['default']['above_content'] .= 'Has Photo';
	}
*/

/*	$slideshow = get_post_meta( $post['ID'], 'featureimage', true);
	
	if ($slideshow == 'Slideshow of All Attached Images') {
	
					$args = array(
						'orderby'        => 'menu_order',
						'order'			 => 'ASC',
						'post_type'      => 'attachment',
						'post_parent'    => $post['ID'],
						'post_status'    => null,
						'post_mime_type' => 'image',
						'numberposts'    => -1
						);
	
					$attachments = get_posts($args);					
					
  					if ($attachments) {
						  	if (count($attachments)>1) {
						  		$gallery_started = '';
						  		$gallery = '[gallery ids="';
	    							foreach ($attachments as $attachment) {
	    								if ($gallery_started == 1) $gallery .= ',';
	    								$gallery .= $attachment->ID;
	    								$gallery_started = 1;
	    							}
	    						$gallery .= '"]';
	    						
	    						$render_gallery = do_shortcode($gallery);

							//	$post_response['do_api_action']['default']['below_content'] .= $render_gallery;
	    					}
	    			}
		
	}
*/
	$imageid = '';
	$custom_fields = get_post_custom($post['ID']);
	
	if ($custom_fields['_wp_page_template'][0] == 'snostaff.php') {
	
		$staff_page_content = sno_mobile_staff_content($post);

		$post_response['do_api_action']['pagesite']['above_content'] .= $staff_page_content;
		
		$mobilestyles = "<style>a, a:hover { text-decoration:none !important; } .post-title {display:none;}</style>";
		$post_response['do_api_action']['pagesite']['below_content'] .= $mobilestyles;

	} else if ($custom_fields['name'][0] != '') {
	
		$profile_name = $custom_fields['name'][0];
	
		$post_response['do_api_action']['default']['above_content'] .= '<h4>' . $profile_name . '</h4>';
		
		$staff_profile_stories = sno_mobile_profile_stories($post, $profile_name);

		$post_response['do_api_action']['default']['below_content'] .= $staff_profile_stories;

		$mobilestyles = "<style>a, a:hover { text-decoration:none !important; } .post-title {display:none;} h4 {text-align:center;}</style>";
		$post_response['do_api_action']['default']['below_content'] .= $mobilestyles;
	
	} else {

	
	$deck = $custom_fields['sno_deck'][0];
	$imagelocation = $custom_fields['featureimage'][0];
	
	if ($deck) {
		$deck = '<div style="padding: 10px 10px 20px;font-style:italic;text-align:center;font-size:1.4em;line-height: auto;">' . $deck . '</div>';
		$post_response['do_api_action']['default']['below_title'] .= $deck;
		
	}

	$post_response['do_api_action']['default']['above_content'] .= '<div style="padding: 0px 0px 20px;font-style:italic">';


	if (has_post_thumbnail($post['ID']) && $imagelocation != 'Do Not Display') {
		$imageid = $custom_fields['_thumbnail_id'][0]; 
		$photographer = get_post_meta($imageid, 'photographer', true);
	   	$caption = get_post_field(post_excerpt, $imageid);

		if ($caption) $post_response['do_api_action']['default']['above_content'] .= $caption;
		if ($photographer) {
			$photocredit = ' (Photo by ' . $photographer . ')';
			$post_response['do_api_action']['default']['above_content'] .= $photocredit;
		}

	}
	
	if ($imagelocation == 'Do Not Display') {
		
		$hideimage = "<style>.post-featured { display: none !important; }</style>";
		$post_response['do_api_action']['default']['below_content'] .= $hideimage;
	}

	$post_response['do_api_action']['default']['above_content'] .= '</div>';


	$post_response['do_api_action']['default']['above_content'] .= '<div style="padding: 10px 0px;font-weight:bold">';

	$writer = snomobile_writer($post);
	
	if ($writer) {
		$byline = $writer . '<br />';
		$post_response['do_api_action']['default']['above_content'] .= $byline;
	}
	
	$date = get_the_time('F j, Y', $post['ID']);
	
	if ($date) {
		$date = $date;
		$post_response['do_api_action']['default']['above_content'] .= $date;
	}
	
	$post_response['do_api_action']['default']['above_content'] .= '</div>';

	$video = $custom_fields['video'][0];
	
	if ($video) {
		$video_insert = '<div style="margin: 10px 10px 3px;">' . $video . '</div>';
		$post_response['do_api_action']['default']['above_content'] .= $video_insert;
		$videographer = snomobile_videographer($post);
		if ($videographer) {
			$videographer = '<div style="padding: 3px 10px 10px;text-align:right;font-weight:bold">Video Credit: ' . $videographer . '</div>';
			$post_response['do_api_action']['default']['above_content'] .= $videographer;
		}		
	}
	
	$story_format = $custom_fields['sno_format'][0];
	
	if ($story_format == "Long-Form") {
	
		$long_form_setup = snomobile_longform($post, $custom_fields);

		$post_response['do_api_action']['default']['below_content'] .= $long_form_setup;
	
	}

	if ($story_format == "Grid") {
	
		$grid_setup = snomobile_grid($post, $custom_fields);

		$post_response['do_api_action']['default']['below_content'] .= $grid_setup;
	
	}

	if ($story_format == "Side by Side") {
	
		$sidebyside_setup = snomobile_sidebyside($post, $custom_fields);

		$post_response['do_api_action']['default']['below_content'] .= $sidebyside_setup;
	
	}
	
	$color = get_theme_mod('app-text-color'); 
	$mobilestyles = "<style>p.pullquotetext { font-size: 20px !important;line-height: 30px !important;text-indent: 55px;padding-top: 15px !important; color: #000; } .pullquote, .storysidebar {border-top: 10px solid $color; background: #eee; padding: 10px;margin: 10px 0px 20px; color: #000;} .largequote { font-size:125px;line-height:100px;text-shadow: #aaa 2px 3px 3px;position: absolute;color: $color } .related { display: none; } table.schedule, table.sportssidebar { width: 100%; }</style>";
	$post_response['do_api_action']['default']['below_content'] .= $mobilestyles;


	}
	
	return $post_response;

}
add_filter( 'json_prepare_post', 'sno_json_api_prepare_post', 10, 3 );

function snomobile_grid($post, $custom_fields) {
				$longform = $post['ID'];
				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS sno_format ON(
						$wpdb->posts.ID = sno_format.post_id
						AND sno_format.meta_key = 'sno_format'
						AND sno_format.meta_value = 'Grid Chapter'
						)
						JOIN $wpdb->postmeta AS sno_grid_list ON(
						$wpdb->posts.ID = sno_grid_list.post_id
						AND sno_grid_list.meta_value = '$longform'
						)
						JOIN $wpdb->postmeta AS sno_grid_order ON(
						$wpdb->posts.ID = sno_grid_order.post_id
						AND sno_grid_order.meta_key = 'sno_grid_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						OR $wpdb->posts.post_status = 'draft'
						OR $wpdb->posts.post_status = 'pending'
						OR $wpdb->posts.post_status = 'future'
						ORDER BY CAST(sno_grid_order.meta_value AS UNSIGNED INTEGER ) ASC
						";


 					$pageposts = $wpdb->get_results($querystr, OBJECT);

					foreach ($pageposts as $chapter_post) {
						setup_postdata($chapter_post);
						$chapter_custom_fields = get_post_custom($chapter_post->ID);
							$video = $chapter_custom_fields['video'][0];
							$videographer = $chapter_custom_fields['videographer'][0];
							$deck = $chapter_custom_fields['sno_deck'][0];
							$imageid = get_post_thumbnail_id($chapter_post->ID); 

						$title = get_the_title($chapter_post->ID);
						if ($title != 'None') {
	            			$results .= '<h3>' . $title . '</h3>';
						}

						if ($deck) {
							$results .= '<div class="storydeck">';
							$results .= '<p>' . $deck . '</p>';
							$results .= '</div>';
						}

						if (has_post_thumbnail($chapter_post->ID)) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);

							$fullimage = wp_get_attachment_image_src( $imageid, 'large'); 
							$results .= '<img src="' . $fullimage[0] . '" style="width:100%;margin-top:15px;" alt="' . get_the_title() . '" />'; 
							if ($caption) $results .= $caption;
							if ($photographer) $results .= ' (Photo by ' . $photographer . ')';
							
							$results .= '<div style="margin-bottom:20px;"></div>';

						}
						
						if ($video) {
						
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video);
						
							$results .= '<div class="photowrap">';
							$results .= '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							$results .= '</div>';
						
						}

						$results .= sno_get_the_content_with_formatting($chapter_post->ID);
						
						$results .= '<div style="margin-bottom:20px;"></div>';

						
					}
					
				return $results;

}

function snomobile_sidebyside($post, $custom_fields) {
				
				$container = $post['ID'];
				global $wpdb;

				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS sno_format ON(
						$wpdb->posts.ID = sno_format.post_id
						AND sno_format.meta_key = 'sno_format'
						AND sno_format.meta_value = 'Side by Side Chapter'
						)
						JOIN $wpdb->postmeta AS sno_sidebyside_list ON(
						$wpdb->posts.ID = sno_sidebyside_list.post_id
						AND sno_sidebyside_list.meta_value = '$container'
						)
						JOIN $wpdb->postmeta AS sno_sidebyside_order ON(
						$wpdb->posts.ID = sno_sidebyside_order.post_id
						AND sno_sidebyside_order.meta_key = 'sno_sidebyside_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						ORDER BY sno_sidebyside_order.meta_value ASC LIMIT 2
						";


 				$pageposts = $wpdb->get_results($querystr, OBJECT);

					foreach ($pageposts as $chapter_post) {
						setup_postdata($chapter_post);
						$chapter_custom_fields = get_post_custom($chapter_post->ID);
							$video = $chapter_custom_fields['video'][0];
							$videographer = $chapter_custom_fields['videographer'][0];
							$deck = $chapter_custom_fields['sno_deck'][0];
							$imageid = get_post_thumbnail_id($chapter_post->ID); 

						$title = get_the_title($chapter_post->ID);
						if ($title != 'None') {
	            			$results .= '<h3>' . $title . '</h3>';
						}

						if ($deck) {
							$results .= '<div class="storydeck">';
							$results .= '<p>' . $deck . '</p>';
							$results .= '</div>';
						}

						if (has_post_thumbnail($chapter_post->ID)) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);

							$fullimage = wp_get_attachment_image_src( $imageid, 'large'); 
							$results .= '<img src="' . $fullimage[0] . '" style="width:100%;margin-top:15px;" alt="' . get_the_title() . '" />'; 
							if ($caption) $results .= $caption;
							if ($photographer) $results .= ' (Photo by ' . $photographer . ')';
							
							$results .= '<div style="margin-bottom:20px;"></div>';

						}
						
						if ($video) {
						
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video);
						
							$results .= '<div class="photowrap">';
							$results .= '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							$results .= '</div>';
						
						}

						$results .= sno_get_the_content_with_formatting($chapter_post->ID);
						
						$results .= '<div style="margin-bottom:20px;"></div>';

						
					}
					
				return $results;

}
function snomobile_longform($post, $custom_fields) {
				$longform = $post['ID'];
				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS sno_format ON(
						$wpdb->posts.ID = sno_format.post_id
						AND sno_format.meta_key = 'sno_format'
						AND sno_format.meta_value = 'Long-Form Chapter'
						)
						JOIN $wpdb->postmeta AS sno_longform_list ON(
						$wpdb->posts.ID = sno_longform_list.post_id
						AND sno_longform_list.meta_value = '$longform'
						)
						JOIN $wpdb->postmeta AS sno_longform_order ON(
						$wpdb->posts.ID = sno_longform_order.post_id
						AND sno_longform_order.meta_key = 'sno_longform_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						OR $wpdb->posts.post_status = 'draft'
						OR $wpdb->posts.post_status = 'pending'
						OR $wpdb->posts.post_status = 'future'
						ORDER BY CAST(sno_longform_order.meta_value AS UNSIGNED INTEGER ) ASC
						";


 					$pageposts = $wpdb->get_results($querystr, OBJECT);

					foreach ($pageposts as $chapter_post) {
						setup_postdata($chapter_post);
						$chapter_custom_fields = get_post_custom($chapter_post->ID);
							$video = $chapter_custom_fields['video'][0];
							$videographer = $chapter_custom_fields['videographer'][0];
							$deck = $chapter_custom_fields['sno_deck'][0];
							$imageid = get_post_thumbnail_id($chapter_post->ID); 

						$title = get_the_title($chapter_post->ID);
						if ($title != 'None') {
	            			$results .= '<h3>' . $title . '</h3>';
						}

						if ($deck) {
							$results .= '<div class="storydeck">';
							$results .= '<p>' . $deck . '</p>';
							$results .= '</div>';
						}

						if (has_post_thumbnail($chapter_post->ID)) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);

							$fullimage = wp_get_attachment_image_src( $imageid, 'large'); 
							$results .= '<img src="' . $fullimage[0] . '" style="width:100%;margin-top:15px;" alt="' . get_the_title() . '" />'; 
							if ($caption) $results .= $caption;
							if ($photographer) $results .= ' (Photo by ' . $photographer . ')';
							
							$results .= '<div style="margin-bottom:20px;"></div>';

						}
						
						if ($video) {
						
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video);
						
							$results .= '<div class="photowrap">';
							$results .= '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							$results .= '</div>';
						
						}

						$results .= sno_get_the_content_with_formatting($chapter_post->ID);
						
						$results .= '<div style="margin-bottom:20px;"></div>';

						
					}
					
				return $results;

}

function snomobile_writer($post) {
	$writers = get_post_meta($post['ID'], 'writer', false); $jobtitle = get_post_meta($post['ID'], 'jobtitle', true);
	if ($writers) {
		$count = count($writers); $i = 0; $names = ''; $title = '';
		if (($count == 1) && ($jobtitle)) $title = $jobtitle;

		$pagelink = sno_staff_profile_link();

		foreach ($writers as $writer) {
		
				$staff_profile_id = sno_mobile_staff_profile_id($writer);
			
			if ($title) {
				$writer = trim ($writer);
				if ($staff_profile_id) {
					$names[] = "<a applink='#' ng-href='#/app/default/$staff_profile_id' href='#/app/default/$staff_profile_id'>$writer</a>, $title";
				} else {
					$names[] = $writer . ', ' . $title;
				}
			} else {
				$writer = trim ($writer);
				if ($staff_profile_id) {
					$names[] = "<a applink='#' ng-href='#/app/default/$staff_profile_id' href='#/app/default/$staff_profile_id'>$writer</a>, $title";
				} else {
					$names[] = $writer;
					
				}
			}
		}
		$count = count($names); $i = 0; $o = '';
		if ($names) foreach ($names as $name) {
			$i++; 
			if ($count == 1) {
				if (!empty($name)) $o .= get_theme_mod('story-byline-text') . ' ' . $name;
			} else if (($count == 2) && ($i == 1)) {
				$o .= get_theme_mod('story-byline-text') . ' ' . $name . ' and ';
			} else if ($i == $count) {
				$o .= $name;
			} else if ($i < $count - 1) {
				if ($i == 1) $o .= get_theme_mod('story-byline-text') . ' ';
				$o .= $name . ', ';	
			} else if ($i < $count) {
				$o .= $name . ', and ';
			}
		}
	return $o;	
	}
}
function snomobile_videographer($post) {
	$videographers = get_post_meta($post['ID'], 'videographer', false); 
	$count = count($videographers); $i = 0;

	foreach ($videographers as $videographer) { $names[] = $videographer; }
	$count = count($names); $i = 0;
	if ($names) foreach ($names as $name) {
		$i++;
		if ($count == 1) {
			$o .= $name;
		} else if (($count == 2) && ($i == 1)) {
			$o .= $name . ' and ';
		} else if ($i == $count) {
			$o .= $name;
		} else if ($i < $count - 1) {
			$o .=  $name . ', ';	
		} else if ($i < $count) {
			$o .=  $name . ', and ';
		}
	return $o;
	}
}
function sno_get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

function sno_mobile_staff_content ($post) {
		$currentyear = date("Y"); 
		$currentmonth = date("m");  

		$resetmonth = get_theme_mod('staff-reset');
		if ($resetmonth == '') $resetmonth = '07';

		if ($currentmonth >= $resetmonth) {
			$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
		} 
		
			global $wpdb;
 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS schoolyear ON(
				$wpdb->posts.ID = schoolyear.post_id
				AND schoolyear.meta_key = 'schoolyear'
				AND schoolyear.meta_value LIKE '%$seasoncheck%'
				)
				JOIN $wpdb->postmeta AS name ON(
				$wpdb->posts.ID = name.post_id
				AND name.meta_key = 'name'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY post_date DESC
				";

 			$pageposts = $wpdb->get_results($querystr, OBJECT);
 			
			if ($pageposts):
 				foreach ($pageposts as $staffpost):
				setup_postdata($staffpost);

					$staff_fields = get_post_custom($staffpost->ID);
						$name = $staff_fields['name'][0];
						$staffposition = $staff_fields['staffposition'][0];
						$postid = $staffpost->ID;
					
					$o .= "<a applink='#' ng-href='#/app/default/$postid' href='#/app/default/$postid'><div style='margin:10px 0px;padding:10px;background: #f1f1f1; color: #000;'>";

							if (has_post_thumbnail($postid)) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'thumbnail'); 
								$o .= '<img style="float:left;margin-right:10px;" src="' . $image[0] . '" />'; 
							}

						$o .= '<span style="font-weight:bold;">'.$name . '</span><br />';
						$o .= $staffposition;
		
					$o .= '<div style="clear:both"></div>';
					$o .= '</div></a>';
								
				endforeach;
			else : endif;

	return $o;
}

function sno_mobile_profile_stories($post, $profile_name) {

$realname = $profile_name;
$profile_name = str_replace( "'", "''", $profile_name );

                global $wpdb;
                if (get_theme_mod('staffpage-exclude') != 'exclude') {
                    $queryadd = "
                        LEFT JOIN $wpdb->postmeta AS videographer ON(
                        $wpdb->posts.ID = videographer.post_id
                        AND videographer.meta_key = 'videographer'
                        )
                        LEFT JOIN $wpdb->postmeta AS photographer ON(
                        $wpdb->posts.ID = photographer.post_id
                        AND photographer.meta_key = 'photographer'
                        )
                    ";
                    $queryadd2 = "
                                OR videographer.meta_value = '$profile_name'
                                OR photographer.meta_value = '$profile_name'
                    ";
                } else { $queryadd = ''; $queryadd2 = ''; }
                $querystr = "
                        SELECT * FROM $wpdb->posts
                        LEFT JOIN $wpdb->postmeta AS writer ON(
                        $wpdb->posts.ID = writer.post_id
                        AND writer.meta_key = 'writer'
                        )
                        $queryadd
                        WHERE     (
                                writer.meta_value = '$profile_name'
                                $queryadd2
                                )
                            AND (
                                $wpdb->posts.post_status = 'publish'
                                OR $wpdb->posts.post_status = 'inherit'
                                )
                        ORDER BY post_date DESC
                        ";
             $pageposts = $wpdb->get_results($querystr, OBJECT);
        
                if ($pageposts):
                    
            
                    foreach ($pageposts as $post2):
                        setup_postdata($post2);
                        $lfstoryid = ''; $lfcheck = '';
                        $gridstoryid = ''; $gridcheck = '';

                                
                        if (get_post_field('post_type', $post2->ID) == "attachment") {
            
                            $storyid = get_post_field('post_parent', $post2->ID);
    
                            if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
                                $lfstoryid = get_post_meta($storyid, 'sno_longform_list', true);
                            }                

                            if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
                                $gridstoryid = get_post_meta($storyid, 'sno_grid_list', true);
                            }                
                            
                        } else {
            
                            $storyid = $post2->ID;

                            if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
                                $lfcheck = get_post_meta($post2->ID, 'sno_longform_list', true);
                                if ($lfcheck != '') $lfstoryid = $lfcheck;
                                
                            }                

                            if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
                                $gridcheck = get_post_meta($post2->ID, 'sno_grid_list', true);
                                if ($gridcheck != '') $gridstoryid = $gridcheck;
                                
                            }                

                        }
                        
                        if ($lfstoryid) {
                        
                            if (get_post_meta($storyid, 'writer', true)) {
                                $content[$lfstoryid]['writer'] = get_post_meta($storyid, 'writer', false);
                            }
                            if (get_post_meta($post2->ID, 'photographer', true) == $realname) {
                                $content[$lfstoryid]['photographer'] = get_post_meta($post2->ID, 'photographer', true);
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
                            if (get_post_meta($post2->ID, 'photographer', true) == $realname) {
                                $content[$gridstoryid]['photographer'] = get_post_meta($post2->ID, 'photographer', true);
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
                            if (get_post_meta($post2->ID, 'photographer', true) == $realname) {
                                $content[$storyid]['photographer'] = get_post_meta($post2->ID, 'photographer', true);
                            }



                            if (get_post_meta($storyid, 'videographer', true)) {
                                $content[$storyid]['videographer'] = get_post_meta($storyid, 'videographer', false);
                            }
                                $content[$storyid]['id'] = $storyid;
                                $content[$storyid]['date'] = get_the_time('Y-m-d', $storyid);
                        }
                        
                        endforeach;
        
                    else : endif;

                    $o .= '<div class="staffstorylist">';
                                        
                        foreach ($content as $story) {
                        
                            $open = 'off'; $type = '';
                                if ( isset ( $story['writer'] ) && is_array($story['writer'])) {
                                    foreach ($story['writer'] as $writer) {
                                        if (trim(strtolower($writer)) == strtolower($realname)) { $type .= 'Story'; $open = 'on'; }
                                    }
                                }
                                
                                if ( isset ($story['photographer']) ) {
                                	
                                        if (trim(strtolower($story['photographer'])) == strtolower($realname)) {
                                            if ($open == 'on') $type .= '/';
                                            $type .= 'Photo'; $open = 'on';
                                        }
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
                                if ( isset ($date[1]) ) $date = date("M d, Y",mktime(0,0,0,$date[1],$date[2],$date[0]));
                            
                            $status = get_post_status($story['id']); $postid = $story['id'];
                            if ($status == 'publish') {
								$o .= "<a applink='#' ng-href='#/app/default/$postid' href='#/app/default/$postid'><div style='margin:10px 0px;padding:10px;background: #f1f1f1;'>";
                                    $o .= '<p style="color: #000; margin-bottom:0px; font-size: 10px; line-height: 14px;font-weight: bold">' . $date . '</p>';
                                    $o .= '<p style="color: #000; margin-bottom:0px">' . get_the_title($story['id']) . ' <span style="font-style:italic">(' . $type . ')</span></div>';
                                $o .= '</div></a>';
                            }
                        }
                        

                    $o .= '</div>';
                    $o .= '<div class="clear"></div>';
    return $o;
}

function sno_mobile_staff_profile_id($writer) {

				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS name ON(
						$wpdb->posts.ID = name.post_id
						AND name.meta_key = 'name'
						AND name.meta_value = '$writer'
						)
						AND $wpdb->posts.post_status = 'publish'
						ORDER BY post_date DESC LIMIT 1
						";
			 	$pageposts = $wpdb->get_results($querystr, OBJECT);
				if ($pageposts): 
					foreach ($pageposts as $post):
						$writer_id = $post->ID;
					endforeach;
				endif;
	return $writer_id;
}