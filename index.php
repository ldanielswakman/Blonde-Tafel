<?php get_header(); ?>

	<div id="content">

		<?php
			$args = array(
				'post_type' => 'page',
				'post_parent' => '0',
				'order' => 'ASC',
				'orderby' => 'menu_order');
			query_posts($args);

		if ( have_posts() ) :

			while (have_posts()) : the_post(); ?>
			<?php if(!in_array(get_the_title(), array("Contact"))) { ?>
			<section id="<?php echo strtolower(preg_replace('/\s+/', '', get_the_title())); ?>">
				<div class="container twelvecol clearfix">
					<h2><?php the_title(); ?></h2>

					<?php if(in_array(get_the_title(), array("Lidmaatschap"))) { ?>
						<div style="text-align: center;">
							<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/join.png" alt="" />
						</div>
					<?php } ?>

				    <?php the_content(); ?>

					<?php if(in_array(get_the_title(), array("Agenda"))) { ?>
						<ul class="container clearfix">
						<?php
						$args = array(
							'post_type' => 'event',
							'showposts' => '3',
							'meta_key' => 'event_date',
							'meta_compare' => '>=',
							'meta_value' => date('Y-m-d'),
							'orderby' => 'event_date',
							'order' => 'ASC',
						);
						$event_query = new WP_Query($args);
						while ($event_query->have_posts()) : $event_query->the_post(); ?>
							<li class="event fourcol">
								<a href="<?php the_permalink(); ?>" class="event-link">
									<div class="calendar">
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
						<a href="<?php echo home_url('/agenda/archief/'); ?>" class="button-box">&larr; Archief</a>
						<a href="<?php echo home_url('/agenda/full/'); ?>" class="button-box">Volledige agenda &rarr;</a>
					<?php } ?>

					<?php if(in_array(get_the_title(), array("Impressie"))) : ?>
					<div class="flexslider">
						<ul class="slides">
							<?php
							$args = array(
								'post_type' => 'carousel',
								'orderby' => 'meta_value_num',
								'order' => 'ASC',
								'meta_key' => 'carousel_order',
		            'post_status' => 'publish'
							);
							$carousel_query = new WP_Query($args);
							while ($carousel_query->have_posts()) : $carousel_query->the_post();
								$title = get_the_title();
								$photographer = get_post_meta(get_the_ID(), 'photographer', true);
								$image = wp_get_attachment_image_src( get_post_meta(get_the_ID(), 'carousel_image', true), 'large'); ?>
								<li>
									<?php echo ($photographer) ? '<div class="descr"> Foto: ' . $photographer . "</div>" : ''; ?>
									<img alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo $image[0]; ?>">
								</li>
							<?php endwhile; ?>
						</ul>
					</div>

					<div class="flexslider-preloader">
						<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/preloader.gif" alt="" /><br />
						de afbeeldingen in de carousel worden geladen...
					</div>

					<!-- calls flexslider script immediately after photo carousel -->
					<script>
						$(window).load(function() {
							$('.flexslider').flexslider({
								animation: "slide",
								smoothHeight: false,
								slideshow: true,
								slideshowSpeed: 4000,
								animationSpeed: 500,
								animationLoop: true,
								pauseOnAction: true,
								pauseOnHover: true,
								useCSS: true,
								touch: true,
								prevText: "",
								nextText: "",
								start: function() {
									$('#impressie .flexslider-preloader').hide();
									$('.flexslider').fadeIn();
								}
							});
						});
					</script>
					<?php endif; ?>
				</div>

				<div class="clearfloat"></div>

			</section>
			<?php } ?>

			<?php endwhile; ?>

		<?php else : ?>

			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something odd...</p>

		<?php endif; ?>
	</div>
	<!--/content -->

<?php get_footer(); ?>
