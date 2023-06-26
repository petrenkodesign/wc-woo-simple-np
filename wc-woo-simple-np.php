<?php
/**
 * Plugin Name: WOO Simple Nova Poshta
 *
 * @package           PluginPackage
 * @author            Olexa Petrenko
 * @copyright         2023 toloka.top
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WOO Simple Nova Poshta
 * Plugin URI:        https://github.com/petrenkodesign/wc-woo-simple-np
 * Description:       Plugin for integration Nova Poshta service to woo shop.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Olexa Petrenko
 * Author URI:        https://toloka.top
 * Text Domain:       woo-simple-np
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/petrenkodesign/wc-woo-simple-np
 */

 if ( ! defined( 'ABSPATH' ) ) { // protection against external access to the plugin via url
	exit; // Exit if accessed directly
}


function add_shipping_method( $methods ) {
	$methods['snp_shipping_method'] = 'Simple_NP_Shipping_Method';
	return $methods;
}

function plugin_initialization() {
	include_once( plugin_dir_path( __FILE__ ) . 'includes/NovaPoshtaProcessor.php' );
	include_once( plugin_dir_path( __FILE__ ) . 'includes/PluginConfig.php' );
	include_once( plugin_dir_path( __FILE__ ) . 'includes/ShippingMethod.php' );

	add_filter( 'woocommerce_shipping_methods', 'add_shipping_method' );
	// shortcode for shipping form
	add_shortcode( 'simple_nova_poshta', array( new NP(), 'search_settlements' ) );
	// setting link for plugin on plugins page
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( new PluginConfig(), 'apd_settings_link' ) );
}

add_action( 'init', 'plugin_initialization' );