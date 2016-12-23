<?php
/**
 * The template part for displaying an Author biography
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<div class="author-info short-bio">
	<div class="author-description">
		<?php
		/**
		 * Filter the Twenty Sixteen author bio avatar size.
		 *
		 * @since Twenty Sixteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'escargatoire_author_bio_avatar_size', 100 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?><!-- .author-avatar -->
		<h3 class="author-title"><span class="author-heading">
		<!-- <?php // _e( 'Author:', 'escargatoire' ); ?>  -->
		<?php echo get_the_author(); ?></h3></span>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?></p>
			<ul class="bio-links">
				<li id="view-all-posts-by"><button class="action-btn author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><
				<?php printf( __( 'View all posts by %s', 'escargatoire' ), get_the_author() ); ?></button>
				</li>
				<li id="view-bio" class="btn"><button class="action-btn author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'More from %s', 'escargatoire' ), get_the_author() ); ?></button>
				</li>		
			</ul>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
