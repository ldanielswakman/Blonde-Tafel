            <footer>
                
                <?php query_posts('pagename=contact');
                if ( have_posts() ) :
                    while (have_posts()) : the_post(); ?>
                    
                <section id="<?php echo strtolower(preg_replace('/\s+/', '', get_the_title())); ?>">
                    <div class="container twelvecol clearfix centre">
                        <h2><?php the_title(); ?></h2>
                        
                        <?php the_content(); ?>
                        
                        <!-- DISABLED LOGIN BUTTON - MIGHT RETURN IF CLIENT WANTS IT --- <a href="<?php /* echo admin_url(); */ ?>" class="" style="float: right;" target="_blank">login</a>-->
                    </div>
                    
                    <div class="container twelvecol clearfix centre">
                        <div class="twocol"></div>
                        <div class="eightcol colofon">
                            <a href="http://www.ldaniel.eu/" target="_blank">website designed by L Daniel Swakman</a>
                        </div>
                        <div class="twocol"></div>
                    </div>
                
                </section>
                
                <?php endwhile; ?>
                
                <?php else : ?>
                
                    <h2>Not Found</h2>
                    <p>Sorry, but you are looking for something odd...</p>
                    
                <?php endif; ?>
            
            </footer>


        </div><!-- end wrapper --->
        
    </body>
    
</html>