<footer id="footer">
<div class="wrapper">
<div class="inside">
	<?php

	if(is_page('blog') || is_category()) {
	
	} elseif (is_page() || is_singular('directory') || is_singular('testimonials')) {?>
		<div id="footer-links">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Links')): ?><?php endif; ?>
		</div><!-- end footer-links -->
	<?php } elseif ( is_single()) {?>	
		
	<?php } else { ?>
	
		<div id="footer-links">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Links')): ?><?php endif; ?>
		</div><!-- end footer-links -->
	
	<?php } ?>
	
	<div id="footer-info">
		<div id="logo"></div>
		<ul class="social">
			<li class="facebook"><a href="">Facebook</a></li>
			<li class="twitter"><a href="">Twitter</a></li>
		</ul><!-- end social -->
		<div id="phone"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in Footer"]'); ?>
		</div><!-- end phone -->
	</div><!-- end footer-info -->
	<div id="footer-base">
		<?php echo do_shortcode('[frn_footer align="left"]'); ?>
	</div><!-- end footer-base -->
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</footer>


<?php wp_footer(); ?>
</body>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/library/js/jquery.uniform.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/library/js/jquery.equalheights.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/library/js/scripts.js"></script>
</html>