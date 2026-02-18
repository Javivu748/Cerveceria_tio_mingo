<?php
/**
 * Configuración de PayPal y credenciales de API
 */

return [
    // Modo de funcionamiento: sandbox para pruebas, live para producción
    'mode'    => env('PAYPAL_MODE', 'sandbox'),

    // Credenciales para el entorno sandbox (pruebas)
    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'        => 'APP-80W284485P519543T', // ID por defecto de sandbox
    ],

    // Credenciales para el entorno live (producción)
    'live' => [
        'client_id'     => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'        => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    // Acción de pago: Sale = pago inmediato, Authorization = autorizar sin capturar, Order = crear orden
    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),

    // Moneda por defecto para los pagos
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),

    // URL a la que PayPal enviará notificaciones de pago
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),

    // Idioma que forzará el checkout de PayPal
    'locale'         => env('PAYPAL_LOCALE', 'en_US'),

    // Validar SSL al crear el cliente de API
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
];
