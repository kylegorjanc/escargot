
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


        	<?php
			      // Include the subscribe form.
			      get_template_part( 'carousel' );
			    ?>

<!-- 		<div class="home-section sixteen-nine" id="home-carousel-section">
		 <a href="./subscribe">
			<div class="section-content banner-wrap" id="home-banner-1">
				<span class="screen-reader-text link-text"><h2>Subscribe</h2></span>
			</a>
			</div>
		</div> --> <!-- Section -->

		<div class="home-section" id="home-buttons-section">
			<div class="section-content" id="home-buttons">
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url( '/category/training-logs/' ) ); ?>">
							<button class="btn-home">Training Logs</button>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( date("Y") ) ); ?>">
							<button class="btn-home">Archive</button>
						 </a></li>
					<li>
						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
							<button class="btn-home">
							Contact Us</button>
						</a>
					</li>
				</ul>
			</div>
		</div>


<!-- 		<div class="main-gallery js-flickity carousel"  data-flickity-options='{ "cellAlign": "center", "contain": true, "wrapAround": "false", "setGallerySize": "false"}'>
		</div> -->
            
					 

<!-- 
	//wp_get_recent_posts( 'numberposts' => '10' );
		// foreach( $recent_posts as $recent ) {
			// echo '<div class="carousel-cell"><div class="cell-wrap banner-wrap">	<a href="' . get_permalink($recent["ID"]) . '">';
			//echo '<img src="http://localhost:8000/wp-content/uploads/2017/01/banner-3.jpg" alt="" >';
			//echo '<h3>' . $recent["post_title"].'</h3>';

		 // }
			// wp_reset_query(); -->


        	<?php
			      // Include the subscribe form.
			      get_template_part( 'recentposts' );
			    ?>


<!-- 
		<div class="home-section sixteen-nine" id="home-lower-banner-section">
			<div class="section-content banner-wrap" id="home-banner-2">
				<span class="screen-reader-text link-text"><h2>Work With Us</h2></span>
			</div>
		</div> --> <!-- Section -->

<!-- 		<div class="home-section" id="home-content-section">
			<div class="section-content change-content-in-page-editor" id="site-desc">
				<?php
				// Start the loop.
				//while ( have_posts() ) : the_post();

					// Include the page content template.
					//get_template_part( 'template-parts/content', 'page' );


					// End of the loop.
				//endwhile;
				?> 

			</div>
		</div> --> <!-- section -->

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
