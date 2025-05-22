# atix-woocommerce
Plugin para WooCommerce (WordPress).

Facilita los cobros de tu negocio con la mejor pasarela de pagos.

> Para poder configurar el servicio, debe contar con sus API KEY de configuración.

## Requisitos

- PHP 5.0+
- Wordpress 4.9+
- WooCommerce 3.4+

## Instalación

Para la instalación es necesario seguir los siguientes pasos:

1.  Descargar el plugin dando ¡[click Aqui](https://github.com/atixdev/atix-woocommerce/releases)!
2.  En su panel de administración de WordPress, dirigirse a la sección **Plugins -> Añadir nuevo**, ubicado en el menú lateral.
3.  Dar clic en la opción **Subir Plugin**, ubicado en la parte superior de la pantalla.
4.  Ubicar el **archivo ZIP** descargado previamente y proporcionarlo al formulario de instalación de plugins. Dar clic en el botón **Instalar Ahora**.
5.  Confirmar que el plugin haya sido instalado correctamente. y presionar **Activar Plugin**.

## Configuración

1.  En su panel de administración de WordPress, dirigirse a la sección **Plugins-> Plugins instalados** - ubicado en el menú lateral
2.  Buscar el plugin **Atix Payment Gateway para WooCommerce** y dar click en **configurar**.
3.  El valor del campo **API Key SOLES y DOLARES** deben ser llenados con el valor proporcionado al darse de alta en el servicio.
4.  Para el uso del **webhook** debe ingresar su llave de seguridad configurada en su Dashboard de administración Atix.
5.  Puede indicar el nombre de su página de **"finalización de compra"** en caso no sea la predeterminada **"checkout"**.
6. Seleccionar el **estado final** en que desea que finalicen sus transacciones. **["completado", "procesando"]**.
7. Activar la opción de **Efectivo/Billeteras** si está afiliado al servicio.
8. Active o desactive el **Modo de prueba** dependiendo si su tienda se encuentra en **"Modo de pruebas"** o **"Producción"**
9. **Guardar** los cambios.


#### Changelog

<h4>Versión 3.1.0</h4><ul><li>Puedes elegir el estado de finalización de la transacción.</li><li>Modificar el nombre de tu página de finalización</li><li>Opción de indicar si tienes afiliado el pago con efectivo o billeteras digitales</li></ul>

<h4>Versión 3.0.0</h4><ul><li>Version inicial Atix</li></ul>