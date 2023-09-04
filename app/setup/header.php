<?php
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
function description_in_nav_menu( $item_output, $item, $depth, $args ){
  $link_name = "link-" . get_field("icon_name", $item->ID);
  return preg_replace(
    '/<(a.*?)>([^<]*?)</',
    "<$1>$2" . "<div class={$link_name}></div><span class='sub-title'>{$item->attr_title}</span><",
    $item_output
  );
}