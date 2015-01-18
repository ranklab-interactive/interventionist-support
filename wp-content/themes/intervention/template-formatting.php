<?php
/*
Template Name: Formatting
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block">
<div class="wrapper">
<div class="inside">
<div class="full-width">

<h2>Shortcuts</h2>  

<code><textarea style="height:760px;color:#000;">
<p class="sub-text">

<div class="boxx">
<div class="boxx lgreen">
<div class="boxx green">
<div class="boxx fgreen">

<div class="boxx half-left">
<div class="boxx half-right">

<div class="separator"></div>

<div class="space"></div>

<div class="one-half">

<div class="accordion">		
<h3>Read More<span class="plus">+</span></h3>
<div>
</div>
</div>

<div class="content-tabs">
<div class="menu-wrapper">
  <ul class="tab-menu">
	<li class="one"><a href="#" class="current">Tab One</a></li>
	<li class="two"><a href="#" class="">Tab Two</a></li>
	<li class="three"><a href="#" class="">Tab Three</a></li>
	<li class="four"><a href="#" class="">Tab Four</a></li>
  </ul>
</div>
<div class="tab-content-wrapper">
	<div class="one dynamic" >
	   tab one content
	</div>
	<div class="two dynamic" style="display:none;">
	   tab two content
	</div>
	<div class="three dynamic" style="display:none;">
	   tab three content
	</div>
	<div class="four dynamic" style="display:none;">
	   tab four content
	</div>
</div>
</div>

</textarea></code>	
		

<h2>Table of Contents</h2>
<div class="toc">
<h2>Find Fast</h2>
<a rel="nofollow" href="#">Link Title Here</a>
<a rel="nofollow" href="#">Link Title Here</a>
<a rel="nofollow" href="#">Link Title Here</a>
</div>

<code><textarea style="height:120px;">
<div class="toc">
<h2>Find Fast</h2>
<a rel="nofollow" href="#">Link Title Here</a>
<a rel="nofollow" href="#">Link Title Here</a>
<a rel="nofollow" href="#">Link Title Here</a>
</div>
</textarea></code>

<h2>Highlighted Text</h2>
<p class="sub-text">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas</p>

<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas</p>

<code><textarea style="height:120px;">
<p class="sub-text">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas</p>
</textarea></code>

<h2>Boxes</h2>
<div class="boxx">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx lgreen">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx green">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx fgreen">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>


<code><textarea style="height:340px;">
<div class="boxx">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx lgreen">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx green">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>

<div class="boxx fgreen">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>
</textarea></code>


<div class="boxx lgreen half-left">
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

<code><textarea style="height:200px;">
<div class="boxx lgreen half-left">
<h3>Lorem Ipsum Dolor Sit Amit</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas <a href="#">Home</a> semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</textarea></code>


<h2>Separator</h2>

<p>This is a Regular Paragraph habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

<div class="separator"></div>

<p>This is a Regular Paragraph habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

<code><textarea style="height:30px;">
<div class="separator"></div>
</textarea></code>

<h2>Spacer</h2>

<p>This is a Regular Paragraph habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

<div class="space"></div>

<p>This is a Regular Paragraph habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

<code><textarea style="height:30px;">
<div class="space"></div>
</textarea></code>

		
<h2>One Fourth Columns</h2>
<div class="one-fourth"><h3>one-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->
<div class="one-fourth"><h3>one-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->
<div class="one-fourth"><h3>one-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->
<div class="one-fourth"><h3>one-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->

<code><textarea>
<div class="one-fourth">Content Goes Here</div><!-- end one-fourth -->
<div class="one-fourth">Content Goes Here</div><!-- end one-fourth -->
<div class="one-fourth">Content Goes Here</div><!-- end one-fourth -->
<div class="one-fourth">Content Goes Here</div><!-- end one-fourth -->
</textarea></code>


<h2>Three Fourth Column</h2>
<div class="three-fourth"><h3>three-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->
<div class="one-fourth"><h3>one-fourth</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-fourth -->

<code><textarea>
<div class="three-fourth">Content Goes Here</div><!-- end three-fourth -->
<div class="one-fourth">Content Goes Here</div><!-- end one-fourth -->
</textarea></code>


<h2>One Half Column</h2>
<div class="one-half"><h3>one-half</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-half -->
<div class="one-half"><h3>one-half</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-half -->

<code><textarea>
<div class="one-half">Content Goes Here</div><!-- end one-half -->
<div class="one-half">Content Goes Here</div><!-- end one-half -->
</textarea></code>



<h2>One Third</h2>
<div class="one-third"><h3>one-third</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-third -->
<div class="one-third"><h3>one-third</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-third -->
<div class="one-third"><h3>one-third</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-third -->

<code><textarea>
<div class="one-third">Content Goes Here</div><!-- end one-third -->
<div class="one-third">Content Goes Here</div><!-- end one-third -->
<div class="one-third">Content Goes Here</div><!-- end one-third -->
</textarea></code>



<h2>Two Third</h2>
<div class="two-third"><h3>two-third</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.  Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end two-third -->
<div class="one-third"><h3>one-third</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div><!-- end one-third -->

<code><textarea>
<div class="two-third">Content Goes Here</div><!-- end two-third -->
<div class="one-third">Content Goes Here</div><!-- end one-third -->
</textarea></code>
		
		

<h2>Accordion</h2>
<div class="accordion">		
<h3>Read More<span class="plus">+</span></h3>
<div>
	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>
</div>

<h3>Read More<span class="plus">+</span></h3>
<div>
	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>
</div>
</div><!-- end accordion div -->

<code><textarea style="height:300px;">
<div class="accordion">		
<h3>Read More<span class="plus">+</span></h3>
<div>
	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>
</div>

<h3>Read More<span class="plus">+</span></h3>
<div>
	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>
</div>
</div><!-- end accordion div -->
</textarea></code>
		
		
<h2>Tabs</h2>
<div class="content-tabs">
<div class="menu-wrapper">
  <ul class="tab-menu">
    <li class="one"><a href="#" class="current">Tab One</a></li>
	<li class="two"><a href="#" class="">Tab Two</a></li>
	<li class="three"><a href="#" class="">Tab Three</a></li>
  </ul>
</div><!-- end menu-wrapper -->
<div class="tab-content-wrapper">
	<div class="one dynamic" >
	   <h3>Lorem Ipsum Dolor Sit Amit</h3>
	   <p>tab one content</p>
	</div><!-- end one dynamic -->
	<div class="two dynamic" style="display:none;">
	   tab two content
	</div><!-- end one dynamic -->
	<div class="three dynamic" style="display:none;">
	   tab three content
	</div><!-- end one dynamic -->
</div><!-- end tab-content-wrapper -->
</div><!-- end tabs -->

<code><textarea style="height:350px;">
<div class="content-tabs">
<div class="menu-wrapper">
  <ul class="tab-menu">
    <li class="one"><a href="#" class="current">Tab One</a></li>
	<li class="two"><a href="#" class="">Tab Two</a></li>
	<li class="three"><a href="#" class="">Tab Three</a></li>
  </ul>
</div><!-- end menu-wrapper -->
<div class="tab-content-wrapper">
	<div class="one dynamic" >
		<h3>Lorem Ipsum Dolor Sit Amit</h3>
	   	<p>tab one content</p>
	</div><!-- end one dynamic -->
	<div class="two dynamic" style="display:none;">
	   tab two content
	</div><!-- end one dynamic -->
	<div class="three dynamic" style="display:none;">
	   tab three content
	</div><!-- end one dynamic -->
</div><!-- end tab-content-wrapper -->
</div><!-- end tabs -->
</textarea></code>
		
	
</div><!-- end full-width -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>