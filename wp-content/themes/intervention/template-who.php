<?php
/*
Template Name: Who
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
		<?php } else {  ?>
		<?php } ?>
	
	
	<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array('id' => 'category-image') );
		}
	?>
	<div id="category-links">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Who Link Block')): ?><?php endif; ?>
	</div><!-- end link-block -->
	<div class="full-width">
		
	</div><!-- end full-width -->
	
	<div class="left-content">
		<?php the_content(); ?>
		<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
		<?php include(TEMPLATEPATH . "/library/includes/modules/further-reading.php");?>
	</div><!-- end left-content -->
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>