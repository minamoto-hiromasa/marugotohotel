<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
</div><!-- #reading-content -->
</div><!-- #content-wrap -->
</div><!-- .body-content -->
</div><!-- .sticky-wrap -->
<?php get_template_part( 'footer-widget' ); ?>

<?php
  $page = get_page_by_path("cta-settings", OBJECT, "cta");
  if(get_field('cta-available', $page->ID)) :
?>
<div id="cta-reservation">
  <a href="<?php echo get_field('cta-url', $page->ID) ?>" target="_blank" class="button-reservation">
    <div class="book_ja">
      <?php echo get_field('cta-title', $page->ID) ?>
    </div>
    <div class="book_en">
      <?php echo get_field('cta-english', $page->ID) ?>
    </div>
    <img class="pencil" src="<?php echo get_template_directory_uri()?>/assets/public/images/pencil.svg" width="20"
      alt="鉛筆">
  </a>
</div>
<?php endif; ?>
<footer id="footer">
  <p>
    <!-- some message can be here-->
  </p>
  <div class="sponsers">
    <img src="<?php echo get_template_directory_uri()?>/assets/public/images/sponser-ensen-marugoto.jpg" width="84"
      alt="沿線まるごと株式会社">
    <img src="<?php echo get_template_directory_uri()?>/assets/public/images/sponser-satoyume.jpg" width="108"
      alt="さとゆめ 故郷の夢をかたちに">
    <img src="<?php echo get_template_directory_uri()?>/assets/public/images/sponser-jr.png" width="43" alt="JR東日本">
    <img src="<?php echo get_template_directory_uri()?>/assets/public/images/sponser-tokyo-adventure-line.jpg"
      width="50" alt="東京アドベンチャーライン">
  </div>
</footer>
<?php endif; ?>
</div><!-- .wrapper -->

<?php wp_footer(); ?>
</body>

</html>