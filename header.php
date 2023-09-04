<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V3LTV1MS29"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
  dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-V3LTV1MS29');
</script>

<body <?php body_class(); ?>>

  <?php

    // WordPress 5.2 wp_body_open implementation
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }

?>
  <div id="page" class="site">
    <header id="masthead"
      class="sticky-top site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
      <a href="https://www.instagram.com/okazaki.cp/?hl=ja" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" xml:space="preserve">
          <path
            d="M76.5 100H23.7c-.3-.1-.6-.2-.9-.2C9.4 97.2.1 86 0 72.3c0-15.1-.1-30.1 0-45.2C.1 12.4 12.4.1 27.1 0H73c3 0 5.9.5 8.7 1.5C91.9 5.5 97.9 13 100 23.7v52.8c-.4 1.7-.7 3.5-1.4 5.1-3.9 10.3-11.4 16.3-22.1 18.4zm14.4-49.9V28.6c0-11.4-8-19.3-19.5-19.4H28.6c-11.5 0-19.4 7.9-19.4 19.4v43c0 11.3 8 19.2 19.3 19.2h43c11.3 0 19.3-8 19.3-19.3.2-7 .1-14.2.1-21.4zM76.1 50c.1 14.1-11.8 26-25.9 26.1-14.2 0-26-11.8-26-26 0-14.1 11.7-25.8 25.8-26C64.1 24 76 35.8 76.1 50zM50 33.6c-9.3 0-16.5 7.3-16.5 16.7 0 9.2 7.3 16.4 16.5 16.4 9.3 0 16.6-7.2 16.6-16.6 0-9.3-7.2-16.6-16.6-16.5zm27-16.9c-3.7 0-6.8 3.1-6.8 6.7s3 6.6 6.7 6.6 6.8-3.1 6.8-6.7c-.1-3.6-3.1-6.6-6.7-6.6z" />
        </svg>
      </a>
    </header><!-- #masthead -->
    <?php if(is_front_page()): ?>
    <section class="key-view">
      <div class="text-content">
        <h1 class="title">
          <span class="d-none d-md-block"><?php get_template_part('./assets/src/images/top-title.svg'); ?></span>
          <span class="d-sm-block d-md-none"><?php get_template_part('./assets/src/images/top-title-sp.svg'); ?></span>
        </h1>
        <span class="logo d-sm-block d-md-none"><?php get_template_part('./assets/src/images/logo.svg'); ?></span>
      </div>
      <div class="hero-slider mobile">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-1-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-2-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-3-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-4-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-5-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-6-sp.jpg)">
            </li>
            <li class="glide__slide"
              style="background-image: url(<?php echo get_template_directory_uri()?>/assets/public/images/key-view-7-sp.jpg)">
            </li>
          </ul>
        </div>
      </div>
      <div class="hero-slider desktop">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-1.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-2.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-3.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-4.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-5.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-6.jpg">
            </li>
            <li class="glide__slide">
              <img class="glide__slide__img"
                src="<?php echo get_template_directory_uri()?>/assets/public/images/key-view-7.jpg">
            </li>
          </ul>
        </div>
      </div>
    </section>
    <?php endif; ?>
    <div id="content" class="site-content">
      <div class="container">
        <div class="row">