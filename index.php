<?php
/**
 * Plugin Name: WeJob Public
 * Version: 0.1
 * Author: Benoît Hubert
 */

 //[foobar]
function wejob_public_app( $atts ){
  $entry = file_get_contents(__DIR__ . '/dist/entry.html');
  $start = strpos($entry, '<div id="root"></div>');
  $end = strpos($entry, '</body>');
  $body_inner = substr($entry, $start, $end - $start);
  $plugin_base_url = plugins_url("wejob-public");
  $script_replaced = str_replace('src="/', "src=\"$plugin_base_url/dist/", $body_inner);
  $script_replaced = str_replace('.js', ".js?ts=" . time(), $script_replaced);
  return $script_replaced;
}

add_shortcode( 'wejob_app', 'wejob_public_app' );
