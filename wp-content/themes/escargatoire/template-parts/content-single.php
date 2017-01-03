<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-header">
		<div class="black-bg entry-header-content">
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
		</div>
		<div class="byline">
		<span>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php $author_bio_avatar_size = apply_filters( 'escargatoire_author_bio_avatar_size', 42 );
	    			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?></a>
			<span class="posted-by">Posted by<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( ' %s', 'escargatoire' ), get_the_author() ); ?></a></span> <?php escargatoire_entry_date();?>
		</span>
		</div>
	</div><!-- .entry-header -->

	<?php escargatoire_excerpt(); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'escargatoire' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'escargatoire' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>

			<div class="post-sharing social-links-menu link-list">
			<h3 class="sharing-title">Share This:</h3>
				<ul>
				<?php 
					if ( 'post' === get_post_type() ) {
						printf( '<li class="menu-item social-icon facebook-icon social-navigation"><a href="https://www.facebook.com/sharer/sharer.php?u=%1$s"></a></li>',
							esc_url( get_permalink() )
							);
						printf('<li class="menu-item social-icon twitter-icon social-navigation"><a href="https://twitter.com/home?status=%1$s%%20%2$s"></a></li>',
							get_the_title(),
							esc_url( get_permalink() )
							);
						printf('<li class="menu-item social-icon pocket-icon social-navigation"><a href="https://getpocket.com/edit?url=%1$s"></a></li>',
							esc_url( get_permalink() )
							);
					}

				 ?>
				</ul>
			</div>

			<?php

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'escargatoire' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
