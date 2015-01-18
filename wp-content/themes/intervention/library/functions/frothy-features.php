<?php
// Frothy Admin
include_once(TEMPLATEPATH . '/library/functions/setup_files/frothy-admin.php');

//Frothy Pagination
function frothy_pagination() {
	global $wp_rewrite, $wp_query;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
	'base' => @add_query_arg('page','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'prev_text' => __('Previous'),
	'next_text' => __('Next'),
	'end_size' => 1,
	'mid_size' => 2,
	'show_all' => false,
	'type' => 'list'
	);
	if ( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if ( !empty( $wp_query->query_vars['s'] ) )
	$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
}
?>