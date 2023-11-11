<?php

function getSponserContent() {
  $config = include get_template_directory() . '/app/config/variables.php';
  $config['campaignPageSlug'];
  echo '>>> ' . is_page('campaign');
  echo '<br>';
  $page = get_page_by_path("general", OBJECT, "content-settings");
  // var_dump(get_post_meta( $page->ID, 'sponser-icon'));
  // var_dump(get_post_meta( $page->ID, 'sponser-link'));
  // var_dump(get_post_meta( $page->ID, 'sponseruse'));
  // echo wp_get_attachment_url($img);
  // $sponserHtml = '<div class="sponsers">';
}