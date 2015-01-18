<div id="page-id">
<div class="wrapper">
<div class="inside">
	<?php if (is_page('blog')) {?>
		
		<div class="text-block center">
			<?php if(get_post_meta($post->ID,'frothy_pmessage', true)) { ?>
				<h1><?php echo get_post_meta($post->ID,'frothy_pmessage', true);?></h1>
				<p><?php echo get_post_meta($post->ID,'frothy_pmessage_sub', true);?></p>		
			<?php } else {  ?>
				<h1><?php the_title();?></h1>
			<?php } ?>
		</div><!-- end text-block -->
		
	<?php }elseif (is_post_type_archive('directory')) {?>
		
		<div class="text-block searchform">
			<h1>Find A Trusted Interventionist</h1>
			<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
			<div>
			    <input type="text" id="s" name="s" value="" />
			    <input type="submit" value="Search Now" id="searchsubmit" class="btn"/>
			    <input type="hidden" name="post_type" value="directory" />
			</div>
			</form>
			<p style="float:right; margin-right:395px;font-size:12px;">Search By: Name, Location or Specialty</p>
		</div><!-- end text-block -->

	<?php }elseif (is_page('directory-new')) {?>
		
		<div class="text-block searchform">
			<h1>Find A Trusted Interventionist</h1>
			<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
			<div>
			    <input type="text" id="s" name="s" value="" />
			    <input type="submit" value="Search Now" id="searchsubmit" class="btn"/>
			    <input type="hidden" name="post_type" value="directory" />
			</div>
			</form>
			<p style="float:right; margin-right:395px;font-size:12px;">Search By: Name, Location or Specialty</p>
		</div><!-- end text-block -->	
	
	<?php } else { ?>
	
		<div class="text-block">
			<h1><?php the_title(); ?></h1>
			<?php include(TEMPLATEPATH . "/library/includes/modules/breadcrumbs.php");?>
		</div><!-- end text-block -->
		<?php if(get_post_meta($post->ID,'frothy_btn_url', true)) { ?>
			<a href="<?php get_post_meta($post->ID,'frothy_btn_url', true);?>" class="btn">
			<span><?php if(get_post_meta($post->ID,'frothy_btn_text', true)) { 
				echo get_post_meta($post->ID,'frothy_btn_text', true);
			}else{
				echo 'Learn More';
			}?>
			
			</span></a>
		<?php } ?>
	
	<?php } ?>
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->	
</div><!-- end pageid -->