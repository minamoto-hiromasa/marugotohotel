<?php
  function change_posts_per_page($query){
    if ( is_admin() || ! $query->is_main_query() ) {
      return;
    }
    if ( $query->is_post_type_archive() ) {
        $query->set( 'posts_per_page', '-1' );
    }
  }
  // add_action( 'pre_get_posts', 'change_posts_per_page' );

  function my_wpseo_title($title) {
    if (is_front_page()) {
      return get_bloginfo();
    }
      return $title;
  }
  // add_filter('wpseo_title', 'my_wpseo_title');