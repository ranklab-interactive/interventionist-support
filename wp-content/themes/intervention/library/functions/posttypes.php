<?php
// ---------------------  Custom Post Types --------------------------------
// Testimonials
function post_type_testimonials() {
	register_post_type(
	'testimonials', 
	array('label' => __('Testimonials'), 
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'query_var' => true,
		    'menu_position' => 30,
		    'rewrite' => array( 'slug' => 'testimonials', 'with_front' => false ),
		    'supports' => array('title','editor','excerpt','thumbnail'),
	)); 
}
add_action('init', 'post_type_testimonials');

// Directory
function post_type_directory() {
	register_post_type(
	'directory', 
	array('label' => __('Interventionists'), 
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'query_var' => true,
		    'menu_position' => 30,
		    'has_archive' => 'interventionists',
		    'rewrite' => array( 'slug' => 'interventionists', 'with_front' => false ),
		    'supports' => array('title','editor','thumbnail','excerpt'),
	)); 
}
add_action('init', 'post_type_directory');

// FAQs
function post_type_faqs() {
	register_post_type(
	'faqs', 
	array('label' => __('FAQs'), 
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'query_var' => true,
		    'menu_position' => 30,
		    'supports' => array('title','editor'),
	)); 
}
add_action('init', 'post_type_faqs');
?>