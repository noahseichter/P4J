<?php
function quickvideo_ajaxpost() {

$args = array( 
    'p' => $_POST['id'] 
    ); 
	
	$type = $_POST['type'];
	$myposts = get_posts( $args ); global $post; 
		foreach( $myposts as $post ) :	setup_postdata($post); 
			echo '<div id="quickvideo">';
			  if ($type == "video") {
              		$video = get_post_meta($post->ID, video, true); if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height=319", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width='519'", $video); echo $video; } 
              		
              		echo '<div style="clear:both"></div><div class="quickvideotitle"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
              		
               }
               
             echo '</div>';
		endforeach; 
	die();
}

add_action('wp_ajax_my_quick_post', 'quickvideo_ajaxpost');
add_action('wp_ajax_nopriv_my_quick_post', 'quickvideo_ajaxpost'); 

function quickstory_ajaxpost() {

$args = array( 
	'numberposts'     => 1,
    'offset'          => $_POST['offset'],
    'category'        => $_POST['cat'] ); 

			$category = $_POST['cat'];
			echo '<div id="quickstory'.$category.'">';
	
	$myposts = get_posts( $args ); global $post; $count=0;
		foreach( $myposts as $post ) :	setup_postdata($post); 
		

	if (has_post_thumbnail()) {
			$imageid = get_post_thumbnail_id();
			$catimage = wp_get_attachment_image_src( $imageid, 'home400'); 
			$photographer = get_post_meta($imageid, photographer, true);
	   		$caption = get_post_field(post_excerpt, $imageid);
			
			if ($catimage[1] >= $catimage[2]) {
			
			$imagetype = "horizontal";
			
			echo '<div id="quicklookphotobox" style="width:330px">';
			
			?><a href="<?php the_permalink(); ?>"><img src="<?php echo $catimage[0]; ?>" style="width:330px;" class="catboxphoto" alt="<?php the_title(); ?>" /></a><?php			
				if (($caption) || ($photographer)) {
					echo '<p class="quickcaption">'. $caption; 
					if ($photographer) echo ' ('. $photographer . ')';
					echo '</p>';
				}
			echo '</div>';
		
			} else {
			$imagetype = "vertical";
						
			echo '<div id="quicklookphotobox">';
			
			?><a href="<?php the_permalink(); ?>"><img src="<?php echo $catimage[0]; ?>" style="height:300px;" class="catboxphoto" alt="<?php the_title(); ?>" /></a><?php	

			echo '</div>';
						
			}
		
		
	}
			
	echo '<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
			
	echo '<p class="datetime">';
		the_time(' F j, Y');
		echo '</p>';
		
	echo '<p class="writer">';
		snowriter();
		echo '</p>';
	
	if ($imagetype == "") {
		echo '<div class="quickbodytext">';	
		the_content_limit('700', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	} else if ($imagetype == "horizontal") {
		echo '<div class="quickbodytext" style="width:400px;float:right;">';	
		the_content_limit('350', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	} else {
		echo '<div class="quickbodytext">';	
		the_content_limit('350', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	}
	
	if ($imagetype=="vertical"){
		$photographer = get_post_meta($post->ID, photographer, true); 
		$caption = get_post_meta($post->ID, caption, true); 
		if (($caption) || ($photographer)) {
			echo '<p class="quickcaption">'. $caption; 
			if ($photographer) echo ' ('. $photographer . ')';
			echo '</p>';
		}

	}
             echo '</div>';
		endforeach; 
	die();
}

add_action('wp_ajax_my_quick_story', 'quickstory_ajaxpost');
add_action('wp_ajax_nopriv_my_quick_story', 'quickstory_ajaxpost'); 

function quick_story ($category) {

	echo '<div style="display:none;position:absolute;left:290px;top:330px;z-index:20" id="dvloader'.$category.'"><img src="' . get_bloginfo('template_url') . '/tools/quicklook/loading.gif" /></div>';

?>
                      		<script type="text/javascript">
			$(function(){
 				var offsettest = 0;
           		$('.moreheadlines<?php echo $category; ?>').click(function(){
				var cat = <?php echo $category; ?>;
				offsettest = offsettest + 1;
				        $("#dvloader<?php echo $category; ?>").show();

                       	$.ajax({
                            url:"/wp-admin/admin-ajax.php",
                            type:'POST',
                            data:'action=my_quick_story&cat=' + cat + '&offset=' + offsettest,
 	                        success:function(results)
	                        { $("#quickstory<?php echo $category; ?>").replaceWith(results); $("#dvloader<?php echo $category; ?>").hide(); }
	                 	});
	         	});
			});
		</script><?php
	
	echo '<div class="quickright">';
	
	echo '<div id="quickstory'.$category.'">';

$count = 0; $category_slug = cat_id_to_slug($category); $category_name = cat_id_to_name($category);
$recent = new WP_Query('cat=' . $category . '&showposts=1'); while($recent->have_posts()) : $recent->the_post(); global $post; $count++; $imagetype="";

	if (has_post_thumbnail()) {
			$imageid = get_post_thumbnail_id();
			$catimage = wp_get_attachment_image_src( $imageid, 'home400'); 
			$photographer = get_post_meta($imageid, photographer, true);
	   		$caption = get_post_field(post_excerpt, $imageid);
			
			if ($catimage[1] >= $catimage[2]) {
			
			$imagetype = "horizontal";
			
			echo '<div id="quicklookphotobox" style="width:330px">';
			
			?><a href="<?php the_permalink(); ?>"><img src="<?php echo $catimage[0]; ?>" style="width:330px;" class="catboxphoto" alt="<?php the_title(); ?>" /></a><?php			
				if (($caption) || ($photographer)) {
					echo '<p class="quickcaption">'. $caption; 
					if ($photographer) echo ' ('. $photographer . ')';
					echo '</p>';
				}
		echo '</div>';
		
			} else {
			
			$imagetype = "vertical";
			echo '<div id="quicklookphotobox">';
			
			?><a href="<?php the_permalink(); ?>"><img src="<?php echo $catimage[0]; ?>" style="height:300px;" class="catboxphoto" alt="<?php the_title(); ?>" /></a><?php	

			echo '</div>';
	
						
			}
		
		
	}
			
	echo '<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
			
	echo '<p class="datetime">';
		the_time(' F j, Y');
		echo '</p>';
		
	echo '<p class="writer">';
		snowriter();
		echo '</p>';

	if ($imagetype == "") {
		echo '<div class="quickbodytext">';	
		the_content_limit('700', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	} else if ($imagetype == "horizontal") {
		echo '<div class="quickbodytext" style="width:400px;float:right;">';	
		the_content_limit('350', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	} else {
		echo '<div class="quickbodytext">';	
		the_content_limit('350', '<span class="quickcontinue">Continue Reading</span>');
		echo '</div>';
	}
	
	if ($imagetype=="vertical"){
		if (($caption) || ($photographer)) {
			echo '<p class="quickcaption">'. $caption; 
			if ($photographer) echo ' ('. $photographer . ')';
			echo '</p>';
		}

	}

	
endwhile; wp_reset_query(); 

	echo '</div>';

	echo '<div class="quickbodybottom">';
		
             $videoid= get_the_ID(); 

		echo '<a href="#" onclick="return false" class="moreheadlines'.$category.'">';  

			echo '<div class="quickbodybottomsecond">';

			echo '<p>Next ' . $category_name . ' Story <span style="font-size:20px;"> &raquo;</span></p>';
		
			echo '</div>';
		
		echo '</a>';
		
		echo '<a class="quickbrlink" href="' . $category_slug . '">'; 
			echo '<div class="quickbodybottommore">';
			
				echo 'All '. $category_name . ' Stories';
		
			echo '</div>';
		echo '</a>';
		
	echo '</div>';

	echo '</div>';

}

function quick_video($category) {

	echo '<div class="quickright" style="padding-left:0px !important ;padding-top:0px;padding-right:0px; width:759px !important;">';

$count = 0; $category_slug = cat_id_to_slug($category); $category_name = cat_id_to_name($category);
$recent = new WP_Query('cat=' . $category . '&showposts=5'); while($recent->have_posts()) : $recent->the_post(); global $post; $count++;

if ($count == 1) {


	$video = get_post_meta($post->ID, video, true);
	if ($video) { $pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "height='319'", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "width='519'", $video); echo '<div class="quickvideowrap"><div id="quickvideo" style="display:block">' . $video . '<div style="clear:both"></div><div class="quickvideotitle"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div></div></div>'; } 
	
	
} else {

             $videoid= get_the_ID(); ?>
                      		<script type="text/javascript">
			$(function(){
           		$('.moreheadlines<?php echo $videoid; ?>').click(function(){
				var videoid = <?php echo $videoid; ?>;
                       	$.ajax({
                            url:"/wp-admin/admin-ajax.php",
                            type:'POST',
                            data:'action=my_quick_post&type=video&id=' + videoid,
 	                        success:function(results)
	                        { $("#quickvideo").replaceWith(results); }
	                 	});
	         	});
			});
		</script><?php


	echo '<div class="quickvideoright">';

		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'videothumb'); 
		if ($thumbnail) echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'"><div class="mmphoto" style="background:url('.$thumbnail[0].') no-repeat"><img class="mmoverlay" src="' . get_bloginfo('template_url') . '/tools/quicklook/playbutton.png" /></div></a>';  
	
		echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';  
		the_title(); 
		echo '</a>';
		
	echo '</div>';
		
}

endwhile; wp_reset_query(); 

	echo '<div id="quickvideomore">';
		echo '<a href="' . $category_slug . '">More ' . $category_name . ' </a>';
	echo '</div>';
	

	echo '</div>';
}

function quick_schedule() {
	echo '<div class="quickright">';

		$currentyear = date("Y"); 
		$currentmonth = date("m");  
		if ($currentmonth >= "07") {
			$spring = $currentyear + 1; 
			$seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; 
			$seasoncheck = "$fall" . "-" . "$currentyear";
		} 
		$today = date("Y").'-'.date("m").'-'.date("d"); 

		$pages = get_pages(array(
    		'meta_key' => '_wp_page_template',
   		 	'meta_value' => 'sportstemplate.php',
    		'showposts' => 1
		));
		foreach($pages as $page) $sportsurl =  $page->ID; 		
		$pagelink = get_permalink($sportsurl);

			echo '<table class="schedule" style="width:740px">';
    		echo '<thead>';
        	echo '<tr class="schedulehead">';
            echo '<th class="tableindent"">Sport</th>';
            echo '<th>Date</th>';
            echo '<th>Time</th>';
            echo '<th>Opponent</th>';
            echo '<th>Location</th>';
        	echo '</tr>';
    		echo '</thead>';
			echo '<tbody>';

			$count = 0;
			$maxcount = get_theme_mod('recent-results'); if ($maxcount == "") { $maxcount = 20; }
			global $wpdb;
			
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
					ORDER BY date.meta_value ASC LIMIT 12
					";

 				$pageposts = $wpdb->get_results($querystr, OBJECT);

				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);

						$sport = get_post_meta($post->ID, sport, true);
						$date = get_post_meta($post->ID, date, true); 
							$date = explode("-",$date); 
							$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
						$time = get_post_meta($post->ID, time, true);
						$opponent = get_post_meta($post->ID, opponent, true);
						$location = get_post_meta($post->ID, location, true);

     					echo '<tr class="rosterrow">';
        	    		echo '<td class="tableindent""><a href="' . $pagelink . '?sport=' . $sport .'">' . $sport . '</a></td>';
        	    		echo '<td>' . $date . '</td>';
        	    		echo '<td>' . $time . '</td>';
						echo '<td>' . $opponent . '</td>';
						echo '<td>' . $location . '</td>';
						echo '</tr>';

					endforeach;  
				else : endif; 
	
				echo '</tbody>';
				echo '</table>';	

echo '<div class="quickbodybottom">';
	echo '<div class="quickbodybottomsports">';
		echo 'Click on any sport above to see a full schedule for that sport.</div>';
	echo '</div>';
echo '</div>';
}
function quick_results() {
	echo '<div class="quickright">';

		$currentyear = date("Y"); 
		$currentmonth = date("m");  
		if ($currentmonth >= "07") {
			$spring = $currentyear + 1; 
			$seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; 
			$seasoncheck = "$fall" . "-" . "$currentyear";
		} 
		$today = date("Y").'-'.date("m").'-'.date("d"); 
		$pages = get_pages(array(
    		'meta_key' => '_wp_page_template',
   		 	'meta_value' => 'sportstemplate.php',
    		'showposts' => 1
		));
		foreach($pages as $page) $sportsurl =  $page->ID; 		
		$pagelink = get_permalink($sportsurl);
				
			echo '<table class="schedule" style="width:740px">';
    		echo '<thead>';
        	echo '<tr class="schedulehead">';
            echo '<th class="tableindent"">Sport</th>';
            echo '<th>Date</th>';
            echo '<th>Opponent</th>';
            echo '<th class="tablecenter">Result</th>';
            echo '<th></th>';
            echo '<th class="tablecenter">W/L</th>';
        	echo '</tr>';
    		echo '</thead>';
			echo '<tbody>';

			$count = 0;
			$maxcount = get_theme_mod('recent-results'); if ($maxcount == "") { $maxcount = 20; }
			global $wpdb;

 				$querystr = "
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
					JOIN $wpdb->postmeta AS season ON(
					$wpdb->posts.ID = season.post_id
					AND season.meta_value = '$seasoncheck'
					)
					AND $wpdb->posts.post_status = 'publish'
					WHERE date.meta_value <= '$today'
					ORDER BY date.meta_value DESC LIMIT 12
					";

 				$pageposts = $wpdb->get_results($querystr, OBJECT);

				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);

						$sport = get_post_meta($post->ID, sport, true);
						$date = get_post_meta($post->ID, date, true); 
							$date = explode("-",$date); 
							$date = date("D, M d",mktime(0,0,0,$date[1],$date[2],$date[0]))."\n";
						$time = get_post_meta($post->ID, time, true);
						$opponent = get_post_meta($post->ID, opponent, true);
						$location = get_post_meta($post->ID, location, true);
						$storylink = get_post_meta($post->ID, storylink, true);
						$ourscore = get_post_meta($post->ID, ourscore, true); 
						$theirscore = get_post_meta($post->ID, theirscore, true);
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

     					echo '<tr class="rosterrow">';
        	    		echo '<td class="tableindent""><a href="' . $pagelink . '?sport=' . $sport .'">' . $sport . '</a></td>';
        	    		echo '<td>' . $date . '</td>';
						echo '<td>' . $opponent . '</td>';
						echo '<td class="tablecenter">' . $score;
							edit_post_link(' Edit', '', '');
							echo '</td>';
						echo '<td>';
							if ($storylink) echo '  <a href="' . $storylink . '">Read Story</a>';
							echo '</td>';
						echo '<td class="tablecenter">' . $result . '</td>';
						echo '</tr>';

					endforeach;  
				else : endif; 
	
				echo '</tbody>';
				echo '</table>';	

echo '<div class="quickbodybottom">';
	echo '<div class="quickbodybottomsports">';
		echo 'Click on any sport above to see a full schedule for that sport.</div>';
	echo '</div>';
echo '</div>';

}
?>