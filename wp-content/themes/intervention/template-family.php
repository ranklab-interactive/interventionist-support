<?php
/*
Template Name: Family
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
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array('class' => 'single-image margin-bottom') );
		}
		?>
		<?php the_content();?>
		<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
		<div id="faqs">
			<h2 class="gray">Frequently Asked Questions</h2>
			<div class="accordian1">
			<?php query_posts('post_type=faqs&posts_per_page=100'); ?>
			<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
				<h3><?php the_title();?></h3>
				<div><?php the_content();?></div>
			<?php endwhile; endif; ?>
			<?php wp_reset_query();?>
			</div><!-- end accordian1 div -->
		</div><!-- end faqs -->
		
	</div><!-- end left-content -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>