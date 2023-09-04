<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

	$footer_page = getSinglePageBySlug('footer');
	$footer_title = "";
	$footer_content = "";
	if($footer_page) {
		$footer_title = ($footer_page->post_title) ? '<h4 class="title">' . $footer_page->post_title . '</h4>' : "";
		$footer_content = $footer_page->post_content;
	}
?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
</div><!-- .row -->
</div><!-- .container -->
</div><!-- #content -->
<?php get_template_part( 'footer-widget' ); ?>

<footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
  <div id="floaty-footer" class="floaty-footer">
    <?php
					wp_nav_menu(array(
					'theme_location'    => 'navi-menu',
					'container'       => 'div',
					'container_id'    => 'footer-menu',
					'container_class' => 'footer-menu',
					'menu_id'         => false,
					'menu_class'      => 'navbar-nav',
					'depth'           => 3,
					'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
					'walker'          => new wp_bootstrap_navwalker()
					));
					?>
  </div>
  <div class="container pt-4 pb-4">
    <div class="footer-content">
      <?php echo $footer_title; ?>
      <?php echo $footer_content; ?>
      <ul>
        <li><a href="mailto:info@okazaki-tomosu.jp">お問い合わせ<span class="d-none d-lg-inline">
              info@okazaki-tomosu.jp</span></a></li>
        <li><a href="https://satoyume.com/disclosure/" target="_blank">個人情報の取り扱い方針</a></li>
        <li><a href="https://satoyume.com/travel/assets/pdf/travel_agent_registration.pdf" target="_blank">旅行業登録票</a>
        </li>
        <li><a href="https://satoyume.com/travel/assets/pdf/travel_conditions.pdf" target="_blank">旅行条件書</a></li>
        <li class="logo-satoyume"><a href="https://satoyume.com" target="_blank">
            <img src="<?php echo get_template_directory_uri()?>/assets/public/images/logo-satoyume.png" alt="株式会社さとゆめ">
          </a>
        </li>
        <li class="logo-owner"><a href="https://www.city.okazaki.lg.jp" target="_blank">
            <img src="<?php echo get_template_directory_uri()?>/assets/public/images/logo-okazaki.png" alt="岡崎市">
          </a></li>
      </ul>
    </div>
    <div class="site-info">
      &copy; <?php echo date('Y'); ?>
      <?php echo '<a href="https://www.kahokurashisha.jp" target="_blank">Okazaki City</a>'; ?>
    </div><!-- close .site-info -->
  </div>
</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>