<?php

function members_preview( $atts ) {

  $html = '';
  $n = (isset($atts['aantal'])) ? (int)$atts['aantal'] : 3;

  $members = get_posts(array(
    'post_type' => 'member',
    'orderby' => 'rand',
    'posts_per_page' => $n,
    'post_status' => 'publish'
  ));

  $html .='<div class="bestuur container clearfix u-aligncenter">';
  foreach ($members as $member) :
    $html .= '<div class="member member-small fourcol u-mt20">';
    $img_url = (strlen(wp_get_attachment_image_src( $member->event_image, 'thumbnail')[0]) > 0) ? wp_get_attachment_image_src( $member->event_image, 'thumbnail')[0] : get_bloginfo( 'stylesheet_directory' ) . '/images/fabric.png';
    $html .= '<img src="' . $img_url . '" alt="' . $member->post_title  . '" />';
    $html .= '<span class="name">' . $member->post_title . '<br /><small><i>' . $member->job_title . '</i></small></span>';
    $html .= '</div>';
  endforeach;
  $html .= '</div>';

  return $html;
}
add_shortcode('leden-preview', 'members_preview');
