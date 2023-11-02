<?php
  function getSinglePageBySlug($the_slug) {
    $args = array(
      'name'        => $the_slug,
      'post_type'   => 'page',
      'post_status' => 'publish',
      'numberposts' => 1
    );
    $my_posts = get_posts($args);
    if( $my_posts ) :
      return $my_posts[0];
    endif;
  }

  function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
  }

  function isPageAnchor($url) {
    $keyword = 'http';
    if (strpos($url, $keyword) === false) {
      return true;
    }
    return false;
  }

  function isCampaignAvailable() {
    $campaignID = get_id_by_slug('campaign');
    if (get_field('campaign-available', $campaignID)) {
      return get_field('campaign-available', $campaignID);
    } else {
      return false;
    }
  }

  function keyVisualLink($arg) {
    $homeID = get_id_by_slug('home');
    if (isCampaignAvailable() && !is_page('home')) { return ''; }
    if (!get_field('key-visual-url', $homeID)) { return ''; }
    if ($arg === 'open') {
      $anchorHtml = '<a href="' . get_field('key-visual-url', $homeID) . '">';
    } else {
      $anchorHtml = '</a>';
    }
    return $anchorHtml;
  }