<?php get_header(); ?>



<div id="content">



	<div id="contentleft" class="page_template">

	

		<div class="postarea page-<?php echo get_the_ID(); ?>">
			
						
			<?php if (have_posts()) : while (have_posts()) : the_post(); global $post; ?>

			<?php $title=get_post_meta($post->ID, 'title', true); if (!$title) { ?><h1><?php the_title(); ?></h1><?php } ?>

			<?php the_content(__('Read more'));?><div style="clear:both;"></div>

			<?php endwhile; else: ?>


			

			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>

		

		</div>

		

	</div>

	

<?php include(TEMPLATEPATH."/sidebar.php");?>

		

</div>



<!-- The main column ends  -->



<?php get_footer(); ?>