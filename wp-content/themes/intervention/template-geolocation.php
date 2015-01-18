<?php
/*
Template Name: Geolocation Template
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
<?php if(get_post_meta($post->ID,'frothy_pmessage', true)) { ?>
		<div id="page-message">
			<h2><?php echo get_post_meta($post->ID,'frothy_pmessage', true);?></h2>
			<p><?php echo get_post_meta($post->ID,'frothy_pmessage_sub', true);?></p>
		</div><!-- end page-message -->	
	<?php } ?>	
	
	<div class="full-width">
		<div id="geolocation-full">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'full');
			}
			?>
			<div class="geo-text-block">
				<div class="promo-large-text">Let Us Tell You How it Works</div>
				<div class="arrow-down"></div>
				<div class="phone-num"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in How It Works Geo Button"]'); ?></div>
			</div><!-- end text-block -->
		</div><!-- end geolocation-full -->
	</div><!-- end full-width -->
	<div class="left-content">
			<?php the_content(); ?>
			<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
		</div><!-- end left-content -->
		<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>