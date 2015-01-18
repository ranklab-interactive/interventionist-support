<?php get_header(); ?>
<section id="home-promo">
<div class="wrapper">
<div class="inside">
	<div class="slideshow">
		<a href="http://www.interventionsupport.com/what-is-intervention/"><img src="/wp-content/uploads/get-your-loved-one-back.jpg" border="0"/></a>
		<div class="text-block"><?php echo stripslashes(get_option('frothy_main_lrg_txt')); ?></div>
	</div><!-- end slideshow -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</section><!-- end home-promo -->
<section id="mid-promo">
<div class="wrapper">
<div class="inside">
	<div class="text-block">
		<?php echo stripslashes(get_option('frothy_mid_lrg_txt')); ?>
		<?php echo stripslashes(get_option('frothy_mid_sub_txt')); ?>
	</div><!-- end text-block -->
	
<!-- <div class="text-block searchform" style="float:right; width:45%;">
			<h3>Find A Trusted Interventionist</h3>
			<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
			<div>
			    <input type="text" id="s" name="s" value="" />
			    <input type="submit" value="Search Now" id="searchsubmit" class="btn"/>
			    <input type="hidden" name="post_type" value="directory" />
			</div>
			</form>
			<p style="float:right;">Name, Location or Specialty</p> -->
		
			<!-- <a href="<?php echo stripslashes(get_option('frothy_mid_btn_url')); ?>" class="btn"><span><?php echo stripslashes(get_option('frothy_mid_btn_txt')); ?></span></a>	-->
			<div class="search">
				<h4>Find an Interventionist</h4>
				<div class="btn">
					<span>
					<form method="get" action="">
						<input type="text" name="s" placeholder="Search by: Name, Location, Specialty" />
					</form>
					</span>
				</div>	
			</div>
			
		</div><!-- end text-block -->
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->


</section><!-- end home-promo -->


<section class="white">
<div class="wrapper">
<div class="inside">
	<div class="half left mtop mbottom">
		<?php echo stripslashes(get_option('frothy_video_embed')); ?>
	</div><!-- end half -->
	
	<div class="half right mtop">
		<a href="<?php echo stripslashes(get_option('frothy_grn_url')); ?>" class="promo-green">
			<span class="desc"><?php echo stripslashes(get_option('frothy_grn_lrg_txt')); ?></span>
			<span class="placebo-link"><?php echo stripslashes(get_option('frothy_grn_btn_txt')); ?></span>
		</a><!-- end promo-green -->
		<div class="phone-promo3">
			<span class="desc">Let Us Answer Your Questions</span>
			<span class="phone"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in Let Us Answer (Homepage)"]'); ?></span>
		</div><!-- end phone-promo3 -->
	</div><!-- end half -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</section><!-- end home-promo -->

<section class="gray2">
<div class="wrapper">
<div class="inside">
	
	<?php include (TEMPLATEPATH.'/library/includes/home-tabs.php');?>

</div><!-- end wrapper div -->
</div><!-- end inside div -->
</section><!-- end home-promo -->

<section class="gray">
<div class="wrapper">
<div class="inside">
	<div id="testimonial-promo" class="ptop">
		<?php query_posts('post_type=testimonials&posts_per_page=1');?>
		<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
		
			<?php the_post_thumbnail( 'full' ); ?>
			<div class="text-block">
				<h2><?php echo get_post_meta($post->ID,'frothy_quote', true);?></h2>
				<a href="/testimonials/" class="link">view more testimonials >></a>
				<div class="offset">
					<!--<a href="/interventionists/" class="btn"><span>Find An Interventionist</span></a>-->
					<div class="phone-promo1">
						<span class="desc">Talk To Someone Now</span>
						<span class="phone"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in Testimonials (Homepage)"]'); ?></span>
					</div><!-- end phone-promo1 -->
				</div><!-- end offset -->
				<div class="test-author">
					<span class="test-name">-<?php the_title();?></span>
					<span class="test-location"><?php echo get_post_meta($post->ID,'frothy_location', true);?></span>
				</div><!-- end test-author -->
			</div><!-- end text-block -->
		
		<?php endwhile; endif; ?>
		<?php wp_reset_query();?>		
	</div><!-- end testimonial-promo -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</section><!-- end home-promo -->

<section class="gray3">
<div class="wrapper">
<div class="inside">
	<div class="home-featured ptop">
		<div class="featured-articles">
			<div class="heading">
				<h2>Featured Intervention Article</h2>
				<a href="/articles/">View All</a>
			</div><!-- end heading -->
			<?php query_posts('section=articles&posts_per_page=1');?>
			<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
				<article>
					<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
					<div class="postmeta">
						<?php the_time('F jS Y') ?> 
					</div><!-- end meta -->
					<p><?php echo get_post_meta($post->ID,'_yoast_wpseo_metadesc', true);?></p>
					<a href="<?php the_permalink();?>" class="right">Continue Reading</a>
				</article>
			<?php endwhile; endif; ?>
			<?php wp_reset_query();?>
		</div><!-- end featured-articles -->
		<div class="featured-blog">
			<div class="heading">
				<h2>From Our Blog</h2>
				<a href="/blog/">View All</a>
			</div><!-- end heading -->
			<?php query_posts('post_type=post&posts_per_page=3');?>
			<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
				<article>
					<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
					<div class="postmeta">
						<?php the_time('F jS Y') ?>  
					</div><!-- end meta -->
				</article>
			<?php endwhile; endif; ?>
			<?php wp_reset_query();?>
						
			<div class="phone-promo2" >
				<span class="desc">Questions? Give Us A Call</span>
				<span class="phone"><?php echo do_shortcode('[frn_phone ga_phone_location="Phone Clicks in From Our Blog (Homepage)"]'); ?></span>
			</div><!-- end promo-green -->
			
		</div><!-- end featured-blog -->
	</div><!-- end home-featured -->
</div><!-- end wrapper div -->
<?php //The link below reports to a third party all spamming computers but is not visible to people. ?>
<a href="http://www.interventionsupport.com/reporting/drawhebetate.php"><div style="height: 0px; width: 0px;"></div></a>
</div><!-- end inside div -->
</section><!-- end home-promo -->

<?php get_footer(); ?>