<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AAA
 */

get_header();
?>
	<article>
		<header class="content-header grey">	
			<div class="header_inner no_image">
				<h1 class="orange <?php echo get_rand_shape_class(); ?>">
					<?php esc_html_e( 'Sorry! That page can&rsquo;t be found.', 'confetti' ); ?>
				</h1>
			</div>
		</header><!-- .entry-header -->
		<section class="content page_404 margins">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try  a search?', 'confetti' ); ?></p>

		<?php
		get_search_form();
		?>
		<p></p>
		<p></p>
		</section><!-- .entry-content -->

		
	</article><!-- #post-<?php the_ID(); ?> -->	
<?php
get_footer();
