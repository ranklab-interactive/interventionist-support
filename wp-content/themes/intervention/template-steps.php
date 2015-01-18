<?php
/*
Template Name: Steps
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
	
		<?php wp_nav_menu( array(
			'menu' => 'Steps Nav', 
			'container_class' => 'steps-nav',
			'walker' => new description_walker()	
		)); 
		?>
		
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', array('class' => 'single-image') );
		}
		?>
		<?php the_content(); ?>
	</div><!-- end full-width -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>