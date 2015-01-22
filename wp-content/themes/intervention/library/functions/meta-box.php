<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them CAREFULLY
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */
     
/**
 * Add field type: 'taxonomy'
 *
 * Note: The class name must be in format "RWMB_{$field_type}_Field"
 */
if ( !class_exists( 'RWMB_Taxonomy_Field' ) ) {
	class RWMB_Taxonomy_Field {
            
		/**
		 * Add default value for 'taxonomy' field
		 * @param $field
		 * @return array
		 */
		static function normalize_field( $field ) {
			// Default query arguments for get_terms() function
			$default_args = array(
				'hide_empty' => false
			);
			if ( !isset( $field['options']['args'] ) )
				$field['options']['args'] = $default_args;
			else
				$field['options']['args'] = wp_parse_args( $field['options']['args'], $default_args );
                                    
			// Show field as checkbox list by default
			if ( !isset( $field['options']['type'] ) )
				$field['options']['type'] = 'checkbox_list';
                                    
			// If field is shown as checkbox list, add multiple value
			if ( 'checkbox_list' == $field['options']['type'] )
				$field['multiple'] = true;
                                    
			return $field;
		}
                    
		/**
		 * Get field HTML
		 * @param $html
		 * @param $field
		 * @param $meta
		 * @return string
		 */
		static function html( $html, $meta, $field ) {
			global $post;
                            
			$options = $field['options'];
                            
			$meta = wp_get_post_terms( $post->ID, $options['taxonomy'], array( 'fields' => 'ids' ) );
			$meta = is_array( $meta ) ? $meta : ( array ) $meta;
			$terms = get_terms( $options['taxonomy'], $options['args'] );
                            
			$html = '';
			// Checkbox_list
			if ( 'checkbox_list' == $options['type'] ) {
				foreach ( $terms as $term ) {
					$html .= "<input type='checkbox' name='{$field['id']}[]' value='{$term->term_id}'" . checked( in_array( $term->term_id, $meta ), true, false ) . " /> {$term->name}<br/>";
				}
			}
			// Select
			else {
				$html .= "<select name='{$field['id']}" . ( $field['multiple'] ? "[]' multiple='multiple' style='height: auto;'" : "'" ) . ">";
				foreach ( $terms as $term ) {
					$html .= "<option value='{$term->term_id}'" . selected( in_array( $term->term_id, $meta ), true, false ) . ">{$term->name}</option>";
				}
				$html .= "</select>";
			}
                            
			return $html;
		}
                    
		/**
		 * Save post taxonomy
		 * @param $post_id
		 * @param $field
		 * @param $old
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field ) {
			wp_set_post_terms( $post_id, $new, $field['options']['taxonomy'] );
		}
	}
}
    
/********************* META BOXES DEFINITION ***********************/
    
/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = 'frothy_';

$meta_boxes[] = array(
	'id' => 'page-options',
	'title' => 'Page Options',
	'pages' => array('page'),
	'fields' => array(
		array(
			'name' => 'Page Message',					// field name
			'desc' => 'Large page message text',	// field description, optional
			'id' => $prefix . 'pmessage',				// field id, i.e. the meta key
			'type' => 'textarea',						// text box
		),
		array(
			'name' => 'Page Message Sub Text',					// field name
			'desc' => 'Large page message sub text',	// field description, optional
			'id' => $prefix . 'pmessage_sub',				// field id, i.e. the meta key
			'type' => 'textarea',						// text box
		),
		array(
			'name' => 'Button Text',					// field name
			'desc' => 'Text for the button - the button doesnt show if empty',	// field description, optional
			'id' => $prefix . 'btn_text',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
		array(
			'name' => 'Button Url',					// field name
			'desc' => 'Url for the button - the button doesnt show if empty',	// field description, optional
			'id' => $prefix . 'btn_url',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
                    
	)
);
    
    
$meta_boxes[] = array(
	'id' => 'testimonials',
	'title' => 'Testimonial Info',
	'priority' => 'high',
	'pages' => array('testimonials'),
	'fields' => array(
		array(
			'name' => 'Quote',					// field name
			'desc' => 'Enter a quote here',	// field description, optional
			'id' => $prefix . 'quote',				// field id, i.e. the meta key
			'type' => 'textarea',						// text box
		),
		array(
			'name' => 'Location',					// field name
			'desc' => 'Enter Author location here e.g.: Houston, TX',	// field description, optional
			'id' => $prefix . 'location',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
                    
	)
);
    
    
    
$meta_boxes[] = array(
	'id' => 'interventionist',
	'title' => 'Interventionist Info',
	'pages' => array('directory'),
	'fields' => array(
                    array(
			'name' => 'In my Words',			
			'desc' => 'Please add short autobiography here',
			'id' => $prefix . 'support_autobiography',	
			'type' => 'textarea',
		),
		array(
			'name' => 'City',					// field name
			'desc' => 'Enter city name here',	// field description, optional
			'id' => $prefix . 'city',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
		array(
			'name' => 'Main State',
			'id' => $prefix . 'state_select',
			'type' => 'select',						// select box
			'options' => array(						// array of key => value pairs for select box
			    'Alabama' => 'Alabama',
			    'Alaska' => 'Alaska',
			    'Arizona' => 'Arizona',
			    'Arkansas' => 'Arkansas',
			    'California' => 'California',
			    'Colorado' => 'Colorado',
			    'Connecticut' => 'Connecticut',
			    'Delaware' => 'Delaware',
			    'District of Columbia' => 'District of Columbia',
			    'Florida' => 'Florida',
			    'Georgia' => 'Georgia',
			    'Guam' => 'Guam',
			    'Hawaii' => 'Hawaii',
			    'Idaho' => 'Idaho',
			    'Illinois' => 'Illinois',
			    'Indiana' => 'Indiana',
			    'Iowa' => 'Iowa',
			    'Kansas' => 'Kansas',
			    'Kentucky' => 'Kentucky',
			    'Louisiana' => 'Louisiana',
			    'Maine' => 'Maine',
			    'Maryland' =>  'Maryland',
			    'Massachusetts' => 'Massachusetts',
			    'Michigan' => 'Michigan',
			    'Minnesota' => 'Minnesota',
			    'Mississippi' => 'Mississippi',
			    'Missouri' => 'Missouri',
			    'Montana' => 'Montana',
			    'Nebraska' => 'Nebraska',
			    'Nevada' => 'Nevada',
			    'New Hampshire' => 'New Hampshire',
			    'New Jersey' => 'New Jersey',
			    'New Mexico' => 'New Mexico',
			    'New York' => 'New York',
			    'North Carolina' => 'North Carolina',
			    'North Dakota' => 'North Dakota',
			    'Ohio' => 'Ohio',
			    'Oklahoma' => 'Oklahoma',
			    'Oregon' => 'Oregon',
			    'Pennsylvania' => 'Pennsylvania',
			    'Rhode Island' => 'Rhode Island',
			    'South Carolina' => 'South Carolina',
			    'South Dakota' => 'South Dakota',
			    'Tennessee' => 'Tennessee',
			    'Texas' => 'Texas',
			    'Utah' => 'Utah',
			    'Vermont' => 'Vermont',
			    'Virginia' => 'Virginia',
			    'Washington' => 'Washington',
			    'West Virginia' => 'West Virginia',
			    'Wisconsin' => 'Wisconsin',
			    'Wyoming' => 'Wyoming',
                                
			),
			'desc' => 'Select main state(s) of operation'
		),
		array(
			'name' => 'Other States of Operation',
			'id' => $prefix . 'state_select_others',
			'type' => 'select',						// select box
                                                'multiple' => true,                                                                                     // this option allows for multiple states to be selected. You can hold down "command" or "CTRL" and click on the desired states.
			'options' => array(						// array of key => value pairs for select box
			    'Alabama' => 'Alabama',
			    'Alaska' => 'Alaska',
			    'Arizona' => 'Arizona',
			    'Arkansas' => 'Arkansas',
			    'California' => 'California',
			    'Colorado' => 'Colorado',
			    'Connecticut' => 'Connecticut',
			    'Delaware' => 'Delaware',
			    'District of Columbia' => 'District of Columbia',
			    'Florida' => 'Florida',
			    'Georgia' => 'Georgia',
			    'Guam' => 'Guam',
			    'Hawaii' => 'Hawaii',
			    'Idaho' => 'Idaho',
			    'Illinois' => 'Illinois',
			    'Indiana' => 'Indiana',
			    'Iowa' => 'Iowa',
			    'Kansas' => 'Kansas',
			    'Kentucky' => 'Kentucky',
			    'Louisiana' => 'Louisiana',
			    'Maine' => 'Maine',
			    'Maryland' =>  'Maryland',
			    'Massachusetts' => 'Massachusetts',
			    'Michigan' => 'Michigan',
			    'Minnesota' => 'Minnesota',
			    'Mississippi' => 'Mississippi',
			    'Missouri' => 'Missouri',
			    'Montana' => 'Montana',
			    'Nebraska' => 'Nebraska',
			    'Nevada' => 'Nevada',
			    'New Hampshire' => 'New Hampshire',
			    'New Jersey' => 'New Jersey',
			    'New Mexico' => 'New Mexico',
			    'New York' => 'New York',
			    'North Carolina' => 'North Carolina',
			    'North Dakota' => 'North Dakota',
			    'Ohio' => 'Ohio',
			    'Oklahoma' => 'Oklahoma',
			    'Oregon' => 'Oregon',
			    'Pennsylvania' => 'Pennsylvania',
			    'Rhode Island' => 'Rhode Island',
			    'South Carolina' => 'South Carolina',
			    'South Dakota' => 'South Dakota',
			    'Tennessee' => 'Tennessee',
			    'Texas' => 'Texas',
			    'Utah' => 'Utah',
			    'Vermont' => 'Vermont',
			    'Virginia' => 'Virginia',
			    'Washington' => 'Washington',
			    'West Virginia' => 'West Virginia',
			    'Wisconsin' => 'Wisconsin',
			    'Wyoming' => 'Wyoming',
                                
			),
			'desc' => 'Select other state(s) that interventionist supports. If you hold down CTRL (PC) or command (Mac), you will be able to select multiple states. Hold down CTRL/command and click to remove selections.'
		),
        array(
			'name' => 'Company Name',					// field name
			'desc' => 'Enter company name here',	// field description, optional
			'id' => $prefix . 'company_name',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
			'name' => 'Phone Number',					// field name
			'desc' => 'Enter phone number using this format <strong>555-555-5555</strong>',	// field description, optional
			'id' => $prefix . 'interventionist_phone',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
			'name' => 'Email',					// field name
			'desc' => 'Enter email here',	// field description, optional
			'id' => $prefix . 'email',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
			'name' => 'Website URL',					// field name
			'desc' => 'Enter website url here including http://',	// field description, optional
			'id' => $prefix . 'website_url',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
			'name' => 'LinkedIn URL',					// field name
			'desc' => 'Enter Linkedin Url here',	// field description, optional
			'id' => $prefix . 'linkedin',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
			'name' => 'Youtube iframe',					// field name
			'desc' => 'Enter youtube embed here',	// field description, optional
			'id' => $prefix . 'video',				// field id, i.e. the meta key
			'type' => 'text',						// text box
		),
        array(
                                                'type' => 'divider',
                                                'id' => 'fake_divider_id', // Not used, but needed
                                ),
        array(
			'name' => 'Subtitle',			
			'desc' => 'Please add desired subtitle here',
			'id' => $prefix . 'support_credentials',	
			'type' => 'text',
		),
        array(
			'name' => 'Years of Experience',			
			'desc' => 'Please add the number of Years of Experience here',
			'id' => $prefix . 'support_years_of_experience',	
			'type' => 'text',
                            
		),
            array(
			'name' => 'Featured Interventionist Interview Excerpt',					// field name
			'desc' => "Place Content for Featured Interventionist's Excerpt Interview",	// field description, optional
			'id' => $prefix . 'support_featured_interview_excerpt',				// field id, i.e. the meta key
			'type' => 'WYSIWYG',					// text box
		),
            array(
			'name' => 'Featured Interventionist Interview',					// field name
			'desc' => "Place content for Featured Interventionist's Interview",	// field description, optional
			'id' => $prefix . 'support_featured_interview',				// field id, i.e. the meta key
			'type' => 'WYSIWYG',					// text box
		),
	)
);
   
/**
 * Register meta boxes
 * Make sure there's no errors when the plugin is deactivated or during upgrade
 */
if ( class_exists( 'RW_Meta_Box' ) ) {
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
    
    
//        array(
//			'name' => 'Additional States',
//			'id' => $prefix . 'addtional_state_select',
//			'type' => 'select',						// select box
//			'options' => array(						// array of key => value pairs for select box
//                '' => 'Select a state',
//			    'Alabama' => 'Alabama',
//			    'Alaska' => 'Alaska',
//			    'Arizona' => 'Arizona',
//			    'Arkansas' => 'Arkansas',
//			    'California' => 'California',
//			    'Colorado' => 'Colorado',
//			    'Connecticut' => 'Connecticut',
//			    'Delaware' => 'Delaware',
//			    'District of Columbia' => 'District of Columbia',
//			    'Florida' => 'Florida',
//			    'Georgia' => 'Georgia',
//			    'Guam' => 'Guam',
//			    'Hawaii' => 'Hawaii',
//			    'Idaho' => 'Idaho',
//			    'Illinois' => 'Illinois',
//			    'Indiana' => 'Indiana',
//			    'Iowa' => 'Iowa',
//			    'Kansas' => 'Kansas',
//			    'Kentucky' => 'Kentucky',
//			    'Louisiana' => 'Louisiana',
//			    'Maine' => 'Maine',
//			    'Maryland' =>  'Maryland',
//			    'Massachusetts' => 'Massachusetts',
//			    'Michigan' => 'Michigan',
//			    'Minnesota' => 'Minnesota',
//			    'Mississippi' => 'Mississippi',
//			    'Missouri' => 'Missouri',
//			    'Montana' => 'Montana',
//			    'Nebraska' => 'Nebraska',
//			    'Nevada' => 'Nevada',
//			    'New Hampshire' => 'New Hampshire',
//			    'New Jersey' => 'New Jersey',
//			    'New Mexico' => 'New Mexico',
//			    'New York' => 'New York',
//			    'North Carolina' => 'North Carolina',
//			    'North Dakota' => 'North Dakota',
//			    'Ohio' => 'Ohio',
//			    'Oklahoma' => 'Oklahoma',
//			    'Oregon' => 'Oregon',
//			    'Pennsylvania' => 'Pennsylvania',
//			    'Rhode Island' => 'Rhode Island',
//			    'South Carolina' => 'South Carolina',
//			    'South Dakota' => 'South Dakota',
//			    'Tennessee' => 'Tennessee',
//			    'Texas' => 'Texas',
//			    'Utah' => 'Utah',
//			    'Vermont' => 'Vermont',
//			    'Virginia' => 'Virginia',
//			    'Washington' => 'Washington',
//			    'West Virginia' => 'West Virginia',
//			    'Wisconsin' => 'Wisconsin',
//			    'Wyoming' => 'Wyoming',
//
//			),
//			'desc' => 'Select additional states',
//            'clone' => 'true'
//		),