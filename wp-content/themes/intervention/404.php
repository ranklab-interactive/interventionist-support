<?php get_header(); ?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	<div class="left-content">
		<h2>Sorry, interventionist or article not available</h2>
		
		<div id="page-id" class=".error404">
			<p><span class="dropcap">O</span>ur interventionists team is here to help make this process easier. Unfortunately, the interventionist or article is no longer on this site or there is something incorrect with the web address you used. Everyday we help people find interventionists who are trustworthy, experienced, and often certified in intervention modals. If you have questions or just need someone to talk to, we are glad to help wherever we can and be part of helping your loved one get back on track (<strong><?=do_shortcode('[frn_phone frn_number_style="white-space:nowrap;display:inline;" ga_phone_location="Phone Clicks in Page (404 Error)"]'); ?></strong>).</p>
			<?php 
				$pagehttp = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pagehttp .= "s";}
				$pagehttp .= "://";
				$pageURL = $pagehttp . 	$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			?>
			<div style="margin:30px 10px;padding:5px 15px;text-align:center;font-weight:bold;border:1px solid gray;background-color:#efefef;"><?="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?></div>

			<div style="text-align:center;">
				<div class="error404_lhn">
					<?=do_shortcode('[lhn_inpage button="chat"]'); ?>
					<?=do_shortcode('[lhn_inpage button="email"]'); ?>
				</div>

				<div class="error404_search"><?php get_search_form(); ?></div>
			</div>
			
			<div style="clear:both;"></div>
			
			<br />
			<!--<p>Thank you!</p>

			<p><strong><?php bloginfo('name'); ?></strong><br />-->

		</div>

	</div><!-- end left-content -->
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php get_footer(); ?>