<?php
/*
Plugin Name: WP Simple Code Highlighter
Plugin URI: https://shaon.pro/
Description: A simple WordPress plugin for syntax highlighting code using Prism.js Where user can use shortcode and highlight codes. 
Version: 1.0.0,1
Author: Mahmudul Hasan Shaon
Author URI: https://shaon.pro/
License: GPL2
*/

// Load the required scripts and styles
add_action( 'wp_enqueue_scripts', 'simple_code_highlighter_scripts' );
function simple_code_highlighter_scripts() {
    wp_enqueue_style( 'prism', 'https://cdn.jsdelivr.net/npm/prismjs@1.25.0/themes/prism.min.css' );
    wp_enqueue_style( 'prism-line-numbers', 'https://cdn.jsdelivr.net/npm/prismjs@1.25.0/plugins/line-numbers/prism-line-numbers.min.css' );
    wp_enqueue_script( 'prism', 'https://cdn.jsdelivr.net/npm/prismjs@1.25.0/prism.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'prism-line-numbers', 'https://cdn.jsdelivr.net/npm/prismjs@1.25.0/plugins/line-numbers/prism-line-numbers.min.js', array( 'prism' ), false, true );
    wp_enqueue_style( 'simple-code-highlighter', plugins_url( 'simple-code-highlighter.css', __FILE__ ) );
}

// Define the shortcode
add_shortcode( 'code', 'simple_code_highlighter_shortcode' );
function simple_code_highlighter_shortcode( $atts, $content = null ) {
    // Extract the shortcode attributes
    extract( shortcode_atts( array(
        'lang' => ''
    ), $atts ) );
 
    // Make sure the content is properly escaped
    $content = htmlspecialchars( $content );
 
    // Wrap the content in a pre tag with the language-* and line-numbers classes
    $output = '<pre class="language-' . $lang . ' line-numbers"><code>' . do_shortcode( $content ) . '</code></pre>';
 
    // Return the output
    return $output;
}
