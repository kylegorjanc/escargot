<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured:', 'escargatoire' ); ?></span>
		<?php endif; ?>

		<div class="black-bg entry-header-content">
		<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?></a>
		<?php escargatoire_entry_date();?>
		</div>
		<div class="byline">
		<span>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php $author_bio_avatar_size = apply_filters( 'escargatoire_author_bio_avatar_size', 36 );
	    			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?></a>
			<span class="posted-by">Posted by<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( ' %s', 'escargatoire' ), get_the_author() ); ?></a></span> on <?php escargatoire_entry_date();?>
		</span>
		</div>
	</header><!-- .entry-header -->

	<?php escargatoire_excerpt(); ?>

<!-- 	<?php //escargatoire_post_thumbnail(); ?> -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Read more >>', 'escargatoire' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'escargatoire' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'escargatoire' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php escargatoire_entry_taxonomies(); ?>
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
