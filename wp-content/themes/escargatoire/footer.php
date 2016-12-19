<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer class="site-footer" role="contentinfo">
			<div class="footer-content">
				<div class="link-list footer-section" id="footer-nav">
					<ul>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/wp-admin' ) ); ?>" rel="about">About</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" rel="contact">Contact</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/wp-admin' ) ); ?>" rel="login">Login</a></li>
					</ul>
				</div>
				<div class="outline-box subscribe-form footer-section" id="footer-subscribe">
					<div class="form-container">
					<p class="form-title">Subscribe</p>
						<ul>
							<li>
								<label for="" class="input-label" id="name-label">Name:</label>
								<input type="text" name="RESULT_TextField-0" class="text_field" id="RESULT_TextField-0" size="25" maxlength="255" value="">
							</li>
							<li>
								<label for="" class="input-label" id="email-label">Email:</label>
								<input type="text" email="RESULT_TextField-0" class="text_field" id="RESULT_TextField-0" size="25" maxlength="255" value="">
							</li>
						</ul>
					</div>
					
				</div>
				<div class="social-nav link-list footer-section">
					<ul id="menu-page-nav-1" class="social-links-menu link-list">
						<li class="menu-item social-icon twitter-icon social-navigation"><a href="https://twitter.com/saltyrunning"></a></li>
						<li class="menu-item social-icon facebook-icon social-navigation"><a href="https://instagram.com/saltyrunning"></a></li>
						<li class="menu-item social-icon instagram-icon social-navigation"><a href="http://facebook.com/saltyrunning"></a></li>
					</ul>
				</div>
			</div>

<!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
