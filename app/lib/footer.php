<?php

function getSponserContent() {
  $config = include get_template_directory() . '/app/config/variables.php';
  $page = get_page_by_path("general", OBJECT, "content-settings");
  $icons = get_post_meta( $page->ID, 'sponser-icon');
  $links = get_post_meta( $page->ID, 'sponser-link');
  $forCampaigns = get_post_meta( $page->ID, 'for-campaign');
  if (empty($icons)) {
    return '';
  }
  $html = '<div class="sponsers">';
  for ($i=0; $i < count($icons); $i++) {
    $icon = $icons[$i];
    $forCampaign = $forCampaigns[$i];
    $link = $links[$i];
    if (!is_page($config['campaignPageSlug']) && $forCampaign) {
      continue;
    }
    if (empty($icon)) {
      continue;
    }
    if (!empty($links)) {
      $html .=
        '<a href="' . $link . '" target="_blank"
        rel="noopener noreferrer">';
    }
    $html .=
      '<img src="' . wp_get_attachment_url($icon) . '"
      alt="' . get_post_meta($icon, '_wp_attachment_image_alt', true) . '">';
    if (!empty($links)) {
      $html .= '</a>';
    }
  }
  $html .= '</div>';
  return $html;
}