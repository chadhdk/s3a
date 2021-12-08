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
			<header id="primary" class="entry-header padding image_bg" style="background-image:url(<?php echo get_the_post_thumbnail_url($id,'full') ;?>)">
				<div class="blue header-circle">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
			</header><!-- .entry-header -->
			<section class="margins case-studies-response grid">
				<?php echo get_case_studies(); ?>
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
