<?php
// Incluye el archivo que contiene la clase
require_once plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

// Ahora sí puedes usar la clase
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/atixdev/atix-woocommerce/',
    plugin_dir_path(__DIR__) . 'woocommerce-atix.php',
    'woocommerce-atix'
);