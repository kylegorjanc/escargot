<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main blog-main" role="main">

      <div id="blog-content" class="blog-content sidebar-right-content"> 
      <div class="wrapper">
    
        <?php if ( have_posts() ) : ?>

          <?php if ( is_home() && ! is_front_page() ) : ?>
            <header>
              <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
          <?php endif; ?>

          <?php
          // Start the loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'template-parts/content', get_post_format() );

          // End the loop.
          endwhile;

          // Previous/next page navigation.
          the_posts_pagination( array(
            'prev_text'          => __( 'Prev', 'escargatoire' ),
            'next_text'          => __( 'Next', 'escargatoire' ),
            'screen_reader_text' => __( 'Navigation', 'escargatoire'),
          ) );

        // If no content, include the "No posts found" template.
        else :
          get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
        </div> <!-- wrapper -->
        </div>  <!-- blog content -->
        <?php get_sidebar(); ?>

    </main><!-- .site-main -->
  </div><!-- .content-area -->

<?php get_footer(); ?>