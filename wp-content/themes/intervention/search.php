<?php get_header(); ?>
	
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>
<div class="content-block">
<div class="wrapper">
<div class="inside">
	<?php if(get_post_meta($post->ID,'frothy_pmessage', true)) { ?>
		<div id="page-message">
			<h2><?php echo get_post_meta($post->ID,'frothy_pmessage', true);?></h2>
			<p><?php echo get_post_meta($post->ID,'frothy_pmessage_sub', true);?></p>
		</div><!-- end page-message -->		
	<?php } ?>
	

	<h4>You searched for <span style="color:#555555;"><?php echo $s; ?></span>. These are the <span style="color:#555555;">Interventionists</span> that matched your search.</h4>
		<ul id="interventionists" style="margin-top:30px;">
		<?php query_posts('s='.$s.'&post_type=directory&posts_per_page=-1'); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<li class="equal
				<?php
				$str = get_post_meta($post->ID,'frothy_state_select', true);
				$str = strtolower($str);
				echo $str; 
				?>
				">
					<div class="headshot">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( array(89,89) );
						} else {
							echo '<img src="'.get_bloginfo("template_url").'/style/images/blank-avatar.jpg" />';
						}
						?>
					</div>
					<div class="text-block">
						<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
						<p>
						<?php echo get_post_meta($post->ID,'frothy_city', true);?>, 
						<?php $value = get_post_meta($post->ID, 'frothy_state_select', true);
							if($value == 'Alabama') {
								echo 'AL';
							} elseif($value == 'Alaska') {
								echo 'AK';
							} elseif($value == 'Arizona') {
								echo 'AZ';
							} elseif($value == 'Arkansas') {
								echo 'AR';
							} elseif($value == 'California') {
								echo 'CA';
							} elseif($value == 'Colorado') {
								echo 'CO';
							} elseif($value == 'Connecticut') {
								echo 'CT';
							} elseif($value == 'Delaware') {
								echo 'DE';
							} elseif($value == 'District Of Columbia') {
								echo 'DC';
							} elseif($value == 'Florida') {
								echo 'FL';
							} elseif($value == 'Georgia') {
								echo 'GA';
							} elseif($value == 'Hawaii') {
								echo 'HI';
							} elseif($value == 'Idaho') {
								echo 'ID';
							} elseif($value == 'Illinois') {
								echo 'IL';
							} elseif($value == 'Indiana') {
								echo 'IN';
							} elseif($value == 'Iowa') {
								echo 'IA';
							} elseif($value == 'Kansas') {
								echo 'KS';
							} elseif($value == 'Kentucky') {
								echo 'KY';
							} elseif($value == 'Louisiana') {
								echo 'LA';
							} elseif($value == 'Maine') {
								echo 'ME';
							} elseif($value == 'Maryland') {
								echo 'MD';
							} elseif($value == 'Massachusetts') {
								echo 'MA';
							} elseif($value == 'Michigan') {
								echo 'MI';
							} elseif($value == 'Minnesota') {
								echo 'MN';
							} elseif($value == 'Mississippi') {
								echo 'MS';
							} elseif($value == 'Missouri') {
								echo 'MO';
							} elseif($value == 'Montana') {
								echo 'MT';
							} elseif($value == 'Nebraska') {
								echo 'NE';
							} elseif($value == 'Nevada') {
								echo 'NV';
							} elseif($value == 'New Hampshire') {
								echo 'NH';
							} elseif($value == 'New Jersey') {
								echo 'NJ';
							} elseif($value == 'New Mexico') {
								echo 'NM';
							} elseif($value == 'New York') {
								echo 'NY';
							} elseif($value == 'North Carolina') {
								echo 'NC';
							} elseif($value == 'North Dakota') {
								echo 'ND';
							} elseif($value == 'Ohio') {
								echo 'OH';
							} elseif($value == 'Oklahoma') {
								echo 'OK';
							} elseif($value == 'Oregon') {
								echo 'OR';
							} elseif($value == 'Pennsylvania') {
								echo 'PA';
							} elseif($value == 'Rhode Island') {
								echo 'RI';
							} elseif($value == 'South Carolina') {
								echo 'SC';
							} elseif($value == 'South Dakota') {
								echo 'SD';
							} elseif($value == 'Tennessee') {
								echo 'TN';
							} elseif($value == 'Texas') {
								echo 'TX';
							} elseif($value == 'Utah') {
								echo 'UT';
							} elseif($value == 'Vermont') {
								echo 'VT';
							} elseif($value == 'Virginia') {
								echo 'VA';
							} elseif($value == 'Washington') {
								echo 'WA';
							} elseif($value == 'West Virginia') {
								echo 'WV';
							} elseif($value == 'Wisconsin') {
								echo 'WI';
							} elseif($value == 'Wyoming') {
								echo 'WY';
							}
						?>
						</p>
						<p><?php the_excerpt(); ?></p>
					</div><!-- end text-block -->
				</li><!-- end interventionist-item -->
			
		<?php endwhile; ?>
		<?php else : ?>

		<h2>No results found.</h2>
		</ul>
	<?php endif; ?>

	<?php //get_sidebar(); ?>
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php get_footer(); ?>
