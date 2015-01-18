<?php get_header(); ?>
<?php if (have_posts()) : ?>
<div id="page-id">
<div class="wrapper">
<div class="inside">
	
	<div class="text-block">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
	
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
	
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
	
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1>Archive for <?php the_time('F, Y'); ?></h1>
	
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
	
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h1 class="pagetitle">Author Archive</h1>
	
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="pagetitle">Blog Archives</h1>
		
		<?php } ?>

		<?php include(TEMPLATEPATH . "/library/includes/modules/breadcrumbs.php");?>
	</div><!-- end text-block -->
	
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->	
</div><!-- end pageid -->

<div class="content-block">
<div class="wrapper">
<div class="inside">
	
	<div class="left-content">
	
	<?php while (have_posts()) : the_post(); ?>
	<article class="blog">
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
</div><!-- end left-content -->
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->
<?php get_footer(); ?>
