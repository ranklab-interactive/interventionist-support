<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	<div class="left-content">
		<?php if(get_post_meta($post->ID,'frothy_pmessage', true)) { ?>
			<div id="page-message">
				<h2><?php echo get_post_meta($post->ID,'frothy_pmessage', true);?></h2>
				<p><?php echo get_post_meta($post->ID,'frothy_pmessage_sub', true);?></p>
			</div><!-- end page-message -->		
		<?php } ?>
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', array('class' => 'single-image') );
		}
		?>
		<?php the_content();?>

<!-- social sharing below (comment out if page doesn't load) -->
		<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>

		<?php include(TEMPLATEPATH . "/library/includes/modules/further-reading.php");?>
	</div><!-- end left-content -->
	
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
<a href="http://www.interventionsupport.com/reporting/drawhebetate.php"><span style="display: none;">tactic-article</span></a>
	<?php 
	//The link above is for reporting to a central third party system any spamming content. This link is hidden so users won't see it but bots will. We will try different ways in order to fool the spammers. ?>
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>