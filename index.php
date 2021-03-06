<?php
/**
 * Plugin Name: WeJob Public Test
 * Version: 0.1
 * Author: Benoît Hubert
 * TODO : gérer modes dev et prod
 */

function wejob_public_app( $atts ){
  $body_inner = file_get_contents(__DIR__ . '/dist/entry.html');
  $plugin_base_url = plugins_url("wejob-public");
  $script_replaced = str_replace('src="/', "src=\"$plugin_base_url/dist/", $body_inner);
  // Ajout d'un timestamp pour forcer le reload
  $script_replaced = str_replace('.js', ".js?ts=" . time(), $script_replaced);
  return $script_replaced;
}

add_shortcode( 'wejob_app', 'wejob_public_app' );
