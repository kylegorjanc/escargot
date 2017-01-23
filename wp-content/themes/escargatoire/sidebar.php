<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>

        <div id="blog-sidebar" class="sidebar-right">
          <div id="category-list" class="archive-list">
            <?php
              wp_list_categories();
             ?>
          </div> <!-- category list -->
          <div id="date-list" class="archive-list">
            <li class="archives">Archives
              <ul>
                <?php
                  wp_get_archives();
                ?>
              </ul>
            </li>
          </div>  <!-- date list -->
<!--           <div id="training-cat-list" class="archive-list">
            <li class="archives">Category Post Archives
              <ul>
                  <?php query_posts('cat=1'); ?>
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                     <a href=""><?php the_title( '<li class="archive-title">', '</li>' ); ?>
                  <?php endwhile; endif; ?>
              </ul>
            </li>
          </div> -->  <!-- date list -->
        </div> <!-- blog sidebar -->


<!-- 	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

