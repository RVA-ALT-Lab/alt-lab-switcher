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

//***************************************add button to editor 
add_action( 'after_setup_theme', 'switchbutton_theme_setup' );
if ( ! function_exists( 'switchbutton_theme_setup' ) ) {
  function switchbutton_theme_setup(){
    /********* TinyMCE Buttons ***********/
    add_action( 'init', 'switchbutton_buttons' );
  }
}
/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'switchbutton_buttons' ) ) {
  function switchbutton_buttons() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
          return;
      }
      if ( get_user_option( 'rich_editing' ) !== 'true' ) {
          return;
      }
      add_filter( 'mce_external_plugins', 'switchbutton_add_buttons' );
      add_filter( 'mce_buttons', 'switchbutton_register_buttons' );
  }
}
if ( ! function_exists( 'switchbutton_add_buttons' ) ) {
  function switchbutton_add_buttons( $plugin_array ) {
      $plugin_array['swpbtn'] = plugin_dir_url(__FILE__).'js/switchbutton-main.js';
      return $plugin_array;
  }
}
if ( ! function_exists( 'switchbutton_register_buttons' ) ) {
  function switchbutton_register_buttons( $buttons ) {
      array_push( $buttons, 'swpbtn' );
      return $buttons;
  }
}

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
