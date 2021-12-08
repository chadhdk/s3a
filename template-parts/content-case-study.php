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
	<header class="post-header gold">
		<div class="breadcrumbs margins">
			<?php echo get_breadcrumbs($id); ?>
		</div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<section class="post-content margins grid">
		<div class="post-thumbnail circle">
			<?php echo get_the_post_thumbnail($id, 'large'); 
			$caption = get_the_post_thumbnail_caption($id);
			if($caption):
			?>
			<p class="caption"><?php echo $c; ?></p>
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
<?php if(have_rows('carousel_cases')): ?>
<div class="content_gallery padding black">
	<h2><?php echo get_field('carousel_title'); ?></h2>
	<?php if(get_field('carousel_description')): ?>
		<div class="two_col">
			<?php echo apply_filters('the_content',get_field('carousel_description')); ?>
		</div>
	<?php endif; ?>
		<div class="carousel carousel--one_up page_carousel">
			<div class="swiper-wrapper">
				<?php while(have_rows('carousel_cases')): the_row(); ?>
					<div class="swiper-slide">
					<?php if(get_sub_field('image')):
						echo wp_get_attachment_image(get_sub_field('image'),'full');
					elseif(get_sub_field('embedded_media')): ?>
						<div class="media_container">
							<?php echo get_sub_field('embedded_media'); ?>
						</div>    
					<?php endif; 
					if(get_sub_field('caption')): ?>
						<p><?php echo get_sub_field('caption'); ?></p>
					<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="swiper-nav swiper-button-prev"></div><div class="swiper-nav swiper-button-next"></div>
		</div>
</div>
<?php endif; ?>
<?php if(get_field('other_case_studies')): ?>
<section class="padding other-case-studies grid wheat top_left_slash">
	<h2>Other case studies</h2>
	<?php foreach(get_field('other_case_studies') as $item): ?>
		<div class="event yellow bg">
			<a href="<?php echo get_permalink($item->ID); ?>">
				<div class="image_container twothree">
					<?php echo get_the_post_thumbnail($item->ID,'large'); ?>
				</div>
				<div class="text_container">
					<h3><?php echo $item->post_title; ?></h3>
					<?php echo get_the_excerpt($item->ID); ?>
				</div>
			</a>
			<a href="<?php echo get_permalink($item->ID); ?>" class="decorative white <?php echo get_rand_shape_class(); ?>">View case study</a>
		</div>
	<?php endforeach; ?>
	<a href="/case-studies" class="decorative white <?php echo get_rand_shape_class(); ?>">View All</a>
</section>
<?php endif;
