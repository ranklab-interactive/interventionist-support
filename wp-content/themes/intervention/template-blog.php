<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	
	<div class="left-content">
		<?php query_posts('post_type=post&posts_per_page=10&paged='.$paged);?>
		<?php if (have_posts()) :  while  (have_posts()) : the_post(); ?>
			<article class="blog">
				<?php
				if ( has_post_thumbnail() ) {?>
					<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'large' );?></a>
				<?php } ?>
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="postmeta">
					<?php the_time('F jS Y') ?> - Posted In: <?php the_category(', ') ?>
				</div><!-- end meta -->
				<?php the_excerpt();?>
				<a href="<?php the_permalink();?>" class="btn"><span>Keep Reading</span></a>
			</article>
		<?php endwhile;?> 
			<?php frothy_pagination();?>
		<?php endif; ?>
		<?php wp_reset_query();?>
	</div><!-- end left-content -->
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>