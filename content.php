<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

			<?php
				$post_img = get_post_meta( $post->ID, 'event_image', 'true' );
				$post_date = get_post_meta( $post->ID, 'event_date', 'true' );
				$post_descr = get_post_meta( $post->ID, 'eventdescription', 'true' );
			?>

			<section class="single-header" id="<?php echo strtolower(preg_replace('/\s+/', '', get_the_title())); ?>">
			
				<div class="container twelvecol clearfix">
					<div class="twocol">
						<a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']) . "#agenda"; ?>" class="button-box" style="margin-top: 2em;">&larr; Terug</a>
					</div>
					<div class="onecol">
						<div class="calendar small">
							<?php $date = strtotime($post_date); ?>
							<span class="cal-date-dm"><?php echo date("d M", $date); ?></span>
							<span class="cal-date-y"><?php echo date("Y", $date); ?></span>
						</div>
					</div>
					<div class="ninecol last">
						<h2><?php the_title(); ?></h2>
					</div>
					
				</div>
				
				<div class="clearfloat"></div>
				
			</section>
			
			<section class="single-content">
				<div class="container twelvecol clearfix">
					<div class="twocol"></div>
					<div class="eightcol">
						
						<img src="<?php echo wp_get_attachment_url($post_img, 'full'); ?>" />
						
						<div class="descr"><?php echo wpautop( $post_descr ); ?></div>
						
					</div>
					<div class="twocol last"></div>
				</div>
				
			</section>