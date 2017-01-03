
<?php
/**
 * The template for displaying the home page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="home-section sixteen-nine" id="home-section-1">
		 <a href="./subscribe"></a>
			<div class="section-content home-banner" id="home-banner-1">
				<h2>Subscribe</h2>
			<a href="./subscribe"></a>
			</div>
		</div> <!-- Section -->

		<div class="home-section" id="home-section-2">
			<div class="section-content change-content-in-page-editor" id="site-desc">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'template-parts/content', 'page' );


					// End of the loop.
				endwhile;
				?>

			</div>
		</div>  <!-- section -->

		<div class="adsense">
		</div>

		<div class="home-section sixteen-nine" id="home-section-3">
			<div class="section-content home-banner" id="home-banner-2">
				<h2>Work With Us</h2>
			</div>
		</div> <!-- Section -->

		<div class="home-section" id="home-section-4">
			<div class="section-content" id="home-buttons">
				<ul>
					<li><button class="btn-home">Training Logs</button></li>
					<li><button class="btn-home">Blog Archive</button></li>
					<li><button class="btn-home">Blog With Us</button></li>
				</ul>
			</div>
		</div>
	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
