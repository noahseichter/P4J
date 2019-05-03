<?php
/*

@author: Lewis A. Sellers <lasellers@gmail.com>
@date: 8/2015
*/

/* */
function snosc_getorpost($parm,$default='')
{
	if(isset($_POST[$parm])) return trim($_POST[$parm]);
	if(isset($_GET[$parm])) return trim($_GET[$parm]);
	return $default;
}

/*

*/
function snosc_related_stories_callback() {
	global $wpdb;

	$q = snosc_getorpost('q','');
	$max_length = snosc_getorpost('max_length',20);
	$max_length=intval($max_length);

	if($q=='')
		$query = "
	SELECT ID,post_title
	FROM $wpdb->posts
	where post_type='post' AND post_status='publish'
	ORDER BY post_date DESC;";
	else
		$query = "
	SELECT ID,post_title
	FROM $wpdb->posts
	where post_type='post' AND post_status='publish' AND post_title LIKE '%$q%'
	ORDER BY post_date DESC;";

	$posts = $wpdb->get_results($query, OBJECT);

	$stories=array();
	foreach($posts as $post)
	{
		if(strlen($post->post_title)>$max_length)
		{
			/* if title lenth > max_length break into whole words boundry and add ... at end */
			$title="";
			$a=explode(" ",$post->post_title);
			foreach($a as $s)
			{
				if(strlen($title)+strlen($s)<$max_length)
				{
					$title.=" $s"; 
				}
				else
				{
					$title.="...";
					break;
				}
			}
		}
		else
		{
			$title=$post->post_title;
		}
		$stories[]=$post->ID."\t".$title;
	}
	echo json_encode($stories);
	wp_die();
}
add_action( 'wp_ajax_related_stories', 'snosc_related_stories_callback' );
?>