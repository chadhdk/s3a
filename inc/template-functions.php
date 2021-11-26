<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package AAA
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function confetti_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'confetti_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function confetti_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'confetti_pingback_header' );

function format_date_range($id){
	$date_override=get_field('date_override',$id);
	if($date_override){
		return $date_override;
	}
    $open = get_field('start_date',$id);
    $close = get_field('end_date',$id);
	if(!$open){
		return;
	}
	$day = "j";
	$day_month = "j M";
	$month_year = "M Y";
	$year= "Y";
	$month = "M";
	$day_month_year = "j M Y";
	
	if($close){
		$event_startMonth = date("m",strtotime($open));
		$event_endMonth = date("m",strtotime($close));
		$event_startYear = date("Y",strtotime($open));
		$event_endYear = date("Y",strtotime($close));
		if($event_startMonth == $event_endMonth && $event_startYear == $event_endYear){
			if($ignore_day){
				return date($month_year, strtotime($close));
			}
			elseif($ignore_month){
				return date($year, strtotime($close));
			}
			else{
				return  date($day, strtotime($open))." - ".date($day_month_year, strtotime($close));
			}
		}
		elseif(($event_startYear == $event_endYear)){
			if($ignore_day){
				return date($month, strtotime($open))." - ".date($month_year, strtotime($close));
			}
			elseif($ignore_month){
				return date($year, strtotime($close));
			}
			else{
				return date($day_month, strtotime($open))." - ".date($day_month_year, strtotime($close));
			}
		}
		else{
			if($ignore_day){
				return date($month_year, strtotime($open))." - ".date($month_year, strtotime($close));
			}
			elseif($ignore_month){
				return date($year, strtotime($open))." - ".date($year, strtotime($close));
			}
			else{
				return date($day_month_year, strtotime($open))." - ".date($day_month_year, strtotime($close));
			}
		}
	}
	else{
		return date($day_month_year, strtotime($open));
	}
}

function get_rand_shape_class(){
	$shapes = array(
		'shape1',
		'shape2',
		'shape3',
		'shape4',
		'shape5',
	);
	return $shapes[array_rand($shapes,1)];
}