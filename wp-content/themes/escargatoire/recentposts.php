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
         <span class="rpost-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
              <h4><?php the_title(); ?></h4>
            </a>
          </span>
          <span class="rpost-author"><?php the_author(); ?></span>
          <span class="rpost-comment-num">
              <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                <?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?>
              </a>
          </span>
          </div>
        </div>
        <?php endforeach; ?>
         </div>
    </div>
</div>
