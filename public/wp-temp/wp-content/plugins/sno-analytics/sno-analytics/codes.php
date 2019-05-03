<?php

function sno_analytics_footer() {

	$options = get_option('sno_analytics_options');

	if ($options['sno_site_analytics_activate'] == 'on') { ?>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php echo $options['sno_site_analytics_code']; ?>', 'auto');
			ga('require', 'displayfeatures');
			ga('send', 'pageview');
		</script> 	
		
	<?php }

}

add_action('wp_footer', 'sno_analytics_footer');
?>