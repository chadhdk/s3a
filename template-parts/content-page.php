<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAA
 */
$id = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-header grey">	
		<?php if( has_post_thumbnail($id)) : ?>
			<div class="header_inner">
				<div class="image_bottom_slash image_container">
					<?php echo get_the_post_thumbnail($id, 'full'); ?>
				</div>
				<h1 class="orange <?php echo get_rand_shape_class(); ?>">
					<?php echo get_the_title(); ?>
				</h1>
			</div>
		<?php else: ?>
			<div class="header_inner no_image">
				<h1 class="orange <?php echo get_rand_shape_class(); ?>">
					<?php echo get_the_title(); ?>
				</h1>
			</div>
		<?php endif; ?>	
	</header><!-- .entry-header -->
	<section class="breadcrumbs margins">
		<?php echo get_breadcrumbs($id); ?>
	</section>

	<section class="content margins">
		<div class="content_text">
			<?php the_content(); ?>
		</div>
		<aside class="content_sidebar">
			<?php get_sidebar_blocks($id); ?>
		</aside>
	</section><!-- .entry-content -->

	<section class="content_blocks">
		<?php get_content_blocks($id); ?>
	</section>
</article><!-- #post-<?php the_ID(); ?> -->
