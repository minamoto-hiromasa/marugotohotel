<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php

    // WordPress 5.2 wp_body_open implementation
    // if ( function_exists( 'wp_body_open' ) ) {
    //     wp_body_open();
    // } else {
    //     do_action( 'wp_body_open' );
    // }
    $menuID = "main-menu";
    $mainMenu = wp_get_nav_menu_items($menuID);
    $navHtml = '<div id="main-menu">';
    foreach($mainMenu as $item){
      $navHtml .= '<a class="' . str_replace("#", "menu-", $item -> url) . '" href="' . $item -> url . '"><span>' . $item -> title . '</span></a>';
    }
    $navHtml .= '</div>';
?>
  <div class="wrapper">
    <div id="sticky-wrap" class="sticky-wrap">
      <div id="body-content" class="body-content">
        <header class="mobile-header">
          <div class="logo"></div>
          <button class="toggle-menu">
            <span class="burger"></span>
          </button>
        </header>
        <aside class="side-nav" data-sticky-container>
          <div class="side-stick" data-sticky data-btm-anchor="content-wrap:bottom">
            <img class="logo" src="<?php echo get_template_directory_uri()?>/assets/public/images/logo.svg"
              alt="沿線まるごと HOTEL PROJECT" srcset="">
            <nav>
              <div class="nav-inner">
                <a href="#body-content" class="tag-new-wrap">
                  <span class="tag-new-inner">
                    <span class="tag-new">NEW!</span>
                    <b>期間限定ツアー</b>
                  </span>
                </a>
                <a href="#mobility-service" class="has-dash" href="">駅発着！<b>モビリティレンタル</b></a>
                <a href="#guide-package" class="has-dash">土日限定！<b>ガイドツアー</b></a>
                <a href="#cycle-guide-a">ツアーA</a>
                <a href="#cycle-guide-b">ツアーB</a>
                <a href="#cycle-guide-c">ツアーC</a>
              </div>
              <a class="fake-link" href="#section-limited-tour"><span></span></a>
              <?php echo $navHtml; ?>
              <a href="https://www.facebook.com/ensenmarugoto" class="facebook" target="_blank">
                <img src="<?php echo get_template_directory_uri()?>/assets/public/images/logo-facebook.svg"
                  alt="facebook" />
              </a>
            </nav>
          </div>
        </aside>
        <div id="content-wrap" class="content-wrap">
          <?php
            $page = get_page_by_path("key-visual-pc", OBJECT, "key-visual");
            $content = apply_filters('the_content', $page->post_content);
            echo $content;
          ?>
          <?php
            $page = get_page_by_path("key-visual-sp", OBJECT, "key-visual");
            $content = apply_filters('the_content', $page->post_content);
            echo $content;
          ?>