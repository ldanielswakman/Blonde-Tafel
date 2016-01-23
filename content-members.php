<?php
/**
 * Template name: Members list Template
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php get_header(); ?>

  <div id="content">

      <section class="bg-btapurple u-pt100 u-pb50 u-mt0 u-mb0">
        
        <div class="container twelvecol clearfix u-mt50 u-mb20">
          <h2 class="c-white u-aligncenter"><?php the_title(); ?></h2>
        </div>
        
        <div class="container twelvecol clearfix">
          <div class="onecol"></div>
          <div class="tencol">
            <?php the_content(); ?>
          </div>
          <div class="onecol last"></div>
        </div>

      </section>

      <section id="alle_leden" class="u-relative u-mt50">

        <div id="members_mask" class="u-pincover bg-white u-z3">
          <div class="container clearfix u-aligncenter">
            <div class="twelvecol">
              testing
            </div>
          </div>
        </div>

        <?php
        $members = get_posts(array(
          'post_type' => 'member',
          'orderby' => 'title',
          'order' => 'ASC',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        ));

        if (!empty($members)) :
        ?>
          <div class="container clearfix">
            <p class="fourcol u-relative" style="margin-left: 15%;">
              <input id="membersearch" type="text" name="q" placeholder="Zoek..." class="input-grey u-mt0 u-mb0"/>
              <a id="membersearch_clear" class="button-box button-box-small"></a>
            </p>
            <p class="sixcol members-sorting">
              <small>Sorteer op 
                <a class="button-box button-box-small highlight" data-sort="random">WILLEKEURIG</a>
                <a class="button-box button-box-small" data-sort="name">NAAM</a>
                <a class="button-box button-box-small" data-sort="title">TITEL</a>
              </small>
            </p>
            <!-- <p class="fourcol"><small>Filter <small><button class="active">ALLE</button> | <button>ACTIEF</button> | <button>NIET ACTIEF</button></small></small></p> -->
            <!-- <p class="fourcol members-layout"><small>Toon als <small><button class="active" data-layout="fitRows">GRID</button> | <button data-layout="vertical">LIJST</button></small></small></p> -->
          </div>
      
          <div class="members container clearfix u-aligncenter">

          <?php
          foreach ($members as $member) :
            $img_url = (strlen(wp_get_attachment_image_src( $member->event_image, 'thumbnail')[0]) > 0) ? wp_get_attachment_image_src( $member->event_image, 'thumbnail')[0] : get_bloginfo( 'stylesheet_directory' ) . '/images/fabric.png';
          ?>
            <a href="#<?php echo $member->post_name ?>" id="<?php echo $member->post_name ?>" onclick="javascript:openMemberDetail($(this))" class="member u-mt20 u-aligncenter">
              <img src="<?php echo $img_url ?>" alt="<?php echo $member->post_title ?>" />
              <span class="name"><?php echo $member->post_title ?></span><span class="title"><?php echo $member->job_title ?></span>
            </a>
          <?php endforeach; ?>

          </div>

          <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/isotope.pkgd.min.js"></script>
          <script>
            var qsRegex;

            // isotope init
            var $container = $('.members').isotope({
              itemSelector: '.member',
              layoutMode: 'fitRows',
              sortBy: 'random',
              getSortData: {
                name: '.name',
                title: '.title'
              },
              filter: function() {
                return qsRegex ? $(this).text().match( qsRegex ) : true;
              }
            });

            // isotope sorting
            $('.members-sorting a').bind('click', (function(e) {
              $('.members-sorting a').removeClass('highlight');
              $(this).addClass('highlight');
              $container.isotope({
                sortBy: $(this).attr('data-sort'),
                sortAscending: true,
                filter: function() {
                  return qsRegex ? $(this).text().match( qsRegex ) : true;
                }
              });
            }));

            // ----------- Search FUNCTION --------//
            // use value of search field to filter
            var $quicksearch = $('#membersearch').bind('keyup change', (debounce( function() {
              qsRegex = new RegExp( $quicksearch.val(), 'gi' );
              $container.isotope();
              if($quicksearch.val().length > 0) {
                $quicksearch.addClass('hasContent');
              } else {
                $quicksearch.removeClass('hasContent');
              }
            })));

            $('#membersearch_clear').bind('click', (function(e) {
              $('#membersearch').val('');
              qsRegex = new RegExp( $quicksearch.val(), 'gi' );
              $container.isotope();
              if($quicksearch.val().length > 0) {
                $quicksearch.addClass('hasContent');
              } else {
                $quicksearch.removeClass('hasContent');
              }
            }));

            // debounce so filtering doesn't happen every millisecond
            function debounce( fn, threshold ) {
              var timeout;
              return function debounced() {
                if ( timeout ) {
                  clearTimeout( timeout );
                }
                function delayed() {
                  fn();
                  timeout = null;
                }
                timeout = setTimeout( delayed, threshold || 100 );
              }
            }

          </script>

        <?php
        else: 
        ?>
        <div class="u-mt50">
          <p><i>Er zijn op dit moment geen toonbare leden gevonden.</i></p>
        </div>
        <?php endif; ?>

      </section>
    
  </div>
  <!--/content -->
  
<?php get_footer(); ?>
