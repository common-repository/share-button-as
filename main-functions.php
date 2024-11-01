<?php

/*
Plugin Name: Share Button

Description: This is share button you can easily share on your site with facebook,google plus,twitter
Author: Asaduzzaman Sohel
Version: 1.6
Author URI: www.facebook.com/asadlive.sohel1
*/


/* Adding Latest jQuery from Wordpress */
function scroll_to_top_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'scroll_to_top_latest_jquery');




function share_button_plugin_main_js() {
    wp_enqueue_script( 'share-buttton-js', plugins_url( '/js/share.js', __FILE__ ), array('jquery'), 1.0, false);
    wp_enqueue_style( 'share-buttton-css', plugins_url( '/css/style.css', __FILE__ ));
}

add_action('init','share_button_plugin_main_js');


add_action('admin_menu', 'share_button_menu');

function share_button_menu() {
	add_menu_page('Share Button option panel', 'Share Button', 'manage_options', 'share-button-option', 'share_button_option_function', plugins_url( '/images/icon.png', __FILE__  ), 6 );
	add_options_page('Share Button option panel', 'Share Button', 'manage_options', 'share-button-option', 'share_button_option_function');
}

function share_button_option_function() {?>
	<div class="wrap">
		<h2>Share Button Option</h2>
			
	</div>
	
<?php
}

function share_active(){?>


  <script>
    var share = new Share("#share-button-top", {
      networks: {
        facebook: {
          app_id: "602752456409826",
        }
      }
    });
  </script>




<?php
}
add_action('wp_footer','share_active');


function share_button_shortcode( $atts ) {
	$atts = extract( shortcode_atts( array(
		'category' => '',
		'position' => '',
		'count' => '5',
	), $atts, 'wishlist' ) );



  $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'accordion-items', 'accordion_category' => $category,'meta_key' => 'pricing_order','orderby' => 'meta_value','order' => 'ASC')
        );		
		
		
	$list = '


  <script>
    var share = new Share("#share-button-top", {
      networks: {
        facebook: {
          app_id: "602752456409826",
        }
      }
    });
  </script>



  <div id="share-button-top" class="share-button '.$position.'">';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		$product_price_dollar = get_post_meta($idd, 'product_price_dollar', true); //Shortcode custom fileld
		$list .= '
		
		
		
		';        
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;

}
add_shortcode( 'share_button','share_button_shortcode' );



?>