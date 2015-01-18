<div id="author-info">
    <div id="author-image">
    	<a href="<?php the_author_meta('user_url'); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?></a>
    </div>   
    <div id="author-bio">
        <h4>Written by <?php the_author_link(); ?></h4>
        <p><?php the_author_meta('description'); ?></p>
    </div>
</div><!--Author Info-->
