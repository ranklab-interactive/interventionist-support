<?php
/*
Template Name: Testimonials
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
	
	<div class="left-content">
		<div id="testimonial" >
		<?php query_posts('post_type=testimonials&posts_per_page=10');?>
		<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
			<div class="testimonial-item">
				<?php the_post_thumbnail( 'medium' ); ?>
				<div class="text-block">
					<h2><?php the_title();?>'s Story</h2>
					<?php the_excerpt();?>
					<a href="<?php the_permalink();?>" class="btn right"><span>Read <?php the_title(); ?>'s Story</span></a>
				</div><!-- end text-block -->
			</div><!-- end testimonial-item -->
		
		<?php endwhile; endif; ?>
		<?php wp_reset_query();?>		
		</div><!-- end testimonial -->
	</div><!-- end left-content -->
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>