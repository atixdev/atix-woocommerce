<?php

function getApikeyByCurrency($currency_transaction){

    $atixGateway = new WC_Gateway_Atix();
    if( $currency_transaction == 'USD' ) {
        return $atixGateway->apikey_usd;
    }

    if( $currency_transaction == 'PEN' ) {
        return $atixGateway->apikey;
    }
    throw new Exception("Error currency undefined", 1);
}

/**
 * Completa un pedido de forma segura usando un transient lock para evitar
 * condiciones de carrera entre el webhook y el controlador de retorno.
 *
 * @param WC_Order $order              Instancia del pedido a completar.
 * @param string   $finalStatus        Estado final deseado (ej. "completed", "processing").
 * @param string   $note               Nota interna agregada al pedido.
 *
 * @return bool True si el pedido fue procesado en esta llamada, false si ya estaba
 *              completo o si otro proceso adquirió el lock primero.
 */
function atix_complete_order( $order, $finalStatus, $note = 'Pago recibido.' ) {
    $order_id = $order->get_id();
    $lock_key = 'atix_processing_order_' . $order_id;

    // 1. Verificación rápida sin lock: si ya está en el estado final, no hacer nada.
    if ( $order->get_status() === $finalStatus ) {
        return false;
    }

    // 2. Intentar adquirir el lock. set_transient devuelve false si ya existe.
    if ( ! set_transient( $lock_key, true, 30 ) ) {
        // Otro proceso ya tiene el lock — salir sin actuar.
        return false;
    }

    // 3. Double-check post-lock: volver a leer el estado desde la BD.
    //    El primer proceso que llegó puede haber completado el pedido ya.
    $order = wc_get_order( $order_id );
    if ( $order->get_status() === $finalStatus ) {
        delete_transient( $lock_key );
        return false;
    }

    // 4. Procesar el pago: payment_complete() reduce el stock internamente.
    $order->payment_complete();
    $order->update_status( $finalStatus, $note );
    $order->save();

    // 5. Liberar el lock.
    delete_transient( $lock_key );

    return true;
}

function redirectPageToUrl($url){
    $url_base = home_url();
    $url_redireccion = $url_base . $url;

    wp_redirect($url_redireccion);
    exit;
}

function prepare_email_payment($order, $sent_to_admin, $plain_text, $email) {
    if (!$sent_to_admin && 'customer_completed_order' === $email->id) {
        echo '<p>Gracias por tu compra. Esperamos que disfrutes de tus productos.</p>';
    }
}
add_action('woocommerce_email_order_details', 'prepare_email_payment', 10, 4);