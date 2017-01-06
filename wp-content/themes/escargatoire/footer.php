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

		<footer class="site-footer dark-bg" role="contentinfo">
			<div class="footer-content">
				<div class="link-list footer-section" id="footer-nav">
					<ul>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" rel="about">About</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" rel="contact">Contact</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/wp-admin' ) ); ?>" rel="login">Login</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/collaborate' ) ); ?>" rel="about">Join the Team</a></li>
						<li class="nav-link"><a href="<?php echo esc_url( home_url( '/workwithus' ) ); ?>" rel="about">Work With Us</a></li>
					</ul>
				</div>
				<div class="lower">
					<div class="outline-box subscribe-form footer-section" id="footer-subscribe">
						<div class="form-container">
						<p class="form-title">Subscribe</p>
							<ul>
								<li>
									<label for="mce-FNAME" class="input-label" id="name-label">Name:</label>
									<input type="text" name="FNAME" class="text_field" id="mce-FNAME" value="">
								</li>
								<li>
									<label for="mce-EMAIL" class="input-label" id="email-label">Email:</label>
									<input type="email" name="EMAIL" class="required email text_field" id="mce-EMAIL"value="">
								</li>
								<li>
										<div class="signup-options"><input type="checkbox" value="1" name="group[10365][1]" id="mce-group[10365]-10365-0"><label for="mce-group[10365]-10365-0">DAILY</label>
										</div>
										<div class="signup-options"><input type="checkbox" value="2" name="group[10365][2]" id="mce-group[10365]-10365-1" checked><label for="mce-group[10365]-10365-1">WEEKLY</label>
										</div>
										<div class="signup-options"><input type="checkbox" value="4" name="group[10365][4]" id="mce-group[10365]-10365-2"><label for="mce-group[10365]-10365-2">UPDATES ONLY</label>
										</div>
								</li>
								</ul>
								<div class="clear"><input id="mc-embedded-subscribe" class="action-btn button" name="subscribe" type="submit" value="Subscribe" /></div>

							
						</div>
						
					</div>
					<div class="lower-right">
						<div class="social-nav link-list footer-section">
							<ul id="menu-page-nav-1" class="social-links-menu link-list">
								<li class="menu-item social-icon twitter-icon social-navigation"><a href="https://twitter.com/saltyrunning"></a></li>
								<li class="menu-item social-icon facebook-icon social-navigation"><a href="https://instagram.com/saltyrunning"></a></li>
								<li class="menu-item social-icon instagram-icon social-navigation"><a href="http://facebook.com/saltyrunning"></a></li>
							</ul>
						</div>
						<div class="footer-search">
							<?php get_search_form(); ?>
						</div>
						<div class="copyright">
							<p><small>All content ©2012 <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" rel="contact">Salty Running</a></small></p>
						</div>
					</div> <!-- lower-right -->
				</div> <!-- lower -->
			</div>

<!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
