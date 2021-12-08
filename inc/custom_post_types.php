<?php
// create new post type for events
function confetti_init(){
    $labels = array(
		'name'               => __( 'Events', 'confetti' ),
		'singular_name'      => __( 'Event', 'confetti' ),
		'menu_name'          => __( 'Events', 'confetti' ),
		'name_admin_bar'     => __( 'Events', 'confetti' ),
		'add_new'            => __( 'Add New', 'confetti' ),
		'add_new_item'       => __( 'Add New Event', 'confetti' ),
		'new_item'           => __( 'New Event', 'confetti' ),
		'edit_item'          => __( 'Edit Event', 'confetti' ),
		'view_item'          => __( 'View Event', 'confetti' ),
		'all_items'          => __( 'All Events', 'confetti' ),
		'search_items'       => __( 'Search Events', 'confetti' ),
		'parent_item_colon'  => __( 'Parent Events:', 'confetti' ),
		'not_found'          => __( 'No Events found.', 'confetti' ),
		'not_found_in_trash' => __( 'No Events found in Trash.', 'confetti' )
	);
	$args = array(
		'labels'             => $labels,
        'description'        => __( 'A post type for S3A Events.', 'confetti' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 4,
        'menu_icon'           =>'dashicons-tickets-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        
	);

	
	register_post_type( 'event', $args );

	$labels_cs = array(
		'name'               => __( 'Case Studies', 'confetti' ),
		'singular_name'      => __( 'Case Study', 'confetti' ),
		'menu_name'          => __( 'Case Studies', 'confetti' ),
		'name_admin_bar'     => __( 'Case Studies', 'confetti' ),
		'add_new'            => __( 'Add New', 'confetti' ),
		'add_new_item'       => __( 'Add New Case Study', 'confetti' ),
		'new_item'           => __( 'New Case Study', 'confetti' ),
		'edit_item'          => __( 'Edit Case Study', 'confetti' ),
		'view_item'          => __( 'View Case Study', 'confetti' ),
		'all_items'          => __( 'All Case Studies', 'confetti' ),
		'search_items'       => __( 'Search Case Studies', 'confetti' ),
		'parent_item_colon'  => __( 'Parent Case Studies:', 'confetti' ),
		'not_found'          => __( 'No Case Studies found.', 'confetti' ),
		'not_found_in_trash' => __( 'No Case Studies found in Trash.', 'confetti' )
	);

	$args_cs = array(
		'labels'             => $labels_cs,
        'description'        => __( 'A post type for S3A Case Studies.', 'confetti' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
        'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'case-study' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 4,
        'menu_icon'           =>'dashicons-open-folder',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        
	);

	
	register_post_type( 'case-study', $args_cs );

	$labels_tax= array(
		'name' => _x( 'Event category', 'taxonomy general name' ),
		'singular_name' => _x( 'Event category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Event categories' ),
		'all_items' => __( 'All Event categories' ),
		'parent_item' => __( 'Parent Event category' ),
		'parent_item_colon' => __( 'Parent Event category:' ),
		'edit_item' => __( 'Edit Event category' ), 
		'update_item' => __( 'Update Event category' ),
		'add_new_item' => __( 'Add New Event category' ),
		'new_item_name' => __( 'New Event category Name' ),
		'menu_name' => __( 'Event categories' ),
	  ); 
	  register_taxonomy('event-category',array('event'), array(
		'hierarchical' => true,
		'labels' => $labels_tax,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'event-category' ),
	  ));

	  
    }
    
    add_action( 'init', 'confetti_init' );

	