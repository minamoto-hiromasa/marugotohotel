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
    global $post;
    $config = include get_template_directory() . '/app/config/variables.php';
    $slug = is_null($post) ? "POST-DOESNOT-EXIST" : $post->post_name;
    $storiesClass = (is_page($config['storiesPageSlug'])) ? "page-stories" : "";
    $storiesClass .= " page-" . $slug;

    // グローバルメニューHTML作成
    $mainMenu = wp_get_nav_menu_items($config['menuMain']);
    $navHtml = '<div id="main-menu">';
    foreach($mainMenu as $item){
      $setImHereStyle = (strpos($item -> url, $post -> post_name)) ? 'im-here' : '';
      $mainUrlPrefix = (
        is_page(array($config['campaignPageSlug'], $config['storiesPageSlug'], $config['dmoPageSlug'])) &&
        isPageAnchor($item -> url)
      ) ? home_url( '/' ) : "";
      $navHtml .=
        '<a class="' . $setImHereStyle . '" href="' . $mainUrlPrefix . $item -> url . '">
        <span>' . $item -> title . '</span>
        </a>';
    }
    $navHtml .= '</div>';

    // キャンペーンメニューHTML作成
    $campaginMenu = wp_get_nav_menu_items($config['menuCampaign']);
    $campaignPageUrl = get_permalink( get_page_by_path($config['campaignPageSlug']));
    // 最初のキャンペーンメニューは特殊なスタイル
    if($campaginMenu) {
      $campaignFirstMenu = array_shift($campaginMenu);
      $campaignUrlPrefix = (!is_page($config['campaignPageSlug']) && isPageAnchor($campaignFirstMenu -> url))
        ? $campaignPageUrl : "";
      $campaginNavHtml = '<div class="nav-inner">';
      $campaginNavHtml .= '<a href="' . $campaignUrlPrefix . $campaignFirstMenu -> url . '" class="tag-new-wrap">';
      $campaginNavHtml .= '<span class="tag-new-inner">';
      $campaginNavHtml .= '<span class="tag-new">NEW!</span>';
      $campaginNavHtml .= '<b>' . $campaignFirstMenu -> title . '</b>';
      $campaginNavHtml .= '</span>';
      $campaginNavHtml .= '</a>';

      // ２つ目以降のキャンペーンメニュー
      foreach($campaginMenu as $item){
        $campaignUrlPrefix =
          (!is_page($config['campaignPageSlug']) && isPageAnchor($item -> url)) ? $campaignPageUrl : "";
        $campaginNavHtml .=
          '<a class="' . $item -> classes[0] . '"
          href="' . $campaignUrlPrefix . $item -> url . '"><span>' . $item -> title . '</span></a>';
      }
      $campaginNavHtml .= '</div>';
    } else {
      $campaginNavHtml = '';
    }


    // アイキャッチ画像取得
    $eyeCatchImage = get_the_post_thumbnail_url();
    $eyeCatchHtml = '<div class="eye-catch" style="background-image: url(' . $eyeCatchImage . ');"></div>';

    // キービジュアル動画取得
    $acfMoviePC = is_null($post) ? "" : get_field('movie-pc', $post->ID);
    $acfPosterPC = is_null($post) ? "" : get_field('poster-pc', $post->ID);
    $acfMovieMobile = is_null($post) ? "" : get_field('movie-mobile', $post->ID);
    $acfPosterMobile = is_null($post) ? "" : get_field('poster-mobile', $post->ID);
    $isMovieAvailable =
      !empty($acfMoviePC) && !empty($acfMovieMobile) && !empty($acfPosterPC) && !empty($acfPosterMobile);
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
          <a href="<?php echo home_url(); ?>">
            <div class="logo"></div>
          </a>
          <button class="toggle-menu">
            <span class="burger"></span>
          </button>
        </header>
        <aside class="side-nav" data-sticky-container>
          <div class="side-stick" data-sticky data-btm-anchor="content-wrap:bottom">
            <a href="<?php echo home_url(); ?>">
              <img class="logo" src="<?php echo get_template_directory_uri()?>/assets/public/images/logo.svg"
                alt="沿線まるごと HOTEL PROJECT" srcset="">
            </a>
            <nav>
              <?php
                // キャンペーンページの表示設定があればメニューを表示する
                if (isCampaignAvailable()) {
                  echo $campaginNavHtml;
                }
              ?>
              <a class="fake-link"><span></span></a>
              <?php
                // グローバルメニュー
                echo $navHtml;
              ?>
              <ul class="sns-links">
                <li><?php echo makeSnsLinks('facebook'); ?></li>
                <li><?php echo makeSnsLinks('instagram'); ?></li>
                <li><?php echo makeSnsLinks('youtube'); ?></li>
                <li><?php echo makeSnsLinks('twitter'); ?></li>
              </ul>
            </nav>
          </div>
        </aside>
        <div id="content-wrap" class="content-wrap">
          <?php
            echo keyVisualLink('open');
            // アイキャッチ画像が設定されていない場合は、共通のスライダーを表示。それ以外はアイキャッチ画像を表示
            if ($isMovieAvailable) {
              echo $movieHtml;
            } elseif ($eyeCatchImage == null) {
              $page = get_page_by_path("key-visual-pc", OBJECT, "key-visual");
              $content = apply_filters('the_content', $page->post_content);
              echo $content;
              $page = get_page_by_path("key-visual-sp", OBJECT, "key-visual");
              $content = apply_filters('the_content', $page->post_content);
              echo $content;
            } else {
              echo $eyeCatchHtml;
            }
            echo keyVisualLink('close');
          ?>
          <div id="reading-content">