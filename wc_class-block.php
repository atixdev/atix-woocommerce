<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Gateway_Atix_Blocks extends AbstractPaymentMethodType {

    private $gateway;
    protected $name = 'atix_gateway';// your payment gateway name

    public function initialize() {
        $this->settings = get_option( 'woocommerce_atix_gateway_settings', [] );
        $this->gateway = new WC_Gateway_Atix();
    }

    public function is_active() {
        return $this->gateway->is_available();
    }

    public function get_payment_method_script_handles() {

        wp_register_script(
            'wc-atix-gateway-blocks-integration',
            plugin_dir_url(__FILE__) . 'js/checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
                'wp-i18n',
            ],
            WOOCOMMERCE_ATIX_VERSION,
            true
        );

        $plugin_url = plugins_url('', __FILE__);

        wp_localize_script(
            'wc-atix-gateway-blocks-integration',
            'atixPluginData',
            array(
                'pluginUrl' => $plugin_url
            )
        );

        if( function_exists( 'wp_set_script_translations' ) ) {            
            wp_set_script_translations( 'wc-atix-gateway-blocks-integration', 'woocommerce-atix', plugin_dir_url(__FILE__) . 'languages/');
            
        }
        return [ 'wc-atix-gateway-blocks-integration' ];
    }

    public function get_payment_method_data() {
        return [
            'title' => __('Pay with credit or debit card', 'woocommerce-atix'),
            'description' => __('Allows payments via payment gateway for Atix Payment Services.', 'woocommerce-atix'),
        ];
    }

}
?>