<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-main" role="main">

			<section class="error-404 not-found"><center>
				<header class="page-header">
					 <h3 class="title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'escargatoire' ); ?></h3>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'escargatoire' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
				</center>
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

		<?php get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
