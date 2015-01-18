<?php get_header(); ?>
<?php include(TEMPLATEPATH . "/library/includes/modules/page-id.php");?>

<div class="content-block" style="padding-top:0px; margin: 0px 0px -50px 0px; background-color:#F0F0F0;">
<div class="wrapper">
<div class="inside">

<!--	<div id="page-message">
		<h2><?php echo stripslashes(get_option('frothy_dir_lrg_txt')); ?></h2>
		<p><?php echo stripslashes(get_option('frothy_dir_sub_txt')); ?></p>
	</div> 
--> 
<!-- end page-message -->		
		
	
<!--	<div id="geolocation-full">
			<img src="<?php echo stripslashes(get_option('frothy_dir_img')); ?>" height="250px" width="1060px" id="category-image"/>
			<div class="geo-text-block">
				<div class="promo-large-text">Looking for Help</div>
				<div class="arrow-down"></div>
				<div class="phone-num"><?php echo do_shortcode('[frn_phone"]'); ?></div>
			</div> 
-->
			<!-- end text-block -->
	</div> <!-- end geolocation-full --> 
	
<!--	
	
	<div id="category-links" style="margin-bottom:0;">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Directory Link Block')): ?><?php endif; ?>
	</div>
--> 	
<!-- end link-block -->
<div class="states-open"><h3>Sort by: State</h3>
	<div>
		<ul id="filter">  
		        <li class="current arrow"><a href="#">All</a></li>
			        
				        <?php
						$metakey = 'frothy_state_select';
						$counties = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_value ASC", $metakey) );
						if ($counties) {
						foreach ($counties as $county) {
						  echo '<li><a href="#">' . $county .'</a></li>';
						}
						}
						?> 
		    </ul> <!-- end filter --> 
	</div>
</div>
<small style="line-height:1.6; display:inline-block">This directory on Intervention Support is created using resources made available in the public domain. If you would like a listing removed, edited or added please contact us. If you are trying to reach a resource listing on one of the pages, please contact them directly through their website or contact information provided.</small> 
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->


<div id="interventionist-list">
<div class="wrapper">
<div class="inside">
	<ul id="interventionists">
	<?php query_posts('post_type=directory&posts_per_page=100&orderby=title&order=ASC');?>
	<?php if (have_posts()) :
		$i=0; // counter
		while  (have_posts()) : the_post();
		if($i%9==0) { // if counter is multiple of 3, put an opening div ?>
		<!-- <?php echo ($i+1).'-'; echo ($i+9); ?> -->
		<?php } ?>
	
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
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<p><strong>
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
				</strong><br>
				<em><?php echo get_post_meta($post->ID,'frothy_company_name', true);?></em>		
				</p>
			</div><!-- end text-block -->
			<p class="bio-blurb"><?php echo get_the_excerpt(); ?></p>
			<a class="interventionist-link" href="<?php the_permalink();?>">Read More »</a>

		</li><!-- end interventionist-item -->
		
	<?php $i++;
		if($i%9==0) { // if counter is multiple of 3, put an closing div ?>
		<div class="directory-cta">If you're not sure who to call, let us find the right interventionist for you. <?php echo do_shortcode('[frn_phone"]'); ?></div>
		<?php } ?>

	<?php endwhile; ?>
		<?php
		if($i%9!=0) { // put closing div here if loop is not exactly a multiple of 3 ?>
		
		<?php } ?>

<?php endif; ?>
	</ul>	
	
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end interventionists -->
<div style="background: #f0f0f0; padding: 40px; height: 150px;">
	<div class="wrapper">
		<div class="inside">
			<div style="float:right; margin:0px 0px 0px 0px;"><?php echo do_shortcode('[frn_phone image_url="http://www.interventionsupport.com/wp-content/uploads/680x100.jpg" alt="80% to 90% of professionally conducted interventions lead to the addict seeking immediate treatment" title="We are available 24/7 to help you find the interventionist that fits your family" ]'); ?></div>
				<div><strong>Helpful Links</strong>: 
			<div><a href="http://www.interventionsupport.com/interventionists/#what">What is an interventionist?</a></div>
			<a href="http://www.interventionsupport.com/interventionists/#research-tips">Tips on researching an interventionist</a></div>
			<?php include(TEMPLATEPATH . "/library/includes/page-share.php");?>
		</div>	
	</div>	
</div>
<div class="content-block">
<div class="wrapper">
<div class="inside">
	<div class="full-width">
		<?php echo stripslashes(get_option('frothy_dir_copy')); ?>
	</div><!-- end full-width -->
</div><!-- end wrapper div -->
</div><!-- end inside div -->
</div><!-- end content_block -->

<?php get_footer(); ?>