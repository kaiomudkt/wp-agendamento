<?php 
// register custom post type to work with
function lc_create_post_type() {
	// set up labels
	$labels = array (
		'name' => 'Events',
		'singular_name' => 'Event',
		'add_new' => 'Add New Event',
		'add_new_item' => 'Add New Event',
		'edit_item' => 'Edit Event',
		'new_item' => 'New Event',
		'all_items' => 'All Events',
		'view_item' => 'View Event',
		'search_items' => 'Search Events',
		'not_found' => 'No Events Found',
		'not_found_in_trash' => 'No Events found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Events',
	);
	//register post type
	register_post_type ( 'event', 
		array(
			'labels' => $labels,
			'has_archive' => true,
			'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
			'taxonomies' => array( 'post_tag', 'category' ),
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'events' ),
		)
	);
}
add_action( 'init', 'lc_create_post_type' );

?>