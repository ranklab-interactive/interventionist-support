<?php
/*
Template Name: Articles
*/
?>
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
		<?php query_posts('section=articles&posts_per_page=100');?>
		<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
			<article class="reg">
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="postmeta">
					<?php the_time('F jS Y') ?>  |  By: <?php the_author(); ?>
				</div><!-- end meta -->
				<p><?php echo get_post_meta($post->ID,'_yoast_wpseo_metadesc', true);?></p>
				<a href="<?php the_permalink();?>" class="right">Continue Reading</a>
			</article>
		<?php endwhile; endif; ?>
		<?php wp_reset_query();?> 
		<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
	</div><!-- end left-content -->
	
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>