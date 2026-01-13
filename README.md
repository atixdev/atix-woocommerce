# Atix Payment Gateway para WooCommerce

[![WordPress](https://img.shields.io/badge/WordPress-4.9%2B-blue.svg)](https://wordpress.org/)
[![WooCommerce](https://img.shields.io/badge/WooCommerce-3.4%2B-purple.svg)](https://woocommerce.com/)
[![PHP](https://img.shields.io/badge/PHP-5.0%2B-777BB4.svg)](https://www.php.net/)

Plugin oficial de Atix para WooCommerce que facilita la integración de pagos en línea para tu tienda WordPress.

## 📋 Descripción

Atix Payment Gateway permite a tu tienda WooCommerce procesar pagos de forma segura y eficiente mediante tarjetas de crédito, débito, y opciones de efectivo/billeteras digitales.

### Características principales

- ✅ Pagos con tarjetas de crédito y débito
- ✅ Pagos en efectivo y billeteras digitales (opcional)
- ✅ Soporte para PEN (Soles) y USD (Dólares)
- ✅ Modo de pruebas y producción
- ✅ Webhooks para actualización automática de estados
- ✅ Compatible con checkout clásico y por bloques
- ✅ Configuración personalizable de estados de orden

## 🔧 Requisitos del sistema

| Componente | Versión mínima |
|------------|----------------|
| PHP | 5.0 o superior |
| WordPress | 4.9 o superior |
| WooCommerce | 3.4 o superior |

> **Importante:** Antes de instalar el plugin, asegúrate de contar con tus credenciales API Key de Atix. Si aún no las tienes, solicítalas en [tu panel de administración de Atix](https://dashboard.atix.com.pe).

## 📦 Instalación

### Método 1: Instalación manual desde WordPress

1. Descarga la última versión del plugin desde [releases](https://github.com/atixdev/atix-woocommerce/releases)
2. En tu panel de WordPress, ve a **Plugins → Añadir nuevo**
3. Haz clic en **Subir Plugin** (parte superior)
4. Selecciona el archivo ZIP descargado
5. Haz clic en **Instalar ahora**
6. Una vez instalado, haz clic en **Activar Plugin**

### Método 2: Instalación vía FTP

1. Descarga y descomprime el archivo ZIP
2. Sube la carpeta `atix-woocommerce` a `/wp-content/plugins/`
3. Activa el plugin desde el menú **Plugins** en WordPress

## ⚙️ Configuración

### Configuración inicial

1. En WordPress, navega a **WooCommerce → Ajustes → Pagos**
2. Localiza **Atix Payment Gateway** y haz clic en **Configurar**
3. Completa los siguientes campos:

#### Credenciales API

- **API Key Soles (PEN):** Ingresa tu API Key para transacciones en soles
- **API Key Dólares (USD):** Ingresa tu API Key para transacciones en dólares

#### Configuración de Webhook

- **Llave de seguridad Webhook:** Ingresa la llave configurada en tu Dashboard de Atix
- Esta llave garantiza que solo Atix pueda actualizar el estado de tus órdenes

#### Opciones avanzadas

| Opción | Descripción | Valores |
|--------|-------------|---------|
| **Página de checkout** | Slug de tu página de finalización de compra | Por defecto: `checkout` |
| **Estado final de orden** | Estado al completar el pago exitosamente | `completado` o `procesando` |
| **Modo de prueba** | Alterna entre entorno de pruebas y producción | Activar/Desactivar |

4. Haz clic en **Guardar cambios**

### Verificación de la instalación

Para verificar que todo funciona correctamente:

1. Activa el **Modo de prueba**
2. Realiza una compra de prueba en tu tienda
3. Verifica que la transacción se procese correctamente
4. Revisa que el estado de la orden se actualice automáticamente

Una vez verificado, desactiva el modo de prueba para comenzar a recibir pagos reales.

## 🚀 Uso

Una vez configurado, el plugin aparecerá automáticamente como método de pago durante el proceso de checkout. Tus clientes podrán:

1. Seleccionar **Atix** como método de pago
2. Completar los datos de su tarjeta de forma segura
3. Recibir confirmación inmediata de su compra

## 📝 Changelog

### Versión 3.2.0
- ✨ Agregada compatibilidad con checkout por bloques de WooCommerce

### Versión 3.1.3
- 🔧 Mejoras en la actualización del estado de compra

### Versión 3.1.2
- 🎨 Mejoras en imagen de marca

### Versión 3.1.1
- 🔧 Optimización en actualización por webhook

### Versión 3.1.0
- ✨ Opción para elegir el estado final de la transacción
- ✨ Configuración personalizable del nombre de página de finalización
- ✨ Soporte para pagos con efectivo y billeteras digitales

### Versión 3.0.0
- 🎉 Lanzamiento inicial del plugin Atix

## 🆘 Soporte

Si tienes problemas con la instalación o configuración del plugin:

- 📧 Contacta a soporte técnico: [soporte@atix.pe](mailto:soporteti@atix.com.pe)
- 📖 Consulta la documentación completa en [docs.atix.pe](https://docs.atix.com.pe)


---

Desarrollado con ❤️ por [Atix](https://atix.com.pe)