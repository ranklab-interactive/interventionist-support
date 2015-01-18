<aside>	
<?php if (is_home() || is_search()) {?>
		
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Default Sidebar') ) : ?>
	<?php endif; ?>

<?php }elseif (is_page('interventionists') || is_singular('directory')) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Directory Sidebar') ) : ?>
	<?php endif; ?>

<?php }elseif (is_page('testimonials') || is_singular('testimonials')) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Testimonial Sidebar') ) : ?>
	<?php endif; ?>
		
<?php } elseif (is_page('blog') || is_single() || is_archive()) {	?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar') ) : ?>
	<?php endif; ?>
	
<?php }elseif (is_page('who-need-an-intervention') || in_section( 'who' )) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Who Sidebar') ) : ?>
	<?php endif; ?>
	
<?php }elseif (in_section( 'about-intervention' )) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('About Intervention Sidebar') ) : ?>
	<?php endif; ?>
	
<?php }elseif (is_page('articles') || in_section( 'articles' )) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Articles Sidebar') ) : ?>
	<?php endif; ?>
	
<?php }elseif (in_section( 'family-support' )) { ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Family Support Sidebar') ) : ?>
	<?php endif; ?>
	
<?php } else { ?>

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Default Sidebar') ) : ?>
	<?php endif; ?>

<?php } ?>
</aside>