<?php
include(TEMPLATEPATH."/tools/theme-options.php");
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );	
require_once ($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/snoflex/tools/aria-walker-nav-menu.php');
if ( function_exists('register_sidebars') )
		register_sidebar(array( 
			'name' 			=> 'Home Top Full Width',
			'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
			'id' 			=> 'sidebar-11',
			'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
			'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' 	=> '</div></div><div class="widgetbody">',
			));			

if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Home Top Wide',
		'id' => 'sidebar-2',
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));
if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Home Top Left',
		'id' => 'sidebar-3',
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));
if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Home Top Center',
		'id' => 'sidebar-4',
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));
if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Home Top Right',
		'id' => 'sidebar-5',
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));

if ( function_exists('register_sidebars') )
		register_sidebar(array( 
			'name' 			=> 'Home Middle Full Width',
			'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
			'id' 			=> 'sidebar-m-11',
			'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
			'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' 	=> '</div></div><div class="widgetbody">',
			));			

	if ( function_exists('register_sidebars') )
		register_sidebar(array('name'=>'Home Bottom Left',
			'id' => 'sidebar-7',
			'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' => '</div><div class="widgetfooter3"></div></div>',
			'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' => '</div></div><div class="widgetbody">',
			));
	if ( function_exists('register_sidebars') )
		register_sidebar(array('name'=>'Home Bottom Center',
			'id' => 'sidebar-8',
			'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' => '</div><div class="widgetfooter3"></div></div>',
			'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' => '</div></div><div class="widgetbody">',
			));
	if ( function_exists('register_sidebars') )
		register_sidebar(array('name'=>'Home Bottom Right',
			'id' => 'sidebar-9',
			'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' => '</div><div class="widgetfooter3"></div></div>',
			'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' => '</div></div><div class="widgetbody">',
			));
if ( function_exists('register_sidebars') )
		register_sidebar(array( 
			'name' 			=> 'Home Bottom Full Width',
			'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
			'id' 			=> 'sidebar-b-11',
			'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
			'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
			'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' 	=> '</div></div><div class="widgetbody">',
			));			
if ( function_exists('register_sidebars') )
		register_sidebar(array( 
			'name' 			=> 'Above Header Full Width',
			'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
			'id' 			=> 'sidebar-h-11',
			'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap"><div>',
			'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
			'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' 	=> '</div></div><div class="widgetbody">',
			));			

	if ( function_exists('register_sidebars') )
		register_sidebar(array('name'=>'Extra Column for Wide Screens (Left)',
			'id' => 'sidebar-10',
			'description' => __('This widget area displays on the left side of the main content.  Activate this area on the SNO Design Options page.', 'sno'),
			'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
			'after_widget' => '</div><div class="widgetfooter3"></div></div>',
			'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' => '</div></div><div class="widgetbody">',
			));
	if ( function_exists('register_sidebars') )
		register_sidebar(array('name'=>'Mobile Phone Homepage',
			'id' => 'sidebar-20',
			'description' => __('If widgets are added to this widget area, this content will display as the homepage for mobile phones.', 'sno'),
			'before_widget' => '<div style="clear:both"></div><div class="widgetwrap"><div>',
			'after_widget' => '</div><div class="widgetfooter3"></div></div>',
			'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
			'after_title' => '</div></div><div class="widgetbody">',
			));
if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Sports Center Sidebar',
		'id' => 'sidebar-6',
		'description' => __('This widget area only displays on the Sports Center page and will only work if you have purchased the Sports Center add-on package.', 'sno'),
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));
if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Non-Home Sidebar',
		'id' => 'sidebar-1',
		'description' => __('This widget area only displays on non-home pages.  Use the other widget areas to display content on your home page.', 'sno'),
		'before_widget' => '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
		'after_widget' => '</div><div class="widgetfooter3"></div></div>',
		'before_title' => '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
		'after_title' => '</div></div><div class="widgetbody">',
		));

function sno_customize_register() {     
	global $wp_customize;
	$wp_customize->remove_panel( 'themes' );  
	$wp_customize->remove_section( 'custom_css' );
} 

add_action( 'customize_register', 'sno_customize_register', 1000 );

add_theme_support( 'post-thumbnails' );


add_action( 'after_setup_theme', 'sno_add_image_sizes' );
function sno_add_image_sizes() {
	add_image_size( 'carouselthumb', 122, 80, true ); 
	add_image_size( 'tsmediumblock', 240, 150, true );
	add_image_size( 'tsbigblock', 475, 300, true );
	add_image_size( 'small', 300);
}

if (is_admin()) {
	if (get_option('large_size_w') != 900) update_option('large_size_w', 900); 
	if (get_option('large_size_h') != 900) update_option('large_size_h', 900);

if (get_option('register_override') == '') {
	if (get_option('users_can_register') != "0") update_option('users_can_register', '0');
	if (get_option('comment_moderation') != "1") update_option('comment_moderation', '1');
}
	if (get_option('sticky_posts') != '') update_option('sticky_posts', '');
	include(TEMPLATEPATH."/tools/adminfunctions.php");

}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {
	global $post;
	$customlink=get_post_meta($post->ID, 'customlink', true);
	if ( is_single() ) { 
		$photolink = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
		$html = '<a id="single_image" href="' . $photolink[0] . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
		return $html;
	}	
	if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) 
		{ $photolink = $customlink; } 
	else 
		{ $photolink = get_permalink ($post_id); } 
	$html = '<a href="' . $photolink . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	return $html;

}

// turns a category ID to a Name
function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
		if ($id == $category->cat_ID) { return $category->cat_name; }
	}
	return;
}
// turns a category ID to a Slug
function cat_id_to_slug($id) {
	$slug = get_category_link( $id ); return $slug; 
}
// turns a page ID to a Name
function page_id_to_name($id) {
	if ($id == $page->page_ID) { return $page->page_name; }
	return;
}
if (get_option('qsno') == "qsno785643q") include(TEMPLATEPATH."/tools/quicklook/quickfunctions.php");
if (get_option('sno_audio') == 'on') include(TEMPLATEPATH."/tools/audio.php");

include(TEMPLATEPATH."/tools/trending.php");
include(TEMPLATEPATH."/tools/sno-slideshows.php");
include(TEMPLATEPATH."/tools/videowidget.php");
include(TEMPLATEPATH."/tools/videoembed.php");
include(TEMPLATEPATH."/tools/staffwidget.php");
include(TEMPLATEPATH."/tools/advertisement.php");
include(TEMPLATEPATH."/tools/categorywidget.php");
include(TEMPLATEPATH."/tools/carouselwidget.php");
include(TEMPLATEPATH."/tools/parallaxwidget.php");
include(TEMPLATEPATH."/tools/gridwidget.php");
include(TEMPLATEPATH."/tools/tagwidget.php");
include(TEMPLATEPATH."/tools/snotext.php");
include(TEMPLATEPATH."/tools/sportsscrollbox.php"); 
include(TEMPLATEPATH."/tools/snods.php");
$sccheck = get_option('ssno'); if ($sccheck == "ssno928462s") {
	include(TEMPLATEPATH."/tools/sportsschedule.php");
	include(TEMPLATEPATH."/tools/recentresults.php");
	include(TEMPLATEPATH."/tools/sportsstandingswidget.php"); 
}
$buscheck = get_option('bussno'); if ($buscheck == "bussno379657b") {
	include(TEMPLATEPATH."/tools/pagewidget.php"); 
}
$checkoptions = get_option('sno_analytics_options'); 
if (isset($checkoptions['sno_site_feedburner_code']) || get_theme_mod('feedburner')) { 	
	include(TEMPLATEPATH."/tools/enews.php");
}
include(TEMPLATEPATH."/tools/customizer.php");
include(TEMPLATEPATH."/tools/sno-mobile-data.php");
include(TEMPLATEPATH."/tools/grid/gridchapter-ajax.php");
include(TEMPLATEPATH."/tools/grid/gridchapter-refresh-ajax.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/snoflex/includes/mobile_detect.php');

add_theme_support( 'nav-menus' );
		
function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
			$content = get_the_content(' <a href="' . get_permalink() . '">Read More &raquo</a>', $stripteaser, $more_file);
			if (get_option('content_limit_filter') == 'yes') $content = apply_filters('the_content',$content);
			if (isset($_GET['p']) && strlen($_GET['p']) > 0) {
				$content = str_replace(']]>', ']]&gt;', $content);
				$content = strip_tags($content);
				$content = strip_shortcodes($content);
				echo "<p>";
				echo $content;
				echo "</p>";
			}
			else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
				$content = str_replace(']]>', ']]&gt;', $content);
				$content = strip_tags($content);
				$content = strip_shortcodes($content);
				$content = substr($content, 0, $espacio);
				echo "<p>";
				echo $content;
				echo "...";
				echo "</p>";
			}
			else {
				$content = str_replace(']]>', ']]&gt;', $content);
				$content = strip_tags($content);
				$content = strip_shortcodes($content);
				echo "<p>";
				echo $content;
				echo "</p>";
			}
}

function get_the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
			$o = '';
			$content = get_the_content('', $stripteaser, $more_file);
			if (get_option('content_limit_filter') == 'yes') $content = apply_filters('the_content',$content);
			$content = str_replace(']]>', ']]&gt;', $content);
			$content = strip_tags($content);
			$content = strip_shortcodes($content);
			if (isset($_GET['p']) && strlen($_GET['p']) > 0) {
				$o .= "<p>";
				$o .= $content;
				$o .= "</p>";
			}
			else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
				$content = substr($content, 0, $espacio);
				$o .= "<p>";
				$o .= $content;
				$o .= "...";
				$o .= "</p>";
			}
			else {
				$o .= "<p>";
				$o .= $content;
				$o .= "</p>";
			}
			return $o;
}

function snowriter() {
			global $post;
			$writers = get_post_meta($post->ID, 'writer', false); 
			$existing_bylines = sno_get_all_bylines();
			
			if (get_theme_mod('sp-jobtitle') == "Yes" && count($writers) == 1) {
				
					$transient_name = str_replace(' ', '_', $writers[0]); 
					$transient_name = str_replace("'", "", $transient_name);
					$transient_name = str_replace("\\", "", $transient_name);
					$transient_id = 'sno_sp_byline_jobtitle_' . $transient_name;
					$transient = get_transient( $transient_id );
														
					if( ! empty( $transient )) {  
						
						$jobtitle = $transient;
				
					} else {
						
						global $wpdb;
						
						$profile_name = stripslashes($writers[0]);
						$profile_name = str_replace( "'", "''", $profile_name );
						
						$querystr = "SELECT * FROM $wpdb->posts JOIN $wpdb->postmeta AS name ON($wpdb->posts.ID = name.post_id AND name.meta_key = 'name' AND name.meta_value = '$profile_name') AND $wpdb->posts.post_status = 'publish' ORDER BY post_date DESC LIMIT 1";
						
						$staffprofiles = $wpdb->get_results($querystr, OBJECT);
						
						if ($staffprofiles) { 
							foreach ($staffprofiles as $profile) {
								setup_postdata($profile);
								$jobtitle = get_post_meta($profile->ID, 'staffposition', true);
							} 
							set_transient( $transient_id, $jobtitle, YEAR_IN_SECONDS );
						} else {
							$jobtitle = get_post_meta($post->ID, 'jobtitle', true);
						}
						

					}
			} else {
				$jobtitle = get_post_meta($post->ID, 'jobtitle', true);
			}
			$staffpage = sno_staff_profile_link();
			if ($writers) {
				$count = count($writers); $i = 0; $names = ''; $title = '';
				if (($count == 1) && ($jobtitle)) $title = $jobtitle;

				foreach ($writers as $writer) {
					if (!empty($writer)) {
						if ($title) {
							$writer = trim ($writer);
							if (($staffpage && in_array($writer, $existing_bylines)) || ($staffpage && get_theme_mod('staffpage-require-profiles') != "Require")) {
								$names[] = '<a href="' . $staffpage . '?writer=' . rawurlencode($writer) . '">' . $writer . '</a>, ' . $title;
							} else {
								$names[] = $writer . ', ' . $title;
							}
						} else {
							$writer = trim ($writer);
							if (($staffpage && in_array($writer, $existing_bylines)) || ($staffpage && get_theme_mod('staffpage-require-profiles') != "Require")) {
								$names[] = '<a href="' . $staffpage . '?writer=' . rawurlencode($writer) . '">' . $writer . '</a>';
							} else {
								$names[] = $writer;
					
							}
						}
					}
				}
				
				$count = count($names); $i = 0; $o = '';
				if ($names) foreach ($names as $name) {
					$i++; 
					$name = trim ($name);
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

function sno_photographer($wrap) {
			global $post;
			$imageid = get_post_meta($post->ID, '_thumbnail_id', true); 
			$photographer = get_post_meta($imageid, 'photographer', true);
			$oldphotographer = get_post_meta($post->ID, 'photographer', true);
			$pretext = get_theme_mod('story-photo-credit');

			if ($photographer == "") $photographer = $oldphotographer;

			if ($photographer) {

				$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
				$queried_posts = get_posts( $args );
				if ($queried_posts) {
					foreach ($queried_posts as $queried_post) {
						$thePostID = $queried_post->ID;
						$link = get_permalink($thePostID);
						if ($wrap == "false") { echo '<span class="photocredit"> ('; } else if ($wrap == "carousel") { echo ' | Photo by '; } else { echo '<p class="photocredit">'; }
							if ($wrap != "carousel" && $pretext) echo $pretext . ' ';
							echo '<a href="' . sno_staff_profile_link() . '?writer=' . rawurlencode($photographer) . '">';
							echo $photographer. '</a>';
							if ($wrap == "false") { echo ')</span>'; } else if ($wrap == "carousel") { } else { echo '</p>'; } 
					}
				} else {
					if ($wrap == "false") { echo '<span class="photocredit"> ('; } else if ($wrap == "carousel") { echo ' | Photo by '; } else { echo '<p class="photocredit">'; }
					if ($wrap != "carousel" && $pretext) echo $pretext . ' ';
					echo $photographer;
					if ($wrap == "false") { echo ')</span>'; } else if ($wrap == "carousel") { } else { echo '</p>'; } 
				}
			}
}
function get_sno_photographer($wrap) {
			global $post; $o = '';
			$imageid = get_post_meta($post->ID, '_thumbnail_id', true); 
			$photographer = get_post_meta($imageid, 'photographer', true);
			$oldphotographer = get_post_meta($post->ID, 'photographer', true);
			$pretext = get_theme_mod('story-photo-credit');

			if ($photographer == "") $photographer = $oldphotographer;

			if ($photographer) {

				$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
				$queried_posts = get_posts( $args );
				if ($queried_posts) {
					foreach ($queried_posts as $queried_post) {
						$thePostID = $queried_post->ID;
						$link = get_permalink($thePostID);
						if ($wrap == "false") { $o .= '<span class="photocredit"> ('; } else if ($wrap == "carousel") { $o .= ' | Photo by '; } else { $o .= '<p class="photocredit">'; }
							if ($wrap != "carousel" && $pretext) $o .= $pretext . ' ';
							$o .= '<a href="' . sno_staff_profile_link() . '?writer=' . rawurlencode($photographer) . '">';
							$o .= $photographer. '</a>';
							if ($wrap == "false") { $o .= ')</span>'; } else if ($wrap == "carousel") { } else { $o .= '</p>'; } 
					}
				} else {
					if ($wrap == "false") { $o .= '<span class="photocredit"> ('; } else if ($wrap == "carousel") { $o .= ' | Photo by '; } else { $o .= '<p class="photocredit">'; }
					if ($wrap != "carousel" && $pretext) $o .= $pretext . ' ';
					$o .= $photographer;
					if ($wrap == "false") { $o .= ')</span>'; } else if ($wrap == "carousel") { } else { $o .= '</p>'; } 
				}
			}
			
			return $o;
}

function sno_slideshow_photographer($imageid) {
	global $post;
	$photographer = get_post_meta($imageid, 'photographer', true);
	$pretext = get_theme_mod('story-photo-credit');
	$photog = '';
	if ($photographer) {
		$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
		$queried_posts = get_posts( $args );
		if ($queried_posts) {
			foreach ($queried_posts as $queried_post) {
				$thePostID = $queried_post->ID;
				$link = get_permalink($thePostID);
				$photog .= ' (';
					if ($pretext) $photog .= $pretext . ' ';
					$photog .= '<a href="' . sno_staff_profile_link() . '?writer=' . rawurlencode($photographer) . '">' .$photographer. '</a>)';
}
} else if ($photographer) {
	$photog .= ' (';
		if ($pretext) $photog .= $pretext . ' ';
		$photog .= $photographer . ')';
}
}
return $photog;
}

function sno_sfi_photographer($imageid) {
	global $post;
	$photographer = get_post_meta($imageid, 'photographer', true);
	$pretext = get_theme_mod('story-photo-credit');
	$photog = '';
	if ($photographer) {
		$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
		$queried_posts = get_posts( $args );
		if ($queried_posts) {
			foreach ($queried_posts as $queried_post) {
				$thePostID = $queried_post->ID;
				$link = get_permalink($thePostID);
					$photog .= '<div class="photocredit">';
					if ($pretext) $photog .= $pretext . ' ';
					$photog .= '<a href="' . sno_staff_profile_link() . '?writer=' . rawurlencode($photographer) . '">' .$photographer. '</a></div>';
			}
		} else if ($photographer) {
			$photog .= "<div class='photocredit'>";
			if ($pretext) $photog .= $pretext . ' ';
			$photog .= $photographer . '</div>';
		}
	}
	return $photog;
}

function sno_videographer($classname) {
	global $post;
	$videographers = get_post_meta($post->ID, 'videographer', false); 
	$staffpage = sno_staff_profile_link();
	$count = count($videographers); $i = 0;

	foreach ($videographers as $videographer) {
		if ($staffpage) {	
			$names[] = '<a href="' . $staffpage . '?writer=' . rawurlencode($videographer) . '">' .$videographer. '</a>';
		} else {
			$names[] = $videographer;
		}
	}
	$count = count($names); $i = 0;
	if ($names) foreach ($names as $name) {
		$i++;
		if ($i == 1) echo '<p class="videocredit ' . $classname . '">';
		if ($count == 1) {
			echo $name . '</p>';
		} else if (($count == 2) && ($i == 1)) {
			echo $name . ' and ';
		} else if ($i == $count) {
			echo $name . '</p>';
		} else if ($i < $count - 1) {
			echo $name . ', ';	
		} else if ($i < $count) {
			echo $name . ', and ';
		}
	}
}

function sno_slideshow_credit($classname) {
	global $post;
	$videographers = get_post_meta($post->ID, 'slideshowcredit', false); 
	$count = count($videographer); $i = 0;

	foreach ($videographers as $videographer) {
		$i++; 
		$args = array( 'meta_key' => 'name', 'meta_value' => $videographer, 'numberposts' => 1 );
		$queried_posts = get_posts( $args );
		if ($queried_posts) {
			foreach ($queried_posts as $queried_post) {
				$thePostID = $queried_post->ID;
				$link = get_permalink($thePostID);
				$names[] = '<a href="' . sno_staff_profile_link() . '?writer=' . rawurlencode($videographer) . '">' .$videographer. '</a>';
			}
		} else {
			$names[] = $videographer;
		}
	}
	$count = count($names); $i = 0;
	if ($names) foreach ($names as $name) {
		$i++;
		if ($i == 1) echo '<p class="videocredit ' . $classname . '">';
		if ($count == 1) {
			echo $name . '</p>';
		} else if (($count == 2) && ($i == 1)) {
			echo $name . ' and ';
		} else if ($i == $count) {
			echo $name . '</p>';
		} else if ($i < $count - 1) {
			echo $name . ', ';	
		} else if ($i < $count) {
			echo $name . ', and ';
		}
	}
}

function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('my-account-with-avatar');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('appearance');
	$wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function my_admin_bar_menu() {
	global $wp_admin_bar;
	$sno_attribution = get_option('sno_analytics_options');
	if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
		$terms_url = "https://boostingblue.com/terms-of-use/";
	} else {
		$terms_url = "https://snosites.com/terms-of-service/";
	}
	if ( !is_user_logged_in() || !is_admin_bar_showing() )
		return;
	if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {

		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu',
			'title' => __( 'Quick Links'),
			'href' => admin_url('/' ) ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'add_story',
			'parent' => 'custom_menu',
			'title' => __( 'Add a Story'),
			'href' => admin_url('/post-new.php?custom-write-panel-id=1') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_widgets',
			'parent' => 'custom_menu',
			'title' => __( 'Customize Live'),
			'href' => admin_url('/customize.php?return=%2Fwp-admin') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_widgets_classic',
			'parent' => 'custom_menu',
			'title' => __( 'Widget Control Panel'),
			'href' => admin_url('/widgets.php') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_menus',
			'parent' => 'custom_menu',
			'title' => __( 'Edit Navigation Menus'),
			'href' => admin_url('/nav-menus.php') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'design_options',
			'parent' => 'custom_menu',
			'title' => __( 'Design Options'),
			'href' => admin_url('/themes.php?page=theme-options') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_help',
			'title' => __( 'Boosting Blue Support'),
			'href' => 'https://sno.zendesk.com/hc/en-us' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_tos',
			'title' => __( 'Terms of Use'),
			'meta' => array( 'target' => '_blank' ),
			'href' => $terms_url ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'instructions',
			'parent' => 'custom_menu_help',
			'title' => __( 'Instructions and Tutorials'),
			'meta' => array( 'target' => '_blank' ),
			'href' => 'https://sno.zendesk.com/hc/en-us' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'support',
			'parent' => 'custom_menu_help',
			'title' => __( 'Submit a Support Ticket'),
			'meta' => array( 'target' => '_blank' ),
			'href' => 'https://sno.zendesk.com/hc/en-us/requests/new' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_logout',
			'title' => __( 'Logout'),
			'href' => wp_logout_url( home_url() ) ) );
	} else {
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu',
			'title' => __( 'SNO Launch Pad'),
			'href' => admin_url('/index.php?page=sno-launch-pad' ) ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'add_story',
			'parent' => 'custom_menu',
			'title' => __( 'Add a Story'),
			'href' => admin_url('/post-new.php?custom-write-panel-id=1') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_widgets',
			'parent' => 'custom_menu',
			'title' => __( 'Customize Live'),
			'href' => admin_url('/customize.php?return=%2Fwp-admin') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_widgets_classic',
			'parent' => 'custom_menu',
			'title' => __( 'Widget Control Panel'),
			'href' => admin_url('/widgets.php') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'edit_menus',
			'parent' => 'custom_menu',
			'title' => __( 'Edit Navigation Menus'),
			'href' => admin_url('/nav-menus.php') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'design_options',
			'parent' => 'custom_menu',
			'title' => __( 'Design Options'),
			'href' => admin_url('/themes.php?page=theme-options') ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_help',
			'title' => __( 'SNO Support'),
			'href' => 'https://sno.zendesk.com/hc/en-us' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_tos',
			'title' => __( 'Terms of Use'),
			'meta' => array( 'target' => '_blank' ),
			'href' => $terms_url ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'instructions',
			'parent' => 'custom_menu_help',
			'title' => __( 'SNO Instructions and Tutorials'),
			'meta' => array( 'target' => '_blank' ),
			'href' => 'https://sno.zendesk.com/hc/en-us' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'support',
			'parent' => 'custom_menu_help',
			'title' => __( 'Submit a Support Ticket'),
			'meta' => array( 'target' => '_blank' ),
			'href' => 'https://sno.zendesk.com/hc/en-us/requests/new' ) );
		$wp_admin_bar->add_menu( array(
			'id' => 'custom_menu_logout',
			'title' => __( 'Logout'),
			'href' => wp_logout_url( home_url() ) ) );
	}
}
add_action('admin_bar_menu', 'my_admin_bar_menu'); 

function sno_dashboard_widget() {
	$sno_attribution = get_option('sno_analytics_options');
	if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
		echo '<div class="alignright browser-icon"><a href="https://boostingblue.com"><img src="/wp-content/themes/snoflex/images/boostingblue.png" style="width:205px;" alt="Boosting Blue Logo" /></a></div>';
		?><br />
		<p style="margin-top:3px"><?php
		$theme_data = wp_get_theme();
		echo $theme_data['Name']; ?> Version <?php
		echo $theme_data['Version']; 
		echo ' <a href="/wp-admin/themes.php?page=theme-options">' . get_option('sno_preset') . ' Design Option</a>';
		?>
		<br />Powered by WordPress Version <?php bloginfo('version'); ?></p>
		<p style="font-size:16px;margin:0px;"><a target="_blank" href="https://sno.zendesk.com/hc/en-us">Instruction Manual</a></p>
		<p style="font-size:16px;margin:0px;"><a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">Submit a Support Request</a></p>
		<?php
	} else {
		echo '<div class="alignright browser-icon"><a href="https://snosites.com"><img src="/wp-content/themes/snoflex/images/sno205.png" style="width:205px;" alt="SNO Logo" /></a></div>';
	
		include_once( ABSPATH . WPINC . '/feed.php' );
		$rss = fetch_feed('http://customers.snosites.com/feed/'); // specify feed url
		
		if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
	
			// Figure out how many total items there are, but limit it to 2. 
			$maxitems = $rss->get_item_quantity( 2 ); 
	
			// Build an array of all the items, starting with element 0 (first element).
			$rss_items = $rss->get_items( 0, $maxitems );
	
		endif;
	
		if (!empty($rss_items)) :
			foreach ($rss_items as $item) :
				
				echo '<a style="font-size:15px;line-height:22px;" href="';
					echo esc_url($item->get_permalink());
					echo '">';
					
				echo esc_html($item->get_title());
				
				echo '</a><br /><span style="margin-left:5px;font-size:10px;color:#666666;">';
					echo esc_html($item->get_date("j F Y | g:i a"));
					echo '</span><br />';
			
				echo "<p style='margin-top:3px;font-size:14px;line-height:20px'>";
					echo sno_rss_feed(esc_html(strip_tags($item->get_content()))); 
					echo "...&nbsp;<a href='";
						echo esc_url($item->get_permalink());
						echo "'>Read More</a>";
					echo '</p>';	
				
				echo '<br /><br />';
			endforeach;
		endif; ?>
		
		<br />
		<p style="font-size:16px;margin:0px;">About This Site</p>
		<p style="margin-top:3px"><?php
		$theme_data = wp_get_theme();
		echo $theme_data['Name']; ?> Version <?php
		echo $theme_data['Version']; 
		echo ' <a href="/wp-admin/themes.php?page=theme-options">' . get_option('sno_preset') . ' Design Option</a>';
		?>
		<br />Powered by WordPress Version <?php bloginfo('version'); ?></p>
		<p style="font-size:16px;margin:0px;"><a target="_blank" href="https://sno.zendesk.com/hc/en-us">Instruction Manual</a></p>
		<p style="font-size:16px;margin:0px;"><a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">Submit a Support Request</a></p>
		<?php
	}
		
} 

	function sno_rss_feed($content) {
		$content = apply_filters('the_content', $content); 
		$content = str_replace(']]>', ']]&gt;', $content); 
		$content = strip_tags($content);
		if ((strlen($content)>350) && ($espacio = strpos($content, " ", 350 ))) {
			$content = substr($content, 0, $espacio); $content = $content;
		}
		return $content;
	}
	
	add_action('wp_dashboard_setup', 'sno_add_dashboard_widgets' );

	function sno_add_dashboard_widgets() {
		$sno_attribution = get_option('sno_analytics_options');
		if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			wp_add_dashboard_widget('sno_announcements', 'About This Site', 'sno_dashboard_widget');
			global $wp_meta_boxes;
			$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
			$sno_widget_backup = array('sno_announcements' => $normal_dashboard['sno_announcements']);
			unset($normal_dashboard['sno_announcements']);
			$sorted_dashboard = array_merge($sno_widget_backup, $normal_dashboard);
			$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		} else {
			wp_add_dashboard_widget('sno_announcements', 'News & Announcements from SNO', 'sno_dashboard_widget');
			global $wp_meta_boxes;
			$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
			$sno_widget_backup = array('sno_announcements' => $normal_dashboard['sno_announcements']);
			unset($normal_dashboard['sno_announcements']);
			$sorted_dashboard = array_merge($sno_widget_backup, $normal_dashboard);
			$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;			
		}
	} 
	$sno_attribution = get_option('sno_analytics_options');
	function sno_custom_login_logo() {
		$sno_attribution = get_option('sno_analytics_options');
		if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			echo '<style type="text/css">
			h1 a { width: 250px !important;background-image: url(/wp-content/themes/snoflex/images/boostingblue.png) !important; background-size:205px auto !important; height: 105px !important;}
			</style>';
		} else if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "None") {
			
		} else {
			echo '<style type="text/css">
			h1 a { width: 250px !important;background-image: url(/wp-content/themes/snoflex/images/sno205.png) !important; background-size:205px 90px !important; }
			</style>';
		}
	}
	add_action('login_head', 'sno_custom_login_logo',9);
	function sno_loginpage_custom_link() {
		$sno_attribution = get_option('sno_analytics_options');
		if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			return 'https://boostingblue.com';			
		} else if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "None") {
			return;
		} else {
			return 'https://snosites.com';
		}

	}
	add_filter('login_headerurl','sno_loginpage_custom_link');
	function sno_change_title_on_logo() {
		$sno_attribution = get_option('sno_analytics_options');
		if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			return 'Hosting and Support by Boosting Blue';
		} else if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "None") {
			return;
		} else {
			return 'FLEX WordPress theme from School Newspapers Online';
		}
	}
	add_filter('login_headertitle', 'sno_change_title_on_logo');

	function sno_login_message( $message ) {
		$sno_attribution = get_option('sno_analytics_options');
		if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			$terms_url = "https://boostingblue.com/terms-of-use/";
		} else {
			$terms_url = "https://snosites.com/terms-of-service/";
		}
    	if ( empty($message) ){
       		return "<div class='message'><p><strong>By logging in to this site, you agree to the <a href='$terms_url' target='_blank'>Terms of Use</a>.</strong></p></div>";
    	} else {
	    	$message .= "<div class='message'><p><strong>By logging in to this site, you agree to the <a href='$terms_url' target='_blank'>Terms of Use</a>.</strong></p></div>";
	    	return $message;
    	}
	}
	add_filter( 'login_message', 'sno_login_message' );

	function sno_css() {
		$favicon = get_theme_mod('favicon'); if (is_ssl()) $favicon = str_replace("http://", "https://", $favicon);
		echo '<link rel="Shortcut Icon" href="'.$favicon.'" type="image/x-icon" />   
		<style type="text/css">
		#categorydiv, #postimagediv, #tagsdiv-post_tag, #sno_format_meta_box_id, #sno_teaser_meta_box_id { display:block !important; }
		#sno_announcements h3 { background:#990000; color:#ffffff;text-shadow:none;}
		#sno_announcements {border-color:#990000; -moz-box-shadow: 1px 1px 5px #888; -webkit-box-shadow: 1px 1px 5px #888; box-shadow: 1px 1px 5px #888;}
		#sno_announcements a {color:#990000;}
		#sno_announcements a:hover {color:#990000;text-decoration:underline;}
		.sno_options_page .postbox {border: 1px solid #777777; -moz-box-shadow: 1px 1px 5px #888; -webkit-box-shadow: 1px 1px 5px #888; box-shadow: 1px 1px 5px #888; }   
		.sno_options_page h3, .sno_options_page h3:hover { background:#777777; color:#ffffff;text-shadow:none;cursor:default;}
		.sno_options_page .divline {clear:both;border-top:1px solid #888888;margin:25px 0px;}
		.sno_options_page p {margin: 0 0 1em 0}
		#snocolorpicker { position:fixed;border:1px solid #ddd;background:#fff;}
		.savebutton { margin-top:220px; margin-left:20px;}
		input.save-button { position:fixed;margin-top:240px;margin-left:15px;font-size:18px!important;}
		.optionsboxwrap {width:270px;float:left;}
		.optionsbox {padding:10px;background:#ffffff;width:260px;float:left;}
		.optionsboxright {padding:10px;background:#eee;width:260px;float:right;}
		.optionsboxwidgets {width:318px;margin-top:10px;border:1px solid #bbb;padding:10px 10px 0px;background:#eee;float:right;}
		.optionsboxdetail {padding:10px;background:#eee;margin-top:10px;}
		.optionsboxwide {padding:10px;background:#eee;margin-top:10px;}
		.optionsboxbase {float:left;width:250px;}
		.optionsboxextra {float:right;width:250px;}
		.headingtext { font-weight:bold;font-size:14px;}
		.subheadingtext { font-weight:bold;font-size:14px;margin-top:5px;margin-bottom:5px !important;}
		.subheadlabel { font-weight:bold;font-size:14px;margin-top:15px!important;margin-bottom:5px !important;}
		.subdivider { width:100%; margin-top:20px;margin-bottom:15px;border-top:1px solid #fff;}
		.glossymenu { margin: 5px 0; padding: 0; }
		.glossymenu a.menuitem { background: #bbb; font: 18px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif; color: #333; display: block; position: relative; width: auto; padding: 6px 0; padding-left: 10px; text-decoration: none; border-bottom:1px solid #fff;}
		.glossymenu a.menuheader { background: #393939; font: 18px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif; color: white; display: block; position: relative; width: auto; padding: 6px 0; padding-left: 10px; text-decoration: none; border-bottom:1px solid #888;}
		.glossymenu a.menuitem .statusicon{ margin-right:10px; border: none; width:17px;}
		.glossymenu a.menuheader .statusicon{ margin-right:10px; border: none; width:17px;}
		.glossymenu a.menuitem:hover { background:#990000; color: #fff; }
		.glossymenu a.menuheader:hover { background:#990000; }
		.glossymenu div.submenu{ padding:10px 10px 10px 10px; background: #fff; }
		.glossymenu a.options_open { background: #990000; color: #fff;}
		.glossymenu .mainbar a.options_open { background: #000000 !important; color:#fff; }
		.glossymenu a.options_open:hover { background: #393939 !important; }
		.mf-field-related, #mfattributespost {display:none !important;}
		.ure-sidebar, #ure_pro_advertisement, #ws_sidebar_pro_ad {display:none !important;}
		#ure_container {min-width:0px !important;}
		 #current-theme img {border: #fff !important;}
		 #adminmenu li.wp-menu-separator { background: #888 !important;}
		.snomessage { background: #990000 !important; color: #ffffff; border: #6d0019 !important; }
		.snomessage a, .snomessage a:hover { color: #fff;text-decoration:none; }
		a.flexupdate { text-decoration:underline!important;}
		a:hover.flexupdate { color: #D29105!important; }
		.welcome_tile_link:hover { background: #990000 !important; }
		.welcome_tile { padding:10px;float:left;width:280px;height:180px;margin:0px 3px 3px 0px; color: #fff; }
		.welcome_tile_ad { float:left;width:300px;height:200px;margin:0px 3px 3px 0px; overflow:hidden;}
		.welcome_tile h1 { margin:0px 0px 15px 0px;color:#fff; }
		.welcome_text { font-size:20px;line-height:30px; }
		table.form-table { margin-bottom: 30px; }
		.yoast-ga-banners {display:none;}
		a#customdimensions-tab, a#extensions-tab, a#licenses-tab { display: none; }
		.yoast-ga-content #extensions {display:none; }
		.restoredesign { background: #db4654; padding: 0px 10px; float:right; color: #fff;}
		.restoredesign:hover { cursor: pointer; background: #fe5767;}
		.restoresnapshot { background: #35aa1c; padding: 0px 10px; float:right; color: #fff; margin-left: 10px;}
		.restoresnapshot:hover { cursor: pointer; background: #53bd3c;}
		.restoredesignrow { background: #eee; width: 96%; clear:both; line-height: 24px; font-size:13px; padding: 7px 2%; border-bottom: 1px solid #ccc; }
		.restoresnapshotrow { background: #eee; width: 98.5%; clear:both; line-height: 24px; font-size:13px; padding: 7px .75%; border-bottom: 1px solid #ccc; }
		.restorestarred { color: #ff9308; float:right; margin-right:10px;cursor: pointer; }
		.restorestarred:hover { color: #ffbe00; }
		.restorename { float:right; margin-right:10px; position: relative; }
		.restore-name { float:left; margin-right: 10px; width: 104px; font-size:10px; border: 1px solid #ccc; }
		.restorename:hover { cursor:pointer; }
		.snapshot-name { float:left; margin-right: 10px; width: 150px; font-size:10px; border: 1px solid #ccc; }
		.restore-name-instructions { position: absolute; left: 1px; top: 20px; width: 100px; font-size:8px; background: #666; color: #fff; line-height:10px; padding:2px; display: none; }
		.restore-name-snapshot-instructions { position: absolute; left: 1px; top: 20px; width: 146px; font-size:8px; background: #666; color: #fff; line-height:10px; padding:2px; display: none; }
		.snapshot-orange { color: #ff9308; }
		.tag-icon-save { color: #35aa1c; }
		.tag-icon-save:hover { color: #53bd3c; }
		.restorelistbutton { background: #ff9308; color: #fff; float:right; margin-left:10px; padding: 2px 7px; cursor: pointer; }
		.restorelistbutton:hover { background: #ffbe00; }
		.restorelisticon { color: #ff9308; float:right; margin-left: 10px; cursor:pointer; }
		.restorelisticon:hover { color: #ffbe00; }
		.restorecontrols { padding: 10px 2%; background: #000; color: #fff; width: 96%;}
		#restoredesignlist { max-height:300px; overflow-y:scroll; }
		.create_snapshot { background: #ff9308; color: #fff; padding: 10px; font-size:24px; float:right;margin-bottom:0px; cursor: pointer; }
		.create_snapshot:hover { background: #ffbe00; }
		.deletesnapshot { color: #db4654; float: right; margin-left: 10px; cursor: pointer;}
		.deletesnapshot:hover { color: #fe5767; } 
		.designsnapshotintro { background: #fff; border: 1px solid #ddd; padding: 10px; margin-bottom:20px;}
		@media only screen and (max-width: 1100px) { .extratext { display:none; }}
		.not_the_right_area { padding: 10px; }
		.litespeed-widget-setting { display:none; }
		#menu_icons-logger-notification, #menu_icons_review { display: none; }
		.am-notification { display:none; }
		.snods_badges a, .snods_badges a:visited, .snods_header a, .snods_header a:hover { color: #fff !important; cursor:pointer;}
		.snods_badges a:hover, .snods_header a:hover {text-decoration: none;}
		.snods_badge_top { border-top:1px solid #444; }
		.snods_badge { background: #000; color: #fff; padding:5px 5px 5px 8px; border-bottom:1px solid #444; font-size:16px;}
		.snods_badge:hover { opacity:.9; }
		.snods_coverage:hover {background: #2673e6 !important;}
		.snods_site:hover {background: #9e73d5 !important;}
		.snods_story:hover {background: #6bc651 !important;}
		.snods_writing:hover {background: #e78501 !important;}
		.snods_media:hover {background: #37a7e3 !important;}
		.snods_audience:hover {background: #f35407 !important;}
		.snods_icon { max-width:25%;width:40px; float:right; text-align:right; }
		.snods_title { max-width:75%; float:left; }
		.snods_coverage_icon { font-size:18px;vertical-align:top;text-decoration:none!important; }
		.snods_site_icon { font-size:24px;vertical-align:top;text-decoration:none!important;margin-top:-3px; }
		.snods_story_icon {font-size:23px;margin-top:-1px;vertical-align:top;text-decoration:none!important;padding-right:1px;}
		.snods_writing_icon {font-size:22px;vertical-align:top;text-decoration:none!important;margin-top:-2px;margin-bottom:-2px;}
		.snods_media_icon {font-size:22px;vertical-align:top;text-decoration:none!important;margin-top:-1px;margin-bottom:-1px;}
		.snods_audience_icon {font-size:26px;margin-top:-4px;vertical-align:top;text-decoration:none!important;padding-right:3px;}
		.snods_badge_icon_only { text-align: center; height:39px;}
		.snods_badge_icon_only .snods_icon_only { font-size:23px; text-decoration:none; padding-top:10px; width:40px;}
		.snods_badge_icon_only { background: #000; color: #fff; }
		p.snods_p { padding: 2px 0 0 0; color: #fff; margin-left:10px; }
		p.snods_p a { color: #fff; }
		p.snods_p a:hover { color: #ddd; }
		.menu-icons-upgrade-hestia, .menu-icons-subscribe {display: none; }
		
		.profile_year { background: #eee; border: 1px solid #aaa; padding: 10px 0; text-align: center; width: calc(100% - 2px); margin-bottom: 15px; cursor:pointer; height: 20px; max-height: 20px; }
		.profile_name { background: #fff; border: 1px solid #666; padding: 10px 0; text-align: center; width: calc(100% - 2px); margin-bottom: 10px; cursor:move; height: 20px; max-height: 20px; }
		.profile_role { background: #fff; border: 1px solid #000; padding: 10px 0; text-align: center; width: calc(100% - 2px); margin-bottom: 10px; cursor:move; height: 20px; max-height: 20px; }
		.ui-sortable-helper { background: #eee; border: 1px solid #000099; height: 10px;}
		.profile_placeholder { background: #aaa; padding: 10px 0; text-align: center; width: 100%; margin-bottom: 10px; cursor:move; border-top: 1px solid aaa; border-bottom: 2px solid #aaa;}
		.staffpages_list_wrap { width: 15%; float: left; }
		.staffposition_list_wrap, .profile_list_wrap { width: 47%; float: left; }
		.staffposition_list_wrap { background: #444;  border-right: 1px solid #fff; }
		.staffpages_list_wrap { margin-right: 15px; }
		.staff_members_list_wrap { width: 33%; float: left; }
		.staffposition_list_wrap { width: calc(47% - 30px); padding: 15px 30px; }
		.profile_list_wrap { padding: 15px; background: #ccc; }
		.list_staff_members { text-align: right; padding-right: 10px; float: right; color: #000; font-size: 26px; margin-top: -3px; cursor: pointer; }
		li.year-selected { padding-right: 15px; background: #444; border-color: #444; color: #fff;  }
		li.role-selected { padding-right: 32px; background: #ccc; border-color: #fff; color: #000; }
		.rolesavailable { padding-top: 15px; }
		.pagesavailable { margin-top: 0;  }
		.profilesavailable { padding: 15px; }
		.staffpage-options { background: #444; float: left; width: calc(85% - 15px); display: flex; }
		.staffoptions-hidden { background: #fff; }
		.staffmove { color: #666; float: left; font-size: 26px; margin-top: -3px; }
		.staffprofilepage { background: #fff; border: 1px solid #ddd; padding: 15px; margin-bottom:20px;}
		.staffpage_wrap { display: flex; }
		.snoprofile-alert a, .snoprofileadjust-alert a { color: #fff; text-decoration: underline; }
		.activate-mini-profiles { margin-left: 30px; float: right; background: #35aa1c; color: #fff; padding: 5px 10px; font-size:16px; line-height: 20px; cursor: pointer; }
		.activate-mini-profiles:hover { background: #53bd3c; }
		.snoprofile-alert, .snoprofileadjust-alert { border:none;background: #000;color: #fff;padding:0px;padding: 10px 0 10px 10px; }
		.applycolor { display:none;float:left; padding: 5px; margin-left: 20px; background: #35aa1c; color: #ffffff; cursor: pointer; }
		.applycolor:hover { background: #53bd3c; }
		.colorlistitem { margin-bottom: 10px; }
		.colorlistbox { width: 200px; float:left; height: 33px; }
		#colorlist { margin-left: 225px; }
		.colorinfo-instances { vertical-align: middle; cursor: pointer; position: relative; float: right; padding-top: 4px; }
		.color-use-info { background: #000; color: #fff; border-radius: 5px; padding: 10px; font-size: 12px; font-family: sans-serif; position: absolute; bottom: 27px; width: 332px; right: -153px;}
		#welcome-panel { display:none; }
		#classic-editor-switch-editor { display: none; }
		table.posts td.column-title .row-actions span:nth-child(1) { display: none; }
		table.pages td.column-title .row-actions span:nth-child(1) { display: none; }
		// workpoint
		
		.snoupdate {
			-moz-box-shadow:inset 0px 1px 0px 0px #fed897;
			-webkit-box-shadow:inset 0px 1px 0px 0px #fed897;
			box-shadow:inset 0px 1px 0px 0px #fed897;
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6b33d), color-stop(1, #d29105) );
			background:-moz-linear-gradient( center top, #f6b33d 5%, #d29105 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#f6b33d", endColorstr="#d29105");
			background-color:#f6b33d;
			-moz-border-radius:4px;
			-webkit-border-radius:4px;
			border-radius:4px;
			border:3px solid #f0ddbb;
			display:inline-block;
			color:#ffffff;
			font-family:arial;
			font-size:20px;
			font-weight:bold;
			padding:9px 18px !important;
			text-decoration:none;
			text-shadow:1px 1px 0px #cd8a15;
		}.snoupdate:hover {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #d29105), color-stop(1, #f6b33d) );
			background:-moz-linear-gradient( center top, #d29105 5%, #f6b33d 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#d29105", endColorstr="#f6b33d");
			background-color:#d29105;
		}.snoupdate:active {
			position:relative;
			top:1px;
		}
		.snomessage .aa_a {
			float:right;
			width:156px;
			margin-top:2px;
			height:57px;
		}
		.snomessage, #message {
			overflow: hidden;
			position: relative;
			padding-right:4px !important;
		}
		.wpp-notice { display:none !important; }
		</style>';
		if (get_option('ssno') != "ssno928462s") {
			echo '<style type="text/css">
			.mf-field-story_sport, .mf-menu-standings, .mf-menu-athlete-roster, .mf-menu-game-scheduler, #sidebar-6 {display:none !important;}
			</style>';
		}
		if (get_option('asno') != "asno836158a") { 
			echo '<style type="text/css">
			.mf-field-teasertitle {display:none !important;}
			.mf-field-teaser {display:none !important;}
			.mf-field-grade {display:none !important;}
			.mf-field-showratings {display:none !important;}
			#gdsr-meta-box-mur {display:none !important;}
			#gdsr-meta-box {display:none !important;}
			</style>';
		}
		if (get_theme_mod('sp-jobtitle') == "Yes") echo '<style type="text/css">.mf-field-jobtitle {display:none !important;}</style>';
		if (get_theme_mod('top-stories-links') == "") echo '<style type="text/css">.mf-field-customlink {display:none !important;}</style>';
		$sno_story_panel_override = get_option('sno_story_panel');
		if ($sno_story_panel_override) { 
			$sno_story_panel = $sno_story_panel_override;
		} else {
			$sno_story_panel = '1';	
		}
		$sno_staff_panel_override = get_option('sno_staff_panel');
		if ($sno_staff_panel_override) { 
			$sno_staff_panel = $sno_staff_panel_override;
		} else {
			$sno_staff_panel = '2';	
		}
		global $post; if (isset($post) && $post) { $story_panel_id = ''; $story_panel_id = get_post_meta($post->ID, '_mf_write_panel_id', true); }

		if (!strstr($_SERVER['REQUEST_URI'], "custom-write-panel-id=$sno_story_panel")) {
			if ( isset ($story_panel_id) && $story_panel_id != "$sno_story_panel") {
				echo '<style type="text/css">
				#sno_format_meta_box_id {display:none !important;}
				#sno_teaser_meta_box_id {display:none !important;}
				</style>';
			}
		}

		if ((strstr($_SERVER['REQUEST_URI'], "custom-write-panel-id=$sno_story_panel")) || (strstr($_SERVER['REQUEST_URI'], "custom-write-panel-id=$sno_staff_panel")) || (strstr($_SERVER['REQUEST_URI'], "post_type=ads"))) {} else {
			if ( isset ($story_panel_id) && ($story_panel_id != "$sno_story_panel") && ($story_panel_id != "$sno_staff_panel")) {
				echo '<style type="text/css">
				#postimagediv {display:none !important;}
				</style>';
			}
		}

		$snoadmin = get_user_by('login', 'snoadmin'); if ($snoadmin) $snoadmin_id = $snoadmin->ID;
		$admin = get_user_by('login', 'admin'); if ($admin) $admin_id = $admin->ID;
		global $current_user;
		wp_get_current_user();
		$sno_user_name = $current_user->user_login;
		if ($sno_user_name != 'snoadmin' && $sno_user_name != 'admin') {
			echo '<style type="text/css">
			#user-' . $snoadmin_id . ', #user-' . $admin_id . ' {display:none;}
			#wpbody #siteurl, #wpbody #home, #toplevel_page_MagicFieldsMenu, #users_can_register {display:none;}
			</style>';
		}

		if (strstr($_SERVER['REQUEST_URI'], "options-media.php") && $sno_user_name != 'snoadmin' && $sno_user_name != 'admin') {
				echo '<style type="text/css">
				.wrap {display:none !important;}
				</style>';
		}
		if (strstr($_SERVER['REQUEST_URI'], "options-writing.php") && $sno_user_name != 'snoadmin' && $sno_user_name != 'admin') {
				echo '<style type="text/css">
				.wrap {display:none !important;}
				</style>';
		}

	}

	add_action('admin_head', 'sno_css');

	function sno_admin_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('sno-upload', '/wp-content/themes/snoflex/tools/sno-script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('sno-upload');
	//	wp_enqueue_script('jquery.js');
	}

	function sno_admin_styles() {
		wp_enqueue_style('thickbox');
	}

	if (isset($_GET['page']) && $_GET['page'] == 'theme-options') {
		add_action('admin_print_scripts', 'sno_admin_scripts');
		add_action('admin_print_styles', 'sno_admin_styles');
	}

	// adding color picker to sno master color page
	if (isset($_GET['page']) && $_GET['page'] == 'master_colors') {
		add_action('admin_print_scripts', 'sno_admin_scripts');
		add_action('admin_print_styles', 'sno_admin_styles');
	}

	add_action('init', 'sno_farbtastic_script');
	function sno_farbtastic_script() {
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
	}
	add_action('init', 'sno_thickbox_script');
	function sno_thickbox_script() {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
	}

	function sno_hide_buttons()
	{
		global $current_screen;

		if(($current_screen->id == 'edit-post') || ($current_screen->id == 'post'))
		{
			echo '<style>.page-title-action{display: none;}</style>';  
		}
	}
	add_action('admin_head','sno_hide_buttons');

	function sno_image_attachment_fields_to_edit($form_fields, $post) {
	
			
			$credit = get_post_meta($post->ID, "photographer", true);
			
			if ($credit == '') {
				$imgmeta = wp_get_attachment_metadata($post->ID);
				$credit = $imgmeta['image_meta']['credit'];
				if ($credit) update_post_meta($post->ID, "photographer", $credit);
				if ($credit) {
					delete_transient( "sno_sp_$credit" );
				}
			}

		$form_fields["photographer"] = array(
			"label" => __("Photographer"),
			"input" => "text", // this is default if "input" is omitted
			"value" => $credit,
			"menu_order" => 0,
			);
		return $form_fields;
	}
	add_filter("attachment_fields_to_edit", "sno_image_attachment_fields_to_edit", 15, 2); 

	function sno_image_attachment_fields_to_save($post, $attachment) {
		if( isset($attachment['photographer']) ){
			update_post_meta($post['ID'], 'photographer', $attachment['photographer']);
		
			$photographer = trim ($attachment['photographer']); 
			$photographer = str_replace(' ', '_', $photographer); 
			$photographer = str_replace("'", "", $$photographer);
			delete_transient( "sno_sp_$photographer" );
		}
		return $post;
	}
	add_filter("attachment_fields_to_save", "sno_image_attachment_fields_to_save", 15 , 2);

	function sno_image_id_display($form_fields, $post) {
		$form_fields["photo_id"] = array(
			"label" => __("Photo ID"),
			"input" => "text", // this is default if "input" is omitted
			"value" => $post->ID,
			"menu_order" => 0,
			);
		return $form_fields;
	}
	add_filter("attachment_fields_to_edit", "sno_image_id_display", 15, 2); 

	function sno_mm_page() {

		$args = array( 
			'p' => $_POST['id'] 
			); 

		$type = $_POST['type'];
		$myposts = get_posts( $args ); global $post; 
		foreach( $myposts as $post ) :	setup_postdata($post); 
		echo '<div id="moreposts">';
		echo '<div id="videowrap">';
		echo '<a class="headline mmheadline" href="' . get_permalink() .'" rel="bookmark"><h3>' . get_the_title() .'</h3></a>';
		if ($type == "video") {
			$video = get_post_meta($post->ID, 'video', true); 
			if ($video) { 
				$pattern = "/height=\"[0-9]*\"/"; 
				$video = preg_replace($pattern, "", $video); 
				$pattern = "/width=\"[0-9]*\"/"; 
				$video = preg_replace($pattern, "", $video); 
				echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>'; 
			} 
			sno_videographer('mmcredit');
			$writer = get_post_meta($post->ID, 'writer', true); 
			if ($writer) echo '<p class="mmteaser permalink"><a href="' . get_permalink() . '">Read full text</a> of accompanying story.</p>';
		}

		if ($type == "slideshow") {

			sno_sfi_story_page($post, $caption, $photographer, $widget = 'true');																

		}
		echo '</div>';
		echo '</div>';
		endforeach; 
		die();
	}

	add_action('wp_ajax_replace_video', 'sno_mm_page');
	add_action('wp_ajax_nopriv_replace_video', 'sno_mm_page'); 

	function sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname) {
		$output = '';
		if ($instance['widget-style']=="Style 1") { 
		$output .= '<div class="widget1 widgettitle"'; if ($customcolors=="snoccon") { 
				$output .= ' style="';
			$output .= 'background: ' . $instance['header-color']; 
			if ($instance['widget-gradient'] == "On") { 
				$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x '; 
			} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) { 
				$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat '; 
			} 
			$output .= '!important;';
			$output .= 'color:' . $instance['header-text'] . ' !important;';
			$output .= 'border-left:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;'; 
			$output .= 'border-right:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;'; 
			$output .= 'border-top:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;'; 
		
			if ($instance['widget-header-size'] == 'Large') {
				$output .= 'font-size:27px !important;';
				$output .= 'line-height:37px !important;';
				$output .= 'background-size: auto auto !important;';
			} else if ($instance['widget-header-size'] == 'Medium') { 
				$output .= 'font-size:22px !important;';
				$output .= 'line-height:32px !important;';
			} else {
				$output .= 'font-size:17px !important;';
				$output .= 'line-height:27px !important;';
			} 
			if ($instance['widget-gradient'] == "On") {	
				$output .= "background-size: auto 100% !important;";
			}
			if ($instance['center-title'] == 'on') {
				$output .= 'text-align:center;';
			} else {
				$output .= 'text-align:left;';
			}
			$output .= '"';
		} $output .= '>';
		
		if ($categoryslug) {
			$output .= '<a'; 
			if ($customcolors=="snoccon") { $output .= ' style="color: ' . $instance['header-text'] . ' !important;"'; }  
			$output .= " href='$categoryslug'>";
			if ($videotitle) { $output .=  $videotitle; } else { $output .=  $categoryname; }
			$output .= "</a>";
		} else { 
			$output .= $instance['title'];
		}
		$output .= "</div>"; 
		$output .= '<div class="widgetbody1" style="';
		if (isset ($instance['remove-padding']) && $instance['remove-padding']=='on') { 
			$output .= 'padding:0px !important;';
		} 
		if ($customcolors=="snoccon") {
			$output .= 'background-color:' . $instance['widget-background'] . ' !important;';
			$output .= 'border-right:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
			$output .= 'border-left:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
			$output .= 'border-bottom:' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
		} 
		$output .= '">';
	} else if ($instance['widget-style']=="Style 2") {
		$output .= '<div style="overflow: hidden;';
		if ($customcolors=="snoccon") {
			$output .= 'border-bottom: ' . $instance['border-thickness2'] . ' solid ' . $instance['widget-border'] . ';';
			$output .= 'border-top: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ';';
			$output .= 'background: ' . $instance['widget-background'] . ';';
			
			if ($instance['widget-padding'] == "Off") { 
				// $output .= 'margin: 15px 10px 0px !important;';
			} else {
				$output .= 'margin-bottom:0px;';
			}			
		} else { 
			if (get_theme_mod('widget7-padding') == "Off") {
				// $output .= 'margin: 15px 10px 0px;';
			} else { 
				$output .= 'margin-bottom:0px;'; 
			} 
			$output .= 'border-bottom:' . get_theme_mod('widget7-thickness2') . ' solid ' . get_theme_mod('widgetborder7') . ';'; 
			$output .= 'border-top:' . get_theme_mod('widget7-thickness') . ' solid ' . get_theme_mod('widgetborder7') . ';';
			$output .= 'background:' . get_theme_mod('widgetbackground7') . ';'; 
		}
		$output .= '">';
		$output .= '<div class="widget7 widgettitle"'; if ($customcolors=="snoccon") { 
			$output .= 'style="';
			$output .= 'background: ' . $instance['header-color']; 
			if ($instance['widget-gradient'] == "On") { 
				$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x ';
			} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) { 
				$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat';
			}  
			
			if ($instance['widget-gradient'] == "On") {	
				$output .= "background-size: auto 100% !important;";
			}
			$output .= '!important;';
			$output .= 'margin-top:1px;';
			$output .= 'margin-bottom:1px;';
			$output .= 'background-color: ' . $instance['header-color'] . ' !important;'; 
			$output .= 'color: ' . $instance['header-text'] . ' !important;';
			
			if ($instance['widget-header-size'] == 'Large') {
				$output .= 'font-size:28px !important;';
				$output .= 'line-height:40px !important;';
				$output .= 'background-size: auto 50px !important;';
			} else if ($instance['widget-header-size'] == 'Medium') {
				$output .= 'font-size:22px !important;';
				$output .= 'line-height:32px !important;';
			} else {
				$output .= 'font-size:17px !important;';
				$output .= 'line-height: 26px !important;';
			} 
			if ($instance['center-title'] == 'on') {
				$output .= 'text-align:center;';
			} else {
				$output .= 'text-align:left;';
			}
			$output .= 'padding: 6px 0px 2px ';
			if ($instance['widget-indent'] == "On") { $output .= '10px;'; } else { $output .= '0px;'; } 
			$output .= '"';
		} 
		$output .= '>';
		if ($categoryslug) { 
			$output .= "<a";
			if ($customcolors=="snoccon") { $output .= " style='color: " . $instance['header-text'] . " !important;'"; }
			$output .= " href='$categoryslug'>";
				if ($videotitle) { $output .= $videotitle; } else { $output .= $categoryname; }
			$output .= '</a>';
		} else { 
			$output .=  $instance['title'];
		}
		$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="widgetbody7" style="';
		if ($customcolors=="snoccon") { 
			$output .= 'background-color: ' . $instance['widget-background'] . ' !important;';
			$output .= 'border:none!important;';
		
			if ($instance['widget-padding']== "On") { 
				$output .= 'padding:10px !important;';
				$output .= 'margin:0px 0px 0px !important;';
			} else {
				$output .= 'padding:10px 0px 0px;';
				$output .= 'margin:0px 0px 20px !important;';
			}	
		} $output .= '">';
	} else if ($instance['widget-style']=="Style 3") { 
		$output .= '<div'; 
		if ($customcolors=="snoccon") { 
			$output .= ' style="';
			$output .= 'color: ' . $instance['header-text'] . '!important; ';
			$output .= 'background: ' . $instance['header-color']; 
			if ($instance['widget-gradient'] == "On") { 
				$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x '; 
			} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) {
				$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat ';
			} 
			$output .= '!important;';
			if ($instance['widget-gradient'] == "On") {	
				$output .= "background-size: auto 100% !important;";
			}
			if ($instance['widget-header-size'] == 'Large') { 
				$output .= 'font-size:27px !important;';
				$output .= 'line-height:27px !important;';
				$output .= 'padding-bottom: 2px !important;';
			} else if ($instance['widget-header-size'] == 'Medium') {
				$output .= 'font-size:19px !important;';
				$output .= 'line-height:22px !important;';
				$output .= 'padding-top:0px !important;'; 
				$output .= 'padding-bottom: 1px !important;';
			} else {
				$output .= 'font-size: 12px !important;'; 
				$output .= 'line-height:13px !important;';
				$output .= 'padding-top:0px !important;';
				$output .= 'padding-bottom:0px !important;';
			} 
			$output .= '"';
		}
		$output .= ' class="widget3 widgettitle">';
			if ($categoryslug) {
				$output .= '<a';
					if ($customcolors=="snoccon") { 
						$output .= " style='color: " . $instance['header-text'] . "!important;'";
					} 
					$output .= " href='$categoryslug'";
				$output .= '>';
					if ($videotitle) { $output .= $videotitle; } else { $output .= $categoryname; }
				$output .= '</a>';
			} else { 
				$output .= $instance['title'];
			}
		$output .= '</div>';
		$output .= '<div class="widgetbody3" style="';
			if (isset ($instance['remove-padding']) && $instance['remove-padding']=='on') { 
				$output .= 'padding:0px !important;';
			}	
			if ($customcolors=="snoccon") { 
				$output .= 'background-color: ' . $instance['widget-background'] . ' !important;';
				$output .= 'border-right: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . '!important;';
				$output .= 'border-left: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . '!important;';
			}
		$output .= '">';
	} else if ($instance['widget-style']=="Style 4") {
		$output .= '<div style="';
			$output .= 'margin: 0px 0px 0px 0px;'; 
			$output .= 'padding: 10px 9px 0px 9px;';
			$output .= 'overflow: hidden;';
		if ($customcolors=="snoccon") {  
			$output .= 'background-color: ' . $instance['widget-background'] . ';'; 
			$output .= 'border-left: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ';'; 
			$output .= 'border-right: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ';'; 
			$output .= 'border-top: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ';';
		} else { 
			$output .= 'background: ' . get_theme_mod('widgetbackground4') . ';'; 
			$output .= 'border-left: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
			$output .= 'border-right: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
			$output .= 'border-top: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
		} 
		$output .= '">';
		$output .= '<div class="widget4 widgettitle"';
			if ($customcolors=="snoccon") {
			$output .= ' style="';
				$output .= 'color: ' . $instance['header-text'] . '!important;';
				$output .= 'background: ' . $instance['header-color']; 
					if ($instance['widget-gradient'] == "On") { 
						$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x ';
					} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) { 
						$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat ';
					}
					$output .= '!important;';
				if ($instance['widget-header-size'] == 'Large') {
					$output .= 'font-size:28px !important;';
					$output .= 'line-height:40px !important;';
					$output .= 'background-size: auto auto !important;';
				} else if ($instance['widget-header-size'] == 'Medium') {
					$output .= 'font-size:22px !important;';
					$output .= 'line-height:32px !important;';
				} else { 
					$output .= 'font-size:16px!important;';
					$output .= 'line-height: 28px!important;'; 
					$output .= 'padding-top:2px !important;';
				} 
				if ($instance['widget-gradient'] == "On") {	
					$output .= "background-size: auto 100% !important;";
				}
				if ($instance['center-title'] == 'on') {
					$output .= 'text-align:center;';
				} else {
					$output .= 'text-align:left;';
				}
				$output .= '"';
			} 
			$output .= '>';
		if ($categoryslug) {
			$output .= '<a ';
			if ($customcolors=="snoccon") {
				$output .= ' style="color: ' . $instance['header-text'] . ' !important;"';
			}
			$output .= " href='$categoryslug'>";
			if ($videotitle) { $output .= $videotitle; } else { $output .= $categoryname; }
			$output .= '</a>';
		} else { 
			$output .= $instance['title']; 
		}
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="widgetbody4" style="';
			if (isset($instance['remove-padding']) && $instance['remove-padding']=='on') {
				$output .= 'padding:0px !important;';
			}	
			if ($customcolors=="snoccon") {
				$output .= 'background-color: ' . $instance['widget-background'] . '!important;';
				$output .= 'border-right: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;'; 
				$output .= 'border-left: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;'; 
				$output .= 'border-bottom: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
			} else {
				$output .= 'background: ' . get_theme_mod('widgetbackground4') . ';'; 
				$output .= 'border-left: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
				$output .= 'border-right: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
				$output .= 'border-bottom: ' . get_theme_mod('widget4-thickness') . ' solid ' . get_theme_mod('widgetborder4') . ';'; 
			} 
		$output .= '">';
	} else if ($instance['widget-style']=="Style 5") {
		$output .= '<div class="widget6 widgettitle" ';
		if ($customcolors=="snoccon") { 
			$output .= 'style="';
			$output .= 'border: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
			$output .= 'color: ' . $instance['header-text'] . ' !important;';
			$output .= 'background: ' . $instance['header-color'];
				if ($instance['widget-gradient'] == "On") { 
					$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x ';
				} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) { 
					$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat ';
				}
				$output .= '!important;';
			if ($instance['widget-header-size'] == 'Large') { 
				$output .= 'font-size:28px !important;';
				$output .= 'line-height:40px !important;';
				$output .= 'background-size: auto 100% !important;';
			} else if ($instance['widget-header-size'] == 'Medium') {
				$output .= 'font-size:22px !important;';
				$output .= 'line-height:32px !important;';
			} else {
				$output .= 'font-size:17px !important;';
				$output .= 'line-height: 25px!important;';
				$output .= 'padding-bottom: 3px !important;';
			} 
			if ($instance['center-title'] == 'on') {
				$output .= 'text-align:center;';
			} else {
				$output .= 'text-align:left;';
			}
			$output .= '"';
		}
		$output .= '>';
		if ($categoryslug) {
			$output .= '<a ';
			if ($customcolors=="snoccon") { 
				$output .= "style='color: " . $instance['header-text'] . " !important;' ";
			}
			$output .= "href='$categoryslug'>";
			if ($videotitle) { $output .= $videotitle; } else { $output .= $categoryname; }
			$output .= '</a>';
		} else { 
			$output .= $instance['title'];
		}
		$output .= '</div>'; 
		$output .= '<div class="widgetbody6" style="';
			if (isset ($instance['remove-padding']) && $instance['remove-padding']=='on') { 
				$output .= 'padding:0px !important;';
			}	
			if ($customcolors=="snoccon") { 
				$output .= 'background-color: ' . $instance['widget-background'] . ' !important;';
				$output .= 'border-right: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
				$output .= 'border-left: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
				$output .= 'border-bottom: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ' !important;';
			}
			$output .= '">';
	} else if ($instance['widget-style']=="Style 6") { 
		$output .= '<div style="overflow: hidden;';
		if ($customcolors=="snoccon") { 
			if ($instance['widget-indent'] != "On") {
				$output .= 'border-top: 0px;';
				$output .= 'background: ' . $instance['widget-border'] . ';';
				$output .= 'margin-bottom:0px;';
			} else {
				$output .= 'border-top: ' . $instance['border-thickness'] . ' solid ' . $instance['widget-border'] . ';';
				$output .= 'background: ' . $instance['widget-background'] . ';';
				$output .= 'margin-bottom:0px;';
			}
		} else { 
			if (get_theme_mod('widget8-indent') != "On") {
				$output .= 'margin-bottom:0px;';
				$output .= 'border-top:0px;';
				$output .= 'background: ' . get_theme_mod('widgetborder8') . ';'; 
			} else {
				$output .= 'margin-bottom:0px;';
				$output .= 'border-top: ' . get_theme_mod('widget8-thickness') . ' solid ' . get_theme_mod('widgetborder8') . ';';
				$output .= 'background: ' . get_theme_mod('widgetbackground8') . ';'; 
			}
		}
		$output .= '">';
		$output .= '<div class="widget8 widgettitle" ';
			if ($customcolors=="snoccon") {
				$output .= 'style="';
				$output .= 'background: ' . $instance['header-color']; 
				if ($instance['widget-gradient'] == "On") { 
					$output .= ' url(/wp-content/themes/snoflex/images/navbg.png) repeat-x ';
				} else if (($instance['widget-gradient'] == "Off") && ($instance['widget-pattern'] != "none")) { 
					$output .= ' url(/wp-content/themes/snoflex/images/' . $instance['widget-pattern'] . ') repeat ';
				}
				$output .= '!important;';
				$output .= 'background-color: ' . $instance['header-color'] . ' !important;';
				$output .= 'color: ' . $instance['header-text'] . ' !important;';
				$output .= 'padding: 0px 8px;';
				if ($instance['widget-header-size'] == 'Large') {
					$output .= 'font-size:26px !important;';
					$output .= 'line-height:38px !important;';
				} else if ($instance['widget-header-size'] == 'Medium') {
					$output .= 'font-size:20px !important;';
					$output .= 'line-height:30px !important;';
				} else {
					$output .= 'font-size:14px !important;'; 
					$output .= 'line-height: 22px!important;';
				}  
				$output .= 'margin: 0px 0px 0px;'; 
				if ($instance['widget-gradient'] == "On") {	
					$output .= "background-size: auto 100% !important;";
				}
				if ($instance['widget-indent'] == "On") { 
					$output .= '10px;';
				} else {
					$output .= '0px;';
				} 
				if ($instance['widget-indent'] != "On") { 
					$output .= 'border-right: ' . $instance['border-thickness'] . ' solid ' . get_theme_mod('widgetbackground8') . ';';
				}
				$output .= '"';
			}
		$output .= '>';
		if ($categoryslug) {
			$output .= '<a '; 
			if ($customcolors=="snoccon") { 
				$output .= "style='color: " . $instance['header-text'] . " !important;' ";
			} 
			$output .= "href='$categoryslug'>";
			if ($videotitle) { $output .= $videotitle; } else { $output .= $categoryname; }
			$output .= '</a>';
		} else { 
			$output .= $instance['title'];
		}
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="widgetbody8" style="';
		if ($customcolors=="snoccon") { 
			$output .= 'background-color: ' . $instance['widget-background'] . ' !important;';
			$output .= 'border:none!important;';
		}
		$output .= '">';
	} 
	return $output;
}

function sno_load_fonts() {
	$font_list = array();
	
	$headerfont = get_theme_mod('header-font');
	$font_list[] = $headerfont;
	
	$taglinefont = get_theme_mod('tagline-font');
	if (!in_array($taglinefont, $font_list) && ($taglinefont)) $font_list[] = $taglinefont;
	
	$topnavfont = get_theme_mod('topnav-font');
	if (!in_array($topnavfont, $font_list) && ($topnavfont)) $font_list[] = $topnavfont;

	$bottomnavfont = get_theme_mod('bottomnav-font');
	if (!in_array($bottomnavfont, $font_list) && ($bottomnavfont)) $font_list[] = $bottomnavfont;

	$headlinefont = get_theme_mod('headline-font');
	if (!in_array($headlinefont, $font_list) && ($headlinefont)) $font_list[] = $headlinefont;

	$headingsfont = get_theme_mod('headings-font');
	if (!in_array($headingsfont, $font_list) && ($headingsfont)) $font_list[] = $headingsfont;

	$captionfont = get_theme_mod('caption-font');
	if (!in_array($captionfont, $font_list) && ($captionfont)) $font_list[] = $captionfont;

	$bodyfont = get_theme_mod('body-font');
	if (!in_array($bodyfont, $font_list) && ($bodyfont)) $font_list[] = $bodyfont;

	$widgetfont = get_theme_mod('widget-font');
	if (!in_array($widgetfont, $font_list) && ($widgetfont)) $font_list[] = $widgetfont;

	$breakingfont = get_theme_mod('breaking-font');
	if (!in_array($breakingfont, $font_list) && ($breakingfont)) $font_list[] = $breakingfont;

	$deckfont = get_theme_mod('deck-font');
	if (!in_array($deckfont, $font_list) && ($deckfont)) $font_list[] = $deckfont;

	if (is_ssl()) {
		$google_request = "https://fonts.googleapis.com/css?family=";
	} else {
		$google_request = "http://fonts.googleapis.com/css?family=";	
	}
	$count = 1;
	foreach ($font_list as $font) {
		if ($count != 1) $google_request .= '|';
		$google_request .= $font . ':400,700';
		$count++;
	}
	
	wp_register_style('googleFonts', $google_request);
	wp_enqueue_style( 'googleFonts');
}

if (get_theme_mod('googlefonts-activate') != "Disable") add_action('wp_enqueue_scripts', 'sno_load_fonts');



function sno_footer_close() {
	echo '<p>';
	if (get_theme_mod('google-apps')) {
		echo '<a href="' . get_theme_mod('google-apps') . '">';
		bloginfo('name');
		echo '</a> &bull; ';
	}
	echo '&copy; ' . date('Y') . ' ';
	if (get_theme_mod('copyright')) echo get_theme_mod('copyright');
	echo ' &bull; ';
	$privacy = get_theme_mod('privacy');
	$footer_credit = get_option('sno_analytics_options');
	if(filter_var($privacy, FILTER_VALIDATE_URL)) {

	} else {
		if (isset($footer_credit['sno_hosting_credit']) && $footer_credit['sno_hosting_credit'] != "None") {
			$privacy = 'https://snosites.com/client-site-privacy-policy/';
		} else {
			$privacy = '/';
		}
	}
	if (isset($footer_credit['sno_hosting_credit'])) {
		if ($footer_credit['sno_hosting_credit']=='None') { 
			if (get_theme_mod('privacy') != '') echo "<a target='_blank' href='$privacy'>Privacy Policy</a> &bull; ";
		} else if ($footer_credit['sno_hosting_credit']=='Boosting Blue') { 
			if (get_theme_mod('privacy') != '') echo "<a target='_blank' href='$privacy'>Privacy Policy</a> &bull; ";
			echo "Hosting and Support by <a href='http://boostingblue.com'>Boosting Blue</a> &bull; ";
		} else {
			echo "<a target='_blank' href='$privacy'>Privacy Policy</a> &bull; <a href='https://snosites.com/why-sno/'>FLEX WordPress Theme</a> by <a href='http://snosites.com'>SNO</a> &bull; ";
		}
	} else {
		echo "<a target='_blank' href='$privacy'>Privacy Policy</a> &bull; <a href='https://snosites.com/why-sno/'>FLEX WordPress Theme</a> by <a href='http://snosites.com'>SNO</a> &bull; ";
	}
	wp_loginout(); 
	wp_register(' &bull; ', '');
	echo '</p>';
}

add_filter( 'the_author', 'sno_author_rss' );
//add_filter( 'get_the_author_display_name', 'sno_author_name' );

function sno_author_name( $name ) {
	if (!wp_is_post_revision()) {
		global $post;
		$author = get_post_meta( $post->ID, 'writer', true );
		if ($author) $name = $author;
		return $name;
	}
}

function sno_author_rss($author) {
	if(is_feed()) {
		global $post;
		$author = get_option("rss_author");
		$writer = get_post_meta($post->ID, 'writer', true);
		$jobtitle = get_post_meta($post->ID, 'jobtitle', true);
		$author = $writer;
		if ($jobtitle) $author .= ', '. $jobtitle;
	}

	return $author;
}
add_filter('wp_nav_menu_objects', 'sno_menu_merge', 10, 2);
function sno_menu_merge($sorted_menu_items, $args)
{

	if ($args->menu == 'Bottom Menu' && $args->menu_class == 'select' && get_theme_mod('topnav-location') != 'Off') {
		$top_menu_items = wp_get_nav_menu_items('Top Menu');
		_wp_menu_item_classes_by_context( $top_menu_items );
		foreach ($top_menu_items as $item) {
			$sorted_menu_items[]=$item;
		}
	}
	return $sorted_menu_items;
}
function sno_unregister_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('bcn_widget');
	unregister_widget('nggMediaRssWidget');
	unregister_widget('Akismet_Widget'); 
}
add_action('widgets_init', 'sno_unregister_default_widgets', 11);
function sno_other_stories_list() {
	global $post; $count = ''; $o = '';
	$categories = get_the_category();
	foreach ($categories as $category) {
		$count++;
		if ($count < 3) {

			$i = "";

			$args = array( 'category' => $category->cat_ID, 'numberposts' => 5, 'exclude' => $post->ID );
			$queried_posts = get_posts( $args );
			if ($queried_posts) {
				foreach ($queried_posts as $queried_post) {

					$thePostID = $queried_post->ID;
					$link = get_permalink($thePostID);
					$i++;
					if ($i == 1) {
						$o .= '<div class="relatedstories">';
						$o .= '<div class="storymeta" style="margin-bottom:0px;">';
						$o .= '<p style="text-align:center;font-size:16px;line-height:30px;">';
						$o .= 'Other stories filed under '; 
						$o .= '<a href="'.cat_id_to_slug($category->cat_ID).'">'.$category->name.'</a>';
						$o .= '</p>';
						$o .= '</div>';	
						$o .= '<div class="relatedbody">';
					}

					$catstoryposition = 'catstory-position-' . $i;

					if ((1 < $i) && ($i < 6)) $o .= "<div class='relateddividervert $catstoryposition'></div>";
					$o .= "<div class='catrow $catstoryposition'>";
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'tsmediumblock');
					if ($image) {
						$o .= '<a href="' . $link . '" title="'. get_the_title($thePostID) .'"><img src="' . $image[0] . '" class="catstory-photo" alt="' . get_the_title($thePostID) . '" /></a>'; 
					}
					$o .= '<h5 class="relatedtitle">';
					$o .= '<a href="' . $link . '">' . get_the_title($thePostID) . '</a>';
					$o .= '</h5>';
					if ($image == "") {
						$o .= '<p class="relatedteaser">';
						$storycontent = $queried_post->post_content;
						$storycontent = strip_tags($storycontent);
						$storycontent = strip_shortcodes($storycontent);
						$o .= substr($storycontent, 0, 150);
						$o .= '...</p>';
						$teaser = '';
					}
					$o .= '</div>';	
				}

				$o .= '<div class="clear"></div>';		
				$o .= '</div>';
				$o .= '</div>';
				$o .= '<div class="clear"></div>';
			}
		}	
	}
	return $o;
}
function sno_extract_related_stories($str){

	preg_match_all('/stories=".*?"/', $str, $m);

	return isset($m[0]) ? $m[0] : array();
}
function sno_make_list($list) {
	$storylist = ''; $i = '';
	foreach ($list as $key => $value) {
		$i++;
		$value =  substr($value,9);
		$value = rtrim($value, '"');
		if ($i>1) $storylist .= ',';
		$storylist .= $value;
	}
	return $storylist;
}
function sno_related_stories_list($list) {		
	$o .= '<div class="relatedstories readnext" style="display:none">';
	$o .= '<div class="storymeta" style="margin-bottom:0px;">';
	$o .= '<p style="text-align:center;font-size:16px;line-height:30px;">';
	$o .= 'Read Next '; 
	$o .= '</p>';
	$o .= '</div>';	
	$o .= '<div class="relatedbody">';
	$stories = explode(',', $list);
	foreach ($stories as $story) {

		$storydata = get_post($story);
		if ( 'post' == get_post_type($story)) {
			$i++; 
			if ($i<6) {
				$link = get_permalink($story);

				$catstoryposition = 'catstory-position-' . $i;

				if ((1 < $i) && ($i < 6)) $o .= "<div class='relateddividervert $catstoryposition'></div>";
				$o .= "<div class='catrow $catstoryposition'>";
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($story), 'tsmediumblock');
				if ($image) {
					$o .= '<a href="' . $link . '" title="'. get_the_title($story) .'"><img src="' . $image[0] . '" class="catstory-photo" alt="' . get_the_title($story) . '" /></a>'; 
				}
				$o .= '<h5 class="relatedtitle">';
				$o .= '<a href="' . $link . '">' . get_the_title($story) . '</a>';
				$o .= '</h5>';
				if ($image == "") {
					$o .= '<p class="relatedteaser">';
					$storycontent = $storydata->post_content;
					$storycontent = strip_tags($storycontent);
					$storycontent = strip_shortcodes($storycontent);
					$o .= substr($storycontent, 0, 150);
					$o .= '...</p>';
					$teaser = '';
				}
				$o .= '</div>';	
			}
		}
	}
	$o .= '<div class="clear"></div>';		
	$o .= '</div>';
	$o .= '</div>';
	$o .= '<div class="clear"></div>';			
	return $o;
}

// design tools story page template meta box
add_action( 'add_meta_boxes', 'sno_format_meta_box_add' );
function sno_format_meta_box_add()
{
	add_meta_box( 'sno_format_meta_box_id', 'SNO Story Page Design Options', 'sno_format_meta_box', 'post', 'side', 'high' );
}

function sno_format_meta_box( $post )
{
	$sno_headline = get_post_meta( $post->ID, 'sno_headline', true );
	$default_headline = get_theme_mod('story-headline');
	if (!$sno_headline) $sno_headline = $default_headline; 
	if (!$sno_headline) $sno_headline = 'Default'; 

	$values = get_post_custom( $post->ID );
	$text = isset( $values['sno_deck'] ) ? esc_attr( $values['sno_deck'][0] ) : '';
	$sno_format = isset( $values['sno_format'] ) ? esc_attr( $values['sno_format'][0] ) : '';
	$sno_longform_list = isset( $values['sno_longform_list'] ) ? esc_attr( $values['sno_longform_list'][0] ) : '';
	$sno_longform_order = isset( $values['sno_longform_order'] ) ? esc_attr( $values['sno_longform_order'][0] ) : '';
	$sno_sidebyside_list = isset( $values['sno_sidebyside_list'] ) ? esc_attr( $values['sno_sidebyside_list'][0] ) : '';
	$sno_sidebyside_order = isset( $values['sno_sidebyside_order'] ) ? esc_attr( $values['sno_sidebyside_order'][0] ) : '';
	$sno_sidebyside_title = isset( $values['sno_sidebyside_title'] ) ? esc_attr( $values['sno_sidebyside_title'][0] ) : '';
	$sno_sidebyside_image = isset( $values['sno_sidebyside_image'] ) ? esc_attr( $values['sno_sidebyside_image'][0] ) : '';
	$sno_longform_title = isset( $values['sno_longform_title'] ) ? esc_attr( $values['sno_longform_title'][0] ) : '';
	$sno_sr_tag = isset( $values['sno_sr_tag'] ) ? esc_attr( $values['sno_sr_tag'][0] ) : '';
	$sno_sr_cat = isset( $values['sno_sr_cat'] ) ? esc_attr( $values['sno_sr_cat'][0] ) : '';
	$sno_sr_title = isset( $values['sno_sr_title'] ) ? esc_attr( $values['sno_sr_title'][0] ) : '';
	$sno_longform_main_title = isset( $values['sno_longform_main_title'] ) ? esc_attr( $values['sno_longform_main_title'][0] ) : '';
	$sno_longform_image = isset( $values['sno_longform_image'] ) ? esc_attr( $values['sno_longform_image'][0] ) : '';
	$sno_longform_image_master = isset( $values['sno_longform_image_master'] ) ? esc_attr( $values['sno_longform_image_master'][0] ) : '';
	$sno_rails_writer = isset( $values['sno_rails_writer'] ) ? esc_attr( $values['sno_rails_writer'][0] ) : '';
	$sno_rails_type = isset( $values['sno_rails_type'] ) ? esc_attr( $values['sno_rails_type'][0] ) : '';
	$sno_rails_number = isset( $values['sno_rails_number'] ) ? esc_attr( $values['sno_rails_number'][0] ) : '';
	$sno_rails_stories = isset( $values['sno_rails_stories'] ) ? esc_attr( $values['sno_rails_stories'][0] ) : '';
	$default_format = get_theme_mod('story-template');
	$sno_network_ads = isset( $values['sno_network_ads'] ) ? esc_attr( $values['sno_network_ads'][0] ) : '';
	$sno_longform_story_override = isset( $values['sno_longform_story_override'] ) ? esc_attr( $values['sno_longform_story_override'][0] ) : '';
	$sno_longform_story_override_kill = isset( $values['sno_longform_story_override_kill'] ) ? esc_attr( $values['sno_longform_story_override_kill'][0] ) : '';

	$sno_grid_story_override = isset( $values['sno_grid_story_override'] ) ? esc_attr( $values['sno_grid_story_override'][0] ) : '';
	$sno_grid_story_override_kill = isset( $values['sno_grid_story_override_kill'] ) ? esc_attr( $values['sno_grid_story_override_kill'][0] ) : '';
	$sno_grid_columns = isset( $values['sno_grid_columns'] ) ? esc_attr( $values['sno_grid_columns'][0] ) : '';
	$sno_grid_main_title = isset( $values['sno_grid_main_title'] ) ? esc_attr( $values['sno_grid_main_title'][0] ) : '';
	$sno_grid_list = isset( $values['sno_grid_list'] ) ? esc_attr( $values['sno_grid_list'][0] ) : '';
	$sno_grid_order = isset( $values['sno_grid_order'] ) ? esc_attr( $values['sno_grid_order'][0] ) : '';
	$sno_grid_image_master = isset( $values['sno_grid_image_master'] ) ? esc_attr( $values['sno_grid_image_master'][0] ) : '';
	$sno_grid_title = isset( $values['sno_grid_title'] ) ? esc_attr( $values['sno_grid_title'][0] ) : '';
	$sno_grid_chapter_title = isset( $values['sno_grid_chapter_title'] ) ? esc_attr( $values['sno_grid_chapter_title'][0] ) : '';

	if ((!$sno_format) && ($default_format == 'Full-Width')) {
		$sno_format = 'Full-Width'; 
	} else if (!$sno_format) {
		$sno_format = 'Classic';  
	}
	wp_nonce_field( 'sno_meta_box_nonce', 'meta_box_nonce' );
	?>
	<?php if ($sno_format != 'Long-Form Chapter') { ?>	
	
	
	<p>	
		<select name="sno_headline">
			<option value="Default" <?php if ($sno_headline == 'Default') echo 'selected="selected"';?>> Default</option>
			<option value="2.6em" <?php if ($sno_headline == '2.6em') echo 'selected="selected"';?>> Small</option>
			<option value="3.6em" <?php if ($sno_headline == '3.6em') echo 'selected="selected"';?>> Medium</option>
			<option value="4.6em" <?php if ($sno_headline == '4.6em') echo 'selected="selected"';?>> Large</option>
			<option value="5.6em" <?php if ($sno_headline == '5.6em') echo 'selected="selected"';?>> XL</option>
			<option value="6.6em" <?php if ($sno_headline == '6.6em') echo 'selected="selected"';?>> Whoa!</option>
		</select> Headline Size
	</p>
	<?php } ?>
	
	<h3 style="border-bottom:none; padding-left:0px">Secondary Headline (Deck)</h3>
	<textarea name="sno_deck" cols=27 rows=5><?php echo $text ?></textarea></p>
	<p style="font-style:italic">This secondary headline will only display on the story page.</p>

	<?php $options = get_option('sno_analytics_options'); if (isset($options['sno_adbutler_analytics_activate']) && $options['sno_adbutler_analytics_activate'] == 'on') { ?>

	<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
	<p><label><input type="checkbox" name="sno_network_ads" value="true" <?php if ($sno_network_ads == true ) echo "checked"; ?>> Hide Ad Marketplace Ad</label></p>

	<?php } ?>
	
	<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
	<h3 style="border-bottom:none; padding-left:0px">Story Page Template</h3>

	<p style="margin-top:0px;">
		
		<label><input class="story-type" type="radio" name="sno_format" value="Classic" <?php if ($sno_format == 'Classic') echo "checked=1";?>> With Non-Home Sidebar</label><br/>
		<label><input class="story-type" type="radio" name="sno_format" value="Full-Width" <?php if ($sno_format == 'Full-Width') echo "checked=1";?>> Full-Width</label><br/>
		<label><input class="story-type" type="radio" name="sno_format" value="Side Rails" <?php if ($sno_format == 'Side Rails') echo "checked=1";?>> Side Rails</label><br/>
		<br />
		<label><input class="story-type" type="radio" name="sno_format" value="Side by Side" <?php if ($sno_format == 'Side by Side') echo "checked=1";?>> Side by Side Container</label><br/>
		<label><input class="story-type" type="radio" name="sno_format" value="Side by Side Chapter" <?php if ($sno_format == 'Side by Side Chapter') echo "checked=1";?>> Side by Side Chapter</label><br/>
		<br />
		<label><input class="story-type" type="radio" name="sno_format" value="Grid" <?php if ($sno_format == 'Grid') echo "checked=1";?>> Grid Container</label><br/>
		<label><input class="story-type" type="radio" name="sno_format" value="Grid Chapter" <?php if ($sno_format == 'Grid Chapter') echo "checked=1";?>> Grid Chapter</label><br/>
		<br />
		<label><input class="story-type" type="radio" name="sno_format" value="Long-Form" <?php if ($sno_format == 'Long-Form') echo "checked=1";?>> Long-Form Container</label><br/>
		<label><input class="story-type" type="radio" name="sno_format" value="Long-Form Chapter" <?php if ($sno_format == 'Long-Form Chapter') echo "checked=1";?>> Long-Form Chapter</label><br/>
	</p>
	

	<?php 
	
	if ($sno_format == 'Long-Form') { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lf_options = ''; $lfc_options = ' style="display:none"'; $sr_options = ' style="display:none"'; $ss_options = ' style="display:none"'; $ssc_options = ' style="display:none"';
	} else if ($sno_format == 'Long-Form Chapter') { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lf_options = ' style="display:none;"'; $lfc_options = ''; $sr_options = ' style="display:none"'; $ss_options = ' style="display:none"'; $ssc_options = ' style="display:none"';
	} else if ($sno_format == 'Side Rails') { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lf_options = ' style="display:none;"'; $lfc_options = ' style="display:none;"'; $sr_options = ''; $ss_options = ' style="display:none"'; $ssc_options = ' style="display:none"';
	} else if ($sno_format == 'Side by Side') { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lf_options = ' style="display:none;"'; $lfc_options = ' style="display:none;"'; $sr_options = ' style="display:none;"'; $ss_options = ''; $ssc_options = ' style="display:none"';
	} else if ($sno_format == 'Side by Side Chapter') { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lf_options = ' style="display:none;"'; $lfc_options = ' style="display:none;"'; $sr_options = ' style="display:none;"'; $ss_options = ' style="display:none;"'; $ssc_options = '';
	} else if ($sno_format == 'Grid') { 
		$grid_options = ''; $gridc_options = ' style="display:none"'; $lf_options = ' style="display:none;"'; $lfc_options = ' style="display:none;"'; $sr_options = ' style="display:none;"'; $ss_options = ' style="display:none"'; $ssc_options = ' style="display:none"';
	} else if ($sno_format == 'Grid Chapter') { 
		$grid_options = ' style="display:none"'; $gridc_options = ''; $lf_options = ' style="display:none;"'; $lfc_options = ' style="display:none;"'; $sr_options = ' style="display:none;"'; $ss_options = ' style="display:none;"'; $ssc_options = ' style="display:none"';
	} else { 
		$grid_options = ' style="display:none"'; $gridc_options = ' style="display:none"'; $lfc_options = ' style="display:none"'; $lf_options = ' style="display:none"'; $sr_options = ' style="display:none"'; $ss_options = ' style="display:none"'; $ssc_options = ' style="display:none"';
	} 
	
	if ($sno_rails_writer == "Hide") $sr_profile_options = ' style="display:none"';
	if ($sno_rails_writer != "Staff Profile") $sr_profile = ' style="display:none"';
	if ($sno_rails_writer != "Tagged Stories") $sr_tag = ' style="display:none"';
	if ($sno_rails_writer != "Category Stories") $sr_cat = ' style="display:none"';
	
	?>

	<div class="sno-lf-options"<?php echo $lf_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%" ?></div>
		<h3 style="border-bottom:none; padding-left:0px">Long-Form Story Options</h3>
		<p>Brief Title for Menu Bar<br >
			<input type="text" name="sno_longform_main_title" maxlength="25" size="25" value="<?php echo $sno_longform_main_title; ?>"><br/>
		</p>
		<p>
			<label><input type="checkbox" name="sno_longform_image_master" value="true" <?php if ($sno_longform_image_master == true ) echo "checked"; ?>> Make Featured Image Immersive</label>
		</p>
		<p>The immersive option overrides other photo options.</p>
		<?php if (get_theme_mod('lf-story-page-override') != 'On' && get_theme_mod('lf-story-page-background') != '') { ?>
		<p>
			<label><input type="checkbox" name="sno_longform_story_override" value="true" <?php if ($sno_longform_story_override == true ) echo "checked"; ?>> Use Override Color Scheme</label><br /><i>Set colors on SNO Design Options page.</i>
		</p>
		<?php } else if (get_theme_mod('lf-story-page-override') == 'On') { ?>
		<p>
			<label><input type="checkbox" name="sno_longform_story_override_kill" value="true" <?php if ($sno_longform_story_override_kill == true ) echo "checked"; ?>> Use White Background</label>
		</p>
		<?php } ?>
	</div>

	<div class="sno-grid-options"<?php echo $grid_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%" ?></div>
		<h3 style="border-bottom:none; padding-left:0px">Grid Container Options</h3>
		<p>Brief Title for Menu Bar<br >
			<input type="text" name="sno_grid_main_title" maxlength="25" size="25" value="<?php echo $sno_grid_main_title; ?>"><br/>
		</p>
		<p>Number of Columns in Grid<br >
				<select name="sno_grid_columns">
					<option value="2" <?php if ( $sno_grid_columns == '2' ) echo 'selected="selected"'; ?>>2</option>
					<option value="3" <?php if ( $sno_grid_columns == '3' ) echo 'selected="selected"'; ?>>3</option>
					<option value="4" <?php if ( $sno_grid_columns == '4' ) echo 'selected="selected"'; ?>>4</option>
					<option value="5" <?php if ( $sno_grid_columns == '5' ) echo 'selected="selected"'; ?>>5</option>
				</select> 		
		</p>
		<p>
			<label><input type="checkbox" name="sno_grid_title" value="true" <?php if ($sno_grid_title == true ) echo "checked"; ?>> Hide Container Story Headline/Date</label>
		</p>
		<p>
			<label><input type="checkbox" name="sno_grid_image_master" value="true" <?php if ($sno_grid_image_master == true ) echo "checked"; ?>> Hide Container Story Image</label>
		</p>
		<p>This option overrides other photo options.</p>
		<?php if (get_theme_mod('lf-story-page-override') != 'On' && get_theme_mod('lf-story-page-background') != '') { ?>
		<p>
			<label><input type="checkbox" name="sno_grid_story_override" value="true" <?php if ($sno_grid_story_override == true ) echo "checked"; ?>> Use Override Color Scheme</label><br /><i>Set colors on SNO Design Options page.</i>
		</p>
		<?php } else if (get_theme_mod('lf-story-page-override') == 'On') { ?>
		<p>
			<label><input type="checkbox" name="sno_grid_story_override_kill" value="true" <?php if ($sno_grid_story_override_kill == true ) echo "checked"; ?>> Use White Background</label>
		</p>
		<?php } ?>
	</div>

	<div class="sno-gridc-options"<?php echo $gridc_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%" ?></div>
		<h3 style="border-bottom:none; padding-left:0px">Grid Chapter Options</h3>
		<p>Attach chapter to which story?<br />

			<?php echo sno_list_grid_stories($sno_grid_list); ?>
		</p>
		<p>
			<select name="sno_grid_order">
				<?php for ($i=1; $i<401; $i++ ) {
					echo "<option value='$i'";
					if ( $sno_grid_order == $i ) echo 'selected="selected"';
					echo ">$i</option>";
				} ?>
			</select> Chapter Order
		</p>
		<p>
			<label><input type="checkbox" name="sno_grid_chapter_title" value="true" <?php if ($sno_grid_chapter_title == true ) echo "checked"; ?>> Hide headline when chapter is viewed</label>
		</p>


	</div>

	<div class="sno-ss-options"<?php echo $ss_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
		<h3 style="border-bottom:none; padding-left:0px">Side by Side Container Options</h3>
		<p>The Side by Side story functions as a container for two Side by Side chapters.</p>

		<p>
			<label><input type="checkbox" name="sno_sidebyside_title" value="true" <?php if ($sno_sidebyside_title == true ) echo "checked"; ?>> Hide Container Story Headline</label>
		</p>
		<p>
			<label><input type="checkbox" name="sno_sidebyside_image" value="true" <?php if ($sno_sidebyside_image == true ) echo "checked"; ?>> Make Featured Image Immersive</label>
		</p>
	</div>

	<div class="sno-ssc-options"<?php echo $ssc_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
		<h3 style="border-bottom:none; padding-left:0px">Side by Side Chapter Options</h3>
		<p>Attach chapter to which Side by Side Container?<br />

			<?php echo sno_list_sidebyside_stories($sno_sidebyside_list); ?>
		</p>
		<p>
			<select name="sno_sidebyside_order">
				<option value="Left" <?php if ( $sno_sidebyside_order == 'Left' ) echo 'selected="selected"'; ?>>Left</option>
				<option value="Right" <?php if ( $sno_sidebyside_order == 'Right' ) echo 'selected="selected"'; ?>>Right</option>
			</select> Chapter Position

		</p>

		<p><a target="_blank" href="/?p=<?php echo $sno_sidebyside_list; ?>">View Side by Side Version</a></p>
	</div>

	<div class="sno-sr-options"<?php echo $sr_options; ?>>
		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
		<h3 style="border-bottom:none; padding-left:0px">Left Side Rail Options</h3>
		<p>
			<select class="sno_rails_writer" name="sno_rails_writer">
				<option value="Staff Profile" <?php if ( $sno_rails_writer == 'Staff Profile' ) echo 'selected="selected"'; ?>>Display Staff Profile Preview</option>
				<option value="Tagged Stories" <?php if ( $sno_rails_writer == 'Tagged Stories' ) echo 'selected="selected"'; ?>>Display Teasers based on Tag</option>
				<option value="Category Stories" <?php if ( $sno_rails_writer == 'Category Stories' ) echo 'selected="selected"'; ?>>Display Teasers based on Category</option>
				<option value="Hide" <?php if ( $sno_rails_writer == 'Hide' ) echo 'selected="selected"'; ?>>Hide</option>
			</select> 
		</p>
		<div class="sno-sr-profile-options"<?php if (isset($sr_profile_options)) echo $sr_profile_options; ?>>
			<div class="sno-sr-profile"<?php if (isset($sr_profile)) echo $sr_profile; ?>>
				<p>
					<select name="sno_rails_type">
						<option value="Writer" <?php if ( $sno_rails_type == 'Writer' ) echo 'selected="selected"'; ?>>Writer</option>
						<option value="Photographer" <?php if ( $sno_rails_type == 'Photographer' ) echo 'selected="selected"'; ?>>Photographer</option>
						<option value="Videographer" <?php if ( $sno_rails_type == 'Videographer' ) echo 'selected="selected"'; ?>>Videographer</option>
					</select> Profile
				</p>
			</div>
			<div class="sno-sr-tag"<?php echo $sr_tag; ?>>
				<p>Which tag?<br />
					<input type="text" name="sno_sr_tag" value="<?php echo $sno_sr_tag; ?>"><br/>
				</p>
			</div>
			<div class="sno-sr-cat"<?php echo $sr_cat; ?>>
				<p>Which category?<br />
					<?php wp_dropdown_categories(array('selected' => $sno_sr_cat, 'name' => 'sno_sr_cat', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
				</p>
			</div>
			<p>
				<select name="sno_rails_number">
					<option value="1" <?php if ( $sno_rails_number == '1' ) echo 'selected="selected"'; ?>>1</option>
					<option value="2" <?php if ( $sno_rails_number == '2' ) echo 'selected="selected"'; ?>>2</option>
					<option value="3" <?php if ( $sno_rails_number == '3' ) echo 'selected="selected"'; ?>>3</option>
					<option value="4" <?php if ( $sno_rails_number == '4' ) echo 'selected="selected"'; ?>>4</option>
					<option value="5" <?php if ( $sno_rails_number == '5' ) echo 'selected="selected"'; ?>>5</option>
					<option value="6" <?php if ( $sno_rails_number == '6' ) echo 'selected="selected"'; ?>>6</option>
					<option value="7" <?php if ( $sno_rails_number == '7' ) echo 'selected="selected"'; ?>>7</option>
					<option value="8" <?php if ( $sno_rails_number == '8' ) echo 'selected="selected"'; ?>>8</option>
					<option value="9" <?php if ( $sno_rails_number == '9' ) echo 'selected="selected"'; ?>>9</option>
				</select> 		
				<select name="sno_rails_stories">
					<option value="date" <?php if ( $sno_rails_stories == 'date' ) echo 'selected="selected"'; ?>>Most Recent</option>
					<option value="rand" <?php if ( $sno_rails_stories == 'rand' ) echo 'selected="selected"'; ?>>Random</option>
				</select> headlines
			</p>
		</div>
		<p>Left Side Rail Title (optional)<br />
			<input type="text" name="sno_sr_title" value="<?php echo $sno_sr_title; ?>">
		</p>
	</div>

	<div class="sno-lfc-options"<?php echo $lfc_options; ?>>

		<div style="border-bottom:1px solid #eee; margin:20px -12px 5px; width:110%"></div>
		<p>All Long-Form Chapters should be assigned to the Uncategorized category.</p>
		<h3 style="border-bottom:none; padding-left:0px">Long-Form Chapter Options</h3>

		<p>Attach chapter to which story?<br />

			<?php echo sno_list_longform_stories($sno_longform_list); ?>
		</p>
		<p>
			<select name="sno_longform_order">
				<?php for ($i=1; $i<41; $i++ ) {
					echo "<option value='$i'";
					if ( $sno_longform_order == $i ) echo 'selected="selected"';
					echo ">$i</option>";
				} ?>
			</select> Chapter Order

		</p>

		<p>Chapter Title for Menu<br />
			<input type="text" name="sno_longform_title" value="<?php echo $sno_longform_title; ?>"><br/>

		</p>
		
		<p>
			<input type="checkbox" name="sno_longform_image" value="true" <?php if ($sno_longform_image == true ) echo "checked"; ?>> Make Featured Image Immersive
		</p>
	</div>
	<script type="text/javascript">
	jQuery(".sno_rails_writer").change(function() {
		if (jQuery(this).val() == "Hide") {
			jQuery(".sno-sr-profile-options").slideUp('slow');
		} else {
			jQuery(".sno-sr-profile-options").slideDown('slow');
		}
	}) 
	jQuery(".sno_rails_writer").change(function() {
		if (jQuery(this).val() == "Staff Profile") {
			jQuery(".sno-sr-profile").slideDown('slow');
		} else {
			jQuery(".sno-sr-profile").slideUp('slow');
		}
	}) 
	jQuery(".sno_rails_writer").change(function() {
		if (jQuery(this).val() == "Tagged Stories") {
			jQuery(".sno-sr-tag").slideDown('slow');
		} else {
			jQuery(".sno-sr-tag").slideUp('slow');
		}
	}) 
	jQuery(".sno_rails_writer").change(function() {
		if (jQuery(this).val() == "Category Stories") {
			jQuery(".sno-sr-cat").slideDown('slow');
		} else {
			jQuery(".sno-sr-cat").slideUp('slow');
		}
	}) 
	jQuery('.error:contains("Please configure your ")').hide();

	jQuery(".story-type").change(function() {
		if (jQuery(this).val() == "Long-Form") {
			jQuery(".sno-lf-options").slideDown('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Long-Form Chapter") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideDown('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Side Rails") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-sr-options").slideDown('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Side by Side") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-ss-options").slideDown('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Side by Side Chapter") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideDown('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Grid") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-grid-options").slideDown('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		} else if (jQuery(this).val() == "Grid Chapter") {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideDown('slow');
		} else {
			jQuery(".sno-lf-options").slideUp('slow');
			jQuery(".sno-lfc-options").slideUp('slow');
			jQuery(".sno-sr-options").slideUp('slow');
			jQuery(".sno-ss-options").slideUp('slow');
			jQuery(".sno-ssc-options").slideUp('slow');
			jQuery(".sno-grid-options").slideUp('slow');
			jQuery(".sno-gridc-options").slideUp('slow');
		}
	});

</script>

<?php

}


add_action( 'save_post', 'sno_format_meta_box_save' );
function sno_format_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'sno_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
			)
		);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['sno_headline'] ) && ($_POST['sno_headline']) )
		update_post_meta( $post_id, 'sno_headline', esc_attr( $_POST['sno_headline'] ) );
	if( isset( $_POST['sno_deck'] ) )
		update_post_meta( $post_id, 'sno_deck', wp_kses( $_POST['sno_deck'], $allowed ) );		
	if( isset( $_POST['sno_format'] ) && ($_POST['sno_format']) )
		update_post_meta( $post_id, 'sno_format', esc_attr( $_POST['sno_format'] ) );
	if( isset( $_POST['sno_longform_list'] ) && ($_POST['sno_longform_list']) )
		update_post_meta( $post_id, 'sno_longform_list', esc_attr( $_POST['sno_longform_list'] ) );
	if( isset( $_POST['sno_longform_order'] ) && ($_POST['sno_longform_order'])  )
		update_post_meta( $post_id, 'sno_longform_order', esc_attr( $_POST['sno_longform_order'] ) );
	if( isset( $_POST['sno_sidebyside_list'] ) && ($_POST['sno_sidebyside_list'])  )
		update_post_meta( $post_id, 'sno_sidebyside_list', esc_attr( $_POST['sno_sidebyside_list'] ) );
	if( isset( $_POST['sno_sidebyside_order'] ) && ($_POST['sno_sidebyside_order'])  )
		update_post_meta( $post_id, 'sno_sidebyside_order', esc_attr( $_POST['sno_sidebyside_order'] ) );
	if( isset( $_POST['sno_longform_title'] ) )
		update_post_meta( $post_id, 'sno_longform_title', esc_attr( $_POST['sno_longform_title'] ) );
	if( isset( $_POST['sno_sr_tag'] ) && ($_POST['sno_sr_tag'])  )
		update_post_meta( $post_id, 'sno_sr_tag', esc_attr( $_POST['sno_sr_tag'] ) );
	if( isset( $_POST['sno_sr_cat'] ) && ($_POST['sno_sr_cat'])  )
		update_post_meta( $post_id, 'sno_sr_cat', esc_attr( $_POST['sno_sr_cat'] ) );
	if( isset( $_POST['sno_sr_title'] ) )
		update_post_meta( $post_id, 'sno_sr_title', esc_attr( $_POST['sno_sr_title'] ) );
	if( isset( $_POST['sno_longform_main_title'] ) )
		update_post_meta( $post_id, 'sno_longform_main_title', esc_attr( $_POST['sno_longform_main_title'] ) );
	if( isset( $_POST['sno_rails_number'] ) && ($_POST['sno_rails_number'])  )
		update_post_meta( $post_id, 'sno_rails_number', esc_attr( $_POST['sno_rails_number'] ) );
	if( isset( $_POST['sno_rails_writer'] ) && ($_POST['sno_rails_writer'])  )
		update_post_meta( $post_id, 'sno_rails_writer', esc_attr( $_POST['sno_rails_writer'] ) );
	if( isset( $_POST['sno_rails_type'] ) && ($_POST['sno_rails_type'])  )
		update_post_meta( $post_id, 'sno_rails_type', esc_attr( $_POST['sno_rails_type'] ) );
	if( isset( $_POST['sno_rails_stories'] ) && ($_POST['sno_rails_stories'])  )
		update_post_meta( $post_id, 'sno_rails_stories', esc_attr( $_POST['sno_rails_stories'] ) );
	if( isset( $_POST['sno_longform_image'] ) && ($_POST['sno_longform_image'])  ) {
		update_post_meta( $post_id, 'sno_longform_image', esc_attr( $_POST['sno_longform_image'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_longform_image'); 
	}
	if( isset( $_POST['sno_longform_image_master'] ) && ($_POST['sno_longform_image_master']) ) {
		update_post_meta( $post_id, 'sno_longform_image_master', esc_attr( $_POST['sno_longform_image_master'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_longform_image_master'); 
	}
	if( isset( $_POST['sno_network_ads'] ) && ($_POST['sno_network_ads']) ) {
		update_post_meta( $post_id, 'sno_network_ads', esc_attr( $_POST['sno_network_ads'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_network_ads'); 
	}
	if( isset( $_POST['sno_longform_story_override'] ) && ($_POST['sno_longform_story_override']) ) {
		update_post_meta( $post_id, 'sno_longform_story_override', esc_attr( $_POST['sno_longform_story_override'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_longform_story_override'); 
	}
	if( isset( $_POST['sno_longform_story_override_kill'] ) && ($_POST['sno_longform_story_override_kill']) ) {
		update_post_meta( $post_id, 'sno_longform_story_override_kill', esc_attr( $_POST['sno_longform_story_override_kill'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_longform_story_override_kill'); 
	}
	if( isset( $_POST['sno_sidebyside_title'] ) && ($_POST['sno_sidebyside_title']) ) {
		update_post_meta( $post_id, 'sno_sidebyside_title', esc_attr( $_POST['sno_sidebyside_title'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_sidebyside_title'); 
	}
	if( isset( $_POST['sno_sidebyside_image'] ) && ($_POST['sno_sidebyside_image']) ) {
		update_post_meta( $post_id, 'sno_sidebyside_image', esc_attr( $_POST['sno_sidebyside_image'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_sidebyside_image'); 
	}

	// grid template variables
	if( isset( $_POST['sno_grid_main_title'] ) )
		update_post_meta( $post_id, 'sno_grid_main_title', esc_attr( $_POST['sno_grid_main_title'] ) );
	if( isset( $_POST['sno_grid_story_override'] ) && ($_POST['sno_grid_story_override']) ) {
		update_post_meta( $post_id, 'sno_grid_story_override', esc_attr( $_POST['sno_grid_story_override'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_grid_story_override'); 
	}
	if( isset( $_POST['sno_grid_chapter_title'] ) && ($_POST['sno_grid_chapter_title']) ) {
		update_post_meta( $post_id, 'sno_grid_chapter_title', esc_attr( $_POST['sno_grid_chapter_title'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_grid_chapter_title'); 
	}
	if( isset( $_POST['sno_grid_story_override_kill'] ) && ($_POST['sno_grid_story_override_kill']) ) {
		update_post_meta( $post_id, 'sno_grid_story_override_kill', esc_attr( $_POST['sno_grid_story_override_kill'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_grid_story_override_kill'); 
	}
	if( isset( $_POST['sno_grid_columns'] ) && ($_POST['sno_grid_columns']) )
		update_post_meta( $post_id, 'sno_grid_columns', esc_attr( $_POST['sno_grid_columns'] ) );
	if( isset( $_POST['sno_grid_image_master'] ) && ($_POST['sno_grid_image_master'])  ) {
		update_post_meta( $post_id, 'sno_grid_image_master', esc_attr( $_POST['sno_grid_image_master'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_grid_image_master'); 
	}
	if( isset( $_POST['sno_grid_order'] ) && ($_POST['sno_grid_order']) )
		update_post_meta( $post_id, 'sno_grid_order', esc_attr( $_POST['sno_grid_order'] ) );
	if( isset( $_POST['sno_grid_list'] ) && ($_POST['sno_grid_list']) )
		update_post_meta( $post_id, 'sno_grid_list', esc_attr( $_POST['sno_grid_list'] ) );
	if( isset( $_POST['sno_grid_title'] ) && ($_POST['sno_grid_title']) ) {
		update_post_meta( $post_id, 'sno_grid_title', esc_attr( $_POST['sno_grid_title'] ) ); 
	} else {
		delete_post_meta( $post_id, 'sno_grid_title'); 
	}
	
	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Side Rails') ) {
		
		delete_post_meta ($post_id, 'sno_rails_writer');
		delete_post_meta ($post_id, 'sno_rails_type');
		delete_post_meta ($post_id, 'sno_rails_number');
		delete_post_meta ($post_id, 'sno_rails_stories');
		delete_post_meta ($post_id, 'sno_sr_title');
		delete_post_meta ($post_id, 'sno_sr_tag');
		delete_post_meta ($post_id, 'sno_sr_cat');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Side by Side') ) {
		
		delete_post_meta ($post_id, 'sno_sidebyside_title');
		delete_post_meta ($post_id, 'sno_sidebyside_image');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Side by Side Chapter') ) {
		
		delete_post_meta ($post_id, 'sno_sidebyside_list');
		delete_post_meta ($post_id, 'sno_sidebyside_order');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Grid') ) {
		
		delete_post_meta ($post_id, 'sno_grid_main_title');
		delete_post_meta ($post_id, 'sno_grid_columns');
		delete_post_meta ($post_id, 'sno_grid_title');
		delete_post_meta ($post_id, 'sno_grid_image_master');
		delete_post_meta ($post_id, 'sno_grid_story_override');
		delete_post_meta ($post_id, 'sno_grid_story_override_kill');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Grid Chapter') ) {
		
		delete_post_meta ($post_id, 'sno_grid_list');
		delete_post_meta ($post_id, 'sno_grid_order');
		delete_post_meta ($post_id, 'sno_grid_chapter_title');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Long-Form') ) {
		
		delete_post_meta ($post_id, 'sno_longform_main_title');
		delete_post_meta ($post_id, 'sno_longform_image_master');
		delete_post_meta ($post_id, 'sno_longform_story_override');
		delete_post_meta ($post_id, 'sno_longform_story_override_kill');
		
	}

	if ( isset( $_POST['sno_format'] ) && ($_POST['sno_format'] != 'Long-Form Chapter') ) {
		
		delete_post_meta ($post_id, 'sno_longform_list');
		delete_post_meta ($post_id, 'sno_longform_order');
		delete_post_meta ($post_id, 'sno_longform_title');
		delete_post_meta ($post_id, 'sno_longform_image');
		
	}
	
		$writers = get_post_meta($post_id, 'writer', false);
		foreach ($writers as $writer) {
			$writer = trim ($writer); $writer = str_replace(' ', '_', $writer); $writer = str_replace("'", "", $writer);
			delete_transient( "sno_sp_$writer" );
			delete_transient( "sno_sp_mini_$writer" );
		}
		$videographers = get_post_meta($post_id, 'videographer', false);
		
		if (count($videographers) != 0) foreach ($videographers as $videographer) {
			$videographer = trim ($videographer); $videographer = str_replace(' ', '_', $videographer); $videographer = str_replace("'", "", $videographer);
			delete_transient( "sno_sp_$videographer" );
			delete_transient( "sno_sp_mini_$videographer" );
		}

	if (get_post_meta($post_id, '_mf_write_panel_id', true) == sno_staff_write_panel_id()) {
		$staff_name = get_post_meta($post_id, 'name', true);
		$staff_name = trim ($staff_name); $staff_name = str_replace(' ', '_', $staff_name); $staff_name = str_replace("'", "", $staff_name);
		delete_transient( "sno_sp_$staff_name" );
		delete_transient( "sno_sp_mini_$staff_name" );
		delete_transient( "sno_sp_byline_jobtitle_$staff_name" );
	}

}

add_action( 'add_meta_boxes', 'sno_teaser_meta_box_add' );
function sno_teaser_meta_box_add()
{
	add_meta_box( 'sno_teaser_meta_box_id', 'Custom Excerpt', 'sno_teaser_meta_box', 'post', 'side', 'high' );
}

function sno_teaser_meta_box( $post )
{
	$sno_teaser = get_post_meta( $post->ID, 'sno_teaser', true );
	wp_nonce_field( 'sno_meta_box_nonce', 'meta_box_nonce' );
	?>
	
	<textarea name="sno_teaser" cols=27 rows=5><?php echo $sno_teaser ?></textarea></p>
	<p style="font-style:italic">This excerpt will display on all pages except the story page. Leave this field blank for an auto-generated excerpt.</p>	
	<?php

}
add_action( 'save_post', 'sno_teaser_meta_box_save' );
function sno_teaser_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'sno_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
			)
		);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['sno_teaser'] ) )
		update_post_meta( $post_id, 'sno_teaser', wp_kses( $_POST['sno_teaser'], $allowed ) );				
}

function sno_mce_edit( $init ) {
	$init['theme_advanced_disable'] = 'blockquote,underline,wp_help,StarRating,justifyleft,justifyright,justifycenter';
	return $init;
}
add_filter('tiny_mce_before_init', 'sno_mce_edit');


function sno_pullquote_func( $atts, $content=null ) {
	
	$bordercolor = get_theme_mod('story-element-border-color'); 
	if ($bordercolor == '') { $bordercolor = get_theme_mod('accentcolor-links'); }

	$pullquotecolor = get_theme_mod('story-element-pullquote-color'); 
	if ($pullquotecolor == '') { $pullquotecolor = get_theme_mod('accentcolor-links'); }
	
	extract(shortcode_atts(array(
		"align" => 'right',
		"speaker" => '',
		"photo" => '',
		"background" => 'on',
		"shadow" => 'off',
		"border" => 'none'
		), $atts));
	global $post; $widgetstyle = ''; $pic = ''; $story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($story_template == "Side Rails") {
		if (($align != "left") && ($align !="right")) $align = "right";
	}
	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";
	
	if ($photo) {
		$sno_attribution = get_option('sno_analytics_options');
		if ($sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
			$image = wp_get_attachment_image_src( $photo, 'medium');
		} else {
			$image = wp_get_attachment_image_src( $photo, 'tsmediumblock');
		}
		if ($image) {
			$pic = '<div class="pullquotepic"><img src="' . $image[0] . '" style="width:100%;" alt="Pullquote Photo" /></div>'; 
		}
	}
	
	$pullquote = "<div class='pullquote $align $widgetstyle sno-animate' style='border-color: $bordercolor;'><div class='largequote' style='color: $pullquotecolor;'>&ldquo;</div>$pic<p class='pullquotetext'>$content&rdquo;</p>";
	if ($speaker) $pullquote .= "<p class='quotespeaker'>&mdash; $speaker</p>";
	$pullquote .= "</div>";

	return $pullquote;
}
add_shortcode( 'pullquote', 'sno_pullquote_func' );

// shortcode for related stories boxes in stories

function sno_related_posts( $atts, $content=null ) {
	global $post; $widgetstyle = ''; $o = ''; $i = 0;
	extract(shortcode_atts(array(
		"stories" => '',
		"align" => 'left',
		"title" => 'Related Content',
		"background" => 'on',
		"shadow" => 'off',
		"border" => 'none',
		"sidebyside" => '',
		), $atts));

	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

	if ($sidebyside) $stories .= ','.$sidebyside;

	$story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($stories) {
		if (($align == 'center') && ($story_template == 'Side Rails')) { $divalign = "relatedvert right"; $align = "right"; } else if ($align == 'center') { $divalign = 'relatedcenter'; } else { $divalign = "relatedvert $align"; }
		$o .= "<div class='related $divalign $widgetstyle sno-animate' style='border-color: $color;'><h5>$title</h5>";
		$allstories = explode(",",$stories);
		foreach ($allstories as $story) {
			$storydata = get_post($story);
			if ( 'post' == get_post_type($story)) {
				$i++; if ($i<5) {
					$relatedposition = 'related-' . $i;
					if (($i>1) && ($align != 'center')) $o .= "<div class='relateddivider'></div>";
					if (($i>1) && ($align == 'center')) $o .= "<div class='relateddividervert sno-animate $relatedposition'></div>";
					if ($align == 'center') $o .= "<div class='relatedrow sno-animate $relatedposition'>";
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($story), 'tsmediumblock');
					if ($image) {
						$o .= '<a href="' . get_permalink($story) . '" title="'. $storydata->post_title .'"><img src="' . $image[0] . '" style="width:100%" class="catboxphoto" alt="' . $storydata->post_title . '" /></a>'; 
					}
					$o .= '<h5 class="relatedtitle">';
					if ($story == $sidebyside) { 
						$o .= '<a href="' . get_permalink($story) . '">View Side by Side</a>';
					} else {
						$o .= '<a href="' . get_permalink($story) . '">' . $storydata->post_title . '</a>';
					}
					$o .= '</h5>';
					if (($image == "") && ($align == "center")) {
						$o .= '<p class="relatedteaser">';
						$storycontent = $storydata->post_content;
						$storycontent = strip_tags($storycontent);
						$storycontent = strip_shortcodes($storycontent);
						$o .= substr($storycontent, 0, 150);
						$o .= '...</p>';
						$teaser = '';
					}


					if ($align == 'center') $o .= '</div>';			
				}
			}

		}
		$o .= '<div class="clear"></div>';
		$o .= '</div>';
	}
	return $o;

}
add_shortcode( 'related', 'sno_related_posts' );

// shortcode for video in posts

remove_shortcode('video');
function sno_video_shortcode( $atts, $content=null ) {
	extract(shortcode_atts(array(
		"align" => 'center',
		"credit" => '',
		"background" => '',
		"shadow" => '',
		"border" => 'off'
		), $atts));

	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }
	
	$widgetid = mt_rand(1, 10000);

	global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true); if ($story_template != "Side Rails") $opacity = ' style="opacity:.4"'; 
	$video = "<div id='video$widgetid' $opacity class='videowidget $align $widgetstyle' style='border-color: $color;'><div class='embedcontainer'>$content</div>$credit</div>";

	if ($opacity) $video .= "<script type='text/javascript'>
		$(document).ready(function() {
			$(function () {
				$(window).scroll(function () {
					var scrollTop$widgetid     = $(window).scrollTop(),
					elementOffset$widgetid = $('#video$widgetid').offset().top,
					distance$widgetid      = (elementOffset$widgetid - scrollTop$widgetid);
					if ((distance$widgetid < 400) && (distance$widgetid > 80)) {
						$('#video$widgetid').stop().animate({'opacity': '1'}, 'slow');

					} else {
						$('#video$widgetid').stop().animate({'opacity': '.4'}, 'slow'); 			
					}


				});
})

})
</script>				
";

return $video;
}
add_shortcode( 'video', 'sno_video_shortcode' );

// shortcode for infographic embed

function sno_infographic_shortcode( $atts, $content=null ) {
	extract(shortcode_atts(array(
		"align" => 'center'
		), $atts));
	
	$video = "<div class='infographicwidget'><div class='$align'>$content</div></div>";

	return $video;
}
add_shortcode( 'infographic', 'sno_infographic_shortcode' );

// shortcode for audio clip embed

function sno_audioclip_shortcode( $atts, $content=null ) {
	extract(shortcode_atts(array(
		"align" => 'center'
		), $atts));
	
	$video = "<div class='infographicwidget'><div class='$align'>$content</div></div>";

	return $video;
}
add_shortcode( 'audioclip', 'sno_audioclip_shortcode' );


// shortcode for generic in-story sidebar elements

function sno_sidebar_shortcode( $atts, $content=null ) {
	extract(shortcode_atts(array(
		"align" => 'left',
		"title" => '',
		"photo" => '',
		"background" => 'on',
		"shadow" => 'off',
		"border" => 'none'
		), $atts));
	
	global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($story_template == "Side Rails") {
		if (($align != "left") && ($align !="right")) $align = "right";
	}
	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

	if ($photo) {
		$image = wp_get_attachment_image_src( $photo, 'tsmediumblock');
		if ($image) {
			$pic = '<div class="sidebarpic"><img src="' . $image[0] . '" style="width:100%;" alt="Sidebar Photo" /></div>'; 
		}
	}
	
	$sidebar .= "<div class='storysidebar relatedvert $align $widgetstyle sno-animate' style='border-color: $color;'>";
	if ($pic) $sidebar .= $pic;
	if ($title) $sidebar .= "<h5>$title</h5>";
	$sidebar .= $content;
	$sidebar .= "</div>";

	return $sidebar;
}
add_shortcode( 'sidebar', 'sno_sidebar_shortcode' );

// shortcode for galleries in posts

remove_shortcode('gallery');
function sno_gallery_shortcode( $atts, $content=null ) {
	global $post; $o = '';
	extract(shortcode_atts(array(
		"ids" => '',
		), $atts));

	if ($ids) {
		$allphotos = explode(",",$ids);
		$unique = mt_rand(1, 1000000);	

	  	if (get_theme_mod('slideshow-type') == 'Inline') {
		  	
			$slideshow = sno_get_inline_slideshow($allphotos, "WP Gallery", $number=null, $instance=null, $widget_id=null, $unique);
			$o .= $slideshow;
			
	  	} else {
					
	  		$slide_number = count($allphotos);
  					$o .= '<div class="photowrap">';
  					$o .= "<div class='sfiphotowrap sfiphotowrap$unique modal-photo$unique'>";
					
					$image = wp_get_attachment_image_src($allphotos[0], 'large', false);
					$vertical = '';
					if ($image[2] > $image[1]) $vertical = 'max-width: 400px; margin: 0 auto;';

					$o .= "<div id='storypageslideshow$unique' style='$vertical'>";
							
							$o .= '<div class="slideshowwrap">';
									$o .= '<img src="' . $image[0] . '" style="width:100%;' . $vertical . '" class="catboxphoto slideshow-photo" />'; 
								$o .= "<a class='modal-photo$unique' href='#slideshow$unique'><div class='slideshow-enlarge'>";
									$o .= '<div class="fa fa-clone slideshow-icon"></div>';
									$o .= "<div class='slideshow-title'>Gallery<span class='v-divider'>|</span>$slide_number Photos</div>";
								$o .= '</div></a>';
							$o .= '</div>';

	   						
							$photographer = sno_sfi_photographer($allphotos[0]);
							$caption = get_post_field('post_excerpt', $allphotos[0]);
	   						
	   						if ($photographer || $caption) $o .= '<div class="captionboxmittop">';

							if ($photographer) $o .= $photographer; 
	   													
							if ($caption) { 
								$o .= '<div class="photocaption">'.$caption.'</div>'; 
	   						} 
	   						
	   						if ($photographer || $caption) { $o .= '</div>'; } else { $o .= '<div class="photobottom"></div>'; }

				
					$o .= '</div>';
					$o .= '</div>';
					$o .= '</div>';		
					$o .= '<div class="photobottom"></div>';
					$o .= '<div class="clear"></div>';
		}
						// overlay slideshow display
						
						$o .= "<div class='remodal remodal-story-image' data-remodal-id='modal-photo$unique' data-remodal-options='hashTracking: false, closeOnConfirm: false'>";

							$o .= '<button data-remodal-action="close" class="remodal-close"><span class="icon-hidden-text">Close</span></button>';
							$o .= "<div class='photo-container$unique'>";
								$o .= '<div id="listloader" class="spinner" style="display:block;float:none;margin:45vh auto;">
									<div class="bounce1"></div>
									<div class="bounce2"></div>
									<div class="bounce3"></div>
									</div>'; 

							$o .= "</div>";
						$o .= "</div>";
						
						$gallery_post_id = $post->ID;
						$color1 = get_theme_mod('reset-color1');
						
						$o .= "<script type='text/javascript'>

								var sno_slideshow_open = 'no';
									$('html').on('wheel', function(event) {
										var delta = {
											y: event.originalEvent.deltaY
										};
													
									if (delta.y > 20 && sno_slideshow_open == 'yes') {
											$('button.remodal-close').trigger('click');
											sno_slideshow_open = 'no';
										}
									});

								$('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
								$('.flex-container').css('background', 'unset');
								$(document).ready(function() {
									$('html').on('click', 'button.remodal-close', function(){
										sno_slideshow_open = 'no';
									});
									$('html').on('click', '.sfi-return-to-story', function(){
										sno_slideshow_open = 'no';
									});
									$('body').keypress(function(e){
										if(e.which == 27 || e.which == 0){
											sno_slideshow_open = 'no';
										}
									});									
									$(function(){
										$('.modal-photo$unique').click(function() {
											var image = $(this).attr('data-image');
											sno_slideshow_open = 'yes';
											var inst = $('[data-remodal-id=modal-photo$unique]').remodal();
											var photoids = '$ids';
											var unique = '$unique';
											var storyid = '$gallery_post_id';
											inst.open();
											
											$.ajax({
												url:'/wp-admin/admin-ajax.php',
												type:'POST',
												data:'action=getslideshow&photoids=' + photoids + '&unique=' + unique + '&storyid=' + storyid + '&image=' + image,
												success:function(results)
													{ $('.photo-container$unique').replaceWith(results); }
	           								});
										});
									});
									$('.sfiphotowrap$unique').hover(function(){
										$('.slideshow-enlarge').css('background', '$color1');
									}, function(){
										$('.slideshow-enlarge').css('background', '#000');
									})
								});
						</script>";
						
		
	}
	return $o;
}
add_shortcode( 'gallery', 'sno_gallery_shortcode' );

// shortcode for adding poll to story

remove_shortcode('poll');
function sno_poll_shortcode($atts) {
	extract(shortcode_atts(array(
		'id' => 0,
		'align' => 'right', 
		'type' => 'vote',
		'background' => 'on',
		'shadow' => 'off',
		'border' => 'none'
		), $atts));

	if(!is_feed()) {
		$id = intval($id);
		global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true);
		if ($story_template == "Side Rails") {
			if (($align != "left") && ($align !="right")) $align = "right";
		}
		if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
		if ($shadow == "on") $widgetstyle .= " shadow";
		if ($border == "left") $widgetstyle .= " borderleft";
		if ($border == "right") $widgetstyle .= " borderright";
		if ($border == "top") $widgetstyle .= " bordertop";
		if ($border == "bottom") $widgetstyle .= " borderbottom";
		if ($border == "all") $widgetstyle .= " borderall";

		$color = get_theme_mod('story-element-border-color'); 
		if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

		$o = "<div class='sno-poll $align $widgetstyle sno-animate' style='border-color: $color;'>";

		if($type == 'vote') {
			$o .= get_poll($id, false);
		} elseif($type == 'result') {
			$o .= display_pollresult($id);
		}
		
		$o .= "</div>";
		return $o;

	} else {
		return __('Note: There is a poll embedded within this post, please visit the site to participate in this post\'s poll.', 'wp-polls');
	}
}
add_shortcode('poll', 'sno_poll_shortcode');

// shortcode for adding roster to story


function sno_roster_shortcode($atts) {

	extract(shortcode_atts(array(
		'align' => 'left', 
		'title' => '',
		'sport' => '',
		'season' => '',
		'background' => 'on',
		'shadow' => 'off',
		'border' => 'none'
		), $atts));

	global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($story_template == "Side Rails") {
		if (($align != "left") && ($align !="right")) $align = "right";
	}
	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

	if (($sport) && ($season)) {
		global $wpdb;

		$sport = str_replace('&amp;', '&', $sport);
		$sport = addslashes($sport); 
		
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
			AND roster_season.meta_value = '$season'
			)
		AND $wpdb->posts.post_status = 'publish'
		ORDER BY CAST(roster_jersey.meta_value AS UNSIGNED INTEGER ) ASC,
		roster_name.meta_value ASC
		";

$pageposts = $wpdb->get_results($querystr, OBJECT);
$count = 0;


if ($pageposts):
	foreach ($pageposts as $post):

		global $post; setup_postdata($post); 
		
			$roster_name = ''; $roster_link = ''; $roster_jersey = ''; $roster_grade = ''; $roster_position = '';
			
			$custom_fields = get_post_custom($post->ID);

			if (isset($custom_fields['roster_name'])) $roster_name = $custom_fields['roster_name'][0];
			if (isset($custom_fields['roster_link'])) $roster_link = $custom_fields['roster_link'][0];
			if (isset($custom_fields['roster_jersey'])) $roster_jersey = $custom_fields['roster_jersey'][0];
			if (isset($custom_fields['roster_grade'])) $roster_grade = $custom_fields['roster_grade'][0];
			if (isset($custom_fields['roster_position'])) $roster_position = $custom_fields['roster_position'][0];

	$count++;
	if ($count == 1) {

		$o .= "<div class='storysidebar storyroster $align $widgetstyle sno-animate' style='border-color: $color;'>";
		$o .= '<h5>';
		if ($title) { $o .= $title; } else { $o .= $season . ' ' . stripslashes($sport) . ' Roster'; }
		$o .= '</h5>';

		$o .= '<table class="sportssidebar">';
		$o .= '<thead>';
		$o .= '<tr class="sidebarhead">';
		$o .= '<th class="tablecenter">Jersey</th>';
		$o .= '<th>Name</th>';
		$o .= '<th class="tablecenter">Position</th>';
		$o .= '<th class="tablecenter">Grade</th>';
		$o .= '</tr>';
		$o .= '</thead>';
		$o .= '<tbody>';

	}

	if ($roster_name) {

		$o .= '<tr class="rosterrow">';
		$o .= '<td class="tablecenter">' . $roster_jersey . '</td>';
		$o .= '<td>';
		if ( term_exists( $roster_name, 'post_tag' ) ) {
			$ketag = "";
			$ketag[] = get_term_by( 'name', $roster_name, 'post_tag', ARRAY_A ); 
			foreach($ketag[0] as $key => $value) { 
				if ($key == "term_id") $tagID = $value; 
			}
			$o .= ' <a href="' . get_tag_link($tagID) . '">' . $roster_name . '</a>';
		} else {
			$o .= $roster_name;
		}
		if ($roster_link) {
			$o .= ' <a href="' . $roster_link . '">(Profile)</a>';
		} 
		if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
		$o .= '</td>';
		$o .= '<td class="tablecenter">' . $roster_position . '</td>';
		$o .= '<td class="tablecenter">' . $roster_grade . '</td>';
		$o .= '</tr>';

	}

	endforeach; 
	else : endif;

	if ($count >= 1) {
		$o .= '</tbody>';
		$o .= '</table>';	
		$o .= '</div>';
	}
}
return $o;
}
if (get_option('ssno') == "ssno928462s") add_shortcode('roster', 'sno_roster_shortcode');

// shortcode for adding sports standings to story

function sno_standings_shortcode($atts) {

	extract(shortcode_atts(array(
		'align' => 'left', 
		'sport' => '',
		'season' => '',
		'title' => '',
		'type' => 'conference',
		'background' => 'on',
		'shadow' => 'off',
		'border' => 'none'
		), $atts));

	global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($story_template == "Side Rails") {
		if (($align != "left") && ($align !="right")) $align = "right";
	}
	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

	if (($sport) && ($season)) {
		global $wpdb;

		$o .= "<div class='storysidebar storyroster $align $widgetstyle sno-animate' style='border-color: $color;'>";

// team conference standings
		if ($type == "conference") {
		
		$sport = str_replace('&amp;', '&', $sport);
		$sport = addslashes($sport); 

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
				AND sport.meta_value = '$sport'
				)
			JOIN $wpdb->postmeta AS season ON(
				$wpdb->posts.ID = season.post_id
				AND season.meta_value = '$season'
				)
			AND $wpdb->posts.post_status = 'publish'
			ORDER BY CAST(conferencewins.meta_value AS UNSIGNED INTEGER ) DESC, 
			CAST(conferencelosses.meta_value AS UNSIGNED INTEGER ) ASC
			";

$pageposts = $wpdb->get_results($querystr, OBJECT);

$count = 0; 

if ($pageposts):
	foreach ($pageposts as $post):

		setup_postdata($post); 

		$conference = ''; $school = ''; $conferencewins = ''; $conferencelosses = ''; $conferenceties = ''; $totalwins = ''; $totallosses = ''; $totalties = '';
		
		$custom_fields = get_post_custom($post->ID);
		if (isset($custom_fields['conference'])) $conference = $custom_fields['conference'][0];
	
	if ($conference == "true") { 
	
		if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
		if (isset($custom_fields['conferencewins'])) $conferencewins = $custom_fields['conferencewins'][0];
		if (isset($custom_fields['conferencelosses'])) $conferencelosses = $custom_fields['conferencelosses'][0];
		if (isset($custom_fields['conferenceties'])) $conferenceties = $custom_fields['conferenceties'][0];
		if (isset($custom_fields['totalwins'])) $totalwins = $custom_fields['totalwins'][0];
		if (isset($custom_fields['totallosses'])) $totallosses = $custom_fields['totallosses'][0];
		if (isset($custom_fields['totalties'])) $totalties = $custom_fields['totalties'][0];


		$count++; if ($count == 1) {
			$o .= '<h5>';
			if ($title) { $o .= $title; } else { $o .= $season . ' ' . stripslashes($sport) . ' Standings'; }
			$o .= '</h5>';
			$o .= '<table class="sportssidebar">';
			$o .= '<tr class="sidebarhead">';
			$o .= '<td width=160 class="tableindent">Team</td>';
			$o .= '<td width=70 class="tablecenter">Conference</td>';
			$o .= '<td width=70 class="tablecenter">Overall</td>';
			$o .= '</tr>';
			$footerkey = 5; 
		}

		$o .= '<tr class="rosterrow">';
		$o .= '<td class="tableindent">' . $school;
		if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
		$o .= '</td>';
		$o .= '<td class="tablecenter">' . $conferencewins . '-' . $conferencelosses;
			if ($conferenceties != '' && $conferenceties != 0) $o .= '-' . $conferenceties;
			$o .= '</td>';
		$o .= '<td class="tablecenter">' . $totalwins . '-' . $totallosses;
			if ($totalties != '' && $totalties != 0) $o .= '-' . $totalties;
			$o .= '</td>';
		$o .= '</tr>';

	}

	endforeach; 
	else : endif;

	if ($footerkey == 5) $o .= '</table>';
}
// team playoff standings
if ($type == "playoff") {

	$sport = str_replace('&amp;', '&', $sport);
	$sport = addslashes($sport); 

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
		AND sport.meta_value = '$sport'
		)
	JOIN $wpdb->postmeta AS season ON(
		$wpdb->posts.ID = season.post_id
		AND season.meta_value = '$season'
		)
	AND $wpdb->posts.post_status = 'publish'
	ORDER BY CAST(totalwins.meta_value AS UNSIGNED INTEGER ) DESC, 
	CAST(totallosses.meta_value AS UNSIGNED INTEGER ) ASC
	";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

$count = 0; $footerkey = 0;

if ($pageposts):
	foreach ($pageposts as $post):
	
		$section = ''; $school = ''; $totalwins = ''; $totallosses = ''; $totalties = '';

		setup_postdata($post);
		$custom_fields = get_post_custom($post->ID);
		if (isset($custom_fields['section'])) $section = $custom_fields['section'][0];

	 if ($section == "true") {

		if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
		if (isset($custom_fields['totalwins'])) $totalwins = $custom_fields['totalwins'][0];
		if (isset($custom_fields['totallosses'])) $totallosses = $custom_fields['totallosses'][0];
		if (isset($custom_fields['totalties'])) $totalties = $custom_fields['totalties'][0];

		$count++; if ($count == 1) {
			$o .= '<h5>';
			if ($title) { $o .= $title; } else { $o .= $season . ' ' . stripslashes($sport) . ' Standings'; }
			$o .= '</h5>';
			$o .= '<table class="sportssidebar">';
			$o .= '<tr class="sidebarhead">';
			$o .= '<td width=220 class="tableindent">Team</td>';
			$o .= '<td width=80 class="tablecenter">Overall</td>';
			$o .= '</tr>';
			$footerkey = 5;
		}

		$o .= '<tr class="rosterrow">';
		$o .= '<td class="tableindent">' . $school;
		if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
		$o .= '</td>';
		$o .= '<td class="tablecenter">' . $totalwins . '-' . $totallosses;
			if ($totalties != '' || $totalties != 0) $o .= '-' . $totalties;
			$o .= '</td>';
		$o .= '</tr>';
	} 

	endforeach; 
	else : endif; 

	if ($footerkey == 5) $o .= '</table>';
}
// team state rankings
if ($type == "staterank") {

	$sport = str_replace('&amp;', '&', $sport);
	$sport = addslashes($sport); 

	$querystr = "
	SELECT * FROM $wpdb->posts
	JOIN $wpdb->postmeta AS staterank ON(
		$wpdb->posts.ID = staterank.post_id
		AND staterank.meta_key = 'staterank'
		AND staterank.meta_value != ''
		)
	JOIN $wpdb->postmeta AS sport ON(
		$wpdb->posts.ID = sport.post_id
		AND sport.meta_value = '$sport'
		)
	JOIN $wpdb->postmeta AS season ON(
		$wpdb->posts.ID = season.post_id
		AND season.meta_value = '$season'
		)
	AND $wpdb->posts.post_status = 'publish'
	ORDER BY CAST(staterank.meta_value AS UNSIGNED INTEGER ) ASC
	";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

$count = 0; $footerkey = 0; 

if ($pageposts): 
	foreach ($pageposts as $post):
		
		$school = ''; $staterank = '';

		setup_postdata($post);
		$custom_fields = get_post_custom($post->ID);
			if (isset($custom_fields['school'])) $school = $custom_fields['school'][0];
			if (isset($custom_fields['staterank'])) $staterank = $custom_fields['staterank'][0];

	$count++; if ($count == 1) { 

		$o .= '<h5>';
		if ($title) { $o .= $title; } else { $o .= $season . ' ' . stripslashes($sport) . ' Rankings'; }
		$o .= '</h5>';
		$o .= '<table class="sportssidebar">';
		$o .= '<tr class="sidebarhead">';
		$o .= '<td width=220 class="tableindent">Team</td>';
		$o .= '<td width=80 class="tablecenter">State Rank</td>';
		$o .= '</tr>';
		$footerkey = 5;
	}


	$o .= '<tr class="rosterrow">';
	$o .= '<td class="tableindent">' . $school;
	if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
	$o .= '</td>';

	$o .= '<td class="tablecenter">' . $staterank;
	$o .= '</tr>';

	endforeach;  
	else : endif;

	if ($footerkey == 5) $o .= '</table>';

}

$o .= '</div>';

}
return $o;
}
if (get_option('ssno') == "ssno928462s") add_shortcode('standings', 'sno_standings_shortcode');


// shortcode for adding sports schedules to story


function sno_schedule_shortcode($atts) {

	extract(shortcode_atts(array(
		'align' => 'left', 
		'sport' => '',
		'season' => '',
		'title' => '',
		'background' => 'on',
		'shadow' => 'off',
		'border' => 'none'
		), $atts));

	global $post; $story_template = get_post_meta ($post->ID, 'sno_format', true);
	if ($story_template == "Side Rails") {
		if (($align != "left") && ($align !="right")) $align = "right";
	}
	if ($background == "on") { $widgetstyle .= " background-gray"; } else { $widgetstyle .= " background-white"; }
	if ($shadow == "on") $widgetstyle .= " shadow";
	if ($border == "left") $widgetstyle .= " borderleft";
	if ($border == "right") $widgetstyle .= " borderright";
	if ($border == "top") $widgetstyle .= " bordertop";
	if ($border == "bottom") $widgetstyle .= " borderbottom";
	if ($border == "all") $widgetstyle .= " borderall";

	$color = get_theme_mod('story-element-border-color'); 
	if ($color == '') { $color = get_theme_mod('accentcolor-links'); }

	if (($sport) && ($season)) {
		global $wpdb;

		$o .= "<div class='storysidebar storyroster $align $widgetstyle sno-animate' style='border-color: $color;'>";

		$o .= '<h5>';
		if ($title) { $o .= $title; } else { $o .= $season . ' ' . $sport; }
		$o .= '</h5>';

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

		$sport = str_replace('&amp;', '&', $sport);
		$sport = addslashes($sport); 
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
			AND season.meta_value = '$season'
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

$o .= '<tr class="sportstoprow rosterrow ' . $rowstyle .'">';
$o .= '<td class="tableindent">' . $date . '</td>';
$o .= '<td class="sportsone">' . substr($opponent, 0, 15);
if (current_user_can( 'edit_posts' )) $o .= '<a href=" ' . get_edit_post_link($post->ID) . '"> E</a>';
$o .= '</td>';
$o .= '<td>' . $score;
if ($storylink) $o .= ' <a href="' . $storylink . '">(Story)</a>';
$o .= '</td>';
$o .= '<td style="padding-right:5px;" class="tablecenter">' . $result . '</td>';
$o .= '</tr>';

endforeach;   
else :
	endif;

$o .= '</tbody>';
$o .= '</table>';
$o .= '</div>';	

}

return $o;
}
if (get_option('ssno') == "ssno928462s") add_shortcode('schedule', 'sno_schedule_shortcode');

// style controls for horizontal scrollers on homepage

function sno_scroller_styles($instance, $customcolors, $categoryslug, $categoryname, $scroller) {

	if ($instance['widget-style']=="Style 1") { ?>
	<h4 class="widget1" style="font-size:24px!important;line-height:27px!important;height:32px!important;text-align:center; <?php if ($customcolors=='snoccon') { ?>
		background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == 'On') { ?>url(/wp-content/themes/snoflex/images/navbg.png) repeat-x <?php } else if (($instance['widget-gradient'] == 'Off') && ($instance['widget-pattern'] != 'none')) { ?>url(/wp-content/themes/snoflex/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		color:<?php echo $instance['header-text']; ?> !important; 
		border-left:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-right:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-top:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		<?php } ?>">
		<a <?php if ($customcolors=="snoccon") { ?>style="color: <?php echo $instance['header-text']; ?> !important;"<?php } ?> href="<?php echo $categoryslug; ?>">
			<?php echo $categoryname; ?>
		</a>
	</h4> 
	<div class="<?php echo $scroller; ?>" style="
		<?php if ($customcolors=='snoccon') { ?>
		background-color:<?php echo $instance['widget-background']; ?> !important; 
		border-right:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-left:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-bottom:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important;
		<?php } else { ?>
		background:<?php echo get_theme_mod('widgetbackground1'); ?> !important;
		<?php } ?>
		">
		<?php } else if ($instance['widget-style']=="Style 2") { ?>
		<div style="
		overflow: hidden;
		<?php if ($customcolors=='snoccon') { ?> 
		border-bottom:<?php echo $instance['border-thickness2']; ?> solid <?php echo $instance['widget-border']; ?>; 
		border-top:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?>;
		background: <?php echo $instance['widget-background']; ?>; 
		margin-bottom:0px; 
		<?php } else { ?> 
		margin-bottom:0px; 
		border-bottom:<?php echo get_theme_mod('widget7-thickness2'); ?> solid <?php echo get_theme_mod('widgetborder7'); ?>; 
		border-top:<?php echo get_theme_mod('widget7-thickness'); ?> solid <?php echo get_theme_mod('widgetborder7'); ?>;
		background: <?php echo get_theme_mod('widgetbackground7'); ?>; 
		<?php } ?>
		">
		<h4 class="widget7" style="font-size:24px!important;text-align:center;line-height:24px!important;height:28px!important; <?php if ($customcolors=='snoccon') { ?>
			background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == 'On') { ?>url(/wp-content/themes/snoflex/images/navbg.png) repeat-x <?php } else if (($instance['widget-gradient'] == 'Off') && ($instance['widget-pattern'] != 'none')) { ?>url(/wp-content/themes/snoflex/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
			margin-top:1px;
			margin-bottom:1px;
			background-color: <?php echo $instance['header-color']; ?> !important; 
			color: <?php echo $instance['header-text']; ?> !important; 
			padding: 6px 0px 2px 0px; 
			<?php } ?>">
			<a <?php if ($customcolors=='snoccon') { ?>style="color: <?php echo $instance['header-text']; ?> !important;"<?php } ?> href="<?php echo $categoryslug; ?>">
				<?php echo $categoryname; ?>
			</a>
		</h4> 
	</div>
	<div class="<?php echo $scroller; ?>" style="
		padding: 0px!important;
		<?php if ($customcolors=='snoccon') { ?> 
		background-color:<?php echo $instance['widget-background']; ?> !important;
		border:none!important;
		<?php } ?>">
		<?php } else if ($instance['widget-style']=='Style 4') { ?>
		<div style="
		margin: 0px 0px 0px 0px; 
		padding: 10px 9px 0px 9px;  
		overflow: hidden; 
		<?php if ($customcolors=='snoccon') { ?> 
		background-color: <?php echo $instance['widget-background']; ?>; 
		border-left:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?>; 
		border-right:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?>; 
		border-top:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?>;
		<?php } else { ?> 
		background: <?php echo get_theme_mod('widgetbackground4'); ?>; 
		border-left: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		border-right: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		border-top: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		<?php } ?>
		">
		<h4 class="widget4" style="font-size:24px!important;text-align:center;line-height:24px!important;height:32px!important; <?php if ($customcolors=='snoccon') { ?>
			color: <?php echo $instance['header-text']; ?> !important;
			background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == 'On') { ?>url(/wp-content/themes/snoflex/images/navbg.png) repeat-x <?php } else if (($instance['widget-gradient'] == 'Off') && ($instance['widget-pattern'] != 'none')) { ?>url(/wp-content/themes/snoflex/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
			<?php } ?>">
			<a <?php if ($customcolors=='snoccon') { ?>style="color: <?php echo $instance['header-text']; ?> !important;"<?php } ?> href="<?php echo $categoryslug; ?>">
				<?php echo $categoryname; ?>
			</a>
		</h4>
	</div> 
	<div class="<?php echo $scroller; ?>" style="
		<?php if ($customcolors=='snoccon') { ?> 
		background-color: <?php echo $instance['widget-background']; ?> !important;
		border-right:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-left:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
		border-bottom:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important;
		<?php } else { ?> 
		background: <?php echo get_theme_mod('widgetbackground4'); ?>; 
		border-left: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		border-right: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		border-bottom: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
		<?php } ?>">
		<?php } else if ($instance['widget-style']=='Style 5') { ?>
		<h4 class="widget6" style="font-size:24px!important;text-align:center;line-height:24px!important;height:32px!important; <?php if ($customcolors=='snoccon') { ?>
			border:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important;
			color: <?php echo $instance['header-text']; ?> !important;
			background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == 'On') { ?>url(/wp-content/themes/snoflex/images/navbg.png) repeat-x <?php } else if (($instance['widget-gradient'] == 'Off') && ($instance['widget-pattern'] != 'none')) { ?>url(/wp-content/themes/snoflex/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
			<?php } ?>">
			<a <?php if ($customcolors=='snoccon') { ?>style="color: <?php echo $instance['header-text']; ?> !important;"<?php } ?> href="<?php echo $categoryslug; ?>">
				<?php echo $categoryname; ?>
			</a>
		</h4> 
		<div class="<?php echo $scroller; ?>" style="
			<?php if ($customcolors=='snoccon') { ?> 
			background-color:<?php echo $instance['widget-background']; ?> !important; 
			border-right:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
			border-left:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important; 
			border-bottom:<?php echo $instance['border-thickness']; ?> solid <?php echo $instance['widget-border']; ?> !important;
			<?php } ?>">
			<?php } 
		}


// redirect to template file based on custom fields
		function sno_story_page($single_template = null) {
			global $post;
			$story_format = get_post_meta($post->ID, 'sno_format', true);
			$name = get_post_meta($post->ID, 'name', true); 

			if ($name) { 

					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'snostaff.php',
						'hierarchical' => 0,
						'showposts' => 1
						));
					$name = str_replace(' ', '_', $name);
					foreach($pages as $page) { $staffurl = $page->ID; }
					$pagelink = get_permalink($staffurl);
					wp_redirect($pagelink . '?writer=' . rawurlencode($name), 301); exit;
					
			} else if ($story_format == 'Classic') {
				$single_template = dirname( __FILE__ ) . '/classic.php';
			} else if ($story_format == 'Full-Width') {
				$single_template = dirname( __FILE__ ) . '/index.php';
			} else if ($story_format == 'Side Rails') {
				$single_template = dirname( __FILE__ ) . '/storyrails.php';
			} else if ($story_format == 'Side by Side') {
				$single_template = dirname( __FILE__ ) . '/sidebyside.php';
			} else if ($story_format == 'Grid') {
				$single_template = dirname( __FILE__ ) . '/grid.php';
			} else if ($story_format == 'Grid Chapter') {
				$single_template = dirname( __FILE__ ) . '/grid.php';
			} else if ($story_format == 'Long-Form') {
				$single_template = dirname( __FILE__ ) . '/multi-part.php';
			} else if ($story_format == 'Long-Form Chapter') {
				$single_template = dirname( __FILE__ ) . '/multi-part.php';
			} else if (get_theme_mod('story-template') == 'Classic') {
				$single_template = dirname( __FILE__ ) . '/classic.php';
			} else if (get_theme_mod('story-template') == '') {
				$single_template = dirname( __FILE__ ) . '/classic.php';
			}
			return $single_template;
		}

		add_filter ( 'single_template', 'sno_story_page', 1, 2);

		function sno_template_redirect () {

			if (!is_search() && !is_archive() && !is_home() && !is_page()) {
				global $post;
				$roster_sport = get_post_meta ($post->ID, 'roster_sport', true);
				$sport = get_post_meta ($post->ID, 'sport', true);
				$name = get_post_meta ($post->ID, 'name', true);
				$bn = get_post_meta ($post->ID, 'breakingnewsheadline', true);


				if (($roster_sport || $sport) && (get_option('ssno') == "ssno928462s")) { 
					$roster_season = get_post_meta ($post->ID, 'roster_season', true);
					$season = get_post_meta ($post->ID, 'season', true);

					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'sportstemplate.php',
						'showposts' => 1
						));
					foreach($pages as $page) $staffurl =  $page->ID; 		
					$pagelink = get_permalink($staffurl);
					if ($roster_season) {
					//	$roster_sport = str_replace(' ', '_', $roster_sport);
						wp_redirect($pagelink . '?sport=' . rawurlencode($roster_sport) . '&schoolyear=' . $roster_season, 301); exit;
					} else {
					//	$sport = str_replace(' ', '_', $sport);
						wp_redirect($pagelink . '?sport=' . rawurlencode($sport) . '&schoolyear=' . $season, 301); exit;

					}
				} else if ($sport) {
					if (!is_home()) {
						$pagelink = home_url();
						wp_redirect($pagelink, 301); exit;
					}
				}

				if ($name) { 	
					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'snostaff.php',
						'hierarchical' => 0,
						'showposts' => 1
						));
					$name = str_replace(' ', '_', $name);
					foreach($pages as $page) $staffurl =  $page->ID; 		
					$pagelink = get_permalink($staffurl);
					wp_redirect($pagelink . '?writer=' . rawurlencode($name), 301); exit;
				}

				if ($bn) { 	
					if (!is_home()) {
						$pagelink = home_url();
						wp_redirect($pagelink, 301); exit;
					}
				}
			}
		}
		add_action( 'template_redirect', 'sno_template_redirect' );

		add_action('admin_init', 'sno_remove_dashboard_widgets');
		function sno_remove_dashboard_widgets() {
 remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins
 remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
 remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // recent drafts
 remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
 remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
}


add_action('admin_menu','sno_wphidenag');

function sno_wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}

add_action( 'admin_menu', 'sno_adjust_the_wp_menu', 999 );
function sno_adjust_the_wp_menu() {
  // remove_submenu_page( 'themes.php', 'customize.php' );
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	$themecheck = get_option('sno_theme_panel'); if ($themecheck != "enabled") {
		remove_submenu_page( 'themes.php', 'themes.php' );
	}

}

// code for 5.3.18

function sno_set_write_panel( $post_id ) {

	$snopanel = get_post_meta($post_id, '_mf_write_panel_id', true);
	$livepost = get_post_meta($post_id, '_edit_last', true);

	$sno_story_panel_override = get_option('sno_story_panel');
	if ($sno_story_panel_override) { 
		$sno_story_panel = $sno_story_panel_override;
	} else {
		$sno_story_panel = '1';	
	}


    // - Update the post's metadata.
	if ($livepost !='') {

		if ($snopanel=='') {
			update_post_meta( $post_id, '_mf_write_panel_id', $sno_story_panel);
		}

	}
}
add_action( 'save_post', 'sno_set_write_panel' );

function sno_sport_list() {
	global $wpdb;
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE name = 'Game Center'" );
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'sport'" );
	$sport_list = $wpdb->get_var( "SELECT options FROM wp_mf_custom_field_options WHERE custom_field_id = $custom_field_id" );
	$list = unserialize($sport_list);
	return $list;
}

// 5.4

function sno_longform_slideshow ($part) {

	global $post;
	$args = array(
		'orderby'        => 'menu_order',
		'order'			 => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_status'    => null,
		'post_mime_type' => 'image',
		'numberposts'    => -1
		);
	
	$attachments = get_posts($args);					

	if ($attachments) {
		echo '<div class="photowrap">';
		echo "<div id='storypageslideshow'>";

		echo '<div class="flex-container">';

		echo "<div id='slideshow$part' class='flexslider flexphotos'>";
		echo '<ul class="slides">';
		foreach ($attachments as $attachment) {
			$image = wp_get_attachment_image_src($attachment->ID, 'large', false);
			$fullimage = wp_get_attachment_image_src($attachment->ID, 'large'); 
			$shphotographer = get_post_meta($attachment->ID, 'photographer', true);
			$shcaption = get_post_field('post_excerpt', $attachment->ID);
			echo '<li class="storyslide">';
			echo '<img src="' . $image[0] . '" style="width:100%" class="catboxphoto" />'; 

			if ($shphotographer || $shcaption) {
				echo '<span class="photocaption">' . $shcaption;
				echo sno_slideshow_photographer($attachment->ID);
				echo '</span>';
			}
			echo '</li>';
		}			
		echo '</ul>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';		
		echo '<div class="photobottom"></div>';
	}

}

function register_sno_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Location "A"' ),
			'header-menu-2' => __( 'Header Location "B"' ),
			'footer-menu' => __( 'Footer Location' ),
			'mobile-menu' => __( 'Mobile Location' )
			)
		);
}
add_action( 'init', 'register_sno_menus' );

function sno_display_icons() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'menu-icons/menu-icons.php' ) ) {
		
		echo '<style>.topnavbarleft { padding: 0px; width:auto; }</style>';

        $searchicon = get_theme_mod('searchicon'); 
        $searchicon = 'true';
        
        if (get_theme_mod('rss-icon') != "Hide") {
        	echo '<a aria-hidden="true" target="_blank" href="' . get_bloginfo('rss_url') . '"><div class="alt-header-social social-border sno-rss dashicons dashicons-rss"><span class="icon-hidden-text">RSS Feed</span></div></a>';
        }
        				
		if (get_theme_mod('email-rss') == "Show") {
			$feedoption = get_theme_mod('feedburner'); 
			$options = get_option('sno_analytics_options'); if (isset($options['sno_site_feedburner_code'])) { $feedadmin = $options['sno_site_feedburner_code']; } else { $feedadmin = ''; }
			if ($feedoption) { $feedburner = $feedoption; } else if ($feedadmin) { $feedburner = $feedadmin; }
			if (isset($feedburner)&&$feedburner) { ?>
        		<a aria-hidden="true" onclick="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" href="#">
        			<div class="alt-header-social social-border sno-email dashicons dashicons-email-alt"><span class="icon-hidden-text">Email Signup</span></div>
        		</a><?php 
        	}
		}
						
        $reddit = get_theme_mod('reddit'); if ($reddit) { 
        	echo '<a aria-hidden="true" target="_blank" href="' . $reddit . '">
        		<div class="alt-header-social-fa social-border sno-reddit genericon genericon-reddit"><span class="icon-hidden-text">Reddit</span></div>
        	</a>';
        }
        				
       	$flickr = get_theme_mod('flickr'); if ($flickr) { 
	       	echo '<a aria-hidden="true" target="_blank" href="' . $flickr . '">
	       		<div class="alt-header-social-fa social-border sno-flickr fa fa-flickr"><span class="icon-hidden-text">Flickr</span></div>
	       	</a>';
	       }
        
        $vimeo = get_theme_mod('vimeo'); if ($vimeo) { 
        	echo '<a aria-hidden="true" target="_blank" href="' . $vimeo . '">
        		<div class="alt-header-social-fa social-border sno-vimeo fa fa-vimeo"><span class="icon-hidden-text">Vimeo</span></div>
        	</a>';
        }

        $youtube = get_theme_mod('youtube'); if ($youtube) { 
        	echo '<a aria-hidden="true" target="_blank" href="' . $youtube . '">
        		<div class="alt-header-social-fa social-border sno-youtube fa fa-youtube"><span class="icon-hidden-text">YouTube</span></div>
        	</a>';
        }

        $snapchat = get_theme_mod('snapchat'); if ($snapchat) { 
        	echo '<a aria-hidden="true" target="_blank" href="https://www.snapchat.com/add/' . $snapchat . '">
        		<div class="alt-header-social-fa social-border sno-snapchat fa fa-snapchat-ghost"><span class="icon-hidden-text">Snapchat</span></div>
        	</a>';
        	
        }
        				
        $schooltube = get_theme_mod('schooltube'); if ($schooltube) { 
        	echo '<a aria-hidden="true" target="_blank" href="' . $schooltube . '">
        		<div class="alt-header-social social-border sno-schooltube dashicons dashicons-format-video"><span class="icon-hidden-text">SchoolTube</span></div>
        	</a>';
        }
        				
       	$googleplus = get_theme_mod('googleplus'); if ($googleplus) { 
	        echo '<a aria-hidden="true" target="_blank" href="' . $googleplus . '">
	       		<div class="alt-header-social-fa social-border sno-google-plus fa fa-google-plus"><span class="icon-hidden-text">Google Plus</span></div>
	        </a>';
    	}
    					
        $soundcloud = get_theme_mod('soundcloud'); if ($soundcloud) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $soundcloud . '">
        		<div class="alt-header-social-fa social-border sno-soundcloud fa fa-soundcloud"><span class="icon-hidden-text">SoundCloud</span></div>
        	</a>';
        }
        				
        $linkedin = get_theme_mod('linkedin'); if ($linkedin) {
	        echo '<a aria-hidden="true" target="_blank" href="' . $linkedin . '">
	        	<div class="alt-header-social-fa social-border sno-linkedin fa fa-linkedin"><span class="icon-hidden-text">LinkedIn</span></div>
	        </a>';
    	}
    					
        $tumblr = get_theme_mod('tumblr'); if ($tumblr) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $tumblr . '">
        		<div class="alt-header-social-fa social-border sno-tumblr fa fa-tumblr"><span class="icon-hidden-text">Tumblr</span></div>
        	</a>';
        }
        				
        $pinterest = get_theme_mod('pinterest'); if ($pinterest) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $pinterest . '">
        		<div class="alt-header-social-fa social-border sno-pinterest fa fa-pinterest"><span class="icon-hidden-text">Pinterest</span></div>
        	</a>';
        }
        
        $instagram = get_theme_mod('instagram'); if ($instagram) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $instagram . '">
        		<div class="alt-header-social-fa social-border sno-instagram fa fa-instagram"><span class="icon-hidden-text">Instagram</span></div>
        	</a>';
        }
        				
        				
        $twitter = get_theme_mod('twitter'); if ($twitter) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $twitter . '">
        		<div class="alt-header-social social-border sno-twitter dashicons dashicons-twitter"><span class="icon-hidden-text">Twitter</span></div>
        	</a>';
        }
        				
        $facebook = get_theme_mod('facebook'); if ($facebook) {
        	echo '<a aria-hidden="true" target="_blank" href="' . $facebook . '">
        		<div class="alt-header-social social-border sno-facebook dashicons dashicons-facebook-alt"><span class="icon-hidden-text">Facebook</span></div>
        	</a>';
        }

        echo '<div class="social-spacer"></div>';
	
	} else {
	
		if (get_theme_mod('rss-icon') != "Hide") { ?>
			<a aria-hidden="true" target="_blank" href="<?php bloginfo('rss_url'); ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/rss.png" alt="Subscribe to <?php bloginfo('name'); ?>" class="socialicon" />
			</a><?php
		} 		
		
		$facebook = get_theme_mod('facebook'); if ($facebook) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $facebook; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/facebook.png" class="socialicon" />
			</a><?php
		}

		$twitter = get_theme_mod('twitter'); if ($twitter) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $twitter; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/twitter.png" class="socialicon" />
			</a><?php 
		}

		$googleplus = get_theme_mod('googleplus'); if ($googleplus) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $googleplus; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/googleplus.png" rel="publisher" class="socialicon" />
			</a><?php 
		}
		
		$tumblr = get_theme_mod('tumblr'); if ($tumblr) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $tumblr; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/tumblr.png" class="socialicon" />
			</a><?php 
		}
		
		$youtube = get_theme_mod('youtube'); if ($youtube) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $youtube; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/youtube.png" class="socialicon" />
			</a><?php 
		} 
		
		$vimeo = get_theme_mod('vimeo'); if ($vimeo) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $vimeo; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/vimeo.png" class="socialicon" />
			</a><?php 
		}
		
		$schooltube = get_theme_mod('schooltube'); if ($schooltube) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $schooltube; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/schooltube.png" class="socialicon" />
			</a><?php 
		}
		
		$flickr = get_theme_mod('flickr'); if ($flickr) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $flickr; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/flickr.png" class="socialicon" />
			</a><?php 
		}
		
		$instagram = get_theme_mod('instagram'); if ($instagram) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $instagram; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/instagram.png" class="socialicon" />
			</a><?php 
		}
		
		$pinterest = get_theme_mod('pinterest'); if ($pinterest) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $pinterest; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/pinterest.png" class="socialicon" />
			</a><?php 
		} 
		
		$reddit = get_theme_mod('reddit'); if ($reddit) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $reddit; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/reddit.png" alt="Share on Reddit" class="socialicon" />
			</a><?php 
		}
		
		$soundcloud = get_theme_mod('soundcloud'); if ($soundcloud) { ?>
			<a aria-hidden="true" target="_blank" href="<?php echo $soundcloud; ?>">
				<img style="vertical-align:top" src="/wp-content/themes/snoflex/images/soundcloud.png" class="socialicon" />
			</a><?php 
		}
		
		
		if (get_theme_mod('email-rss') == "Show") {
			$feedoption = get_theme_mod('feedburner'); 
			$options = get_option('sno_analytics_options'); $feedadmin = $options['sno_site_feedburner_code'];
			if ($feedoption) { $feedburner = $feedoption; } else if ($feedadmin) { $feedburner = $feedadmin; }
			if (isset($feedburner)&&$feedburner) { ?>
				<a aria-hidden="true" onclick="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" href="#">
					<img style="vertical-align:top;width:20px;" src="/wp-content/themes/snoflex/images/email.png" class="socialicon" />
				</a><?php 	
			} 
		}
	} 
}

function sno_display_search () {
	$random = mt_rand(1, 10000);
	?>	<form method="get" id="searchform<?php echo $random; ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="s<?php echo $random; ?>" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
			<div class="search-button-container" id="searchthis<?php echo $random; ?>">
			<button type="submit" disabled="disabled" id="sno-search-navbar-<?php echo $random; ?>" class="sno-submit-search-button sno-search fa fa-search"><span class="icon-hidden-text">Submit Search</span></button>
			</div>
			<input type="text" class="field s" name="s" id="s<?php echo $random; ?>" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
			<input type="submit" class="submit" name="submit" id="searchsubmit<?php echo $random; ?>" style="display:none;" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
		</form>
	<?php
}
function remove_sharethis() {
	global $post;
		remove_filter('the_content', 'st_add_widget');
		remove_filter('the_excerpt', 'st_add_widget');
		remove_action('wp_head', 'st_widget_head');
}
add_action( 'template_redirect', 'remove_sharethis' );

function sno_list_longform_stories($sno_longform_list) {
	$limitvariable = 50;
	global $wpdb;
	$querystr = "
	SELECT * FROM $wpdb->posts
	JOIN $wpdb->postmeta AS featureimage ON(
		$wpdb->posts.ID = featureimage.post_id
		AND featureimage.meta_key = 'sno_format'
		AND featureimage.meta_value = 'Long-Form'
		)
	WHERE $wpdb->posts.post_status = 'publish'
	OR $wpdb->posts.post_status = 'draft'
	OR $wpdb->posts.post_status = 'future'
	OR $wpdb->posts.post_status = 'pending'
	ORDER BY post_date DESC LIMIT $limitvariable
	";
	$pageposts = $wpdb->get_results($querystr, OBJECT);

	if ($pageposts):

		?><select name="sno_longform_list"><?php
			echo '<option value="">None</option>';
				foreach ($pageposts as $post_list):
					setup_postdata($post_list);
					$storyid= $post_list->ID;
					$storytitle = substr(get_the_title($storyid),0,30);

					if ($storyid) { ?><option value="<?php echo $storyid; ?>" <?php if ( $sno_longform_list == $storyid ) echo 'selected="selected"'; ?>><?php echo $storyid . ': ' . $storytitle; ?></option><?php }

				endforeach; 

			echo '</select>';

	else : endif;
}

function sno_list_grid_stories($sno_grid_list) {
	$limitvariable = 50;
	global $wpdb;
	$querystr = "
	SELECT * FROM $wpdb->posts
	JOIN $wpdb->postmeta AS sno_format ON(
		$wpdb->posts.ID = sno_format.post_id
		AND sno_format.meta_key = 'sno_format'
		AND sno_format.meta_value = 'Grid'
		)
	WHERE $wpdb->posts.post_status = 'publish'
	OR $wpdb->posts.post_status = 'draft'
	OR $wpdb->posts.post_status = 'future'
	OR $wpdb->posts.post_status = 'pending'
	ORDER BY post_date DESC LIMIT $limitvariable
	";
	$pageposts = $wpdb->get_results($querystr, OBJECT);

	if ($pageposts):

		?><select name="sno_grid_list"><?php
			echo '<option value="">None</option>';
				foreach ($pageposts as $post_list):
					setup_postdata($post_list);
					$storyid= $post_list->ID;
					$storytitle = substr(get_the_title($storyid),0,30);

					if ($storyid) { ?><option value="<?php echo $storyid; ?>" <?php if ( $sno_grid_list == $storyid ) echo 'selected="selected"'; ?>><?php echo $storyid . ': ' . $storytitle; ?></option><?php }

				endforeach; 

			echo '</select>';

	else : endif;
}

function sno_list_sidebyside_stories($sno_sidebyside_list) {
	$limitvariable = 50;
	global $wpdb;
	$querystr = "
	SELECT * FROM $wpdb->posts
	JOIN $wpdb->postmeta AS sno_format ON(
		$wpdb->posts.ID = sno_format.post_id
		AND sno_format.meta_key = 'sno_format'
		AND sno_format.meta_value = 'Side by Side'
		)
WHERE $wpdb->posts.post_status = 'publish'
OR $wpdb->posts.post_status = 'draft'
OR $wpdb->posts.post_status = 'future'
OR $wpdb->posts.post_status = 'pending'
ORDER BY post_date DESC LIMIT $limitvariable
";
$pageposts = $wpdb->get_results($querystr, OBJECT);

if ($pageposts):
	?><select name="sno_sidebyside_list"><?php
echo '<option value="">None</option>';
foreach ($pageposts as $post_list):
	setup_postdata($post_list);
$storyid= $post_list->ID;
$storytitle = substr(get_the_title($storyid),0,30);


if ($storyid) { ?><option value="<?php echo $storyid; ?>" <?php if ( $sno_sidebyside_list == $storyid ) echo 'selected="selected"'; ?>><?php echo $storyid . ': ' . $storytitle; ?></option><?php }

endforeach; 

echo '</select>';

else : endif;
}

function sno_exclude_posts($widget = null, $cat = null, $number = null) {
	wp_reset_query();
	$exclusionarray = array();
	
	if ($widget == 'widget') {
		$exclusioncat = $cat;
		$exclusionnumber = $number;
		$args = array('category' => $exclusioncat, 'posts_per_page' => $exclusionnumber);
		$exclusionquery = get_posts($args); 
		foreach ($exclusionquery as $exclusion) if (has_post_thumbnail($exclusion->ID)) $exclusionarray[] = $exclusion->ID;
	}
	if ((get_theme_mod('top-stories-scrollbox') == "Display") && (get_theme_mod('showcase-exclude') == "Exclude") && is_home()) {
		$exclusioncat = get_theme_mod('featured-cat');
		$exclusionnumber = get_theme_mod('featured-count');
		$args = array('category' => $exclusioncat, 'posts_per_page' => $exclusionnumber);
		$exclusionquery = get_posts($args); 
		foreach ($exclusionquery as $exclusion) if (has_post_thumbnail($exclusion->ID)) $exclusionarray[] = $exclusion->ID;
	}

	if ((get_theme_mod('home-breaking') == "Display") && (get_theme_mod('topstory-exclude') == "Exclude") && is_home()) {
		$exclusioncat = get_theme_mod('home-breaking-cat');
		$args = array('category' => $exclusioncat, 'posts_per_page' => 1);
		$exclusionquery = get_posts($args); $exclusionarray[] = $exclusionquery[0]->ID; 
	}	
	return $exclusionarray;
}
add_action( 'admin_print_styles', 'sno_hide_sticky_option' );
function sno_hide_sticky_option() {
	global $post_type, $pagenow;
	if( 'post.php' != $pagenow && 'post-new.php' != $pagenow )
		return;
	?>
	<style type="text/css">#sticky-span { display:none!important }</style>
	<?php
}
function sno_filter_gettext( $translated, $original, $domain ) {

	$strings = array(
		'The following themes have new versions available. Check the ones you want to update and then click &#8220;Update Themes&#8221;.' => 'Please update your SNO FLEX theme whenever you see an update available.',
		'<strong>Please Note:</strong> Any customizations you have made to theme files will be lost. Please consider using <a href="%s">child themes</a> for modifications.' => '',
		'<strong>Important:</strong> before updating, please <a href="https://codex.wordpress.org/WordPress_Backups">back up your database and files</a>. For help with updates, visit the <a href="https://codex.wordpress.org/Updating_WordPress">Updating WordPress</a> Codex page.' => 'WordPress updates are important for site security. Please update immediately to the latest version of WordPress.',
		'You can update to <a href="https://codex.wordpress.org/Version_%1$s">WordPress %2$s</a> automatically or download the package and install it manually:' => '',
		'The following plugins have new versions available. Check the ones you want to update and then click &#8220;Update Plugins&#8221;.' => '',
		'Return to Themes page' => '',
		'Check your email for the confirmation link.' => 'Please check your email for a password reset link. If you didn\'t receive the email, please <a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">submit a support request</a>.',
		'Sorry, this file type is not permitted for security reasons.' => 'Sorry, this file type is not permitted.',
        // Add some more strings here
		);

    // See if the current string is in the $strings array
    // If so, replace its translation
	if ( isset( $strings[$original] ) ) {
        // This accomplishes the same thing as __()
        // but without running it through the filter again
		$translations = get_translations_for_domain( $domain );
		$translated = $translations->translate( $strings[$original] );
	}

	return $translated;
}
add_filter( 'gettext', 'sno_filter_gettext', 10, 3 );

function change_footer_admin () {  
	$sno_attribution = get_option('sno_analytics_options');
	if (isset ($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
		echo 'FLEX WordPress Theme by <a href="https://boostingblue.com">Boosting Blue</a>. Need help? Submit a <a href="https://sno.zendesk.com/hc/en-us/requests/new">support ticket.</a>';  
	} else {
		echo 'FLEX WordPress Theme by <a href="https://snosites.com">SNO</a>. Need help? Submit a <a href="https://sno.zendesk.com/hc/en-us/requests/new">support ticket.</a>';  
	}

}  

add_filter('admin_footer_text', 'change_footer_admin');

add_action('admin_head', 'sno_flex_repair');

function sno_flex_repair () {
	
	if (get_option('flex_511') != 4) {

		sno_deactivate_plugin();
		sno_activate_plugin();
		update_option('flex_511','4');
	}
}

function sno_activate_plugin() {
	activate_plugin( 'menu-icons/menu-icons.php' );
}

function sno_deactivate_plugin() {
	deactivate_plugins( 'share-this/sharethis.php' );
}

// FLEX 5.5
function sno_profile_teaser () {
	global $post; $i = ''; $o = '';
	$teaser_type = get_post_meta($post->ID, 'sno_rails_writer', true);
	$number = get_post_meta($post->ID, 'sno_rails_number', true);
	$order = get_post_meta($post->ID, 'sno_rails_stories', true);
	$sr_title = get_post_meta($post->ID, 'sno_sr_title', true);
	$original_id = $post->ID;
	
	if ($teaser_type == 'Tagged Stories') {

		$tags = get_post_meta($post->ID, 'sno_sr_tag', true); 
		$tags = explode(',',$tags);
		
		foreach ($tags as $tag) {  
			
			$tag_id = get_term_by('name', $tag, 'post_tag');
			$tag = $tag_id->term_id; 
			
			$args = array( 'exclude' => $post->ID, 'orderby' => $order, 'numberposts' => $number, 'tax_query' => array(array('taxonomy'=> 'post_tag','field'=>'term_id','terms'=> $tag)) );

			$tag_posts = get_posts( $args ); 
			$i++;
			if ($tag_posts) $o .= "<div id='tagbox$i' class='tagbox'>";
			foreach ($tag_posts as $tag_post) {
				$thePostID = $tag_post->ID;
				$link = get_permalink($thePostID);
				$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

				if ($i > 1) $o .= '<div class="railspacerlarge"></div>';
				$o .= '<div class="sno-animate">';
				if ($writer_image) $o .= '<a href="'.$link.'#photo"><img src="' . $writer_image[0] . '" alt="' . get_the_title($thePostID) . '" style="width:100%" /></a>';
				$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($thePostID).'</a></div>';
				$o .= '</div>';
				$o .= '<div class="railspacer">';
				$o .= '</div>';
			}
			if ($tag_posts) $o .= '</div>';
		}
		wp_reset_query();


	} else if ($teaser_type == 'Category Stories') {

		$cat = get_post_meta($post->ID, 'sno_sr_cat', true);
		
		$args = array( 'category' => $cat, 'exclude' => $post->ID, 'orderby' => $order, 'numberposts' => $number );

		$cat_posts = get_posts( $args ); 
		$i++;
		if ($cat_posts) $o .= "<div id='catbox$i' class='catbox'>";
		foreach ($cat_posts as $cat_post) {
			$thePostID = $cat_post->ID;
			$link = get_permalink($thePostID);
			$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

			if ($i > 1) $o .= '<div class="railspacerlarge"></div>';
			$o .= '<div class="sno-animate">';
			if ($writer_image) $o .= '<a href="'.$link.'#photo"><img src="' . $writer_image[0] . '" alt="' . get_the_title($thePostID) . '" style="width:100%" /></a>';
			$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($thePostID).'</a></div>';
			$o .= '</div>';
			$o .= '<div class="railspacer">';
			$o .= '</div>';
		}
		if ($cat_posts) $o .= '</div>';
		wp_reset_query();

	} else {

		$profile_type = get_post_meta($post->ID, 'sno_rails_type', true); $i = ''; $o = '';
		if ($profile_type == 'Writer') $writers = get_post_meta($post->ID, 'writer', false); 
		if ($profile_type == 'Photographer') {
			$photographer = get_post_meta(get_post_meta($post->ID, '_thumbnail_id', true), 'photographer', true); 
		}
		if ($profile_type == 'Videographer') $videographers = get_post_meta($post->ID, 'videographer', false);
		

		if (isset ($writers) && $writers) foreach ($writers as $writer) {
			$i++; 

			if ($i > 1) $o .= '<div class="railbuffer"></div>';

			$args = array( 'meta_key' => 'name', 'meta_value' => $writer, 'numberposts' => 1 );
			$queried_posts = get_posts( $args );
			if ($queried_posts) {

				foreach ($queried_posts as $queried_post) {
					$thePostID = $queried_post->ID;
					$link = get_permalink($thePostID);
					$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

					if ($writer_image) $o .= '<a href="'.$link.'"><img src="' . $writer_image[0] . '" style="width:100%" alt="' . get_the_title($thePostID) . '" /></a>';
				}
			}
			$args = array( 'meta_key' => 'writer', 'meta_value' => $writer, 'orderby' => $order, 'numberposts' => $number, 'exclude' => $post->ID );
			$writers_stories = get_posts( $args );
			if ($writers_stories) {
				$o .= '<div class="railspacer">';
				$o .= "<p>More stories from $writer</p>";
				$o .= '</div>';

				foreach ($writers_stories as $story) {
					$storyID = $story->ID;
					$link = get_permalink($storyID);

					
					$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($storyID).'</a><br />';
					$o .= '<span class="writer_date">' . get_the_time('F j, Y', $storyID) . '</span>';
					$o .= '</div>';

				}
			} 
		}

		if (isset ($videographers) && $videographers) foreach ($videographers as $videographer) {
			$i++; 

			if ($i > 1) $o .= '<div class="railbuffer"></div>';

			$args = array( 'meta_key' => 'name', 'meta_value' => $videographer, 'numberposts' => 1 );
			$queried_posts = get_posts( $args );
			if ($queried_posts) {
				foreach ($queried_posts as $queried_post) {
					$thePostID = $queried_post->ID;
					$link = get_permalink($thePostID);
					$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

					if ($writer_image) $o .= '<a href="'.$link.'"><img src="' . $writer_image[0] . '" style="width:100%" alt="' . get_the_title($thePostID) . '" /></a>';
				}
			}

			$args = array( 'meta_key' => 'videographer', 'meta_value' => $videographer, 'orderby' => $order, 'numberposts' => $number, 'exclude' => $post->ID );
			$writers_stories = get_posts( $args );
			
			if ($writers_stories) {
				$o .= '<div class="railspacer">';
				$o .= "<p>More videos from $videographer</p>";
				$o .= '</div>';

				foreach ($writers_stories as $story) {
					$storyID = $story->ID;
					$link = get_permalink($storyID);

					
					$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($storyID).'</a><br />';
					$o .= '<span class="writer_date">' . get_the_time('F j, Y', $storyID) . '</span>';
					$o .= '</div>';
				}
			}
		}

		if (isset($photographer) && $photographer) {
			$i++; 

			if ($i > 1) $o .= '<div class="railbuffer"></div>';
			$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
			$queried_posts = get_posts( $args );
			if ($queried_posts) {
				foreach ($queried_posts as $queried_post) {
					$thePostID = $queried_post->ID;
					$link = get_permalink($thePostID);
					$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

					if ($writer_image) $o .= '<a href="'.$link.'"><img src="' . $writer_image[0] . '" style="width:100%" alt="' . get_the_title($thePostID) . '" /></a>';
				}
			}
			global $wpdb;

			if ($order == 'date') { $order = 'post_date'; } else { $order = 'RAND()'; }
			$realname = $photographer; $photographer = str_replace( "'", "''", $photographer );
			$querystr = "
			SELECT * FROM $wpdb->posts
			JOIN $wpdb->postmeta AS photographer ON(
				$wpdb->posts.ID = photographer.post_id
				AND photographer.meta_key = 'photographer'
				AND photographer.meta_value = '$photographer'
				)
WHERE $wpdb->posts.post_type = 'attachment'
AND $wpdb->posts.post_parent != '0'
AND $wpdb->posts.post_parent != '$original_id'
ORDER BY $order DESC LIMIT $number
";

$pageposts = $wpdb->get_results($querystr, OBJECT);

if ($pageposts):

	$o .= '<div class="railspacer">';
$o .= "<p>More photos from $realname</p>";
$o .= '</div>';

foreach ($pageposts as $post):
	setup_postdata($post);

$storyID = get_post_field(post_parent, $post->ID); 

$link = get_permalink($storyID);


$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($storyID).'</a><br />';
$o .= '<span class="writer_date">' . get_the_time('F j, Y', $storyID) . '</span>';
$o .= '</div>';

endforeach; 
else : endif; 

wp_reset_query();


}
}

$output = '<div id="writer_stories">';
if ($sr_title) $output .= '<h5>' . $sr_title . '</h5>';
$output .= $o . '</div>';
return $output;	
}
function sno_stories_tag () {
	global $post;
	$tags = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ) );
	
	foreach ($tags as $tag) {
		$args = array( 'tag' => $tag, 'exclude' => $post->ID );

		$tag_posts = get_posts( $args ); 
		$i++;
		if ($tag_posts) $o .= "<div id='tagbox$i' class='tagbox'>Tagged with " . $tag;
		foreach ($tag_posts as $tag_post) {
			$thePostID = $tag_post->ID;
			$link = get_permalink($thePostID);
			$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

			if ($i > 1) $o .= '<div class="railspacerlarge"></div>';
			$o .= '<div class="sno-animate">';
			$o .= '<a href="'.$link.'"><img src="' . $writer_image[0] . '" style="width:100%" alt="' . get_the_title($thePostID) . '" /></a>';
			$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($thePostID).'</a></div>';
			$o .= '</div>';
			$o .= '<div class="railspacer">';
			$o .= '</div>';
		}
		if ($tag_posts) $o .= '</div>';
	}
	echo $o;
	wp_reset_query();
}


//add_filter( 'the_content', 'sno_p_content_filter', 20 );
function sno_p_content_filter( $content ) {
	$graph = ''; $new_content = '';
	if ( is_single() ) {

		$content = explode ( "</p>", $content );
		if ($content[0] != '') {
			for ( $i = 0; $i < count ( $content ); $i++ ) {
				$graph++;
				$paragraph = str_replace("<p>","<p id='graph$graph'>", $content[$i] );
				$new_content .= $paragraph . "</p>";
			}
			$new_content .= '<div id="story_bottom"></div>';
		}
		return $new_content;    
	} else { return $content; }

}
function sno_add_photocredit($html, $id, $alt, $title, $align, $url, $size ) {

	$photographer = get_post_meta($id, 'photographer', true);
	if ($photographer) {	
		$pretext = get_theme_mod('story-photo-credit');		
		$args = array( 'meta_key' => 'name', 'meta_value' => $photographer, 'numberposts' => 1 );
		$queried_posts = get_posts( $args );
		if ($queried_posts) {
			foreach ($queried_posts as $queried_post) {
				$thePostID = $queried_post->ID;
				$link = get_permalink($thePostID);
				$o .= '<span class="photocreditinline">';
				if ($pretext) $o .= $pretext . ' ';
				$o .= '<a href="' . $link . '">';
				$o .= $photographer. '</a>';
				$o .= '</span><br />';
			}
		} else {
			$o .= '<span class="photocreditinline">';
			if ($pretext) $o .= $pretext . ' ';
			$o .= $photographer;
			$o .= '</span><br />'; 
		}

		$html .= $o;
	}
	return $html;
}
if (get_option('photo-credit-insert') != "off") add_filter('image_send_to_editor', 'sno_add_photocredit', 10, 3);

function sno_staff_profile_link() {
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'snostaff.php',
		'number' => 1,
		'post_type' => 'page',
		'hierarchical' => 0,
		'post_status' => 'publish'
		));
	if (count($pages) == 0) return;
	foreach($pages as $page) $staffurl =  $page->ID; 		
	$pagelink = get_permalink($staffurl);
	return $pagelink; 
}
function sno_dashboard_home($username, $user){
		wp_redirect(admin_url('/index.php?page=sno-launch-pad', 'http'), 301);
	exit;
}
$options = get_option('sno_privacy_options'); 
$sno_mobile_active = get_option('sno_analytics_options');
$kill_redirect = "no";
if ( isset($options['sno_privacy_activate']) ) {
	if ( $options['sno_privacy_activate'] == 'on' ) {
		$kill_redirect = "yes";
	}
}
if ( isset( $sno_mobile_active['sno_mobile_active'] ) ) {
	if ( $sno_mobile_active['sno_mobile_active'] == 'on' ) {
		$kill_redirect = "yes";
	}
}	
if ( $kill_redirect == "no" ) {
	$sno_attribution = get_option('sno_analytics_options');
	if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
	
	} else {
		add_action('wp_login', 'sno_dashboard_home', 100, 100);	
	}
}

function sno_lf_exclusion( $query ) {
	if( $query->is_main_query() && !is_admin() ) {
		$meta_query = array(
			'relation' => 'OR',
			array(
				'key' => 'sno_format',
				'value' => 'Long-Form Chapter',
				'compare' => 'NOT LIKE'
				),
			array(
				'key' => 'sno_format',
				'value' => 'Long-Form Chapter',
				'compare' => 'NOT EXISTS'
				)
			);
		$query->set( 'meta_query', $meta_query );
	}

}

//add_action( 'pre_get_posts', 'sno_lf_exclusion' );

function sno_exclusion( $query ) {

	if (( $query->is_main_query() && !is_admin()) && (is_archive() || is_feed())) {
		$meta_value =  array(
			'relation' => 'OR',
			array(
				'key' => '_mf_write_panel_id',
				'value' => sno_story_write_panel_id(),
				'compare' => 'LIKE'
				),
			array(
				'key' => '_mf_write_panel_id',
				'value' => sno_staff_write_panel_id(),
				'compare' => 'LIKE'
				),
			array(
				'key' => '_mf_write_panel_id',
				'compare' => 'NOT EXISTS'
				)

			);

		$query->set( 'meta_query', $meta_value );
	}

}
// add_action( 'pre_get_posts', 'sno_exclusion' );

function sno_staff_write_panel_id () {

	$sno_staff_panel_override = get_option('sno_staff_panel');
	if ($sno_staff_panel_override) { 
		$sno_staff_panel = $sno_staff_panel_override;
	} else {
		$sno_staff_panel = '2';	
	}
	
	return $sno_staff_panel;
}

function sno_story_write_panel_id () {

	$sno_story_panel_override = get_option('sno_story_panel');
	if ($sno_story_panel_override) { 
		$sno_story_panel = $sno_story_panel_override;
	} else {
		$sno_story_panel = '1';	
	}
	
	return $sno_story_panel;
}

function sno_ad_network($ad, $styles) {
	$o = '';
	$options = get_option('sno_analytics_options'); 
	if (isset($options['sno_adbutler_analytics_activate'])) {
		if ($options['sno_adbutler_analytics_activate'] == 'on') {

		if ($ad == 'image') {

			$o .= "<div class='snoadnetwork $styles'>";
			$o .= '<h3>Advertisement</h3>';
			$o .= "<div class='advertisementwrap' style='margin:0px auto;max-width:100%;'>";

			$o .= $options['sno_site_adbutler_code']; 
			$o .= '</div>';
			$o .= '</div>';
			
		} else {
			$o .= '<div class="snoadnetwork">';
			$o .= '<div class="widgetwrap">';
			$o .= '<h3>Advertisement</h3>';
			$o .= '<div class="widgetbody3">';
			$o .= '<div class="advertisementwrap" style="float:none;margin:0px auto;max-width:300px">';

			$o .= $options['sno_site_adbutler_code']; 

			$o .= '</div>';
			$o .= '</div>';
			$o .= '</div>';
			$o .= '</div>';
		}
		
		return $o;		
		}
	} 
}
// adios spammers
function sno_preprocess_new_comment($commentdata) {
	if(!isset($_POST['sno_stop_spam']) && !(is_admin())) {
		die('Hmmm....what are you trying to do?');
	}
	return $commentdata;
}
if (get_option('sno_kill_honeypot') == '') add_action('preprocess_comment', 'sno_preprocess_new_comment');

// load wp colorpicker for widgets
add_action( 'load-widgets.php', 'my_custom_load' );

function my_custom_load() {    
	wp_enqueue_style( 'wp-color-picker' );        
	wp_enqueue_script( 'wp-color-picker' );    
}

function sno_other_story($original, $parent) {
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
	AND sno_sidebyside_list.meta_value = '$parent'
	)
WHERE $wpdb->posts.post_status = 'publish'
ORDER BY sno_sidebyside_list.meta_value ASC LIMIT 5 
";

$pageposts = $wpdb->get_results($querystr, OBJECT);
if ($pageposts) {
	foreach ($pageposts as $post) {
			//setup_postdata($post);
		if ($post->ID != $original) $related .= $post->ID; 
	}
}
return $related;
}



/** 
BEGIN SNOSC BLOCK
**/
/**
 *	snosc -- sno s[hort]c[ode] -- setup
 *	@author lasellers@gmail.com
 *	@date 8/7/2015
**/
define('SPORTS_SSNO','ssno928462s');
/* get list of possible school years (single year) */
function sno_sport_schoolyear_list()
{
	$years=array();
	$current_year=date("Y");
	for($y=2014;$y<=$current_year;$y++)
	{
		$years[]=$y;
	}
	return $years;
}
/* get the default schoolyear (paired season format) "y1-y2" */
function sno_get_current_sports_schoolyear()
{
	$resetmonth = get_theme_mod('sports-reset');
	if ($resetmonth == '') $resetmonth = '07';

	$currentyear = date("Y");
	$currentmonth = date("m");  
	if ($currentmonth >= $resetmonth)
	{
		$spring = $currentyear + 1;
		$schoolyear = "$currentyear" . "-" . "$spring";
	}
	else
	{
		$fall = $currentyear - 1;
		$schoolyear = "$fall" . "-" . "$currentyear";
	}

	return $schoolyear;
}
/* get list of ad groups suitable for html select/options */
function sno_ad_group_list()
{
	$taxonomies = array( 
		'ad-group',
		);

	$args = array(
		'orderby'           => 'name', 
		'order'             => 'ASC',
		'hide_empty'        => false, 
		'fields'            => 'all', 
		); 

	$arr=array();
	$ad_groups = get_terms($taxonomies, $args);
	foreach($ad_groups as $ad_group)
	{
		$arr[$ad_group->term_id]=$ad_group->name;
	}
	return $arr;
}
/* get list of reader polls suitable for html select/options */
function sno_reader_poll_list()
{
	global $wpdb;
	$wpdb->pollsq   = $wpdb->prefix.'pollsq';
	$results = $wpdb->get_results("SELECT pollq_id,pollq_question FROM $wpdb->pollsq WHERE pollq_active=1");
	$polls=array();
	foreach($results as $result)
	{
		$polls[$result->pollq_id]="ID: ".$result->pollq_id." ".stripcslashes(sanitize_text_field(esc_textarea($result->pollq_question)));
	}

	return $polls;
}
/* *DEPRECATED for AJAX* get list of related stories suitable for html select/options*/
function sno_snosc_stories_list()
{
	global $wpdb;
	$query = "
	SELECT ID,post_title
	FROM $wpdb->posts
	where post_type='post' AND post_status='publish'
	ORDER BY post_date DESC;";

	$posts = $wpdb->get_results($query, OBJECT);

	$stories=array();
	foreach($posts as $post)
	{
		$stories[$post->ID]=$post->post_title;
	}
	return $stories;
}
/* */
global $pagenow;
if(is_admin())
{
	/* load the ajax handler for the autocompletes, etc */
	require_once( TEMPLATEPATH . "/snosc/ajax.php");
	/* add a few vars to allowed url queries */
	add_filter( 'query_vars', function( $vars ){
		$vars[] = "id";
		$vars[] = "q";
		$vars[] = "max_length";
		return $vars;
	});
	/* add the snosc media button to the editor */
	add_action('media_buttons_context',function ($context) 
	{
		$src=get_template_directory_uri().'/snosc/sno-button.png';
		$title = 'Add SNO Story Element';
		$context .= "<a href='#TB_inline?width=400&inlineId=popup_container' class='thickbox button sno-add-sno-story-element' title='$title'><img src='{$src}' />$title</a>";
		return $context;
	});
	/* create the media button popup content -- THIS SHOWS THE SNOSC CONTENT  */
	add_action( 'admin_footer',function() { ?>
		<style type="text/css">
		.snosc-panel {}
		.snosc-panel .form-table td { padding: 4px 1px !important; }
		ul#snosc-tabs {}
		#snosc-tabs li { display: inline-block;}
		.btn { 
			color: white !important;
			border-radius: .5em !important;
			padding .5em !important; 
			height: auto !important;
		}
		.btn-primary { background-color: #286090 !important;}
		.btn-warning { background-color: #c7a58c !important; }
		.snosc-input { max-width: 10em; width: 10em; margin-right: 1em !important;}
		.snosc-input-m { max-width: 15em; width: 15em; margin-right: 1em !important;}
		</style>
		<div id="popup_container" style="display:none;">
			<h2>Select A Story Element</h2>
			<ul id="snosc-tabs">
				<li><a class="button" href="#related-stories">Related Stories</a></li>
				<li><a class="button" href="#pull-quote">Pull Quote</a></li>
				<li><a class="button" href="#sidebar">Side Box</a></li>
				<li><a class="button" href="#video-embed">Video Embed</a></li>
				<li><a class="button" href="#infographic-embed">Infographic Embed</a></li>
				<li><a class="button" href="#audio-clip">Audio Clip</a></li>

				<?php if(defined('WP_POLLS_VERSION')) { ?>
				<li><a class="button" href="#reader-poll">Reader Poll</a></li>
				<?php } ?>
				<?php if(function_exists('snoadrotate_ad_group')) { ?>
				<li><a class="button" href="#advertisement">Advertisement</a></li>
				<?php } ?>
				<?php if(get_option('ssno') == "ssno928462s") {?>
				<li><a class="button" href="#sports-schedule">Sports Schedule</a></li>
				<li><a class="button" href="#sports-roster">Sports Roster</a></li>
				<li><a class="button" href="#sports-standings">Sports Standings</a></li>
				<?php } ?>
			</ul>
			<hr>
			<?php
			include(TEMPLATEPATH."/snosc/panel.related_stories.php");
			include(TEMPLATEPATH."/snosc/panel.pull_quote.php");
			include(TEMPLATEPATH."/snosc/panel.video_embed.php");
			include(TEMPLATEPATH."/snosc/panel.infographic_embed.php");
			include(TEMPLATEPATH."/snosc/panel.audio_clip.php");

			if(defined('WP_POLLS_VERSION')):
				include(TEMPLATEPATH."/snosc/panel.reader_poll.php");
			endif;

			include(TEMPLATEPATH."/snosc/panel.advertisement.php");

			if(get_option('ssno') == SPORTS_SSNO):
				include(TEMPLATEPATH."/snosc/panel.sports_schedule.php");
			endif;

			if(get_option('ssno') == SPORTS_SSNO):
				include(TEMPLATEPATH."/snosc/panel.sports_roster.php");
			endif;

			if(get_option('ssno') == SPORTS_SSNO):
				include(TEMPLATEPATH."/snosc/panel.sports_standings.php");
			endif;

			include(TEMPLATEPATH."/snosc/panel.sidebar.php");
			?>
		</div>
		<?php });
/* common footer html used in snosc panels */
function sno_emit_snosc_common_fields($prefix)
{ ?>
	<tr valign="top">
		<td>
			<select class="snosc-input" name="<?php echo $prefix; ?>-alignment" id="<?php echo $prefix; ?>-alignment">
				<option value="left"<?php if (get_theme_mod('story-element-align') == 'left') echo ' selected="selected"'; ?>>Left</option>
				<option value="right"<?php if (get_theme_mod('story-element-align') == 'right') echo ' selected="selected"'; ?>>Right</option>
				<option value="center"<?php if (get_theme_mod('story-element-align') == 'center') echo ' selected="selected"'; ?>>Center</option>
			</select>
			<b>Alignment</b>
		</td>

		<td>
			<select class="snosc-input" name="<?php echo $prefix; ?>-background" id="<?php echo $prefix; ?>-background">
				<option value="on"<?php if (get_theme_mod('story-element-background') == 'on') echo ' selected="selected"'; ?>>On</option>
				<option value="off"<?php if (get_theme_mod('story-element-background') == 'off') echo ' selected="selected"'; ?>>Off</option>
			</select>
			<b>Background</b>
		</td>

	</tr>

	<tr valign="top">
		<td>
			<select class="snosc-input" name="<?php echo $prefix; ?>-border" id="<?php echo $prefix; ?>-border">
				<option value="all"<?php if (get_theme_mod('story-element-border') == 'all') echo ' selected="selected"'; ?>>All</option>
				<option value="none"<?php if (get_theme_mod('story-element-border') == 'none') echo ' selected="selected"'; ?>>None</option>
				<option value="top"<?php if (get_theme_mod('story-element-border') == 'top') echo ' selected="selected"'; ?>>Top</option>
				<option value="right"<?php if (get_theme_mod('story-element-border') == 'right') echo ' selected="selected"'; ?>>Right</option>
				<option value="bottom"<?php if (get_theme_mod('story-element-border') == 'bottom') echo ' selected="selected"'; ?>>Bottom</option>
				<option value="left"<?php if (get_theme_mod('story-element-border') == 'left') echo ' selected="selected"'; ?>>Left</option>
			</select>
			<b>Border</b>
		</td>

		<td>
			<select class="snosc-input" name="<?php echo $prefix; ?>-shadow" id="<?php echo $prefix; ?>-shadow">
				<option value="on"<?php if (get_theme_mod('story-element-shadow') == 'on') echo ' selected="selected"'; ?>>On</option>
				<option value="off"<?php if (get_theme_mod('story-element-shadow') == 'off') echo ' selected="selected"'; ?>>Off</option>
			</select>
			<b>Shadow</b>
		</td>
	</tr>
	<?php
}
/* see https://codex.wordpress.org/Function_Reference/wp_enqueue_script */
/* load jquery ui core if we dont already have it */
add_action('admin_enqueue_scripts', function() {
	/*if(!wp_script_is('jquery-ui')) 
	{
		wp_register_script("jquery-ui", get_template_directory_uri()."/javascript/jquery-ui/jquery-ui.min.js",['jquery']);
		wp_enqueue_script("jquery-ui");
	}*/
	if(!wp_script_is('jquery-ui-core')) 
	{
		wp_enqueue_script("jquery-ui-core");
	}
	if(!wp_script_is('jquery-ui-autocomplete')) 
	{
		wp_enqueue_script("jquery-ui-autocomplete");
	}
	if(!wp_script_is('jquery-ui-sortable')) 
	{
		wp_enqueue_script("jquery-ui-sortable");
	}
	if(!wp_script_is('jquery-ui-draggable')) 
	{
		wp_enqueue_script("jquery-ui-draggable");
	}

});
add_action('admin_enqueue_styles', function() {
	/*if(!wp_style_is('jquery-ui'))
	{
		wp_register_style("jquery-ui", get_template_directory_uri() . "/javascript/jquery-ui/jquery-ui.css");
		wp_enqueue_style("jquery-ui");
	}*/
	if(!wp_style_is('jquery-ui-core'))
	{
		wp_enqueue_style("jquery-ui-core");
	}
	if(!wp_style_is('jquery-ui-autocomplete'))
	{
		wp_enqueue_style("jquery-ui-autocomplete");
	}
	if(!wp_style_is('jquery-ui-sortable'))
	{
		wp_enqueue_style("jquery-ui-sortable");
	}
	if(!wp_style_is('jquery-ui-draggable'))
	{
		wp_enqueue_style("jquery-ui-draggable");
	}
});
/* load our main snosc js file */
add_action('admin_enqueue_scripts', function()
{
	if(!wp_script_is('snosc')) 
	{
		wp_enqueue_script('snosc', get_template_directory_uri().'/snosc/snosc.js', 'jquery','jquery-ui-core','jquery-ui-autocomplete', '1.0', true);
	}
});
}
/** 
END SNOSC BLOCK
**/

// run following function once to update default dates -- update this every summer with new dates

function sno_update_default_dates() {

	if (get_option('flex_2017') != 3) {

	global $wpdb;
	// update default dates for game scheduler
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE name = 'Game Center'" );
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'season'" );
	$wpdb->update( 
		'wp_mf_custom_field_options', 
		array( 
			'default_option' => 'a:1:{i:0;s:9:"2018-2019";}'
		), 
		array( 'custom_field_id' => $custom_field_id ) 
	);

	// update default dates for roster
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE name = 'Athlete Roster Information'" );
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'roster_season'" );
	$wpdb->update( 
		'wp_mf_custom_field_options', 
		array( 
			'default_option' => 'a:1:{i:0;s:9:"2018-2019";}'
		), 
		array( 'custom_field_id' => $custom_field_id ) 
	);

	// update default dates for standings
	$panel_id = $wpdb->get_var( "SELECT id FROM wp_mf_write_panels WHERE name = 'Standings'" ); 
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE panel_id = '$panel_id'" ); 
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'season'" ); 
	$wpdb->update( 
		'wp_mf_custom_field_options', 
		array( 
			'default_option' => 'a:1:{i:0;s:9:"2018-2019";}'
		), 
		array( 'custom_field_id' => $custom_field_id ) 
	);

	// update default dates for staff profiles
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE name = 'Profile Information'" );
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'schoolyear'" );
	$wpdb->update( 
		'wp_mf_custom_field_options', 
		array( 
			'default_option' => 'a:1:{i:0;s:9:"2018-2019";}'
		), 
		array( 'custom_field_id' => $custom_field_id ) 
	);

	//delete default WordPress themes
	$url = get_home_path() . 'wp-content/themes/twentyten';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentyeleven';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentytwelve';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentythirteen';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentyfourteen';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentyfifteen';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentysixteen';
	sno_init_cleanup($url);		

	$url = get_home_path() . 'wp-content/themes/twentyseventeen';
	sno_init_cleanup($url);		

	update_option('flex_2017','3');
	}
	
}
add_action('admin_head', 'sno_update_default_dates');

function sno_init_cleanup($path) {
    if (is_dir($path) === true) {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file) {
            sno_init_cleanup(realpath($path) . '/' . $file);
        }
		return rmdir($path);
    } else if (is_file($path) === true) {
        return unlink($path);
    }
    return false;
}



// add facebook meta tags for sharing

function sno_facebook_metatags(){
	global $wp_query;
	global $post;
	
	$additional_tags = array();
	
	if( is_single() || is_page() && !is_front_page() ){
		$thePostID = $wp_query->post->ID;
		$sno_teaser = get_post_meta ($thePostID, 'sno_teaser', true);
	
		$the_post = get_post($thePostID); 
		// The title
		$title = apply_filters('the_title', $the_post->post_title);
		$writer = get_post_meta($post->ID, 'writer', true);
		// Description
		if($sno_teaser){
			$desc = trim(esc_html(strip_tags(do_shortcode( apply_filters('the_excerpt', $sno_teaser) ))));
		} else if (has_excerpt()) {
			$desc = trim(esc_html(strip_tags(do_shortcode( apply_filters('the_excerpt', $the_post->post_excerpt) ))));
		} else {
                $text = strip_shortcodes( $the_post->post_content );
                $text = apply_filters('the_content', $text);
                $text = str_replace(']]>', ']]&gt;', $text);
                $text = addslashes( strip_tags($text) );
                $excerpt_length = apply_filters('excerpt_length', 55);
               
                $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                if ( count($words) > $excerpt_length ) {
                        array_pop($words);
                        $text = implode(' ', $words);
                        $text = $text . "...";
                } else {
                        $text = implode(' ', $words);
                }
		
			$desc =  $text;
		} 
		
		$url = get_permalink( $the_post );
		
		// Tags
		$tags = get_the_tags();
		$tag_list = array();
		if($tags){
			foreach ($tags as $tag){
				$tag_list[] = $tag->name;
			}
		}
		$tags = implode( ",", $tag_list );
		
		if( get_post_meta($thePostID, 'video', true ) != '' ){ // Video post
		
			$type = "video.other";
			
			$additional_tags[] = "\n\t<meta property=\"video:tag\" content=\"$tags\" />"; 			
		
		} else { // Default post
		
			$type = "article";
			
			// Author
			/*$author = get_the_author();
			$additional_tags[] = "\n\t<meta property=\"article:author\" content=\"$author\" />"; */
			
			// Category
			$category = get_the_category(); 
			if (array_key_exists('0', $category)) {
				$section =  $category[0]->cat_name;
				$additional_tags[] = "\n\t<meta property=\"article:section\" content=\"$section\" />"; 
				$additional_tags[] = "\n\t<meta property=\"article:tag\" content=\"$tags\" />"; 
			}
		}
		
		// Post thumbnail
		if( has_post_thumbnail( $thePostID )){
			$thumb_id = get_post_thumbnail_id( $thePostID ); 
			$image = wp_get_attachment_image_src( $thumb_id, 'large' );
			$thumbnail = $image[0];
			$thumb_width = $image[1];
			$thumb_height = $image[2];
		} else if (get_theme_mod('fallback-image') != '') {
			$thumbnail = get_theme_mod('fallback-image'); 
			$thumb_id = sno_get_attachment_id( $thumbnail );
			$image = wp_get_attachment_image_src( $thumb_id, 'large' );
			$thumb_width = $image[1];
			$thumb_height = $image[2];
		} else if (get_theme_mod('touch-icon') != '') {
			$thumbnail = get_theme_mod('touch-icon'); 
			$thumb_id = sno_get_attachment_id( $thumbnail );
			$image = wp_get_attachment_image_src( $thumb_id, 'large' );
			$thumb_width = $image[1];
			$thumb_height = $image[2];
		} else {
			$thumbnail = get_theme_mod('header-image'); 
			$thumb_id = sno_get_attachment_id( $thumbnail );
			$image = wp_get_attachment_image_src( $thumb_id, 'large' );
			$thumb_width = $image[1];
			$thumb_height = $image[2];
		}
		
	} elseif( is_home() || is_front_page() ){
		$title = get_bloginfo('name');
		$desc = get_bloginfo('description');
		$type = "blog";
		$url = get_home_url();
		$thumbnail = get_theme_mod('touch-icon'); 
	} else {
		$title = get_bloginfo('name');
		$desc = get_bloginfo('description');
		$type = "blog";
		$url = get_home_url();
		$thumbnail = get_theme_mod('touch-icon'); 
	}
	
	$site_name = get_bloginfo();
	if (is_single()) {	
		echo "\n\t<meta property=\"og:title\" content=\"$title\" />";
   	 	echo "\n\t<meta property=\"og:type\" content=\"$type\" />";
   	 	echo "\n\t<meta name=\"author\" content=\"$writer\" />";
   	 	echo "\n\t<meta property=\"og:url\" content=\"$url\" />";
   	 	echo "\n\t<meta property=\"og:image\" content=\"$thumbnail\" />";
    	if (isset($thumb_width)) echo "\n\t<meta property=\"og:image:width\" content=\"$thumb_width\" />";
    	if (isset($thumb_height)) echo "\n\t<meta property=\"og:image:height\" content=\"$thumb_height\" />";
    	echo "\n\t<meta property=\"og:site_name\" content=\"$site_name\" />";
	}

    echo "\n\t<meta property=\"og:description\" content=\"$desc\" />";
    echo "\n\t<meta name=\"description\" content=\"$desc\" />";
		  
	echo implode($additional_tags);
				   
	echo "\n<!-- End of Facebook Meta Tags -->\n";
	
}

add_action('wp_head', 'sno_facebook_metatags');
function sno_remove_tinymce_buttons($buttons)
 {
 		// removing the polls TinyMCE button and the Read More button
		$remove = array('polls','wp_more');

		// if a staff profile is being edited, change it so that just polls is hidden
		$sno_staff_panel_override = get_option('sno_staff_panel');
		if ($sno_staff_panel_override) { 
			$sno_staff_panel = $sno_staff_panel_override;
		} else {
			$sno_staff_panel = '2';	
		}
		global $post; if (isset($post) && $post) { $story_panel_id = ''; $this_panel_id = get_post_meta($post->ID, '_mf_write_panel_id', true); }
		
		if ($this_panel_id == $sno_staff_panel) $remove = array('polls');

		//Find the array key and then unset
		return array_diff($buttons,$remove);
      	return $buttons;
 }
add_filter('mce_buttons','sno_remove_tinymce_buttons', 20);

function sno_search_sports_results($search_query) {
	$result = array();
	$list = sno_sport_list();
	foreach ($list as $sport) {
		if (strpos(strtolower($sport),strtolower($search_query)) !== false) { $result[] = $sport; }
	}
	return $result;
}

add_action('save_post','sno_blank_customfields_check');
function sno_blank_customfields_check($post_id) {

    // verify this is not an auto save routine. 
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    //authentication checks
    if (!current_user_can('edit_post', $post_id)) return;

    //obtain custom field meta for this post
     $custom_fields = get_post_custom($post_id);

    if(!$custom_fields) return;

    foreach($custom_fields as $key=>$custom_field):
        //$custom_field is an array of values associated with $key - even if there is only one value. 
        //Filter to remove empty values.
        //Be warned this will remove anything that casts as false, e.g. 0 or false 
        //- if you don't want this, specify a callback.
        //See php documentation on array_filter
		// removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
		$values = array_filter( $custom_field, 'strlen' );
        //After removing 'empty' fields, is array empty?
        if(empty($values)):
            if ($key == 'ourscore' || $key == 'roster_jersey') {} else { delete_post_meta($post_id,$key); } //Remove post's custom field
        endif;
    endforeach; 
    return;
}

function sno_auto_update_specific_plugins ( $update, $item ) {
    // Array of plugin slugs to always auto-update
    $plugins = array ( 
        'admin-menu-editor',
        'akismet',
        'facebook-meta-tags',
        'gravity-forms',
        'magic-fields',
        'maintenance-mode',
        'my-calendar',
        'print-friendly-and-pdf',
        'remove-inactive-widgets',
        'sharethis',
        'sno-ad-manager',
        'sno-privacy-gateway',
        'sno-site-analytics',
        'ultimate-category-excluder',
        'user-role-editor',
        'wordpress-thread-comment',
        'wp-paginate',
        'wp-polls',
        'menu-icons',
    );
    if ( in_array( $item->slug, $plugins ) ) {
        return true; // Always update plugins in this array
    } else {
        return $update; // Else, use the normal API response to decide whether to update or not
    }
} 
add_filter( 'auto_update_plugin', 'sno_auto_update_specific_plugins', 10, 2 );
add_filter( 'auto_update_theme', '__return_true' );
// add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );
add_filter( 'allow_minor_auto_core_updates', '__return_true' );

function sno_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	return $attachment[0]; 
}
function sno_menu_icons() {
	$menus = get_option('menu-icons');
	$change = '';
	if (!in_array('fa', $menus['global']['icon_types'])) { $menus['global']['icon_types'][] = 'fa'; $change = 'True'; }
	if (!in_array('elusive', $menus['global']['icon_types'])) { $menus['global']['icon_types'][] = 'elusive'; $change = 'True'; }
	if (!in_array('dashicons', $menus['global']['icon_types'])) { $menus['global']['icon_types'][] = 'dashicons'; $change = 'True'; }
	if (!in_array('foundation-icons', $menus['global']['icon_types'])) { $menus['global']['icon_types'][] = 'foundation-icons'; $change = 'True'; }
	if (!in_array('genericons', $menus['global']['icon_types'])) { $menus['global']['icon_types'][] = 'genericons'; $change = 'True'; }
	if ($change == 'True') update_option('menu-icons', $menus);

	if ( is_admin() && !is_plugin_active( 'menu-icons/menu-icons.php' ) ) {
		sno_activate_plugin();
	}
}
add_action('shutdown', 'sno_menu_icons');

function sno_display_extra_column() {
	
	$result = '';
	
	$content_width = get_theme_mod('content-width'); if ($content_width == '') $content_width = 980;

	if (is_single() && get_theme_mod('extra-column') == 'Display' && is_active_sidebar(10) && $content_width == 980) {
		$template_url = sno_story_page($single_template = null);
		$pos = strrpos($template_url, '/');
		$template = $pos === false ? $template_url : substr($template_url, $pos + 1);
		if ( $template == 'storyrails.php' && get_theme_mod('extra-column-siderails') == 'Yes') { 
			$result = "True";	
		} 
		if ( $template == 'index.php' && get_theme_mod('extra-column-fullwidth') == 'Yes') { 
			$result = "True";	
		} 
		if ( $template == 'classic.php' && get_theme_mod('extra-column-classic') == 'Yes') { 
			$result = "True";	
		} 
	}
	if (is_archive() && get_theme_mod('extra-column') == 'Display' && is_active_sidebar(10) && get_theme_mod('extra-column-category') == 'Yes' && $content_width == 980) {
		$result = "True";
	}
	if (is_home() && get_theme_mod('extra-column') == 'Display' && is_active_sidebar(10) && $content_width <= 1200) {
		$result = "True";	
	}
	return $result;
}
function sno_sharing_icons($template, $location, $story=null) {
	
	global $post; $content = ''; $original_location = $location;
	
	if ($template == 'Full-Width') {
		$fullwidthoptions = get_theme_mod('sharing-icons-fullwidth'); 
			if ($fullwidthoptions == '') $fullwidthoptions = 'Above';
			if ($fullwidthoptions == 'Above/Below' && ($location == 'Above' || $location == 'Below')) $location = 'Above/Below';
	}
	if ($template == 'Classic') {
		$classicoptions = get_theme_mod('sharing-icons-classic'); 
			if ($classicoptions == '') $classicoptions = 'Above';
			if ($classicoptions == 'Above/Below' && ($location == 'Above' || $location == 'Below')) $location = 'Above/Below';
	}
	if ($template == 'Side Rails') {
		$siderailsoptions = get_theme_mod('sharing-icons-siderails'); 
			if ($siderailsoptions == '') $siderailsoptions = 'Left Rail';
			if ($siderailsoptions == 'Left Rail/Below' && ($location == 'Left Rail' || $location == 'Below')) $location = 'Left Rail/Below';
	}	
	
	if ($template == 'Full-Width' && $fullwidthoptions != $location) return;
	if ($template == 'Classic' && $classicoptions != $location) return;
	if ($template == 'Side Rails' && $siderailsoptions != $location) return;
	
	
		$shareURL = urlencode(get_permalink($story));
 		$short_link = urlencode(wp_get_shortlink($story)); 
		$shareTitle = urlencode(get_the_title($story));
		$shareThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		
		$twitterHandle = get_theme_mod('sharing-twitter-username'); 
		if ($twitterHandle) {
			$twitterHandle = str_replace('@', '', $twitterHandle);
			$urlcleaner = strrpos($twitterHandle, '/'); 
			if ($urlcleaner) $twitterHandle = substr($twitterHandle, $urlcleaner + 1);
			$twitterHandle = "&amp;via=" . $twitterHandle;
		}
		
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$shareTitle.'&amp;url='.$short_link.$twitterHandle;
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shareURL;
		$googleURL = 'https://plus.google.com/share?url='.$shareURL;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$shareURL.'&amp;media='.$shareThumbnail[0].'&amp;description='.$shareTitle;
 		$redditURL = 'https://reddit.com/submit?url='.$shareURL.'&title='.$shareTitle;
		$tumblrURL = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='.$shareURL.'&title='.$shareTitle;

		$content .= '<div class="sharing sharing-top">';
		
		$sharing_mobile = ' sharing-mobile-show';
		if (get_theme_mod('sharing-mobile-comments') != 'Display') $sharing_mobile = ' sharing-mobile-hide';
		
			if (get_theme_mod('comments') == 'Enable' && $original_location != 'Below' && $template != 'Side by Side' && get_theme_mod('sharing-comments') != 'Hide') {
				$content .= "<a class='commentscroll' href='" . get_comments_link() . "'><div class='sharing-icon sno-comments fa fa-comments-o sno-dark $sharing_mobile'></div></a>";
				?><script type="text/javascript">
					$(function () {
						$('.commentscroll').click(function () {
						var adjustment = 70;
						<?php if ( get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') != 'Off') { ?>
							adjustment += $('.navbarwrap').height(); 
						<?php } ?>
						<?php if ( get_theme_mod('bottomnav-stick') == 'Activate' && get_theme_mod('bottomnav') == 'Show') { ?>
							adjustment += $('.subnavbarwrap').height();
						<?php } ?>
						$('html, body').animate({ scrollTop: $("#commentswrap").offset().top - adjustment }, 500);
						return false;
						});
					});
				</script><?php

			}
						
		$sharing_mobile = ' sharing-mobile-show';
		if (get_theme_mod('sharing-mobile') != 'Display') $sharing_mobile = ' sharing-mobile-hide';
		$show_remodal = false;
		
			if (get_theme_mod('sharing-facebook') != 'Hide') {
				$content .= '<a class="modal-share" href="'.$facebookURL.'" title="Share on Facebook" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-facebook dashicons dashicons-facebook-alt sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Facebook</span></div></a>';
				$show_remodal = true;
			}
			if (get_theme_mod('sharing-twitter') != 'Hide') {
				$content .= '<a class="modal-share" href="'.$twitterURL.'" title="Tweet This Story" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-twitter dashicons dashicons-twitter sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Twitter</span></div></a>';
				$show_remodal = true;
			}
			if (get_theme_mod('sharing-google') == 'Show') {
				$content .= '<a class="modal-share" href="'.$googleURL.'" title="Share on Google+" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-google-plus fa fa-google-plus sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Google Plus</span></div></a>';
				$show_remodal = true;
			}
			if (get_theme_mod('sharing-pinterest') == 'Show') {
				$content .= '<a class="modal-share" href="'.$pinterestURL.'" title="Share on Pinterest" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-pinterest fa fa-pinterest sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Pinterest</span></div></a>';
				$show_remodal = true;
			}
			if (get_theme_mod('sharing-reddit') == 'Show') {
				$content .= '<a class="modal-share" href="'.$redditURL.'" title="Share on Reddit" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-reddit genericon genericon-reddit sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Reddit</span></div></a>';
				$show_remodal = true;
			}
			if (get_theme_mod('sharing-tumblr') == 'Show') {
				$content .= '<a class="modal-share" href="'.$tumblrURL.'" title="Share on Tumblr" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-tumblr fa fa-tumblr sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share on Tumblr</span></div></a>';
				$show_remodal = true;
			}
			
		$sharing_mobile = ' sharing-mobile-show';
		if (get_theme_mod('sharing-mobile-email') != 'Display') $sharing_mobile = ' sharing-mobile-hide';
			
			if (get_theme_mod('sharing-email') != 'Hide') {
				$content .= '<a aria-hidden="true" data-remodal-target="modal"><div class="sharing-icon sno-email dashicons dashicons-email-alt sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Email</span></div></a>';
				$show_remodal = true;
			}
		$content .= '</div>';		
		
		echo $content;	
		
		if ( $show_remodal == true ) {
			
		?>
			<script type="text/javascript">
				$(document).ready(function() {
					$(function(){
						$('.modal-share').click(function() {
							var inst = $('[data-remodal-id=modal-share]').remodal();
							inst.open();

							var sharestoryid = '<?php echo $post->ID; ?>';

							$.ajax({
	                			url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=sharestory&sharestoryid=' + sharestoryid,
								success:function(results)
	            					{ $("#suggestedstories").replaceWith(results); }
	           				});

						});
										
					});
				});
			</script>

			<div class="remodal" data-remodal-id="modal-share" data-remodal-options="hashTracking: false, closeOnConfirm: false">
  				<button data-remodal-action="close" class="remodal-close"><span class="icon-hidden-text">Close Modal Window</span></button>
  				<div id="suggestedstories">
  				<h1>Hang on for a minute...we're trying to find some more stories you might like.</h1>
  				<form method="post" action="">

  				<br />
  				<button data-remodal-action="cancel" class="remodal-cancel">Close</button>

  				</form>
  				</div>
			</div>

		<?php
		}

		if (get_theme_mod('sharing-email') != 'Hide') {
			
			$location = str_replace(' ', '', $original_location);
			$number1 = rand(0, 10);
			$number2 = rand(0, 10);
			$result = $number1 + $number2;

			?>
			<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnConfirm: false">
  				<button data-remodal-action="close" class="remodal-close"><span class="icon-hidden-text">Close Modal Window</span></button>
  				<div id="emailstoryform">
  				<h1>Email This Story</h1>
  				<form method="post" action="">
  				<label for="email_to_<?php echo $location; ?>" style="display:none;">Send email to this address</label>
  				<input type="text" id="email_to_<?php echo $location; ?>" name="email_to_<?php echo $location; ?>" class="sno_email_fields" placeholder="Send email to this address"><br />
  				
  				<label for="email_from_<?php echo $location; ?>" style="display:none;">Enter Your Name</label>
  				<input type="text" id="email_from_<?php echo $location; ?>" name="email_from_<?php echo $location; ?>" class="sno_email_fields" placeholder="Enter Your Name"><br />
  				
  				<label for="email_comment_<?php echo $location; ?>" style="display:none;">Add a comment here</label>
  				<textarea rows="4" id="email_comment_<?php echo $location; ?>" name="email_comment_<?php echo $location; ?>" class="sno_email_fields" placeholder="Add a comment here (optional)."></textarea><br />
  				
  				<label for="human_<?php echo $location; ?>" style="display:none;">Verification</label>
  				<input type="text" id="human_<?php echo $location; ?>" name="human_<?php echo $location; ?>" class="sno_email_fields" placeholder="What's <?php echo $number1; ?> + <?php echo $number2; ?>?"><br />

  				<br />
  				<button id="submit_email_<?php echo $location; ?>" data-remodal-action="confirm" class="remodal-confirm">Send Email</button>
  				<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  				<?php wp_nonce_field( 'sno_email_submission_check', 'sno_email_submission_form' ); ?>

  				</form>
  				</div>
			</div>
										<script>
								$(document).ready(function() {

								$(function(){
           							$('#submit_email_<?php echo $location; ?>').click(function(){
											var storyid = '<?php echo $post->ID; ?>';
											var datastring = '';
											if ($("#email_to_<?php echo $location; ?>").length > 0){
												var email_to = $('input[name=email_to_<?php echo $location; ?>]');
												datastring += '&email_to=' + encodeURIComponent(email_to.val());
       										}

											if ($("#email_from_<?php echo $location; ?>").length > 0){
												var email_from = $('input[name=email_from_<?php echo $location; ?>]');
												datastring += '&email_from=' + encodeURIComponent(email_from.val());
       										}

											if ($("#email_comment_<?php echo $location; ?>").length > 0){
												var email_comment = $('textarea[name=email_comment_<?php echo $location; ?>]');
												datastring += '&email_comment=' + encodeURIComponent(email_comment.val());
       										}

											if ($("#human_<?php echo $location; ?>").length > 0){
												var human = $('input[name=human_<?php echo $location; ?>]');
												datastring += '&human=' + encodeURIComponent(human.val());
       										}
       										
	   										datastring += '&humanity=' + <?php echo $result; ?>;

       										var verification = $('input[name=sno_email_submission_form]');
	   										datastring += '&verification=' + verification.val();
       										
										//	var parentid = '<?php echo $parent_id; ?>';
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=emailstory&storyid=' + storyid + datastring,
 	            				            success:function(results)
	            				            { $("#emailstoryform").replaceWith(results); }
	           				    	  	});
	         						});
								});
								});

							</script>

			<?php 
		}	
	
	return;				

}

function sno_get_teaserbar( $home=null ) {
	wp_reset_query();
	global $post; 

	if ($home == 'home') {
				
		$storybarcount = get_theme_mod('storybar-home-count'); if ($storybarcount == '') $storybarcount = 10;
		echo '<div class="sno_teaserbar_home" id="sno_teaserbar">';

	} else {

		$storybarcount = get_theme_mod('storybar-count'); if ($storybarcount == '') $storybarcount = 10;
		echo '<div class="sno_teaserbar" id="sno_teaserbar">';

	}
		
		if ($home == 'home') {
		
			$cat = get_theme_mod('storybar-cat-home'); 
			if ($cat == '') $cat = get_theme_mod('featured-cat');
			$args = array ( 'cat' => $cat, 'numberposts' => $storybarcount, 'exclude' => $post->ID );		

		} else if (get_theme_mod('storybar-content') == 'Custom Category' || get_theme_mod('storybar-content') == '') {
			
			$cat = get_theme_mod('storybar-cat');
			if ($cat == '') $cat = get_theme_mod('featured-cat');
			$args = array ( 'cat' => $cat, 'numberposts' => $storybarcount, 'exclude' => $post->ID );	
			
						
		} else if (get_theme_mod('storybar-content') == 'Same Category as Story') {
			
			global $post; $cat_info = get_the_category(); $cat = $cat_info[0]->cat_ID;
			$args = array ( 'cat' => $cat, 'numberposts' => $storybarcount, 'exclude' => $post->ID );		

		} else if (get_theme_mod('storybar-content') == 'Same Writer as Story') {
			

			$writers = get_post_meta($post->ID, 'writer', false); 
		
				$args = array(
					'numberposts' => $storybarcount,
					'exclude' => $post->ID,
					'meta_query' => array(
						array(
							'key' => 'writer',
							'value' => $writers,
							'compare' => 'IN'
						)
					)
				);

		} else if (get_theme_mod('storybar-content') == 'Same Tags as Story') {

			$tag_data = get_the_tags(); $tags = array();
			
			if (is_array($tag_data)) foreach ($tag_data as $tag_info) $tags[] = $tag_info->term_id;

			$args = array( 'exclude' => $post->ID, 'numberposts' => $storybarcount, 'tax_query' => array(array('taxonomy'=> 'post_tag','field'=>'term_id','terms'=> $tags)) );


		}
		
		$queried_posts = get_posts( $args );

			$count = count($queried_posts);
			
			if ($count < $storybarcount) {
				$needed_count = $storybarcount - $count; $exclusion = array();
				
				foreach ($queried_posts as $checkpost) $exlusion[] = $checkpost->ID;
				
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); 
				$args = array ( 'cat' => $uncategorized, 'showposts' => $needed_count, 'post__not_in' => $exclusion, 'exclude' => $post->ID);
				
				$queried_posts_addition = get_posts($args);
				
				$queried_posts = array_merge($queried_posts, $queried_posts_addition);
		
			}

			echo '<div class="stb_nav">';
				echo '<div class="custom-navigation">';
					echo '<span class="flex-prev"><div class="stb_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
				echo '</div>';

			echo '</div>';

			echo "<div id='stb-container' class='flexslider'>";				
			echo '<ul class="slides">';
			foreach ($queried_posts as $queried_post) {
			
				$thePostID = $queried_post->ID; setup_postdata($thePostID);
				$link = get_permalink($thePostID);

					echo "<li class='stb-top-row'>";
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium');
						$unique_id = 'stb' . $thePostID;
						
						if ($image) {
							echo "<div class='stb_image'>";

							if ($image[1] > $image[2]) { 
								$thumbstyle = " style='height:70px;min-height:70px;width:auto;'";
							} else {
								$thumbstyle = " style='width:70px;min-width:70px;'";
							} 

							echo "<a href='$link#photo'>";
							
							$image0 = $image[0];
							echo "<img src='$image0' id='grow-$unique_id' $thumbstyle class='catboxphoto' alt='" . get_the_title() . "'/>";
						
							echo '</a>';
							echo '</div>'; 

							if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
								echo "<script type='text/javascript'>
									$(document).ready(function() {
   								 		$('#grow-$unique_id').mouseenter(function() {
   											$('#grow-$unique_id').removeClass('shrink');
   											$('#grow-$unique_id').removeClass('grow');
   											$('#grow-$unique_id').addClass('grow');
   										}).mouseleave(function() {
   											$('#grow-$unique_id').addClass('shrink');
   										});";
  													
								echo "});</script>";
							}

						}

    					$categories = get_the_category($thePostID); $cat_list = array();
    					
    					$catcount = count($categories);
    					    					
    					if ($catcount == 1) {
	    				
	    					foreach($categories as $category) $cat_list[] = $category->term_id;							
	    				
	    				} else {

							foreach($categories as $category)  {  	
								if ($home == 'home') {
									if ($category->term_id != get_theme_mod('storybar-cat-home')) $cat_list[] = $category->term_id;	
								} else {
									if ($category->term_id != get_theme_mod('storybar-cat') || $category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;	
								}						
							}
						
						}
    					
    					$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
												
						if (isset ($single_cat) || $home == 'home') {
						
							$co .= get_cat_name($single_cat); 
							echo "<p class='stb-cat'>$co</p>";

						} else {
						
							echo "<p class='stb-cat'>Related Content</p>";
						
						}

						echo '<p class="relatedtitle">';
						echo '<a href="' . $link . '">' . get_the_title($thePostID) . '</a>';
						echo '</p>';
					echo '</li>';	
					
			}
			echo '</ul>';
			echo '</div>';

			echo '<div class="stb_nav">';
				echo '<div class="custom-navigation">';
					echo '<span class="flex-next"><div class="stb_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
				echo '</div>';
			echo '</div>';

	echo '</div>';
	echo '<div class="clear"></div>';
	?><script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#stb-container').flexslider({
				animation: "slide",
				animationLoop: true,
				customDirectionNav: $(".stb_nav .custom-navigation span"), 
       			slideshow: false,
				itemMargin: 2,
				touch: true,
				itemWidth: 250,
				minItems: 1,
				move: 1,
				maxItems: 5
  			});

  							//		animation: 'fade',
  							//		smoothHeight: false,
  							//		customDirectionNav: $("#sfi-navigation<?php echo $unique; ?> span"),
  							//		animationLoop: true,
  							//		slideshow: false,
  							//		touch: true



		});

			$(document).ready(function(){
			
			var TB_CurrentScroll = 0; var TB_NextScroll = 0; var hbheight = 0;
			
		<?php if (get_theme_mod('storybar-direction') != 'Bottom') { ?>	
			$(window).scroll(function(event) {
				TB_CurrentScroll = TB_NextScroll;
				if ($('#sno_hoverbar').is(":visible")) { hbheight = 50 }
				TB_NextScroll = $(this).scrollTop();
				if (TB_NextScroll < TB_CurrentScroll && $(document).scrollTop() > 500) {  // scrolling up on the page causes it to display
					if ($('.sno_teaserbar').is(":hidden")) {
						$('.sno_teaserbar').show();
						$('.sno_teaserbar').stop().animate({ top: hbheight }, { duration: 300, queue: false });
					}
				}
				 else if ((TB_NextScroll > TB_CurrentScroll && $(document).scrollTop() > 500) || $(document).scrollTop() < 400 ){ // scrolling down on the page causes it to hide
					$('.sno_teaserbar').stop().animate({
						top: '-86px'
						},200, function(){
							$('.sno_teaserbar').hide();
						});
				} 
			});
		<?php } else { ?>
			$(window).scroll(function(event) {
				TB_CurrentScroll = TB_NextScroll;
				TB_NextScroll = $(this).scrollTop();
				if (TB_NextScroll < TB_CurrentScroll && $(document).scrollTop() > 500) {  // scrolling up on the page causes it to display
					if ($('.sno_teaserbar').is(":hidden")) {
						$('.sno_teaserbar').show();
						$('.sno_teaserbar').stop().animate({ bottom: '0' }, { duration: 300, queue: false });
					}
				}
				 else if ((TB_NextScroll > TB_CurrentScroll && $(document).scrollTop() > 500) || $(document).scrollTop() < 10 ){ // scrolling down on the page causes it to hide
					$('.sno_teaserbar').stop().animate({
						bottom: '-86px'
						},200, function(){
							$('.sno_teaserbar').hide();
						});
				} 
			});
		<?php } ?>
		});
	</script><?php

}

function sno_get_hoverbar () {
	if (get_theme_mod('header-alt') != 'Display' || get_theme_mod('altheader-stick') == 'Deactivate') {
		if (get_theme_mod('sharing-mobile-stick') == 'Stick' && is_single()) { 
			echo '<div id="mobile-socialmedia">';
        		sno_sharing_icons( $template = 'Long Form', $location = 'Bar');
			echo '</div>';
		}
		
	echo '<div id="sno_hoversearch">';
		echo '<div class="sno-search-close foundation-icons fi-x" style="float:right;"></div>';
		echo '<div class="hover-search-area">';

										?><form method="get" id="searchform-alt" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<label for="s-alt" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
											<input type="text" class="field" name="s" id="s-alt" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
											<input type="submit" class="submit" name="submit" id="searchsubmit-alt" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
											<button type="submit" id="sno-hover-search-button" class="sno-submit-search sno-search fa fa-search"><span class="icon-hidden-text">Submit Search</span></button>
										</form><?php
		echo '</div>';
	echo '</div>';
	
	echo '<div id="sno_hoverbar">';
			echo '<div class="hoverheader">';
			
				if 	(( get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') != 'Off') || (get_theme_mod('bottomnav-stick') == 'Activate' && get_theme_mod('bottomnav') == 'Show') || get_theme_mod('header-alt') == 'Display') { } else { 

					echo '<div id="hover-menu">';
						echo '<div class="sno-menu menu-icon dashicons dashicons-menu"><span class="icon-hidden-text">Menu</span></div>';
						echo '<div class="sno-menu close-icon foundation-icons fi-x" style="display:none;"><span class="icon-hidden-text">Close Menu</span></div>';
					echo '</div>';
				}


				echo '<div id="search-top"><div aria-hidden="true" class="sno-search-button fa fa-search"><span class="icon-hidden-text">Activate Search</span></div></div>';

				if (is_single()) {
					echo '<div class="socialmedia">';
        				sno_sharing_icons( $template = 'Long Form', $location = 'Bar');
					echo '</div>';
				}
				

				echo '<div id="back-top"><a id="snotop" href="#top" title="Return to Top"><div aria-hidden="true" class="sno-arrow-up fa fa-arrow-up"><span class="icon-hidden-text">Scroll to Top</span></div></a></div>';

 				echo '<div class="lf_headerleft">';
 					
 					$immersion_redirect = '';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

 					if (get_theme_mod('mini-logo')) { 
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" /></a>';			
					} else if (get_theme_mod('header-image-small')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-small') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else if (get_theme_mod('header-image-medium')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-medium') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else if (get_theme_mod('header-image')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else {
						echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<div class="sno-home menu-icon dashicons dashicons-admin-home"><span class="icon-hidden-text">Home</span></div>';
						echo '</a>';
       				}
       				
       			echo '</div>';


       			echo '<div class="hover_title">';
       				echo '<div class="hover_titletext">';
       					if (get_theme_mod('hoverbar-title') != 'Hide') {
	       					if (is_single()) { global $post; the_title(); }
		   					if (is_archive()) { single_cat_title(); }
		   					if (is_home()) { bloginfo('description'); }
		   					if (is_search()) { echo 'Search: '; the_search_query(); }
		   					if (is_page()) { global $post; the_title(); }
		   				}
		   			echo '</div>';
       			echo '<span id="progress-bar"><span id="progress-bar-color"></span></span>';
       			echo '</div>';

			echo '</div>';
			echo '<div class="clear"></div>';
		echo '</div>';
		
		if (get_theme_mod('header-alt') != 'Display') {
			echo '<div id="hoverbar_menu">';
				echo '<ul class="slidemenu mobile-menu">';
					
						echo '<li class="mobile-search">';


								?><form method="get" id="searchform-alt-left" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label for="s-alt-left-hoverbar" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
									<input type="text" class="field" name="s" id="s-alt-left-hoverbar" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
									<input type="submit" class="submit" name="submit" id="searchsubmit-left" style="display:none;" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
								</form><?php

						echo '</li>';
					echo '<div class="clear"></div>';

					$nav_menu = get_theme_mod('nav_menu_locations');

					if ($nav_menu['mobile-menu'] == '') {
						$menu_name = 'header-menu-2';
					} else { 
						$menu_name = 'mobile-menu';
					}
					
					wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'mobile-menu' ) );	
    				
				echo '</ul>';
				
			echo '</div>';
		}

	?><script type="text/javascript">
		$(document).ready(function(){
			

			function sharingIconsResize() {
				if ($(window).width() < 850) {
					var socialwidth;
					var count = $("#mobile-socialmedia .sharing-mobile-show").length;
					if (count != 0) {
						socialwidth = 100 / count;
						$('#mobile-socialmedia .sharing-icon').width(socialwidth + '%');
					}
				} else {
					$('#sno_hoverbar .sharing-icon').width('50px');
				}
			}
			<?php if (get_theme_mod('sharing-mobile-stick') == 'Stick') { ?>
				sharingIconsResize();
				
				$(window).resize(function() {
					sharingIconsResize();
				});
			<?php } ?>
			
			$('.sno-search-button').click(function() {
				$('#sno_hoversearch').fadeToggle();
				$('#sno_hoversearch').css({ top: '0' });
				$('#s-alt').focus();
			});
			$('.sno-search-close').click(function() {
				$('#sno_hoversearch').fadeToggle();
				$('#sno_hoversearch').css({ top: '-50px' });
			});

			var NavScrollTop		= $(window).scrollTop();
    		
    		if( $('.navbarwrap').length ) {
    			var	TopNavOffset 		= $('.navbarwrap').offset().top;
				var TopNavDistance		= (TopNavOffset - NavScrollTop);
   	 		}
   	 		if( $('.subnavbarwrap').length ) {
	   	 		var	BottomNavOffset 	= $('.subnavbarwrap').offset().top;
	   	 		var	BottomNavDistance	= (BottomNavOffset - NavScrollTop);
   	 		}
   	 		
   	 		$('#hoverbar_menu .mobile-menu').height( $(window).height() - 50);
   	 		
   	 		var HoverOffset = 0, HoverOffset2 = 0;
			<?php if (is_admin_bar_showing()) { ?>
					if ($('#wpadminbar').is(":visible")) {
						HoverOffset += $('#wpadminbar').outerHeight();
						HoverOffset2 += $('#wpadminbar').outerHeight();
					}
   	 		<?php } ?>
   	 		var HoverHeight = $('#sno_hoverbar').outerHeight();
   	 		var HoverHeight2 = $('#sno_hoverbar').outerHeight();
   	 		
			<?php if 	(
							get_theme_mod('topnav-stick') == 'Activate' && 
							get_theme_mod('topnav-location') != 'Off' && (
								get_theme_mod('header-alt') == '' || (
									get_theme_mod('header-alt') == 'Display' && 
									get_theme_mod('altheader-top') == 'Menu A'
								)
							)
						) { ?>
						
						if( $('.navbarwrap').length ) {
							HoverOffset2 += $('.navbarwrap').outerHeight();
							HoverHeight2 += $('.navbarwrap').outerHeight();
						}
			<?php } ?>

			var CurrentScroll = 0;
			var WindowHeight = $(document).height() - $('.footerwrap').height();
			
			<?php if (get_theme_mod('comments') == 'Enable' && is_single()) { ?>
				WindowHeight -= $('#commentswrap').height();		
			<?php } ?>
			
			
			$('.sno-menu').click(function() {
			
				$('#hoverbar_menu').fadeToggle();
				$('.menu-icon').toggle();
				$('.close-icon').toggle();
				$('#hoverbar_menu').css({ height: $(window).height() - 50 });
			
			});
			
			$(window).scroll(function(event) {
				var NextScroll = $(this).scrollTop();

				var ScrollPercent = (NextScroll / (WindowHeight - $(window).height())) * 100;
				

				$('#progress-bar-color').css({ width: ScrollPercent + '%'});
				$('#hoverbar_menu').css({ top: $('#sno_hoverbar').height() });
				
				if ( ScrollPercent > 100 ) {
					<?php $accentcolor = get_theme_mod('hoverbar-accent'); if ($accentcolor == '') $accentcolor = get_theme_mod('reset-color1'); ?>
					$('.sno-arrow-up').css({ background: '<?php echo $accentcolor; ?>', color: '#eee'});
					$('.sno-menu').css({ background: '<?php echo $accentcolor; ?>', color: '#eee'});
					$('.socialmedia .sharing-icon').css({ opacity: 1 })
					
					<?php if (get_theme_mod('hoverbar-color') == 'Dark') { ?>
						$('.sharing-icon').removeClass("sno-dark");
					<?php } ?>

				} else {
					<?php 	if (get_theme_mod('hoverbar-color') == 'Dark') { 
								$background = '#222'; $color = '#fff'; $menubackground = '#000';
								?>$('.sharing-icon').addClass("sno-dark");<?php
								if (get_theme_mod('hoverbar-progress') == 'Deactivate') { 
									$background = $menubackground;
								}
							} else if (get_theme_mod('hoverbar-color') == 'Custom') {
								$background = get_theme_mod('hoverbar-site-icons-background');
								$color = get_theme_mod('hoverbar-site-icons');
							} else {
								$background = '#eee'; $color = '#ccc'; $menubackground = '#eee';
							}
					?>
					$('.sno-arrow-up').css({ background: '<?php echo $background; ?>', color: '<?php echo $color; ?>'});
					$('.sno-menu').css({ background: '<?php echo $menubackground; ?>', color: '<?php echo $color; ?>'});
				}
				var headerLocation = $("#wrap").offset().top;
				if (NextScroll > CurrentScroll && $(document).scrollTop() > headerLocation) {
					if ($('#sno_hoverbar').is(":hidden")) {
						$('#sno_hoverbar').show();
						$('#sno_hoverbar').stop().animate({ top: '0' }, { duration: 300, queue: false });
						<?php if 	(
										get_theme_mod('topnav-stick') == 'Activate' && 
										get_theme_mod('topnav-location') != 'Off' && (
											get_theme_mod('header-alt') == '' || (
												get_theme_mod('header-alt') == 'Display' && 
												get_theme_mod('altheader-top') == 'Menu A'
											)
										)
									) { ?>
							if( $('.navbarwrap').length ) {
								$('.navbarwrap').stop().animate({ top: HoverHeight +'px'}, { duration: 300, queue: false });
							}
						<?php } ?>

						<?php if 	(
										get_theme_mod('bottomnav-stick') == 'Activate' && 
										get_theme_mod('bottomnav') == 'Show' && 
										get_theme_mod('header-alt') == ''
									) { ?>
							if( $('.subnavbarwrap').length ) {	
								$('.subnavbarwrap').stop().animate({ top: HoverHeight2 +'px'}, { duration: 300, queue: false });
							}
						<?php } ?>
						
						<?php if (get_theme_mod('hoverbar-progress') != 'Deactivate') { ?>
							var lpb = $('.lf_headerleft').width();
							<?php if (( get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') != 'Off') || (get_theme_mod('bottomnav-stick') == 'Activate' && get_theme_mod('bottomnav') == 'Show') || get_theme_mod('header-alt') == 'Display') { } else { ?>lpb += $('#sno_hoverbar .sno-menu').width(); <?php } ?>
							var rpb = 50 + $('.socialmedia').width();
							<?php if (get_theme_mod('hoverbar-search') != 'Hide') { ?>
								rpb += $('#sno_hoverbar .sno-search-button').width();
							<?php } ?>
							$('#progress-bar').css({ left: lpb + 'px', right: rpb + 'px'})
						<?php } ?>
        			}


        			
				} else if (NextScroll < CurrentScroll && $(document).scrollTop() < ( headerLocation + 300 ) && $('#sno_hoverbar').is(":visible")) {
				
						$('#hoverbar_menu').hide();
						$('.close-icon').hide();
						$('.menu-icon').show();
						$('#hoverbar_menu').hide();
						$('#sno_hoverbar').stop().animate({
							top: '-50px'
							},300, function(){
								$('#sno_hoverbar').hide();
							});
						if ( $('.navbarwrap').length ) { $('.navbarwrap').stop().animate({ top: HoverOffset + 'px'},300); }
						if ( $('.subnavbarwrap').length ) { $('.subnavbarwrap').stop().animate({ top: HoverOffset2 + 'px'},300); }

				}
			CurrentScroll = NextScroll;
			});


		});

		$("#snotop").hide();
	
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 500) {
					$('#snotop').fadeIn();
				} else {
					$('#snotop').fadeOut();
				}
			});

			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});

		});
	</script><?php
	}
}


function emailstory_ajaxpost() {
	
	$unique = '';
	if ( isset($_POST['unique'])) $unique = $_POST['unique'];
  				
	if ( ! isset( $_POST['verification'] ) || ! wp_verify_nonce( $_POST['verification'], 'sno_email_submission_check'.$unique ) ) {

		
		echo 'Something doesn\'t quite seem right. Are you sure you\'re a human?';
		die;
		

	} else {
		
		
		$slideshow = $_POST['slideshow'];
		if ($slideshow = 'slideshow') { $type = 'slideshow'; } else { $type = 'story'; }
     	$email_to = $_POST['email_to'];
     	$email_from = stripslashes($_POST['email_from']);
     	$storyid = $_POST['storyid'];
     	$email_comment = stripslashes($_POST['email_comment']);
     	$humanity = $_POST['humanity'];
     	$human = stripslashes($_POST['human']);
	 	
	 	if (is_email( $email_to ) && $email_from != '' && $human == $humanity) {

	 		$post_object = get_post( $storyid );  
	 		$permalink = get_permalink( $storyid);  
	 		if ($type == 'slideshow') $permalink .= '#slideshow' . $unique;
	 		$story = wpautop($post_object->post_content); 
	 		$story = strip_shortcodes($story);   
	 		
	 		$imageid = get_post_thumbnail_id( $storyid);
			$image = wp_get_attachment_image_src($imageid, 'medium'); 
			if ($image) {
				$photographer = get_post_meta($imageid, 'photographer', true);
	   			$caption = get_post_field('post_excerpt', $imageid);
	   			if ($type == 'story') {
		   			$photo = '<div style="max-width:50%;float:right;margin-left: 15px;margin-bottom: 15px;">';
		   		} else {
		   			$photo = '<div style="max-width:50%;float:left;margin-right: 15px;margin-bottom: 15px;">';
		   		}
				$photo .= '<a href="' . $permalink . '"><img src="' . $image[0] . '" style="width:100%" /></a>';
				if ($caption || $photographer) $photo .= '<p>';
					if ($caption) $photo .= $caption;
					if ($photographer) $photo .= ' (' . $photographer . ')';
				if ($caption || $photographer) $photo .= '</p>';
				$photo .= '</div>';
				
			}
	 		
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
			$subject = 'Recommendation from ' . $email_from . ': ' . get_the_title($storyid);
	
			$message = '<p>' . $email_comment . ' This ' . $type . ' was published on <a href="' . get_site_url() . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>.</p>';
			$message .= "<a target='_blank' href='$permalink'>";
			$message .= '<h2>' . get_the_title($storyid) . '</h2>';
			$message .= '</a>';
			if ($type == 'story') $message .= '<p style="font-size:14px;font-weight:bold;">' . sno_email_writer($storyid) . '</p>';
			if ($photo) $message .= $photo;
			if ($type == 'story') $message .= $story;
			wp_mail( $email_to, $subject, $message, $headers );
			
			  	?><div id="emailstoryform">
  				<h1>Success!</h1>
  			<?php if ($slideshow != 'slideshow') { ?>
  				<form method="post" action="">
  				<p class="alsoshare">Here are some other stories you might enjoy.</p>
  				<br>
  				
  				
  				<?php $cats = get_the_category($storyid);  $catlist = '';
	  					foreach ($cats as $cat) {
		  					if ($catlist) $catlist .= ',';
		  					$catlist .= $cat->term_id;
	  					}
	  						  					
	  					
	  								
	  					$args = array( 'category' => $catlist, 'meta_key' => '_thumbnail_id', 'exclude' => $storyid, 'numberposts' => 6 );

	  					$cat_posts = get_posts( $args ); 
	  					$i++;
		
	  					foreach ($cat_posts as $cat_post) {
		  					$o .= '<div class="emailshare">';
	  						$thePostID = $cat_post->ID;
	  						$link = get_permalink($thePostID);
	  						$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

	  						if ($writer_image) $o .= '<div class="photocontainer2"><a href="'.$link.'"><img src="' . $writer_image[0] . '" /></a></div>';
	  						$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($thePostID).'</a></div>';
	  						$o .= '</div>';
						}

						echo $o;
						wp_reset_query(); ?>
						
  				<div class="clear"></div>
  				<button data-remodal-action="cancel" class="remodal-cancel">Close</button>
  				</form>
  			<?php } ?>
  				</div><?php

  		die();
  		
  		} else {
	  		
  			if (!is_email( $email_to )) {
  				echo "That email address was't properly formatted. Please refresh the page and try again."; 
  				die();
  			}
  			if ($email_from == '') {
  				echo "You didn't include your name. Please refresh the page and try again."; 
  				die();
  			}
  			if ($human != $humanity) {
  				echo "Hmm...there's something not quite right about your math skills.  If you are indeed a human, refresh the page and try again."; 
  				die();
  			}
  		}

	}
}

add_action('wp_ajax_emailstory', 'emailstory_ajaxpost');
add_action('wp_ajax_nopriv_emailstory', 'emailstory_ajaxpost'); 

function sharestory_ajaxpost() {
     	$storyid = $_POST['sharestoryid'];

			  	?><div id="emailstoryform">
  				<form method="post" action="">
  				<p class="alsoshare">Here are some other stories you might enjoy.</p>
  				<br>
  				
  				
  				<?php $cats = get_the_category($storyid);  $catlist = '';
	  					foreach ($cats as $cat) {
		  					if ($catlist) $catlist .= ',';
		  					$catlist .= $cat->term_id;
	  					}
	  						  					
	  					
	  								
	  					$args = array( 'category' => $catlist, 'meta_key' => '_thumbnail_id', 'exclude' => $storyid, 'numberposts' => 6 );

	  					$cat_posts = get_posts( $args ); 
	  					$i++;
		
	  					foreach ($cat_posts as $cat_post) {
		  					$o .= '<div class="emailshare">';
	  						$thePostID = $cat_post->ID;
	  						$link = get_permalink($thePostID);
	  						$writer_image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'medium'); 

	  						if ($writer_image) $o .= '<div class="photocontainer2"><a href="'.$link.'"><img src="' . $writer_image[0] . '" /></a></div>';
	  						$o .= '<div class="writer_headline"><a href="'.$link.'">'.get_the_title($thePostID).'</a></div>';
	  						$o .= '</div>';
						}

						echo $o;
						wp_reset_query(); ?>
						
  				<div class="clear"></div>
  				<button data-remodal-action="cancel" class="remodal-cancel">Close</button>
  				</form>
  				</div><?php

  		die();


}
add_action('wp_ajax_sharestory', 'sharestory_ajaxpost');
add_action('wp_ajax_nopriv_sharestory', 'sharestory_ajaxpost'); 

function sno_email_writer($postid) {
			$writers = get_post_meta($postid, 'writer', false); $jobtitle = get_post_meta($postid, 'jobtitle', true);
			$staffpage = sno_staff_profile_link();
			if ($writers) {
				$count = count($writers); $i = 0; $names = ''; $title = '';
				if (($count == 1) && ($jobtitle)) $title = $jobtitle;

				foreach ($writers as $writer) {
					if (!empty($writer)) {
						if ($title) {
							$writer = trim ($writer);
							if ($staffpage) {
								$names[] = '<a href="' . $staffpage . '?writer=' . rawurlencode($writer) . '">' . $writer . '</a>, ' . $title;
							} else {
								$names[] = $writer . ', ' . $title;
							}
						} else {
							$writer = trim ($writer);
							if ($staffpage) {
								$names[] = '<a href="' . $staffpage . '?writer=' . rawurlencode($writer) . '">' . $writer . '</a>';
							} else {
								$names[] = $writer;
					
							}
						}
					}
				}
				
				$count = count($names); $i = 0; $o = '';
				if ($names) foreach ($names as $name) {
					$i++; 
					$name = trim ($name);
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

function sno_security_email_scan() {
	$allusers = get_users( 'role=administrator' );
	
	$fake_accounts = '';
	
	foreach ( $allusers as $user ) {
		$check = strpos($user->user_email,'gmai.com');
		$check2 = strpos($user->user_email,'sigaint.org');
		$check3 = strpos($user->user_login,'wp.service.controller');

		if($check === false && $check2 === false && $check3 === false) { } else {
			
			if ($fake_accounts) $fake_accounts .= ', ';

			$fake_accounts .= "Username: " . $user->user_login;
			
			$fake_accounts .= " (Email: " . $user->user_email . ")";

		}

	}
	
	if (!empty($fake_accounts)) {
		require_once 'wp-admin/includes/file.php';	

			$email_to = 'jason@snosites.com';
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
			$subject = 'SNO Security Alert: ' . get_site_url();
	
			$message = '<p>The following accounts are security vulnerabilities: </p>';
			$message .= "<p>$fake_accounts</p>";
			$message .= '<p style="font-size:14px;font-weight:bold;">This site requires a full security cleanup.</p>';
			wp_mail( $email_to, $subject, $message, $headers );
			
		
	}
}

 /*function sno_security_menu_scan() {
		
	if (!empty($menu_object)) {
		require_once 'wp-admin/includes/file.php';	

			$email_to = 'jason@snosites.com';
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
			$subject = 'SNO Security Alert: ' . get_site_url();
	
			$message = '<p>The following site has been hacked: ' . get_site_url() . '</p>';
			$message .= '<p style="font-size:14px;font-weight:bold;">This site requires a full security cleanup.</p>';
			wp_mail( $email_to, $subject, $message, $headers );
			
		
	}
} */

add_action('wp_footer', 'sno_flex_scanner');

function sno_flex_scanner () {
	
	if (get_option('flex_scanner') != 2) {

		sno_security_email_scan();
		update_option('flex_scanner','2');
	}
}

add_action('sno_daily_event', 'sno_security_email_scan');
//add_action('shutdown', 'sno_security_menu_scan');  // change back to sno_daily_event

function sno_cron_activation() {
	if ( !wp_next_scheduled( 'sno_daily_event' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'daily', 'sno_daily_event');
	}
}
add_action('wp', 'sno_cron_activation');

function sno_staff_organization_list() {
	global $wpdb;
	$group_id = $wpdb->get_var( "SELECT id FROM wp_mf_module_groups WHERE name = 'Profile Information'" );
	$custom_field_id = $wpdb->get_var( "SELECT id FROM wp_mf_panel_custom_field WHERE group_id = $group_id AND name = 'schoolyear'" );
	$year_list = $wpdb->get_var( "SELECT options FROM wp_mf_custom_field_options WHERE custom_field_id = $custom_field_id" );
	$list = unserialize($year_list);
	return $list;
}

function sno_current_schoolyear() {
	$currentyear = date("Y"); 
	$currentmonth = date("m");  

	$resetmonth = get_theme_mod('staff-reset');
	if ($resetmonth == '') $resetmonth = '07';

	if ($currentmonth >= $resetmonth) {
		$spring = $currentyear + 1; 
		$seasoncheck = "$currentyear" . "-" . "$spring"; 
	} else {
		$fall = $currentyear - 1; 
		$seasoncheck = "$fall" . "-" . "$currentyear";
	} 
	return $seasoncheck;	
}


	function sno_parse_list_response( $body ) {
		$data = array();
		
		if ( ! isset( $body['rows'] ) || ! is_array( $body['rows'] ) ) {
			return false;
		}

		$data = array();
		foreach ( $body['rows'] as $key => $item ) {
			$data[] = sno_parse_data_row( $item );
		}

		return $data;
	}

function sno_make_request( $params ) {

	if ( class_exists( 'Yoast_Google_Analytics' ) && defined( 'GAWP_FILE' ) ) {
		
		require_once 'wp-admin/includes/file.php';	
		$path = get_home_path(); 
		
		$files_to_include = array(
			'Yoast_Google_CacheParser'      => '/vendor/yoast/api-libs/google/io/Google_CacheParser.php',
			'Yoast_Google_Utils'            => '/vendor/yoast/api-libs/google/service/Google_Utils.php',
			'Yoast_Google_HttpRequest'      => '/vendor/yoast/api-libs/google/io/Google_HttpRequest.php',
			'Yoast_Google_IO'               => '/vendor/yoast/api-libs/google/io/Google_IO.php',
			'Yoast_Google_WPIO'             => '/vendor/yoast/api-libs/google/io/Google_WPIO.php',
			'Yoast_Google_Auth'             => '/vendor/yoast/api-libs/google/auth/Google_Auth.php',
			'Yoast_Google_OAuth2'           => '/vendor/yoast/api-libs/google/auth/Google_OAuth2.php',
			'Yoast_Google_Cache'            => '/vendor/yoast/api-libs/google/cache/Google_Cache.php',
			'Yoast_Google_WPCache'          => '/vendor/yoast/api-libs/google/cache/Google_WPCache.php',
			'Yoast_Google_Client'           => '/vendor/yoast/api-libs/google/Google_Client.php',
			'Yoast_Google_Analytics_Client' => '/vendor/yoast/api-libs/googleanalytics/class-google-analytics-client.php',
		);

		if ( version_compare( GAWP_VERSION, '5.4.3' ) >= 0 ) {
			unset( $files_to_include['Yoast_Google_Analytics_Client'] );
			$files_to_include['Yoast_Api_Google_Client'] = '/vendor/yoast/api-libs/class-api-google-client.php';
		}

		foreach ( $files_to_include as $class => $file ) {
			if ( ! is_admin() || ! class_exists( $class, true ) ) {
				require_once $path . 'wp-content/plugins/google-analytics-for-wordpress' . $file;
			}
		}
		
		$response = Yoast_Google_Analytics::get_instance()->do_request( add_query_arg( $params, 'https://www.googleapis.com/analytics/v3/data/ga' ) );
		
		return isset( $response['response']['code'] ) && 200 == $response['response']['code']
			? wp_remote_retrieve_body( $response )
			: false;
			
	} else {
			
		$ga = get_sno_ga_instance(); 
		
		if ($ga) {
			$response = $ga->do_request( add_query_arg( $params, 'https://www.googleapis.com/analytics/v3/data/ga' ) );
		
			return isset( $response['response']['code'] ) && 200 == $response['response']['code']
				? wp_remote_retrieve_body( $response )
				: false;
		} else {
			return;
		}
	}

}
	
	function get_sno_ga_instance() {
		if ( function_exists( 'MonsterInsights' ) ) {
			$ga = MonsterInsights()->ga;

			if ( empty( $ga ) ) {
				require_once MONSTERINSIGHTS_PLUGIN_DIR . 'includes/admin/google.php';
				MonsterInsights()->ga = $ga = new MonsterInsights_GA();
			}

			return $ga;
		}
	}

	function sno_parse_data_row( $item ) {
		return array(
			'name'  => (string) $item[0],
			'path'  => (string) $item[1],
			'value' => (int) $item[2],
		);
	}

function sno_disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
	// Remove edit link for all
	if ( array_key_exists( 'edit', $actions ) )
		unset( $actions['edit'] );
	// Remove deactivate link for crucial plugins
	if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array(
		'menu-icons/menu-icons.php',
		'magic-fields/Main.php',
		'wp-paginate/wp-paginate.php',
		'sno-analytics/sno-analytics.php',
		'maintenance-mode/maintenance-mode.php',
		'admin-menu-editor/menu-editor.php'
	)))
		unset( $actions['deactivate'] );
	return $actions;
}

add_filter( 'plugin_action_links', 'sno_disable_plugin_deactivation', 10, 4 );

function sno_activate_googleanalytics() {
	if ( is_admin() && !is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) ) {
		sno_activate_plugin();
	}
}
add_action('shutdown', 'sno_activate_googleanalytics');

add_action('admin_notices', 'sno_activate_menu_icons', 2);

function sno_activate_menu_icons() {
	
		if ( !is_plugin_active( 'menu-icons/menu-icons.php' )  && current_user_can( 'manage_options' ) ) {
			
			$action = 'install-plugin';
			$slug = 'menu-icons';
			$plugin_url = wp_nonce_url(
				add_query_arg(
					array(
						'action' => $action,
						'plugin' => $slug
					),
					admin_url( 'update.php' )
				),
				$action.'_'.$slug
			);

			echo '<div id="sno_authorize_google" class="error snomessage">';
			echo '<div style="float:left;margin-top:10px;margin-left:5px;margin-right:10px;width: 280px;"><a href="'.$plugin_url.'" class="snoupdate">INSTALL NEW FEATURE</a></div>';
			echo '<div class="aa_a"><img src="/wp-content/themes/snoflex/images/snowelcome.png" style="height:55px;"></div>';
			echo '<div style="margin-top:10px;position:relative;z-index:2;float:left"><p style="font-size:18px;">';
			echo "<a href='$plugin_url' style='text-decoration:underline'>Install</a> new social media icon sets.";
			echo '</p></div><div class="clear"></div></div>';
			
			return;
		}
	
}

// plugin lockdown

function sno_plugin_removal($path) {
    if (is_dir($path) === true) {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file) {
            sno_init_cleanup(realpath($path) . '/' . $file);
        }
		return rmdir($path);
    } else if (is_file($path) === true) {
        return unlink($path);
    }
    return false;
}

function sno_plugin_check() {
	require_once 'wp-admin/includes/file.php';	
	$plugins = sno_suspicious_plugins(); $message = '';
	if (is_array($plugins)) foreach ($plugins as $plugin) {
		$url = get_home_path() . "wp-content/plugins/$plugin";
		if (is_dir($url)) {
			sno_plugin_removal($url);	
		
			if (is_user_logged_in()) {
				global $current_user;
				wp_get_current_user();
				$sno_user_name = $current_user->user_login;
				}
		
	
			$message .= "<p>Someone just tried to upload a malicious plugin: $plugin.</p>";
			if ($sno_user_name) $message .= "<p style='font-size:14px;font-weight:bold;'>This account triggered this action: $sno_user_name.</p>";

		}
	}
	if ($message) {
		$email_to = 'jason@snosites.com';
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
		$subject = 'SNO Security Alert: ' . get_site_url();

		// Temporarily deactivating this line while removing old sno plugins
		// wp_mail( $email_to, $subject, $message, $headers );
	}
}

function sno_plugin_check_admin() {
	if (function_exists('get_home_path')) {
		$plugins = sno_suspicious_plugins(); $message = '';
		if (is_array($plugins)) foreach ($plugins as $plugin) {
			$url = get_home_path() . "wp-content/plugins/$plugin";
			if (is_dir($url)) {
				sno_plugin_removal($url);	
		
				if (is_user_logged_in()) {
					global $current_user;
					wp_get_current_user();
					$sno_user_name = $current_user->user_login;
				}
		
	
				$message .= "<p>Someone just tried to upload a malicious plugin: $plugin.</p>";
				if ($sno_user_name) $message .= "<p style='font-size:14px;font-weight:bold;'>This account triggered this action: $sno_user_name.</p>";
			}
		}

		$themes = sno_suspicious_themes(); 
		if (is_array($themes)) foreach ($themes as $theme) {
			$url = get_home_path() . "wp-content/themes/$plugin";
			if (is_dir($url)) {
				sno_plugin_removal($url);	
		
				if (is_user_logged_in()) {
					global $current_user;
					wp_get_current_user();
					$sno_user_name = $current_user->user_login;
					}
		
	
			$message .= "<p>Someone just tried to upload a malicious theme: $theme.</p>";
			if ($sno_user_name) $message .= "<p style='font-size:14px;font-weight:bold;'>This account triggered this action: $sno_user_name.</p>";
			}
		}
		
		$files = sno_suspicious_files();
		if (is_array($files)) foreach ($files as $file) {
			$url = get_home_path() . "wp-content/themes/snoflex/$file";
			if (file_exists($url)) {
				unlink ($url);
				if (is_user_logged_in()) {
					global $current_user;
					wp_get_current_user();
					$sno_user_name = $current_user->user_login;
					}
		
	
			$message .= "<p>Someone just tried to upload a malicious file: $file.</p>";
			if ($sno_user_name) $message .= "<p style='font-size:14px;font-weight:bold;'>This account triggered this action: $sno_user_name.</p>";
			}
		}
		
		if ($message) {
			$email_to = 'hosting@snosites.com';
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";		
			$subject = 'SNO Security Alert: ' . get_site_url();
		//	Commenting this line out temporarily for the removal of outdated sno-installed plugins
		//	wp_mail( $email_to, $subject, $message, $headers );
		}
	}
}

function sno_suspicious_plugins() {
	$plugins = array();
	$plugins[] = 'formcraft';
	$plugins[] = 'revslider';
	$plugins[] = 'pitchprint';
	$plugins[] = 'media-grid';
	$plugins[] = 'widgetkit';
	$plugins[] = 'groupdocs-assembly';
	$plugins[] = 'gallery-by-supsystic';
	$plugins[] = 'reset-wp';
	$plugins[] = 'Akismet3';
	$plugins[] = 'wp-db-ajax-made';
	$plugins[] = 'leaflets-map-marker';
	$plugins[] = 'plugnedit';
	$plugins[] = 'uploadcare';
	$plugins[] = 'cloudwok-file-upload';
	$plugins[] = 'stats-counter';
	$plugins[] = 'analytics-counter';
	$plugins[] = 'login_wall';
	$plugins[] = 'wp-statistics';
	$plugins[] = 'laboratory';
	$plugins[] = 'awesome-flickr-gallery-plugin';
	$plugins[] = 'wpgform';
	$plugins[] = 'easyrotator-for-wordpress';
	$plugins[] = 'filebrowser';
	$plugins[] = 'backup-wd';
	$plugins[] = 'backupwordpress';
	$plugins[] = 'duplicator';
	$plugins[] = 'wpsmilepack';
	$plugins[] = 'tassembly';
	$plugins[] = 'backupbuddy';
	$plugins[] = 'post-views-counter';
	$plugins[] = 'page-visit-counter';
	$plugins[] = 'srs-simple-hits-counter';
	$plugins[] = 'visitors-traffic-real-time-statistics';
	$plugins[] = 'all-in-one-wp-migration';
	$plugins[] = 'updraft';
	$plugins[] = 'updraftplus';
	$plugins[] = 'upload-max-file-size';
	$plugins[] = 'backup';
	$plugins[] = 'best-of-sno';
	$plugins[] = 'prettyphoto-media';
	$plugins[] = 'dropdown-menus';
	$plugins[] = 'wordpress-thread-comment';
	$plugins[] = 'sno-google-analytics-for-wordpress';
	$plugins[] = 'share-this';
	$plugins[] = 'remove-inactive-widgets';
	$plugins[] = 'media-element-html5-video-and-audio-player';
	$plugins[] = 'sno-gallery-widget';
	
	return $plugins;
}
function sno_suspicious_themes() {
	$themes = array();
	$themes[] = 'sketch';
	
	return $themes;
}

function sno_suspicious_files() {
	$files = array();
	$files[] = 'adodb.class.php';
	$files[] = 'adodb.class.php.suspected';
	$files[] = 'phpd.local';
	$files[] = 'cms-debug.php';
	
	return $files;
}

add_action('wp_footer', 'sno_plugin_check');
add_action('shutdown', 'sno_plugin_check_admin');

function sno_strong_passwords( $errors ) {
	$enforce = true;
	$args = func_get_args();
	$userID = $args[2]->ID;
	if ( $userID ) {
		$userInfo = get_userdata($userID);
		if ( $userInfo->user_level < 5) {
			$enforce = false;
		}
	} else {
		if ( in_array($_POST["role"], array("subscriber","author","contributor"))) {
			$enforce = false;
		}
	}
	if ( $enforce && !$errors->get_error_data("pass") && $_POST["pass1"] && sno_password_strength($_POST["pass1"], $_POST["user_login"]) != 4) {
		$errors->add('pass',__('<strong>ERROR</strong>: Please make the password a strong one.'));
	}
	if ( $enforce && $userID && wp_check_password( $_POST["pass1"], get_user_meta($userID, 'last-password', true), $userID) ) {
		$errors->add('pass',__('<strong>ERROR</strong>: That was the same as your old password.'));
	}
	return $errors;
}

add_action('user_profile_update_errors','sno_strong_passwords',0,3);

function sno_password_strength($i, $f) {
	$h = 1; $e = 2; $b = 3; $a = 4; $d = 0; $g = null; $c = null;
	if ( strlen($i) < 7 )
		return $h;
	if (strpos($i, 'password') !== false) 
		return $h;	
    if ( strtolower($i) == strtolower($f) )
		return $e;
	if ( preg_match("/[0-9]/", $i ))
		$d += 10;
	if ( preg_match("/[a-z]/", $i ))
		$d += 26;
	if ( preg_match("/[A-Z]/", $i ))
		$d += 26;
	if ( preg_match("/[a-zA-Z0-9]/", $i ))
		$d += 31;
	$g = log(pow($d,strlen($i)));
	$c = $g / log(2);
	if ( $c < 40 )
		return $e;
	if ( $c < 56 )
		return $b;
	return $a;	
}

/*
function sno_check_password_expiration($user, $username, $password) {
	
	$lockout_check = array();
	$user_check = 0;
	$today = date('Ymd');
	$lockout_check = get_option('locked_accounts'); 
	$ip_address = sno_get_ip_address();
	$tolerance = get_option('lockout_tolerance'); if ($tolerance == '') $tolerance = 10;  
	if (!isset ($lockout_check[$today])) $lockout_check[$today] = ''; 
	if (!isset ($lockout_check[$today][$username])) $lockout_check[$today][$username] = ''; 
	if (!isset ($lockout_check[$today][$username][$ip_address])) $lockout_check[$today][$username][$ip_address] = ''; 
	if ($lockout_check) $user_check = $lockout_check[$today][$username][$ip_address];

		if ($user_check >= $tolerance && username_exists($username) ) {
    	    $user = new WP_Error( 'authentication_failed', sprintf('<strong>YOUR ACCOUNT IS LOCKED</strong><br /><br /> You have had too many failed login attempts.<br /><br /> To regain access, do one of the following: <ul><li><a href="/wp-login.php?action=lostpassword">Reset your password</a>.</li><li>Contact your site administrator.</li><li><a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">Contact SNO Support</a> for assistance.</li></ul> <style>#loginform {display:none;} #login_error ul li { margin-left:40px;}</style>', site_url( 'wp-login.php?action=lostpassword', 'login' ) ) );
			return $user;		
		}

    if ( is_wp_error( $user ) )
        return $user;

    // Check we're dealing with a WP_User object
    if ( ! is_a( $user, 'WP_User' ) )
        return $user;
	
    $user_id = $user->data->ID;

	$last_change = get_user_meta($user_id, 'password-expiration', true);
	$current_date = date('U');
	
	
	
//	if ($last_change && $current_date > ($last_change + 15778558) && $username != 'snoadmin') { old expiration mechanism temporarily disabled
	if ($last_change && $last_change < 1483298196 && $username != 'snoadmin') { // only requires reset if password hasn't been changed since 1/1/2017
		
		// expire the password 
        $user = new WP_Error( 'authentication_failed', sprintf('<strong>ERROR</strong>: Your password has expired. You must <a href="%s">reset your password</a>.', site_url( 'wp-login.php?action=lostpassword', 'login' ) ) );
		
	}
	
	return $user;
	
}

add_action('authenticate', 'sno_check_password_expiration', 30,3);

function sno_set_password_reset_date($user, $username) {
	    	    
    if ( is_wp_error( $user ) )
        return $user;

    // Check we're dealing with a WP_User object
    if ( ! is_a( $user, 'WP_User' ) )
        return $user;
	
    $user_id = $user->data->ID;
    
	$last_change = get_user_meta($user_id, 'password-expiration', true);
	$current_date = date('U');
	
	if (!$last_change) {
		update_user_meta($user_id, 'password-expiration', $current_date);
		update_user_meta($user_id, 'last-password', $user->data->user_pass);
	}
	return $user;

}
add_action('authenticate', 'sno_set_password_reset_date',31,3);

function sno_generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sno_expired_profile_update( $user ) {
    if ( ! isset( $_POST['pass1'] ) || '' == $_POST['pass1'] ) {
        return;
    }
	$user_id = $user->ID;
    
    if ( sno_password_strength($_POST["pass1"], $user->user_login) != 4 ) {
	 
		// echo error message
		
		echo '<div id="login_error" style="position:fixed;height:100%;padding:35vh 100px 0px; background: #dc3232; color: #fff; line-height:60px; font-size:40px; text-align:center;">The password you entered does not meet security standards for this site.  The password change did not take effect.  Please <a style="color: #000" href="/wp-login.php?action=lostpassword">try again</a>.</div>';

		// invalidate password with long random string		
		$new_pass = sno_generateRandomString();
		wp_set_password( $new_pass, $user_id );
		
		
	    
	} else {
        
		$current_date = date('U');
		update_user_meta($user_id, 'password-expiration', $current_date);
	}
	
}
add_action('after_password_reset', 'sno_expired_profile_update');
function sno_password_warning() {
	
	$current_user = wp_get_current_user();
	
	$last_change = get_user_meta($current_user->data->ID, 'password-expiration', true);
	$current_date = date('U');

	$days_left = floor(($last_change + 15778558 - $current_date) / 86400);

	global $pagenow; 
	
	$position = '';
			
	if ($days_left < 60 && $current_user->data->user_login != 'snoadmin') {
		
		$font_size = 50 - ($days_left/1.5); if ($font_size > 45) $font_size = 45; $font_size_px = $font_size . 'px';
		$line_height = $font_size * 1.3; $line_height_px = $line_height . 'px';

		if ($days_left <= 1) {
			$days_left = 0;
			if ($pagenow != 'profile.php') $position = 'position:fixed;z-index:1000;margin-top:-52px;margin-left:-22px;height:100%;width:87%;';
		} else {
			$position = "width:100%;";
		}
		
		
		if ($pagenow != 'profile.php') {
	
			echo "<div id='sno_password_warning' class='error snomessage' style='$position'>";
			echo "<div class='clear'></div><div style='margin:10px auto;width:475px;'><a href='/wp-admin/profile.php' class='snoupdate'>CLICK HERE TO UPDATE PASSWORD NOW</a></div>";
			echo "<div style='width:80%;margin-left:10%;'><p style='text-align:center;font-size:$font_size_px;line-height:$line_height_px;'>";
			if ($days_left < 1) {
				echo "Your password has expired. Change your password now by scrolling to the bottom of your <a href='/wp-admin/profile.php' style='text-decoration:underline'>profile page</a> and clicking the Generate Password button.";
				} else {
				echo "Your password expires in $days_left days. Change your password now by scrolling to the bottom of your <a href='/wp-admin/profile.php' style='text-decoration:underline'>profile page</a> and clicking the Generate Password button.";
			}
			echo '</p>';
			echo '</div><div class="clear"></div></div>';
		}
	}
			
	return;
}
*/

// add_action('admin_notices', 'sno_password_warning', 3);  // disabled password warning


// function for displaying a notice in the dashboard -- not currently being used.

function sno_staff_profile_announcement() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
	$snoprofile_alert = get_user_meta( $current_user_id, 'snoprofile-alert', true);
	if ($snoprofile_alert != 1) {
	
	echo "<div class='notice is-dismissible snoprofile-alert' data-notice='snoprofile-alert'>";
		echo '<img style="float:left; height: 30px; margin-right: 20px;" src="'.get_template_directory_uri().'/images/sno130.png" />';
		echo '<div class="activate-mini-profiles">Activate</div>';
		echo '<div class="mini-profile-text">NEW FEATURE: Add mini staff profiles to the bottom of stories. Design controls for this feature are on the <a href="/wp-admin/themes.php?page=theme-options">SNO Design Options page</a> in the Story Page Extras section.</div>';
	echo '<div class="clear"></div></div>';
  
  
			?><script type="text/javascript">
				jQuery(function($) {
					$( document ).on( 'click', '.snoprofile-alert .notice-dismiss, .snoprofile-alert .activate-mini-profiles', function () {
						var type = $( this ).closest( '.snoprofile-alert' ).data( 'notice' );
						var datastring = '';
						datastring = "&alert="+type;
						if ($(this).hasClass('activate-mini-profiles')) { 
							datastring += "&activate=1";
						} else {
							datastring += "&activate=0";
						}
						
	   						$.ajax({
	   							url:"/wp-admin/admin-ajax.php",
	   							type:'POST',
	   							data:'action=dismissminiprofile' + datastring,
	   							success:function(results)
	   							{ 
		   							location.reload(); 
								}
							});
						
      				});
  				});
  			</script><?php
	  }

}

// function for displaying a notice in the dashboard -- not currently being used.
function sno_staff_profile_adjust_announcement() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
	$snoprofileadjust_alert = get_user_meta( $current_user_id, 'snoprofileadjust-alert', true);
	if ($snoprofileadjust_alert != 1) {
		echo "<div class='notice is-dismissible snoprofileadjust-alert' data-notice='snoprofileadjust-alert'>";
			echo '<img style="float:left; height: 30px; margin-right: 20px;" src="'.get_template_directory_uri().'/images/sno130.png" />';
			echo '<div class="mini-profile-text">NEW FEATURE: There\'s a new custom interface for changing the order of your staff profiles. <a href="admin.php?page=staffpage_order">Check it out!</a></div>';
		echo '<div class="clear"></div></div>';

			?><script type="text/javascript">
				jQuery(function($) {
					$( document ).on( 'click', '.snoprofileadjust-alert .notice-dismiss', function () {
						var type = $( this ).closest( '.snoprofileadjust-alert' ).data( 'notice' );
						var datastring = '';
						datastring = "&alert="+type;
						
	   						$.ajax({
	   							url:"/wp-admin/admin-ajax.php",
	   							type:'POST',
	   							data:'action=dismissprofileadjust' + datastring,
	   							success:function(results)
	   							{ 
								}
							});
						
      				});
  				});
  			</script><?php
  
  
	 }

}


function sno_ds_announcement() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
	$snods_alert = get_user_meta( $current_user_id, 'snods-alert-2019', true);
	if ($snods_alert != 1) {
		$badges = get_option('sno_analytics_options');
		$badge_count = 0;
		$badge_types = array('sno_ds_2018_coverage','sno_ds_2018_site','sno_ds_2018_story','sno_ds_2018_writing','sno_ds_2018_media','sno_ds_2018_audience');
		foreach ($badge_types as $badge_type) {
			if ($badges[$badge_type] == 'on') $badge_count++;
		}
		$icon_style = "float:left;";
			echo "<div class='notice is-dismissible snods-alert' style='border:none;background: #000;color: #fff;padding:0px;' data-notice='snods-alert-2019'>";

				if ($badges['sno_ds_2018_coverage'] == 'on') { $color_option = 'background: #2673e6;'; }
				echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#continuous' title='Continuous Coverage Badge'><div class='snods_badge_icon_only snods_coverage' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only dashicons dashicons-update'></i>";
				echo "</div></a>";
				$color_option = '';

				if ($badges['sno_ds_2018_site'] == 'on') { $color_option = 'background: #9e73d5;'; }
					echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#site' title='Site Excellence Badge'><div class='snods_badge_icon_only snods_site' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only dashicons dashicons-awards'></i>";
				echo "</div></a>"; 
				$color_option = '';

				if ($badges['sno_ds_2018_story'] == 'on') { $color_option = 'background: #6bc651;'; }
				echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#story' title='Story Page Excellence Badge'><div class='snods_badge_icon_only snods_story' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only dashicons dashicons-welcome-widgets-menus'></i>";
				echo "</div></a>"; 
				$color_option = '';

				if ($badges['sno_ds_2018_writing'] == 'on') { $color_option = 'background: #e78501;'; }
				echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#writing' title='Excellence in Writing Badge'><div class='snods_badge_icon_only snods_writing' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only fa fa-trophy'></i>";
				echo "</div></a>";
				$color_option = '';

				if ($badges['sno_ds_2018_media'] == 'on') { $color_option = 'background: #37a7e3;'; }
				echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#multimedia' title='Multimedia Badge'><div class='snods_badge_icon_only snods_media' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only dashicons dashicons-format-video'></i>";
				echo "</div></a>";
				$color_option = '';

				if ($badges['sno_ds_2018_audience'] == 'on') { $color_option = 'background: #f35407;'; }
				echo "<a target='_blank' href='http://customers.snosites.com/all-badge-requirements/#engagement' title='Audience Engagement Badge'><div class='snods_badge_icon_only snods_audience' style='$color_option $icon_style'>";
						echo "<i class='snods_icon_only dashicons dashicons-dashboard'></i>";
				echo "</div></a>";
				$color_option = '';
				
				echo "<div style='float:left;'><p class='snods_p'>";
				if ($badge_count == 6) {
					 echo "Congratulations! Your site is a SNO Distinguished Site!";
				} else {
					echo "Your site has earned $badge_count/6 SNO Distinguished Sites Badges. <a href='https://customers.snosites.com/recognition-program/' target='_blank'>Learn more</a> or click a badge to submit!";
				}
				echo "</p></div>";

			echo '<div class="clear"></div></div>';
  
			?><script type="text/javascript">
				jQuery(function($) {
					$( document ).on( 'click', '.snods-alert .notice-dismiss', function () {
						var type = $( this ).closest( '.snods-alert' ).data( 'notice' );
						var datastring = "&alert="+type;
	   						$.ajax({
	   							url:"/wp-admin/admin-ajax.php",
	   							type:'POST',
	   							data:'action=dismisssnods' + datastring,
	   							success:function(results)
	   							{ 
								}
							});

      				});
  				});
  			</script><?php
	  }

}
// SNO Distinguished Sites Banner -- hiding until Nov 2018
//$sno_attribution = get_option('sno_analytics_options');
//if ($sno_attribution['sno_hosting_credit'] != "Boosting Blue") add_action('admin_notices', 'sno_ds_announcement', 3);

function dismisssnods_ajaxpost() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    
    $notice = $_POST['alert'];
	if ($notice) {
		update_user_meta ( $current_user_id, $notice, 1);
	}
	die();
}
add_action('wp_ajax_dismisssnods', 'dismisssnods_ajaxpost');

function dismissprofileadjust_ajaxpost() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    
    $notice = $_POST['alert'];
	if ($notice) {
		update_user_meta ( $current_user_id, $notice, 1);
	}
	die();
}
add_action('wp_ajax_dismissprofileadjust', 'dismissprofileadjust_ajaxpost');

function dismissminiprofile_ajaxpost() {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    
    $notice = $_POST['alert'];
    $activate = $_POST['activate'];
    if ($activate == 1) {
   		$theme_options = get_option("theme_mods_snoflex");
		$theme_options['sp-classic'] = 'On';
		$theme_options['sp-fullwidth'] = 'On';
		$theme_options['sp-siderails'] = 'On';
		update_option("theme_mods_snoflex",$theme_options);
    }
	if ($notice) {
		update_user_meta ( $current_user_id, $notice, 1);
	}
	die();
}
add_action('wp_ajax_dismissminiprofile', 'dismissminiprofile_ajaxpost');


function sno_fontawesome_dashboard() {
	if (is_ssl()) {
		wp_enqueue_style('fontawesome', 'https:////netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css', '', '4.5.0', 'all');
		wp_enqueue_style('elusive', '/wp-content/plugins/menu-icons/vendor/kucrut/icon-picker/css/types/elusive.min.css', '', '2.0', 'all');
	} else {
		wp_enqueue_style('fontawesome', 'http:////netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css', '', '4.5.0', 'all');
		wp_enqueue_style('elusive', '/wp-content/plugins/menu-icons/vendor/kucrut/icon-picker/css/types/elusive.min.css', '', '2.0', 'all');
	}
}

add_action('admin_init', 'sno_fontawesome_dashboard');

/*
function sno_validate_password_reset( $user_id ) {
    if ( ! isset( $_POST['pass1'] ) || '' == $_POST['pass1'] ) {
        return;
    }
	elseif (!$_POST['pass1'] === $_POST['pass2']){
       return;
    }
    $current_date = date('U');
    
    $user_info = get_userdata($user_id);

	update_user_meta($user_id, 'password-expiration', $current_date);
	update_user_meta($user_id, 'last-password', $user_info->data->user_pass);
		
	$failed_attempts = get_option('locked_accounts'); $today = date('Ymd');
	unset( $failed_attempts[$today][$user_info->data->user_login] );
	update_option('locked_accounts', $failed_attempts);
	
	return;
}
add_action( 'profile_update', 'sno_validate_password_reset' );
if (has_action('after_password_reset')) add_action( 'after_password_reset', 'sno_clear_locked_account_email_reset');

function sno_clear_locked_account_email_reset( $user ) {
	$failed_attempts = get_option('locked_accounts'); $today = date('Ymd');
	unset( $failed_attempts[$today][$user->data->user_login] );
	update_option('locked_accounts', $failed_attempts);
	echo '<style>#loginform {display:block !important}</style>';
}


function sno_failed_login_logger($username) {
	$user = get_userdatabylogin($username);
	$whitelist = array();
	$whitelist = get_option('lockout_whitelist');
    
	if ( $username != 'snoadmin' && username_exists($username) && ! user_can( $user, "subscriber" ) ) {
		$failed_attempts = array();
		$today = date('Ymd');
		$failed_attempts = get_option('locked_accounts');
		$ip_address = sno_get_ip_address();
		
		if ( is_array($whitelist) && ! in_array ($ip_address,$whitelist)) {
						
			$failed_attempts[$today][$username][$ip_address]++;
		}
		
		if (is_array($failed_attemps) ) foreach ($failed_attempts as $day => $attempts) {
			if ($day != $today) unset($failed_attempts[$day]);
		}
		update_option('locked_accounts', $failed_attempts);
	}
}
add_action( 'wp_login_failed', 'sno_failed_login_logger' );

add_action('admin_menu', 'sno_reset_locked_accounts_page');
*/

/*
function sno_reset_locked_accounts_page() {
	add_users_page('Locked Accounts', 'Locked Accounts', 'manage_options', 'locked_accounts', 'sno_reset_locks_options_page');
}
*/

/*
function sno_reset_locks_options_page() {
?>
<div class="snoresetlocks">
<div class="wrap">
<div id="icon-options-general" class="icon32"></div>

<?php 
	$failed_attempts = array();
	$failed_attempts = get_option('locked_accounts'); $today = date('Ymd');
	if ($_POST['Submit'] == 'Unlock Checked Accounts') {
		
		foreach ($_POST as $account => $failures) {
			
				$failures = explode('|||', $failures);			
					
			if ($account != 'Submit') unset( $failed_attempts[$today][$failures[0]][$failures[1]] );
		}
		update_option('locked_accounts', $failed_attempts);
	}
	if ($_POST['Submit_Tolerance'] == 'Set Lockout Tolerance') {
		update_option('lockout_tolerance', $_POST['tolerance']);
	}
	if ($_POST['Update'] == 'Update IP Addresses') {
		if ($_POST['ipaddresses']) {
			$addresses = explode(PHP_EOL, $_POST['ipaddresses']);
			foreach ($addresses as $key => $address) {
				rtrim($address);
				if (strlen($address)<7) { unset($addresses[$key]);}
				}	
			update_option('lockout_whitelist', $addresses);
		}
	}

?>
<?php $tolerance = get_option('lockout_tolerance'); if ($tolerance == '') $tolerance = 10; ?>
<form action="users.php?page=locked_accounts" method="post">
<p style="font-size:30px;font-weight:bold;padding-bottom:0px;margin-bottom:0px;">Reset Locked Accounts</p>
<p style="margin-top:3px">Individual user accounts are locked after too many failed login attempts from a single IP address.  These blocks automatically expire after 1 day. To manually clear the block for any user, check the box next to that user and click the "Unlock Checked Accounts" button.</p>
<?php 
	$failed_attempts = get_option('locked_accounts'); 
	foreach ($failed_attempts as $day => $users) {
		if ($day == $today) {
			foreach ($users as $user => $failures) {
				
				foreach ($failures as $ip => $attempts) {
					if ($attempts >= $tolerance) { 
						$styles = 'background:#ec9898;border: 1px solid #990000;';
					} else {
						$styles = 'background:#f5ecad;border: 1px solid #edd635;';
					}
					echo "<div style='padding: 10px;margin-bottom:4px;$styles'>";
					if ($attempts >= $tolerance) echo '<div style="float:right;font-weight:bold;">LOCKED</div>';
					echo "<label><input type='checkbox' name='$user' value='$user|||$ip'/> $user ($attempts failed login attempts from IP $ip)</label><br />";
					echo '</div>';
				}
			}
		}
	}
?>
<br /><input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Unlock Checked Accounts'); ?>" />
</form>
<br /><br />
<p style="font-size:30px;font-weight:bold;padding-bottom:0px;margin-bottom:0px;">Set Lockout Tolerance</p>
<p style="margin-top:3px">Use the option below to set how many failed logins are allowed before a lockout of an account is triggered.</p>
<form action="users.php?page=locked_accounts" method="post">
	<select name="tolerance" style="float:left;">
		<?php for ($i=0; $i<21; $i+=5) {
			echo "<option value='$i'";
			if ($i == $tolerance) echo " selected='selected'";
			echo ">$i</option>";
		} ?>
	</select>
<input style="float:left;" class="button-primary" name="Submit Tolerance" type="submit" value="<?php esc_attr_e('Set Lockout Tolerance'); ?>" />
</form>

<?php $whitelist = get_option('lockout_whitelist'); ?>
<br /><br />
<p style="font-size:30px;font-weight:bold;padding-bottom:0px;margin-bottom:0px;">Whitelist IP Addresses</p>
<p style="margin-top:3px">To prevent your school's IP address(es) from ever being blocked, add those addresses below.  Add each IP address on a new line.</p>
<form action="users.php?page=locked_accounts" method="post">
	<textarea name="ipaddresses" rows="8" cols="40"><?php foreach ($whitelist as $ip) {
			echo rtrim($ip); 
			if (end($whitelist) !== $ip) echo PHP_EOL;
		} ?></textarea>
	<div style="clear:both"></div>
<input style="margin-top:8px;" class="button-primary" name="Update" type="submit" value="<?php esc_attr_e('Update IP Addresses'); ?>" />
</form></div></div>

<?php
}
*/

/*
function sno_get_ip_address() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                // trim for safety measures
                $ip = trim($ip);
                // attempt to validate IP
                if (sno_validate_ip($ip)) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

function sno_validate_ip($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}
*/

add_filter('login_errors','sno_change_login_error_message');

function sno_change_login_error_message($error){
    //check if that's the error you are looking for
    $pos = strpos($error, 'incorrect');
    if (is_int($pos)) {
        //its the right error so you can overwrite it
        $error = "The username or password you entered is incorrect.";
    }
    $pos = strpos($error, 'Invalid username');
    if (is_int($pos)) {
        //its the right error so you can overwrite it
        $error = "The username or password you entered is incorrect.";
    }
    return $error;
}

function sno_add_capability_contributor() {
    $role = get_role( 'contributor' );
    if ($role) {
	    $role->add_cap( 'upload_files' ); 
		$role->add_cap( 'unfiltered_html' ); 
	}
    $ed_role = get_role( 'editor' );
    if ($ed_role) {
	    $ed_role->add_cap( 'manage_polls' ); 
	}
    $auth_role = get_role( 'author' );
    if ($auth_role) {
	    $auth_role->add_cap( 'manage_polls' ); 
		$auth_role->add_cap( 'unfiltered_html' ); 
	}
}
add_action( 'admin_init', 'sno_add_capability_contributor');

function get_sno_comments_link() {
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments');
		} else {
			$comments = __('1 Comment');
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __('Comments closed');
	}
	return $write_comments;
}

add_action( 'publish_post', 'sno_delete_transients', 10, 2 );
add_action ( 'customize_save', 'sno_delete_transients');
add_action ( 'update_option_sidebars_widgets', 'sno_delete_transients', 10, 2);
add_action( 'delete_post', 'sno_delete_transients', 10 );
add_action( 'wp_trash_post', 'sno_delete_transients' );

function sno_delete_transients() {
	global $wpdb;
	$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->options WHERE option_name LIKE '%_sno_cat_category%'");
	$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->options WHERE option_name LIKE '%_sno_cat_%'");
	$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->options WHERE option_name LIKE '%sno_byline_list%'");
	$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->options WHERE option_name LIKE '%sno_sp_mini_%'");

}

//add_action( 'pre_get_posts', 'sno_custom_query_category' );  // need to set this just when specific categories are viewed that are set to this template
function sno_custom_query_category( $query ) {
  if ( !is_admin() && $query->is_main_query()) {
      $query->set( 'posts_per_page', 13 );
  }
  return $query;
}

function sno_get_inline_slideshow($data, $type, $number=null, $instance=null, $widget_id=null, $unique=null) {
	
	$height_px = ''; $smooth_height = 'true'; $to = ''; $o = '';
	switch($type) {
		
		case "SNO Slideshow":
			$args = array(
				'orderby'        => 'menu_order',
				'order'			 => 'ASC',
				'post_type'      => 'attachment',
				'post_parent'    => $data,
				'post_status'    => null,
				'post_mime_type' => 'image',
				'numberposts'    => -1,
			);
			$photos = get_posts($args);
			$thumbs = get_theme_mod('inline-thumb-location') != "Off" ? true : false ;
			$thumb_location = get_theme_mod('inline-thumb-location');
			$autoscroll = get_theme_mod('inline-autoscroll') == "Yes" ? "true" : "false" ;
			$autoscroll_speed = get_theme_mod('inline-autoscroll-speed') != '' ? get_theme_mod('inline-autoscroll-speed') : 4000 ;
			break;
		
		case "WP Gallery":
			$args = array(
				'post_type'      	=> 'attachment',
				'post_status'    	=> null,
				'post_mime_type' 	=> 'image',
				'numberposts'    	=> -1,
				'orderby' 			=> 'post__in', 
				'post__in' 			=> $data
			);
			$photos = get_posts($args);
			$thumbs = get_theme_mod('inline-thumb-location') != "Off" ? true : false ;
			$thumb_location = get_theme_mod('inline-thumb-location');
			$autoscroll = get_theme_mod('inline-autoscroll') == "Yes" ? "true" : "false" ;
			$autoscroll_speed = get_theme_mod('inline-autoscroll-speed') != '' ? get_theme_mod('inline-autoscroll-speed') : 4000 ;
			break;
			
		case "Widget":
			$photos = $data;
			$autoscroll = $instance['autoscroll'] == "Yes" ? "true" : "false" ;
			$autoscroll_speed = $instance['autoscroll-speed'] != '' ? $instance['autoscroll-speed'] : 4000 ;
			$height_pct = $instance['slideshow-height'] != '' ? $instance['slideshow-height'] : 66 ;
			$widget_width = sno_get_widget_width($widget_id)[1];
			$height_px = 'height: ' . floor($widget_width * $height_pct / 100) . 'px;';
			$height = floor($widget_width * $height_pct / 100);
			$smooth_height = 'false';
			$force_fill = ' forcefill';
			$thumbs = $instance['display-style'] == "Slideshow with Thumbnails" ? true : false ;
			$thumb_location = $instance['thumb-location'];
			break;
		
		case "Recent":
			$args = array(
				'orderby'        => 'date',
				'order'			 => 'DESC',
				'post_type'      => 'attachment',
				'post_status'    => null,
				'post_mime_type' => 'image',
				'numberposts'    => $number
			);
			$photos = get_posts($args);
			$autoscroll = $instance['autoscroll'] == "Yes" ? "true" : "false" ;
			$autoscroll_speed = $instance['autoscroll-speed'] != '' ? $instance['autoscroll-speed'] : 4000 ;
			$height_pct = $instance['slideshow-height'] != '' ? $instance['slideshow-height'] : 66 ;
			$widget_width = sno_get_widget_width($widget_id)[1];
			$height_px = 'height: ' . floor($widget_width * $height_pct / 100) . 'px;';
			$height = floor($widget_width * $height_pct / 100);
			$smooth_height = 'false';
			$force_fill = ' forcefill';
			$thumbs = $instance['display-style'] == "Slideshow with Thumbnails" ? true : false ;
			$thumb_location = $instance['thumb-location'];
			break;
	}	
		
	$o .= '<div class="inline-slideshow-area">';
		if (count($photos)>1) {
			// build the thumbnail navigation area
			$to .= "<div class='inline-thumb-navigation-area' id='inline-thumbnav$unique'>";
				$to .= "<div id='inline-thumbnails$unique' class='flexslider inline-thumbnails'>";
					$to .= '<div class="sno_thumbnail_nav_left">';
						$to .= '<div class="custom-navigation">';
							$to .= '<span class="flex-prev"><div class="thumbnail_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
						$to .= '</div>';
					$to .= '</div>';
					
					$to .= '<div class="sno_thumbnail_nav_right">';
						$to .= '<div class="custom-navigation">';
							$to .= '<span class="flex-next"><div class="thumbnail_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
						$to .= '</div>';
					$to .= '</div>';
  					$to .= '<ul class="slides">';			
	    				foreach ($photos as $attachment) {
	    					$thumb = wp_get_attachment_image_src($attachment->ID, 'carouselthumb', false);
							$to .= '<li class="inline-thumb">';
								$to .= '<img src="' . $thumb[0] . '" class="inline-thumbnail"/>';
							$to .= '</li>';
						}			
  					$to .= '</ul>';
				$to .= '</div>';	
			$to .= '</div>';	
		}
		
		if ($thumb_location == "Top" && $thumbs == true) $o .= $to;


																												
						$o .= '<div class="flex-container inline-slideshow-inner-area inline-slideshow-inner-area'.$unique.'">';

						
							$o .= "<div id='inline-slideshow$unique' class='flexslider inline-slideshow' style='$height_px'>";
								$o .= '<div class="sno_slideshow_nav_left">';
									$o .= '<div class="custom-navigation">';
										$o .= '<span class="flex-prev"><div class="slideshow_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
									$o .= '</div>';
								$o .= '</div>';
					
								$o .= '<div class="sno_slideshow_nav_right">';
									$o .= '<div class="custom-navigation">';
										$o .= '<span class="flex-next"><div class="slideshow_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
									$o .= '</div>';
								$o .= '</div>';
								$o .= '<ul class="slides">';
	    							foreach ($photos as $attachment) {
		    							$count++;
										$fullimage = wp_get_attachment_image_src($attachment->ID, 'full'); 
										$shphotographer = get_post_meta($attachment->ID, 'photographer', true);
	   									$caption = get_post_field('post_excerpt', $attachment->ID);
	   									$image_id = $attachment->ID;
	   									$force_fill_photo = $force_fill;
		   								$image_height = $height_px;
		   								// some overrides for widget slideshows
		   								if ($height) {
			   								$area_ratio = $widget_width / $height;
			   								$photo_ratio = $fullimage[1] / $fullimage[2];
			   								$ratio_diff = abs($area_ratio - $photo_ratio);
			   								if ($ratio_diff > .3) {
				   								$force_fill_photo = ' scaledown';
				   							} else {
					   							$image_height = "height: 100%;min-$height_px";
					   							if ($widget_width && $fullimage[1] > $widget_width * .7) $force_fill_photo = ' forcefill';
				   							}
		   								}
		   								
		   								if ($fullimage[2] >= $fullimage[1]) {
			   								$orientation = 'max-height:100%; margin:0 auto;';
		   								} else {
			   								$orientation = 'max-width:100%;margin:0 auto;';
			   							}
		   								
			   								
		   								// let's make it so that force fill only works if the images are close to big enough.
		   								if ($widget_width && $fullimage[1] < $widget_width * .7) $force_fill_photo = '';
		   								if ($height && $fullimage[2] < $height * .7) $force_fill_photo = '';
		   								
		   								
										$o .= '<li class="storyslide inlinestoryslide" style="'.$height_px.'">';
		   									if ($caption || $photographer) { 
												$o .= "<div class='inline-caption-container'$caption_border>";
													$o .= "<p class='photocaptioninline'>$caption</p>";
													$o .= "<p class='photocredit'>" . sno_sfi_photographer($attachment->ID) . "</p>";	
												$o .= "</div>";
											}
											$o .= "<div class='inline-photo-wrap inline-photo-wrap$unique $caption_area_adjustment modal-photo$unique'  data-image='".$attachment->ID."'>";
												$o .= '<img id="image' . $image_id . '" src="' . $fullimage[0] . '" style="'.$orientation.$image_height.'" class="'.$force_fill_photo.'" />';
											$o .= '</div>';

										$o .= '</li>';
	   								}
										
				
								$o .= '</ul>';
							$o .= '</div>';
						$o .= '</div>';

		if ($thumb_location == "Bottom" && $thumbs == true) $o .= $to;
					
	$o .= '</div>';
						
						$o .= "<script type='text/javascript'>
							$('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
							$('.flex-container').css('background', 'unset');
							$(document).ready(function() {
								$('#inline-thumbnails$unique').flexslider({
									animation: 'slide',
									controlNav: false,
  									customDirectionNav: $('#inline-thumbnav$unique span'),
									animationLoop: true,
									slideshow: false,
									itemWidth: 107,
									itemMargin: 1,
									touch: true,
									asNavFor: '#inline-slideshow$unique'
  								});
   
  								$('#inline-slideshow$unique').flexslider({
  									animation: 'slide',
  									smoothHeight: $smooth_height,
								    controlNav: false,
									slideshowSpeed: $autoscroll_speed,
									slideshow: $autoscroll,
  									customDirectionNav: $('#inline-slideshow$unique span'),
  									animationLoop: true,
  									touch: true,
  									sync: '#inline-thumbnails$unique'
  								});
  								
  								$('.inline-slideshow-inner-area$unique .flex-viewport').each(function() {
  									var first_image_height = $(this).find('ul.slides li:first-child img').css('height');";

  									if ($type != "Widget" && $type != "Recent") {
  									//	$o .= "$(this).css('height', first_image_height);";
  									}
							$o .= "});
								
								
  								var thumbAreaWidth = $('#inline-thumbnails$unique').width();
  								var thumbRowWidth = 111 * $('#inline-thumbnails$unique li').length;
  								if (thumbRowWidth < thumbAreaWidth) {
	  								$('#inline-thumbnails$unique').width(thumbRowWidth);
	  								$('#inline-thumbnails$unique').closest('.inline-slideshow-area').css('background', '#000000');
	  								$('#inline-thumbnails$unique').closest('.flexslider').css('background', '#000000');
	  							}

							});</script>";
						
		return $o;
	
}


function getslideshow_ajaxpost() {
	global $post;
	$widget = ''; $unique = ''; $photoids = ''; $storyid = ''; $recent = 'false'; $back_text = "Back to Article"; $start = 0;
	
     	if ( isset ($_POST['storyid']) ) $storyid = $_POST['storyid']; 
     	if ( isset ($_POST['unique']) ) $unique = $_POST['unique'];
     	if ( isset ($_POST['widget']) ) { $widget = $_POST['widget']; $back_text = "Close Gallery"; }
     	if ( isset ($_POST['photoids']) ) $photoids = $_POST['photoids'];
     	if ( isset ($_POST['recent']) ) $recent = $_POST['recent'];
     	if ( isset ($_POST['image']) ) $image = $_POST['image'];
     	
     	
     	     	
			
			echo '<div class="photo-container">';
			
				// removing the option for sharing icons on slideshows -- it's just not that useful
				//	if (get_theme_mod('slideshow-sharing-icons') != 'Hide') sno_slideshow_sharing_icons( $story = $storyid );

	 		echo '<div class="sfi-header">';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

					echo '<div class="sfi-return-to-story" data-remodal-action="cancel">';
						echo '<div class="fa fa-angle-left"><div class="icon-hidden-text">' . $back_text . '</div></div>';
						echo '<div class="sfi-back-text">' . $back_text . '</div>';
					echo '</div>';
					echo '<div class="sfi-title-area">';
						if ($widget == 'true') {
							echo '<p class="sfi-title"><a href="' . get_permalink($storyid) . '">' . get_the_title($storyid) . '</a></p>';
						} else {
							echo '<p class="sfi-title">' . get_the_title($storyid) . '</p>';
						}
					echo '</div>';
						
					
					echo '<div class="clear"></div>';
			echo '</div>';
					

			if ($photoids) {
				
				$photos = explode(',', $photoids);
				
				$args = array(
					'post_type'      	=> 'attachment',
					'post_status'    	=> null,
					'post_mime_type' 	=> 'image',
					'numberposts'    	=> -1,
					'orderby' 			=> 'post__in', 
					'post__in' 			=> $photos
				);
				
						
			} else if ($recent != 'false') {
				
				$args = array(
					'orderby'        => 'date',
					'order'			 => 'DESC',
					'post_type'      => 'attachment',
					'post_status'    => null,
					'post_mime_type' => 'image',
					'numberposts'    => $recent
				);
			} else {

				$args = array(
					'orderby'        => 'menu_order',
					'order'			 => 'ASC',
					'post_type'      => 'attachment',
					'post_parent'    => $storyid,
					'post_status'    => null,
					'post_mime_type' => 'image',
					'numberposts'    => -1
				);
			}
	
					$attachments = get_posts($args);
					$number_photos = count($attachments);
					$count = 0;
					
					
			// build the thumbnail navigation area
			echo "<div class='sfi-thumb-navigation-area' id='sfi-thumbnav$unique'>";
				echo '<span class="flex-prev"><div class="sfi_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
				echo '<span class="flex-next"><div class="sfi_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';

						  	if ($number_photos>1) {
							echo "<div id='sfi-thumbnails$unique' class='flexslider sfi-thumbnails'>";
  								echo '<ul class="slides">';			
	    							foreach ($attachments as $attachment) {
	    								$thumb = wp_get_attachment_image_src($attachment->ID, 'carouselthumb', false);
					
										echo '<li class="sfi-thumb">';
											echo '<img src="' . $thumb[0] . '" class="sfi-thumbnail"/>';
										echo '</li>';
									}			
  								echo '</ul>';
							echo '</div>';
							}
				
			echo '</div>';


																												
						echo '<div class="flex-container sfi-slideshow-area">';

						
							echo "<div id='sfi-slideshow$unique' class='flexslider sfi-slideshow'>";
								echo '<div class="sno_slideshow_nav_left">';
									echo '<div class="custom-navigation">';
										echo '<span class="flex-prev"><div class="slideshow_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
									echo '</div>';
								echo '</div>';
					
								echo '<div class="sno_slideshow_nav_right">';
									echo '<div class="custom-navigation">';
										echo '<span class="flex-next"><div class="slideshow_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
									echo '</div>';
								echo '</div>';
								echo '<ul class="slides">';
	    							foreach ($attachments as $attachment) {
		    							if (isset($image) && $image == $attachment->ID) $start = $count;
		    							$count++;
										$fullimage = wp_get_attachment_image_src($attachment->ID, 'full'); 
										$photographer = get_post_meta($attachment->ID, 'photographer', true);
	   									$caption = get_post_field('post_excerpt', $attachment->ID);
	   									$image_id = $attachment->ID;
	   									if ($fullimage[2] >= $fullimage[1]) {
		   									$orientation = 'max-height: 100%; width:auto; margin:0 auto;';
		   									$vertical = 'On';
	   									} else {
		   									$orientation = 'max-width:100%;margin:0 auto;';
		   									$vertical = '';
		   								}
		   								$caption_area_adjustment = ''; $caption_border = '';
		   								if ($caption || $photographer) { 
			   								$caption_area_adjustment = " sfi_has_caption";
			   							} else {
				   							$caption_border = " style='border: none;'";
			   							}
										echo '<li class="storyslide">';

											echo "<div class='slideshow-caption-container'$caption_border>";
												echo "<p class='photocaptionremodal'>$caption</p>";	
												echo "<p class='photocredit'>" . sno_sfi_photographer($attachment->ID) . "</p>";	
										//		echo "<div class='sfi-progress'>$count of $number_photos</div>";	
											echo "</div>";

											echo "<div class='sfi-photo-wrap sfi-photo-wrap$unique $caption_area_adjustment'>";
												echo '<img id="image' . $image_id . '" src="' . $fullimage[0] . '" style="'.$orientation.'" data-width="' . $fullimage[1] . '" data-height="' . $fullimage[2] .'" />';
											echo '</div>';
											echo '<div class="slideshow-caption-container-tablet">';
												if ($caption) echo "<p class='photocaptionremodal'>$caption</p>";	
												if ($photographer) echo sno_sfi_photographer($attachment->ID);	
										//		echo "<div class='sfi-progress'>$count of $number_photos</div>";	
											echo "</div>";

										echo '</li>';
	   								}
										
				
								echo '</ul>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
						
						?><script type="text/javascript">
							$('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
							$('.flex-container').css('background', 'unset');
							$(document).ready(function() {
								$('#sfi-thumbnails<?php echo $unique; ?>').flexslider({
									animation: 'slide',
									controlNav: false,
  									customDirectionNav: $("#sfi-thumbnav<?php echo $unique; ?> span"),
									animationLoop: true,
									slideshow: false,
									itemWidth: 106,
									itemMargin: 5,
									touch: true,
									asNavFor: '#sfi-slideshow<?php echo $unique; ?>'
  								});
   
  								$('#sfi-slideshow<?php echo $unique; ?>').flexslider({
  									animation: 'fade',
  									smoothHeight: false,
  									customDirectionNav: $("#sfi-slideshow<?php echo $unique; ?> span"),
  									animationLoop: true,
  									slideshow: false,
  									startAt: <?php echo $start; ?>,
  									touch: true,
  									sync: "#sfi-thumbnails<?php echo $unique; ?>"
  								});
  								
  								var thumbAreaWidth = $('#sfi-thumbnails<?php echo $unique; ?>').width();
  								var thumbRowWidth = 111 * $('#sfi-thumbnails<?php echo $unique; ?> li').length;
  								if (thumbRowWidth < thumbAreaWidth) {
	  								$('.sfi-thumbnails').width(thumbRowWidth);
	  							}
	  							
	  							// let's make photos fully fill the frame if they are close to filling the frame and if they are large enough to start with
	  							
	  							function scalephotos() {
		  							$("#sfi-slideshow<?php echo $unique; ?> ul.slides li.storyslide").each(function(){
			  							photo_w = $(this).find('img').attr('data-width');
			  							photo_h = $(this).find('img').attr('data-height');
			  							if (photo_h > 0) { photo_ratio = photo_w / photo_h; } else { photo_ratio = 2; }
			  							area_w = $(this).find('.sfi-photo-wrap').width();
			  							area_h = $(this).find('.sfi-photo-wrap').height();
			  							if (area_h > 0) { area_ratio = area_w / area_h; } else { area_ratio = 2; }
			  							photo_ratio = photo_ratio.toFixed(2); area_ratio = area_ratio.toFixed(2);
			  							ratio_diff = Math.abs(area_ratio - photo_ratio).toFixed(2);
			  							if (ratio_diff < .3 && photo_w > area_w * .7 && photo_h > area_h * .7) {
				  							$(this).find('img').addClass('forcefill');
				  						} else {
				  							$(this).find('img').removeClass('forcefill');
				  						}
		  							})
	  							}
								$(function() {
									scalephotos();
									window.onresize = function() {
										scalephotos();
						            };
								});
	  							

	  							
							});
						</script><?php
  		die();
}
add_action('wp_ajax_getslideshow', 'getslideshow_ajaxpost');
add_action('wp_ajax_nopriv_getslideshow', 'getslideshow_ajaxpost'); 

function sno_slideshow_sharing_icons($story) {
	
	global $post; $content = ''; $original_location = $location;	
	$unique = rand(0, 1000000);

		$shareURL = urlencode(get_permalink($story) . '#slideshow');
 		$short_link = urlencode(wp_get_shortlink($story) . '#slideshow'); 
		$shareTitle = urlencode(get_the_title($story));
		$shareThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		
		$twitterHandle = get_theme_mod('sharing-twitter-username'); 
		if ($twitterHandle) {
			$twitterHandle = str_replace('@', '', $twitterHandle);
			$urlcleaner = strrpos($twitterHandle, '/'); 
			if ($urlcleaner) $twitterHandle = substr($twitterHandle, $urlcleaner + 1);
			$twitterHandle = "&amp;via=" . $twitterHandle;
		}
		
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$shareTitle.'&amp;url='.$short_link.$twitterHandle;
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shareURL;
		$googleURL = 'https://plus.google.com/share?url='.$shareURL;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$shareURL.'&amp;media='.$shareThumbnail[0].'&amp;description='.$shareTitle;
 		$redditURL = 'https://reddit.com/submit?url='.$shareURL.'&title='.$shareTitle;
		$tumblrURL = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='.$shareURL.'&title='.$shareTitle;

		$content .= '<div id="content"><div class="sfi-sharing sharing sharing-top">';
		
		$sharing_mobile = ' sharing-mobile-show';
		if (get_theme_mod('sharing-mobile') != 'Display') $sharing_mobile = ' sharing-mobile-hide';
		
			if (get_theme_mod('sharing-facebook') != 'Hide') {
				$content .= '<a class="modal-share" href="'.$facebookURL.'" title="Share on Facebook" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-facebook dashicons dashicons-facebook-alt sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Facebook</span></div></a>';
			}
			if (get_theme_mod('sharing-twitter') != 'Hide') {
				$content .= '<a class="modal-share" href="'.$twitterURL.'" title="Tweet This Story" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-twitter dashicons dashicons-twitter sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Twitter</span></div></a>';
			}
			if (get_theme_mod('sharing-google') == 'Show') {
				$content .= '<a class="modal-share" href="'.$googleURL.'" title="Share on Google+" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-google-plus fa fa-google-plus sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Google Plus</span></div></a>';
			}
			if (get_theme_mod('sharing-pinterest') == 'Show') {
				$content .= '<a class="modal-share" href="'.$pinterestURL.'" title="Share on Pinterest" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-pinterest fa fa-pinterest sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Pinterest</span></div></a>';
			}
			if (get_theme_mod('sharing-reddit') == 'Show') {
				$content .= '<a class="modal-share" href="'.$redditURL.'" title="Share on Reddit" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-reddit genericon genericon-reddit sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Reddit</span></div></a>';
			}
			if (get_theme_mod('sharing-tumblr') == 'Show') {
				$content .= '<a class="modal-share" href="'.$tumblrURL.'" title="Share on Tumblr" target="_blank"><div aria-hidden="true" class="sharing-icon sharing-mobile sno-tumblr fa fa-tumblr sno-dark' . $sharing_mobile . '"><span class="icon-hidden-text">Share via Tumblr</span></div></a>';
			}
			
		$sharing_mobile = ' sharing-mobile-show';
		if (get_theme_mod('sharing-mobile') != 'Display') $sharing_mobile = ' sharing-mobile-hide';

			if (get_theme_mod('sharing-email') != 'Hide') {
				$content .= "<div aria-hidden='true' id='sfi_email_button$unique' class='sharing-icon sno-email dashicons dashicons-email-alt sno-dark $sharing_mobile'><span class='icon-hidden-text'>Share via email</span></div>";
			}
		$content .= '</div></div>';	
		
		echo $content;
			
		if (get_theme_mod('sharing-email') != 'Hide') {
			$number1 = rand(0, 10);
			$number2 = rand(0, 10);
			$result = $number1 + $number2;

			
			echo "<div id='sfi-email$unique' class='sfi-email'>";	
  				echo "<div class='sfi_emailstoryform' id='sfi_emailstoryform$unique'>";
  				echo "<h1>Email This Slideshow</h1>";
  				echo "<form method='post' action=''>";
  				echo "<input type='text' id='sfi_email_to$unique' name='sfi_email_to$unique' class='sno_email_fields' placeholder='Send email to this address'><br />";
  				echo "<input type='text' id='sfi_email_from$unique' name='sfi_email_from$unique' class='sno_email_fields' placeholder='Enter Your Name'><br />";
  				echo "<textarea rows='4' id='sfi_email_comment$unique' name='sfi_email_comment$unique' class='sno_email_fields' placeholder='Add a comment here (optional).'></textarea><br />";
  				echo "<input type='text' id='sfi_human$unique' name='sfi_human$unique' class='sno_email_fields' placeholder='What is $number1 + $number2?'><br />";

  				echo "<br />";
  				echo "<div id='sfi_submit_email$unique' class='remodal-confirm'>Send Email</div>";
  				echo "<div id='sfi_cancel_email$unique' class='sfi-cancel-email'>Cancel</div>";
  				wp_nonce_field( 'sno_email_submission_check'.$unique, 'sfi_sno_email_submission_form'.$unique );

  				echo '</form></div></div>';
			


		?>
		
										<script>
								$(document).ready(function() {
									$('#sfi_email_button<?php echo $unique; ?>').click(function(){
										if ($('#sfi-email<?php echo $unique; ?>').is(":hidden")) {
											$('#sfi-email<?php echo $unique; ?>').show();
											$('#sfi-email<?php echo $unique; ?>').animate({ bottom: 0 }, { duration: 1000, queue: false });
										} else if ($('#sfi-email<?php echo $unique; ?>').is(":visible")) {
											$('#sfi-email<?php echo $unique; ?>').animate({ bottom: -1000 }, 1000, function() { $(this).hide(); });
										}
									});
									$('#sfi_cancel_email<?php echo $unique; ?>').click(function(){
											$('#sfi-email<?php echo $unique; ?>').animate({ bottom: -1000 }, 1000, function() { $(this).hide(); });
									})
								$(function(){
           							$('#sfi_submit_email<?php echo $unique; ?>').click(function(){
											var storyid = '<?php echo $story; ?>';
											var datastring = '';
											
											
											if ($("#sfi_email_to<?php echo $unique; ?>").length > 0){
												var email_to = $('input[id=sfi_email_to<?php echo $unique; ?>]');
												datastring += '&email_to=' + encodeURIComponent(email_to.val());
       										}
											if ($("#sfi_email_from<?php echo $unique; ?>").length > 0){
												var email_from = $('input[name=sfi_email_from<?php echo $unique; ?>]');
												datastring += '&email_from=' + encodeURIComponent(email_from.val());
       										}

											if ($("#sfi_email_comment<?php echo $unique; ?>").length > 0){
												var email_comment = $('textarea[name=sfi_email_comment<?php echo $unique; ?>]');
												datastring += '&email_comment=' + encodeURIComponent(email_comment.val());
       										}

											if ($("#sfi_human<?php echo $unique; ?>").length > 0){
												var human = $('input[name=sfi_human<?php echo $unique; ?>]');
												datastring += '&human=' + encodeURIComponent(human.val());
       										}
       										
	   										datastring += '&humanity=' + <?php echo $result; ?>;
	   										datastring += '&slideshow=slideshow';
	   										datastring += '&unique=' + <?php echo $unique; ?>;

       										var verification = $('input[name=sfi_sno_email_submission_form<?php echo $unique; ?>]');
	   										datastring += '&verification=' + verification.val();
	   										
	   									//	alert('<?php echo $story; ?>');
	   										
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=emailstory&storyid=' + storyid + datastring,
 	            				            success:function(results)
	            				            { 	$("#sfi_emailstoryform<?php echo $unique; ?>").replaceWith(results); 
	            				            	$("#sfi-email<?php echo $unique; ?>").delay(2000).animate({ bottom: -1000 }, 1000, function() { $(this).hide(); });
	            				            }
	           				    	  	});
	         						});
								});
								});

							</script><?php
		}
	return;				
}

function sno_sfi_story_page($post, $caption, $photographer, $widget=null) {
	
					$args = array(
						'orderby'        => 'menu_order',
						'order'			 => 'ASC',
						'post_type'      => 'attachment',
						'post_parent'    => $post->ID,
						'post_status'    => null,
						'post_mime_type' => 'image',
						'numberposts'    => -1
						);
	
					$attachments = get_posts($args);
										
					$vertical = '';
					
					$unique = mt_rand(1, 1000000);	
					
  					if ($attachments) {
	  					
	  					if (get_theme_mod('slideshow-type') == 'Inline') {
							
							echo sno_get_inline_slideshow($post->ID, "SNO Slideshow", $number=null, $instance=null, $widget_id=null, $unique);

	  					} else {
		  					
		  					$slide_number = count($attachments);
		  					
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
	
							if ($image[0] == '') {
								$image = wp_get_attachment_image_src($attachments[0]->ID, 'large', false);
							}
							
							if ($image[2] > $image[1]) $vertical = 'max-width:400px;margin:0 auto;';
	
		  					echo '<div class="photowrap">';
			  					echo "<div class='sfiphotowrap sfiphotowrap$unique modal-photo$unique'>";
									echo "<div id='storypageslideshow' style='$vertical'>";
											
											echo "<div id='slideshowwrap$unique' class='slideshowwrap'>";
													echo '<img src="' . $image[0] . '" style="width:100%;' . $vertical . '" class="catboxphoto slideshow-photo" />'; 
												echo "<a class='modal-photo$unique' href='#slideshow'><div class='slideshow-enlarge' id='slideshow-enlarge$unique'>";
													echo '<div class="fa fa-clone slideshow-icon"></div>';
													echo "<div class='slideshow-title'>Gallery<span class='v-divider'>|</span>$slide_number Photos</div>";
												echo '</div></a>';
											echo '</div>';
				
											$photographer = sno_sfi_photographer(get_post_thumbnail_id($post->ID));
					   						if ($photographer || $caption) echo '<div class="captionboxmittop">';
				
											if ($photographer) echo $photographer; 
					   													
											if ($caption) { 
												echo '<div class="photocaption">'.$caption.'</div>'; 
					   						} 
					   						
					   						if ($photographer || $caption) { echo '</div>'; } else { echo '<div class="photobottom"></div>'; }
				
								
									echo '</div>';
								echo '</div>';
							echo '</div>';		
							echo '<div class="photobottom"></div>';
						
						}
					
						// overlay slideshow display
						
						echo "<div class='remodal remodal-story-image' data-remodal-id='modal-photo$unique' data-remodal-options='hashTracking: false, closeOnConfirm: false'>";

							echo '<button data-remodal-action="close" class="remodal-close"></button>';
							echo "<div class='photo-container$unique'>";
								echo '<div id="listloader" class="spinner" style="display:block;float:none;margin:45vh auto;">
									<div class="bounce1"></div>
									<div class="bounce2"></div>
									<div class="bounce3"></div>
									</div>'; 

							echo "</div>";
						echo "</div>";
						?><script type="text/javascript">
							
								var sno_slideshow_open = 'no';
									$('html').on('wheel', function(event) {
										var delta = {
											y: event.originalEvent.deltaY
										};
													
									if (delta.y > 20 && sno_slideshow_open == 'yes') {
											$('button.remodal-close').trigger('click');
											sno_slideshow_open = 'no';
										}
									});

								$(document).ready(function() {
									$('html').on('click', 'button.remodal-close', function(){
										sno_slideshow_open = 'no';
									});
									$('html').on('click', '.sfi-return-to-story', function(){
										sno_slideshow_open = 'no';
									});
									$('body').keypress(function(e){
										if(e.which == 27 || e.which == 0){
											sno_slideshow_open = 'no';
										}
									});									
									$(function(){
										$(".modal-photo<?php echo $unique; ?>").click(function() {
											var image = $(this).attr('data-image');
											
											sno_slideshow_open = 'yes';
											var inst = $("[data-remodal-id=modal-photo<?php echo $unique; ?>]").remodal();
											inst.open();
											var storyid = '<?php echo $post->ID; ?>';
											var unique = '<?php echo $unique; ?>';
											<?php if ($widget == 'true') { ?>
												var widget = 'true';
											<?php } else { ?>
												var widget = 'false';
											<?php } ?>

											$.ajax({
												url:"/wp-admin/admin-ajax.php",
												type:'POST',
												data:'action=getslideshow&storyid=' + storyid + '&unique=' + unique + '&widget=' + widget + '&image=' + image,
												success:function(results)
													{ 
														$(".photo-container<?php echo $unique; ?>").replaceWith(results); 
													}
	           								});
										});
									});
									



									$('.sfiphotowrap<?php echo $unique; ?>').hover(function(){
										$('#slideshow-enlarge<?php echo $unique; ?>').css("background", "<?php echo get_theme_mod('reset-color1'); ?>");
									}, function(){
										$('#slideshow-enlarge<?php echo $unique; ?>').css("background", "#000");
									})
								});
						</script><?php
						
					}
}

function sno_get_single_image($post, $caption, $photographer) {
		$unique = 'single'.$post->ID;
							echo '<div class="photowrap">';  
									$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
									$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); 
									if ($fullimage[1] > 600 || $fullimage[2] > 600) {

		   								$caption_area_adjustment = ''; $caption_border = '';
		   								if ($caption || $photographer) { 
			   								$caption_area_adjustment = " sfi_has_caption";
			   							} else {
				   							$caption_border = " style='border: none;'";
			   							}
			   							

										echo "<a class='modal-photo$unique' href='#photo'><img src='" . $image[0] . "' alt='";
											echo urlencode($caption);
											echo "' style='width:100%' class='catboxphoto feature-image' /></a>"; 
										echo "<div class='modal-photo$unique photo-enlarge elusive el-icon-zoom-in'></div>";
										echo "<div class='remodal remodal-story-image sno-single-image' data-remodal-id='modal-photo$unique' data-remodal-options='hashTracking: false, closeOnConfirm: false'>";
											echo '<button data-remodal-action="close" class="remodal-close"><span class="icon-hidden-text">Close</span></button>';
											echo '<div class="photo-container">';
												echo '<div class="sfi-header">';
													echo '<div class="sfi-return-to-story" data-remodal-action="cancel">';
														echo '<div class="fa fa-angle-left"><div class="icon-hidden-text">Back to Article</div></div>';
														echo '<div class="sfi-back-text">Back to Article</div>';
													echo '</div>';
													echo '<div class="sfi-title-area">';
														echo '<p class="sfi-title">' . get_the_title($post->ID) . '</p>';
													echo '</div>';
												echo '</div>';
												echo "<div class='single-photo-wrap single-photo-container slideshow-photo-container$unique $caption_area_adjustment'>";
													echo '<img id="image'.$unique.'" src="' . $fullimage[0] . '" alt="' . strip_tags($caption) . '" class="enlarged-photo" data-width="'.$fullimage[1].'" data-height="'.$fullimage[2].'"/>';
												echo '</div>';
												echo "<div class='photo-caption-container'$caption_border>";
													echo "<p class='photocaptionremodal'>$caption</p>";	
													echo "<p class='photocreditremodal'>" . get_sno_photographer( $wrap = false) . "</p>";		
												echo "</div>";
												echo '<div class="clear"></div>';
												echo '<div class="slideshow-caption-container-tablet">';
													echo "<p class='photocaptionremodal'>$caption</p>";	
													echo "<p class='photocredit'>" . get_sno_photographer( $wrap = false) . "</p>";	
												echo "</div>";
											echo '</div>';
										echo "</div>";
										?><script type="text/javascript">
												$(document).ready(function() {
													$(function(){
														$('html').on('click', 'button.remodal-close', function(){
															sno_slideshow_open = 'no';
														});
														$('html').on('click', '.sfi-return-to-story', function(){
															sno_slideshow_open = 'no';
														});
														$('body').keypress(function(e){
															if(e.which == 27 || e.which == 0){
																sno_slideshow_open = 'no';
															}
														});									

														var sno_slideshow_open = 'no';
															$('html').on('wheel', function(event) {
																var delta = {
																	y: event.originalEvent.deltaY
																};
																			
															if (delta.y > 20 && sno_slideshow_open == 'yes') {
																	$('button.remodal-close').trigger('click');
																	sno_slideshow_open = 'no';
																}
															});
															
														$(".modal-photo<?php echo $unique; ?>").click(function() {
															sno_slideshow_open = 'yes';
															var inst = $("[data-remodal-id=modal-photo<?php echo $unique; ?>]").remodal();
															inst.open();
															scalephoto();
															var slideshow_area_height<?php echo $unique; ?> = $('.single-photo-container').height(); 
															var photo_height<?php echo $unique; ?> = <?php echo $fullimage[2]; ?>;
													
															if (photo_height<?php echo $unique; ?> < slideshow_area_height<?php echo $unique; ?> ) {
																var top_margin<?php echo $unique; ?> = (slideshow_area_height<?php echo $unique; ?> - photo_height<?php echo $unique; ?>)/2;
																$('#image<?php echo $unique; ?>').css("margin-top", top_margin<?php echo $unique; ?>);
															}
														});
													});

						  							// let's make photos fully fill the frame if they are close to filling the frame and if they are large enough to start with
						  							
						  							function scalephoto() {
							  							$(".slideshow-photo-container<?php echo $unique; ?>").each(function(){
								  							photo_w = $(this).find('img').attr('data-width');
								  							photo_h = $(this).find('img').attr('data-height');
								  							if (photo_h > 0) { photo_ratio = photo_w / photo_h; } else { photo_ratio = 2; }
								  							area_w = $(this).width();
								  							area_h = $(this).height();
								  							if (area_h > 0) { area_ratio = area_w / area_h; } else { area_ratio = 2; }
								  							photo_ratio = photo_ratio.toFixed(2); area_ratio = area_ratio.toFixed(2);
								  							ratio_diff = Math.abs(area_ratio - photo_ratio).toFixed(2);
								  							if (ratio_diff < .3 && photo_w > area_w * .7 && photo_h > area_h * .7) {
									  							$(this).find('img').addClass('forcefill');
									  						} else {
									  							$(this).find('img').removeClass('forcefill');
									  						}
							  							})
						  							}
													$(function() {
														scalephoto();
														window.onresize = function() {
															scalephoto();
											            };
													});

												});
										</script><?php


									} else {
										echo '<img src="' . $image[0] . '" style="width:100%" alt="' . $caption . '" class="catboxphoto" />'; 
									}
							echo '</div>';
	
}

$active_cats = get_option('sno_active_cats');

if (is_array($active_cats) && !empty($active_cats)) {
	
	$active_cats = array_filter($active_cats);
	
	foreach ($active_cats as $active_cat_id => $active_cat_name) {
		
		if (get_theme_mod('cat-template-'.$active_cat_id) == 'Widget Areas') {

			register_sidebar(array( 
				'name' 			=> $active_cat_name . ' Top Full Width',
				'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
				'id' 			=> 'cat'.$active_cat_id.'-t-11',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));			
			register_sidebar(array( 
				'name' 			=> $active_cat_name . ' Top Wide',
				'id' 			=> 'cat'.$active_cat_id.'-2',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));
			register_sidebar(array(
				'name'			=> $active_cat_name . ' Left',
				'id' 			=> 'cat'.$active_cat_id.'-3',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));
			register_sidebar(array(
				'name'			=> $active_cat_name . ' Center',
				'id' 			=> 'cat'.$active_cat_id.'-4',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));
			register_sidebar(array(
				'name'			=> $active_cat_name .' Right',
				'id' 			=> 'cat'.$active_cat_id.'-5',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));
			register_sidebar(array( 
				'name' 			=> $active_cat_name . ' Bottom Full Width',
				'description'	=> 'Not all widgets will look good in this area. The SNO Category, SNO Story Carousel, and SNO Story Grid widgets are designed for this area.',
				'id' 			=> 'cat'.$active_cat_id.'-b-11',
				'before_widget'	=> '<div style="clear:both"></div><div class="widgetwrap sno-animate"><div>',
				'after_widget' 	=> '</div><div class="widgetfooter3"></div></div>',
				'before_title' 	=> '</div><div class="titlewrap"><div class="widgettitle-nonsno">',
				'after_title' 	=> '</div></div><div class="widgetbody">',
			));			
		}
	}
}

function get_sno_timestamp() {
	
	global $post;

	$timestamp = get_post_time('U', true);
	if ($timestamp < 0) {
		$pfx_date = get_the_date( 'F j, Y', $post_id ); return '<span class="time-wrapper">'.$pfx_date.'</span>';
	}
	
	$gmtOffset=get_option('gmt_offset'); 

	$offset = $gmtOffset * 3600;
	$time = $timestamp + $offset; 
	$notification_time = date('F j, Y', $time);

	$current_time = time() + $offset;
	$time_compare = $current_time - $time;
	
	if (!is_single() || (is_single() && get_theme_mod('time-story-page') == 'on')) {
		if ($time > strtotime("today") && get_theme_mod('time-format') == 'Time Stamp') {
			
			
			$notification_time = get_theme_mod('time-pretext-elapsed') . ' ' . date('g:i a', $time);
			
			if (get_theme_mod('time-alert') == 'on') {
				if (get_theme_mod('time-alert-limit') == '1' && $time_compare < 3600) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '2' && $time_compare < 21600) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '3' && $time_compare < 43200) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '4' && $time_compare < 86400) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '5' && $time_compare < 604800) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				}
				
			}

		} else if (get_theme_mod('time-format') == 'Elapsed Time') {
			
			
			$time_elapsed_limit = get_theme_mod('time-elapsed-limit'); if ($time_elapsed_limit == '') $time_elapsed_limit = 4;

			switch (true) {
				case ($time_compare < 60):
					$notification_time = $time_compare . ' seconds ago';
					break;
				case ($time_compare < 120):
					$notification_time = (floor($time_compare/60)) . ' minute ago';
					break;
				case ($time_compare < 3600):
					$notification_time = (floor($time_compare/60)) . ' minutes ago';
					break;
				case ($time_compare < 7200):
					if ($time_elapsed_limit >=2) $notification_time = (floor($time_compare/3600)) . ' hour ago';
					break;
				case ($time_compare < 21600):
					if ($time_elapsed_limit >=2) $notification_time = (floor($time_compare/3600)) . ' hours ago';
					break;
				case ($time_compare < 43200):
					if ($time_elapsed_limit >=3) $notification_time = (floor($time_compare/3600)) . ' hours ago';
					break;
				case ($time_compare < 86400):
					if ($time_elapsed_limit >=4) $notification_time = (floor($time_compare/3600)) . ' hours ago';
					break;
				case ($time_compare < 172800):
					if ($time_elapsed_limit >=5) $notification_time = (floor($time_compare/86400)) . ' day ago';
					break;
				case ($time_compare < 604800):
					if ($time_elapsed_limit >=5) $notification_time = (floor($time_compare/86400)) . ' days ago';
					break;

			}

			$notification_time = get_theme_mod('time-pretext-elapsed') . ' ' . $notification_time;
			if (get_theme_mod('time-alert') == 'on') {
				if (get_theme_mod('time-alert-limit') == '1' && $time_compare < 3600) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '2' && $time_compare < 21600) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '3' && $time_compare < 43200) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '4' && $time_compare < 86400) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				} else if (get_theme_mod('time-alert-limit') == '5' && $time_compare < 604800) { 	
					$notification_time = '<span class="time-alert">' . $notification_time . '</span>';
				}
				
			}
			 
		} else {
			$notification_time = get_theme_mod('time-pretext') . ' ' . date('F j, Y', $time);
		}
				
	} else {
		
		if (get_theme_mod('time-pretext')) $notification_time = get_theme_mod('time-pretext') . ' ' . $notification_time;		
	
	}
	
	$notification_time = '<span class="time-wrapper">' . $notification_time . '</span>';
	
	return $notification_time;

}

function sno_get_widget_width($widget_id) {
	
		$sidebars = get_option('sidebars_widgets'); 
		
		$current_area = '';
		foreach($sidebars as $area => $widgets) {
			if (is_array($widgets)) {
				foreach($widgets as $widget) {
					if ( $widget === $widget_id ) $current_area = $area;	
				}
			}
    	}	
    	
		if (strpos($current_area, 'cat') !== false) {
			$cat_id_string = explode('-', $current_area); 
			$cat_id = str_replace('cat', '', $cat_id_string[0]);
			$columns = get_theme_mod("cat-widget-layout-$cat_id");
		} else { 
			$columns = get_theme_mod('sno-layout'); 
		}
		
		$site_width = get_theme_mod('content-width');
		if ($site_width == '') $site_width = 980;
		if (get_theme_mod('outerwrap') != get_theme_mod('innerbackground')) $site_width -= 30;

		$widget_width = array();
		
		if (substr($current_area, -2) == '-2') {
			$widget_width[0] = 'Main Column';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200 ) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
		} else if (substr($current_area, -3) == '-11' || $current_area == '-11') {
			$widget_width[0] = 'Full-Width'; 
			$widget_width[1] = $site_width;
			if (substr($current_area, -4) == 'h-11') $widget_width[1] = $site_width + 30;
		} else if (substr($current_area, -2) == '-1' || $current_area == 'sidebar-6') {
			$widget_width[0] = 'Non-Home Sidebar'; 
			$widget_width[1] = 320;
		} else if (substr($current_area, -2) == '-3' && $columns == 'Option 1') {
			$widget_width[0] = 'Narrow'; 
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1] * .3);
		} else if (substr($current_area, -2) == '-3' && $columns == 'Option 2') {
			$widget_width[0] = 'Wide';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335; // need to make this conditional that it's only the homepage
			$widget_width[1] *= .7;
			$widget_width[1] = floor($widget_width[1]);
		} else if (substr($current_area, -2) == '-3' && ($columns == 'Option 4' || $columns == 'Option 5' || $columns == 'Option 6')) {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = 320;
		} else if (substr($current_area, -2) == '-3') {
			$widget_width[0] = 'Left Regular Width';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200 ) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1]/2);
		} else if (substr($current_area, -2) == '-4' && $columns == 'Option 1') {
			$widget_width[0] = 'Wide';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] *= .7;
			$widget_width[1] = floor($widget_width[1]);
			$widget_width[1] -= 15;
		} else if (substr($current_area, -2) == '-4' && $columns == 'Option 5') {
			$widget_width[0] = 'Wide';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] *= .7;
			$widget_width[1] = floor($widget_width[1]);
		} else if (substr($current_area, -2) == '-4' && $columns == 'Option 2') {
			$widget_width[0] = 'Narrow'; 
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1] * .3);
			$widget_width[1] -= 15;
		} else if (substr($current_area, -2) == '-4' && $columns == 'Option 4') {
			$widget_width[0] = 'Narrow'; 
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1] * .3);
		} else if (substr($current_area, -2) == '-4' && $columns == 'Option 3') {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1]/2);
			$widget_width[1] -= 15;
		} else if (substr($current_area, -2) == '-4') {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1]/2);
		} else if (substr($current_area, -2) == '-5' && $columns == 'Option 5') {
			$widget_width[0] = 'Narrow'; 
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1] * .3);
			$widget_width[1] -= 15;
		} else if (substr($current_area, -2) == '-5' && $columns == 'Option 4') {
			$widget_width[0] = 'Wide';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] *= .7;
			$widget_width[1] -= 15;
			$widget_width[1] = floor($widget_width[1]);
		} else if (substr($current_area, -2) == '-5' && $columns == 'Option 6') {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = $site_width - 335;
			if ( is_home() && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display' && get_theme_mod('content-width') >= 1200) $widget_width[1] -= 335;  // need to make this conditional that it's only the homepage
			$widget_width[1] = floor($widget_width[1]/2);
			$widget_width[1] -= 15; // margin between two columns
		} else if (substr($current_area, -2) == '-5') {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = 320;
			// add width calculator
		} else if (substr($current_area, -3) == '-10') {
			$widget_width[0] = 'Extra';
			$widget_width[1] = 320;
		} else if (substr($current_area, -3) == '-20') {
			$widget_width[0] = 'Mobile';
			$widget_width[1] = 400;
		} else if (substr($current_area, -2) == '-7') {
			$widget_width[0] = 'Home Bottom Left';
			$widget_width[1] = floor($site_width * .3333);
		} else if (substr($current_area, -2) == '-8') {
			$widget_width[0] = 'Home Bottom Center';
			$widget_width[1] = floor(($site_width * .3333)-15);
		} else if (substr($current_area, -2) == '-9') {
			$widget_width[0] = 'Home Bottom Right';
			$widget_width[1] = floor(($site_width * .3334)-15);
		} else if ($current_area == 'mega-menu') {
			$widget_width[0] = 'Main Column';
			$widget_width[1] = floor($site_width - 215);
		} else {
			$widget_width[0] = 'Home Sidebar';
			$widget_width[1] = 320;
		}
				
		return $widget_width;
	
}

function get_widget_title_size($widget_style, $title_size, $customcolors) {
	
	$select_styles = '';
	
		if ($widget_style == 'Style 1') {
			if ($customcolors == 'snoccon') {		
				if ($title_size == 'Large') $select_styles .= 'margin-right:10px;margin-top:-7px;';
				if ($title_size == 'Medium') $select_styles .= 'margin-right:7px;margin-top:-5px;';
				if ($title_size == 'Small') $select_styles .= 'margin-right:5px;margin-top:-3px;';
			} else {
				$title_size = get_theme_mod('widget1-text-size');
				if ($title_size == 'Large') $select_styles = 'margin-right:10px;margin-top:-7px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:7px;margin-top:-5px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:5px;margin-top:-3px;';
			}
		}
		
		if ($widget_style == 'Style 2') {
			if ($customcolors == 'snoccon') {	
				if ($title_size == 'Large') $select_styles .= 'margin-right:12px;margin-top:-8px;';
				if ($title_size == 'Medium') $select_styles .= 'margin-right:8px;margin-top:-6px;';
				if ($title_size == 'Small') $select_styles .= 'margin-right:6px;margin-top:-4px;';
			} else {
				$title_size = get_theme_mod('widget7-text-size');
				if ($title_size == 'Large') $select_styles = 'margin-right:10px;margin-top:-6px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:7px;margin-top:-4px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:5px;margin-top:-2px;';
			}
		}
		
		if ($widget_style == 'Style 3') {
			if ($customcolors == 'snoccon') {	
				if ($title_size == 'Large') $select_styles = 'margin-right:6px;margin-top:-5px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:3px;margin-top:-3px;';
				if ($title_size == 'Small') $select_styles = 'Hide';
			} else {
				$title_size = get_theme_mod('widget3-text-size');
				if ($title_size == 'Large') $select_styles = 'margin-right:6px;margin-top:-6px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:2px;margin-top:-3px;';
				if ($title_size == 'Small') $select_styles = 'Hide';
			}
		}
		
		if ($widget_style == 'Style 4') {
			if ($customcolors == 'snoccon') {	
				if ($title_size == 'Large') $select_styles = 'margin-right:2px;margin-top:-7px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:-3px;margin-top:-4px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:-4px;margin-top:-3px;';
			} else {
				$title_size = get_theme_mod('widget4-text-size'); 
				if ($title_size == 'Large') $select_styles = 'margin-right:2px;margin-top:-7px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:2px;margin-top:-6px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:0px;margin-top:-4px;';
			}
		}
		
		if ($widget_style == 'Style 5') {
			if ($customcolors == 'snoccon') {	
				if ($title_size == 'Large') $select_styles = 'margin-right:12px;margin-top:-9px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:9px;margin-top:-6px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:8px;margin-top:-4px;';
			} else {
				$title_size = get_theme_mod('widget6-text-size');
				if ($title_size == 'Large') $select_styles = 'margin-right:11px;margin-top:-10px;';
				if ($title_size == 'Medium') $select_styles = 'margin-right:9px;margin-top:-6px;';
				if ($title_size == 'Small') $select_styles = 'margin-right:8px;margin-top:-4px;';
			}
		}
		
		if ($widget_style == 'Style 6') {
			$select_styles = 'Hide';
		}
		
	
	return $select_styles;
	
}

function sno_get_attachment_id( $url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}
add_filter( 'enable_post_by_email_configuration', '__return_false', 100 );

add_action('admin_enqueue_scripts', function() {
	wp_enqueue_script('sno_hide_error', get_bloginfo('template_url').'/javascript/sno_hide_error.js', array('jquery'));
});   

if(get_option('sno_resizeupload_version') != '1.7') {

  update_option('sno_resizeupload_version', 			'1.7', '','yes');
  update_option('sno_resizeupload_width', 				'1501', '', 'yes');
  update_option('sno_resizeupload_height',				'1501', '', 'yes');
  update_option('sno_resizeupload_quality',				'75', '', 'yes');
  update_option('sno_resizeupload_resize_yesno', 		'yes', '','yes');
  update_option('sno_resizeupload_recompress_yesno', 	'no', '','yes');
  update_option('sno_resizeupload_convertbmp_yesno', 	'no', '', 'yes');
  update_option('sno_resizeupload_convertpng_yesno', 	'no', '', 'yes');
  update_option('sno_resizeupload_convertgif_yesno', 	'no', '', 'yes');
}

// resizing functions from https://wordpress.org/plugins/resize-image-after-upload/

function sno_uploadresize_resize($image_data){
	
  sno_error_log("**-start--resize-image-upload");


  $resizing_enabled = get_option('sno_resizeupload_resize_yesno');
	$resizing_enabled = ($resizing_enabled=='yes') ? true : false;

  $force_jpeg_recompression = get_option('sno_resizeupload_recompress_yesno');
	$force_jpeg_recompression = ($force_jpeg_recompression=='yes') ? true : false;

  $compression_level = get_option('sno_resizeupload_quality');


  $max_width  = get_option('sno_resizeupload_width')==0 ? false : get_option('sno_resizeupload_width');

  $max_height = get_option('sno_resizeupload_height')==0 ? false : get_option('sno_resizeupload_height');


  $convert_png_to_jpg = get_option('sno_resizeupload_convertpng_yesno');
	$convert_png_to_jpg = ($convert_png_to_jpg=='yes') ? true : false;

  $convert_gif_to_jpg = get_option('sno_resizeupload_convertgif_yesno');
	$convert_gif_to_jpg = ($convert_gif_to_jpg=='yes') ? true : false;

  $convert_bmp_to_jpg = get_option('sno_resizeupload_convertbmp_yesno');
	$convert_bmp_to_jpg = ($convert_bmp_to_jpg=='yes') ? true : false;



  //---------- In with the old v1.6.2, new v1.7 (WP_Image_Editor) ------------

  if($resizing_enabled || $force_jpeg_recompression) {

		$fatal_error_reported = false;
		$valid_types = array('image/gif','image/png','image/jpeg','image/jpg');

    if(empty($image_data['file']) || empty($image_data['type'])) {
    	sno_error_log("--non-data-in-file-( ".print_r($image_data, true)." )");	
		  $fatal_error_reported = true;
    }
    else if(!in_array($image_data['type'], $valid_types)) {
    	sno_error_log("--non-image-type-uploaded-( ".$image_data['type']." )");
		  $fatal_error_reported = true;
    }

    sno_error_log("--filename-( ".$image_data['file']." )");
    $image_editor = wp_get_image_editor($image_data['file']);
    $image_type = $image_data['type'];


    if($fatal_error_reported || is_wp_error($image_editor)) {
      sno_error_log("--wp-error-reported");
    }
    else {

      $to_save = false;
      $resized = false;


      // Perform resizing if required
      if($resizing_enabled) {

        sno_error_log("--resizing-enabled");
        $sizes = $image_editor->get_size();

        if((isset($sizes['width']) && $sizes['width'] > $max_width)
          || (isset($sizes['height']) && $sizes['height'] > $max_height)) {

          $image_editor->resize($max_width, $max_height, false);
          $resized = true;
          $to_save = true;

          $sizes = $image_editor->get_size();
          sno_error_log("--new-size--".$sizes['width']."x".$sizes['height']);
        }
        else {
          sno_error_log("--no-resizing-needed");
        }
      }
      else {
        sno_error_log("--no-resizing-requested");
      }


      // Regardless of resizing, image must be saved if recompressing
      if($force_jpeg_recompression && ($image_type=='image/jpg' || $image_type=='image/jpeg')) {

        $to_save = true;
        sno_error_log("--compression-level--q-".$compression_level);
      }
      elseif(!$resized) {
        sno_error_log("--no-forced-recompression");
      }


      // Only save image if it has been resized or need recompressing
      if($to_save) {
	      
        $image_editor->set_quality($compression_level);
        $saved_image = $image_editor->save($image_data['file']);
        sno_error_log("--image-saved");
      }
      else {
        sno_error_log("--no-changes-to-save");
      }
    }
  } // if($resizing_enabled || $force_jpeg_recompression)

  else {
    sno_error_log("--no-action-required");
  }

  sno_error_log("**-end--resize-image-upload\n");


  return $image_data;
} 

// Hook the function to the upload handler
add_action('wp_handle_upload', 'sno_uploadresize_resize');

function sno_error_log($message) {
  global $DEBUG_LOGGER;

  if($DEBUG_LOGGER) {
    error_log(print_r($message, true));
  }
}

function sno_mime_types($mime_types){
    unset($mime_types['asf|asx']); 
    unset($mime_types['wmv']); 
    unset($mime_types['wmx']); 
    unset($mime_types['wm']); 
    unset($mime_types['avi']); 
    unset($mime_types['divx']); 
    unset($mime_types['flv']); 
    unset($mime_types['mov|qt']); 
    unset($mime_types['mpeg|mpg|mpe']);
    unset($mime_types['mp4|m4v']);  
    unset($mime_types['ogv']);  
    unset($mime_types['webm']);  
    unset($mime_types['mkv']);  
    unset($mime_types['3gp|3gpp']);  
    unset($mime_types['3g2|3gp2']);  

    unset($mime_types['mp3|m4a|m4b']);  
    unset($mime_types['ra|ram']);  
    unset($mime_types['wav']);  
    unset($mime_types['ogg|oga']);  
    unset($mime_types['mid|midi']);  
    unset($mime_types['wma']);  
    unset($mime_types['wax']);  
    unset($mime_types['mka']);  

    return $mime_types;
}
add_filter('upload_mimes', 'sno_mime_types', 1, 1);

if (is_plugin_active('nextgen-gallery/nggallery.php')) {
	$ngg_options = get_option('ngg_options');
	if ($ngg_options) {
		if ($ngg_options['imgAutoResize'] != '1') {
			$ngg_options['imgWidth'] = '1500';
			$ngg_options['imgHeight'] = '1000';
			$ngg_options['imgQuality'] = '85';
			$ngg_options['imgWidth'] = '1500';
			$ngg_options['imgBackup'] = '0';
			$ngg_options['imgAutoResize'] = '1';
		
			update_option('ngg_options', $ngg_options);
		}
	}
}

function sno_get_all_bylines() {
	

			$transient_id = 'sno_byline_list';
	
			$transient = get_transient( $transient_id ); 
			$output = '';
		  
			if( ! empty( $transient )) {  

				return $transient;
						
			} else {

				$bylines = array_filter(sno_get_meta_values( 'name' ));
				
				set_transient( $transient_id, $bylines, DAY_IN_SECONDS );
				return $bylines;
				
			}
	
}

function sno_check_byline_existence($profile_name) {
	global $wpdb;
	$r = $wpdb->get_row( $wpdb->prepare( "
		SELECT DISTINCT meta_key FROM $wpdb->postmeta WHERE meta_value = '%s' 
		", $profile_name ) );
    
	if ($r->meta_key == 'name' || $r->meta_key == 'writer' || $r->meta_key == 'photographer' || $r->meta_key == 'videographer') {
		return true;
	} else {
		return false;
	}
}

function sno_get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {

    global $wpdb;

    if( empty( $key ) )
        return;

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );

    return $r;
}


function sno_check_ssl_plugin_footer() {
	if (get_option('sno_check_ssl_plugin') != 1) {
		
		$build_ssl_option = get_option('rlrsssl_options');
		
		if ($build_ssl_option == '') $build_ssl_option=array();
		
		$build_ssl_option['ssl_enabled'] = true;
		$build_ssl_option['wp_redirect'] = true;
		$build_ssl_option['ssl_success_message_shown'] = true;
		$build_ssl_option['site_has_ssl'] = true;
		$build_ssl_option['hsts'] = true;
		$build_ssl_option['htaccess_warning_show'] = true;
		$build_ssl_option['autoreplace_insecure_links'] = true;
		$build_ssl_option['plugin_db_version'] = '2.5.20';
		$build_ssl_option['debug'] = false;
		$build_ssl_option['do_not_edit_htaccess'] = true;
		$build_ssl_option['htaccess_redirect'] = true;
		$build_ssl_option['javascript_redirect'] = true;
		$build_ssl_option['switch_mixed_content_fixer-hook'] = true;


		update_option('rlrsssl_options', $build_ssl_option);
		update_option('sno_check_ssl_plugin', 1);
	} 
}
add_action ('wp_footer', 'sno_check_ssl_plugin_footer');

function sno_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'sno_theme_slug_setup' );

add_filter( 'wp_mail_from', function( $from_email ) { return 'wordpress@'.str_replace(array('http://','https://','www.'), '', get_site_url());} );

//add_action( 'admin_head', 'sno_hide_menu_css' );
function sno_hide_menu_css() {
    global $pagenow;
    if ( $pagenow == 'nav-menus.php' ) {
        ?>
        <style type="text/css">
        .auto-add-pages {
            display: none;
        }
        </style>
        <?php
    }
}
function sno_deny_password_reset( $allow, $user_id ) {

	// WP_User object
	$user = get_user_by( 'id', $user_id );
	
	$dontallow=array('snoadmin','admin');

	if ( in_array( $user->user_login, $dontallow ) ) {
		$allow = false;
	}

	return $allow;
}
add_filter( 'allow_password_reset', 'sno_deny_password_reset', 10, 2 );

// adding functionality to backup SNO Design Options and Widget Configurations
// If tables need to be updated or altered, increment the versioning and update the queries below.

function sno_db_install() {
	
	$sno_db_designbackup_version = get_option( 'sno_db_designbackup_version' );
	
	if ( $sno_db_designbackup_version != '1.4' ) {
	
		global $wpdb;
		$design_table_name = $wpdb->prefix . "snodesignoptions";
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $design_table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			timestamp bigint(11) NOT NULL,
			backup longtext NOT NULL,
			userid mediumint(9) NOT NULL,
			starred tinyint(1) DEFAULT '0' NOT NULL,
			name varchar(55),
			PRIMARY KEY  (id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
		update_option( 'sno_db_designbackup_version', '1.4');
	}

	$sno_db_designsnapshot_version = get_option( 'sno_db_designsnapshot_version' );
	
	if ( $sno_db_designsnapshot_version != '1.4' ) {
	
		global $wpdb;
		$snapshot_table_name = $wpdb->prefix . "snodesignsnapshot";
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $snapshot_table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			timestamp bigint(11) NOT NULL,
			backup longtext NULL,
			userid mediumint(9) NOT NULL,
			starred tinyint(1) DEFAULT '0' NOT NULL,
			name varchar(55),
			PRIMARY KEY  (id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
		update_option( 'sno_db_designsnapshot_version', '1.4');
	} 
	
	$sno_db_widgetsnapshots_version = get_option( 'sno_db_widgetsnapshots_version' );

	if ( $sno_db_widgetsnapshots_version != '1.4' ) {
	
		global $wpdb;
		$widgets_table_name = $wpdb->prefix . "snowidgetsnapshots";
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $widgets_table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			snapshotid mediumint(9) NOT NULL,
			widgetid mediumint(9) NOT NULL,
			widgetname text NOT NULL,
			widgetvalue longtext NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
		update_option( 'sno_db_widgetsnapshots_version', '1.4');
	} 
}

add_action( 'admin_init', 'sno_db_install' );

// AJAX functions for updating revision data and viewing revision history

function updatestar_ajaxpost() {
	$value = $_POST['value'];
	$revision_id = $_POST['id'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignoptions';
	$wpdb->update( 
		$table_name, 
				array( 'starred' => $value ), 
				array( 'id' => $revision_id ),
				array( '%d' ),
				array( '%d' ) 
			);
			
	die();	


}
add_action('wp_ajax_updatestar', 'updatestar_ajaxpost');

function restoredesign_ajaxpost() {
	$revision_id = $_POST['id'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignoptions';
	$restoration_data = $wpdb->get_row( "SELECT * from $table_name WHERE id = $revision_id");
	
	update_option( 'theme_mods_snoflex', maybe_unserialize( $restoration_data->backup ) );
	die();	


}
add_action('wp_ajax_restoredesign', 'restoredesign_ajaxpost');

function namerevision_ajaxpost() {
	$revision_id = $_POST['id'];
	$revision_name = $_POST['name'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignoptions';
	
	$wpdb->update( 
		$table_name, 
				array( 'name' => $revision_name ), 
				array( 'id' => $revision_id ),
				array( '%s' ),
				array( '%d' ) 
			);
			
	die();	
}
add_action('wp_ajax_namerevision', 'namerevision_ajaxpost');

function morerestores_ajaxpost() {
	$action = $_POST['listtype'];
	$page = $_POST['currentpage'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignoptions';
	$count_query = "select count(*) from $table_name";
	$num = $wpdb->get_var($count_query);
	$limit = 20;
	$where = '';
	$limit_query = '';
	$offset_query = '';
	
	if ($action == 'restorelistnewer') {

			$page = $page - 1;
			$offset = ( $page - 1 ) * $limit;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			$offset_query = "OFFSET $offset";
		
	} else if ($action == 'restorelistolder') {
		
			$offset = $page * $limit;
			$page = $page + 1;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			$offset_query = "OFFSET $offset";

	} else if ($action == 'restorelistreset') {
			$page = 0;
			$offset = $page * $limit;
			$page = $page + 1;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}

	} else if ($action == 'restoreliststarred') {
			
			$offset = 0;
			$page = 1;
			$where = " WHERE starred = '1'";
			$end = $limit;
			if ($num < $limit) $end = $num;
			
	} else if ($action == 'restorelistnamed') {

			$offset = 0;
			$page = 1;
			$where = " WHERE name != ''";
			$end = $limit;
			if ($num < $limit) $end = $num;

	}
	
			
			$design_history = $wpdb->get_results( "SELECT * FROM $table_name $where ORDER BY timestamp DESC $limit_query $offset_query" );

			echo '<div id="restorearea">';
			echo '<div class="restorecontrols">';
				if ($action == 'restoreliststarred') { 
					echo "All Starred Revisions"; 
				} else if ($action == 'restorelistnamed') {
					echo "All Tagged Revisions";
				} else {
					echo "$start-$end of $num Available Revisions";
				}
				if ($action != 'restorelistnamed') echo '<div id="restorelistnamed" class="restorelist restorelisticon dashicons dashicons-tag"></div>';
				if ($action != 'restoreliststarred') echo '<div id="restoreliststarred" class="restorelist dashicons restorelisticon dashicons-star-filled"></div>';
				if ($action == 'restorelistnamed' || $action == 'restoreliststarred') {
					echo '<div id="restorelistreset" class="restorelist restorelistbutton">Full List</div>';
				} else {
					if ($end < $num) echo '<div id="restorelistolder" class="restorelist restorelistbutton">Older</div>';
					if ($page != 1) echo '<div id="restorelistnewer" class="restorelist restorelistbutton">Newer</div>';
				}
				echo '<div class="clear"></div>';
			echo '</div>';
			
			
			?><script type="text/javascript">
    			jQuery(document).ready(function() {
	    			jQuery(".restorelist").click(function(){
		    			var restoreaction = this.id;
		    			var currentpage = <?php echo $page; ?>;
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=morerestores&listtype=' + restoreaction + '&currentpage=' + currentpage,
							success:function(results)
							{
								jQuery("#restorearea").replaceWith(results);
							}
	    				});

	    			});				
	    		});
				
			</script><?php
			

			echo '<div id="restoredesignlist">';
						
			foreach ($design_history as $design) {
				
				$gmtOffset = get_option('gmt_offset'); 
				$offset = $gmtOffset * 3600;
				$time = $design->timestamp + $offset; 
				$revision_id = $design->id;
							

				$design_time = date("M j, Y, g:ia", $time);
				echo '<div class="restoredesignrow">';
					echo $design_time;
					if ($design->userid != 0) {
						$designuser = get_userdata( $design->userid );
						echo " <i>(" . substr($designuser->first_name . " " . $designuser->last_name,0,15) . ")</i>";
					}
					echo '<div class="restoredesign" id="restore-'.$design->timestamp.'">Restore</div>';
					echo '<div class="restorestarred">';
						if ( $design->starred == 0 ) {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-empty"></div>';
						} else {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-filled"></div>';
						}
					echo '</div>';
					echo '<div class="restorename">';
						if ( $design->name == '') {
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="" class="restore-name" placeholder="Tag this revision" style="display:none;" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-instructions">Click Tag Icon to Save</div>';
						} else {
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="'.stripslashes($design->name).'" class="restore-name"  placeholder="Tag this revision" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-instructions">Click Tag Icon to Save</div>';
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
						} 
					echo '</div>';
				echo '</div>';
				
				
				?><script type="text/javascript">
    				jQuery(document).ready(function() {
	    				jQuery("#restore-tag-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery("#restore-name-<?php echo $design->timestamp; ?>").is(":visible")) { 
							} else {
								jQuery("#restore-name-<?php echo $design->timestamp; ?>").fadeIn().focus();
							}
		    			});
		    			jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(){
			    			var string=jQuery(this).val();	
							if(string.length > 1){
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").show();
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							} else {
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							}
			    		});
			    		jQuery(".tag-icon-save-<?php echo $design->timestamp; ?>").live('click', function(){
				    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=namerevision&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								}
	    					});
			    		});
	    				jQuery("#star-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery(this).hasClass('dashicons-star-empty')) {
			    				jQuery(this).removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
			    				var changeStar = 1;
							} else {
			    				jQuery(this).removeClass('dashicons-star-filled').addClass('dashicons-star-empty');								
			    				var changeStar = 0;
							}
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=updatestar&value=' + changeStar + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
								}
	    					});
	    				});
	    				jQuery("#restore-<?php echo $design->timestamp; ?>").click(function(){
		    				jQuery("#restore-<?php echo $design->timestamp; ?>").text('Wait...');
	    					jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=restoredesign&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									window.location = '/wp-admin/themes.php?page=theme-options&restored=true&id=<?php echo $design->timestamp; ?>';
								}

	    					});
	    				});
	    			});
				</script><?php
			}
			
			echo '</div>'; // end of restoredesignlist
			
			echo '</div>'; // end of restorearea

	die();
}
add_action('wp_ajax_morerestores', 'morerestores_ajaxpost');

// adding WP admin page for managing design snapshots
add_action('admin_menu', 'design_snapshot_create');
function design_snapshot_create() {
	$parent_slug = 'themes.php';
    $page_title = 'Design Snapshots';
    $menu_title = 'Design Snapshots';
    $capability = 'edit_theme_options';
    $menu_slug = 'design_snapshot';
    $function = 'design_snapshot_page';
    $icon_url = 'dashicons-format-gallery';
    $position = 24;

    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

// function that creates the guts of the design snapshot page
function design_snapshot_page() {
	echo '<div class="wrap">';
		if(isset($_REQUEST['created']) && $_REQUEST['created'] == 'true') {
			echo '<div class="updated" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>'.__('New Design Snapshot', 'sno').' <strong>Saved</strong></p></div>';
		}
		echo '<h1>Design Snapshots</h1>';
		
		echo '<div class="designsnapshotintro"><h2>Welcome to the SNO Design Snapshot Control Panel!</h2>';
		echo '<p>Design Snapshots store a copy of all widget configurations (homepage, custom widget category pages, mobile homepage widget area, etc...) as well as all options on the SNO Design Options page. You can choose to restore just the widget configurations, just the SNO Design Options, or both.</p><p><b>Design Snapshots are NOT site backups</b> -- they do not store your stories, photos, or categories.  If you accidentally delete stories, photos, or categories and need to get them back, SNO does maintain daily backups of your site -- please contact <a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">SNO Support</a> if you need assistance with content restoration.</p>';
		
		echo '<div id="create_snapshot" class="fire_once create_snapshot">Create New Design Snapshot</div><div class="clear"></div>';

		echo '</div>';
		

			global $wpdb;
			$table_name = $wpdb->prefix . 'snodesignsnapshot';
			$count_query = "select count(*) from $table_name";
			$num = $wpdb->get_var($count_query);
			$limit = 20;
			$page = 1;
			$offset = 0;
			$start = $offset + 1;
			
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			
			$end = $limit;
			if ($num < $limit) $end = $num;
			
			$design_history = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY timestamp DESC $limit_query" );
			echo '<div id="restorearea">';
			echo '<div class="restorecontrols">';
				echo "$start-$end of $num Available Design Snapshots";
				echo '<div id="restorelistnamed" class="restorelist restorelisticon dashicons dashicons-tag"></div>';
				echo '<div id="restoreliststarred" class="restorelist dashicons restorelisticon dashicons-star-filled"></div>';
				if ($limit < $num) echo '<div id="restorelistolder" class="restorelist restorelistbutton">Older</div>';
				if ($page != 1) echo '<div id="restorelistnewer" class="restorelist restorelistbutton">Newer</div>';
				echo '<div class="clear"></div>';
			echo '</div>';
			?><script type="text/javascript">
    			jQuery(document).ready(function() {
	    			jQuery("#create_snapshot").click(function(){
		    			jQuery("#create_snapshot").unbind( "click" );
		    			jQuery(".create_snapshot").text('Saving...Please wait...');
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=createsnapshot',
							success:function(results)
							{
								window.location = '/wp-admin/themes.php?page=design_snapshot&created=true';

							}
	    				});

	    			});				
	    			jQuery(".restorelist").click(function(){
		    			var restoreaction = this.id;
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=moresnapshots&listtype=' + restoreaction + '&currentpage=1',
							success:function(results)
							{
								jQuery("#restorearea").replaceWith(results);
							}
	    				});

	    			});				
	    		});
				
			</script><?php

			echo '<div id="restoresnapshotlist">';
						
			foreach ($design_history as $design) {
				
				$gmtOffset=get_option('gmt_offset'); 
				$offset = $gmtOffset * 3600;
				$time = $design->timestamp + $offset; 
				$revision_id = $design->id;

				$design_time = date("M j, Y, g:ia", $time);
				echo '<div class="restoresnapshotrow" id="restoresnapshotrow-'.$design->id.'">';
					echo $design_time;
					if ($design->userid != 0) {
						$designuser = get_userdata( $design->userid );
						echo " <i>(" . substr($designuser->first_name . " " . $designuser->last_name,0,15) . ")</i>";
					} else {
						echo " <i>(Automated Snapshot)</i>";
					}
					echo '<div class="deletesnapshot dashicons dashicons-dismiss" id="delete-snapshot-'.$design->id.'"></div>';
					echo '<div id="restoreboth" class="restoresnapshot restore-'.$design->timestamp.'">Full Restore</div>';
					echo '<div id="restorewidgets" class="restoresnapshot restore-'.$design->timestamp.'"><span class="extratext">Restore </span>Widgets</div>';
					echo '<div id="restoredesign" class="restoresnapshot restore-'.$design->timestamp.'"><span class="extratext">Restore </span>Design</div>';
					echo '<div class="restorestarred">';
						if ( $design->starred == 0 ) {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-empty"></div>';
						} else {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-filled"></div>';
						}
					echo '</div>';
					echo '<div class="restorename">';
						if ( $design->name == '') {
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="" class="snapshot-name" placeholder="Tag this snapshot" style="display:none;" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-snapshot-instructions">Click Tag Icon or Press Enter to Save</div>';
						} else {
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="'.stripslashes($design->name).'" class="snapshot-name"  placeholder="Tag this snapshot" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-snapshot-instructions">Click Tag Icon or Press Enter to Save</div>';
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag snapshot-orange"></div>';
						} 
					echo '</div>';
				echo '</div>';
				?><script type="text/javascript">
    				jQuery(document).ready(function() {
	    				jQuery("#delete-snapshot-<?php echo $design->id; ?>").click(function(){
		    				
		    				var snapshotname = '<?php echo $design->name; ?>';
		    				if (snapshotname == '') snapshotname = 'this';
		    				var snapshotdate = '<?php echo $design_time; ?>';
		    				
           					function delete_confirmation() {
								var answer = confirm("Are you sure you want to permanently delete " + snapshotname + " snapshot taken on " + snapshotdate + "?")
								if (answer){
									
          		             		jQuery.ajax({
                		        	    url:"/wp-admin/admin-ajax.php",
										type:'POST',
										data:'action=deletesnapshot' + datastring,
										success:function(results)
										{ jQuery("#restoresnapshotrow-<?php echo $design->id; ?>").slideUp();}
	                 				});

								} else {

								}
							}

							var snapshotid = <?php echo $design->id; ?>;
							var	datastring = '&id=' + snapshotid;
							delete_confirmation();
						});

	    				jQuery("#restore-tag-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery("#restore-name-<?php echo $design->timestamp; ?>").is(":visible")) { 
							} else {
								jQuery("#restore-name-<?php echo $design->timestamp; ?>").fadeIn().focus();
							}
		    			});
		    			jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(){
			    			var string=jQuery(this).val();	
							if(string.length > 1){
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").show();
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('snapshot-orange');
							} else {
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							}
			    		});
			    		jQuery(".tag-icon-save-<?php echo $design->timestamp; ?>").live('click', function(){
				    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=namesnapshot&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								}
	    					});
			    		});
			    		jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(e){
				    		if (e.which == 13) {
					    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
								jQuery.ajax({
                            		url:"/wp-admin/admin-ajax.php",
									type:'POST',
									data:'action=namesnapshot&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
									success:function(results)
									{
										jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
										jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
										jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
									}
	    						});
							}
			    		});
	    				jQuery("#star-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery(this).hasClass('dashicons-star-empty')) {
			    				jQuery(this).removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
			    				var changeStar = 1;
							} else {
			    				jQuery(this).removeClass('dashicons-star-filled').addClass('dashicons-star-empty');								
			    				var changeStar = 0;
							}
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=updatestarsnapshot&value=' + changeStar + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
								}
	    					});
	    				});
	    				jQuery(".restore-<?php echo $design->timestamp; ?>").click(function(){
		    				jQuery(this).text('Wait...');
		    				var restoreType = jQuery(this).attr('id');
		    				var clickedDiv = jQuery(this);
		    				
	    					jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=restoresnapshot&id=' + <?php echo $revision_id; ?> + '&restoretype=' + restoreType,
								success:function(results)
								{
									jQuery("#restorearea").prepend(results);
									jQuery(clickedDiv).text('Complete!');
									jQuery(clickedDiv).unbind('click');

								}

	    					});
	    				});
	    			});
				</script><?php
			}
			
			echo '</div>'; // end of restoredesignlist
			
			echo '</div>'; // end of restorearea
		
	echo '</div>';
}

function createsnapshot_ajaxpost() {
	global $wpdb;

	// first let's store the design options
	$timestamp = time();
	$saved_options = maybe_serialize(get_theme_mods());
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
		$wpdb->insert( $table_name, 
			array(
					'timestamp' => $timestamp,
					'backup' => $saved_options,
					'userid' => get_current_user_id(),
					'starred' => 0
			),
			array(
					'%d',
					'%s',
					'%d',
					'%d'
			)
		);
		
		$snapshot_id = $wpdb->insert_id;
		
	// now let's find all the widget options and store them
	$widget_options = $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_name LIKE "%widget%" and option_name NOT LIKE "%sno_db%"');
	$table_name_widgets = $wpdb->prefix . 'snowidgetsnapshots';
	foreach ($widget_options as $option) {
		if ($option->option_name != 'dashboard_widget_options') {
			$widgetid = $option->option_id;
			$widgetname = $option->option_name;
			$widgetvalue = $option->option_value;
			$wpdb->insert( $table_name_widgets, 
				array(
					'snapshotid' => $snapshot_id,
					'widgetid' => $widgetid,
					'widgetname' => $widgetname,
					'widgetvalue' => $widgetvalue
				),
				array(
					'%d',
					'%d',
					'%s',
					'%s'
				)
			);
		}
		
	} 

	// let's delete out any unstarred, untagged system snapshots that are more than one month old
	$one_month_ago = $timestamp - 2678400;
	$out_of_date_revisions = $wpdb->get_results( "SELECT * FROM $table_name WHERE timestamp < $one_month_ago AND starred = '0' AND name IS NULL AND userid = '0'" );
		
		foreach( $out_of_date_revisions as $revision) {
			$wpdb->delete( $table_name_widgets, array( 'snapshotid' => $revision->id));
			$wpdb->delete( $table_name, array( 'id' => $revision->id));
		}
	
	die();
}
add_action('wp_ajax_createsnapshot', 'createsnapshot_ajaxpost');

function namesnapshot_ajaxpost() {
	$revision_id = $_POST['id'];
	$revision_name = $_POST['name'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
	
	$wpdb->update( 
		$table_name, 
				array( 'name' => $revision_name ), 
				array( 'id' => $revision_id ),
				array( '%s' ),
				array( '%d' ) 
			);
			
	die();	
}
add_action('wp_ajax_namesnapshot', 'namesnapshot_ajaxpost');

function updatestarsnapshot_ajaxpost() {
	$value = $_POST['value'];
	$revision_id = $_POST['id'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
	$wpdb->update( 
		$table_name, 
				array( 'starred' => $value ), 
				array( 'id' => $revision_id ),
				array( '%d' ),
				array( '%d' ) 
			);
			
	die();	


}
add_action('wp_ajax_updatestarsnapshot', 'updatestarsnapshot_ajaxpost');

// ajax action to restore design snapshot to live version of site
function restoresnapshot_ajaxpost() {
	$revision_id = $_POST['id'];
	$restore_type = $_POST['restoretype'];
	global $wpdb;
	
	// first, let's assume someone clicked this without thinking it through -- we'll make a new snapshot of the current settings before restoring an old one
	
	// let's store the existing design options
	$timestamp = time();
	$saved_options = maybe_serialize(get_theme_mods());
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
		$wpdb->insert( $table_name, 
			array(
					'timestamp' => $timestamp,
					'backup' => $saved_options,
					'userid' => 0,
					'starred' => 0
			),
			array(
					'%d',
					'%s',
					'%d',
					'%d'
			)
		);
		
		$snapshot_id = $wpdb->insert_id;
		
	// let's store the existing widget options
	$widget_options = $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_name LIKE "%widget%" and option_name NOT LIKE "%sno_db%"');
	$table_name = $wpdb->prefix . 'snowidgetsnapshots';
	foreach ($widget_options as $option) {
		if ($option->option_name != 'dashboard_widget_options') {
			$widgetid = $option->option_id;
			$widgetname = $option->option_name;
			$widgetvalue = $option->option_value;
			$wpdb->insert( $table_name, 
				array(
					'snapshotid' => $snapshot_id,
					'widgetid' => $widgetid,
					'widgetname' => $widgetname,
					'widgetvalue' => $widgetvalue
				),
				array(
					'%d',
					'%d',
					'%s',
					'%s'
				)
			);
		}
		
	} 
	
	// now, on with business -- let's restore the design options settings based on the request
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
	$restoration_data = $wpdb->get_row( "SELECT * from $table_name WHERE id = $revision_id");
	if ($restore_type == 'restoreboth' || $restore_type == 'restoredesign') update_option( 'theme_mods_snoflex', maybe_unserialize( $restoration_data->backup ) );
	$restoration_name = $restoration_data->name;
	$restoration_time = $restoration_data->timestamp;
		$gmtOffset=get_option('gmt_offset'); 
		$offset = $gmtOffset * 3600;
		$time = $restoration_time + $offset; 
		$design_time = date("M j, Y, g:i a", $time);
	
	// now let's restore all the widget settings based on the request
	if ($restore_type == 'restoreboth' || $restore_type == 'restorewidgets') {
		$table_name = $wpdb->prefix . 'snowidgetsnapshots';
		$restoration_data = $wpdb->get_results( "SELECT * from $table_name WHERE snapshotid = $revision_id");
		foreach( $restoration_data as $widget ) {
			update_option($widget->widgetname, maybe_unserialize($widget->widgetvalue));
		}
	}
	sno_delete_transients();
	delete_transient( 'sno_custom_css' );
	echo '<div class="updated" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>';
	if ($restoration_name) echo $restoration_name . ' ';
	echo "Design Snapshot from $design_time Activated</p></div>";
	die();	


}
add_action('wp_ajax_restoresnapshot', 'restoresnapshot_ajaxpost');
function deletesnapshot_ajaxpost() {
	$snapshot_id = $_POST['id'];

	global $wpdb;

	$table_name = $wpdb->prefix . 'snowidgetsnapshots';
	$wpdb->delete( $table_name, array( 'snapshotid' => $snapshot_id ) );

	$table_name = $wpdb->prefix . 'snodesignsnapshot';
	$wpdb->delete( $table_name, array( 'id' => $snapshot_id ) );

	die();
}
add_action('wp_ajax_deletesnapshot', 'deletesnapshot_ajaxpost');

function moresnapshots_ajaxpost() {
	$action = $_POST['listtype'];
	$page = $_POST['currentpage'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'snodesignsnapshot';
	$count_query = "select count(*) from $table_name";
	$num = $wpdb->get_var($count_query);
	$limit = 20;
	$where = '';
	$limit_query = '';
	$offset_query = '';
	
	if ($action == 'restorelistnewer') {

			$page = $page - 1;
			$offset = ( $page - 1 ) * $limit;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			$offset_query = "OFFSET $offset";
		
	} else if ($action == 'restorelistolder') {
			$offset = $page * $limit;
			$page = $page + 1;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			$offset_query = "OFFSET $offset";

	} else if ($action == 'restorelistreset') {
			$page = 0;
			$offset = $page * $limit;
			$page = $page + 1;
			$start = $offset + 1;
			$end = $start + ($limit - 1);
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}

	} else if ($action == 'restoreliststarred') {
			
			$offset = 0;
			$page = 1;
			$where = " WHERE starred = '1'";
			$end = $limit;
			if ($num < $limit) $end = $num;
			
	} else if ($action == 'restorelistnamed') {

			$offset = 0;
			$page = 1;
			$where = " WHERE name != ''";
			$end = $limit;
			if ($num < $limit) $end = $num;

	}
	
			
			$design_history = $wpdb->get_results( "SELECT * FROM $table_name $where ORDER BY timestamp DESC $limit_query $offset_query" );

			echo '<div id="restorearea">';
			echo '<div class="restorecontrols">';
				if ($action == 'restoreliststarred') { 
					echo "All Starred Revisions"; 
				} else if ($action == 'restorelistnamed') {
					echo "All Tagged Revisions";
				} else {
					echo "$start-$end of $num Available Revisions";
				}
				if ($action != 'restorelistnamed') echo '<div id="restorelistnamed" class="restorelist restorelisticon dashicons dashicons-tag"></div>';
				if ($action != 'restoreliststarred') echo '<div id="restoreliststarred" class="restorelist dashicons restorelisticon dashicons-star-filled"></div>';
				if ($action == 'restorelistnamed' || $action == 'restoreliststarred') {
					echo '<div id="restorelistreset" class="restorelist restorelistbutton">Full List</div>';
				} else {
					if ($end < $num) echo '<div id="restorelistolder" class="restorelist restorelistbutton">Older</div>';
					if ($page != 1) echo '<div id="restorelistnewer" class="restorelist restorelistbutton">Newer</div>';
				}
				echo '<div class="clear"></div>';
			echo '</div>';
			?><script type="text/javascript">
    			jQuery(document).ready(function() {
	    			jQuery("#create_snapshot").click(function(){
		    			jQuery("#create_snapshot").unbind( "click" );
		    			jQuery(".create_snapshot").text('Saving...Please wait...');
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=createsnapshot',
							success:function(results)
							{
								window.location = '/wp-admin/themes.php?page=design_snapshot&created=true';

							}
	    				});

	    			});				
	    			jQuery(".restorelist").click(function(){
		    			var currentpage = <?php echo $page; ?>;
		    			var restoreaction = this.id;
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=moresnapshots&listtype=' + restoreaction + '&currentpage=' + currentpage,
							success:function(results)
							{
								jQuery("#restorearea").replaceWith(results);
							}
	    				});

	    			});				
	    		});
				
			</script><?php

			echo '<div id="restoresnapshotlist">';
						
			foreach ($design_history as $design) {
				
				$gmtOffset=get_option('gmt_offset'); 
				$offset = $gmtOffset * 3600;
				$time = $design->timestamp + $offset; 
				$revision_id = $design->id;

				$design_time = date("M j, Y, g:ia", $time);
				echo '<div class="restoresnapshotrow" id="restoresnapshotrow-'.$design->id.'">';
					echo $design_time;
					if ($design->userid != 0) {
						$designuser = get_userdata( $design->userid );
						echo " <i>(" . substr($designuser->first_name . " " . $designuser->last_name,0,15) . ")</i>";
					} else {
						echo " <i>(Automated Snapshot)</i>";

					}
					echo '<div class="deletesnapshot dashicons dashicons-dismiss" id="delete-snapshot-'.$design->id.'"></div>';
					echo '<div id="restoreboth" class="restoresnapshot restore-'.$design->timestamp.'">Full Restore</div>';
					echo '<div id="restorewidgets" class="restoresnapshot restore-'.$design->timestamp.'"><span class="extratext">Restore </span>Widgets</div>';
					echo '<div id="restoredesign" class="restoresnapshot restore-'.$design->timestamp.'"><span class="extratext">Restore </span>Design</div>';
					echo '<div class="restorestarred">';
						if ( $design->starred == 0 ) {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-empty"></div>';
						} else {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-filled"></div>';
						}
					echo '</div>';
					echo '<div class="restorename">';
						if ( $design->name == '') {
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="" class="snapshot-name" placeholder="Tag this snapshot" style="display:none;" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-snapshot-instructions">Click Tag Icon or Press Enter to Save</div>';
						} else {
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="'.stripslashes($design->name).'" class="snapshot-name"  placeholder="Tag this snapshot" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-snapshot-instructions">Click Tag Icon or Press Enter to Save</div>';
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag snapshot-orange"></div>';
						} 
					echo '</div>';
				echo '</div>';
				?><script type="text/javascript">
    				jQuery(document).ready(function() {
	    				jQuery("#delete-snapshot-<?php echo $design->id; ?>").click(function(){
		    				
		    				var snapshotname = '<?php echo $design->name; ?>';
		    				if (snapshotname == '') snapshotname = 'this';
		    				var snapshotdate = '<?php echo $design_time; ?>';
		    				
           					function delete_confirmation() {
								var answer = confirm("Are you sure you want to permanently delete " + snapshotname + " snapshot taken on " + snapshotdate + "?")
								if (answer){
									
          		             		jQuery.ajax({
                		        	    url:"/wp-admin/admin-ajax.php",
										type:'POST',
										data:'action=deletesnapshot' + datastring,
										success:function(results)
										{ jQuery("#restoresnapshotrow-<?php echo $design->id; ?>").slideUp();}
	                 				});

								} else {

								}
							}

							var snapshotid = <?php echo $design->id; ?>;
							var	datastring = '&id=' + snapshotid;
							delete_confirmation();
						});

	    				jQuery("#restore-tag-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery("#restore-name-<?php echo $design->timestamp; ?>").is(":visible")) { 
							} else {
								jQuery("#restore-name-<?php echo $design->timestamp; ?>").fadeIn().focus();
							}
		    			});
		    			jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(){
			    			var string=jQuery(this).val();	
							if(string.length > 1){
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").show();
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('snapshot-orange');
							} else {
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							}
			    		});
			    		jQuery(".tag-icon-save-<?php echo $design->timestamp; ?>").live('click', function(){
				    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=namesnapshot&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								}
	    					});
			    		});
			    		jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(e){
				    		if (e.which == 13) {
					    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
								jQuery.ajax({
                            		url:"/wp-admin/admin-ajax.php",
									type:'POST',
									data:'action=namesnapshot&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
									success:function(results)
									{
										jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
										jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
										jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
									}
	    						});
							}
			    		});
	    				jQuery("#star-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery(this).hasClass('dashicons-star-empty')) {
			    				jQuery(this).removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
			    				var changeStar = 1;
							} else {
			    				jQuery(this).removeClass('dashicons-star-filled').addClass('dashicons-star-empty');								
			    				var changeStar = 0;
							}
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=updatestarsnapshot&value=' + changeStar + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
								}
	    					});
	    				});
	    				jQuery(".restore-<?php echo $design->timestamp; ?>").click(function(){
		    				jQuery(this).text('Wait...');
		    				var restoreType = jQuery(this).attr('id');
		    				var clickedDiv = jQuery(this);
		    				
	    					jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=restoresnapshot&id=' + <?php echo $revision_id; ?> + '&restoretype=' + restoreType,
								success:function(results)
								{
									jQuery("#restorearea").prepend(results);
									jQuery(clickedDiv).text('Complete!');
									jQuery(clickedDiv).unbind('click');

								}

	    					});
	    				});
	    			});
				</script><?php
			}
			
			echo '</div>'; // end of restoresnapshotlist
			
			echo '</div>'; // end of restorearea

	die();
}
add_action('wp_ajax_moresnapshots', 'moresnapshots_ajaxpost');

// temp code to flush all transients on update because of changed widget styles
function snoupdate_713() {
	$flush_transient = get_option('flex730_flush');
	if ( $flush_transient != '6' ) {
		sno_delete_transients();
		delete_transient( 'sno_custom_css' );
		update_option( 'flex730_flush', '6');
//		update_option( 'menu_icons_logger_flag', 'no');
	}
}
add_action( 'wp_head', 'snoupdate_713' );

function sno_theme_header_scripts()
{
    wp_register_script( 'flex-jquery', get_template_directory_uri() . '/javascript/jquery.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'flex-jquery');

    wp_register_script( 'flex-flexslider-script', get_template_directory_uri() . '/tools/flexslider/jquery.flexslider.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-flexslider-script');

    wp_register_script( 'flex-jquery-visible', get_template_directory_uri() . '/javascript/jquery-visible.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-jquery-visible');
 
    wp_register_script( 'flex-hoverintent', get_template_directory_uri() . '/tools/superfish/js/hoverintent.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-hoverintent');

    wp_register_script( 'flex-superfish', get_template_directory_uri() . '/tools/superfish/js/superfish.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-superfish');

    wp_register_script( 'flex-supersubs', get_template_directory_uri() . '/tools/superfish/js/supersubs.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-supersubs');

    wp_register_script( 'flex-scrollfix', get_template_directory_uri() . '/javascript/jquery-scrolltofixed-min.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-scrollfix');

    wp_register_script( 'flex-remodal', get_template_directory_uri() . '/javascript/remodal.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-remodal');

    wp_register_script( 'flex-cycle', get_template_directory_uri() . '/javascript/jquery.cycle.all.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-cycle');

    wp_register_script( 'flex-bnticker', get_template_directory_uri() . '/javascript/jcarousellite_1.0.1c4.js' );
    wp_enqueue_script( 'flex-bnticker');
    
    wp_register_script( 'flex-menus', get_template_directory_uri() . '/javascript/menus-init.js', array( 'jquery' ) );
    wp_enqueue_script( 'flex-menus');
    
}
add_action( 'wp_enqueue_scripts', 'sno_theme_header_scripts' );
function sno_theme_header_styles()
{
    wp_register_style( 'flex-parallax', get_template_directory_uri() . '/parallax/css/main.css', array(), '20180212', 'all' );
    wp_enqueue_style( 'flex-parallax' );

    wp_register_style( 'flex-flexslider', get_template_directory_uri() . '/tools/flexslider/flexslider.css', array(), '20180207', 'all' );
    wp_enqueue_style( 'flex-flexslider' );

    wp_register_style( 'flex-superfish', get_template_directory_uri() . '/tools/superfish/css/superfish.css', array(), '20180207', 'all' );
    wp_enqueue_style( 'flex-superfish' );

    wp_register_style( 'flex-remodal', get_template_directory_uri() . '/javascript/remodal.css', array(), '20180207', 'all' );
    wp_enqueue_style( 'flex-remodal' );

    wp_register_style( 'flex-remodal-default', get_template_directory_uri() . '/javascript/remodal-default-theme.css', array(), '20180207', 'all' );
    wp_enqueue_style( 'flex-remodal-default' );

    wp_register_style( 'flex-stylesheet', get_template_directory_uri() . '/style.css', array(), '20181207', 'all' );
    wp_enqueue_style( 'flex-stylesheet' );

}
add_action( 'wp_enqueue_scripts', 'sno_theme_header_styles' );

function sno_get_opacity_code($opacity){
	switch ($opacity) {
		case "1":
			$opacity = "ff";
			break;
		case ".9":
			$opacity = "cc";
			break;
		case ".8":
			$opacity = "aa";
			break;
		case ".7":
			$opacity = "99";
			break;
		case ".6":
			$opacity = "88";
			break;
		case ".5":
			$opacity = "77";
			break;
		case ".4":
			$opacity = "66";
			break;
		case ".3":
			$opacity = "44";
			break;
		case ".2":
			$opacity = "33";
			break;
		case ".1":
			$opacity = "22";
			break;
		case "0":
			$opacity = "00";
			break;			
	}
	return $opacity;
}

add_action( 'publish_future_post', 'sno_delete_transients' );

function sno_get_staff_profile_preview($postid, $attached_ids = null) {
	wp_reset_query();

	$template = get_post_meta($postid, 'sno_format', true);

	switch($template) {
		case "Classic":
			if (get_theme_mod('sp-classic') != "On") return;
			break;
		case "Full-Width":
			if (get_theme_mod('sp-fullwidth') != "On") return;
			break;
		case "Side Rails":
			if (get_theme_mod('sp-siderails') != "On") return;
			break;
		case "Side by Side":
			if (get_theme_mod('sp-sidebyside') != "On") return;
			break;
		case "Side by Side Chapter":
			if (get_theme_mod('sp-sidebyside') != "On") return;
			break;
		case "Grid":
			if (get_theme_mod('sp-grid') != "On") return;
			break;
		case "Grid Chapter":
			if (get_theme_mod('sp-grid') != "On") return;
			break;
		case "Long-Form":
			if (get_theme_mod('sp-longform') != "On") return;
			break;
		case "Long-Form Chapter":
			if (get_theme_mod('sp-longform') != "On") return;
			break;
			
	}
	$credit_label = ''; $credit_label_count = array();
	$credits = array();
	$existing_bylines = sno_get_all_bylines();
	
	// let's clean out any spaces jokers might have added to byline names
	foreach ($existing_bylines as $key => $byline) $existing_bylines[$key] = trim($byline); 

	$pagelink = sno_staff_profile_link();
	
	$including_chapters = array();
	$including_chapters[] = $postid;
	if (is_array($attached_ids)) foreach ($attached_ids as $attached_chapter) $including_chapters[] = $attached_chapter;
	
	foreach ($including_chapters as $postid) {
		$writers = get_post_meta($postid, 'writer', false);
		foreach ($writers as $writer) {
			if (in_array($writer, $existing_bylines)) {
				$credits[]=$writer;
				$credit_label = 'Writer';
				$credit_label_count['writer'] = 'On';
			}
		}
		if (get_theme_mod('sp-hide-videographer') != 'Exclude') {
			$videographers = get_post_meta($postid, 'videographer', false);
			foreach ($videographers as $videographer) {
				if (in_array($videographer, $existing_bylines)) {
					$credits[]=$videographer;
					if ($credit_label == '') $credit_label = 'Videographer';
					$credit_label_count['videographer'] = 'On';
				}
			}
		}
		if (get_theme_mod('sp-hide-photographer') != 'Exclude') {
			$photos = get_attached_media('image', $postid);
			foreach ($photos as $photo) {
				$photographer = get_post_meta($photo->ID, 'photographer', true);
				if (in_array($photographer, $existing_bylines)) {
					$credits[]=$photographer;
					if ($credit_label == '') $credit_label = 'Photographer';
					$credit_label_count['photographer'] = 'On';
				}
			}
		}
	}
	if (count($credit_label_count) > 1) $credit_label = 'Contributor';

	$credits = array_unique($credits);

	if (count($credits) > 0) {
		$plural = ''; $tile_class = "storycreditboxwide";
		if (count($credits) > 1) { $plural = 's'; $tile_class = "storycreditbox"; }
		echo '<div class="aboutwriter">';
		$heading = get_theme_mod('sp-label-text');
		if ($heading == "Automatic") {
			echo "<div class='aboutwritertitle'>About the $credit_label$plural</div>"; // add option to change this text and option to add plural
		} else if ($heading == "Custom") {
			echo "<div class='aboutwritertitle'>" . get_theme_mod('sp-label-custom') . "</div>"; // add option to change this text and option to add plural
		}
		foreach ($credits as $credit) {
			if ($credit != '') {
					$credit = trim ($credit); 
					$transient_name = str_replace(' ', '_', $credit); 
					$transient_name = str_replace("'", "", $transient_name);
					$transient_name = str_replace("\\", "", $transient_name);
					$transient_id = 'sno_sp_mini_' . $transient_name;
					$transient = get_transient( $transient_id );
														
					if( ! empty( $transient )) {  
						
						echo "\n<!-- profile displayed from cache -->\n";
						echo $transient;
				
					} else {
						$output = '';
						global $wpdb;
						
						$profile_name = stripslashes($credit);
						$profile_name = str_replace( "'", "''", $profile_name );
						
						$querystr = "SELECT * FROM $wpdb->posts JOIN $wpdb->postmeta AS name ON($wpdb->posts.ID = name.post_id AND name.meta_key = 'name' AND name.meta_value LIKE '%$profile_name%') AND $wpdb->posts.post_status = 'publish' ORDER BY post_date DESC LIMIT 1";
						 $staffprofiles = $wpdb->get_results($querystr, OBJECT);
						if ($staffprofiles) { 
							foreach ($staffprofiles as $profile) {
								setup_postdata($profile);
								$output .= "<div class='$tile_class'>";
									$excerpt_type = get_theme_mod('sp-excerpt');
									if ($excerpt_type == "Automatic Excerpt" || "Formatted Excerpt") {
										$excerpt_length = get_theme_mod('sp-excerpt-length');
										if (!is_numeric($excerpt_length)) $excerpt_length = 150;
										$bio = nl2br(get_the_content_limit($excerpt_length, ''));
										
									} else if ($excerpt_type == "Full Profile") {
										$bio = nl2br($profile->post_content);
									}
									$name = $credit;
									$title = get_post_meta($profile->ID, 'staffposition', true);
											
									// need to add an option for forced horizontal images -- tsmediumblock 
									// or uncropped images -- small
									$photo_size = "tsmediumblock";
									if (get_theme_mod('sp-photo-size') != "Force Horizontal") $photo_size = "medium";
									$photo = wp_get_attachment_image_src(get_post_thumbnail_id($profile->ID), $photo_size, false)[0];
									
									$text_width = '';												
									if ($photo && get_theme_mod('sp-photo') != 'Hide') {
										$output .= "<div class='sc_photo'><img src='$photo'/></div>";
									} else {
										$text_width = " style='width:100%;'";
									}
									// add option to show title or not
									$output .= "<a href='" . $pagelink . "?writer=" . urlencode($name) . "'>";
										$output .= "<div class='sc_title'>$name, $title</div>";
									$output .= "</a>";
											
									// add option to show full bio, shortened bio (with option for character limit), or no bio
									$output .= "<div class='sc_bio'$text_width>$bio<div class='clear'></div></div>";

								$output .= '</div>';
							} 

						}
						
						echo $output;
						set_transient( $transient_id, $output, MONTH_IN_SECONDS );

					}
			}
		}
		echo '<div class="clear"></div>';
		echo '</div>';
	}
	wp_reset_query();
}

function sno_custom_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'sno_custom_excerpt_more' );

// adding WP admin page for managing design snapshots
add_action('admin_menu', 'staff_profile_order_create', 11);
function staff_profile_order_create() {
	$sno_staff_panel_override = get_option('sno_staff_panel');
	if ($sno_staff_panel_override) { 
		$sno_staff_panel = $sno_staff_panel_override;
	} else {
		$sno_staff_panel = '2';	
	}
	$mf_slug = $sno_staff_panel + 5;

	$parent_slug = $mf_slug . '.php';
    $page_title = 'Staff Profile Order';
    $menu_title = 'Staff Profile Order';
    $capability = 'edit_posts';
    $menu_slug = 'staffpage_order';
    $function = 'staffpage_order_page';
    $position = 24;

    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url=null, $position );
}

// function that creates the guts of the staff profile order page
function staffpage_order_page() {
	echo '<div class="wrap">';
		echo '<h1>Staff Profile Order</h1>';
		
		echo '<div class="staffprofilepage"><h1>Staff Profile Order</h1>';
		echo '<p>Use the drag and drop interface below to <b>order your staff profiles by staff position</b>.  The list of staff positions contains only staff positions used by staff members assigned to the current year. The individual <b>staff profiles within each position can also be reordered</b> -- to do this, click the profile icon on the right side of a staff position.  Archived staff pages can be ordered based on individual staff profiles only. <b>Changes are saved instantly</b> upon dropping them into a new location.</p>';
			
			$currentyear = date("Y"); 
			$currentmonth = date("m"); 
		
			if (get_theme_mod('staffpage-custom') == 'Activate') {
				$seasoncheck = get_theme_mod('staffpage-year');
				$thisyear = $seasoncheck;
			} else {
				$resetmonth = get_theme_mod('staff-reset');
				if ($resetmonth == '') $resetmonth = '07';
				if ($currentmonth >= $resetmonth) {
					$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
				} else {
					$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
				} 
				$thisyear = $seasoncheck; 
			}

			$staffpage_years = get_active_staffpage_years();
			echo '<div class="staffpage_wrap">';
		
			echo '<div class="staffpages_list_wrap">';
				echo '<ul class="pagesavailable connectedSortableSteps ui-sortable">';
				foreach ($staffpage_years as $page) {
					$activeyear = ''; $current_year = " data-current-year='false'";
					if ($page == $thisyear) { $activeyear = ' year-selected'; $current_year = " data-current-year='true'";}
					echo "<li data-year='$page' class='profile_year$activeyear'$current_year>$page</li>";
				}
				echo '</ul>';
			echo '</div>';
			
			echo '<div class="staffpage-options">';

				// let's only show profile roles that exist for the current year's students
				global $wpdb;
				$querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS schoolyear ON(
					$wpdb->posts.ID = schoolyear.post_id
					AND schoolyear.meta_key = 'schoolyear'
					AND schoolyear.meta_value LIKE '%$thisyear%'
					)
					JOIN $wpdb->postmeta AS staffposition ON(
					$wpdb->posts.ID = staffposition.post_id
					AND staffposition.meta_key = 'staffposition'
					)
					AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'draft' OR $wpdb->posts.post_status = 'pending')
					ORDER BY staffposition.meta_value DESC


				";
				$posts = $wpdb->get_results($querystr, OBJECT);
				$current_roles = array();
				foreach ($posts as $profile) $current_roles[] = trim($profile->meta_value);
				$profile_roles = array_reverse(array_unique($current_roles));

				
				
				echo '<div class="staffposition_list_wrap">';
					echo '<ul class="rolesavailable connectedSortableSteps ui-sortable">';
					// retrieve saved order for profile roles
					$role_order = get_option('sno_staffpage_role_order');
					if ($role_order) {
						foreach ($role_order as $role) {
							if (in_array($role, $profile_roles)) echo "<li data-role='$role' class='profile_role'><div class='elusive el-icon-resize-vertical staffmove'></div>$role<div class='list_staff_members elusive el-icon-group'></div></li>";
							if (($key = array_search($role, $profile_roles)) !== false) { unset($profile_roles[$key]); }
						}
					} else {
						// if the role order hasn't been set yet, this sets it.
						$new_roles = array();
						foreach ($profile_roles as $role) {
							$new_roles[] = $role;
						}
						update_option('sno_staffpage_role_order', $new_roles);
						update_option('sno_staff_ordering_active', 'on');
					}
					// this is for any roles that were added after the role order was previously saved
					foreach ($profile_roles as $role) {
						echo "<li data-role='$role' class='profile_role'><div class='elusive el-icon-resize-vertical staffmove'></div>$role<div class='list_staff_members elusive el-icon-group'></div></li>";
					}
					echo '</ul>';
				echo '</div>';
				echo '<div class="profile_list_wrap staffoptions-hidden">';
					echo '<ul class="profilesavailable"></ul>';
				echo '</div>';
			echo '</div>';
			
			echo '</div>';
		?><script type="text/javascript">
					jQuery(function() {
						
						jQuery(".profile_year").click(function(){
							var clicked = this;
							var target_ul = '';
							if (jQuery(".staffposition_list_wrap ul").hasClass('profilesavailable')) { 
								target_ul = 'profilesavailable';
							} else {
								target_ul = 'rolesavailable';
															}
							var year = encodeURIComponent(jQuery(this).closest('li').attr('data-year'));
							var datastring = '';
							datastring = '&staffgroup=' + year + '&targetul=' + target_ul;
								jQuery.ajax({
		   							url:"/wp-admin/admin-ajax.php",
		   							type:'POST',
		   							data:'action=getstaffmembers' + datastring,
		   							success:function(results)
		   							{ 	
			   							
			   							jQuery(".staffposition_list_wrap ul." + target_ul).replaceWith(results);
			   							jQuery(clicked).closest('ul').find('.year-selected').removeClass('year-selected');
			   							jQuery(clicked).closest('li').addClass('year-selected');
			   							jQuery(".profile_list_wrap").addClass('staffoptions-hidden').find('ul').empty();
			   							liststaffmembers();
				   						makeprofilessortable();
				   						makerolessortable();
									}
								});
						});
						
						function liststaffmembers(){
							jQuery(".list_staff_members").click(function(){
								var clicked = this;
								var staffPosition = encodeURIComponent(jQuery(this).closest('li').attr('data-role'));
								var datastring = '';
								datastring = '&staffposition=' + staffPosition;
									jQuery.ajax({
			   							url:"/wp-admin/admin-ajax.php",
			   							type:'POST',
			   							data:'action=getstaffmembers' + datastring,
			   							success:function(results)
			   							{ 	
				   							jQuery("ul.profilesavailable").replaceWith(results); 
				   							jQuery(clicked).closest('ul').find('.role-selected').removeClass('role-selected');
				   							jQuery(clicked).closest('li').addClass('role-selected');
				   							jQuery(".profile_list_wrap").removeClass('staffoptions-hidden');
				   							makeprofilessortable();
										}
									});
							});
						}
						liststaffmembers();
						
						function makerolessortable(){
							jQuery( ".rolesavailable" ).sortable({
								connectWith: ".connectedSortableSteps",
								items: "li.profile_role",
								placeholder: "profile_placeholder",
							//	handle: ".staffmove",
								axis: "y",
								update: function() {
									var profileOrder = jQuery(".rolesavailable").find('li').map(function(){ return encodeURIComponent(jQuery(this).attr('data-role')); }).get();
									var datastring = '';
									var datastring = "&roleorder=" + profileOrder;
									jQuery.ajax({
			   							url:"/wp-admin/admin-ajax.php",
			   							type:'POST',
			   							data:'action=updatestafforder' + datastring,
			   							success:function(results)
			   							{ 		 
										}
									});
		        				},
								start: function(e, ui){
									ui.placeholder.height(ui.item.height());
		    					}
							});
						}
						makerolessortable();

						function makeprofilessortable(){
							jQuery( ".profilesavailable" ).sortable({
								connectWith: ".connectedSortableProfiles",
								items: "li.profile_name",
								placeholder: "profile_placeholder",
							//	handle: ".staffmove",
								axis: "y",
								update: function() {
									var profileOrder = jQuery(".profilesavailable").find('li').map(function(){ return encodeURIComponent(jQuery(this).attr('data-postid')); }).get();
									var staffPosition = jQuery(".profilesavailable").attr('data-role');
									var staffYear = jQuery(".profilesavailable").attr('data-year');
									var datastring = '';
									var datastring = "&profileorder=" + profileOrder + "&staffposition=" + staffPosition + "&staffyear=" + staffYear;
									jQuery.ajax({
			   							url:"/wp-admin/admin-ajax.php",
			   							type:'POST',
			   							data:'action=updateprofileorder' + datastring,
			   							success:function(results)
			   							{ 		 
										}
									});
		        				},
								start: function(e, ui){
									ui.placeholder.height(ui.item.height());
		    					}
							});
						}


					});
		</script><?php
		echo '<div class="clear"></div>';
		echo '</div>';
		
		

		
	echo '</div>';
}

function updatestafforder_ajaxpost() {
	$new_order = explode(',', $_POST['roleorder']);
	update_option('sno_staffpage_role_order', $new_order);
	update_option('sno_staff_ordering_active', 'on');
	die();
}
add_action('wp_ajax_updatestafforder', 'updatestafforder_ajaxpost');

function updateprofileorder_ajaxpost() {
	$new_order = explode(',', $_POST['profileorder']);
	$staffposition = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['staffposition']);
	$staffyear = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['staffyear']);
	if ($staffyear && $staffposition) {
		update_option('sno_staffpage_' . $staffyear . '_' . $staffposition, $new_order);
	} else {
		update_option('sno_staffpage_'.$staffyear, $new_order);
	}
	update_option('sno_staff_ordering_active', 'on');
	die();
}
add_action('wp_ajax_updateprofileorder', 'updateprofileorder_ajaxpost');

function getstaffmembers_ajaxpost() {
	$staffposition = $_POST['staffposition'];
	
	
	$currentyear = date("Y"); 
	$currentmonth = date("m"); 

	if (get_theme_mod('staffpage-custom') == 'Activate') {
		$seasoncheck = get_theme_mod('staffpage-year');
		$thisyear = $seasoncheck;
	} else {
		$resetmonth = get_theme_mod('staff-reset');
		if ($resetmonth == '') $resetmonth = '07';
		if ($currentmonth >= $resetmonth) {
			$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
		} 
		$thisyear = $seasoncheck; 
	}
	
		global $wpdb;
	$sp_query = '';
	$target_ul_class = "profilesavailable";
	if (isset($_POST['staffgroup']) && $_POST['staffgroup'] == $thisyear ) {
	

				// let's only show profile roles that exist for the current year's students
				global $wpdb;
				$querystr = "
					SELECT * FROM $wpdb->posts
					JOIN $wpdb->postmeta AS schoolyear ON(
					$wpdb->posts.ID = schoolyear.post_id
					AND schoolyear.meta_key = 'schoolyear'
					AND schoolyear.meta_value LIKE '%$thisyear%'
					)
					JOIN $wpdb->postmeta AS staffposition ON(
					$wpdb->posts.ID = staffposition.post_id
					AND staffposition.meta_key = 'staffposition'
					)
					AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'draft' OR $wpdb->posts.post_status = 'pending')
					ORDER BY staffposition.meta_value DESC


				";
				$posts = $wpdb->get_results($querystr, OBJECT);
				$current_roles = array();
				foreach ($posts as $profile) $current_roles[] = trim($profile->meta_value);
				$profile_roles = array_reverse(array_unique($current_roles));

				echo '<ul class="rolesavailable connectedSortableSteps ui-sortable">';
					// retrieve saved order for profile roles
					$role_order = get_option('sno_staffpage_role_order');
					if ($role_order) {
						
						
						foreach ($role_order as $role) {
							if (in_array($role, $profile_roles)) echo "<li data-role='$role' class='profile_role'><div class='elusive el-icon-resize-vertical staffmove'></div>$role<div class='list_staff_members elusive el-icon-group'></div></li>";
							if (($key = array_search($role, $profile_roles)) !== false) { unset($profile_roles[$key]); }
						}
					} else {
						
						$new_roles = array();
						foreach ($profile_roles as $role) {
							$new_roles[] = $role;
						}
						updatestafforder($new_roles);
					}
					// this is for any roles that were added after the role order was previously saved
					foreach ($profile_roles as $role) {
						// output roles that aren't yet stored in database
						echo "<li data-role='$role' class='profile_role'><div class='elusive el-icon-resize-vertical staffmove'></div>$role<div class='list_staff_members elusive el-icon-group'></div></li>";
					}
				echo '</ul>';

		die();
	} else if (isset($_POST['staffgroup']) && $_POST['staffgroup'] != $thisyear ) {
		$thisyear = $_POST['staffgroup'];
		$target_ul_class = "profilesavailable";
		$existing_sort = $thisyear;
	} else {
		$sp_query = "
				JOIN $wpdb->postmeta AS staffposition ON(
				$wpdb->posts.ID = staffposition.post_id
				AND staffposition.meta_key = 'staffposition'
				AND staffposition.meta_value = '$staffposition'
				) ";
		$existing_sort = $staffposition;
	}
	$target_data_year = " data-year='$thisyear'";
	// current school year for staff page
 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS schoolyear ON(
				$wpdb->posts.ID = schoolyear.post_id
				AND schoolyear.meta_key = 'schoolyear'
				AND schoolyear.meta_value LIKE '%$thisyear%'
				)
				$sp_query
				JOIN $wpdb->postmeta AS name ON(
				$wpdb->posts.ID = name.post_id
				AND name.meta_key = 'name'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY post_date DESC
				";

 			$master_profiles = $wpdb->get_results($querystr, OBJECT);
 			$no_profiles = true;
 			
 			
 			echo "<ul class='$target_ul_class connectedSortableProfiles ui-sortable' data-role='$staffposition'$target_data_year>";
 				
 				$staff_profile_order = get_option('sno_staffpage_'.preg_replace("/[^a-zA-Z0-9]+/", "", $thisyear) . '_' . preg_replace("/[^a-zA-Z0-9]+/", "", $existing_sort));

	 			if ( count($staff_profile_order) > 0 ) {
		 			foreach ($staff_profile_order as $profile) {
			 			foreach ($master_profiles as $key => $master_profile) {
				 			if ($master_profile->ID == $profile) {
					 			$profile_name = $master_profile->meta_value;
					 			unset($master_profiles[$key]);
					 		}
			 			}
			 			if ($profile != 'undefined') echo '<li data-postid="' . $profile . '" class="profile_name"><div class="elusive el-icon-resize-vertical staffmove"></div>' . $profile_name . ' <a target="_blank" href="/wp-admin/post.php?post=' . $profile . '&action=edit">Edit</a></li>';
			 			$no_profiles = false;
		 			}
		 			
		 		}
 			
	 			if ( count($master_profiles) > 0 ) {
		 			foreach ($master_profiles as $profile) {
			 			echo '<li data-postid="' . $profile->ID . '" class="profile_name"><div class="elusive el-icon-resize-vertical staffmove"></div>' . $profile->meta_value . ' <a target="_blank" href="/wp-admin/post.php?post=' . $profile->ID . '&action=edit">Edit</a></li>';
			 			$no_profiles = false;
			 		}
	
		 		} 
			 	
			 	if ($no_profiles == true) echo "Ah, snap, you don't have any staff members assigned to this role yet.";
		 		
		 	echo '</ul>';
	
	die();
}
add_action('wp_ajax_getstaffmembers', 'getstaffmembers_ajaxpost');

function get_active_staffpage_years() {

	$currentyear = date("Y"); 
	$currentmonth = date("m"); 

	if (get_theme_mod('staffpage-custom') == 'Activate') {
		$seasoncheck = get_theme_mod('staffpage-year');
		$thisyear = $seasoncheck;
	} else {
		$resetmonth = get_theme_mod('staff-reset');
		if ($resetmonth == '') $resetmonth = '07';
		if ($currentmonth >= $resetmonth) {
			$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
		} else {
			$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
		} 
		$thisyear = $seasoncheck; 
	}
	
			
	global $wpdb;
	$querystr = "
		SELECT * FROM $wpdb->posts
		JOIN $wpdb->postmeta AS schoolyear ON(
		$wpdb->posts.ID = schoolyear.post_id
		AND schoolyear.meta_key = 'schoolyear'
		AND schoolyear.meta_value != ''
		)
		AND $wpdb->posts.post_status = 'publish'
		ORDER BY schoolyear.meta_value ASC
		";
		 	
	$pageposts = $wpdb->get_results($querystr, OBJECT);
				
		if ($pageposts): 
			foreach ($pageposts as $post):
				$schoolyear = $post->meta_value;
				$schoolyear = explode('"', $schoolyear); 
				$possible_years = sno_staff_organization_list();
							
				if (is_array($schoolyear)) { 								
					foreach ($schoolyear as $single) {
								
						if (in_array($single,$possible_years)) $datelist[] = $single;
					} 
				}
			endforeach; 
		else : endif; 
				
		if (is_array($datelist)) {

			sort($datelist);
			$datelist = array_unique($datelist);		
					
			if (get_theme_mod('staffpage-custom') != 'Activate') {  // removing any custom groups if that feature has been deactivated
				foreach ($datelist as $k => $v) {
					if(preg_match("/[a-z]/i", $v)){
						unset ($datelist[$k]);
					}
				}
			} 		

		}
		
		// if the current year is not yet in the array, add it
		
		if (!in_array($thisyear, $datelist)) $datelist[] = $thisyear; 
		$datelist = array_reverse($datelist);
		
		// if the current year is not first in the array, move it
		if ( in_array($thisyear,$datelist ) ) {
			$key = array_search($thisyear, $datelist); 
			unset($datelist[$key]);
			array_unshift($datelist,$thisyear);
  		}		

	
	return $datelist;
}

function mastercolorchange_ajaxpost() {
	
	$old_color = $_POST['oldcolor'];
	$new_color = $_POST['newcolor'];
	$all_theme_mods = get_theme_mods(); 
	$color_array = array(); 
	
	// let's store a copy of the existing theme mods into the revision history of the SNO Design Options Page
	global $wpdb;
	$timestamp = time();
	$saved_options = maybe_serialize($all_theme_mods);
	$table_name = $wpdb->prefix . 'snodesignoptions';
	$wpdb->insert( $table_name, 
		array(
				'timestamp' => $timestamp,
				'backup' => $saved_options,
				'userid' => get_current_user_id(),
				'starred' => 0
		),
		array(
				'%d',
				'%s',
				'%d',
				'%d'
		)
	);
	
	// loop through all the theme mods and change color when appropriate
	foreach ($all_theme_mods as $theme_mod => $theme_mod_value) {
		if (substr($theme_mod_value, 0, 1) === '#' && strpos($theme_mod, 'override') === false && $theme_mod_value == $old_color) {
			$all_theme_mods[$theme_mod] = $new_color;					
		}
	}
	
	// resave the theme options
	update_option( 'theme_mods_snoflex', $all_theme_mods );
	
	// now we need to have it update all custom colors in widgets
	// we're only going to do this, though, if the strings are the same length so that we don't mess up serialized arrays.
	if (strlen($old_color) == strlen($new_color)) {

		$widget_options = $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_name LIKE "%widget%" and option_name NOT LIKE "%sno_db%"');
		
		// loop through each retrieved widget (option in the options table) and do a find and replace
		foreach ($widget_options as $widget) {
			$widget_values = str_replace($old_color, $new_color, $widget->option_value);
			
			// store the updated widget data
			update_option($widget->option_name, maybe_unserialize( $widget_values ));
			
		} 
	}
	
	
	die();	


}
add_action('wp_ajax_mastercolorchange', 'mastercolorchange_ajaxpost');

// adding WP admin page for master color page
add_action('admin_menu', 'sno_master_colors');
function sno_master_colors() {
	$parent_slug = 'themes.php';
    $page_title = 'Master Colors';
    $menu_title = 'Master Colors';
    $capability = 'edit_theme_options';
    $menu_slug = 'master_colors';
    $function = 'master_color_page';
    $icon_url = 'dashicons-art';
    $position = 24;

    add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

// function that creates the guts of the master color page
function master_color_page() {
	echo '<div class="wrap">';
		
		echo '<div class="designsnapshotintro"><h2>Welcome to the SNO Master Color Control Panel!</h2>';
		echo '<p>Throughout the <a href="/wp-admin/themes.php?page=theme-options" target="_blank">SNO Design Options page</a> and the settings for individual widgets, there are hundreds of different options for controlling individual colors.  The Master Color Controls allow you to quickly change all instances of a single color to a new color.  Below is a list of all the colors currently in use on this site.  To change all options using that color, click into the color field, select a new color, and then click the "Apply Color Change" button.  That\'s it -- all changes are saved and implemented instantly.</p><p><b>NOTE:</b> <i>Before making any changes here, create a new <a href="/wp-admin/themes.php?page=design_snapshot" target="_blank">Design Snapshot</a> so that you can easily revert to old colors.';
		
		echo '</div>';
				echo '<div id="snocolorpicker"></div>';

		
			echo '<div id="colorlist">';

						
				$all_theme_mods = get_theme_mods(); $color_array = array(); $color_labels_array = array();
				foreach ($all_theme_mods as $theme_mod => $theme_mod_value) {
					if (substr($theme_mod_value, 0, 1) === '#' && strlen($theme_mod_value) == 7 && strpos($theme_mod, 'override') === false) {
						if (!in_array($theme_mod_value, $color_array)) $color_array[$theme_mod_value]++;
						if (isset($color_labels_array[$theme_mod_value])) $color_labels_array[$theme_mod_value] .= ', ';
						$color_labels_array[$theme_mod_value] .= $theme_mod;
					
					}
				}
				global $wpdb;
				$widget_options = maybe_unserialize( $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_name LIKE "%widget%" and option_name NOT LIKE "%sno_db%"' ));
				foreach ($widget_options as $widget_option) {
					$widget_type = maybe_unserialize( $widget_option->option_value );
					
					
					foreach ($widget_type as $widget_instance) {
						foreach ($widget_instance as $k => $v) {
							if ($v[0] == "#" && strlen($v) == 7) {
								if (!in_array($v, $color_array)) {
									$color_array[$v]++;
									if (isset($color_labels_array[$v]) && strstr($color_labels_array[$v], 'Widget Options') ) {} else {
										if (isset($color_labels_array[$v])) $color_labels_array[$v] .= ', ';
										$color_labels_array[$v] .= 'Assorted Widget Options';
									}
								}
							}
						}
					}
				}
				echo '<br /><br />All colors used:<br />';
				
				// need to remove any color that's not 7 digits
				arsort ($color_array);
				foreach ($color_array as $color => $usage) {
					$times = 'instance';
					if ($usage > 1) $times = 'instances';
					echo '<div class="colorlistitem">';
						echo "<div class='colorlistbox'><input type='text' data-old-value='$color' maxlength='7' size='7' value='$color' class='colorwell changecolors' /> $usage $times";
						echo '<span class="dashicons dashicons-info colorinfo-instances"><span class="color-use-info" style="display:none;">'.$color_labels_array[$color].'</span></span>';
						echo "</div>";
						echo "<div class='applycolor' data-old-value='$color'>Apply Color Change</div><br />";
					echo '</div>';
					echo '<div class="clear"></div>';
				}
			?><script type="text/javascript">

    			jQuery(document).ready(function() {

	    			jQuery('.changecolors').on('click', function(){
		    			if (jQuery(this).closest('.colorlistitem').find('.applycolor').is(':visible')) {} else { jQuery(".applycolor").fadeOut(); }
		    			if (jQuery(this).closest('.colorlistitem').find('.color-use-info').is(':visible')) {} else { jQuery(".color-use-info").fadeOut(); }
		    			jQuery(this).parents().siblings('.applycolor').text('Apply Color Change').fadeIn();
	    			});
	    			jQuery('.colorinfo-instances').click(function(){
		    			if (jQuery(this).find('.color-use-info').is(':visible')) {
		    				jQuery(".color-use-info").hide();
		    				return;
		    			} else {
			    			jQuery(".color-use-info").hide();
			    	//		jQuery(this).find('.color-use-info').fadeIn();
			    			jQuery(this).closest('.colorlistitem').find('.color-use-info').fadeIn();
			    			jQuery('.applycolor').fadeOut();
			    			jQuery('.changecolors').blur();
		    			}
	    			});
	    			jQuery(".applycolor").click(function(){
		    			var clicked = this;
		    			var oldcolor = jQuery(this).attr('data-old-value');
		    			var newcolor = jQuery(this).siblings('.colorlistbox').find('input').val();
		    			// require that new color start with # and be an actual color code
		    			var checkColor  = /^#[0-9A-F]{6}$/i.test(newcolor)
		    			
		    			if (checkColor !== true) {
			    			alert ("Please use a valid 6 digit hex color code that starts with #.")	
			    			return;
						}
						if (oldcolor == newcolor) {
			    			alert ("The old color is the same as the new one. Change the color and try again.")	
			    			return;
						}
						jQuery.ajax({
	                       	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=mastercolorchange&oldcolor=' + oldcolor + '&newcolor=' + newcolor,
							success:function(results)
							{
								jQuery(clicked).text('Color successfully changed!').delay(2000).fadeOut();
								jQuery(clicked).attr('data-old-value', newcolor);
								jQuery(clicked).siblings('.colorlistbox').find('input').attr('data-old-value', newcolor);
								jQuery(clicked).siblings('.colorlistbox').find('input').val(newcolor);
							}
		    			});

	    			});				
	    		});
	    	</script><?php
			
			
			echo '</div>'; // end of colorlist
		
	echo '</div>';
}

function get_best_of_sno_badge($custom_fields) {
	if (isset($custom_fields['best_of_sno'])) $best_of_sno = $custom_fields['best_of_sno'][0]; 
	$logo_path = get_theme_mod('bos-logo') == "White" ? "boslogo-white.png" : "boslogo.png" ;
	if ($best_of_sno) {
		echo "<div class='bestofsno-badge'><a href='https://bestofsno.com/?p=$best_of_sno' target='_blank'>";
			echo "<img src='" . get_template_directory_uri() . "/images/$logo_path' />";
		echo "</a></div>";
		echo "<div class='clear'></div>";
	}	
}

function sno_before_story() {
	do_action('sno_before_story');
}

function sno_remove_block_cf() {
	$blocks_cleared = get_option('sno_block_cf_cleared');
	if ($blocks_cleared != '3') {
		global $wpdb;
		$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->postmeta WHERE meta_value LIKE 'block-editor'");
		update_option('sno_block_cf_cleared', '3');
	}
}

add_action('admin_init', 'sno_remove_block_cf');
