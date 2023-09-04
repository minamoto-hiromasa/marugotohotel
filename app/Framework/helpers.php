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