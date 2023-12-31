<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
</div><!-- #reading-content -->
</div><!-- #content-wrap -->
</div><!-- .body-content -->
</div><!-- .sticky-wrap -->
<?php get_template_part( 'footer-widget' ); ?>

<?php
  $page = get_page_by_path("general", OBJECT, "content-settings");
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
  <?php echo getSponserContent(); ?>
  <div class="brand">
    <ul>
      <?php
        if (get_field('trip-tc', $page->ID)) :
      ?>
      <li>
        <a href="<?php echo get_field('trip-tc', $page->ID); ?>" target="_blank" rel="noopener noreferrer">旅行条件書</a>
      </li>
      <?php endif ?>
      <?php
        if (get_field('trip-registration', $page->ID)) :
      ?>
      <li>
        <a href="<?php echo get_field('trip-registration', $page->ID); ?>" target="_blank"
          rel="noopener noreferrer">旅行業登録票</a>
      </li>
      <?php endif ?>
      <?php
        if (get_field('trip-terms', $page->ID)) :
      ?>
      <li>
        <a href="<?php echo get_field('trip-terms', $page->ID); ?>" target="_blank"
          rel="noopener noreferrer">個人情報保護方針</a>
      </li>
      <?php endif ?>
    </ul>
    <div class="copyright">Copyright © 2023 沿線まるごと株式会社. All Right Reserved.</div>
  </div>
</footer>
<?php endif; ?>
</div><!-- .wrapper -->

<?php wp_footer(); ?>
</body>

</html>