<?php

$themename = "Intervention";
$shortname = "frothy";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "General",
	"type" => "section"),
	
array( "name" => "Telephone",
	"desc" => "Enter your phone number",
	"id" => $shortname."_telephone",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Facebook URL",
	"desc" => "Enter your Facebook URL HERE",
	"id" => $shortname."_facebook_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Twitter URL",
	"desc" => "Enter your Twitter URL HERE",
	"id" => $shortname."_twitter_url",
	"type" => "text",
	"std" => ""),	
	

array( "type" => "close"),
array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Main Promo Large Text",
	"desc" => "Enter Main Promo Large Text",
	"id" => $shortname."_main_lrg_txt",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Mid Large Text",
	"desc" => "Enter Promo Large Text",
	"id" => $shortname."_mid_lrg_txt",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Mid Sub Text",
	"desc" => "Enter sub text here",
	"id" => $shortname."_mid_sub_txt",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Mid Button Text",
	"desc" => "Enter btw text here",
	"id" => $shortname."_mid_btn_txt",
	"type" => "text",
	"std" => ""),
array( "name" => "Mid Button URL",
	"desc" => "Enter button url here",
	"id" => $shortname."_mid_btn_url",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Video Embed",
	"desc" => "Enter Video Embed",
	"id" => $shortname."_video_embed",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Green Promo URL",
	"desc" => "Enter green promo url here",
	"id" => $shortname."_grn_url",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Green Promo Large Text",
	"desc" => "Enter green promo large text here",
	"id" => $shortname."_grn_lrg_txt",
	"type" => "text",
	"std" => ""),
array( "name" => "Green Promo Button Text",
	"desc" => "Enter green promo button text here",
	"id" => $shortname."_grn_btn_txt",
	"type" => "text",
	"std" => ""),
	
	
array( "type" => "close"),
array( "name" => "Directory",
	"type" => "section"),
array( "type" => "open"),


array( "name" => "Large Text",
	"desc" => "Enter Large Text",
	"id" => $shortname."_dir_lrg_txt",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Sub Text",
	"desc" => "Enter sub text here",
	"id" => $shortname."_dir_sub_txt",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Main Image",
	"desc" => "Enter Image url 1060px x 250px",
	"id" => $shortname."_dir_img",
	"type" => "textarea",
	"std" => ""),
array( "name" => "Page Content",
	"desc" => "Enter page copy here",
	"id" => $shortname."_dir_copy",
	"type" => "textarea",
	"std" => ""),

	 
array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=frothy-admin.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=frothy-admin.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}
/*This script allows for custom taxonomy slugs to appear in the body as a "custom_tax_{slug}*/
function featured_custom_taxonomy_in_body_class( $classes ){
  if( is_singular() )
  {
    $custom_terms = get_the_terms(0, 'interventionist-type');
    if ($custom_terms) {
      foreach ($custom_terms as $custom_term) {
        $classes[] = 'custom_tax_' . $custom_term->slug;
      }
    }
  }
  return $classes;
}

add_filter( 'body_class', 'featured_custom_taxonomy_in_body_class' );

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/library/functions/setup_files/frothy-admin.css", false, "1.0", "all");

}

function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>

</div>

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>