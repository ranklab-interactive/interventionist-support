<?php
// -------------------------------  Taxonomies ---------------------------------------

// Section
register_taxonomy(  
	'section',  
	array('page'),  
	array(  
	 'hierarchical' => true,  
	 'label' => 'Section',  
	 'query_var' => true,  
	 'rewrite' => true  
	)  
);
// Interventionist Taxonomy
add_action( 'init', 'interventionist_type_tax' );

function interventionist_type_tax() {
	register_taxonomy(
        'interventionist-type',
		'directory',
		array(
			'label' => __( 'Interventionist Categories' ),
			'rewrite' => false,
			'hierarchical' => true,
            
		)
	);
}
 register_taxonomy_for_object_type( 'interventionist-type','directory');
 
?>