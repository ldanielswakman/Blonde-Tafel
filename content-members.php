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

        <a href="javascript:toggleMemberDetail()" id="members_mask" class="u-pincover bg-white u-z3 isVisible">
          <div class="container clearfix u-aligncenter">
            <div class="twelvecol">
            </div>
          </div>
        </a>

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
          </div>
      
          <div class="members container clearfix u-aligncenter">

          <?php
          foreach ($members as $member) :
            if (intval($member->active) != 0) :
              $img_obj = wp_get_attachment_image_src( $member->event_image, 'thumbnail');
              $img_url = (strlen($img_obj[0]) > 0) ? $img_obj[0] : get_bloginfo( 'stylesheet_directory' ) . '/images/fabric.png';
              ?>
              <div href="#<?php echo $member->post_name ?>" id="<?php echo $member->post_name ?>" onclick="javascript:toggleMemberDetail($(this))" class="member member-detail u-mt20 u-aligncenter">
                <img src="<?php echo $img_url ?>" alt="<?php echo $member->post_title ?>" />
                <span class="name"><?php echo $member->post_title ?></span>

                <div class="member__details">
                  <div class="container twelvecol">
                    <div class="threecol"></div>
                    <div class="sixcol">

                      <span class="title">
                        <?php echo $member->job_title ?>
                      </span>
                      <?php if (strlen($member->employer) > 1): ?>
                        <small class="employer">(<?php echo $member->employer ?>)</small>
                      <?php endif ?>

                      <div class="u-mt10">
                        <?php if(count($member->linkedin_url) > 0 && substr($member->linkedin_url,0,4) === "http") { ?>
                          <a href="<?php echo $member->linkedin_url ?>" target="_blank" class="member__meta u-mh5">Linkedin</a>
                        <?php } if(count($member->twitter_url) > 0 && substr($member->twitter_url,0,4) === "http") { ?>
                          <a href="<?php echo $member->twitter_url ?>" target="_blank" class="member__meta u-mh5">Twitter</a>
                        <?php } ?>
                      </div>
                      
                    </div>
                    <div class="threecol"></div>
                  </div>
                  <div class="container twelvecol u-mt20">
                    <div class="threecol"></div>
                    <div class="sixcol u-alignleft">
                      <?php echo wpautop($member->bio) ?>
                    </div>
                    <div class="threecol"></div>
                  </div>
                </div>
              </div>
            <?php 
            endif;
          endforeach; 
          ?>

          </div>

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
