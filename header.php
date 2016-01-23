<!DOCTYPE html>

<html lang="en">
    
    <head>
        
        <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="L Daniel Swakman, www.ldaniel.eu" />
        <meta charset="utf-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        
        <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <!--<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.ico">-->
        <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.js"></script>
				<!--[if lt IE 9]>
				<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/IE9.js"></script>
				<![endif]-->
        <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.scrollto.js"></script>
				<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.flexslider.js"></script>
				<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.anchor.js"></script>
        <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/isotope.pkgd.min.js"></script>
        <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/scripts.js"></script>
		
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  
			ga('create', 'UA-9833982-19', 'deblondetafelamsterdam.nl');
			ga('send', 'pageview');
		</script>
		
    </head>
    
    <body <?php body_class(); ?>>
		
        <div id="wrapper">
			
			<header>
                <div class="container">
					<?php if (is_home()) {
							$homelink = "";
						} else {
							$homelink = home_url() . "/";
						} ?>
                    <h1 class="fourcol"><a href="<?php echo $homelink . "#intro"; ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png" alt="" class="logo" /></a></h1>
                    
                    <?php $args = array(
						'post_type' => 'page',
						'order' => 'ASC',
						'post_parent' => '0',
            'orderby' => 'menu_order'
						);
						query_posts($args);
                    
                    if ( have_posts() ) : ?>
                    
                        <nav class="eightcol last">
							<ul>
                        
							<?php while (have_posts()) : the_post(); if(!in_array(get_the_title(), array("Intro"))) { ?>
								<li><a href="<?php echo $homelink . "#" . strtolower(preg_replace('/\s+/', '', get_the_title())); ?>"><?php the_title(); ?></a></li>
							<?php } endwhile; ?>
                        
							</ul>
							
							<a href="javascript:void(0)" class="menubutton"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/menubutton.png" alt="" /></a>
						</nav>
                        
                    <?php endif; wp_reset_query(); ?>
                    
                    <div class="clearfloat"></div>
					
					<div class="viewport-width-flag"></div>
					
                </div>
            </header>
			
	<!--/header -->