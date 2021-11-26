<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AAA
 */

get_header();
$this_id = get_option( 'page_for_posts' );
?>

	<main class="site-main">

		<?php
		if ( have_posts() ) : ?>	
                <header class="content-header">
                    <div class="header_inner">
                        <div class="image_bottom_slash image_container">
                            <?php echo get_the_post_thumbnail($this_id, 'full'); ?>
                        </div>
                        <h1 class="magenta <?php echo get_rand_shape_class(); ?>">
                            <?php echo get_the_title($this_id); ?>
                        </h1>
                    </div>
                </header><!-- .entry-header -->
                <section class="margins whats-on_response blog_response grid">
                    <?php while ( have_posts() ) :
                        the_post(); ?>
                        <div class="event white bottom_slash">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="image_container twothree image_bottom_slash">
                                    <?php echo get_the_post_thumbnail(get_the_ID(),'large'); ?>
                                </div>
                                <div class="text_container">
                                    <h3><?php echo get_the_title(); ?></h3>
                                    <?php echo get_the_excerpt(); ?>
                                </div>
                            </a>
                            <a href="<?php echo get_permalink(); ?>" class="decorative magenta <?php echo get_rand_shape_class(); ?>">Read</a>
                        </div>

                    <?php endwhile; ?>
                </section>

                <div class="blog_pagination margins">
                    <?php echo get_the_posts_pagination(array('mid_size'=>4,'prev_text'=>'<', 'next_text'=>'>')); ?>
                </div>
<?php 
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        <?php $cta_footer = get_field('call_to_action_footer',$this_id);
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
			endif; ?>
	</main><!-- #main -->

<?php

get_footer();
