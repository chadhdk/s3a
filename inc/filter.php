<?php 
add_action('wp_ajax_filter', 'aaa_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filter', 'aaa_filter_function');
 
function aaa_filter_function(){
   
   get_production_grid($_POST['categoryfilter'],-1,false,true);
	die();
}