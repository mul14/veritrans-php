<?php

require_once(__DIR__ . '/../../Veritrans.php');

Veritrans\Config::$serverKey = '<your server key>';

// Uncomment for production environment
// Veritrans\Config::$isProduction = true;

// Uncomment to enable sanitization
// Veritrans\Config::$isSanitized = true;

// Uncomment to enable 3D-Secure
// Veritrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id'     => rand(),
        'gross_amount' => 10000,
    )
);

try {
    // Redirect to Veritrans VTWeb page
    header('Location: ' . Veritrans\Vtweb::getRedirectionUrl($params));
}
catch (Exception $e) {
    echo $e->getMessage();
}
