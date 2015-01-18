<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<?php 
$full_width = has_post_format( 'aside' ); 
$permalink = get_permalink(); 
global $cfs;
?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	
<?php if ( $full_width ): ?>
	<div class="left-content" style="width:100%;">
<?php else: ?>
	<div class="left-content">
<?php endif; ?>
	
		<?php
		if ( has_post_thumbnail() && !$full_width ) {
			the_post_thumbnail( 'large', array('class' => 'single-image') );
		}
		?>
		<!--<h2><?php the_title();?></h2>-->
		<div class="postmeta">
			<?php the_time('F jS Y') ?> - Posted In: <?php the_category(', ') ?>
		</div><!-- end meta -->
		
		<div class="copy">
			<?php the_content(); ?>

		</div><!-- end copy -->
		
		<?php if ( $full_width ): ?>
		
		<div style="width:940px; margin:auto;">
		
		
		<div style="float:left; width:100%; clear:both; overflow:auto;">
			<div style="font-size:14px; font-weight:bold; margin:15px 0 10px 0;">Embed this Image on Your Site:</div>
			<textarea cols="45" rows="4" onfocus="this.select();">&lt;a href="<?php echo $permalink; ?>"&gt;&lt;img src="<?php echo $cfs->get('infographic_url'); ?>" alt="<?php the_title();?>" width="500" border="0" /&gt;&lt;/a&gt;&lt;br /&gt;Via: &lt;a href="http://www.interventionsupport.com"&gt;Intervention Support&lt;/a&gt;</textarea>
		</div>
		<div style="clear:both;"></div>
		
		</div>
		
		<?php endif; ?>
		
<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
<div style="width:200px;z-index:100; clear:both;"><a href="/contact/"><img src="http://www.foundationsrecoverynetwork.com/support/images/contact-us-cta.png" alt="Contact Us" /></a></div>

		<div id="comments-section" style="float:left; clear:both;">
			<?php comments_template( '', true ); ?>
		</div><!-- end comments-section -->

	</div><!-- end left-content -->
	
	
	<?php 
	if ( !$full_width ) { get_sidebar(); }
	?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
<div style="position: absolute; top: -250px; left: -250px;"><a href="http://www.interventionsupport.com/reporting/drawhebetate.php">tactic-article</a></div>
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>