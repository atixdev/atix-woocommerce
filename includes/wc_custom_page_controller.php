<?php

function custom_page_controller(){
   
    $atixGateway = new WC_Gateway_Atix();
    $sectionUrl  = $atixGateway->sectionNameUrl;

    try {

        $token = isset( $_GET['tk'] ) ? sanitize_text_field( $_GET['tk'] ) : '';

        ?>
        <div style="width: 100%; display: flex; justify-content: center; flex-direction: column; align-items: center; margin-top: 40px;">
            <img style="max-width: 200px;" src="<?php echo plugins_url('../assets/images/procesando.png', __FILE__);?>" alt="Procesando"/>
            <p>Estamos procesando tu solicitud. Por favor espera un momento.</p>
        </div>
        <?php

        if (!$token) {
            throw new \Exception('Token not provided');
        }

        $debug = $atixGateway->testmode;

        $url = BASE_URL_SANDBOX . '/GBCPE_ResultTransaction';

        if (!$debug) {
            $url = BASE_URL_PROD . '/GBCPE_ResultTransaction';
        }

        // Obtener el identificador del pedido actual, de la sesión orderId
        $orderId = isset($_SESSION['orderId']) ? $_SESSION['orderId'] : '';

        $order = wc_get_order($orderId);

        if (!$order) {
            throw new \Exception(__('Order not found', 'woocommerce-atix'));
        }

        $data = array(
            "Token" => $token
        );

        $response = wp_remote_request($url, array(
            'method'  => 'POST',
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
            ),
            'body' => json_encode($data)
        ));

        if (is_wp_error($response)) {
            // Manejar el error si ocurre
        } else {
            $finalStatusTransaction = $atixGateway->finalStatus;

            $body     = wp_remote_retrieve_body($response);
            $response = json_decode($body);
            $resultCode = $response[0]->ResultCode;

            if (isset($response[0]->ResultCode) && $resultCode === '00') {
                // atix_complete_order usa transient lock para evitar doble procesamiento
                // con el webhook. Si el webhook ya completó el pedido, esta llamada
                // detecta el estado final y no realiza ninguna acción.
                atix_complete_order( $order, $finalStatusTransaction, 'Pago confirmado por retorno del cliente.' );

                redirectPageToUrl("/$sectionUrl/order-received/" . $order->get_id() . '/?key=' . $order->get_order_key());

            } else {

                // Solo marcar como fallido si el pedido aún no fue completado por el webhook
                if ($order->get_status() !== $finalStatusTransaction) {
                    $order->update_status('failed');
                    $order->save();
                }

                redirectPageToUrl("/$sectionUrl/order-received/" . $order->get_id() . '/?key=' . $order->get_order_key());
            }
        }

    } catch (\Exception $e) {

        echo $e->getMessage();
        if (isset($order) && $order) {
            $order->update_status('failed');
            $order->save();
            redirectPageToUrl("/$sectionUrl/order-received/" . $order->get_id() . '/?key=' . $order->get_order_key());
        }
        exit;
    }
}
