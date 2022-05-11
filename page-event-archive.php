<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAA
 */

get_header();
$id = get_the_ID();
$paged=(get_query_var('paged'))?get_query_var('paged'):1;
?>

	<main  class="site-main grey">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<header id="primary" class="entry-header bg yellow padding">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<section class="margins whats-on_response grid" id="response">
				<?php echo get_whatson_archive($paged); ?>
			</section>
			
	   <?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
