<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-main" role="main">

		<?php if ( have_posts() ) : ?>
     
			<header class="page-header">
				<?php the_archive_title( '<h3 class="archive-title">', '</h3>' ); 
				?>
			</header><!-- .page-header -->
		<div class="page-level-bios">
		<div class="author-avatar"><?php
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
		<p><?php the_author_meta( 'description' ); ?></p>
</div>
<div class="profile-info">Here
<!-- 	<h3><?php 
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	$user_id = sprintf("user_$curauth->id"); ?>

	<?php the_field('public_email', $user_id); ?></h3> -->


	<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  $user_id = sprintf("user_$curauth->id"); ?>


<ul class="author-contacts post-sharing">
	<h4>Contact <?php $curauth ?></h4>

	<?php
  echo '<li class="menu-item social-icon social-navigation .light-bg"><a href="mailto:' . get_field('public_email', $user_id) . '</a></li>';

  echo '<li><a href="https://twitter.com/' . get_field('twitter', $user_id) . '</a></li>';

  echo '<li><a href="https://facebook.com/' . get_field('facebook', $user_id) . '</a></li>';

  echo '<li><a href="https://instagram.com/' . get_field('instagram', $user_id) . '</a></li>';

  echo '<li><a href="https://pinterest.com/' . get_field('pinterest', $user_id) . '</a></li>';

  echo '<li><a href="https://snapchat.com/' . get_field('snapchat', $user_id) . '</a></li>';

	?>

</ul>

</div> <!-- profile-info -->


			<?php
			// Start the Loop.
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
				'prev_text'          => __( 'Previous page', 'escargatoire' ),
				'next_text'          => __( 'Next page', 'escargatoire' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'escargatoire' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
