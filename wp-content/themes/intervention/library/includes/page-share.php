<?php if(!is_page(1750)): ?>
<div id="page-share">

	<div class="share-item" style="margin-top: 4px;"><!-- Place this tag where you want the +1 button to render -->
<g:plusone size="medium"></g:plusone></div>

	<div class="share-item" style="margin-top: 4px;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
	
	<div class="share-item"><fb:like href="<?php echo get_permalink($post->ID); ?>" send="true" layout="button" width="450" show_faces="false" ref="bottom_of_content"></fb:like></div>

</div><!-- end page-share div -->
<?php endif; ?>