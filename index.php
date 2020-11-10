<?php 
/*
Plugin Name: ALT Lab Switcher
Plugin URI:  https://github.com/
Description: For making a shortcode that toggles content between two languages or really two whatevers. [switcher][main][/main][alt][/alt][/switcher] is the shortcode pattern.
Version:     1.0
Author:      ALT Lab
Author URI:  http://altlab.vcu.edu
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action('wp_enqueue_scripts', 'alt_switcher_load_scripts');

function alt_switcher_load_scripts() {                           
    $deps = array('jquery');
    $version= '1.0'; 
    $in_footer = true;    
    wp_enqueue_script('alt-switcher-main-js', plugin_dir_url( __FILE__) . 'js/alt-switcher-main.js', $deps, $version, $in_footer); 
    wp_enqueue_style( 'alt-switcher-main-css', plugin_dir_url( __FILE__) . 'css/alt-switcher-main.css');
}


//wrapper and button
function alt_switcher_shortcode($atts, $content = null){
  $html = "<div class='switcher'>
            <button class='switch-button btn btn-primary'>Switch Languages</button>";
  $html .= do_shortcode($content);
  $html .=  "</div>";
  return $html;
}

add_shortcode('switcher', 'alt_switcher_shortcode');


function alt_switcher_main_shortcode( $atts = array(), $content = null ) {
    
    return "<div class='main'>{$content}</div>";
}
add_shortcode( 'main', 'alt_switcher_main_shortcode' );

function alt_switcher_alt_shortcode( $atts = array(), $content = null ) {
    
    return "<div class='alt hide'>{$content}</div>";
}
add_shortcode( 'alt', 'alt_switcher_alt_shortcode' );

// <div class="switcher">
//   <button class="switch-button">switch languages</button>
//   <div class="main">
//     Here is English or whatever
//   </div>
//   <div class="alt hide">
//     Aqui es Español
//   </div>
// </div>



//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");
