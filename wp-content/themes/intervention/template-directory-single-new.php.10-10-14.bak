<?php
/*
Template Name: [Interventionist] NEW
  3/4/2014 - edited by Dax to improve phone number tracking and recording in analytics form completions. Fixing spam issue caused every completion to be recorded as an error
             Field names were changed from things like email and name to unconventional names to protect against spam bots (e.g. maker and wire instead of name and email).
             This includes something that when something is entered into the hidden captcha fields, then a success page is shown even though nothing was sent. The security fields are supposed to be blank since they are not shown on the page.
  4/7/14   - edited again to limit submissions
  4/24/14  - fixed share box from blocking clicks on first two entries, fixed name issues in email footers, removed abhi from CCs, removed interventionist from getting directly emailed, added Call Center CCs (RACs), added variables to make code more similar to sober living code
  5/19/14 - changed "from" of email to our team to generic email instead of including the person's email
*/
?>
<?php 


/*
Left to do:
1. Replicate on CSL.com

*/


	/////
	//Settings: Recipients
	/////
		$tester_email = "Daxon.Edwards@frnmail.com";
		$tester = "Daxon Edwards <".$tester_email.">";
		$tester2_email = "Cherie.Pilliod@frnmail.com";
		$tester2 = "Cherie Pilliod <".$tester2_email.">";  //comma before is necessary
		$test="";
		
		//$recipients = "Dax Edwards (Gmail1) <daxonedwards@gmail.com>,Dax Edwards (Gmail2) <daxwards@gmail.com>,Daxon Edwards <daxon@myspotinternetmarketing.com>,";
		//$send_to = $tester;
		
		$recipients = array (
			"Caleb Rich <Caleb.Rich@frnmail.com>",
			"K Anderson <K.Anderson@frnmail.com>",
			"Josh Foster <Josh.Foster@frnmail.com>",
			"Keziah Hill <Keziah.Hill@frnmail.com>",
			"Dawn Watson <Dawn.Watson@frnmail.com>",
			"Garrett Willis <Garrett.Willis@frnmail.com>",
			"Kelley Martin <Kelley.Martin@frnmail.com>"
		);
		$proper_domain = "InterventionSupport.com";
		$base_domain = str_replace("http://","",str_replace("www.","",home_url()));
		$proper_name = "Intervention Support";
		$proper_email = "noreply";
		$subject_start = "Intervention";
		$plural_form = "interventionists";
		$singular_form = "interventionist";
		$schema_type = "Person";
	/////
	// End Settings
	/////
		
		
		
	//For Dev testing only:
	//displays array of email addresses
	$count = count($recipients);
	$send_to = "";

	//$test_array = "<!--"; //to display built list on a page
	if($count>0) {
		for ($i=0; $i<$count; $i++) {
			$send_to .= $recipients[$i].", ";
			//$test_array .= $recipients[$i].",";
		}
	}
	//echo $test_array."-->";
	
	
		
	/////
	// Spam Protection
	/////
	//Prevents too many attempts
	$subs_limit=5;
	
	session_start(); 
	//session_destroy();
	$subs=$_SESSION['submissions']; //stores session number of times submitted into a var
	$session_email = strtolower(trim($_SESSION['email'])); //no strip tags since this is set after cleaning
	
	if($subs=="" || ($subs>=5 && $session_email!="")) $_SESSION['submissions']=0; //if subs is blank, start storing session data or if something weird happened where subs increased while the email was blank, reset it.
	if($subs=="" && isset($_POST['subs'])) {
		$subs=$_POST['subs'];
		$_SESSION['submissions']=$subs;
		//backup in case sessions fail
	}
	if(isset($_POST['submitted']) && $subs>=$subs_limit) $subs=$subs+1;
	if(isset($_POST['submitted'])) {
		$post_email = strtolower(trim(strip_tags(stripslashes($_POST['wire']))));
		$post_name = trim(strip_tags(stripslashes($_POST['maker'])));
		if($session_email!=$post_email) {
			//required since the email address may change from the time before I submitted it
			if($post_email==strtolower($tester_email)) $test = "yes";
		}
	}
	//if($subs=="") 
	
	
	/////
	//Test Mode Setup: 
	/////
	//Trigger
	if(
		$session_email==strtolower($tester_email) || 
		$post_email==strtolower($tester_email) || 
		strpos($post_name,"%%test%%") || 
		strpos(trim($_SESSION['name']),"%%test%%")
	) {
		$test = "yes";
		if($_SESSION['submissions']!="") $subvarused=" (sessions used)";
		elseif($subs>$subs_limit) $subvarused=" (added one more since too many subs)";
		else $subvarused=" (post used or both blank)";
		echo "
		<!--
			testing: ACTIVE
			stored name: ".trim($_SESSION['name'])."
			stored email: ".$session_email."
			stored submissions: ".$_SESSION['submissions']."
			submitted name: ".trim($_POST['maker'])."
			submitted email address: ".$post_email."
			submitted submissions: ".$_POST['subs']."
			submissions variable: ".$subs.$subvarused." 
		-->";
	}
	else $tester=$tester .", ". $tester2;

	
	/*
	//////
	// Error handling for dev to display on page
	//////
	function customError($errno, $errstr) {
	  if($test!="") echo "<b>Error:</b> [$errno] $errstr<br>";
	}
	set_error_handler("customError");
	*/
	//$title = get_the_title();  //Was used for JS GA codes


/////
// Validate Form Submission
/////
//If the form is submitted
if(isset($_POST['submitted']) && $subs<=$subs_limit) {
	$errorType = "";
	$ga_Error = "";
	
	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['security']) != '') {
		//$captchaError = true;
		//$hasError = true;
		//$errorType = $errorType . "Captcha Blank (maybe others too); ";
		$captchaError = "Spam bot submitted this.";
		
		//$ga_Error= "
		//	<script type='text/javascript'>
		//		 _gaq.push(['_trackEvent', 'Contact an Interventionist', 'Contact Errors', '".$errorType." (SL: ".$title.")', 'From:".$email."; To:".$emailTo."']);
		//	</script>";

	} else {

		//Security Check
		//$check = $_POST["check1"] + $_POST["check2"];
		//$ans = $_POST["security"];
		
		/*
		if ($check <> $ans) {
			$hasError = true;
			$captchaError = true;
			$errorType = $errorType . "Wrong Captcha; ";
			$captchaError = "You did not add them correctly.";
		}
		*/
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['maker']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
			$errorType = $errorType . "No Name; ";
		} else {
			$name = strip_tags(trim($_POST['maker']));
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['wire']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
			$errorType = $errorType . "No Email; ";
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['wire']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
			$errorType = $errorType . "Bad Email; ";
		} else {
			$email = strip_tags(trim($_POST['wire']));
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['gibberish']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = "y";
			$errorType = $errorType . "No Comments; ";
		} else {
			if(function_exists('stripslashes')) {
				$comments = nl2br(trim($_POST['gibberish']));
				$comments = strip_tags(stripslashes($comments),"<br />,<br>");
			} else {
				$comments = nl2br(trim($_POST['gibberish']));
				$comments = strip_tags($comments,"<br />,<br>");
			}
		}
		
		/* //removed since this does not work. Leaving in case a revelation happens in the future.
		if(isset($hasError)) $ga_Error= "
			<script type='text/javascript'>
				 _gaq.push(['_trackEvent', 'Contact an Interventionist', 'Contact Errors', '".$errorType." (SL: ".$title.")', 'From:".$email."; To:".$emailTo."']);
			</script>";
		else $ga_Error = "";
		*/
		
		//If there is no error, send the email
		if(!isset($hasError)) {
			
			$pageURL = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			$pageURL = str_replace("?thankyou","",$pageURL);
			
			$blog_name = get_bloginfo('name');
			$template_base = get_bloginfo('template_directory');
			
			//$post_id = intval($_POST["id"]);
			$postid = $post->ID; //Wordpress default since we already know what page we are on
			//echo "<!--Post ID: ".$postid."-->"; //for dev testing
			$interventionist_email = get_post_meta($postid,'frothy_email', true);
			$interventionist_name = trim($_POST["int_name"]);
			//echo "<!--Interventionist email: ".$interventionist_email."-->";
			if($interventionist_email!="") $interventionist_info = $interventionist_name." &lt; ".$interventionist_email." &gt; ";
			else $interventionist_info = $interventionist_name . " (email not in system)";
			$sender = $name." <".$email.">";  //person's email that is seeking intervention
			
			//Image
			if ( has_post_thumbnail($postid) ) {
				$photo='<td valign="middle" align="center" width="160"><a href="'.$pageURL.'">'.get_the_post_thumbnail( $postid, 'thumbnail' , array('alt' => "", 'border' => '0')).'</a></td>';
			}
			else $photo = '';
			
			
			/////
			//Test Mode Setup: Recipients
			/////
			if($test!="") {
				$send_to=$sender; 
				$Cc="";
				$tester_email_mssg="[This is a test message]";
			}
			else {
				//$send_to already defined at top, no need to set it again
				$Cc="Cc: " . $tester . "\r\n";
			}
			$reply_to_ext_full = $proper_name." <".$proper_email."@".$base_domain.">";  //when we leave from info blank, this is used by site: "intervention@corporate.foundationsrecoverynetwork.com"; 
			$reply_to_ext = $proper_email."@".$base_domain; //"noreply@".str_replace("http://","",str_replace("www.","",home_url()));
			
			/*
			echo "<!--";
			echo "send_to: ".$send_to;
			echo "; reply_to_ext: ".$reply_to_ext;
			echo "; reply_to_int: ".$reply_to_int;
			echo "-->";
			*/
			
			
			
			$subject = $subject_start. " Request for ".$interventionist_name." (".$proper_domain. ")"; // . ucwords(str_replace("http://","",home_url()));
			
			//old: $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			
			$copy_intro = '
			<div class="body">
				<p>We&#39;re so glad you are pursuing recovery and we are here to help answer your intervention questions at any time, day or night. If you need help, feel free to call '.do_shortcode("[frn_phone only='yes']").'. Below is the copy of your message sent from the page for <a href="'.$pageURL.'">'.$interventionist_name.'</a> on <a href="'.home_url().'">'. $proper_domain .'</a>.</p>' . "\r\n" . '
				Sincerely, <br /> <br /> ' . "\r\n" . '
				<a href="'.home_url().'">'. $proper_domain .'</a><br /> 
				'.do_shortcode("[frn_phone only='yes']").'<br />
				<font size="1">Provided by <a href="http://www.foundationsrecoverynetwork.com">Foundations Recovery Network</a></font><br />
				<br /> 
				<br />
				<br />
				<div>- - -</div>
				'.$tester_email_mssg.'
				[The copy of your email...]<br /> <br /> <br />
			</div>' . "\r\n";
			
			//plain text version
			$copy_intro_plain = "
We&#39;re so glad you are pursuing recovery and we are here to help answer intervention questions at any time, day or night. If you need help, feel free to call (".do_shortcode("[frn_phone only='yes']")."). Below is the copy of your message sent from the page for ".$interventionist_name." (".$pageURL.") on the site ". $proper_domain .".
	
Sincerely,
". $proper_domain ." (".home_url().")
".do_shortcode("[frn_phone only='yes']")."
	
Provided by Foundations Recovery Network (http://www.foundationsrecoverynetwork.com)



	
- - -
[The copy of your email...]

";
			
			
			$body = '
			<style type="text/CSS">
			   .body {font-family: Arial, Helvetica, sans-serif; font-size:11pt; color:#333; }
			   .body a {color:#0256aa;text-decoration:none;}
			   .body a:visited {color:#577ac2;text-decoration:none;}
			   .body a:active {color:#54aaff;text-decoration:none;}
			   .body a:hover {color:#0066cc;text-decoration:underline;}
			</style>' . "\r\n" . '
			<div class="body">
			<div style="background-color:#f0f0f0; font-family:Arial, Helvetica, sans-serif; color:#333; border:1px solid #999; padding:3px;">
			  <table cellpadding="2" bgcolor="#f0f0f0" width="100%"><tr>
			  '.$photo.'
			    <td valign="top" align="left"><div style="font-family: Arial, Helvetica, sans-serif; font-size:9pt;">' . "\r\n" . '
			    <div style="font-size:7pt">INTERVENTIONIST: </div>&nbsp;&nbsp; <b>'.$interventionist_info."</b><br />&nbsp; <br />\r\n" . '
			    <div style="font-size:7pt">REQUESTED BY: </div>&nbsp;&nbsp; <b><a href="mailto:'.$email.'" style="color:#555;"><font color="#555">'.$name." (".$email.")</font></a></b><br />&nbsp; <br />\r\n" . '
			    <div style="font-size:7pt">SUBJECT: </div>&nbsp;&nbsp; <b>'.$subject."</b><br />
			  </div></td>
			  </tr></table>
			</div>\r\n" . '
			<div style="font-size:7pt;margin-top:30px;">MESSAGE:</div>' . "\r\n" . 
			$comments."
			<br />
			<br />
			<br />
			<br />
			</div>\r\n" . '
			<div style="font-size:7pt;margin-top:50px;">--<br />' . "\r\n" . $tester_email_mssg . '
			This email was sent from the information page for <a href="'.$pageURL.'">'.$interventionist_name.'</a> on <a href="'.home_url().'">'.$proper_domain.'</a>, a service provided by <a href="http://www.foundationsrecoverynetwork.com">Foundations Recovery Network</a>. '.do_shortcode("[frn_phone only='yes']").'</div>' . "\r\n" . '
			<a href="'.home_url().'"><img alt="'.$proper_domain.'" src="'.$template_base.'/style/images/logo.png" border="0" height="70" width="210" /></a><br /> <br /> 
			</div>';

			//Plain text body
			$plain_body = "
TO: ".$interventionist_name."
FROM: ".$name." (".$email.")
SUBJECT: ".$subject."
	
".$comments . '



This email was sent from the information page for '.$interventionist_name.' ('.$pageURL.') on '.$proper_domain.' ('.home_url().'), a service provided by Foundations Recovery Network (http://www.foundationsrecoverynetwork.com). '.do_shortcode("[frn_phone only='yes']").'



';


			
			//Used to enable plain text emails showing at top for email clients that don't read HTML (or don't like it)
			$unique_boundary = uniqid('frn');
			$boundary = "\r\n\r\n--" . $unique_boundary . "\r\n" . "Content-type: text/html;charset=utf-8\r\n\r\n";
			$internal_headers = 'From: '.$reply_to_ext_full."\r\n" . 
				'Reply-To: ' . $reply_to_ext . "\r\n" . 
				$Cc .
				'Content-Type: multipart/alternative; boundary=' . $unique_boundary . "\r\n";
			
			//Email to interventionist (unless in test mode). Discontinued 4/26 per decision from Lee, K, and Caleb that they wanted to be part of all communication.
				//if(trim($interventionist_email) != "") mail($emailTo, $subject, $plain_body . $boundary . '<body style="font-family: Arial, Helvetica, sans-serif; font-size:11pt;">'."\r\n".$body."\r\n </body> \r\n", $headers);
			
			//Internal Mail to Team
					//if(strpos($name,"%%test%%")===false and $email!=$tester_email) $CopyTo = $cc1_name.' <'.$cc1_email.'>, '.$cc2_name.' <'.$cc2_email.'>, '.$tester;
					//	else $CopyTo = $send_to.$tester;
					//if(trim($interventionist_email) == "") {
					//	$body = str_replace($interventionist_name,$interventionist_name." <font color=red><b>Email Not in System</b></font>",$body);
					//	$internal_prefix = '[RAC Must Contact '.$interventionist_name.'] ';
					//	}
					//	else $internal_prefix = '[Copy] ';
			mail($send_to, $subject, $plain_body . $boundary . '<body link="#0256aa" vlink="#577ac2" alink="#54aaff" style="font-family: Arial, Helvetica, sans-serif; font-size:11pt;">'."\r\n".$body."\r\n </body> \r\n", $internal_headers);

			//Email to sender if checkmark in checkbox
			$sendCopy = trim($_POST['sendCopy']);
			if($sendCopy == true) {
				$body = str_replace($interventionist_info,$interventionist_name,$body);  //makes sure interventionist or facility email is not sent to sender
				//$copy_intro = str_replace("(".$emailTo.")","",$copy_intro); 
				$subject = '[Copy] Your Message for '.$interventionist_name . ' from ' . $proper_domain;
				$ext_headers = 'From: '.$reply_to_ext_full. "\r\n" . 
				'Reply-To: ' . $reply_to_ext . "\r\n" . 
				'Content-Type: multipart/alternative; boundary=' . $unique_boundary . "\r\n";
				//$body = str_replace($interventionist_info,$interventionist_name,$body); //makes sure the interventionist's email address is not in their copy just in case the interventionist doesn't want to reply
				mail($sender, $subject, $copy_intro_plain . $plain_body . $boundary . '<body link="#0256aa" vlink="#577ac2" alink="#54aaff" style="font-family: Arial, Helvetica, sans-serif; font-size:11pt;">'."\r\n".$copy_intro . $body . "\r\n </body> \r\n", $ext_headers);
			}
			
			$emailSent = true;
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;
			//store number of successful submissions
			$subs = $subs+1;
			$_SESSION['submissions']=$subs;
		}
	}
} 


//////
// Build the Page Displayed
//////



?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php"); 







/////
/// Page Layout
////
//This portion of the page is different than sober living's
?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	<div class="left-content" itemscope itemtype="http://schema.org/<?=$schema_type; ?>">
		<div class="info-block">
		<div class="inside">
		<div class="text-block">
			<div class="headshot-linkedin">
			    <div class="headshot">
				    <?php
					//Image
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'full' , array('itemprop' => 'image'));
					}
				    ?>
			    </div>
			    <?php if(get_post_meta($post->ID,'frothy_linkedin', true)) echo '<div class="linkedin-container"><a href="'.get_post_meta($post->ID,'frothy_linkedin', true).'" target="_blank" itemprop="url" class="linkedin">LinkedIn</a></div>';?>
			    <?php if(get_post_meta($post->ID,'frothy_website_url', true)) echo '<div class="website-container"><a href="'.get_post_meta($post->ID,'frothy_website_url', true).'" target="_blank" itemprop="url">'.get_post_meta($post->ID,'frothy_website_url', true) .'</a></div>';?>
			</div>
		    <div class="bio">
			    <h2><span itemprop="name"><?php the_title(); ?></span></h2>
			    <?php if($singular_form="interventionist") { ?>
				 <div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			    	<?php if(get_post_meta($post->ID,'frothy_city', true)) echo '<p><span itemprop="addressLocality">'.get_post_meta($post->ID,'frothy_city', true).'</span>,  <span itemprop="addressRegion">'.get_post_meta($post->ID,'frothy_state_select', true).'</span></p>'; ?>
			    </div>
			    <?php }
			      	if(get_post_meta($post->ID,'frothy_company_name', true)) echo '<p><span class="company" itemprop="worksFor">'.get_post_meta($post->ID,'frothy_company_name', true).'</span></p>';
			    ?>					
			</div>	
		</div><!--end text-block -->
		</div><!-- end inside -->
		</div><!-- end info-block -->
		<?php the_content(); ?>
		<?php
					if(get_post_meta($post->ID,'frothy_video', true)) echo '<h3>Watch Video</h3><div class="video">'.get_post_meta($post->ID,'frothy_video', true).'</div>';				
				?>
		<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
	</div><!-- end left-content -->
	<aside>
	<h2>Let Us Connect You with this Interventionist</h2>	
	<div class="widget contact-block">
	<div class="inside">
		<?php 
		if($emailSent===true || $captchaError!="" || $subs>=$subs_limit) { 
			
			if($subs>$subs_limit) { 
				if($test!="") $_SESSION['submissions']=0;
				//converts single digit numbers to words for notice statement
				$dictionary  = array(
					0  => 'zero',
					1  => 'one',
					2  => 'two',
					3  => 'three',
					4  => 'four',
					5  => 'five',
					6  => 'six',
					7  => 'seven',
					8  => 'eight',
					9  => 'nine'
				);
			?>
		<div class="thanks">
		  <h2>Too Many Attempts</h2>
		  <p>You have tried to contact one or more <?=$plural_form; ?> at least <?=$dictionary[$subs_limit]; ?> times. We are available 24/7 to help families and friends select the best <?=$singular_form; ?> for their loved ones. We are passionate about helping people walk the journey of recovery. Let us help you.</p>
		  <h3><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks on '.ucwords($singular_form).' Page" ga_phone_label="Too Many Submissions"]'); ?></h3>
		  <p></p>
		</div>
			<?php 
			} //end too many attempts
			else { 
			?>

		<div class="thanks">
		  <h2>Thanks, <?=$name;?></h2>
		  <p>Your email was successfully sent! <?php if($sendCopy == true) { ?>If you don't get a copy of your email in the next minute or two, check your junk or spam folder. <?php } ?>We will be in touch soon or feel free to give us a call at <?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks on '.ucwords($singular_form).' Page" ga_phone_label="After Submission"]'); ?>.</p>
		</div>
			<?php 
			} //end if too many subs or thanks
			
			?>
		<?php /* 
		//Removed since the javascript is not executing upon page load. Keeping in case a revelation happens in the future.
		if($captchaError==="") { ?>
		<script type="text/javascript">
			 _gaq.push(['_trackEvent', 'Contact an Interventionist', 'Contact Completions', '[<?=$title; ?>]', 'From:<?=$email; ?>; To:<?=$emailTo; ?>']);
		</script>
		<?php } */
		
		} else { 
			//although not displayed to typical users, the numbers displayed are used to fake out spam bots since it displays for them (they don't read the CSS display:none setting)
			$num1 = rand(1,10);
			$num2 = rand(1,10);
		?>

			<script type='text/javascript'>
				function validateForm() {
					var slform = document.getElementById("contactForm");
					error_url="<?php the_permalink(); echo '?error'; ?>";
					ty_url="<?php the_permalink(); echo '?thankyou'; ?>";
					
					if(this.maker.value=="" || this.wire.value=="" || slform.gibberish.value=="") slform.action = error_url; // || slform.security.value==""
					else {
						var re = /^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/;
						if(re.test(this.wire.value)) slform.action = error_url;
						else slform.action = ty_url;
						//else if(<?=$num1;?> + <?=$num2;?> != slform.security.value) slform.action = error_url;
					}
				}
			</script>

			<h3>Call <?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks on Page ('.ucwords($singular_form).')" ga_phone_label="Above Contact Form"]'); ?><br />
			or Send a Message</h3>

			<?php if(isset($hasError)) echo "<p class='error_main'>Please correct the errors below...</p>";
			else echo "<p>Let us connect you with ".get_the_title().".</p>";
			
			$action=' action="'.get_permalink().'"';
			?>
			<form id="contactForm" method="post" action="<?=the_permalink(); ?>" onSubmit="return validateForm();" >
					<ul class="forms">
					<li><label>Name</label>
						<?php if($nameError != '') { ?>
							<span class="error"><?=$nameError;?></span> 
						<?php } ?>
						<input type="text" name="maker" id="maker" value="<?php if(isset($_POST['maker'])) echo $_POST['maker'];?>" class="requiredField" />
					</li>
					
					<li><label>Email</label>
						<?php if($emailError != '') { ?>
							<span class="error"><?=$emailError;?></span>
						<?php } ?>
						<input type="text" name="wire" id="wire" value="<?php if(isset($_POST['wire']))  echo $_POST['wire'];?>" class="requiredField wire" />
						
					</li>
					
					<li class="textarea"><label>Comments</label>
						<?php if($commentError != '') { ?>
							<span class="error"><?=$commentError;?></span> 
						<?php } ?>
						<textarea name="gibberish" id="gibberish" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['gibberish'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['gibberish']); } else { echo $_POST['gibberish']; } } ?></textarea>
						
					</li>
					
					<li class="captcha">
						<?php if($captchaError != '') { ?>
							<span class="error"><?=$captchaError;?></span> 
						<?php } ?>						
						<label>For security, please solve: <?php echo $num1; ?> + <?php echo $num2; ?></label>
						<input type="text" name="security" value="" style="width:50px;" />

					</li>
					
					<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /> Send yourself a copy</li>
					<li class="buttons">
						<input type="hidden" name="check1" value="<?=$num1; ?>" />
						<input type="hidden" name="check2" value="<?=$num2; ?>" />
						<input type="hidden" name="int_name" value="<?=the_title(); ?>" />
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<input type="hidden" name="id" value="<?=$postid; ?>" />
						<input type="hidden" name="subs" value="<?=$subs; ?>" />
						<br />
						<button type="submit" >Send &raquo;</button> <?php //onClick="_gaq.push(['_trackEvent', 'Contact an <?=ucwords($singular_form);?', 'Contact Attempts', 'SL: =$title; ','From:=$email; To:=$emailTo'])" ?>
					</li>
				</ul>
				</form>
					<?//=$ga_Error;?>
					
		<?php } ?>
	</div><!-- end inside -->
	</div><!-- end contact-block -->
	<?php if($test!="") {
		echo "
		Test Mode: [Activated]<br /> 
		Submissions: [".$subs."] <br />
		Emails Submitted: [".$subs. "]<br />
		Email stored: [".$_SESSION['email']. "]<br />
		Name stored: [".$_SESSION['name']. "]<br />
		";
	}
	?>
	</aside>
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>