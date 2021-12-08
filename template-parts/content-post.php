<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAA
 */
$id = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header magenta">
		<div class="breadcrumbs margins">
			<?php echo get_breadcrumbs($id); ?>
		</div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<section class="post-content margins grid">
		<div class="post-thumbnail">
			<?php echo get_the_post_thumbnail($id, 'large'); 
			$caption = get_the_post_thumbnail_caption($id);
			if($caption):
			?>
			<p class="caption"><?php echo $caption; ?></p>
			<?php endif; ?>
		</div>
	<div class="post-meta grey">
		<p class="date"><?php echo get_the_date('j M Y'); ?></p>
		<?php get_social_share($id); ?>
	</div>
	<div class="entry-content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<section class="padding whats-on_response blog_response grid blue top_left_slash">
	<h2>Recent Posts</h2>
	<?php $latest=get_posts(array('numberposts'=>3));
	foreach($latest as $item): ?>
		<div class="event white bottom_slash">
			<a href="<?php echo get_permalink($item->ID); ?>">
				<div class="image_container twothree image_bottom_slash">
					<?php echo get_the_post_thumbnail($item->ID,'large'); ?>
				</div>
				<div class="text_container">
					<h3><?php echo $item->post_title; ?></h3>
					<?php echo get_the_excerpt($item->ID); ?>
				</div>
			</a>
			<a href="<?php echo get_permalink($item->ID); ?>" class="decorative magenta <?php echo get_rand_shape_class(); ?>">Read</a>
		</div>
	<?php endforeach; ?>
	<a href="/blog" class="decorative white <?php echo get_rand_shape_class(); ?>">View All</a>
</section>
