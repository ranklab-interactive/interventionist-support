<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
	<div class="left-content">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'thumbnail', array('class' => 'single-image') );
		}
		?>
		<h2><?php the_title();?></h2>
		<div class="share">
			<div class="share-item" >
				<!-- Place this tag where you want the +1 button to render -->
				<g:plusone size="medium" annotation="none"></g:plusone>
				
				<!-- Place this render call where appropriate -->
				<script type="text/javascript">
				  (function() {
				    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				    po.src = 'https://apis.google.com/js/plusone.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div><!-- end share-item -->
			
			<div class="fb-like share_item" data-send="false" data-layout="button_count"   data-show-faces="false"></div><!-- end share-item -->
			
			<div class="share-item"><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></div>
			
		</div><!-- end share -->
		<?php the_content(); ?>
		
	</div><!-- end left-content -->
	
	<?php get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>