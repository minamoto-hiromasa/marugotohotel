<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <script type="text/javascript" src="//code.typesquare.com/static/ZDbTe4IzCko%253D/ts106f.js" charset="utf-8"></script>
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
    global $post;
    $campaignPageSlug = "campaign";
    $storiesPageSlug = "stories-of-ome-line";
    $dmoPageSlug = "dmo";
    $slug = is_null($post) ? "POST-DOESNOT-EXIST" : $post->post_name;
    $storiesClass = (is_page($storiesPageSlug)) ? "page-stories" : "";
    $storiesClass .= " page-" . $slug;


    function isPageAnchor($url) {
      $keyword = 'http';
      if (strpos($url, $keyword) === false) {
        return true;
      }
      return false;
    }

    // グローバルメニューHTML作成
    $menuID = "main-menu";
    $mainMenu = wp_get_nav_menu_items($menuID);
    $navHtml = '<div id="main-menu">';
    foreach($mainMenu as $item){
      $mainUrlPrefix = (
        is_page(array($campaignPageSlug, $storiesPageSlug, $dmoPageSlug)) &&
        isPageAnchor($item -> url)
      ) ? home_url( '/' ) : "";
      $navHtml .=
        '<a class="' . str_replace("#", "menu-", $item -> url) . '"
        href="' . $mainUrlPrefix . $item -> url . '"><span>' . $item -> title . '</span></a>';
    }
    $navHtml .= '</div>';

    // キャンペーンメニューHTML作成
    $campaignMenuID = "campaign-menu";
    $campaginMenu = wp_get_nav_menu_items($campaignMenuID);
    $campaignPageUrl = get_permalink( get_page_by_path($campaignPageSlug));
    // 最初のキャンペーンメニューは特殊なスタイル
    $campaignFirstMenu = array_shift($campaginMenu);
    $campaignUrlPrefix = (!is_page($campaignPageSlug) && isPageAnchor($campaignFirstMenu -> url)) ? $campaignPageUrl : "";
    $campaginNavHtml = '<div class="nav-inner">';
    $campaginNavHtml .= '<a href="' . $campaignUrlPrefix . $campaignFirstMenu -> url . '" class="tag-new-wrap">';
    $campaginNavHtml .= '<span class="tag-new-inner">';
    $campaginNavHtml .= '<span class="tag-new">NEW!</span>';
    $campaginNavHtml .= '<b>' . $campaignFirstMenu -> title . '</b>';
    $campaginNavHtml .= '</span>';
    $campaginNavHtml .= '</a>';

    // ２つ目以降のキャンペーンメニュー
    foreach($campaginMenu as $item){
      $campaignUrlPrefix = (!is_page($campaignPageSlug) && isPageAnchor($item -> url)) ? $campaignPageUrl : "";
      $campaginNavHtml .=
        '<a class="' . $item -> classes[0] . '"
        href="' . $campaignUrlPrefix . $item -> url . '"><span>' . $item -> title . '</span></a>';
    }
    $campaginNavHtml .= '</div>';

    // アイキャッチ画像取得
    $eyeCatchImage = get_the_post_thumbnail_url();
    $eyeCatchHtml = '<div class="eye-catch" style="background-image: url(' . $eyeCatchImage . ');"></div>';

    // キービジュアル動画取得
    $acfMoviePC = is_null($post) ? "" : get_field('movie-pc', $post->ID);
    $acfPosterPC = is_null($post) ? "" : get_field('poster-pc', $post->ID);
    $acfMovieMobile = is_null($post) ? "" : get_field('movie-mobile', $post->ID);
    $acfPosterMobile = is_null($post) ? "" : get_field('poster-mobile', $post->ID);
    $isMovieAvailable = !empty($acfMoviePC) && !empty($acfMovieMobile);
    if($isMovieAvailable) {
      $movieHtml = '
        <div id="key-movie" class="key-movie play">
          <div class="movie-control">
            <button class="btn-volume muted">音声</button>
          </div>
          <video
            class="movie-pc" autoplay muted loop type="video/mp4"
            src="' . $acfMoviePC['url'] . '"
            poster="' . $acfPosterPC['url'] . '">
          </video>
          <video
            class="movie-mobile" playsinline autoplay muted loop type="video/mp4"
            src="' . $acfMovieMobile['url'] . '"
            poster="' . $acfPosterMobile['url'] . '">
          </video>
        </div>';
    }

?>
  <div class="wrapper <?php echo $storiesClass?>">
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
              <?php
                // キャンペーンページの表示設定があればメニューを表示する
                $campaignID = get_id_by_slug('campaign');
                if (get_field('campaign-available', $campaignID)) {
                  echo $campaginNavHtml;
                }
              ?>
              <a class="fake-link"><span></span></a>
              <?php
                // グローバルメニュー
                echo $navHtml;
              ?>
              <a href="https://www.facebook.com/ensenmarugoto" class="facebook" target="_blank"
                rel="noopener noreferrer">
                <img src="<?php echo get_template_directory_uri()?>/assets/public/images/logo-facebook.svg"
                  alt="facebook" />
              </a>
            </nav>
          </div>
        </aside>
        <div id="content-wrap" class="content-wrap">
          <?php
            // アイキャッチ画像が設定されていない場合は、共通のスライダーを表示。それ以外はアイキャッチ画像を表示
            if ($isMovieAvailable) {
              echo $movieHtml;
            } else if ($eyeCatchImage == null) {
              $page = get_page_by_path("key-visual-pc", OBJECT, "key-visual");
              $content = apply_filters('the_content', $page->post_content);
              echo $content;
              $page = get_page_by_path("key-visual-sp", OBJECT, "key-visual");
              $content = apply_filters('the_content', $page->post_content);
              echo $content;
            } else {
              echo $eyeCatchHtml;
            }
          ?>
          <div id="reading-content">