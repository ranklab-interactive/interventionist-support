<?php
if($post->post_parent)
$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
else
$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
if ($children) { ?>

<div id="further-reading">
	<div class="title-block">
		<h2>Further Reading About <?php the_title();?></h2>
	</div><!-- end title-block -->
	<div class="link-block">
		<ul>
			<?php echo $children; ?>
		</ul>
	</div><!-- end link-block -->
</div><!-- end further-reading -->
<?php } ?>