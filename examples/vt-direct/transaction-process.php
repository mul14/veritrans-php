<?php

require_once(__DIR__ . '/../../Veritrans.php');

Veritrans\Config::$serverKey = '<your server key>';

$orderId = '1404189699';

$status = Veritrans\Transaction::status($orderId);
var_dump($status);

// $approve = Veritrans\Transaction::approve($orderId);
// var_dump($approve);

// $cancel = Veritrans\Transaction::cancel($orderId);
// var_dump($cancel);
