<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<div id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'お探しのページが見つかりませんでした。', 'wp-bootstrap-starter' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'ページのURLが変更されたか削除された可能性があります。', 'wp-bootstrap-starter' ); ?></p>
					<p><?php esc_html_e( 'お手数をお掛けしますが、下記のリンクか左のメニューからご覧になりたい情報をお探しください。', 'wp-bootstrap-starter' ); ?></p>
					<p class="external"><a href="<?php echo esc_url( get_home_url() ); ?>">トップページ</a></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
