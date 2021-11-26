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
?>

	<main  class="site-main grey">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<header id="primary" class="entry-header bg yellow padding">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<h4>View:</h4>
				<div class="filters flex">
					<?php echo get_filter_list('event-category'); ?>
				</div>
			</header><!-- .entry-header -->
			<section class="margins whats-on_response grid" id="response">
				<?php echo get_whatson_response(); ?>
			</section>
			<?php $cta_footer = get_field('call_to_action_footer');
			if($cta_footer):
        	?><section class="cta_footer top_slash purple bg full">
            <?php foreach($cta_footer as $block): ?>
                    <div class="text_container">
                        <h2><?php echo $block['title']; ?></h2>
                        <?php echo apply_filters('the_content',$block['description']); ?>
                        <a href="<?php echo $block['link']; ?>" class="decorative white <?php echo get_rand_shape_class(); ?>">
                            <?php echo $block['button_text']; ?>
                        </a>
                    </div>
            <?php endforeach; ?>
			</section><?php
			endif;
	   endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
