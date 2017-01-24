<?php
/**
 * The template for displaying pages
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
  <main id="main" class="site-main page-main" role="main">
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

      // Include the page content template.
      get_template_part( 'template-parts/content', 'page' );

      // End of the loop.
    endwhile;
    ?>


  <?php
    $authors=get_users();
    $i=0;
    //get all users list
    foreach($authors as $author){
        $authorList[$i]['id']=$author->data->ID;
        $authorList[$i]['name']=$author->data->display_name;
        $i++;
    }
    ?>
    <div class="page-level-bios">
        <?php 
        foreach($authorList as $author){
            $args=array(
                    'showposts'=>1,
                    'author'=>$author['id'],
                    'caller_get_posts'=>1
                   );
            $query = new WP_Query($args);
            if($query->have_posts() ) {
                while ($query->have_posts()){
                    $query->the_post();
        ?>
        <div id="author-<?php echo $author['name'] ?>" class="author" >
         <!-- <h3><?php echo $author['name']; ?></h3>
         <?php echo get_avatar( $author['id'] ); ?> -->
              <?php

      if ( '' !== get_the_author_meta( 'description' ) ) {
        get_template_part( 'template-parts/biography' );
      }
    ?>
        </div>
        <hr class="black hr2">
        <?php
                }
                wp_reset_postdata();
            }
        }
        ?>
    </div>







  </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
