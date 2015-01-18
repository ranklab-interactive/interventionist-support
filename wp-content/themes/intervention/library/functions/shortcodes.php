<?php
//Screenshot     use=[ss_screenshot width='300' site='http://amazon.com']  
add_shortcode('ss_screenshot', 'ss_screenshot_shortcode');  
  
function ss_screenshot_shortcode($atts){  
  
  $width = intval($atts['width']);  
  
  $width = (100 <= $width && $width <= 300) ? $width : 200;  
  
  $site = trim($atts['site']);  
  
  if ($site != ''){  
  
    $query_url =  'http://s.wordpress.com/mshots/v1/' . urlencode($site) . '?w=' . $width;  
  
    $image_tag = '<img class="ss_screenshot_img" alt="' . $site . '" width="' . $width . '" src="' . $query_url . '" />';  
  
    echo '<a class="ss_screenshot_link" href = "' . $site . '">' . $image_tag . '</a>';   
  
  }else{    
  
  }  
}

?>