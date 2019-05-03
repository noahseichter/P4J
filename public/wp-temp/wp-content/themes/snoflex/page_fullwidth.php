<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<div id="content" class="fullwidth">

	<div id="contentleft">
	
		<div class="postarea page-<?php echo get_the_ID(); ?>" style="padding:1.5%;">
				
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $title=get_post_meta($post->ID, 'title', true); if (!$title) { ?><h1><?php the_title(); ?></h1><?php } ?>
		
			<?php the_content(__('[Read more]'));?>
		 			
			<?php endwhile; else: ?>
			
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
						
		</div>
		
	</div>
	
</div>

<!-- The main column ends  -->

<?php get_footer(); ?>