<?php
/**
 * The template part for displaying an Author biography
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	<div class="author-description short-bio">

		<div class="author-bio">
		<div class="author-avatar"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php
		/**
		 * Filter the Escargatoire author bio avatar size.
		 *
		 * @since Twenty Sixteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'escargatoire_author_bio_avatar_size', 300 );

		echo get_avatar( get_the_author_meta( 'id' ), $author_bio_avatar_size );
		?></a></div><!-- .author-avatar -->

<div class="author-bio-content">
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<h3 class="author-title"><span class="author-heading">
		<!-- <?php // _e( 'Author:', 'escargatoire' ); ?>  -->
		<?php echo get_the_author(); ?></span></h3>	
		</a>

		<p><?php the_author_meta( 'description' ); ?></p></div><!-- .author-bio -->

		<div class="author-bio-link">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			More from <?php echo get_the_author(); ?>
			</a>
		</div>
		</div>
	</div><!-- .author-description -->

