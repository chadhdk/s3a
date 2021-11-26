<?php
/**
 * Template part for displaying the home page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Confetti
 */
$id = get_the_id();
?>
<section class="block full hero"><?php get_hero_carousel($id); ?></section>
<?php get_home_layouts($id); ?>

