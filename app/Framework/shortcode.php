<?php
function getNewItems($atts) {
  extract(shortcode_atts(array(
    "num" => '',	//最新記事リストの取得数
    "cat" => ''	//表示する記事のカテゴリー指定
  ), $atts));
  global $post;
  $oldpost = $post;
  $custom_post_slug_name = 'history';
  $myposts = get_posts(
    'post_type=' . $custom_post_slug_name .
    '&numberposts=' . $num .
    '&order=DESC&orderby=post_date&taxonomy=' . $custom_post_slug_name .
    '&term=' . $cat
  );
  $retHtml='';
  foreach($myposts as $post) :
    setup_postdata($post);
    $retHtml.='<div class="description">';
    $retHtml.='<h3>' . the_title("","",false) . '</h3>';
    $retHtml.='<div class="copy">';
    $retHtml.='<small>' . get_post_meta($post->ID, 'project-date', true) . '</small>';
    $retHtml.= get_the_content();
    $retHtml.='</div>';
    $retHtml.='</div>';
  endforeach;
  $post = $oldpost;
  wp_reset_postdata();
  return $retHtml;
}
add_shortcode("bloglist", "getNewItems");