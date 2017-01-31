<?php

//Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

function wp_register_post_type() {
 
	$singular = 'Property Listing'; 
	$plural = 'Property Listings';

	$labels = array(
		'name' 				 => $plural,
		'singular_name' 	 => $singular,
		'add_name' 			 => 'Add New',
		'add_new_item' 		 => 'Add New '.$singular,
		'edit' 				 => 'Edit',
		'edit_item' 		 => 'Edit '.$singular,
		'new_item' 			 => 'New '.$singular,
		'view' 				 => 'View '.$singular,
		'view_item' 		 => 'View '.$singular,
		'search_item' 		 => 'Search '.$plural,
		'parent' 			 => 'Parent '.$singular,
		'not_found' 		 => 'No '.$plural.' found',
		'not_found_in_trash' => 'No '.$plural.' in Trash' 
		);
 	$args = array(
 		'labels' 			   => $labels,
 		'public' 			   => true,
 		'publicly_queryable'   => true,
 		'exclude_from_search'  => false,
 		'show_in_nav_menus'    => true,
 		'show_ui' 			   => true,
 		'show_in_menu' 		   => true,
 		'show_in_admin_bar'    => true,
 		'menu_position' 	   => 6,
 		'menu_icon' 		   => 'dashicons-businessman',
 		'can_export' 		   => true,
 		'delete_with_user'     => false,
 		'hierarchical' 	       => false,
 		'has_archive' 		   => true,
 		'query_var'   		   => true,
 		'capability_type' 	   => 'post',
 		'map_meta_cap' 		   => true,
 		'rewrite' 			   => array(
 			'slug' 			   => 'property',
 			'with_front' 	   => true,
 			'pages' 		   => true,
 			'feeds' 		   => true,
 			),
 		'supports' => array(
 			'title',
 			'thumbnail'
 			)
 		);
 	register_post_type('property', $args);
}
add_action('init', 'wp_register_post_type');

// if (defined ('ABSPATH') && ! defined( 'RWMB_VER' )) {
// 	require_once dirname( __FILE__ ) . '/inc/loader.php';
// 	$loader = new RWMB_Loader;
// 	$loader->init();
// }

function wp_register_taxonomy() {
	$plural = 'Locations';
	$singular = 'Location';

	$labels = array(
		'name' => $plural,
		'singular_name'	=> $singular,
		'search_items'	=> 'Search '.$plural,
		'popular_items'	=> 'Popular '.$plural,
		'all_items'	=> 'All '.$plural,
		'parent_item'	=> null,
		'parent_item_colon'	=> null,
		'edit_item'	=> 'Edit '.$singular,
		'update_item'	=> 'Update '.$singular,
		'add_new_item'	=> 'Add New '.$singular,
		'new_item_name'	=> 'New '.$singular.' Name',
		'separate_items_with_commas'	=> 'Seperate '.$plural.' with commas',
		'add_or_remove_items'	=> 'Add or remove '.$plural,
		'choose_from_most_used'	=> 'Choose from the most used '.$plural,
		'not_found'	=> 'No '.$plural.' found.',
		'menu_name'	=> $plural, 
	);

	$args = array(
		'hierarchical'	=> true,
		'labels'	=> $labels,
		'show_ui'	=> true,
		'show_admin_column'	=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'	=> true,
		'rewrite'	=> array('slug' => 'location'),
	 );

	register_taxonomy('location', 'property', $args);
}
add_action('init', 'wp_register_taxonomy');


if ( defined( 'ABSPATH' ) && !defined( 'RWMB_VER' ) ) {
	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$loader = new RWMB_Loader;
	$loader->init();
}


add_filter( 'rwmb_meta_boxes', 'YOURPREFIX_register_meta_boxes' );

function YOURPREFIX_register_meta_boxes( $meta_boxes ) {
    $prefix = 'rw_';
    // 1st meta box
    $meta_boxes[] = array(
        'id'         => 'personal',
        'title'      => __( 'My Information', 'textdomain' ),
        'post_types' => array( 'post', 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => __( 'Property name', 'textdomain' ),
                'desc'  => 'Format: First Last',
                'id'    => $prefix . 'fname',
                'type'  => 'text',
                'std'   => 'Anh Tran',
                'class' => 'custom-class',
                'clone' => true,
            ),
        )
    );
    // 2nd meta box
    $meta_boxes[] = array(
        'title'      => __( 'Property Details', 'textdomain' ),
        'post_types' => 'property',
        'fields'     => array(
            array(
                'name' => __( 'Size in Acres', 'textdomain' ),
                'id'   => $prefix . 'sAcres',
                'type' => 'text',
            ),
             array(
                'name' => __( 'Address', 'textdomain' ),
                'id'   => $prefix . 'Address',
                'type' => 'text',
            ),
              array(
                'name' => __( 'Status', 'textdomain' ),
                'id'   => $prefix . 'Address',
                'type' => 'select',
                "options"=>array(
                	"Developed"=>"Developed",
                	"Undeveloped"=>"Undeveloped"
                	)
            ),
        )
    );
    return $meta_boxes;
}



