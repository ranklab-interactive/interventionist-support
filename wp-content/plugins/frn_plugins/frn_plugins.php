<?php

/**
 * Plugin Name: FRN Settings!
 * Description: This plugin installs the common website elements used on most of our sites. Updates: Fixed Pinterest button issue, added social button switch, fixed some external icon issues, and added ext. link options. // This plugin includes phone number shortcodes, Google Analytics features, LiveHelpNow buttons shortcodes and slider, privacy policy and footer shortcodes, and Chartbeat. This plugin can only be updated manually via FTP or ManageWP.
 * Version: 1.83
 * Author: Daxon Edwards / Foundations Recovery Network
 * Author URI: http://daxon.me
 */
 /*
	Copyright 2013-2014  Foundations Recovery Network  ( email : frnservices@gmail.com )

	Tutorial source: http://ottopress.com/2009/wordpress-settings-api-tutorial/
	
	Each field in the FRN Settings page needs the following to work:
	1. Admin
		Define the code for the input field using a function
		Add field to the new section of admin
	2. Saving or storing data in fields
		Create data group
		Create data field(s)
		Use function to filter/qualify data and put multiple information into an array (to save server efficiency)
		Saving arrays is more efficient than using the DB to create a new field for every piece of data.
	3. On-Page
		Create function that will process data stored and create the code that will be added up on page load
		If shortcode, use add_shortcode to tell wp that it's available and reference the function that creates what replaces the shortcode
		Use add_filter to execute a function if going to add data to a section of a page
	
*/



 
 
/////////////////////////////////////
// Create admin area for settings  //
/////////////////////////////////////


//////
// Core code setting up a menu and page
//
// Creates a menu section
function plugin_admin_add_page() {
	global $frn_settings_page;
	$frn_settings_page = add_menu_page( 'FRN Settings (Phone, Chat, Mobile, Analytics, Chartbeat)', 'FRN Settings', 'manage_options', 'frn_features', 'frn_plugin_settings', plugins_url().'/frn_plugins/images/frn_icon_menu.png' );
}

// Basic structure for settings form (form fields created using function)
function frn_plugin_settings() {
?>
<div class="wrap">

<?php //screen_icon(); ?>
<h2>Foundations Recovery Network Settings</h2>
<p>Welcome! Click the FRN HELP tab at the far right to view more dynamic customization options and details for everything below.</p>
<form action="options.php" method="post" class="frn_styles">
	<?php settings_fields('frn_plugin_data'); // must match register_setting first variable?>
	<?php do_settings_sections('frn_phone_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php //settings_fields('site_head_code'); ?>
	<?php do_settings_sections('frn_head_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php //settings_fields('frn_extlinks_section'); ?>
	<?php do_settings_sections('frn_extlinks_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php //settings_fields('site_lhn_code'); ?>
	<?php do_settings_sections('frn_lhn_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php //settings_fields('frn_footer'); ?>
	<?php do_settings_sections('frn_footer_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php do_settings_sections('frn_sitebase_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	<br />
	<?php do_settings_sections('frn_social_section'); ?>
	<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>
</div>

<?php
}

/// End of core code






//////
// Creating a Help tab
//

function my_plugin_help($contextual_help, $screen_id, $screen) {

	global $frn_settings_page;
	$screen = get_current_screen();
	
	// Add help tabs
	if ( $screen->id != $frn_settings_page ) return;
		
	$phone_help = '
	<br />
	<h2>Phone Number Shortcode Help</h2>
	<div class="typical_box">
		<table class="frn_help_table"><tr>
			<th colspan="2">Auto Scan Feature</th>
			</tr><tr>
				<td valign="top" nowrap><b>Overview</b></td>
				<td valign="top"><div class="shortcode_indent">This features uses PHP or JavaScript to scan elements of a page for a phone number pattern. If found, it automatically puts our typical &lt;SPAN&gt; code around the number. From there our typical phones2links.js (placed in the footer) will take over and turn the numbers into links for mobile devices.
					<p>Phone numbers must have a space, opening bracket, or less than (&lt;) before it and a period, space, closing bracket, or greater than (&gt;) after it to be found. This reduces the chances that a group of digits in the middle of external links would be considered as phone numbers and having our SPAN tag added to the middle of it (and really messing up the page). Whatever characters or space is around the phone number will also be linked visually in mobile devices. But those characters will not be in the tel: phone number portion of the link for mobile devices. That makes sure the numbers are still dialable.</p></div></td>
			</tr><tr>
				<td valign="top" nowrap><b>Disabled</b></td>
				<td valign="top"><div class="shortcode_indent">Default setting. Turns off all phone number scanning on the site.</div></td>
			</tr><tr>
				<td valign="top" nowrap><b>Only Content Fields</b></td>
				<td valign="top"><div class="shortcode_indent">This scans the content prior to looking for shortcodes. You shouldn\'t have to worry about double span codes and links. Only works on Page and Post content fields. It will not scan any other part of a page. No title, no widgets, no header or footer.</div></td>
			</tr><tr>
				<td valign="top" nowrap><b>Only Widgets</b></td>
				<td valign="top"><div class="shortcode_indent">There may be a case where you have added shortcodes to pages/posts but not widgets and have too many to look through. This option turns on scanning the content of widgets only. It will not scan widget titles or any other part of a page.</div></td>
			</tr><tr>
				<td valign="top" nowrap><b>Only Widgets & Content</b></td>
				<td valign="top"><div class="shortcode_indent">This option activates the scanning of both widgets and pages or posts content fields. See notes for the other two options above for more detail on how each option works.</div></td>
			</tr><tr>
				<td valign="top" nowrap><b>Entire Page</b></td>
				<td valign="top"><div class="shortcode_indent">This option will not be helpful if you have already used shortcodes or our frn_phones SPAN code on the site. If you have, this feature will shut down on pages where that SPAN code exists. It\'s possible this may affect things visually, functionally, and how things are recorded in Analytics.<br /> <br />
					This option turns off the PHP scanning of content fields and, for mobile devices only, relies on a JavaScript scan of all code between BODY tags. It will look at everything on the page--header, footer, widgets, content--every bit of code and link the phone numbers. This code is in the phones2links.js in the footer. When this setting is selected, it adds another &lt;SCRIPT&gt; line just above the phones2links.js in the footer. That activates a variable that the phones2links.js code looks for to activate the entire page scanning. Phones2links.js already scans the BODY for SPANs normally for both computers and mobile devices. But when this option is activated, it scans for phone number patterns instead and on mobile devices only and changes them to links if found.</div></td>
			</tr></table>
	</div>
	<div class="typical_box">
		<table class="frn_help_table"><tr>
			<th colspan="2">Common Shortcodes for Text Numbers</th>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help1" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help1\')">[frn_phone ga_phone_location="Phone Clicks in <span style="color:red;"><b>##location on page##</b></span>"]</span></b></td>
				<td valign="top"><div class="shortcode_indent">Displays phone number with typical SPAN around it for mobile and Google Analytics tracking.</div></td>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help2" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help2\')"><&#63;php echo do_shortcode(\'[frn_phone ga_phone_location="Phone Clicks in <span style="color:red;"><b>##location on page##</b></span>"]\'); &#63;></span></b></td>
				<td valign="top"><div class="shortcode_indent">Use for header.php or footer.php or inserting into any php file. Use a typical shortcode within the single quotes.</div></td>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help3" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help3\')">[frn_phone only="yes"]</span></b></td>
				<td valign="top"><div class="shortcode_indent">Use when you only want a phone number to show without formatting or mobile tracking. Used best with images since we need SPANs put around the image or an object. The following code will also work in places shortcodes won\'t.<br />
					Example Use: <b><span id="frn_phone_help4" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help4\')">&lt;span id="frn_phones" ga_phone_location="Phone Clicks in <span style="color:red;"><b>##location on page##</b></span>" frn_number="<span style="color:red;"><b>[frn_phone only="yes"]</b></span>"&gt;&lt;img src="[your image address]" alt="[Don\'t forget Alt tag]" /&gt;&lt;/span&gt;</span></b></div></td>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help9" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help9\')">[frn_phone number="###-###-####"]</span></b></td>
				<td valign="top"><div class="shortcode_indent">Add number="" anytime the frn_phone shortcode is used with any other attributes if you want to use a unique number for that location and override the site\'s default. Whatever phone number format you use here will be displayed as is on the page surrounded by our SPAN JavaScript code. Example: [frn_phone number="555.555.1234" ga_phone_location="Phone Clicks in Sidebar"]</div></td>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help5" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help5\')">[frn_phone]</span></b></td>
				<td valign="top"><div class="shortcode_indent">Use this only in content pages like posts and pages. The Google Analytics tracking code for this is "Phone Clicks (General)". Using this only for in-page phone numbers helps total them all together in reporting since we expect those clicks to be very few. But for pages where it\'s important to know the location of the phone number in stats, then use the option above where you can set a location label.</div></td>
			</tr><tr>
			<th colspan="2" style="text-align:left;padding-top:30px;font-size:16px;">Common Shortcodes for Phone Numbers in Images</th>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help6" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help6\')">[frn_phone ga_phone_location="Phone Clicks in ##page location##" image_url="" alt="" title="" id="" class="" css_style=""]</span></b></td>
				<td valign="top"><div class="shortcode_indent">This shortcode will build the SPAN code BUT ALSO it will build the image HTML between the SPAN code. This example shortcode includes all possible attributes available in the shortcode. Attributes can be added in any order. They don\'t have to be in the order you see to the left within the brackets. Remove any you don\'t need or leave them empty as they are.</div></td>
			</tr><tr>
				<td valign="top"><b><span id="frn_phone_help7" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help7\')">%%frn_phone%%</span></b></td>
				<td valign="top"><div class="shortcode_indent">This will add the phone number to any of our shortcodes. It\'s most helpful when adding to image Alt or Title tags. Since shortcodes normally start with a bracket, WordPress only processes the first shortcode, not the second one within it. Therefore, we just created our own shortcode approach to use within our own shortcodes using two percents (%%).</div></td>
		</tr><tr>
				<td valign="top"><b><span id="frn_phone_help8" class="frn_shortcode_sel" onClick="selectText(\'frn_phone_help8\')"></span></b></td>
				<td valign="top"><div class="shortcode_indent"></div></td>
		</tr></table>
	</div>
	
	<table class="frn_help_table">
		<tr>
			<th>Customizable Attributes for Text Uses:</th>
		</tr>
		<tr>
			<td valign="top">
				<li><b><span id="phone_shortcode_help1" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help1\')">ga_phone_location="Phone Clicks in ##page location##</span></b>  --- Most often customized. This is what we use to know what phone numbers on the site are clicked on. When this is not in a shortcode, the default is: "Phone Clicks (General)"</li>
				<li><b><span id="phone_shortcode_help2" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help2\')">ga_phone_category=""</span></b>  --- The main category that all our phone number clicks are stored under in Google Analytics. Default: "Phone Numbers"</li>
				<li><b><span id="phone_shortcode_help3" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help3\')">ga_phone_label=""</span></b> --- Can be used to store a phone number if they are different on a site. Simply put "include_phone" between the quotes and it\'ll automatically store the phone number in Analytics (e.g. <strong><span id="phone_shortcode_help3b" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help3b\')">ga_phone_label="include_phone"</span></strong>). The default is "Calls" and serves as another way to group the data in Analytics.</li>
				<li><b><span id="phone_shortcode_help4" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help4\')">frn_number_style="white-space:nowrap;"</span></b> --- If you want to style a number for only mobile devices, use this. Default:  "white-space:nowrap" … "style=" is added before it automatically … To remove any mention of styles, put "none" between parenthesis.</li>
				<li><b><span id="phone_shortcode_help5" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help5\')">only="yes"</span></b> --- Use if you want only the phone number to show. Default format for this is 1-555-555-1212, the format that best works for iPhones. No Google Analytics tracking or mobile linking will be included.</li>
				<li><b><span id="phone_shortcode_help6" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help6\')">int_prefix=""</span></b> --- Used only by Rehab and Treatment since the international portion is separate from the number generated by IfByPhone scripts. This makes sure the international code is used in the mobile phone link and passed to the LHN slideout tab as part of the number.</li>
				<li><b><span id="phone_shortcode_help7" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help7\')">lhn_tab_disabled="yes"</span></b> --- Use if you want to disable the phone number where the shortcode is used not to be included in the LHN slide out tab. If you have a shortcode or frn_phone SPAN code somewhere else on the page with out a disabled option or in the main FRN Settings, then there could still be a number in the slideout. This is really helpful if you have different numbers on a page and want to control which one shows in the slideout. It does not matter if yes is used or not. If you don\'t want it disabled, you must remove the variable from the shortcode or SPAN.</li>
			</td>
		</tr><tr>
			<th style="text-align:left;padding-top:30px;font-size:16px;">Customizable Attributes for Image Uses</th>
		</tr><tr>
			<td valign="top">
				<li><b><span id="phone_shortcode_help11" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help11\')">image_url=""</span></b> --- This is the key piece that triggers the image code to be built. This should be the URL to the image file on the server.</li>
				<li><b><span id="phone_shortcode_help12" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help12\')">alt=""</span></b> --- Fill this out to include alt text in the image. You only need the text. The shortcode will take care of adding "alt=".</li>
				<li><b><span id="phone_shortcode_help13" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help13\')">title=""</span></b> --- Fill this out if you want a text bubble to show for the image. It can be that last push to sell a person to click. The shortcode will take care of adding "title=".</li>
				<li><b><span id="phone_shortcode_help14" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help14\')">id=""</span></b> --- If you have an id CSS style you want applied to the image. Just enter the ID here. E.g. id="image_id"</li>
				<li><b><span id="phone_shortcode_help15" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help15\')">class=""</span></b> --- If you have a class CSS style you want applied to the image. Just enter the ID here. E.g. class="image_class"</li>
				<li><b><span id="phone_shortcode_help16" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help16\')">css_style=""</span></b> --- If you want to directly add a style to the image, enter the portion that would be between the quotes in a normal style attribute. E.g. css_style="border:0;margin:5px;"</li>
			</td>
		</tr>
	</table>
	<table class="frn_help_table">
		<tr>
			<th>"Location" Labeling for Analytics:</th>
		</tr>
		<tr>
			<td valign="top">
			Use the following "###location###" labels depending on where you want to place a phone number. Following this labeling will help us when looking at data in Google Analytics.<br />
			<div class="typical_box">
				<li><b>Header:</b> "<span id="phone_shortcode_help6" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help6\')">Phone Clicks in Header</span>"</li>
				<li><b>Footer:</b> "<span id="phone_shortcode_help7" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help7\')">Phone Clicks in Footer</span>"</li>
				<li><b>Sidebar:</b> "<span id="phone_shortcode_help8" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help8\')">Phone Clicks in Sidebar (Just Ask Widget)</span>"</li>
				<li><b>Content:</b> "<span id="phone_shortcode_help9" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help9\')">Phone Clicks in Page (Last Paragraph)</span>"</li>
				<li><b>Images:</b> "<span id="phone_shortcode_help10" class="frn_shortcode_sel" onClick="selectText(\'phone_shortcode_help10\')">Phone Clicks in Page (Banner)" or "Phone Clicks in Header (Banner)</span>"</li>
			</div></td>
		</tr>
	</table>
	<br />
	
	';
		
		
	$screen->add_help_tab( array(
		'id'    => 'frn_tab_phone',
		'title' => __( 'Phone Shortcode', 'frn_phone_help' ),
		'content' => __( $phone_help, 'frn_phone_help'
		),
	)
	);

	$screen->add_help_tab( array(
		'id'    => 'frn_tab_ga',
		'title' => __( 'Google Analytics', 'frn_ga_help' ),
		'content'   => __( '
			<br />
			<h2>Help for Google Analytics Options</h2>
			<p>Most of the activation options are not available for Universal Analytics. Be sure to click the question mark icon next to each item to see the specifics.</p>
			<h3>General Information</h3>
			<p>The system automatically turns off Google Analytics for us admins. It will display a note in the header like "YOU ARE LOGGED IN and therefore not being tracked in Google Analytics or the FRN setting for the GA ID is empty". If the page is missing a Google Analytics ID, then another message will display on the page clarifying that. If you want to override the defaults and force the Google code to show for everyone visiting the site, place a checkmark in the box for "Test Mode".</p> <p>This code tracks click events on downloads, emails, 404 errors, and outbound links. As a result, it also automatically adds a target=_blank to all links that do not match the root domain for the site. For example, if the site has a www at the front of the page where the link is, but the link does not have www even though it\'s to another page on the same site, this code will still think it\'s an outbound link. Someday we\'ll code an exception, but for now this is how it\'ll function until it becomes an issue.</p>
			<h3>404 Page Titles</h3>
			<p>The default for the 404 page title is "Page Not Found". That\'s the WordPress default. However, some themes come with a 404 page template and sometimes they change it to "Nothing found for..." or something similar. Enter the beginning words of the page title for the 404 page--the words between the &lt;title&gt; tags at the top of the page. If you don\'t include this, then details on 404 errors will not be tracked--only that a 404 error occurred. The 404 event tracking in Analytics will tell us what page they were trying to visit when they got the error. We can then try to fix those broken link periodically.</p>
			<h3>Universal Analytics</h3>
			<p>This is Google\'s new way of integrating Analytics into a site. You must convert this site\'s Analytics account to <a href="https://developers.google.com/analytics/devguides/collection/upgrade/guide" target="_blank" >Universal Analytics</a> via the account\'s admin in the Property settings BEFORE activating the option in the plugin below. Activating this will switch the GA code to this new version. To activate demographics in Universal Analytics, you need to go to the site\'s Property settings  (<a href="https://www.google.com/analytics/web/?hl=en#management/Settings/a33689825w61035006p62464467/%3Fm.page%3DPropertySettings/" target="_blank">FRN Events example</a>). Once Google lets you know it\'s complete, you can then select this option in the plugin below. Activating this will switch the GA code to this new version. For us, there are no additional features we\'ll use when compared to the classic version other than maybe a lighter page. It mostly helps with Adwords and if we provide logins on our sites (as of 4/15/14).</p>
			<h3>DoubleClick Demographics</h4>
			<p>This affects the privacy policy. To activate this feature using Universal Analytics, go to the site\'s Property settings  (<a href="https://www.google.com/analytics/web/?hl=en#management/Settings/a33689825w61035006p62464467/%3Fm.page%3DPropertySettings/" target="_blank">FRN Events example</a>). This feature uses DoubleClick advertising data and what they assume about a person as they visit sites on the web. The old version pulls Google\'s Analytics JS code from DoubleClick servers instead of Google\'s. Universal Analytics works differently. Learn more: <a href="https://support.google.com/analytics/answer/2819948?hl=en" target="_blank" >Activating Demographics</a></p>
			<h3>Enhanced Link Attribution</h3>
			<p>Enhanced link attribution starts tracking where links are clicked on a page. Normally when looking at in-page analytics, if more than one link goes to the same page, they would all have the same numbers (i.e. pageviews). Activating this will tell Google to track how many clicks each individual link on a page actually gets. It\'s best if you are planning on optimizing a webpage on the site. Otherwise, keep it off. Activating this will not apply to data in the past--only going forward. Learn more: <a href="https://support.google.com/analytics/answer/2558867?hl=en" target="_blank" >Enhanced link attribution</a></p>
			', 'frn_ga_help'
		),
	) );
	
	$screen->add_help_tab( array(
		'id'    => 'frn_tab_lhn',
		'title' => __( 'LiveHelpNow', 'frn_lhn_help' ),
		'content'   => __( '
			<br />
			<h2>LHN Shortcode</h2>
			<p>The shortcode allows us to place basic code anywhere in a page, header, footer, or widget and WordPress will automatically replace it with whatever we tell it to. It acts like a variable we can make happen or change at any time.</p>
			<p>Remember that you set the site-wide chat and email button defaults here on this page below. When you do so, all you need to add to a page is the basic shortcodes (e.g. [lhn_inpage button="chat"]). Only use the id or url attributes when you want to customize the buttons on one particular page.</p>
			<div class="typical_box">
				<h3>Shortcode Options:</h3>
				<table class="customizable_options"><tr>
				<td><li>Both Buttons All Defaults:</li>
					<li>Only the Chat Button:</li>
					<li>Customized Chat Button:</li>
					<li>Only the Email Button:</li>
					<li>Customized Email Button:</li></td>
				<td><li><b><span id="lhn_shortcode_help1" class="frn_shortcode_sel" onClick="selectText(\'lhn_shortcode_help1\')">[lhn_inpage]</span></b> (or [lhn_inpage button="both"])</li>
					<li><b><span id="lhn_shortcode_help2" class="frn_shortcode_sel" onClick="selectText(\'lhn_shortcode_help2\')">[lhn_inpage button="chat"]</span></b></li>
					<li><b><span id="lhn_shortcode_help3" class="frn_shortcode_sel" onClick="selectText(\'lhn_shortcode_help3\')">[lhn_inpage button="chat" id="####"]</span></b></li>
					<li><b><span id="lhn_shortcode_help4" class="frn_shortcode_sel" onClick="selectText(\'lhn_shortcode_help4\')">[lhn_inpage button="email"]</span></b></li>
					<li><b><span id="lhn_shortcode_help5" class="frn_shortcode_sel" onClick="selectText(\'lhn_shortcode_help5\')">[lhn_inpage button="email" url="http://mylink.com/image.png"]</span></b></li></td>
				</tr></table>
			</div>
			<br />
			<p><b>Directions for Each Button:</b> Use the [lhn_inpage] shortcode to display the default LHN buttons on a page side-by-side (or [lhn_inpage button="both"]). It will add a style to the page with display:inline and puts a div id="lhn_buttons" around both buttons. Use [lhn_inpage button="email"] or [lhn_inpage button="chat"] to show only the respective buttons and control their layout. The chat button will wrap to its own line unless you add a &lt;div&gt; around the button shortcode and then create a style with a sub &lt;div&gt; and make it display:inline (similar to the default when the [lhn_inpage] is used by itself.</p>
			<p><b>Customize Chat Button:</b> To customize a chat button, upload your button image to the <a href="https://www.livehelpnow.net/lhn/console/admin/install_live_chat_button/code1.aspx?style=30" target="_blank">main LHN website</a> that stores the online/offline button images. You\'ll and add an id="####" to the shortcode (replacing the #### with the button id).</p>
			<p><b>Customize Email Button:</b> To use a custom email button, add email_url="" to the shortcode. Put the full HTTP web address to the image in between the quotes.
			<p><b>System Defaults:</b> Leaving the button id and email url fields blank will default to our standard LHN buttons. Selecting to deactivate the buttons here will turn them off everywhere on the site where the shortcode is used.</p>
			<br />
			<br />
			', 'frn_lhn_help'
		),
	) );
	
	$screen->add_help_tab( array(
		'id'    => 'frn_tab_ftr',
		'title' => __( 'Footer Elements', 'frn_ftr_help' ),
		'content'   => __( '
			<br />
			<h2>Footer Section Options</h2>
			This section includes settings for both the privacy policy URL and Chartbeat tracking code.
			<h3>Privacy Policy URL Shortcode</h3>
			Since we treat privacy policy styling and location so differently, the only element generally consistent was the URL. If we decide that we want to be more consistent, we can create another shortcode that represents more code. Leaving the URL field blank will use the default URL that points to the policy included with our plugin. If you have a custom version for this site, enter the URL for its location here. It will automatically change the URL for all privacy shortcodes used on the site. You can have a special privacy policy just for one page by adding "url" to the shortcode and using a full URL to the privacy policy. It will override all defaults (e.g. [frn_privacy_url url="http://website.com/privacy.html"]).<br />
			<br />
			<div class="typical_box">
				Shortcode: <b><span id="priv_shortcode_help2" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help2\')">[frn_privacy_url url="[optional]"\']</span></b><br />
				Footer.php: <b><span id="priv_shortcode_help3" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help3\')">&lt;?php echo do_shortcode("[frn_privacy_url]"); ?&gt;</span></b>
			</div>
			<br />
			<h3>Default Footer Shortcode</h3>
			<p>The standard footer format for FRN is:</p> 
			<p><strong>&lt;p style="text-align:center;"&gt;Copyright © '.date("Y").' [site name]. All Rights Reserved. | Confidential and Private Call: 877.714.1318 | Privacy Policy&lt;/p&gt;</strong></p>
			<p><strong>Activate Auto Footer:</strong> You can automatically add a footer to the wp_footer() template location on a page simply by placing a check in the Activate Auto Footer checkbox. Wp_footer() needs to be in the location in footer.php where you want the copyright to show. However, any plugins and default WordPress JavaScript code also goes into the wp_footer() location. In most cases, the copyright info will show above any scripts added, but since we can\'t control third party plugins, their scripts may affect spacing and possibly styling if they add CSS into the footer area. Also, if you keep the shortcode in footer.php and have the Activate Auto Footer checked, you will have two footers showing on the page. You will need to remove the shortcode from footer.php or deactivate the auto feature checkbox. </p>
			<p><strong>Shortcode Options</strong>: By using the shortcode below, a version like that will be added to the footer incorporating the FRN Settings. Like normal, you can customize pieces of the shortcode to keep it dynamic and to make it easier to update all sites with the FRN plugin. You can change the alignment, start year, copyright name, phone number, privacy policy url, phone number styling, and Google Analytics event category and labels. If you don\'t want to customize an element, just don\'t use the variable in the example shortcode below. Here is a list of all of the variables (example use of the variables are in the box below): <br />
				<ul>
					<li style="margin-bottom:0;"><span id="priv_shortcode_help4" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help4\')" style="font-weight:bold;">align=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help5" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help5\')" style="font-weight:bold;">startyear=""</span> (If not used, then no year range will be used in footer)</li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help6" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help6\')" style="font-weight:bold;">sitename=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help7" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help7\')" style="font-weight:bold;">frn_phone=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help8" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help8\')" style="font-weight:bold;">frn_privacy_url=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help9" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help9\')" style="font-weight:bold;">ga_phone_category=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help10" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help10\')" style="font-weight:bold;">ga_phone_location=""</span> (default is "Phone Clicks in Footer")</li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help11" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help11\')" style="font-weight:bold;">ga_phone_label=""</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help12" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help12\')" style="font-weight:bold;">frn_number_style=""</span> (refer to the phone number shortcode for options)</li>
					<li style="margin-top:0;"><span id="priv_shortcode_help13" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help13\')" style="font-weight:bold;">paragraph="no"</span> (use "no" if you don\'t want P tags around footer)</li>
					<li style="margin-top:0;"><span id="priv_shortcode_help13b" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help13b\')" style="font-weight:bold;">nodiv="yes"</span> (use "yes" or "y" if you don\'t want the div tags around the footer)</li>
				</ul></p>
			<p><br />
				<strong>Using a Customized Footer</strong>: You can also use your own footer code but keep the year, name, phone number and privacy policy url dynamic so you only have to change those in one place. Whatever you add there will automatically be added to the normal footer locations (using the auto footer or shortcode). An example of what you could use in the footer textbox below would be: </p>
				<span id="priv_shortcode_help14a" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help14a\')" style="font-weight:bold;margin-left:30px;">&lt;div&gt;Copyright 2006-%%year%% %%site_name%% | Let us help. %%frn_phone%% | &lt;a href="%%frn_privacy_url%%"&gt;Privacy Policy&lt;/a&gt;&lt;/div&gt;</span>
				<p>You must use %% or square brackets around variables to have them replaced by the default settings. The only features lost in this version is the ability to customize the phone number font formatting. You\'ll have to modify the actual CSS file to affect formatting. All other normal shortcode parameters listed above will still affect the dynamic elements you add below. This mostly helps with the Google Analytics event category and labels. The full list of dynamic elements you can add to your code are: 
				<ul>
					<li style="margin-bottom:0;"><span id="priv_shortcode_help14" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help14\')" style="font-weight:bold;">%%year%%</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help15" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help15\')" style="font-weight:bold;">%%sitename%%</span></li>
					<li style="margin-top:0;margin-bottom:0;"><span id="priv_shortcode_help16" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help16\')" style="font-weight:bold;">%%frn_phone%%</span> (Analytics label will be "Phone Clicks in Footer")</li>
					<li style="margin-top:0;"><span id="priv_shortcode_help17" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help17\')" style="font-weight:bold;">%%frn_privacy_url%%</span></li>
				</ul></p>
			<br />
			<div class="typical_box">
				Shortcode: <b><span id="priv_shortcode_help18" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help18\')" style="font-weight:bold;">[frn_footer startyear="optional" sitename="optional" frn_phone="optional" privacy_url="optional" ga_phone_location="optional" \']</span></b><br />
				Footer.php: <b><span id="priv_shortcode_help19" class="frn_shortcode_sel" onClick="selectText(\'priv_shortcode_help19\')" style="font-weight:bold;">&lt;?php echo do_shortcode(\'[frn_footer start_date="optional" site_name="optional" frn_phone="optional" privacy_url="optional"]\'); ?&gt;</span></b>
			</div>
			<br />
			<h3>Chartbeat Options</h3>
			<p>To test to make sure Chartbeat is working, select the "test" radio button. You can then view the source code for the site and make sure things are filled out correctly. Select "activate" to make sure that company employees are not tracked.</p>
			<p>Chartbeat code is automatically disabled for people logged into the site or accessing it from the company IP addresses (206.19.211.16 and 173.164.20.3; <b>your IP is '.$_SERVER['REMOTE_ADDR'].'</b>).</p>
			<p>To add a category or change the name of it, we can easily do that by using the plugin and then rolling it out to all the sites. We could use a function to automatically reset the category to something else for, let\'s say all the "niche" sites. But it\'s like no matter how we slice it, we\'ll have to go back to the specific sites to select the new category. Renaming is not challenging either. In the end, adding a category is easy. It\'s the choosing the category that needs to be manual.</p><br /> <br />
			
			', 'frn_ftr_help'
		),
	) );
	
	$screen->add_help_tab( array(
		'id'    => 'frn_social_info',
		'title' => __( 'Social Help', 'frn_social_help' ),
		'content'   => __( '
			<br />
			<h2>Social Shortcode Options</h2>
			<ul>
			<li>All Buttons: The shortcode in the social section at the bottom allows you to just place one shortcode for all three buttons and customize as needed. This reduces duplication and helps with positioning when all three are used. Not all attributes are needed. There are defaults for all of them except bold, tweet, image, and summary.</li>
			<li>Default Twitter options use the page\'s URL for the shared url after your message followed by the username and "Tweet It" for the linked text on the page. Cross promoted/related Twitter usernames will be suggested after the person sends their tweet if they don\'t follow the account.</li>
			<li>Default Twitter button options use the page\'s URL for the shared url, "Tweet" for the button, and the medium sized button. Everything else if blank will not be in the code. Using a float left or float right will help line up the button vertically if used in line with text--although it will then be thrust to the front or end of the line. Consider adding a &lt;div&gt; around it to help.</li>
			<li>If you don\'t want a button showing in the list of icons, add the label for it and make it equal no (e.g. linkedin="no"). You cannot customize the title, image, or shared page URL for buttons.</li>
			<li>Although, this shortcode will work in all the places our other shortcodes work, only use this text in widget, post, or page content due to the code including links and JavaScript.</li>
			<li>To get analytics on all of our sites that use the ShareThis button, go to <a href="http://sharethis.com/publishers/social-analytics.php#mainNav:nav-left-list-trends" target="_blank">ShareThis Social Analytics</a> and login with the FRN account. The twitter link and button will be tracked in Google Analytics. If you add a Facebook or Google+ button using the code found on their sites, Analytics will pick up sharing activity there too.</li>
			<li>Pinterest: The counter default is none. But you can use "above" or "beside" if you want the counter to show. To use the larger button, use version="large". To use just the round icon, use version="icon" or circular. To change the button to red or white, just use color="red" or white in the shortcode. To use a button that allows the person to select any article image on the page, just use [frn_social type="PINTEREST"]. </li>
			</ul>
			<p><br />
				You can get fully customized ShareThis code by logging in and building your own buttons. There are dozens to choose from. </p>
				<p><b>IMPORTANT</b>: When adding buttons to content after first clicking the "text" tab and then switch to the "visual" tab, WordPress likes to remove variables in spans that are not normal HTML variables. ShareThis is foremost affected, but sometimes the others are as well. So, use with caution.<br />
				<li><a href="http://www.sharethis.com/get-sharing-tools/">Go to ShareThis.com</a></li>
			</p>
			<p>You can get fully customized Twitter code:<br />
				<li><a href="https://about.twitter.com/resources/buttons">Twitter Buttons</a></li>
			</p>
			<p>You can get fully customized Pinterest code:<br />
				<li><a href="http://business.pinterest.com/en/widget-builder#do_pin_it_button">Pinterest Buttons</a></li>
			</p>
			<p>You can get fully customized Facebook buttons:<br />
				<li><a href="https://developers.facebook.com/docs/plugins/like-button">Like Buttons</a></li>
				<li><a href="https://developers.facebook.com/docs/plugins/share-button">Share Buttons</a></li>
				<li><a href="https://developers.facebook.com/docs/plugins/follow-button">Follow Buttons</a></li>
			</p>
			<p>You can get fully customized Goolge+ buttons:<br />
				<li><a href="https://developers.google.com/+/web/share/">Google+ Buttons</a></li>
			</p>
			', 'frn_social_help' )
	) );
	
	

	
	// Set help sidebar
	$screen->set_help_sidebar(
		'
		<h3>Updating the Plugin</h3>
		This is not in the WordPress plugins store. You must use FTP to drag over the non-zipped files or use ManageWP to upload a new zip file that contains all of the plugin files. You cannot just upload a zip file via the Plugins section of WordPress since it will not let you overwrite the files. Contact Daxon Edwards if you find and error or need help (615-400-2064).
		<ul>
			<li></li>
		</ul>
		'
	);
	
}
if ( is_admin() ) add_filter('contextual_help', 'my_plugin_help', 10, 3);







/////
// FRN Phone: displays the settings for the phone shortcode

// Creates the field for the phone number shortcode
function frn_phone_field() {
	$options_phone = get_option('site_phone_number');
	
	//for copy text script
	$frn_shortcode='[frn_phone ga_phone_location="Phone Clicks in ##page location##"]';
	$php_shortcode = '&lt;?php echo do_shortcode(\''.$frn_shortcode.'\'); ?&gt;';
	$frn_shortcode2='[frn_phone ga_phone_location="Phone Clicks in ##page location##" image_url="" alt="" title="" css_style="" id="" class=""]';
	$php_shortcode2 = '&lt;?php echo do_shortcode(\''.$frn_shortcode2.'\'); ?&gt;';
	$section_id = 'frn_plugin_phone';
	$shortcode_box = $section_id.'_box';
	
	echo "<input id='".$section_id."' name='site_phone_number[site_phone]' size='60' type='text' value='{$options_phone['site_phone']}' />";
	
	//auto scan dropdown
	?>
	<strong>Auto Scan:</strong> 
	<select id='frnphone_auto_scan' name='site_phone_number[auto_scan]'>
	  <option value="D" <?=($options_phone['auto_scan']=="D" || $options_phone['auto_scan']=="") ? "selected " : "" ; ?>>Disabled</option>
	  <option value="C" <?=$options_phone['auto_scan']=="C" ? "selected " : "" ; ?>>Only Content Fields</option>
	  <option value="W" <?=$options_phone['auto_scan']=="W" ? "selected " : "" ; ?>>Only Widgets</option>
	  <option value="WC" <?=$options_phone['auto_scan']=="WC" ? "selected " : "" ; ?>>Only Widgets & Content</option>
	  <option value="A" <?=$options_phone['auto_scan']=="A" ? "selected " : "" ; ?>>Entire Page (No Shortcodes)</option>
	</select> <small>Use "entire page" if no shortcodes</small>
	<?php
	echo "
	<div id='frn_plugin_phone_help' class='frn_help_boxes'>
		<li><strong>Formatting: </strong>Do not use letters in phone number or they will be stripped out in the link. The number format will display on the page just like you enter it here but will be formatted differently in the link itself (a friendly version for smartphones).</li>
		<li><strong>Auto Scan: </strong>Only use the auto scan \"Entire Page\" option if you have not used shortcodes or manually added our frn_phones SPAN code anywhere on the site. If you have, this feature will shut down on those pages that have the SPAN code already added. To be found, phone numbers must have a period, bracket, &lt; or &gt;, or space before and/or after the number to be found. See the FRN Help tab above for all details.</li>
		<li><strong>Analytics: </strong>In Analytics, all phone numbers that don't have an \"action\" set with the shortcode will use the event label \"Phone Clicks (General)\". The only time an action should be set is when the phone is in a prominent location on a page you wanted tracked separately. If the number is in the body of an article, you can just use the plain \"[frn_plugin]\" shortcode.</li>
		<li><strong>Images with Numbers: </strong>The shortcode for images with phone numbers actually builds the image HTML so it can be wrapped in a SPAN for mobile linking. See the FRN Help tab above for details and more options.</li>
		<li><strong>Limitations: </strong>Shortcodes only work in the HEAD area (i.e. meta descriptions), page titles, excerpts, frn_plugin fields on this page and shortcodes, widgets and content. You can't use them in menus, SEO fields, theme options, or other plugins.</li>
	</div>
	".'
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="top">Shortcode for Text: </td>
			<td valign="top"><b><span id="'.$shortcode_box.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'\')">'.$frn_shortcode.'</span></b> <font size="1">(most common for posts)</font></td>
		</tr><tr>
			<td valign="top">PHP: </td>
			<td valign="top"><b><span id="'.$shortcode_box.'php" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'php\')">'.$php_shortcode.'</span></b> <font size="1">(most common for use in header.php)</font></td>
	</tr><tr>
			<td valign="top" style="padding-top:5px;border-top:1px solid gray;">Shortcode for Images: </td>
			<td valign="top" style="padding-top:5px;border-top:1px solid gray;"><b><span id="'.$shortcode_box.'2" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'2\')">'.$frn_shortcode2.'</span></b></td>
	</tr><tr>
			<td valign="top">Image PHP: </td>
			<td valign="top"><b><span id="'.$shortcode_box.'php2" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'php2\')">'.$php_shortcode2.'</span></b></td>
	</tr></table></div><font size="1">See FRN HELP tab at top-right for more customizing and tracking options</font>
	
	';
}
//validate function--not really validating just trimming for storage
function plugin_options_validate($input) {
	//sets up an array in case more variables should be added
	$newinput['site_phone'] = trim($input['site_phone']);
	$newinput['auto_scan'] = trim($input['auto_scan']);
	return $newinput;
}
// Text between the section H2 and the settings field for shortcode
function frn_shortcode_section_text() { 
	echo '
	<script type="text/javascript">
		var change_help = document.getElementById("contextual-help-link");
		change_help.innerHTML = "<img src=\''.plugins_url().'/frn_plugins/images/frn_icon_menu.png\' /> FRN Help";
	</script>
	';
}
function frn_before_sitebase_info() { 
	//not used
}
//function frn_admin_head() {
//}
//if ( is_admin() ) add_action( 'admin_head', 'frn_admin_head' );

function load_custom_wp_admin_stuff() {
	wp_register_script( 'frn_wp_admin_script', plugins_url(). '/frn_plugins/admin_scripts.js', false, '2.0.0' );
	wp_enqueue_script( 'frn_wp_admin_script' );
	wp_register_style( 'frn_wp_admin_css', plugins_url(). '/frn_plugins/frn_plugins_admin.css', false, '2.1.0' );
	wp_enqueue_style( 'frn_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_stuff' );




//////
// Head Code: Settings fields for HEAD Components

//Used for HEAD section form to add text between h2 and form fields
function text_before_head_form() {
	//return "";
}
// field for Google analytics id
function ga_id_field() {
	$options = get_option('site_head_code');
	if($options['site_ga_test']!="") $ga_testmode = " checked";
	else $ga_testmode = "";
	echo "<input id='frn_plugin_ga' name='site_head_code[site_ga_id_value]' size='60' type='text' value='{$options['site_ga_id_value']}' /><br /> 
	<input type='checkbox' name='site_head_code[site_ga_test]' value='Test'".$ga_testmode." style='margin-left:8px;'>&nbsp;&nbsp;Test Mode 
	<div id='frn_plugin_ga_help' class='frn_help_boxes'>Leave blank if you don't want the tracking code to be on the site. If you want to override the defaults and force the Google code to show for everyone visiting the site, place a checkmark in the box for \"Test Mode\". This code also automatically adds a target=_blank to all outbound links.</div>
	";
}
//field for 404 page title
function ga_404_field() {
	$options_404 = get_option('site_head_code');
	//if($options_404['frn_ga_404']=="") $options_404['frn_ga_404']="Page Not Found";  //disabled since javascript handles this if it's blank. default = Page Not Found
	echo "<input id='frn_plugin_ga_404' name='site_head_code[frn_ga_404]' size='60' type='text' value='{$options_404['frn_ga_404']}' />
	<div id='frn_plugin_ga_404_help' class='frn_help_boxes'>Leaving blank will use the default \"Page Not Found\" in tracking 404 events. Enter the beginning words of the page title for the 404 page--the words between the &lt;title&gt; tags in the HTML, also used in browser tabs. </div>
	";
}
//field for Universal Analytics
function ga_ua_field() {
	$options_ua = get_option('site_head_code');
	if($options_ua['frn_ga_ua']=="Activate") $activate_chkd=" checked";
	if($options_ua['frn_ga_ua']=="Deactivate" or $options_ua['frn_ga_ua']=="") $deactivate_chkd=" checked";
	//onClick="disable_ga_features(\'frn_plugin_frn_ga_dgrphx\',\'frn_plugin_frn_ga_dgrphx2\')"; //used to deactivate form fields
	//onClick="enable_ga_features(\'frn_plugin_frn_ga_dgrphx\',\'frn_plugin_frn_ga_dgrphx2\')";
	echo '
	<input id="frn_plugin_frn_ga_ua" type="radio" name="site_head_code[frn_ga_ua]" value="Activate" '.$activate_chkd.' /> Activate <br />'."\n".'
	<input id="frn_plugin_frn_ga_ua" type="radio" name="site_head_code[frn_ga_ua]" value="Deactivate" '.$deactivate_chkd.' /> Deactivate'."\n".'
	<div id="frn_plugin_frn_ga_ua_help" class="frn_help_boxes">This is Google\'s new way of integrating Analytics into a site. You must convert this site\'s Analytics account to <a href="https://developers.google.com/analytics/devguides/collection/upgrade/guide" target="_blank" >Universal Analytics</a> via the account\'s admin and Property settings. Once Google lets you know it\'s complete, you can then select this option in the plugin below. Activating this will switch the GA code to this new version. For us, there are no additional features we\'ll use when compared to the classic version other than maybe a lighter page. It mostly helps with Adwords and if we provide logins on our sites (as of 4/15/14).</div>
	';
}
//field for DoubleClick Demographic data
function ga_dgrphx_field() {
	$options_demo = get_option('site_head_code');
	if($options_demo['frn_ga_dgrphx']=="Activate") $activate_chkd=" checked";
	if($options_demo['frn_ga_dgrphx']=="Deactivate" or $options_demo['frn_ga_dgrphx']=="" ) $deactivate_chkd=" checked";
	//No longer true. Recognized 6/4/14.
	//if($options_demo['frn_ga_ua']=="Activate") {
	//	$disable_field = " disabled";
	//	$ua_demo_note = "To get demographics reporting when you are using Universal Analytics, you do not need to activate it here. But you will need to activate it in the Profile Properties for this website in Google Analytics. ";
	//}
	echo '
	<input id="frn_plugin_frn_ga_dgrphx" type="radio" name="site_head_code[frn_ga_dgrphx]" value="Activate" '.$activate_chkd.$disable_field.' /> Activate <br />'."\n".'
	<input id="frn_plugin_frn_ga_dgrphx2" type="radio" name="site_head_code[frn_ga_dgrphx]" value="Deactivate" '.$deactivate_chkd.$disable_field.' /> Deactivate'."\n".'
	<div id="frn_plugin_frn_ga_dgrphx_hlp" class="frn_help_boxes">This affects the privacy policy. You must also activate this option in the site\'s Property settings (<a href="https://www.google.com/analytics/web/?hl=en#management/Settings/a33689825w61035006p62464467/%3Fm.page%3DPropertySettings/" target="_blank">FRN Events example</a>).  This will enable Google to report on the demographics and interests of those visiting the site based on what DoubleClick Advertising assumes about a person as they visit sites on the web. Learn more: <a href="https://support.google.com/analytics/answer/2819948?hl=en" target="_blank" >Activating Demographics</a></div>';
}
//field for Enhanced Link Attribution for in-page link tracking
function ga_ea_field() {
	$options_ea = get_option('site_head_code');
	if($options_ea['frn_ga_ea']=="Activate") $activate_chkd=" checked";
	if($options_ea['frn_ga_ea']=="Deactivate" or $options_ea['frn_ga_ea']=="") $deactivate_chkd=" checked";
	echo '
	<input id="frn_plugin_frn_ga_ea" type="radio" name="site_head_code[frn_ga_ea]" value="Activate" '.$activate_chkd.' /> Activate <br />'."\n".'
	<input id="frn_plugin_frn_ga_ea" type="radio" name="site_head_code[frn_ga_ea]" value="Deactivate" '.$deactivate_chkd.' /> Deactivate'."\n".'
	<div id="frn_plugin_frn_ga_ea_help" class="frn_help_boxes">Enhanced link attribution starts tracking where links are clicked on a page. To activate, you must go to the site\'s Property settings in Analytics in the In-Page Analytics section and select "Use enhanced link attribution" (<a href="https://www.google.com/analytics/web/?hl=en#management/Settings/a33689825w61035006p62464467/%3Fm.page%3DPropertySettings/" target="_blank">FRN Events example</a>). Normally when looking at in-page analytics, if more than one link goes to the same page, they would all have the same numbers (i.e. pageviews). Activating this will tell Google to track how many clicks each individual link on a page actually gets. It\'s best if you are planning on optimizing a webpage on the site. Otherwise, keep it off. Activating this will not apply to data in the past--only going forward. Be sure to make a note in the Analytics charts that you made this change. Learn more: <a href="https://support.google.com/analytics/answer/2558867?hl=en" target="_blank" >enhanced link attribution</a></div>
	';
}
//field for removing external link icon (affects javascript)
function ga_extlinkicon_field() {
	$options_extlink = get_option('site_head_code');
	if($options_extlink['ext_link_icon']=="A" || $options_extlink['ext_link_icon']=="") $activate_chkd=" checked";
	elseif($options_extlink['ext_link_icon']=="D") $deactivate_chkd=" checked";
	echo '
	<div style="float:right;width:60%;"><small>You can disable an icon on a specific link by adding <b><span id="ext_link_icon" class="frn_shortcode_sel" onClick="selectText(\'ext_link_icon\')">data-exticon="no"</span></b> to the &lt;a href&gt; portion.</small></div>
	<input id="frn_ext_link_input" type="radio" name="site_head_code[ext_link_icon]" value="A" '.$activate_chkd.' /> Activate Icon: <img src="'.plugins_url().'/frn_plugins/images/icon_ext_links.png" /><br />'."\n".'
	<input id="frn_ext_link_input" type="radio" name="site_head_code[ext_link_icon]" value="D" '.$deactivate_chkd.' /> Deactivate'."\n".'
	<div id="frn_ext_link_icon" class="frn_help_boxes">By default, an icon will show to the right of any external links found. If you don\'t want that on the site, select deactivate above and it will remove the icons from the site.</div>
	';
}
//field for removing external link icon (affects javascript)
function ga_extlinktarget_field() {
	$options_exttarget = get_option('site_head_code');
	if($options_exttarget['ext_link_target']=="A" || $options_exttarget['ext_link_target']=="") $activate_chkd=" checked";
	elseif($options_exttarget['ext_link_target']=="D") $deactivate_chkd=" checked";
	echo '
	<div style="float:right;width:60%;"><small>You can disable a specific link\'s target by adding <b><span id="ext_link_target" class="frn_shortcode_sel" onClick="selectText(\'ext_link_target\')">data-target="no"</span></b> to the &lt;a href&gt; portion.</small></div>
	<input id="frn_ext_target_input" type="radio" name="site_head_code[ext_link_target]" value="A" '.$activate_chkd.' /> Activate<br />'."\n".'
	<input id="frn_ext_target_input" type="radio" name="site_head_code[ext_link_target]" value="D" '.$deactivate_chkd.' /> Deactivate'."\n".'
	<div id="frn_ext_link_target" class="frn_help_boxes">By default, any external links will open in a new window. "www" will throw it off. Make sure all your links match the root domain of the site or this feature will open even internal links in a new window.</div>
	';
}
// cleans up data before stored using plugin_admin_init
function plugin_options_head($input) {
	//sets up an array as more variables are added
	$newinput['site_ga_id_value'] = trim($input['site_ga_id_value']);
	$newinput['site_ga_test'] = trim($input['site_ga_test']);
	$newinput['frn_ga_404'] = trim($input['frn_ga_404']);
	$newinput['frn_ga_ua'] = trim($input['frn_ga_ua']);
	$newinput['frn_ga_dgrphx'] = trim($input['frn_ga_dgrphx']);
	$newinput['frn_ga_ea'] = trim($input['frn_ga_ea']);
	$newinput['ext_link_icon'] = trim($input['ext_link_icon']);
	$newinput['ext_link_target'] = trim($input['ext_link_target']);
	return $newinput;
}





///////
// LiveHelpNow Options
//Text before LHN form

function text_before_lhn_form() {
	//return "";
}
//field for lhn slideout activation radio button
function lhn_activation() {
	$options_lhn = get_option('site_lhn_code');
	if($options_lhn['lhn_activation']=="Activate") $activate_chkd=" checked";
	else if($options_lhn['lhn_activation']=="Deactivate" or $options_lhn['lhn_activation']=="") $deactivate_chkd=" checked";
	if($options_lhn['lhn_ph_slideout']=="Include") $phoneinclude_chkd=" checked";
	else $phoneinclude_chkd="";
	echo '
	<input id="frn_plugin_lhn_activate" type="radio" name="site_lhn_code[lhn_activation]" value="Activate" '.$activate_chkd.' /> Activate <br />'."\n".'
	<input id="frn_plugin_lhn_activate" type="radio" name="site_lhn_code[lhn_activation]" value="Deactivate" '.$deactivate_chkd.' /> Deactivate'."\n".'<br />
	<div id="frn_plugin_lhn_activate_hlp" class="frn_help_boxes">This feature only activates the floating LiveHelpNow slideout button on the right side of the page. If the site is RehabAndTreatment.com, the phone number will not show in the LiveHelpNow HEAD code to allow phone numbers in the page to set the phone number in the slideout.</div>
	<table class=\"frn_options_table\"><tr>
			<td align="left">PreChat Window ID:</td>
			<td><input id="frn_plugin_lhn_window" type="text" name="site_lhn_code[lhn_window]" value="'.$options_lhn['lhn_window'].'" />'."\n".'</td>
	</tr></table>';
}
//field for lhn in-page buttons activation
function lhn_inpage() {
	$options_lhn = get_option('site_lhn_code');
	
	//for copy text script
	$frn_shortcode='[lhn_inpage button="chat/email" id="[chat only]" url="[email only]"]';
	$php_shortcode = '&lt;?php echo do_shortcode(\''.$frn_shortcode.'\'); ?&gt;';
	$section_id = 'frn_plugin_lhn_inpage';
	$shortcode_box = $section_id.'_box';
	
	if($options_lhn['lhn_inpageact']=="Activate") $activate_chkd=" checked";
	if($options_lhn['lhn_inpageact']=="Deactivate" or $options_lhn['lhn_inpageact']=="") $deactivate_chkd=" checked";
	echo '
	<input id="'.$section_id.'" type="radio" name="site_lhn_code[lhn_inpageact]" value="Activate" '.$activate_chkd.' /> Activate <br />'."\n".'
	<input id="'.$section_id.'" type="radio" name="site_lhn_code[lhn_inpageact]" value="Deactivate" '.$deactivate_chkd.' /> Deactivate<br />'." \n
	<table class=\"frn_options_table\"><tr>
			<td>Chat Button ID:</td>
			<td><input id='frn_plugin_lhn_chat' name='site_lhn_code[lhn_inpage_chat_btnid]' size='10' type='text' value='{$options_lhn['lhn_inpage_chat_btnid']}' /></td>
		<tr></tr>
			<td>Email Button URL:</td>
			<td><input id='frn_plugin_lhn_email' name='site_lhn_code[lhn_inpage_email_btnurl]' size='30' type='text' value='{$options_lhn['lhn_inpage_email_btnurl']}' /></td>
	</tr></table>".'
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="top">Shortcode: <font size=1 style="white-space:nowrap;">(most common)</font></td>
			<td valign="top"><b><span id="'.$shortcode_box.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'\')">'.$frn_shortcode.'</span></b></td>
		</tr><tr>
			<td valign="top">PHP: </td>
			<td valign="top"><b><span id="'.$shortcode_box.'php" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'php\')">'.$php_shortcode.'</span></b></td>
	</tr></table></div>
	
	';
	echo '
	<div id="frn_plugin_lhn_inpage_hlp" class="frn_help_boxes">
		Use the <b>[lhn_inpage]</b> shortcode to display the default LHN buttons on a page side-by-side. Use <b>[lhn_inpage button="email"]</b> or <b>[lhn_inpage button="chat"]</b> to show only the respective buttons.<br /> <br />
		To customize a chat button on just one page, upload your button image to the LHN servers and add <b>button_id="####"</b> to the shortcode (replacing the #### with the button id). To use a custom email button, add <b>email_url=""</b> to the shortcode. Put the full HTTP web address to the image in between the quotes.<br /> <br />
		Leaving the button id and email url fields blank will default to our standard LHN buttons. Selecting to deactivate the buttons here will turn them off everywhere on the site where the shortcode is used.</div>
	';
}
// cleans up data before stored using plugin_admin_init
function plugin_options_lhn($input) {
	//sets up an array when more variables are added
	$newinput['lhn_activation'] = trim($input['lhn_activation']);
	$newinput['lhn_window'] = trim($input['lhn_window']);
	$newinput['lhn_inpageact'] = trim($input['lhn_inpageact']);
	$newinput['lhn_inpage_chat_btnid'] = trim($input['lhn_inpage_chat_btnid']);
	$newinput['lhn_inpage_email_btnurl'] = trim($input['lhn_inpage_email_btnurl']);
	return $newinput;
}





////////
// Settings form for Footer Components

// Prep Footer form fields
function text_before_ftr_form() {
	//return "";
}
function ftr_priv_url_funct() {
	$options_ftr = get_option('site_footer_code');  //must match second section of register_setting
	//if($options_ftr['ftr_priv_url']=="") $options_ftr['ftr_priv_url']= '[our default url]';
	
	//for copy text script for privacy url
	$frn_shortcode='[frn_privacy_url]';
	$php_shortcode = '&lt;?php echo do_shortcode(\''.$frn_shortcode.'\'); ?&gt;';
	$section_id = 'frn_plugin_priv_url';
	$shortcode_box = $section_id.'_box';
	
	echo "<input id='".$section_id."' name='site_footer_code[ftr_priv_url]' size='60' type='text' value='{$options_ftr['ftr_priv_url']}' /><br />
	".'
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="top">Shortcode: </td>
			<td valign="top"><b><span id="'.$shortcode_box.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'\')">'.$frn_shortcode.'</span></b></td>
		</tr><tr>
			<td valign="top">PHP: </td>
			<td valign="top"><font size="1">(PHP version is most common if ever used: add this to footer.php)<br /> </font>
			<b><span id="'.$shortcode_box.'php" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'php\')">'.$php_shortcode.'</span></b></td>
	</tr></table></div>
	'."
	<div id='frn_plugin_lhn_priv_hlp' class='frn_help_boxes'>Leaving blank will use the default URL for our privacy policy included with the plugin. If you have a custom version for this site, enter the URL for its location here. You can have a special privacy policy just for one page by adding \"url\" to the shortcode and using a full URL to the privacy policy. It will override all defaults (e.g. [frn_privacy_url url=\"http://website.com/privacy.html\"]).<br />
		<b>Shortcode: [frn_privacy_url url=\"[optional]\"']</b><br />
		<b>Header/Footer:</b> ".$php_shortcode.";
	</div>
	";
}
function ftr_funct() {
	$options_ftr = get_option('site_footer_code');  //must match second section of register_setting
	//for copy text script for copyright footer
	$frn_shortcode2='[frn_footer startyear="" sitename="" frn_phone="" frn_privacy_url="" ga_phone_location="" nodiv=""]';
	$php_shortcode2 = '&lt;?php echo do_shortcode(\''.$frn_shortcode2.'\'); ?&gt;';
	$section_id2 = 'frn_plugin_ftr';
	$shortcode_box2 = $section_id2.'_box';
	if(trim($options_ftr['act_autoftr'])!="") $activate_autoftr = " checked";
	else $activate_autoftr = "";
	$options_phone = get_option('site_phone_number');
		
	echo "<font size=1>See all customize options in <b>FRN HELP</b> tab at top.</font>
	<textarea id='".$section_id2."' cols='65' rows='5' name='site_footer_code[frn_footer]' >{$options_ftr['frn_footer']}</textarea><br />
	<input type='checkbox' name='site_footer_code[act_autoftr]' value='Activate'".$activate_autoftr." style='margin-left:8px;'>&nbsp; Activate Auto Footer <font size=1>(auto added to wp_footer() in footer.php file)</font>
	".'
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="top">Shortcode: </td>
			<td valign="top"><b><span id="'.$shortcode_box2.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2.'\')">'.$frn_shortcode2.'</span></b> <font size="1">(remove variables you don\'t want to customize)</font></td>
		</tr><tr>
			<td valign="top">PHP: </td>
			<td valign="top"><font size="1">(PHP version most common: add this to footer.php)<br /> </font>
			<b><span id="'.$shortcode_box2.'php" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2.'php\')">'.$php_shortcode2.'</span></b></td>
	</tr></table></div>
	'."
	<div id='frn_plugin_lhn_ftr_hlp' class='frn_help_boxes'>
		View the FRN HELP tab at the top to see all options and directions. Leaving the textbox above empty will use the default copyright and privacy arrangement wherever you put the shortcode in footer.php or if the Auto Footer is activated, wherever the wp_footer() code is in footer.php. The default footer: <br /> <br />
		<strong>&lt;p style=\"text-align:center;\"&gt;Copyright © 2010-".date('Y')." [Site Name]. All Rights Reserved. | Confidential and Private Call: ".stripslashes($options_phone['site_phone'])." | Privacy Policy &lt;/p&gt;</strong><br /> <br />
		<b>SHORTCODE PARAMETERS:</b> As you can see in the shortcode's parameters above (e.g. startyear=\"\"), you can customize specific pieces to keep them dynamic and make updating in the future easier. You'd leave the box above blank and just add those parameters to the shortcode you add into the footer.php. If you just want to use the default footer, remove all parameters and leave just \"frn_footer\" in the shortcode.<br /> <br />
		<b>CUSTOMIZED FOOTER: </b> If you have a custom version for this site, enter the code in the textbox above. Whatever you put into the textbox above will be used wherever you use the shortcode or the wp_footer() code is in footer.php. If you use both the shortcode and Auto Footer, the copyright information will be placed on the page twice. A good starting place for customizing your footer is:<br /> <br />
		<b><span id='".$shortcode_box2."_custom' class=\"frn_shortcode_sel\" onClick=\"selectText('".$shortcode_box2."_custom')\">&lt;div class=\"frn_footer\"&gt;Copyright 2006-%%year%% %%site_name%% | Let us help. %%frn_phone%% | &lt;a href=\"%%frn_privacy_url%%\"&gt;Privacy Policy&lt;/a&gt;&lt;/div&gt;</span></b><br /> <br />
	</div>
	";
}
function ftr_chrbt_chkbx_funct() {
	$options_ftr = get_option('site_footer_code');  //must match second section of register_setting
	if($options_ftr['ftr_chrbt_checkbox']=="Activate") $activate_chkd=" checked";
	if($options_ftr['ftr_chrbt_checkbox']=="Deactivate" or $options_ftr['ftr_chrbt_checkbox']=="") $deactivate_chkd=" checked";
	if($options_ftr['ftr_chrbt_checkbox']=="Test") $test_chkd=" checked";
	echo '
	<input type="radio" name="site_footer_code[ftr_chrbt_checkbox]" value="Activate"'.$activate_chkd.' >Activate <br />
	<input type="radio" name="site_footer_code[ftr_chrbt_checkbox]" value="Deactivate"'.$deactivate_chkd.'>Deactivate <br />
	<input type="radio" name="site_footer_code[ftr_chrbt_checkbox]" value="Test"'.$test_chkd.'>[Test]'."\n
	<div id='frn_plugin_cht_hlp' class='frn_help_boxes'>Click \"test\" to turn on the code so that you as an admin can see it when viewing the source code. Choose \"activate\" to keep employee activity from being tracked. Click \"deactivate\" to remove the chartbeat code for everyone visiting the site so that no pages in the site show in our real-time reporting monitors.</div>";
?>
	<br /> <br /><b>Category:</b>
	<select id='frn_plugin_chrbt_cat' name='site_footer_code[ftr_chrbt_category]'>
	  <option value="" <?=$options_ftr['ftr_chrbt_category']=="" ? "selected " : "" ; ?>></option>
	  <option value="Primary" <?=$options_ftr['ftr_chrbt_category']=="Primary" ? "selected " : "" ; ?>>Primary</option>
	  <option value="Niche" <?=$options_ftr['ftr_chrbt_category']=="Niche" ? "selected " : "" ; ?>>Niche</option>
	  <option value="PPC" <?=$options_ftr['ftr_chrbt_category']=="PPC" ? "selected " : "" ; ?>>PPC</option>
	</select> 
	<div id='frn_plugin_chtcat_hlp' class='frn_help_boxes'>Select the category you want the site to fall within for our Chartbeat reporting. The default is niche.</div>
		
<?php
}
//Shouldn't be used anymore
function ftr_chrbt_cat_funct() {
	$options_ftr = get_option('site_footer_code');  //must match second section of register_setting
	?>
		<select id='frn_plugin_chrbt_cat' name='site_footer_code[ftr_chrbt_category]'>
		  <option value="" <?=$options_ftr['ftr_chrbt_category']=="" ? "selected " : "" ; ?>></option>
		  <option value="Primary" <?=$options_ftr['ftr_chrbt_category']=="Primary" ? "selected " : "" ; ?>>Primary</option>
		  <option value="Niche" <?=$options_ftr['ftr_chrbt_category']=="Niche" ? "selected " : "" ; ?>>Niche</option>
		  <option value="Niche" <?=$options_ftr['ftr_chrbt_category']=="PPC" ? "selected " : "" ; ?>>PPC</option>
		</select>
		<div id='frn_plugin_chtcat_hlp' class='frn_help_boxes'>Select the category you want the site to fall within for our Chartbeat reporting. The default is niche.</div>
		
	<?php
}
// cleans up data before stored using plugin_admin_init
function plugin_options_footer($input) {
	//sets up an array when more variables are added
	//if(trim($input['ftr_priv_url'])=='[our default url]') $newinput['ftr_priv_url'] = ""; //resets to blank since default doesn't need to be stored, but should be displayed to admin person
	//else 
	$newinput['ftr_priv_url'] = trim($input['ftr_priv_url']);
	$newinput['frn_footer'] = trim($input['frn_footer']);
	$newinput['act_autoftr'] = trim($input['act_autoftr']);
	//if($input['ftr_chrbt_checkbox']=="") $input['ftr_chrbt_checkbox']="Activate"; //Used for the first time plugin is used
	$newinput['ftr_chrbt_checkbox'] = trim($input['ftr_chrbt_checkbox']);
	$newinput['ftr_chrbt_category'] = trim($input['ftr_chrbt_category']);
	return $newinput;
}






////////
// Settings form for URL base shortcodes

function sitebase_sc_info() {
	$options_base=get_option('site_sitebase_code');
	
	//for copy text script
	$frn_shortcode='[ldomain]';
	$php_shortcode = '&lt;?php echo do_shortcode(\''.$frn_shortcode.'\'); ?&gt;';
	$section_id = 'frn_plugin_sitebase';
	$shortcode_box = $section_id.'_box';
	
	echo "
	<input id='".$section_id."' name='site_sitebase_code[frn_sitebase]' size='60' type='text' value='{$options_base['frn_sitebase']}' /><br />";
}
function imagebase_sc_info() {
	$options_base=get_option('site_sitebase_code');
	
	//for copy text script
	$frn_shortcode='idomain';
	$php_shortcode = '&lt;?php echo do_shortcode(\''.$frn_shortcode.'\'); ?&gt;';
	$section_id = 'frn_plugin_imagebase';
	$shortcode_box = $section_id.'_box';
	$frn_shortcode2='ldomain';
	$php_shortcode2 = '&lt;?php echo do_shortcode(\''.$frn_shortcode2.'\'); ?&gt;';
	$section_id2 = 'frn_plugin_sitebase';
	$shortcode_box2 = $section_id2.'_box';
	
	if(trim($options_base["frn_imagebase"])=="") $idomain = site_url();
	else $idomain = $options_base["frn_imagebase"];
	if(trim($options_base["frn_sitebase"])=="") $ldomain = site_url();
	else $ldomain = $options_base["frn_sitebase"];
	
	echo "
	<input id='".$section_id."' name='site_sitebase_code[frn_imagebase]' size='60' type='text' value='{$options_base['frn_imagebase']}' /><br />
	".'
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="bottom">Shortcodes for Links: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box2.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2.'\')">['.$frn_shortcode2.']</span></b></td>
		</tr><tr>
			<td valign="top">&nbsp;&nbsp; <small>For FRN Plugin Fields: </small></td>
			<td valign="top"><b><span id="'.$shortcode_box2.'_2" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2.'_2\')">%%'.$frn_shortcode2.'%%</span></b></td>
		</tr><tr>
			<td valign="bottom">Shortcode for Images: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'\')">['.$frn_shortcode.']</span></b></td>
		</tr><tr>
			<td valign="top">&nbsp;&nbsp; <small>For FRN Plugin Fields: </small></td>
			<td valign="top"><b><span id="'.$shortcode_box.'_2" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box.'_2\')">%%'.$frn_shortcode.'%%</span></b></td>
		</tr><tr>
			<td valign="top" style="padding-top:5px;">This Replaces the Shortcode if Blank: </td>
			<td valign="top" style="padding-top:5px;"><b><span id="'.$shortcode_box2.'_3" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2.'_3\')">'.site_url().'</span></b></td>
		</tr></table></div>
	<div id="frn_plugin_sitebase_hlp" class="frn_help_boxes">
		<p>The most important one is <b>ldomain</b> to allow links to work in a sub-directory or sub-domain environment and automatically convert when launching a site. <b>ldomain</b> stands for "link domain". <b>idomain</b> stands for "image domain".</p>
		<p>To keep either shortcode automatic, don\'t enter anything above. As a result, the installed directory in the site\'s General Settings will be used as a default.</p>
		<p>However, if you want to lock down the links but still give you the option to change all the base domains in one fell swoop, you can put something in the fields above and use the shortcodes in the web addresses.</p>
		<p>NOTE: Shortcodes only work in the HEAD area (i.e. meta descriptions), page titles, excerpts, frn_plugin fields on this page and shortcodes, widgets and content. You can\'t use them in menus, theme options, or other plugins.</p>
		<p><br />
		<b>EXAMPLES: </b><br />
			<i>If used in an FRN shortcode like LHN email buttons: </i><b>%%'.$frn_shortcode.'%%</b>/images/image.png<br />
				&nbsp;&nbsp;&nbsp; => <i>Turns into: </i><b>'. $idomain .'/images/image.png</b><br />
			<i style="margin-top:7px;"><i>If not in an FRN shortcode: </i><b>['.$frn_shortcode2.']</b>/contact/<br />
				&nbsp;&nbsp;&nbsp; => <i>Turns into: </i><b>'.$ldomain.'/contact/</b>
		</p>
	</div>
	';
}

function social_info($input) {	
	$options_shortcodes=get_option('site_sitebase_code');
	if($options_shortcodes['frn_social']=="A") $activate_chkd=" checked";
	if($options_shortcodes['frn_social']=="D" or $options_shortcodes['frn_social']=="") $deactivate_chkd=" checked";
	
	//all share buttons
	$frn_shortcode1a="[frn_social order=\"spt\" version=\"\" float=\"LEFT\" link_text=\"Share this image \" account=\"FRNetwork\" related=\"HeroesNRecovery\" related_tagline=\"Changing the Stigma\" hashtag=\"#drugabuse\" size=\"\" counter=\"\" tweet=\"\" bold=\"\" summary=\"\" image=\"\" url=\"\" ]";
	$shortcode_box1a="frn_social_box-all";
	//twitter link
	$frn_shortcode1t="[frn_social version=\"text\" tweet=\"\" link_text=\"Tweet It\" url=\"\" account=\"\" related=\"\" related_tagline=\"\"]";
	$shortcode_box1t="frn_social_box1";
	//twitter button
	$frn_shortcode2t="[frn_social size=\"\" float=\"\" counter=\"\" tweet=\"\" link_text=\"\" hashtag=\"\" account=\"\" related=\"\" related_tagline=\"\"]";
	$shortcode_box2t="frn_social_box2";
	//pinterest share button
	$frn_shortcode1p="[frn_social type=\"PINTEREST\" float=\"\" counter=\"\" image=\"\" summary=\"\" url=\"\"]";
	$shortcode_box1p="frn_social_box4";
	//sharethis link (default sharethis)
	$frn_shortcode1s="[frn_social type=\"SHARETHIS\" link_text=\"\" bold=\"\" summary=\"\" image=\"\"]";
	$shortcode_box1s="frn_social_box3";
	//sharethis buttons
	$frn_shortcode2s="[frn_social type=\"SHARETHIS\" version=\"buttons\" plusone=\"\" like=\"\" google=\"\" facebook=\"\" twitter=\"\" linkedin=\"\" email=\"\" pinterest=\"\" sharethis=\"\"]";
	$shortcode_box2s="frn_social_box4";
	
	echo '
	<input type="radio" name="site_sitebase_code[frn_social]" value="A"'.$activate_chkd.' >Activate <br />
	<input type="radio" name="site_sitebase_code[frn_social]" value="D"'.$deactivate_chkd.'>Deactivate
	<div class="frn_options_table">
		<p>Be sure to read the explanations in the FRN Help tab at top-right.</p>
		<table class="frn_options_table"><tr>
			<td valign="bottom" colspan="2"><h4>MOST COMMON USES: </h4></td>
		</tr><tr>
			<td valign="bottom">All Buttons: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box1a.'_a" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1a.'_a\')">'.$frn_shortcode1a."</span></b></td>".'
		</tr><tr>
			<td valign="bottom">Twitter Links: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box1t.'_a" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1t.'_a\')">'."[frn_social tweet=\"This is my tweet.\" version=\"TEXT\" account=\"FRNetwork\" related=\"HeroesNRecovery\" related_tagline=\"Changing the Stigma\"]</span></b></td>".'
		</tr><tr>
			<td valign="top">Twitter Buttons: </td>
			<td valign="top"><b><span id="'.$shortcode_box2t.'_a" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2t.'_a\')">'."[frn_social tweet=\"This is my tweet.\" float=\"RIGHT\" account=\"FRNetwork\" related=\"HeroesNRecovery\" related_tagline=\"Changing the Stigma\"]</span></b></td>".'
		</tr><tr>
			<td valign="top">Pinterest Button: </td>
			<td valign="top"><b><span id="'.$shortcode_box1p.'_b" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1p.'_b\')">'."[frn_social type=\"PINTEREST\" float=\"RIGHT\" image=\"".site_url()."/wp-content/uploads/image.png (image 750px)\" summary=\"What people would say about it\" ]".'</span></b></td>
		</tr><tr>
			<td valign="bottom">ShareThis Link for Page: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box1s.'_a" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1s.'_a\')">[frn_social version="SHARETHIS"]</span></b><br />
			You can still customize the title, image, and summary for a page, but you don\'t have to. The following shortcode assumes you don\'t prefer to customize anything.</td>
		</tr><tr>
			<td valign="top">ShareThis Link for an Object: </td>
			<td valign="top"><b><span id="'.$shortcode_box2s.'_a" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2s.'_a\')">'."[frn_social type=\"SHARETHIS\" link_text=\"Share This Image \" bold=\"Bold point about object above summary (85 chars in window but FB shows more)\" summary=\"Second key point about the object (FB up to 300 chars)\" image=\"".site_url()."/wp-content/uploads/image.png (image 1600px)\"]".'</span></b><br />
			This option has everything customized in order to work as if a person is sharing an image although the URL being shared goes to the page.</td>
		</tr><tr>
			<td valign="top">ShareThis Buttons (in a line): </td>
			<td valign="top"><b><span id="'.$shortcode_box1s.'_b" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1s.'_b\')">'."[frn_social type=\"SHARETHIS\" version=\"BUTTONS\" ]".'</span></b><br />
			This option has everything customized in order to work as if a person is sharing an image although the URL being shared goes to the page.</td>
		</tr></table>
	</div>
	<div class="frn_options_table"><table class="frn_options_table"><tr>
			<td valign="bottom" colspan="2"><h4>All Possible Options: </h4></td>
		</tr><tr>
			<td valign="bottom">Twitter Links: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box1t.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1t.'\')">'.$frn_shortcode1t.'</span></b></td>
		</tr><tr>
			<td valign="top">Twitter Buttons: </td>
			<td valign="top"><b><span id="'.$shortcode_box2t.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2t.'\')">'.$frn_shortcode2t.'</span></b></td>
		</tr><tr>
			<td valign="bottom">ShareThis Link: </td>
			<td valign="bottom"><b><span id="'.$shortcode_box1s.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box1s.'\')">'.$frn_shortcode1s.'</span></b></td>
		</tr><tr>
			<td valign="top">ShareThis Buttons: </td>
			<td valign="top"><b><span id="'.$shortcode_box2s.'" class="frn_shortcode_sel" onClick="selectText(\''.$shortcode_box2s.'\')">'.$frn_shortcode2s.'</span></b></td>
		</tr></table>
	</div>
	
	';
}
function plugin_options_sitebase($input) {
	$newinput['frn_sitebase'] = trim($input['frn_sitebase']);
	$newinput['frn_imagebase'] = trim($input['frn_imagebase']);
	$newinput['frn_social'] = trim($input['frn_social']);
	return $newinput;
}






////////
// Store/Display Fields: This is what stores and pulls the settings form the DB

function plugin_admin_init(){
	
	//site_footer_code = houses all footer fields data in an array
	//site_head_code = houses all head fields data in an array

	//initiates groups of data (id of settings_fields, field name storing data, function setting up array)
	register_setting( 'frn_plugin_data', 'site_phone_number','plugin_options_validate'  );
	register_setting( 'frn_plugin_data', 'site_head_code','plugin_options_head'  );
	register_setting( 'frn_plugin_data', 'site_lhn_code','plugin_options_lhn'  );
	register_setting( 'frn_plugin_data', 'site_footer_code','plugin_options_footer'  ); 
	register_setting( 'frn_plugin_data', 'site_sitebase_code','plugin_options_sitebase'  ); 
	
	//displays the data in Admin and sets up DB
	//PHONE shortcode
	add_settings_section('site_phone_number', 'Shortcode for Phone Numbers', 'frn_shortcode_section_text', 'frn_phone_section');
		add_settings_field('frn_plugin_phone', "Phone Number <a href='javascript:showhide(\"frn_plugin_phone_help\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a>", 'frn_phone_field', 'frn_phone_section', 'site_phone_number');
	//HEAD settings field:(unique id, field label, function to add form field, menu page, page section)
	add_settings_section('site_head_code', "Google Analytics Settings", 'text_before_head_form', 'frn_head_section');
		add_settings_field('frn_plugin_ga', "Google Analytics <span style='white-space:nowrap;'>ID <a href='javascript:showhide(\"frn_plugin_ga_help\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_id_field', 'frn_head_section', 'site_head_code');
		add_settings_field('frn_plugin_ga_404', "404 Page Title Beginning <span style='white-space:nowrap;'>Words <a href='javascript:showhide(\"frn_plugin_ga_404_help\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_404_field', 'frn_head_section', 'site_head_code');
		add_settings_field('frn_plugin_ga_ua', "Universal <span style='white-space:nowrap;'>Analytics <a href='javascript:showhide(\"frn_plugin_frn_ga_ua_help\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_ua_field', 'frn_head_section', 'site_head_code');
		add_settings_field('frn_plugin_ga_dgrphx', "DoubleClick <span style='white-space:nowrap;'>Demographics <a href='javascript:showhide(\"frn_plugin_frn_ga_dgrphx_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_dgrphx_field', 'frn_head_section', 'site_head_code');
		add_settings_field('frn_plugin_ga_enhcd', "Enhanced <span style='white-space:nowrap;'>Analytics <a href='javascript:showhide(\"frn_plugin_frn_ga_ea_help\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_ea_field', 'frn_head_section', 'site_head_code');
	//External Links Section
	add_settings_section('site_extlinks_code', "External Links Options", '', 'frn_extlinks_section');
		add_settings_field('frn_plugin_ext_link_icon', "External Link <span style='white-space:nowrap;'>Icon <a href='javascript:showhide(\"frn_ext_link_icon\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_extlinkicon_field', 'frn_extlinks_section', 'site_extlinks_code');
		add_settings_field('frn_plugin_target', "Open in New <span style='white-space:nowrap;'>Windows <a href='javascript:showhide(\"frn_ext_link_target\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ga_extlinktarget_field', 'frn_extlinks_section', 'site_extlinks_code');
	//LHN section
	add_settings_section('site_lhn_code', 'LiveHelpNow Settings', 'text_before_lhn_form', 'frn_lhn_section');
		add_settings_field('frn_plugin_lhn_activate', "<span style='white-space:nowrap;'>Slideout <a href='javascript:showhide(\"frn_plugin_lhn_activate_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'lhn_activation', 'frn_lhn_section', 'site_lhn_code');
		add_settings_field('lhn_inpage_chat_btnid', "In-Page <span style='white-space:nowrap;'>Buttons <a href='javascript:showhide(\"frn_plugin_lhn_inpage_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'lhn_inpage', 'frn_lhn_section', 'site_lhn_code');
	//FOOTER settings field:(unique id, field label, function to add form field, menu page, page section)
	add_settings_section('site_footer_code', 'Privacy Policy and Chartbeat', 'text_before_ftr_form', 'frn_footer_section');
		add_settings_field('frn_plugin_ftr_ppurl', "Privacy Policy Shortcode <span style='white-space:nowrap;'>URL <a href='javascript:showhide(\"frn_plugin_lhn_priv_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ftr_priv_url_funct', 'frn_footer_section', 'site_footer_code');
		add_settings_field('frn_plugin_ftr', "Copyright & Privacy <span style='white-space:nowrap;'>Code Override <a href='javascript:showhide(\"frn_plugin_lhn_ftr_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ftr_funct', 'frn_footer_section', 'site_footer_code');
		add_settings_field('frn_plugin_ftr_chbt', "Chartbeat <span style='white-space:nowrap;'>Tracking <a href='javascript:showhide(\"frn_plugin_cht_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'ftr_chrbt_chkbx_funct', 'frn_footer_section', 'site_footer_code');
	//Site Base shortcode
	add_settings_section('site_sitebase_code', 'Shortcode for Links and Images', 'frn_before_sitebase_info', 'frn_sitebase_section');
		add_settings_field('frn_site_base_URL', "Link Base URL <span style='white-space:nowrap;'>Override<a href='javascript:showhide(\"frn_plugin_sitebase_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'sitebase_sc_info', 'frn_sitebase_section', 'site_sitebase_code');
		add_settings_field('frn_image_base_URL', "Image Base URL <span style='white-space:nowrap;'>Override<a href='javascript:showhide(\"frn_plugin_sitebase_hlp\")' ><img src='".plugins_url()."/frn_plugins/images/icon_help.png' /></a></span>", 'imagebase_sc_info', 'frn_sitebase_section', 'site_sitebase_code');
	//Social shortcode (no settings form, just info)
	add_settings_section('site_social', 'Shortcode for Social Buttons', '', 'frn_social_section');
		add_settings_field('frn_social', "Shortcode Options", 'social_info', 'frn_social_section', 'site_social');
		
}



//////
//This actually makes it all show on admin page
if ( is_admin() ){ // admin actions
	add_action('admin_menu', 'plugin_admin_add_page');
	add_action('admin_init', 'plugin_admin_init');
} else {
  // non-admin enqueues, actions, and filters
}










/////////////////////////////////
// On-page Component Rendering //
/////////////////////////////////

//Used in phone number and copyright shortcode functions below. Used to format the number friendly for all mobile phones.
function frn_clean_number($number) {
	
	//Cleans it up to use as mobile phone number--works with images only
	if(trim($number)!="") $frn_number = strip_tags(stripslashes(trim($number))); //cleans out all HTML and quotes
	else {
		$options = get_option('site_phone_number');
		$frn_number = trim(strip_tags(stripslashes($options['site_phone']))); //cleans out all HTML and quotes
	}
	if($frn_number!="") {
		$frn_number=preg_replace("/[^0-9]/","",$frn_number); //strips all but numbers in case some text is left
		
		//Format the phone to still look pretty although the JS portion will reformat again
		if(strlen($frn_number)==11) {$frn_phoneFormat = '/^1?(\d)([0-9]..)([0-9]..)([0-9]...)$/'; //starts with 1
		  $frn_number = preg_replace($frn_phoneFormat,'$1-$2-$3-$4',$frn_number);}
		else if(strlen($frn_number)==10) {$frn_phoneFormat = '/([0-9]..)([0-9]..)([0-9]...)$/'; //doesn't start with 1
		  $frn_number = preg_replace($frn_phoneFormat,'1-$1-$2-$3',$frn_number);}
		else if(strlen($frn_number)==13){$frn_phoneFormat = '/([0-9]..)([0-9]..)([0-9]..)([0-9]...)$/'; //international
		  $frn_number = preg_replace($frn_phoneFormat,'$1-$2-$3-$4',$frn_number);}
		else if(strlen($frn_number)==14 && substr($frn_number,1)=="("){$frn_phoneFormat = '/([0-9]...)([0-9]..)([0-9]..)([0-9]...)$/'; //international
		  $frn_number = preg_replace($frn_phoneFormat,'$1-$2-$3-$4',$frn_number);}
	}
	 return $frn_number;
}

//////
// Phone Shortcode: If shortcode found, this is what splits out the variables into our SPAN tags and phone number.
//shortcode requires "return" not "echo"
function frn_phone_funct($atts){
	extract( shortcode_atts( array(
		'lhn_tab_disabled'=> '',
		'number' => '',
		'intl_prefix'=> '',
		'ga_phone_category' => '',
		'ga_phone_location' => '',
		'ga_phone_label' => '',
		'frn_number_style' => '',
		'only' => '',
		'css_style' => '',
		'style' => '',
		'image_style' => '',
		'image_url' => '',
		'url' => '',
		'image_alt' =>'',
		'alt' =>'',
		'image_title' => '',
		'title' => '',
		'image_id' => '',
		'id' => '',
		'image_class' => '',
		'class' => ''
	), $atts, 'frn_phone' ) );
	
		
	//adds HTML to variable values for javascript features
	if($only=="yes") {
		return frn_clean_number($number);
	}
	else if(trim($image_url)!="" || trim($url)!="") {
		
		//Prep image related variables
		if($url=="") $image_url=trim($image_url);
			else $image_url=trim($url);
		if($style=="") $css_style=trim($css_style);
			else $css_style=trim($style);
		if($alt=="") $image_alt=trim($image_alt);
			else $image_alt=trim($alt);
		if($title=="") $image_title=trim($image_title);
			else $image_title=trim($title);
		if($id=="") $image_id=trim($image_id);
			else $image_id=trim($id);
		if($class=="") $image_class=trim($image_class);
			else $image_class=trim($class);
		$frn_number = frn_clean_number($number);
		
		//Check if shortcode is used, replace with base url for images
		if(stripos($image_url,"%%frn_imagebase%%")>=0 or stripos($image_url,"%%idomain%%")>=0) {
			//create site base url
			$options_sitebase = get_option('site_sitebase_code');
			if(trim($options_sitebase['frn_imagebase'])!="") $site_base =  trim($options_sitebase['frn_imagebase']);
			else $site_base = site_url();
			$image_url=str_replace('%%frn_imagebase%%',$site_base,$image_url);
			$image_url=str_replace('%%idomain%%',$site_base,$image_url);
		}
		else if(stripos($image_url,"%%frn_sitebase%%")>=0 or stripos($image_url,"%%ldomain%%")>=0) {
			//create site base url
			$options_sitebase = get_option('site_sitebase_code');
			if(trim($options_sitebase['frn_sitebase'])!="") $site_base =  trim($options_sitebase['frn_sitebase']);
			else $site_base = site_url();
			$image_url=str_replace('%%frn_sitebase%%',$site_base,$image_url);
			$image_url=str_replace('%%ldomain%%',$site_base,$image_url);
		}
		
		if ($_SERVER["HTTPS"] == "on") $image_url = str_replace('http://','https://',$image_url);
		
		
		if($image_alt!="") {
			$image_alt=' alt="'.$image_alt.'"';
			if($number!="") $image_alt=str_replace('%%frn_phone%%',$number,$image_alt);
			else $image_alt=str_replace('%%frn_phone%%',$frn_number,$image_alt);
		}
		if($image_title!="") {
			$image_title=' title="'.$image_title.'"';
			if($number!="") $title=str_replace('%%frn_phone%%',$number,$image_title);
			else $image_title=str_replace('%%frn_phone%%',$frn_number,$image_title);
		}
		if($image_id!="") $image_id=' id="'.$image_id.'"';
		if($image_class!="") $image_class=' class="'.$image_class.'"';
		
		//Google Analytics event tracking variables, duplicated for easier to see path
		if($ga_phone_category!="") $ga_phone_category=' ga_phone_category="'.$ga_phone_category.'"';
		if($ga_phone_location!="") $ga_phone_location=' ga_phone_location="'.$ga_phone_location.'"';
		if($ga_phone_label!="") $ga_phone_label=' ga_phone_label="'.$ga_phone_label.'"';
		if($frn_number!="") $frn_number = ' frn_number="'.$frn_number.'"';
		if($css_style=="none" || $style=="none") $style="";
		else if($css_style!="") $style=' style="'.$css_style.'"';
		else if($style!="") $style=' style="'.$style.'"';
		if($lhn_tab_disabled!="") $lhn_tab_disabled = ' lhn_tab_disabled="'.$lhn_tab_disabled.'"';
		if($intl_prefix!="") $intl_prefix=' intl_prefix="'.$intl_prefix.'"';
		
		return '<span id="frn_phones"'.$style.$ga_phone_category.$ga_phone_location.$ga_phone_label.$frn_number.$lhn_tab_disabled.$intl_prefix.' ><img'.$image_id.$image_class.' src="'.$image_url.'"'.$image_title.$image_alt.$image_style.' /></span>';
	}
	else {
		//If not an image, then process like normal and letting the JS use the phone number between the spans
		if($number!="") $printed_number = $number;
		else {
			$options = get_option('site_phone_number');
			$printed_number = trim(stripslashes($options['site_phone']));
		}
		/*
		//The following is hidden so that the span codes still print into the page even if a phone number is blank in the FRN settings.
		//This gives the javascript a chance to look for any number on the page in SPANs and put that between this SPAN--assuming that if a person uses a shortcode, they intend for a phone number to be there.
		//If the JS finds no phone number, the SPAN code will stay but won't be visible.
		
		if($printed_number!="") { */
			if($ga_phone_category!="") $ga_phone_category=' ga_phone_category="'.$ga_phone_category.'"';
			if($ga_phone_location!="") $ga_phone_location=' ga_phone_location="'.$ga_phone_location.'"';
			if($ga_phone_label!="") $ga_phone_label=' ga_phone_label="'.$ga_phone_label.'"';
			if($lhn_tab_disabled!="") $lhn_tab_disabled = ' lhn_tab_disabled="'.$lhn_tab_disabled.'"';
			if($intl_prefix!="") $intl_prefix=' intl_prefix="'.$intl_prefix.'"';
			if($frn_number_style=="none" or $style=="none") $style="";
			else if($frn_number_style!="" or $style!="") $style=' style="'.$style.$frn_number_style.'"';
			else if($frn_number_style=="" and $style=="") $style=' style="white-space:nowrap;"';
			
			$frn_phone_code = '<span id="frn_phones"'.$ga_phone_category.$ga_phone_location.$ga_phone_label.$style.$lhn_tab_disabled.$intl_prefix.' >'.$printed_number.'</span>';
		/*}
		else $frn_phone_code="";*/
		
		return $frn_phone_code;
	}
}
//////
// Phone Tagging: If turned on, this will scan only content or the entire page for phone number patterns for only mobile devices and turn touches on them into trackable events and to always look like links.
//
function frn_phone_autoscan_content( $content ) {
	//PHP option: simply acts like a shortcode in that it looks for a number pattern and then replaces it with the spans and number again
	/*
	Will not work with letters (helps with pattern identification and mobile conversions)
	You can change out dashes for spaces or periods
	International:
	0 000 (000) 000-0000
	000 (000) 000-0000
	0-000-000-000-0000
	000 (000) 000-0000
	000-000-000-0000
	000-00-0-000-0000
	0000-00-0-000-0000
	+000-000-000-0000
	
	U.S. Versions:
	0 (000) 000-0000
	+0-000-000-0000
	0-000-000-0000
	000-000-0000
	(000) 000-0000
	000-0000
	
	NOTE: To help with the autoscan, it requires a period, space, bracket, greater or less than, or parenthesis to be at the front and/or end of the number before it's found. 
		  Some links have numbers with periods in them that cause the autoscan feature to add the SPAN code within the links. This decreases the chances of that happening, but it also includes those characters in the linked text, but not the telephone link.
		  Primary resources: http://us3.php.net/preg_replace and http://us3.php.net/manual/en/function.preg-replace-callback.php
		  A phone pattern resources: http://stackoverflow.com/questions/17331386/php-preg-replace-phone-numbers ,  http://www.myspotinternetmarketing.com/javascript-php-and-regular-expressions-for-international-and-us-phone-number-formats/
	
	These are found, but are incorrect formats: Basically, make sure you don't have a dash, space, plus sign, or period before number or this will pull it in.
	   0-000-0000
	   -0-000-0000
	   -0-000-000-0000
	   -0 (000) 000-0000
	   +000 00-0-000-0000
	   3456789012345-6789
	*/
	
	$options_phone = get_option('site_phone_number');
	$auto_scan = $options_phone['auto_scan'];
	if($auto_scan=="C" || $auto_scan=="WC") {
		$pattern = "/(\s|\(|\[|\>)\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}(\s|\)|\]|\.|\<)/s"; //makes sure there is a space or some other character on either side of the number
		$content = preg_replace_callback($pattern, "preg_replace_clean_up", $content, 1);  //This helps make sure that characters outside of phone numbers aren't linked.
		//old (links the characters on either side of number as well: $content = preg_replace($pattern, $before."$0".$after, $content, 1);
	}
	return $content;
}
function preg_replace_clean_up($matches) {
	//This is a separate function that makes sure only the number in the pattern is linked but the things on either side aren't removed.
	$pattern = "/\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}/"; //without making sure something is on either site
	$before = '<span id="frn_phones" style="white-space:nowrap;" ga_phone_label="include_phone" >';
	$after = "</span>";
	$number_span = preg_replace($pattern, $before."$0".$after, $matches[0], 1);
	return $number_span;
}
add_filter( 'the_content', 'frn_phone_autoscan_content');

function frn_phone_autoscan_widget( $widget ) {
	//PHP option: simply acts like a shortcode in that it looks for a number pattern and then replaces it with the spans and number again
	$options_phone = get_option('site_phone_number');
	$auto_scan = $options_phone['auto_scan'];
	if($auto_scan=="WC" || $auto_scan=="W") {
		//Pull the matches
		$pattern = "/(\s|\(|\[|\>)\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}(\s|\)|\]|\.|\<)/";
		$widget = preg_replace_callback($pattern, "preg_replace_clean_up", $widget, 1);
	}
	return $widget;
}
add_filter( 'widget_text', 'frn_phone_autoscan_widget');

function frn_phone_ftr(){
// This script runs for every page load.
// Used to add phones2links.js to footer and see if entire page autoscan is turned on for JS file to scan the page for phone number formats and turn them into links using JS.
	$frn_phone_ftr="";

	//Turn on auto scanning
	$options_phone = get_option('site_phone_number');
	$auto_scan = $options_phone['auto_scan'];
	if($auto_scan=="A") $frn_phone_ftr .=  '
	<script type="text/javascript">frn_phone_autoscan="yes";</script>'; //if all of the page, set a global JS variable that will turn on the autoscan feature in our normal phones2links.js
	
	////
	//Add number span page scan to footer in all cases since GA tracking is not its only feature
	//One known issue: if person is on mobile phone and logged in and GA is not in test mode and then the admin clicks on a number, there will be a JS error since GA is disabled.
	$options_ua = get_option('site_head_code');
	if($options_ua['frn_ga_ua']=="Activate") $ga_ua = "_ua";
	else $ga_ua="";
	$frn_phone_ftr .=  '
	<script type="text/javascript" src="'.plugins_url().'/frn_plugins/frn_phones2links'.$ga_ua.'.js"></script>
	';
	
	echo $frn_phone_ftr;
}
add_action('wp_footer', 'frn_phone_ftr', 3); //3 to make sure the script is added below chartbeat, etc.



///////
//Add Components to the HEAD
function frn_addtoheader() {
    //frn GA version 2.3 10/15/2013
	
	$frn_ga = '
	<!-- #####
	Google Analytics
	##### -->';

	
	$options_head = get_option('site_head_code');
	if($options_head['frn_ga_ua']=="Activate") $ga_ua = "_ua"; //Used to refer to other JS files that have the latest GA event and social tracking codes
	
	//Deactivates external links opening in a new window if this is D
	if($options_head['ext_link_target']=="D") 
		$ga_exttarget = '
		frn_eli_target="D";';
	
	//Deactivates the external link icons
	if($options_head['ext_link_icon']=="D") 
		$ga_deact_eli = '
		frn_eli_deact="Y";';
	
	if ( !is_user_logged_in() or $options_head[site_ga_test]=="Test") { //decided to continue tracking company persons since many sites employees use and we want to see how
	
		if($options_head['site_ga_id_value']!="") {  //if no GA site id is not included, then don't put GA code on site
			
			//Adds the info to our GA code that turns on our in-page per link click tracking
			if($options_head['frn_ga_ea']=="Activate") { 
				$ea_js = "var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
		_gaq.push(['_require', 'inpage_linkid', pluginUrl]);";
				$ea_ua_js = "
		ga('require', 'linkid', 'linkid.js');";
			}
			else {$ea_js = ''; $ea_ua_js="";}
			
			if($options_head['frn_ga_404']=="") $error_404_title = "";
			else $error_404_title = "
		error_404_title = '".$options_head['frn_ga_404']."';";
			
			//Once a GA account is converted to a Universal Analytics account, this is the code that will replace the standard GA code.
			if($options_head['frn_ga_ua']=="Activate") {
			
				//Used for including Double-Clicks' assumed demographics data
				if($options_head['frn_ga_dgrphx']=="Activate") $demo_js = "
		ga('require', 'displayfeatures');";
				else $demo_js = "";
			
				$ga_ua = "_ua"; //Used to refer to other JS files that have the latest GA event and social tracking codes
				$frn_ga .= "
	<script>
		pluginInstall='".plugins_url()."';".
		$error_404_title.$ga_deact_eli.$ga_exttarget."
		baseDomain = location.hostname;
		
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		ga('create', '".$options_head['site_ga_id_value']."');".
		$ea_ua_js.
		$demo_js."
		ga('send', 'pageview');
	</script>";
			}
			else { //If UA is not activated, then install the old script by default
			
				//Used for including Double-Clicks' assumed demographics data
				if($options_head['frn_ga_dgrphx']=="Activate") $demo_js = "'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'";
				else $demo_js = "'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'";
			
				$ga_ua = "";
				$frn_ga .= '
	<script type=\'text/javascript\'>
		pluginInstall="'.plugins_url().'";'.
		$error_404_title.$ga_deact_eli.'
		baseDomain = location.hostname;
		var _gaq = _gaq || [];
		'.$ea_js.'
		_gaq.push([\'_setAccount\', \''.$options_head['site_ga_id_value'].'\']);
		_gaq.push([\'_trackPageview\']);
		(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? '.$demo_js.';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>';
			}
			
		}
		else $frn_ga .= '
	<!--FRN Plugin: Google Analytics ID is empty and tracking is thus not activated-->
	
	<script type=\'text/javascript\'>pluginInstall="'.plugins_url().'";'.$ga_deact_eli.'</script>';
	} 
	else $frn_ga .= '
	<!--YOU ARE LOGGED IN and therefore not being tracked in Google Analytics or the FRN setting for the GA ID is empty.-->
	
	<script type=\'text/javascript\'>pluginInstall="'.plugins_url().'";'.$ga_deact_eli.'</script>';
	$frn_ga .= '
	<script type="text/javascript" src="'.plugins_url().'/frn_plugins/ga_frn_eventsandsocial'.$ga_ua.'.js"></script>
	<!-- #####
	Google Analytics Ends
	##### -->
	
	';
	
	echo $frn_ga;
	
}

function frn_plugin_scripts() {
	$options_head = get_option('site_head_code');
	//if(!is_user_logged_in() or $options_head[site_ga_test]=="Test") {
	//	if($options_head['frn_ga_ua']=="Activate") $ga_ua = "_ua";
	//	wp_enqueue_script( 'my-js', plugins_url().'/frn_plugins/ga_frn_eventsandsocial'.$ga_ua.'.js', false );
	//}
	wp_register_script( 'frn_mdetect_script', plugins_url(). '/frn_plugins/frn_mdetect.js', false, '1.0.0' );
	wp_enqueue_script( 'frn_mdetect_script' );
}
add_action( 'wp_enqueue_scripts', 'frn_plugin_scripts' );


function frn_lhn_slideout() {
//Add Our LiveHelpNow Code to the HEAD
	
	$options_lhn = get_option('site_lhn_code');;
	
	if($options_lhn['lhn_activation']=="Activate") {
	
		//Defines if page has a secure https or not
		$pagehttp = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pagehttp .= "s";}
		$pagehttp .= "://";
		$pageURL = $pagehttp.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		
		$options_phone = get_option('site_phone_number');
		
		$options_ua = get_option('site_head_code');
		if($options_ua['frn_ga_ua']=="Activate") $ga_ua = "_ua";
		else $ga_ua="";
		
		if(stripos(home_url(),"rehabandtreatment.com")>0) $frn_phone = "";
		else $frn_phone = stripslashes($options_phone['site_phone']);
		
		$frn_lhn = '
	<!-- #####
	LiveHelpNow Code
	##### -->
	<script type="text/javascript">';
		if($frn_phone!="") $frn_lhn = $frn_lhn.'
		frn_phone = "'.$frn_phone.'";';
		//The following was removed since it was not helping with tracking in the call center in LHN Analytics.
		//lhnCustom1 = encodeURIComponent("'.urlencode(ucwords(str_replace($pagehttp,"",home_url()))).'");
		//lhnCustom2 = encodeURIComponent("'.wp_title(" | ", false).'");
		//lhnCustom3 = "'.urlencode($pageURL).'";
		$frn_lhn = $frn_lhn. '
		lhnCss = "'.plugins_url().'/frn_plugins/frn_plugins_lhn.css";';
		if($options_lhn['lhn_window']!="") $frn_lhn = $frn_lhn. 'lhnWindowN = "'.$options_lhn['lhn_window'].';"' ;
		$frn_lhn = $frn_lhn. '
	</script>
	<script src="'.plugins_url().'/frn_plugins/lhnhelpouttab-defaults.min.js" type="text/javascript" ></script>
	<script src="//www.livehelpnow.net/lhn/widgets/helpouttab/lhnhelpouttab-current.min.js" type="text/javascript" id="lhnscriptho"></script>
	<script src="'.plugins_url().'/frn_plugins/lhnhelpouttab-custom'.$ga_ua.'.min.js" type="text/javascript" ></script>
	<!-- #####
	LiveHelpNow Code Ends
	##### -->
		
		';
	
	echo $frn_lhn;
	
	}
}



//////
// LHN Shortcode:
//shortcode requires "return" not "echo"
function frn_lhnshortcode_funct($atts){
	$options = get_option('site_lhn_code');
	$frn_lhnbtns = "";
	extract( shortcode_atts( array(
			'button' => '',
			'id' => '',
			'url' => ''
		), $atts, 'lhn_inpage' ) );
	
	if($options['lhn_inpageact']=="Activate") {
	
		//if wanting both buttons side by side, this adds a style and div around the buttons to make it happen
		if($button=="" or $button=="both") $frn_lhnbtns .= "
			
			<!-- LiveHelpNow On-Page Buttons -->
			<style type=\"text/css\" media=\"screen\">
				.lhn_buttons div {display:inline;}
			</style>
			<div class=\"lhn_buttons\">";
		
		//typical email button
		if(trim($button)=="email" or trim($button)=="" or $button=="both") {
			if(trim($url)!="") {
				//custom email button used in shortcode on a page
				$emailbtn_url = trim($url);
			}
			else if(trim($options['lhn_inpage_email_btnurl'])!="") {
				//default email button defined in settings
				$emailbtn_url = $options['lhn_inpage_email_btnurl'];
			}
			else $emailbtn_url = plugins_url()."/frn_plugins/images/lhn_btn_email.png";
			
			if(stripos($emailbtn_url,"%%frn_imagebase%%")>=0 or stripos($emailbtn_url,"%%idomain%%")>=0 or stripos($emailbtn_url,"%%ldomain%%")>=0 or stripos($emailbtn_url,"%%frn_sitebase%%")>=0) {
				//create image base url
				$options_sitebase = get_option('site_sitebase_code');
				if(trim($options_sitebase['frn_imagebase'])!="") $site_base = trim($options_sitebase['frn_imagebase']);
				else $site_base = site_url();
				$emailbtn_url=str_replace('%%frn_imagebase%%',$site_base,$emailbtn_url);
				$emailbtn_url=str_replace('%%frn_sitebase%%',$site_base,$emailbtn_url);
				$emailbtn_url=str_replace('%%idomain%%',$site_base,$emailbtn_url);
				$emailbtn_url=str_replace('%%ldomain%%',$site_base,$emailbtn_url);
			}
			
			//making sure there are no security issues
			if ($_SERVER["HTTPS"] == "on") $emailbtn_url = str_replace('http://','https://',$emailbtn_url);
			
			$frn_lhnbtns .= '
				<!-- LiveHelpNow On-Page Email Button -->
				<a onclick="window.open(\'http://www.livehelpnow.net/lhn/TicketsVisitor.aspx?lhnid=14160\',\'Ticket\',\'left=\' + (screen.width - 550-32) / 2 + \',top=50,scrollbars=yes,menubar=no,height=550,width=450,resizable=yes,toolbar=no,location=no,status=no\');return false;" href="http://www.livehelpnow.net/lhn/TicketsVisitor.aspx?lhnid=14160"><img id="lhnEmailButton" src= "'.$emailbtn_url.'" alt="Send us an Email" title="Give us a chance to help." border="0" /></a>
				';
		}
		//typical chat button
		if($button=="chat" or $button=="" or $button=="both") {
			if(trim($id)!="") $id = trim($id);
			else if(trim($options['lhn_inpage_chat_btnid'])!="") $id = trim($options['lhn_inpage_chat_btnid']); //default id is handled by javascript
			if(trim($options['lhn_inpage_chat_btnid'])!="" or trim($id)!="") $frn_lhnbtns .= '<script type="text/javascript">lhnButtonN="'.$id.'";</script>';

			$frn_lhnbtns .= '
				<!-- LiveHelpNow On-Page Chat Button -->
				<script src= "'.plugins_url().'/frn_plugins/lhnchatbutton-defaults.min.js" type="text/javascript" ></script>
				<script src="//www.livehelpnow.net/lhn/widgets/chatbutton/lhnchatbutton-current.min.js" type="text/javascript" id="lhnscript"></script>';
		}
		if($button=="" or $button=="both") $frn_lhnbtns .= "
			</div>
			<!-- End LiveHelpNow On-Page Buttons -->
			
";
		
		return $frn_lhnbtns;
	}
	else {
		if($button=="chat") $frn_lhnbtns .= "
		<!-- LiveHelpNow On-Page CHAT Button -->
		<!-- Normally the button would be in this location, but the buttons are deactivated -->
		
";
		else if($button=="email") $frn_lhnbtns .= "
		<!-- LiveHelpNow On-Page EMAIL Button -->
		<!-- Normally the button would be in this location, but the buttons are deactivated -->
		
";
		else $frn_lhnbtns .= "
		<!-- LiveHelpNow On-Page Buttons -->
			<!-- Normally both buttons would be in this location, but they are deactivated -->
		<!-- End LiveHelpNow On-Page Buttons -->
		
";
	}
	
	return $frn_lhnbtns;
}



//////
// Social Button Shortcodes:
//shortcode requires "return" not "echo"
function frn_social_funct($atts){
	$options_shortcodes=get_option('site_sitebase_code');
	$frn_social = "";
	
	if($options_shortcodes['frn_social']=="A") {
		
		//defaults
		extract( shortcode_atts( array(
			'type' => '',
			'version' => 'button',
			'size' => 'medium',
			'float' => 'none',
			'order' => '',
			'counter' => 'none',
			'tweet' => '',
			'hashtag' => '',
			'link_text' => 'Tweet It',
			'url' => '',
			'account' => '',
			'related' => '',
			'related_tagline' => '',
			'image' => '',
			'bold' => '',
			'summary' => '',
			'like' => '',
			'plusone' => '',
			'sharethis' => '',
			'google' => '',
			'facebook' => '',
			'twitter' => '',
			'linkedin' => '',
			'email' => '',
			'pinterest' => ''
		), $atts, 'frn_social' ) );
		
		$float=strtolower(trim($float));
		$counter=strtolower(trim($counter));
		$image=trim($image);
		$type=strtolower(trim($type));
		$version=strtolower(trim($version));
		$url=trim($url);
		
		if($type=="sharethis" || $type=="all" || $type=="") {
			$sharethis = "";
			if($version=="buttons") {
				if(strtolower(trim($plusone))!="no") $sharethis.="<span class='st_plusone_large' displayText='Google +1'></span>";
				if(strtolower(trim($like))!="no") $sharethis.="<span class='st_fblike_large' displayText='Like' style='float:left; margin-top:3px;'></span>";
				if(strtolower(trim($google))!="no") $sharethis.="<span class='st_googleplus_large' displayText='ShareThis'></span>";
				if(strtolower(trim($facebook))!="no") $sharethis.="<span class='st_facebook_large' displayText='ShareThis'></span>";
				if(strtolower(trim($twitter))!="no") $sharethis.="<span class='st_twitter_large' displayText='ShareThis'></span>";
				if(strtolower(trim($linkedin))!="no") $sharethis.="<span class='st_linkedin_large' displayText='ShareThis'></span>";
				if(strtolower(trim($pinterest))!="no") $sharethis.="<span class='st_pinterest_large' displayText='ShareThis'></span>";
				if(strtolower(trim($email))!="no") $sharethis.="<span class='st_email_large' displayText='ShareThis'></span>";
				if(strtolower(trim($sharethis))!="no") $sharethis.="<span class='st_sharethis_large' displayText='ShareThis'></span>";
				$sharethis.="
					<script type=\"text/javascript\">var switchTo5x=true;</script>
					<script type=\"text/javascript\">stLight.options({publisher: \"edec65cb-2ba0-420b-90af-5194e9f67e79\", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
				";
				wp_register_script( 'frn_sharethis', 'http://w.sharethis.com/button/buttons.js', false, '1.0.0', true ); //name,url,js required before to run,version,in footer
				wp_enqueue_script( 'frn_sharethis' );
			}
			elseif($version=="floating") {
				$sharethis.='
					<script type="text/javascript">var switchTo5x=true;</script>
					<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
					<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
					<script type="text/javascript">stLight.options({publisher: "edec65cb-2ba0-420b-90af-5194e9f67e79", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
					<script>
						var options={ "publisher": "edec65cb-2ba0-420b-90af-5194e9f67e79", "logo": { "visible": false, "url": "", "img": "", "height": 45}, "ad": { "visible": false, "openDelay": "5", "closeDelay": "0"}, "livestream": { "domain": "", "type": "sharethis"}, "ticker": { "visible": false, "domain": "", "title": "", "type": "sharethis"}, "facebook": { "visible": false, "profile": "sharethis"}, "fblike": { "visible": false, "url": ""}, "twitter": { "visible": false, "user": "sharethis"}, "twfollow": { "visible": false}, "custom": [{ "visible": false, "title": "Custom 1", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 2", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 3", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}], "chicklets": { "items": ["googleplus", "facebook", "twitter", "linkedin", "pinterest", "email", "sharethis"]}};
						var st_bar_widget = new sharethis.widgets.sharebar(options);
					</script>
				';
			}
			else {
				if($image!="") $image_st="st_image=\"".$image."\" ";
				if(trim($bold)!="") $bold="st_title=\"".$bold."\" ";
				if(trim($summary)!="") $summary_st="st_summary=\"".$summary."\" ";
				if($link_text=="Tweet It") $link_text="Share This ";
				//url to page is automatic
				//once a person clicks/rolls over a sharethis link, that information is cashed for all other sharethis links on a page. The page must be refreshed.
				//For this link to work on the page, the sharethis plugin must be installed: https://wordpress.org/plugins/share-this/
				if($float!="none") {
					if(strtolower(trim($float))=="left") {$sharethis.="<div class=\"frn_social_s\" style=\"float:".$float."; margin:0 5px 0 0;\">"; $float_end="</div>";}
					elseif(strtolower(trim($float))=="right") {$sharethis.="<div class=\"frn_social_s\" style=\"float:".$float."; margin:0 0 0 5px;\">"; $float_end="</div>";}
				}
				$sharethis.='<span class="st_sharethis" style="cursor:pointer;" '.$image_st.$bold.$summary_st.'>'.$link_text.' </span>';
				$sharethis.=$float_end;
				$sharethis.='
					<script type="text/javascript">var switchTo5x=true;</script>
					<script type="text/javascript">stLight.options({publisher: "edec65cb-2ba0-420b-90af-5194e9f67e79", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>';
				wp_register_script( 'frn_sharethis', 'http://w.sharethis.com/button/buttons.js', false, '1.0.0', true ); //name,url,js required before to run,version,in footer
				wp_enqueue_script( 'frn_sharethis' );
			}
		}
		if($type=="pinterest" || $type=="all" || $type=="") {
			$pinterest="";
			//Settings
			$image_p = urlencode( $image );
			if($url=="") $url_p=urlencode(get_permalink());
			if($version=="icon" || $version=="circular") {
				$version_p='
				data-pin-shape="round"';
				$button_image="pinit_fg_en_round_red_16.png";
				}
				elseif(trim($version)=="large") {
					$version_p='
				data-pin-height="28"';
				$button_image="pin_it_button.png";
				}
				else {
					$version_p="";
					$button_image="pin_it_button.png";
				}
			if(trim($summary)!="") $summary=urlencode($summary);
			if(trim($float)!="none") {
				if(strtolower(trim($float))=="left") {$float_start="<div class=\"frn_social_p\" style=\"float:".$float."; margin-right:5px;\">"; $float_end="</div>";}
				elseif(strtolower(trim($float))=="right") {$float_start="<div class=\"frn_social_p\" style=\"float:".$float."; margin-left:5px;\">"; $float_end="</div>";}
			}
			if(trim($color)!="") $color='
				data-pin-color="'.$color.'"';
			
			//Add the pinterest script into the footer in order to run it only once no matter how many buttons are on the page
			wp_register_script( 'pinterest', '//assets.pinterest.com/js/pinit.js', false, '1.0.0', true ); //name,url,js required before to run,version,in footer
			wp_enqueue_script( 'pinterest' );
			
			//Build the button
			$pinterest.=$float_start;
			$pinterest.='<a 
				href="http://www.pinterest.com/pin/create/button/?url='.$url_p.'&media='.$image_p.'&description='.$summary.'" 
				data-pin-do="buttonPin" '.$version_p.$color.'
				data-pin-config="'.trim($counter).'" >
				<img src="//assets.pinterest.com/images/pidgets/'.$button_image.'" />
			</a>';
			$pinterest.=$float_end;
		}
		if($type=="twitter" || $type=="all" || $type=="") {
			$twitter = "";
			//assume it's twitter
			if($version=="text") {
				//convert text to URL friendly vars
				$tweet = urlencode ( $tweet );
				if(stripos($link_text,"http://")) $link_text='<img src="'.$link_text.'" />Tweet';
				else $link_text=str_replace("Share","Tweet",$link_text);
				if(trim($related)!="") $related="&related=".$related.":".urlencode ( $related_tagline );
				//uses page's url if not specified.
				if($url=="") $url_t="%20".get_permalink();
				if(trim($account)!="") $account="%20%40".$account;
				if(trim($hashtag)!="") $hashtag="%20%23".$hashtag;
				if($float=="left") $twitter.="<div class=\"frn_social_t\" style=\"float:".$float."; margin-right:5px; line-height: 70%;\">";
				elseif($float=="right") $twitter.="<div class=\"frn_social_t\" style=\"float:".$float."; margin-left:5px; line-height: 70%;\">";
				$twitter.='<a href="https://twitter.com/intent/tweet?text='.$tweet.$hashtag.$url_t.$account.$related.'" target="_blank">'.$link_text.'</a>';
				if($float=="left" || $float=="right") $twitter.="</div>";
				$twitter.='<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>';
			}
			else {
				//button
				if(trim($link_text)=="Tweet It") $link_text=="Tweet";
				if($float=="left") $float_t=" style=\"float:".$float."; margin-right:5px; line-height: 70%;\"";
				elseif($float=="right") $float_t=" style=\"float:".$float."; margin-left:5px; line-height: 70%;\"";
				else $float_t="";
				if(trim($related)!="") $related="data-related=\"".$related.":".$related_tagline."\" ";
				if($url!="") $tweet = $tweet." ".$url;
				if(trim($account)!="") $account="data-via=\"".$account."\" ";
				if(trim($hashtag)!="") $hashtag="data-hashtag=\"".$hashtag."\" ";
				$twitter.='<div class="frn_social_t"'.$float_t.'><a href="https://twitter.com/share" class="twitter-share-button" data-text="'.$tweet.'" '.$hashtag.$account.'data-size="'.$size.'" '.$related.'data-count="'.$counter.'" data-dnt="true">'.$link_text.'</a></div>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
				';
			}
		}
	}
	
	$order=trim($order);
	$order_default=$sharethis.$pinterest.$twitter;
	//manual ordering (tps, pst, stp)
	if($order!="") {
		if($order=="tps") $frn_social.=$twitter.$pinterest.$sharethis;
		elseif($order=="pst") $frn_social.=$pinterest.$sharethis.$twitter;
		else $frn_social.=$order_default;
	}
	elseif($float=="right") $frn_social.=$twitter.$pinterest.$sharethis;
	else $frn_social.=$order_default;
	
	return $frn_social;
}




///////
//Add Footer Components

//Privacy Policy Shortcode
function frn_privShortcode_funct($atts) {
	extract( shortcode_atts( array(
		'url' => ''
	), $atts, 'frn_privacy_url' ) );
	
	//assumes array of data is saved.
	$options_priv = get_option('site_footer_code');
	//shortcode simply replaces shortcode with standard url or a custom url
	if(trim($url)!="") return $url; //if they include a special URL in the privacy shortcode, then it will be used instead of main setting
	else if(trim($options_priv['ftr_priv_url'])!="") return $options_priv['ftr_priv_url'];  //If there is a custom sitewide privacy url, then it will be used instead of the default
	else return plugins_url().'/frn_plugins/privacy-policy.pdf'; //this is the default URL for the privacy policy that all sites will use
	
}

//General Footer Shortcode
//shortcode requires "return" not "echo"
function frn_ftrShortcode_funct($atts) {
	$new_atts = shortcode_atts( array(
		'sitename' => get_bloginfo( 'name' ),
		'startyear' => '',
		'align' => 'center',
		'frn_phone' => '',
		'frn_privacy_url' => '',
		'ga_phone_category' => '',
		'ga_phone_location' => 'Phone Clicks in Footer',
		'ga_phone_label' => '',
		'frn_number_style' => '',
		'paragraph' => '',
		'nodiv' => ''
	), $atts, 'frn_footer' );
	return frn_footer($new_atts);
}
//shortcode requires "return" not "echo"
function frn_footer($atts) {

	$options_ftr = get_option('site_footer_code'); //load all footer settings
	
	if((trim($options_ftr['act_autoftr'])!="" && !is_array($atts)) || is_array($atts)) {
		//This runs if there is a check in the automatically add footer and the shortcode is not running or if the shortcode is running (whether or not the auto is checked)
		//if atts is an array, then you know it's a shortcode that was used and we'll need to use "return" instead of "echo" and build things a little differently.
		
		if(is_array($atts)) extract($atts);
		else {
			$sitename=get_bloginfo( 'name' );
			$startyear="";
			$align="center";
			$frn_phone="";
			$frn_privacy_url="";
			$ga_phone_category="";
			$ga_phone_location="Phone Clicks in Footer";
			$ga_phone_label="";
			$frn_number_style="";
			$nodiv="";
		}
		
		//Prep mobile phone number SPAN code
		if($ga_phone_category!="") $ga_phone_category=' ga_phone_category="'.$ga_phone_category.'"';
		if($ga_phone_location!="") $ga_phone_location=' ga_phone_location="'.$ga_phone_location.'"';
		//	else  $ga_phone_location=' ga_phone_location="Phone Clicks in Footer"';
		if($ga_phone_label!="") $ga_phone_label=' ga_phone_label="'.$ga_phone_label.'"';
		
		if($frn_number_style=="none") $frn_number_style="";
		else if($frn_number_style!="") $frn_number_style=' style="'.$frn_number_style.'"';
		else if($frn_number_style=="") $frn_number_style=' style="white-space:nowrap;"';
		
		if(trim($frn_phone)!="") $site_phone = trim($frn_phone);
		else {
			$site_phone_options = get_option('site_phone_number');
			$site_phone = strip_tags(stripslashes($site_phone_options['site_phone'])); //cleans out all HTML and quotes
		}
		
		//Check if there is a manually entered footer or not
		$footer_code = trim($options_ftr['frn_footer']);
		if($footer_code!="") {
			
			//if there is a manually entered footer, this replaces the variables in it if any
			
			//replace phone variable
			if(stripos($footer_code,"%%frn_phone%%")>=0 || stripos($footer_code,"[frn_phone]")>=0) {
				
				$printed_number = '<span id="frn_phones"'.$ga_phone_category.$ga_phone_location.$ga_phone_label.$frn_number_style.' >'.$site_phone.'</span>';
				//End phone number prep
				$footer_code=str_replace('%%frn_phone%%',$printed_number,$footer_code);
				$footer_code=str_replace('[frn_phone]',$printed_number,$footer_code);
			}
			
			//replace privacy url
			if(stripos($footer_code,"%%frn_privacy_url%%")>=0 || stripos($footer_code,"[frn_privacy_url]")>=0) {
				if($frn_privacy_url=="") {
					if(trim($options_ftr['ftr_priv_url'])!="") $frn_privacy_url = $options_ftr['ftr_priv_url'];  //If there is a custom sitewide privacy url, then it will be used instead of the default
					else $frn_privacy_url = plugins_url().'/frn_plugins/privacy-policy.pdf'; //this is the default URL for the privacy policy that all sites will use
				}
				$footer_code=str_replace('%%frn_privacy_url%%',$frn_privacy_url,$footer_code);
				$footer_code=str_replace('[frn_privacy_url]',$frn_privacy_url,$footer_code);
			}
			
			//replace site name
			$footer_code=str_replace('%%sitename%%',$sitename,$footer_code);
			$footer_code=str_replace('[sitename]',$sitename,$footer_code);
			
			//use dynamic date
			if(stripos($footer_code,"%%year%%")>=0 || stripos($footer_code,"[year]")>=0) {
				$footer_code=str_replace('%%year%%',date("Y"),$footer_code);
				$footer_code=str_replace('[year]',date("Y"),$footer_code);
			}
			
			$frn_footer = "
			<!--START COPYRIGHT, WEBSITE NAME, PHONE NUMBER, PRIVACY POLICY-->
			".$footer_code."</div>
			<!-- END COPYRIGHT, WEBSITE NAME, PHONE NUMBER, PRIVACY POLICY -->
			";
		 
		}
		else {
			//If there is not a manually entered footer then build our default version
			
			$printed_number = '<span id="frn_phones"'.$ga_phone_category.$ga_phone_location.$ga_phone_label.$frn_number_style.' >'.$site_phone.'</span>';
			//End phone number prep
			
			if($frn_privacy_url=="") {
				if(trim($options_ftr['ftr_priv_url'])!="") $frn_privacy_url = $options_ftr['ftr_priv_url'];  //If there is a custom sitewide privacy url, then it will be used instead of the default
				else $frn_privacy_url = plugins_url().'/frn_plugins/privacy-policy.pdf'; //this is the default URL for the privacy policy that all sites will use
			}
			
			if(trim($startyear)!="") $startyear.="-";
			if($paragraph!="") $paragraph = strtolower(trim($paragraph));
			if($nodiv=="") {$nodiv_start="<div class=\"frn_footer\">";$nodiv_end="</div>";}
			else {$nodiv_start="";$nodiv_end="";}
			
			$frn_footer = "
			<!--START COPYRIGHT, WEBSITE NAME, PHONE NUMBER, PRIVACY POLICY-->
			".$nodiv_start;
			if($paragraph=="" or $paragraph=="yes" or $paragraph=="y") $frn_footer .= "<p align=\"".$align."\">";
			$frn_footer .= "Copyright © ".$startyear.date("Y")." ".$sitename.". All Rights Reserved. | Confidential and Private Call: ".$printed_number." | <a href=\"".$frn_privacy_url."\" target=\"_blank\">Privacy Policy</a>";
			if($paragraph=="" or $paragraph=="yes" or $paragraph=="y") $frn_footer .= "</p>";
			$frn_footer .= "
			".$nodiv_end."
			<!-- END COPYRIGHT, WEBSITE NAME, PHONE NUMBER, PRIVACY POLICY -->
			";
			
		}
		
		if(is_array($atts)) return $frn_footer;
			else echo $frn_footer;
	}
}




/////
//Chartbeat

//Adds chartbeat time code to HEAD
function frn_addtoheadchrbt() {
	$options_chrtbt = get_option('site_footer_code');
	/*
		IPs:
		FRN: 206.19.211.16, 173.164.20.37
		Matt: 75.118.35.203
		RankLab: 173.55.187.31
	*/
	// Keeps chartbeat from tracking us admins or any company employee
	if($_SERVER['REMOTE_ADDR']!='108.160.148.114' or $_SERVER['REMOTE_ADDR']!='206.19.211.16' or $_SERVER['REMOTE_ADDR']!='173.164.20.37' or $_SERVER['REMOTE_ADDR']!='75.118.35.203' or $_SERVER['REMOTE_ADDR']!='173.55.187.31') $launch_chartbeat="yes" ;
	// Keeps chartbeat from tracking us admins or any company employee  206.19.211.16
	else if(!is_user_logged_in() and !is_admin()) $launch_chartbeat="yes";
	else $launch_chartbeat="no";
	
	if(is_user_logged_in() and $options_chrtbt['ftr_chrbt_checkbox']=="Test") {$launch_chartbeat="yes"; $test_mode="<!--Chartbeat Test Mode Engaged-->";}
	
	/*
	if(is_user_logged_in()) echo "<!--loggedin-->"; else echo "<!--not logged in-->";
	if($_SERVER['REMOTE_ADDR']!= "108.160.148.114" and $_SERVER['REMOTE_ADDR']!= "108.160.148.114" and $_SERVER['REMOTE_ADDR']!= "206.19.211.16" and $_SERVER['REMOTE_ADDR']!= "173.164.20.37" and $_SERVER['REMOTE_ADDR']!= "75.118.35.203") echo "<!--company ip ".$_SERVER['REMOTE_ADDR']."-->"; else echo "<!--not on company ip-->";
	if(!is_admin()) echo "<!--not admin area-->";
	*/
	
	if($launch_chartbeat=="yes" and ($options_chrtbt['ftr_chrbt_checkbox']=="Activate" or $options_chrtbt['ftr_chrbt_checkbox']=="Test")) {
		//all limitations are also for the frn_addtofooter code -- had to separate since I can't add an action within another action
		$frn_chartbeat = "
	".$test_mode.
		"
	<script type='text/javascript'>var _sf_startpt=(new Date()).getTime();</script>
		
		";
	}
	else $frn_chartbeat = '
	<!--Chartbeat: You are either logged in, accessing the site from a company location, or Chartbeat is deactivated. As a result you are not being tracked in Chartbeat: Your IP address: '.$_SERVER['REMOTE_ADDR'].'-->
	
	';
	
	echo $frn_chartbeat;
	
}
function frn_chartbeat_ftr() {
	
	$company_ip="no";
	$options_chrtbt = get_option('site_footer_code');
	if($_SERVER['REMOTE_ADDR']=='108.160.148.114' or $_SERVER['REMOTE_ADDR']=='206.19.211.16' or $_SERVER['REMOTE_ADDR']=='173.164.20.37' or $_SERVER['REMOTE_ADDR']=='75.118.35.203' or $_SERVER['REMOTE_ADDR']=='173.55.187.31') $company_ip="yes" ;
	// Keeps chartbeat from tracking us admins or any company employee  206.19.211.16
	else if(!is_user_logged_in() and !is_admin()) $launch_chartbeat="yes";
	else $launch_chartbeat="no";
	
	if(is_user_logged_in() and $options_chrtbt['ftr_chrbt_checkbox']=="Test") $launch_chartbeat="yes";
	
	if($launch_chartbeat=="yes")
	{
		if($options_chrtbt['ftr_chrbt_checkbox']=="Activate" or $options_chrtbt['ftr_chrbt_checkbox']=="Test") { //if chartbeat is activated
			
			if(trim($options_chrtbt['ftr_chrbt_category'])!="") $category=$options_chrtbt['ftr_chrbt_category'];
			else $category="Niche";
			
			$pagehttp = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pagehttp .= "s";}
			$pagehttp .= "://";
			
			//goes in footer
			
			$frn_chartbeat =  "
	
	
	<!-- #####
	Chartbeat Code
	##### -->";
			
			if($options_chrtbt['ftr_chrbt_checkbox']=="Test") { 
				$frn_chartbeat .= '
	
	<!--Chartbeat: Testing Mode Engaged (Your IP address: '.$_SERVER['REMOTE_ADDR'].'; IP='.$company_ip.'; launch='.$launch_chartbeat.' )-->
		';
		//if(is_admin()) echo " <!--It's admin -->"; else echo " <!--Not an admin -->";
				if(is_user_logged_in() and $company_ip=="yes") $frn_chartbeat .= "
	<!--Chartbeat: You are logged in and on the company network and therefore not being tracked in Chartbeat. Your IP address: ".$_SERVER['REMOTE_ADDR']."-->\n
		";
				else if(is_user_logged_in()) $frn_chartbeat .= "
	<!--Chartbeat: You are logged in and therefore not being tracked in Chartbeat-->\n
		";
				else if($company_ip=="yes") $frn_chartbeat .= "
	<!--Chartbeat: You are accessing the site from a company location and therefore not being tracked in Chartbeat: Your IP address: ".$_SERVER['REMOTE_ADDR']."-->\n
		";
				else $frn_chartbeat .= "
	<!--Chartbeat: Not sure why you are seeing this.-->
		";
			}
	
			$frn_chartbeat .= "
	<script type='text/javascript'>
		var _sf_async_config={};
		/** CONFIGURATION START **/
		_sf_async_config.uid = 37107;
		_sf_async_config.domain = 'allwebsites.com';
		_sf_async_config.sections = '".str_replace($pagehttp,"",str_replace("www.","",home_url()))."';
		_sf_async_config.authors = '".$category."';
		/** CONFIGURATION END **/
		(function(){
		  function loadChartbeat() {
			window._sf_endpt=(new Date()).getTime();
			var e = document.createElement('script');
			e.setAttribute('language', 'javascript');
			e.setAttribute('type', 'text/javascript');
			e.setAttribute('src',
			   (('https:' == document.location.protocol) ? 'https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/' : 'http://static.chartbeat.com/') +
			   'js/chartbeat.js');
			document.body.appendChild(e);
		  }
		  var oldonload = window.onload;
		  window.onload = (typeof window.onload != 'function') ?
			 loadChartbeat : function() { oldonload(); loadChartbeat(); };
		})();
	</script>
	<!-- #####
	Chartbeat Code Ends
	##### -->
	
	
		";
		
		}
		
	}
	else {
	
		$frn_chartbeat = "";
	
		if($options_chrtbt['ftr_chrbt_checkbox']=="Deactivate") $frn_chartbeat .=  "
	<!--Chartbeat: Chartbeat is deactivated-->
		";
		else if(is_user_logged_in() and $company_ip=="yes") $frn_chartbeat .=   "
	<!--Chartbeat: You are logged in and on the company network and therefore not being tracked in Chartbeat. Your IP address: ".$_SERVER['REMOTE_ADDR']."-->\n
		";
		else if(is_user_logged_in()) $frn_chartbeat .=   "
	<!--Chartbeat: You are logged in and therefore not being tracked in Chartbeat-->\n
		";
		else if($company_ip=="yes") $frn_chartbeat .=   "
	<!--Chartbeat: You are accessing the site from a company location and therefore not being tracked in Chartbeat: Your IP address: ".$_SERVER['REMOTE_ADDR']."-->\n
		";
		else $frn_chartbeat .=   "
	<!--Chartbeat: You are looking at the admin area-->
		";
		
	}
	
	echo $frn_chartbeat;
	
}

//shortcode requires "return" not "echo"
function frn_baseurl_funct($atts){
	$options_basedomain = get_option('site_sitebase_code');
	
	//create site base url
	if(trim($options_basedomain['frn_sitebase'])!="") $site_base =  trim($options_basedomain['frn_sitebase']);
	else $site_base = site_url();
	
	if($_SERVER["HTTPS"] == "on") $site_base = str_replace('http://','https://',$site_base);
		
	return $site_base;
}
//shortcode requires "return" not "echo"
function frn_imagebaseurl_funct($atts){
	$options_basedomain = get_option('site_sitebase_code');
	
	//create image base url
	if(trim($options_basedomain['frn_imagebase'])!="") $site_base =  trim($options_basedomain['frn_imagebase']);
	else $site_base = site_url();
	
	if($_SERVER["HTTPS"] == "on") $site_base = str_replace('http://','https://',$site_base);
		
	return $site_base;
}
function load_jQuery() {
	//loads jQuery if the theme doesn't already
	if (!is_admin()) {
		wp_enqueue_script('jquery');
	}
}



if ( !is_admin() ){ //if page is not an admin page
	add_action('wp_head', 'frn_addtoheader', 100);
	add_action('wp_head', 'frn_lhn_slideout', 101);
	add_action('wp_head', 'frn_addtoheadchrbt', 102	); //Adds time code to head section of page
	add_action('wp_footer', 'frn_footer', 1);
	add_action('wp_footer', 'frn_chartbeat_ftr', 2);
	add_action('init', 'load_jQuery'); //loads jQuery if the theme doesn't already
	
	//shortcode works in main content areas by default. The following applies them to more areas.
	add_shortcode( 'frn_privacy_url', 'frn_privShortcode_funct' );
	add_shortcode( 'frn_footer', 'frn_ftrShortcode_funct' );
	add_shortcode( 'lhn_inpage', 'frn_lhnshortcode_funct' );
	add_shortcode( 'frn_phone', 'frn_phone_funct' );
	add_shortcode( 'frn_sitebase', 'frn_baseurl_funct' );
	add_shortcode( 'ldomain', 'frn_baseurl_funct' );
	add_shortcode( 'frn_imagebase', 'frn_imagebaseurl_funct' );
	add_shortcode( 'idomain', 'frn_imagebaseurl_funct' );
	add_shortcode( 'frn_social', 'frn_social_funct' );
	
	///General filters to activate shortcodes -- applies to all shortcodes
	add_filter('widget_text', 'do_shortcode'); //in widget code
	add_filter('single_post_title ', 'do_shortcode'); //in post titles
	add_filter('the_excerpt ', 'do_shortcode'); //for excerpts in categories
	add_filter('wp_title ', 'do_shortcode'); //for page title
	add_filter('wp_head ', 'do_shortcode');  //for meta description

}
?>