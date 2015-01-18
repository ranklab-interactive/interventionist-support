<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->
<head>
<meta charset="<?php bloginfo('charset'); ?>">	
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="google-site-verification" content="WOVon3HRLTwg8Fz9J-3OT8ZZezL3gdcyAA1mlQ7d36Y" />
<meta name="google-site-verification" content="KZcALrj8d-jfB-ExTO5--9ALI26rR66bZi6WQ-n1cu4" />
<meta name="format-detection" content="telephone=no">
<meta property="fb:admins" content="701372480" />
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" /> 
<?php } ?>
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico">
<!-- This is the traditional favicon.
	 - size: 16x16 or 32x32
	 - transparency is OK
	 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
	 
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_/img/apple-touch-icon.png">
<!-- The is the icon for iOS's Web Clip.
	 - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4's retina display (IMHO, just go ahead and use the biggest one)
	 - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
	 - Transparency is not recommended (iOS will put a black BG behind the icon) -->
<link href="http://fonts.googleapis.com/css?family=Coustard" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- all our JS is at the bottom of the page, except for Modernizr. -->
<script src="<?php bloginfo('template_directory'); ?>/library/js/modernizr-1.7.min.js"></script>
<script type='text/javascript'>var _sf_startpt=(new Date()).getTime()</script>
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/fancybox/source/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/js/fancybox/source/jquery.fancybox.css?v=2.1.2" media="screen" />


<script>
	$(document).ready(function() {
		$('.notice').fancybox({
			'scrolling'   : 'yes'
		});
	});
</script>


<!-- Start of Woopra Code -->
<script type="text/javascript">
function woopraReady(tracker) {
    tracker.setDomain('interventionsupport.com');
    tracker.setIdleTimeout(300000);
    tracker.track();
    return false;
}
(function() {
    var wsc = document.createElement('script');
    wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
    wsc.type = 'text/javascript';
    wsc.async = true;
    var ssc = document.getElementsByTagName('script')[0];
    ssc.parentNode.insertBefore(wsc, ssc);
})();
</script>
<!-- End of Woopra Code -->


<script type="text/javascript">
  var _kmq = _kmq || [];
  var _kmk = _kmk || 'f8c41dda3831cab7889a42d6e5a9624f5141caaa';
  function _kms(u){
    setTimeout(function(){
      var d = document, f = d.getElementsByTagName('script')[0],
      s = d.createElement('script');
      s.type = 'text/javascript'; s.async = true; s.src = u;
      f.parentNode.insertBefore(s, f);
    }, 1);
  }
  _kms('//i.kissmetrics.com/i.js');
  _kms('//doug1izaerwt3.cloudfront.net/' + _kmk + '.1.js');
</script>

</head>


<body <?php body_class(); ?>>


 
<section id="topbar">

	<div class="share">
		<div class="share-item">
	<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></script>
	</div>
	
	<div class="share-item">
	<g:plusone size="medium"></g:plusone></div>
	
	<div class="share-item">
	<div class="fb-like" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false"></div>
	</div>
	
	

<!-- Place this render call where appropriate -->


<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=193679857447141";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		
	</div><!-- end share -->
	<div id="company-nav">
		<ul>
			<li><a href="<?php echo get_option('home'); ?>/about-us/">About Us</a></li>
			<li>|</li>
			<li><a href="<?php echo get_option('home'); ?>/contact/">Contact</a></li>
			<li>|</li>
			<li><a href="<?php echo get_option('home'); ?>/testimonials/">Testimonials</a></li>
			<li>|</li>
			<li><a href="<?php echo get_option('home'); ?>/blog/">Blog</a></li>
			
		</ul>
	</div><!-- end company-nav -->
</section><!-- end top bar -->
<header id="header">
<div class="wrapper">
<div class="inside">
	<div id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></div>
	<nav id="topnav">
		<ul>
			<li <?php if(is_page('who-need-an-intervention') || in_section('who')) { echo 'class="current"';} ?>>
				<a href="<?php echo get_option('home'); ?>/who-need-an-intervention/">
				<span class="label">Who</span>
				<span class="desc">Needs Help</span>
				</a>
			</li>
			<li <?php if(is_page('what-is-intervention') || in_section('about-intervention')) { echo 'class="current"';} ?>>
				<a href="<?php echo get_option('home'); ?>/what-is-intervention/">
				<span class="label">About</span>
				<span class="desc">Interventions</span>
				</a>
			</li>
			<li <?php if(is_post_type_archive('directory') || is_singular('directory')) { echo 'class="current"';} ?>>
				<a href="<?php echo get_option('home'); ?>/interventionists/">
				<span class="label">Find</span>
				<span class="desc">An Interventionist</span>
				</a>
			</li>
			<li <?php if(is_page('family-intervention')) { echo 'class="current"';} ?>>
				<a href="<?php echo get_option('home'); ?>/family-intervention/">
				<span class="label">Family</span>
				<span class="desc">Support Center</span>
				</a>
			</li>
		</ul>
	</nav><!-- end topnav div -->
	<div class="phone-promo4">
		<a class="notice" href="#call" rel="nofollow"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks Opening What to Expect Window (Header)"]'); ?>
		<p><img src="http://www.interventionsupport.com/wp-content/uploads/arrow-cta.png">Talk to an expert</a></p>
		<div id="call" style="width:600px;display:none;">
			<h3>What to Expect When You Call</h3>
			<p>When you call us, we will place you with the most qualified family mediator according to the needs of your family.</p>
			<div class="boxx lgreen"><p>We may discuss the following with you:</p>
			<ul style="list-style-type:disc; padding-left:40px; margin-bottom:15px;">
				<li>Who it is that needs help and why.</li>
				<li>We will help determine what services you will require.</li>
				<li>What treatment and aftercare plans you will need to arrange.</li>
			</ul>
</div>
			<p class="sub-text" align="center">Ease your stress, call today<br />get connected with a family mediator.</p>
			<div align="center" style="margin-top: 25px;"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in Who To Expect Popup" frn_number_style="font-size:48px; color:#76B617;"]'); ?></div>
			<div class="boxx frn-service">
				<img id="frn-logo" src="<?php echo get_template_directory_uri();?>/style/images/frn_logo.png" alt="Foundations Recovery Network Logo" width="160px">
				<p>Intervention Support is a service provided by Foundations Recovery Network. As part of the Foundations Recovery Network, our goal is to provide science-based treatments to individuals suffering from issues of addiction and mental illness.</p>
				<p>When you call you will be connected to a member of the Foundations Recovery Network who will assist in providing you with any questions you may have regarding the treatment process.</p>
				<p>The treatment directory on Intervention Support is created using resources made available in the public domain. If you would like a listing removed, edited or added please contact us. If you are trying to reach a resource listing on one of the pages, please contact them directly through their website or contact information provided.</p>
				<hr>
				<img id="jcaho-logo"src="<?php echo get_template_directory_uri();?>/style/images/JCAHO_logo.png" alt="JCAHO Logo" width="106px">
				<p>JCAHO The Joint Commission on Accreditation of Healthcare Organizations (JCAHO) is the national evaluation and certifying agency for health care organization and programs in the United States. JCAHO strives to improve health care for the public. FRN is proud to be affiliated with several JCAHO accredited facilities.</p>
			</div>
		</div>
	</div><!-- end phone-promo4 -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->


<!-- Start Visual Website Optimizer Asynchronous Code -->
<script type='text/javascript'>
var _vwo_code=(function(){
var account_id=31005,
settings_tolerance=2000,
library_tolerance=1500,
use_existing_jquery=false,
// DO NOT EDIT BELOW THIS LINE
f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
</script>
<!-- End Visual Website Optimizer Asynchronous Code -->


</header><!-- end header -->