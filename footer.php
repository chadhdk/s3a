<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAA
 */

?>

	<footer id="colophon" class="site-footer black top_slash">
		<div class="footer_row flex flex_25">
			<button id="newsletter_trigger" class="gold <?php echo get_rand_shape_class(); ?>"  aria-controls="pb_signup_container" aria-expanded="false" >Sign up to our newsletter</button>
			<div class="socials flex flex_25">
				<a href="https://www.facebook.com/Studio3ArtsBarking"><span class="screen-reader-text">Facebook</span><?php echo file_get_contents(get_template_directory() . '/assets/fb.svg'); ?></a>
				<a href="https://www.instagram.com/studio3arts/"><span class="screen-reader-text">Instagram</span><?php echo file_get_contents(get_template_directory() . '/assets/ig.svg'); ?></a>
				<a href="https://twitter.com/studio3arts"><span class="screen-reader-text">Twitter</span><?php echo file_get_contents(get_template_directory() . '/assets/twitter.svg'); ?></a>
				<a href="https://www.youtube.com/channel/UCYPHpljebOXLmTF0B-uWMYw"><span class="screen-reader-text">Youtube</span><?php echo file_get_contents(get_template_directory() . '/assets/yt.svg'); ?></a>
			</div>
		</div>
		<div class="footer_row flex flex_202060">
			<address>
				<p><strong>Studio 3 Arts</strong></p>
				<p><?php echo get_field('address','option'); ?></p>
				<p></p>
				<p><a href="tel:<?php echo get_field('phone_number','option'); ?>"><?php echo get_field('phone_number','option'); ?></a></p>
				<p><a href="mailto:<?php echo get_field('email_address','option'); ?>"><?php echo get_field('email_address','option'); ?></a></p>
			</address>
			<nav class="footer-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'footer-menu',
					)
				);
				?>
			</nav>
			<div class="sponsors flex">
				<img src="<?php echo get_template_directory_uri() .'/assets/lbbd-logo-footer.png'; ?>" alt="Barking & Dagenham logo">
				<img src="<?php echo get_template_directory_uri() .'/assets/HereForCulture_Black-1536x1429.png'; ?>" alt="Here for Culture logo">
				<img src="<?php echo get_template_directory_uri() .'/assets/grant_png_black.png'; ?>" alt="Arts Council England logo">
			</div>
		</div>
		<div class="footer_row flex fine-print">
			<small>Studio 3 Arts © <?php echo date('Y'); ?> | Registered Charity Number: 1054793 Company Number: 3177640</small>
			<a href="https://wearehdk.com/?utm_source=studio_3_arts&utm_medium=website&utm_campaign=made_by_hdk"><span class="screen-reader-text">Made by HdK</span><?php echo file_get_contents(get_template_directory() . '/assets/MadebyHdK.svg'); ?></a>
		</div>

	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<div id='pb_signup_container' class="modal modal--newsletter">
	<div class="newsletter-inner">
		<button id="close-signup" class="close-modal hamburger hamburger--collapse is-active" aria-controls="pb_signup_container" aria-expanded="false">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<?php
		$modal = get_transient( 'newsletter_modal' );
		if (false === $modal) {
			$modal = file_get_contents("https://uk.patronbase.com/_Studio3Arts/Signup/Form?layout=none");
			//Making PatronBase jQuery work with WP
			$open_pos = strpos($modal,'text/javascript');
			$find_open = '<script type="text/javascript">';
			//Aaargh. Detecting both ' and "
			$find_open_alt = "<script type='text/javascript'>";
			$replace_open = $find_open.'jQuery(document).ready(function($) {';
			$find_close = '</script>';
			$replace_close = '});'.$find_close;
			$modal = str_ireplace($find_open,$replace_open,$modal);
			$modal = str_ireplace($find_open_alt,$replace_open,$modal);
			$modal = str_ireplace($find_close,$replace_close,$modal);

			/*Removing Stylesheets and other rubbish*/
			$modal = preg_replace("/(<link).*(>)/",'',$modal);
			set_transient('newsletter_modal', $modal, DAY_IN_SECONDS);
		}
		echo $modal;	
	?>
	</div>
</div>
</body>
</html>
