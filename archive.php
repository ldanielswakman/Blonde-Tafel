<?php
/**
 * Template name: Event Archives
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php get_header(); ?>

	<div id="content">
		<section id="archief">
			<div class="container clearfix centre">
				<div class="twocol">
					<a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']) . "#agenda"; ?>" class="button-box" style="margin-top: 1em;">&larr; Terug</a>
				</div>
				<div class="eightcol">
					<h2>archief agenda</h2>
				</div>
			</div>
			<ul class="container clearfix">
				<?php 
				$args = array(
					'post_type' => 'event',
					'meta_key' => 'event_date',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'meta_compare' => '<',
					'meta_value' => date('Y-m-d'),
					'orderby' => 'event_date',
				);
				query_posts($args);
				while (have_posts()) : the_post(); ?>
					<li class="event fourcol">
						<a href="<?php the_permalink(); ?>" class="event-link">
							<div class="calendar" style="background-image: url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/calendar_dark.png');">
								<!--<div class="banner" style="background: url('<?php echo wp_get_attachment_url( get_post_meta(get_the_ID(), 'event_image', true), 'large'	 ); ?>'); background-size: cover; background-position: center;"></div>-->
								<?php $date = strtotime(get_post_meta(get_the_ID(), 'event_date', true)); ?>
								<span class="cal-date-dm"><?php echo date("d M", $date); ?></span>
								<span class="cal-date-y"><?php echo date("Y", $date); ?></span>
							</div>
							<h3><?php the_title(); ?></h3>
							<div class="descr">
								<?php
									$descr_full = get_post_meta(get_the_ID(), 'eventdescription', true);
									$descr_trimmed = wp_trim_words( $descr_full, $num_words = 12);
									echo $descr_trimmed;
								?>
							</div>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			
		</section>
		
	</div>
	<!--/content -->
	
<?php get_footer(); ?>