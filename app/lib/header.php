<?php
function makeSnsLinks($snsName) {
  $snsHtml = '';
  $page = get_page_by_path("general", OBJECT, "content-settings");
  if(get_field('link-' . $snsName, $page->ID)) {
    $link = get_field('link-' . $snsName, $page->ID);
    $snsHtml =
      '<a href="#"
        onclick="window.open(' . '\'' . $link . '\'' . ');return false;"
        class="' . $snsName . '">
      <img src="' . get_template_directory_uri() . '/assets/public/images/logo-' . $snsName . '.svg" alt="' . $snsName . '"/></a>';
  }
  return $snsHtml;
}