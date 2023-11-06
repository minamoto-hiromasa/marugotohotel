<?php
function makeSnsLinks($snsName) {
  $snsHtml = '';
  $page = get_page_by_path("general", OBJECT, "content-settings");
  if(get_field('link-' . $snsName, $page->ID)) {
    $snsHtml =
      '<a href="' . get_field('link-' . $snsName, $page->ID) .'" class="' . $snsName . '" target="_blank" rel="noopener noreferrer">
      <img src="' . get_template_directory_uri() . '/assets/public/images/logo-' . $snsName . '.svg" alt="' . $snsName . '"/></a>';
  }
  return $snsHtml;
}