<?php
/**
 * Template name: Signup Form Template
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php get_header(); ?>

	<div id="content">

			<section class="single-header" id="inschrijven">
				
				<div class="container twelvecol clearfix">
					<h2><?php the_title(); ?></h2>
				</div>
				
				<div class="container twelvecol clearfix">
					<div class="onecol"></div>
					<div class="tencol">
						<?php the_content(); ?>
					</div>
					<div class="onecol last"></div>
				</div>
				
			</section>
		
	</div>
	<!--/content -->
	
<?php get_footer(); ?>