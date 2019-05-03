<?php 

	echo '<div id="homebreaking">';

	query_posts('showposts=1&cat='.get_theme_mod('home-breaking-cat')); 
	if (have_posts()) : while (have_posts()) : the_post();

		$custom_fields = get_post_custom($post->ID);
			if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
			if (isset($custom_fields['deck'])) $deck = $custom_fields['sno_deck'][0];
			if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
			if (isset($custom_fields['sno_teaser'])) $sno_teaser = $custom_fields['sno_teaser'][0]; 

		if (isset($imageid) && ($imageid)) $breakingimage = wp_get_attachment_image_src( $imageid, 'medium'); 
		$teaser = get_theme_mod('home-breaking-teaser');			
		
		if ($video) {
			
			echo '<div id="topstoryvideo">';
			echo '<h1 class="breakingheadline headline" style="text-align:center;"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
		
			if ($deck) {
				echo '<div class="homedeck" style="text-align:center;">';
				echo '<p>' . $deck . '</p>';
				echo '</div>';
			}
					
				echo '<div class="breakingstory-horiz">';

				if (get_theme_mod('home-breaking-byline') == 'Display') {
		   			echo '<div id="storymeta" class="storymeta">';
						echo '<p>';
						$byline = snowriter(); if ($byline) echo $byline . ' &bull; ';
							the_time('F j, Y'); 
						echo '</p>';
					echo '</div>';
				}					
					
					echo '<div class="topstoryintro">';
			  	      	if ($sno_teaser) { 
			    	       	echo '<p>' . $sno_teaser . ' <a href="' . get_permalink() . '">Read more &raquo;</a></p>'; 
						} else {
							the_content_limit($teaser, "Read more &raquo;");
						}
					echo '</div>';
				
				echo '</div>';

					$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video);
					echo '<div class="videowrap" style="width:50%;"><div class="embedcontainer">' . $video . '</div></div>';
					
			echo '</div>';
	
		
		} else if ((has_post_thumbnail()) && ($breakingimage[1] <= $breakingimage[2])) {
		
			echo '<div id="topstoryvert">';
			echo '<a href="' . get_permalink() . '"><img src="' . $breakingimage[0] . '" style="width:30%" class="homebreaking-photo-vert" /></a>'; 

			echo '<div class="breakingstory">';
			echo '<h1 class="breakingheadline headline"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';

				if ($deck) {
					echo '<div class="homedeck">';
					echo '<p>' . $deck . '</p>';
					echo '</div>';
				}		

				if (get_theme_mod('home-breaking-byline') == 'Display') {
		   			echo '<div id="storymeta" class="storymeta">';
						echo '<p>';
						$byline = snowriter(); if ($byline) echo $byline . ' &bull; ';
							the_time('F j, Y'); 
						echo '</p>';
					echo '</div>';
				}

					echo '<div class="topstoryintro">';
			  	      	if ($sno_teaser) { 
			    	       	echo '<p>' . $sno_teaser . ' <a href="' . get_permalink() . '">Read more &raquo;</a></p>'; 
						} else {
							the_content_limit($teaser, "Read more &raquo;");
						}
					echo '</div>';
			
			echo '</div>';
			echo '</div>';
		
		} else if (has_post_thumbnail()) {

			echo '<div id="topstoryhoriz">';

			echo '<h1 class="breakingheadline headline" style="text-align:center;"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
		
			if ($deck) {
				echo '<div class="homedeck" style="text-align:center;">';
				echo '<p>' . $deck . '</p>';
				echo '</div>';
			}
			
			$breakingimage = wp_get_attachment_image_src( $imageid, 'large'); 			

			echo '<a href="' . get_permalink() . '"><img src="' . $breakingimage[0] . '" style="width:50%" class="homebreaking-photo-horiz" /></a>'; 
		
				echo '<div class="breakingstory-horiz">';

				if (get_theme_mod('home-breaking-byline') == 'Display') {
		   			echo '<div id="storymeta" class="storymeta">';
						echo '<p>';
						$byline = snowriter(); if ($byline) echo $byline . ' &bull; ';
							the_time('F j, Y'); 
						echo '</p>';
					echo '</div>';
				}

					echo '<div class="topstoryintro">';
			  	      	if ($sno_teaser) { 
			    	       	echo '<p>' . $sno_teaser . ' <a href="' . get_permalink() . '">Read more &raquo;</a></p>'; 
						} else {
							the_content_limit($teaser, "Read more &raquo;");
						}
					echo '</div>';

				echo '</div>';
				echo '</div>';

		} else {

			echo '<div id="topstorynophoto">';
		
			echo '<h1 class="breakingheadline headline" style="text-align:center;"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
		
			if (isset($deck) && $deck) {
				echo '<div class="homedeck" style="text-align:center;">';
				echo '<p>' . $deck . '</p>';
				echo '</div>';
			}
			
				echo '<div class="breakingstory-nophoto">';
				if (get_theme_mod('home-breaking-byline') == 'Display') {
		   			echo '<div id="storymeta" class="storymeta">';
						echo '<p>';
						$byline = snowriter(); if ($byline) echo $byline . ' &bull; ';
							the_time('F j, Y'); 
						echo '</p>';
					echo '</div>';
				}

					echo '<div class="topstoryintro" style="max-width:600px;margin: 0px auto;">';
			  	      	if ($sno_teaser) { 
			    	       	echo '<p>' . $sno_teaser . ' <a href="' . get_permalink() . '">Read more &raquo;</a></p>'; 
						} else {
							the_content_limit($teaser, "Read more &raquo;");
						}
					echo '</div>';

				echo '</div>';
				echo '</div>';
		}
	
	endwhile; else: endif;
	
	
	echo '</div>';


?>