<?php

add_action('widgets_init', create_function('', "register_widget('sno_tag');"));
class sno_tag extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_display_by_tag',
			'description' => __( 'Use this widget to display teasers to stories with a specific tag.' )
			);

		$control_ops = array(
			'id_base' => 'tag'
			);

		parent::__construct( 'tag', __( '(SNO) Display Stories by Tag' ), $widget_ops, $control_ops );

	}

	function widget($args, $instance) {
		extract($args);
 		$totalstories=$instance['number']+$instance['number-headlines'];		
		if ( isset ($instance['category']) && (($instance['category'] == -1) || ($totalstories <= 0))) {} else {


				$widget = $this->id; $sidebartest = get_option('sidebars_widgets'); 
				$columns = get_theme_mod('sno-layout'); 
					
				if ($sidebartest["sidebar-1"]) foreach ($sidebartest["sidebar-1"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Non-Home Sidebar'; 
						}
				}
				if ($sidebartest["sidebar-2"]) foreach ($sidebartest["sidebar-2"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Main Column'; 
						}
				}
				if ($sidebartest["sidebar-3"]) foreach ($sidebartest["sidebar-3"] as $key => $value ) { 
					if (($widget == $value) && ($columns == "Option 1")) {
						$instance['sidebarname'] = 'Home Bottom Narrow'; 
						}
					if (($widget == $value) && ($columns == "Option 2")) {
						$instance['sidebarname'] = 'Home Bottom Wide';
						}
					if (($widget == $value) && ($columns == "Option 3")) {
						$instance['sidebarname'] = 'Home Bottom Left';
						}
					if (($widget == $value) && ($columns == "Option 4")) {
						$instance['sidebarname'] = 'Home Sidebar'; 
						}
					if (($widget == $value) && ($columns == "Option 5")) {
						$instance['sidebarname'] = 'Home Sidebar';
						}
					if (($widget == $value) && ($columns == "Option 6")) {
						$instance['sidebarname'] = 'Home Sidebar';
						}
				}
				if ($sidebartest["sidebar-4"]) foreach ($sidebartest["sidebar-4"] as $key => $value ) { 
					if (($widget == $value) && ($columns == "Option 1")) {
						$instance['sidebarname'] = 'Home Bottom Wide'; 
						}
					if (($widget == $value) && ($columns == "Option 2")) {
						$instance['sidebarname'] = 'Home Bottom Narrow';
						}
					if (($widget == $value) && ($columns == "Option 3")) {
						$instance['sidebarname'] = 'Home Bottom Left';
						}
					if (($widget == $value) && ($columns == "Option 4")) {
						$instance['sidebarname'] = 'Home Bottom Narrow'; 
						}
					if (($widget == $value) && ($columns == "Option 5")) {
						$instance['sidebarname'] = 'Home Bottom Wide';
						}
					if (($widget == $value) && ($columns == "Option 6")) {
						$instance['sidebarname'] = 'Home Bottom Left';
						}
				}
				if ($sidebartest["sidebar-5"]) foreach ($sidebartest["sidebar-5"] as $key => $value ) { 
					if (($widget == $value) && ($columns == "Option 1")) {
						$instance['sidebarname'] = 'Home Sidebar'; 
						}
					if (($widget == $value) && ($columns == "Option 2")) {
						$instance['sidebarname'] = 'Home Sidebar';
						}
					if (($widget == $value) && ($columns == "Option 3")) {
						$instance['sidebarname'] = 'Home Sidebar';
						}
					if (($widget == $value) && ($columns == "Option 4")) {
						$instance['sidebarname'] = 'Home Bottom Wide'; 
						}
					if (($widget == $value) && ($columns == "Option 5")) {
						$instance['sidebarname'] = 'Home Bottom Narrow';
						}
					if (($widget == $value) && ($columns == "Option 6")) {
						$instance['sidebarname'] = 'Home Bottom Left';
						}
				}
				if ( isset ($sidebartest["sidebar-6"]) && $sidebartest["sidebar-6"]) foreach ($sidebartest["sidebar-6"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Sports Center Sidebar';
						} 
				}
				if ( isset ($sidebartest["sidebar-7"]) && $sidebartest["sidebar-7"]) foreach ($sidebartest["sidebar-7"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Bottom Left';
						} 
				}
				if ( isset ($sidebartest["sidebar-8"]) && $sidebartest["sidebar-8"]) foreach ($sidebartest["sidebar-8"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Bottom Right';
						} 
				}
				if ( isset ($sidebartest["sidebar-9"]) && $sidebartest["sidebar-9"]) foreach ($sidebartest["sidebar-9"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Sidebar';
						} 
				}

		if ($instance['custom-view-all']=="on") {
			$categoryslug = $instance['custom-link'];
		} else {
			if ( isset ($instance['tag'])) $categoryslug = cat_id_to_slug($instance['tag']); 
		}
		
		if ( isset ($instance['tag'])) {
			$tag = get_tag($instance['tag']);
			$categoryname = $tag->name;
		}
		$customcolors=$instance['custom-colors'];
		
	if ($instance['tag'] != '' && $instance['tag'] != '-1') {

				$shadow = '';
				if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
					$shadow = "box-shadow: none;";
				} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
					$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
				}

				$widgetwrap_style = " style='$shadow'";

		
		echo "<div class='widgetwrap sno-animate sno-$widget'$widgetwrap_style>"; 
		
		if ( !isset ($categoryslug) ) $categoryslug = '';
		if ( !isset ($instance['title']) ) {
			$videotitle = '';
		} else {
			$videotitle = $instance['title'];
		}	
		if ( !isset ($categoryname) ) $categoryname = '';
		$exitkey = '';

		echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname);
		

		if (($instance['sidebarname'] == 'Home Main Column' ) && ($instance['number-headlines'] > 0) && ($instance['two-column'] == 'on')) { 
			
			$storydivider = $instance['number']+1;
			
			$exclusionarray = sno_exclude_posts();
			
			
				$args = array ( 'tag__in' => array($instance['tag']), 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'ignore_sticky_posts' => true);

            query_posts( $args ); 
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
            $count++; 

			if ($count == 1) {
				echo '<div class="catwidgetleft">';
				$exitkey = 4;
			}

			if ($count <= $instance['number']) {
			
			if (has_post_thumbnail()) { ?>
				<div class="catboxthumbnail" style="float:left; margin-left:0px;">
				<?php $catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
					<a href="<?php the_permalink(); ?>#photo">
						<img src="<?php echo $catimage[0]; ?>" style="width:100%" class="catboxphoto" alt="<?php the_title(); ?>" />
					</a><?php
					
					if ($instance['show-caption']==on) {
						$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   					$caption = get_post_field(post_excerpt, $imageid);	
						sno_photographer($wrap);								   						
	   					if ($caption) { 
	   						echo '<p class="photocaption" style="padding-bottom:8px !important">'.$caption.'</p>'; 
	   					} 
					}
				echo '</div>';
			}

			$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
			<div class="widgetheadline"><a href="<?php the_permalink() ?>"  class="homeheadline" style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;"rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
            <?php if ($instance['show-writer']==on) { $byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>'; } 
  			$teaser = $instance['category-teaser']; 
  			$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  			if ($excerpt) { echo '<p>' . $excerpt . '</p>'; } 
  				else if ($teaser) { the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>"); }
  			if (($instance['show-date']==on) || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']==on)) || (is_user_logged_in())) { ?><p class="datetime"><?php
            if ($instance['show-date']==on) { ?><?php echo get_sno_timestamp(); }
            if (($instance['show-date']==on) && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']==on))) echo ' &bull; '; 
            if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']==on)) { comments_popup_link(' 0 comments', ' 1 comment', ' % comments'); } 
    		edit_post_link('Edit this story', ' &bull; ', ''); ?></p><?php } 
			echo '<div class="storybottomnolineleft"></div>';   		
    		} else  {    		
    		
				if (($count==$storydivider) && ($instance['headline-header'] == on)) { ?>
						<a href="<?php echo $categoryslug; ?>"><p class="sectionhead" style="font-size:14px;margin-bottom:7px;font-weight:normal;">Recent <?php echo $categoryname; ?> Stories</p></a>
				<?php } ?>

				<?php if ($instance['bullet-list']=="Bullet List") { ?>
				<?php if ($exitkey != 5) { echo '<ul>'; $exitkey=5; } ?>
                  	<li><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php if ($instance['teaser-date']==on) { ?><?php echo get_sno_timestamp(); ?><?php } ?></li>
				<?php } else { ?>


                  <?php if($instance['teaser-thumb']==on) { 
                  $thumbplacement=$instance['teaser-thumb-placement']; ?>
                  
<?php if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'thumbnail', array('class' => 'catboxthumb', 'style' => 'width:70px;margin-bottom:10px; float:'.$thumbplacement.'; margin-'.$thumbplacement.':0px;'));} ?>

					<?php } ?>
                  <p><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php if ($instance['teaser-date']==on) { ?><p><?php echo get_sno_timestamp(); ?></p><?php } ?>

                  <?php $teaser = $instance['headline-teaser']; if ($teaser) the_content_limit($teaser, " Read More &raquo;"); ?>
				<div class="clear"></div><div style="margin-top:15px"></div>
                 <?php }
    		    		
    		}
    		
    		if ($count == $instance['number']) {
    			if ($instance['dividing-line']=='on') { 
    			 	$thickness = $instance['dividing-line-thickness'];
    			 	$linetype = $instance['dividing-line-type'];
    				$dividingline = "style='border-top:$thickness $linetype #c0c0c0;border-bottom:$thickness $linetype #c0c0c0;'";
    			}
    			echo "</div><div class='catwidgetright' $dividingline>";
    		}

        endwhile; else: endif; wp_reset_query();
        
        if ($exitkey == 4) echo '</div>';
        if ($exitkey == 5) echo '</ul></div>';


		} else {
		
			if((!is_int($totalstories)) || ($totalstories==0)) $totalstories=1; $storydivider = $instance['number']+1; $count=0;	
			$exclusionarray = sno_exclude_posts();

				$args = array ( 'tag__in' => array($instance['tag']), 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'ignore_sticky_posts' => true);
			
            query_posts( $args ); 
			if (have_posts()) : while (have_posts()) : the_post(); global $post; $count++; 
			
            if ($count <= $instance['number']) {              
				if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Wide")) { $photowidth = "100%"; $thumbnailsize="medium"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Main Column")) { $photowidth = "50%"; $thumbnailsize="medium"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Right")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Left"))){ $photowidth = "100%"; $thumbnailsize="medium"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Narrow")) { $photowidth = "100%"; $thumbnailsize="medium"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Non-Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Sports Center Sidebar"))) { $photowidth = "100%"; $thumbnailsize="medium"; }
				
				else if ($instance['sidebarname'] == "Home Bottom Wide") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Main Column") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Bottom Narrow") { $photowidth = "100%"; $thumbnailsize="permalink"; } 
				else { $photowidth = "40%"; $thumbnailsize="medium"; } 
								
				if ($photowidth=="") { $photowidth = "100%"; $thumbnailsize="medium"; } 
				
				?>
				
				<?php if (has_post_thumbnail()) { ?>
				
					<div class="catboxthumbnail" style="float:<?php echo $instance['category-photo-placement']; ?>; width: <?php echo $photowidth; ?>; margin-<?php echo $instance['category-photo-placement']; ?>:0px;">
						
<?php if (has_post_thumbnail()) { $catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?><a href="<?php the_permalink(); ?>#photo"><img src="<?php echo $catimage[0]; ?>" style="width:100%" class="catboxphoto" alt="<?php the_title(); ?>" /></a><?php }
						
					
						if ($instance['show-caption']=='on') {
							$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   						$caption = get_post_field(post_excerpt, $imageid);
	   						$oldcaption = get_post_meta($post->ID, 'caption', true);
							
							sno_photographer($wrap);
								   						
	   						if ($caption) { 
	   							echo '<p class="photocaption" style="padding-bottom:8px !important">'.$caption.'</p>'; 
	   						} else if ($oldcaption) { 
	   							echo '<p class="photocaption" style="padding-bottom:8px !important">'.$oldcaption.'</p>';
	   						}

						}
				echo '</div>';
			
				}
				
			$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
			<div class="widgetheadline"><a href="<?php the_permalink() ?>"  class="homeheadline" style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;"rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
            <?php if ($instance['show-writer']=='on') { $byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>'; } 
  			$teaser = $instance['category-teaser']; 
  			$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  			if ($excerpt) { echo '<p>' . $excerpt . '</p>'; } 
  				else if ($teaser) { the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>"); }
  			if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) || (is_user_logged_in())) { ?><p class="datetime"><?php
            if ($instance['show-date']=='on') { ?><?php echo get_sno_timestamp(); }
            if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) echo ' &bull; '; 
            if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { comments_popup_link(' 0 comments', ' 1 comment', ' % comments'); } 
    		edit_post_link('Edit this story', ' &bull; ', ''); ?></p><?php } 
    		?>

			<?php if (($count >= 1) && ($count < $totalstories) && ($totalstories!=1)) { ?><?php if ($instance['dividing-line']=='on') { ?><div style="border-bottom: <?php echo $instance['dividing-line-thickness']; ?> <?php echo $instance['dividing-line-type']; ?> #c0c0c0 !important;" class="storybottom"></div><?php } else { ?><div class="storybottomnoline"></div><?php } ?><?php } ?>

                 <?php } else { ?>
				<?php if (($count==$storydivider) && ($instance['headline-header'] == on)) { ?>
						<a href="<?php echo $categoryslug; ?>"><p class="sectionhead" style="font-size:14px;margin-top:15px;margin-bottom:7px;font-weight:normal;">Recent <?php echo $categoryname; ?> Stories</p></a>
				<?php } ?>

				<?php if ($instance['bullet-list']=="Bullet List") { ?>
				<?php if ($exitkey != 5) { echo '<ul>'; $exitkey=5; } ?>
                  	<li><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php if ($instance['teaser-date']==on) { ?><?php echo get_sno_timestamp(); ?><?php } ?></li>
				<?php } else { ?>


                  <?php if($instance['teaser-thumb']==on) { 
                  $thumbplacement=$instance['teaser-thumb-placement']; ?>
                  
<?php if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'thumbnail', array('class' => 'catboxthumb', 'style' => 'width:70px;margin-bottom:10px; float:'.$thumbplacement.'; margin-'.$thumbplacement.':0px;'));} ?>

					<?php } ?>
                  <p><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php if ($instance['teaser-date']==on) { ?><p><?php echo get_sno_timestamp(); ?></p><?php } ?>

                  <?php $teaser = $instance['headline-teaser']; if ($teaser) the_content_limit($teaser, " Read More &raquo;"); ?>
				<div class="clear"></div><div style="margin-top:15px"></div>
                 <?php }
                 }        

        endwhile; else: endif; wp_reset_query();
        
        if ($exitkey == 5) { ?></ul><?php $exitkey = 0; }


	} ?>

		<div class="widget-expander" style="padding-bottom:<?php echo $instance['widget-expander']; ?>"></div><div class="clear"></div>

</div>

		<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
		<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
		<?php } ?>
		" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>
		
		</div>

	<?php } ?> 


	<?php } // end of check for whether or not a tag was selected ?> 
				
<?php	}
	

		function update( $new_instance, $old_instance ) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['tag'] = $new_instance['tag'];
		$instance['number'] = $new_instance['number'];
		$instance['number-headlines'] = $new_instance['number-headlines'];
		$instance['category-photo-placement'] = $new_instance['category-photo-placement'];
		$instance['teaser-thumb-placement'] = $new_instance['teaser-thumb-placement'];
		$instance['category-photo-size'] = $new_instance['category-photo-size'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['category-teaser'] = $new_instance['category-teaser'];
		$instance['headline-teaser'] = $new_instance['headline-teaser'];
		$instance['headline-size'] = $new_instance['headline-size'];
 		$instance['show-writer'] = ( isset( $new_instance['show-writer'] ) ? on : "" );  
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
 		$instance['show-comments'] = ( isset( $new_instance['show-comments'] ) ? on : "" );  
 		$instance['show-caption'] = ( isset( $new_instance['show-caption'] ) ? on : "" );  
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
 		$instance['teaser-thumb'] = ( isset( $new_instance['teaser-thumb'] ) ? on : "" );  
 		$instance['teaser-date'] = ( isset( $new_instance['teaser-date'] ) ? on : "" );  
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
 		$instance['headline-header'] = ( isset( $new_instance['headline-header'] ) ? on : "" );  
 		$instance['two-column'] = ( isset( $new_instance['two-column'] ) ? on : "" );  
 		$instance['three-column'] = ( isset( $new_instance['three-column'] ) ? on : "" );  
		$instance['bullet-list'] = $new_instance['bullet-list'];
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['dividing-line-type'] = $new_instance['dividing-line-type'];
		$instance['dividing-line-thickness'] = $new_instance['dividing-line-thickness'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['box1'] = $new_instance['box1'];
		$instance['box2'] = $new_instance['box2'];
		$instance['box3'] = $new_instance['box3'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'number' => '1', 'number-headlines' => '3', 'number3c' => '3', 'fixed-height' => '300', 'headline-size' => '18', 'category-photo-placement' => 'Left', 'category-photo-size' => 'Large', 'border-thickness' => '1px','category-teaser' => '170','headline-teaser' => '0', 'show-writer' => 'on', 'view-all' => 'on', 'show-date' => 'on', 'show-comments' => 'on', 'show-caption' => '', 'teaser-date' => 'on', 'teaser-thumb' => 'on', 'teaser-thumb-placement' => 'Left', 'widget-style'=>get_theme_mod('widget-style-sno'), 'bullet-list' => 'Teasers', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgettag = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgettag)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}

if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
		
		if ($instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if ($instance['box2'] == 'Closed') { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
		} 

		if ($instance['box3'] == 'Closed') { 
			$box3 = ' style="display:none"'; $expand3 = ''; $collapse3 = ' style="display:none"'; 
		} else { 
			$box3 = ''; $collapse3 = ''; $expand3 = ' style="display:none"'; 
		} 

?>
<div class="hide_all"<?php echo $hide_all; ?>>

				<select style="display:none;" id="<?php echo $this->get_field_id('box1'); ?>" name="<?php echo $this->get_field_name( 'box1' ); ?>">
					<option value="Closed" <?php if ($instance['box1'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box1'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box2'); ?>" name="<?php echo $this->get_field_name( 'box2' ); ?>">
					<option value="Closed" <?php if ($instance['box2'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box2'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box3'); ?>" name="<?php echo $this->get_field_name( 'box3' ); ?>">
					<option value="Closed" <?php if ($instance['box3'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box3'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>

		<div class="widgetsection" id="widgetsection1-<?php echo $random; ?>">
			<div class="expand" id="expand1-<?php echo $random; ?>" <?php echo $expand1; ?>></div><div class="collapse" id="collapse1-<?php echo $random; ?>" <?php echo $collapse1; ?>></div>
			Story Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>
		
		Select a tag<br />
			<?php wp_dropdown_categories(array('taxonomy' => 'post_tag', 'selected' => $instance['tag'], 'name' => $this->get_field_name( 'tag' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'flex'), 'hide_empty' => '0' )); ?><br />
		
		
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Widget Title:"); ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
				
			<span class='widewidgetarea'>
			<br />
			<input class="threecolumncheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['three-column'] == on) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'three-column' ); ?>" name="<?php echo $this->get_field_name( 'three-column' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'three-column' ); ?>"> Three Column Format</label>
			<br />
			</span>
			<br />
				
		<div class="widgetdivider"></div>

			<span class="threecolumn<?php echo $random; ?>">

			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					<?php for ($i = 1; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			</span>
			
			<span class="threecolumnhide<?php echo $random; ?>">
			<?php if ($disable_js == 'on') { echo '<div id="th">'; } ?>
			<p>
				<select id="<?php echo $this->get_field_id('number3c'); ?>" name="<?php echo $this->get_field_name('number3c'); ?>">
					<?php for ($i = 3; $i <= 12; $i+=3) { 
						echo "<option value='$i'";
						if ($i == $instance['number3c']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id('fixed-height'); ?>" name="<?php echo $this->get_field_name('fixed-height'); ?>">
					<?php for ($i = 150; $i <= 350; $i+=25) { 
						$height = $i . 'px';
						echo "<option value='$height'";
						if ($height == $instance['fixed-height']) echo ' selected="selected"';
						echo ">$height</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('fixed-height'); ?>"><?php _e('Fixed Story Height'); ?></label>
			</p>
		
			<div class="widgetdivider"></div>

			<?php if ($disable_js == 'on') { echo '</div>'; } ?>

			</span>
			
			<span class="threecolumn<?php echo $random; ?>">

				<select id="<?php echo $this->get_field_id( 'category-photo-placement' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-placement' ); ?>">
					<option value="Left" <?php if ( 'Left' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Left</option>
					<option value="Right" <?php if ( 'Right' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Right</option>
				</select>
				<select id="<?php echo $this->get_field_id( 'category-photo-size' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-size' ); ?>">
					<option value="Small" <?php if ( 'Small' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Small</option>
					<option value="Large" <?php if ( 'Large' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Large</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'category-photo-size' ); ?>">Photos</label>
			
			<br /><br />
			</span>
		<div class="widgetdivider threecolumn<?php echo $random; ?>"></div>

			<span class="threecolumn<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
					<?php for ($i=14; $i <= 26; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Headline Size</label>
			<br /><br />
			</span>
		<div class="widgetdivider threecolumn<?php echo $random; ?>"></div>
		
			<p>
				<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
				<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>
			</p>

			
		<div class="widgetdivider"></div>
		

			<input class="checkbox" type="checkbox" <?php if ($instance['show-writer'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-writer' ); ?>" name="<?php echo $this->get_field_name( 'show-writer' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-writer' ); ?>">Show Byline</label>			
		
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>">Show Date</label>			
		
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-comments'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-comments' ); ?>" name="<?php echo $this->get_field_name( 'show-comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-comments' ); ?>">Show Comments Link</label>			

		<br />
		<span class="threecolumn<?php echo $random; ?>">

			<input class="checkbox" type="checkbox" <?php if ($instance['show-caption'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-caption' ); ?>" name="<?php echo $this->get_field_name( 'show-caption' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-caption' ); ?>">Show Caption</label>			
		
		<br />
		
			<input class="checkbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['dividing-line'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Lines</label>

		<br />
				

		<div class="dividinglines<?php echo $random; ?>">
		<br />

		<div class="widgetdivider"></div>

				<select id="<?php echo $this->get_field_id( 'dividing-line-type' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-type' ); ?>">
					<option value="solid" <?php if ( 'solid' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Solid</option>
					<option value="dotted" <?php if ( 'dotted' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dotted</option>
					<option value="dashed" <?php if ( 'dashed' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dashed</option>
				</select>
				<select id="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-thickness' ); ?>">
					<option value="1px" <?php if ( '1px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>1px</option>
					<option value="2px" <?php if ( '2px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>2px</option>
					<option value="3px" <?php if ( '3px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>3px</option>
					<option value="4px" <?php if ( '4px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>4px</option>
					<option value="5px" <?php if ( '5px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>5px</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>"> Line Style</label>
				<br />

		</div>
		<br />
		</span>
		<br />
		</div>

		<div class="widgetsection" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Extra Headlines
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

		<span class="threecolumn<?php echo $random; ?>">
			
			<span class='widewidgetarea'>
			<input class="checkbox" type="checkbox" <?php if ($instance['two-column'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'two-column' ); ?>" name="<?php echo $this->get_field_name( 'two-column' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'two-column' ); ?>"> Show as Second Column</label>
			<br />
			</span>


			<input class="checkbox" type="checkbox" <?php if ($instance['headline-header'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'headline-header' ); ?>" name="<?php echo $this->get_field_name( 'headline-header' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'headline-header' ); ?>"> Show Recent Headlines Label</label><br />

			<input class="checkbox" type="checkbox" <?php if ($instance['teaser-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-date' ); ?>" name="<?php echo $this->get_field_name( 'teaser-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-date' ); ?>"> Show Dates</label>
			<br /><br />
			
			<div class="widgetdivider"></div>
			<p>
				<select id="<?php echo $this->get_field_id('number-headlines'); ?>" name="<?php echo $this->get_field_name('number-headlines'); ?>">
					<?php for ($i = 1; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number-headlines']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('number-headlines'); ?>"><?php _e('Number of Extra Headlines'); ?></label>
			</p>

			<div class="widgetdivider"></div>
			<p>
			<select class="displaystyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'bullet-list' ); ?>" name="<?php echo $this->get_field_name( 'bullet-list' ); ?>">
				<option style="padding-right:10px;" value="Bullet List" <?php if ( 'Bullet List' == $instance['bullet-list'] ) echo 'selected="selected"'; ?>>Bullet List</option>
				<option style="padding-right:10px;" value="Teasers" <?php if ( 'Teasers' == $instance['bullet-list'] ) echo 'selected="selected"'; ?>>Teasers</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'bullet-list' ); ?>"> Display Style</label><br />
			</p>
			


		<div class="displayoptions<?php echo $random; ?>">

			<div class="widgetdivider"></div>

			<p>
			<input id="<?php echo $this->get_field_id('headline-teaser'); ?>" name="<?php echo $this->get_field_name('headline-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['headline-teaser']; ?>" />
			<label for="<?php echo $this->get_field_id('headline-teaser'); ?>">Teaser Length (characters)</label>
			</p>
			
			<p>
			<input class="teaserselect<?php echo $random; ?>" type="checkbox" <?php if ($instance['teaser-thumb'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>"> Show Thumbnails</label><br />
			</p>
			<div class="teaseroptions<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb-placement' ); ?>">
				<option value="left" <?php if ( 'left' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Left</option>
				<option value="right" <?php if ( 'right' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Right</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>">Thumbnail Placement</label><br /><br />
			</div>



		</div>

		</span>
	

		</div>

		<div class="widgetsection" id="widgetsection3-<?php echo $random; ?>">
			<div class="expand" id="expand3-<?php echo $random; ?>" <?php echo $expand3; ?>></div><div class="collapse" id="collapse3-<?php echo $random; ?>" <?php echo $collapse3; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody3-<?php echo $random; ?>" <?php echo $box3; ?>>
		
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
	</div>
	<div class="lastsection"></div>
	</div>

	<?php 
		$wid = array(); 
		$wid[0] = $this->number;
		$wid[1] = $this->get_field_id('box1'); 
		$wid[2] = $this->get_field_id('box2'); 
		$wid[3] = $this->get_field_id('box3'); 
	//	sno_widget_toggles($wid, $boxes=3, $random);
		sno_widget_interface_styles(); 
	?>
		
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




    				jQuery("#widgetsection1-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody1-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse1-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand1-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse1-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 

    				});
    				jQuery("#widgetsection2-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody2-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse2-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand2-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse2-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 
    				});
    				jQuery("#widgetsection3-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody3-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse3-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand3-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse3-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Open'); 
    					} 
    				});
			

	</script>
	
	<?php } ?>
		
	<?php 
	}

}
?>