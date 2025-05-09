<?php

/**
 * Atix Payment Gateway for Woocommerce
 *
 * This is a simple payment gateway for Atix Payment Services.
 *
 * @link              https://dashboard.atix.com.pe/
 * @since             3.1.0
 * @package           woocommerce_atix
 *
 * @wordpress-plugin
 * Plugin Name:       Atix Payment Gateway for Woocommerce
 * Plugin URI:        https://docs.atix.com.pe/plugin-woocommerce
 * Description:       This is a simple payment gateway for Atix Payment Services.
 * Version:           3.1.0
 * Author:            Atix
 * Author URI:        https://atix.com.pe/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-atix
 * Domain Path:       /languages
 * Update URI:        atix.com/plugin
 * Requires at least: 4.9
 * Tested up to: 6.7.2
 * Requires PHP: 5.5
 */

/* --------------------------------------------------------------
    ABORT IF FILE IS CALLED DIRECTLY
-------------------------------------------------------------- */
if ( ! defined( 'WPINC' ) ) {
    die;
}

/* --------------------------------------------------------------
    DEFINE CURRENT PLUGIN VERSION
-------------------------------------------------------------- */
define( 'WOOCOMMERCE_ATIX_VERSION', '3.1.0' );

require dirname( __FILE__ ) . '/plugin-update-checker/load-v5p5.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/atixdev/atix-woocommerce',
    __FILE__,
    'atix_payment_gateway'
);

$myUpdateChecker->setBranch('main');

function init_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'init_session');

//Load languages
add_action('plugins_loaded', 'atix_load_textdomain');
function atix_load_textdomain() {
    load_plugin_textdomain(
        'woocommerce-atix',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages/'
    );
}

//Plugin link
require_once plugin_dir_path(__FILE__) . 'includes/wc_atix_gateway_plugin_links.php';

//Webhook
require_once plugin_dir_path(__FILE__) . 'includes/wc_register_webhook_endpoint.php';
require_once plugin_dir_path(__FILE__) . 'includes/wc_webhook_notification.php';

//Documentation
require_once plugin_dir_path(__FILE__) . 'includes/wc_atix_add_documentation_menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/wc_atix_documentation_handler.php';

//init data
require_once plugin_dir_path(__FILE__) . 'includes/wc_atix_gateway_init.php';

//Custom Page redirect
require_once plugin_dir_path(__FILE__) . 'includes/wc_custom_page_controller.php';

//Create dinamic confirmation route
require_once plugin_dir_path(__FILE__) . 'includes/wc_dinamic_confirmation_route.php';

//title option checkout
require_once plugin_dir_path(__FILE__) . 'includes/wc_custom_atix_gateway_title.php';

require_once plugin_dir_path(__FILE__) . 'includes/wc_utils.php';

//Checkout block
require_once plugin_dir_path(__FILE__) . 'includes/wc_compatibility_checkout_block.php';


const BASE_URL_SANDBOX = "https://gateway.atix.com.pe/PaymentGatewayJWS_Sandbox/Service1.svc";
const BASE_URL_PROD = "https://gateway.atix.com.pe/PaymentGatewayJWS/Service1.svc";




