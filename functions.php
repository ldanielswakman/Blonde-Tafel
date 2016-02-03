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
    $img_obj = wp_get_attachment_image_src( $member->event_image, 'thumbnail');
    $img_url = (strlen($img_obj[0]) > 0) ? $img_obj[0] : get_bloginfo( 'stylesheet_directory' ) . '/images/fabric.png';
    $html .= '<img src="' . $img_url . '" alt="' . $member->post_title  . '" />';
    $html .= '<span class="name">' . $member->post_title . '<br /><small><i>' . $member->job_title . '</i></small></span>';
    $html .= '</div>';
  endforeach;
  $html .= '</div>';

  return $html;
}
add_shortcode('leden-preview', 'members_preview');


function members_statistics( $atts ) {
  // set attribute defaults
  $atts = shortcode_atts(
    array(
      'ledenaantal' => 'ja',
      'leeftijd' => 'ja',
      'beroepen' => 'ja',
      'lidtijd' => 'ja',
    ), $atts, 'leden-statistieken' );

  // count amount of stats to be displayed
  $count = count($atts);
  foreach ($atts as $att) { if($att == 'nee') { $count--; } }
  switch ($count) {
    case 4:
      $colsize = "threecol";
      break;
    case 3:
      $colsize = "fourcol";
      break;
    case 2:
      $colsize = "sixcol";
      break;
    default:
      $colsize = "twelvecol";
      break;
  }

  // retrieve members
  $members = get_posts(array(
    'post_type' => 'member',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'post_status' => 'publish'
  ));

  // collecting data from members
  $member_ages = array();
  $member_joindates = array();
  $member_active_count = 0;
  $member_titles = array();
  $minJoinDate = 2008;
  
  foreach ($members as $member) {
    if (intval($member->active) != 0) {
      $member_active_count += intval($member->active);
      // if a birth date is set & produces valid output, add to average queue
      if (strlen($member->birthdate) > 0 && date("d/m/Y", strtotime($member->birthdate)) != '01/01/1970') { 
        $member_ages[] = strtotime($member->birthdate);
      }
      // if a join date is set & produces valid output, add to average queue
      if (strlen($member->join_date) > 0 && intval($member->join_date) > $minJoinDate) {
        $member_joindates[] = strtotime("01-01-" . intval($member->join_date));
      }
      if (strlen($member->job_title) > 0 && !in_array($member->job_title, $member_titles)) {
        $member_titles[] = $member->job_title;
      }
    }
  }

  // build html
  $html = '';
  if ($count > 0) {
    $html .= '<div class="memberstats container twelvecol clearfix u-aligncenter u-mt50 u-mb20">';
    if ($atts['ledenaantal'] != 'nee') {
      $html .= '<div class="' . $colsize . ' u-pv10">';
      $html .= '<div class="value">' . $member_active_count . '</div>';
      $html .= '<p><label>actieve leden</label></p>';
      $html .= '</div>';
    }
    if ($atts['leeftijd'] != 'nee') {
      $html .= '<div class="' . $colsize . ' u-pv10">';
      $html .= '<div class="value">' . calcAvgDate($member_ages) . '</div>';
      $html .= '<p><label>gemiddelde leeftijd</label></p>';
      $html .= '</div>';
    }
    if ($atts['beroepen'] != 'nee') {
      $html .= '<div class="' . $colsize . ' u-pv10">';
      $html .= '<div class="value">' . count($member_titles) . '</div>';
      $html .= '<p><label>verschillende beroepen</label></p>';
      $html .= '</div>';
    }
    if ($atts['lidtijd'] != 'nee') {
      $html .= '<div class="' . $colsize . ' u-pv10">';
      $html .= '<div class="value">' . calcAvgDate($member_joindates) . '</div>';
      $html .= '<p><label>gemiddeld aantal jaren lid</label></p>';
      $html .= '</div>';
    }
    $html .= '</div>';
  }

  return $html;
}
add_shortcode('leden-statistieken', 'members_statistics');


/*
* Calculate Average Date
* 
* param @date (array) array of unix timestamp dates
* return @average (int) average in years, 1 decimal
* 
*/
function calcAvgDate( $date_array ) {
  $avg_date = 0;
  if (is_array($date_array) && !empty($date_array)) {
    // calculate average timestamp
    $avg_timestamp = array_sum($date_array) / count($date_array);
    //and convert to average age in years, then add month as decimal
    $avg_date = date("Y") - date("Y", $avg_timestamp);
    $avg_date += round((date("m") - date("m", $avg_timestamp))/12, 1);
  }
  return $avg_date;
}
