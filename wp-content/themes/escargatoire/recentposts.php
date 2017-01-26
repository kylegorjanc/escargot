<div class="home-section recent-posts" id="recent-posts-section">
    <div class="recent-posts-wrapper">
        <h2 class="black">Recent Posts</h2>

        <?php 
        $args = array( 'numberposts' => 6, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");

        $postslist = get_posts( $args );
        echo '<div class="recent-posts flexbox">';
         foreach ($postslist as $post) :  setup_postdata($post);
             echo "<div class=\"flex-section-3 rpost-thumb\" style=\"background-image: url(";
             the_post_thumbnail_url();
             echo ")\";"; ?>
        <strong></strong><br />
        <div class="rpost-meta">
          <div class="rpost-meta-wrapper">
           <div class="rpost-title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                <?php the_title(); ?>
              </a>
            </div>
            <div class="rpost-author">by <span style="text-transform:capitalize;"><?php the_author(); ?></span>
            </div>
            <div class="rpost-comments">
                <a href="<?php the_permalink(); ?>#comments" title="<?php the_title();?>">
                  <?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?>
                </a>
            </div>
          </div> <!-- rpost-meta-wrapper -->
        </div> <!-- rpost-meta -->
        </div> <!-- flex-section-3 rpost-thumb -->
        <?php endforeach; ?>
         </div> <!-- recent-posts flexbox -->
    </div> <!-- recent-posts-wrapper -->
</div>
