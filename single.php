<?php get_header(); ?>

	<div id="content">
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'content', get_post_format() ); ?>
			
		<?php endwhile; // end of the loop. ?>
		
	</div>
	<!--/content -->
	
<?php get_footer(); ?>