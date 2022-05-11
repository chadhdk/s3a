<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAA
 */
$id = get_the_ID();
$event = get_event_fields($id);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-header grey">
		<div class="header_inner">
			<div class="image_bottom_slash image_container">
				<?php echo get_the_post_thumbnail($id, 'full'); ?>
			</div>
			<h1 class="navy <?php echo get_rand_shape_class(); ?>">
				<?php echo get_the_title(); ?>
			</h1>
		</div>
		<div class="event_details margins flex flex_50">
			<h3><?php echo $event['sub_title']; ?></h3>
			<p class="date"><?php echo $event['date']; ?></p>
		</div>
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
			<?php get_social_share($id); ?>
		</aside>
	</section><!-- .entry-content -->
	<section class="content_blocks">
		<?php get_content_blocks($id); ?>
	</section>
</article><!-- #post-<?php the_ID(); ?> -->
