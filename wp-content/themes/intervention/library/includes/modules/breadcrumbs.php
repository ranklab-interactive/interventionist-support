<div id="bread-wrapper">
<?php // Breadcrumb navigation
    if (is_page() && !is_front_page() || is_single() || is_category() ) {
        echo '<p id="breadcrumb">';
        echo '<a href="'.get_bloginfo('url').'" class="home">Home</a>';
        echo '<span class="breadcrumb-arrow">&#x232A;</span>';
 		
        
        if(is_page('articles')){
        }elseif(in_section('articles')) {
        	echo '<a href="/articles/">Articles</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        
        if(is_page('who-need-an-intervention')){
        }elseif(in_section('who')) {
        	echo '<a href="/who-need-an-intervention/">Who Needs Intervention</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        
        if (is_page('what-is-intervention')) {
        }elseif(in_section('about-intervention')) {
        	echo '<a href="/what-is-intervention/">About Intervention</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        
        if (is_page('family-intervention')) {
        }elseif(in_section('family-support')) {
        	echo '<a href="/family-intervention/">Family Intervention</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        
        if (is_singular('testimonials')) {
        	echo '<a href="/testimonials/">Testimonials</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }elseif (is_singular('directory')) {
        	echo '<a href="/interventionists/">Interventionists</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        elseif (is_single()) {
        	echo '<a href="/blog/">Blog</a>';
        	echo '<span class="breadcrumb-arrow">&#x232A;</span>';
        }
        
        if (is_page()) {
            $ancestors = get_post_ancestors($post);
 
            if ($ancestors) {
                $ancestors = array_reverse($ancestors);
 
                foreach ($ancestors as $crumb) {
                    echo '<a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a>';
                    echo '<span class="breadcrumb-arrow">&#x232A;</span>';
                }
            }
        }
 
        if (is_single('blog_posts')) {
            $category = get_the_category();
            echo '<a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a>';
        }
 
        if (is_category()) {
            $category = get_the_category();
            echo ''.$category[0]->cat_name.'';
        }
 
        // Current page
        if (is_page() || is_single()) {
            echo ''.get_the_title().'';
            
        }
        echo '</p>';
    } elseif (is_front_page()) {
        // Front page
        echo '<p class="breadcrumbs">';
        echo '<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a>';
        echo 'Home Page';
        echo '</p>';
    }
?>
</div><!-- end bread-wrapper -->