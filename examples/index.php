<?php

require __DIR__.'/../Veritrans.php';

Veritrans\Config::$serverKey = '705882c8-f8f1-45fa-a23e-652ee4fcf40f';

$notif = new Veritrans\Notification();

$transaction = $notif->transaction_status;
$fraud = $notif->fraud_status;

error_log("Order ID $notif->order_id: " .
    "transaction status = $transaction, fraud staus = $fraud");

if ($transaction == 'capture') {
    if ($fraud == 'challenge') {
        // TODO Set payment status in merchant's database to 'challenge'
    }
    else if ($fraud == 'accept') {
        // TODO Set payment status in merchant's database to 'success'
    }
}
else if ($transaction == 'cancel') {
    if ($fraud == 'challenge') {
        // TODO Set payment status in merchant's database to 'failure'
    }
    else if ($fraud == 'accept') {
        // TODO Set payment status in merchant's database to 'failure'
    }
}
else if ($transaction == 'deny') {
    // TODO Set payment status in merchant's database to 'failure'
}
