<?php
// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// These allows me to tag blog posts for full-page layouts needed for the Infographics. 
add_theme_support( 'post-formats', array( 'aside' ) );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// This theme uses wp_nav_menu()
add_theme_support( 'nav-menus' );

// This theme uses wp_nav_menu() in one location.
function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
		)
	);
}
add_action( 'init', 'register_my_menus' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

//Change Footer Text
function modify_footer_admin () {
  echo 'Created by <a href="http://ranklab.com" target="_blank">Ranklab Interactive</a>';
}
add_filter('admin_footer_text', 'modify_footer_admin');

//Disable Autosave
function disableAutoSave(){
    wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disableAutoSave' );



//Login Logo
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/style/images/wp_login_logo.png) !important; }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');
function change_wp_login_url() {
echo bloginfo('url');
}

function change_wp_login_title() {
echo get_option('blogname');
}
add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');



//Dashboard Logo
if ( ! function_exists( 'sm_add_adminbar_site_icon' ) ) {
// add to admin area, inside head
add_action( 'admin_head', 'sm_add_adminbar_site_icon' );
// add to frontend, inside head
add_action( 'wp_head', 'sm_add_adminbar_site_icon' );
function sm_add_adminbar_site_icon() {
if ( ! is_admin_bar_showing() ) {
return;
}
echo '<style>
#wp-admin-bar-site-name > a.ab-item:before {
float: left;
width: 16px;
height: 16px;
margin: 5px 5px 0 -1px;
display: block;
content: "";
opacity: 0.4;
background: url('.get_bloginfo('template_directory').'/style/images/wp_dashboard_logo.png) !important;
}
#wp-admin-bar-site-name:hover > a.ab-item:before { opacity: 1; }
</style>';
}
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
.rwmb-text-wrapper:nth-child(odd){
      background: #fafafa;
    } 
  </style>';
}
}


		
					
//Content and Excerpt Limits
function content($num) {
$theContent = get_the_content();
$output = preg_replace('/<img [^/>]+./','', $theContent);
$limit = $num+1;
$content = explode(' ', $output, $limit);
array_pop($content);
$content = implode(" ",$content)."";
echo $content;
}

function excerpt($num) {
$limit = $num+1;
$excerpt = explode(' ', get_the_excerpt(), $limit);
array_pop($excerpt);
$excerpt = implode(" ",$excerpt)."";
echo $excerpt;
}




// Load jQuery
if ( !is_admin() ) {
   wp_deregister_script('jquery');
   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false);
   wp_enqueue_script('jquery');
}

//Remove Dashboard Widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


//Unregister Widgets
// unregister all default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);
	


?>