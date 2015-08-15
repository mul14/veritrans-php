<?php

namespace Veritrans;

/**
 * API methods to get transaction status, approvea and cancel transactions
 */
class Transaction
{
    /**
     * Retrieve transaction status
     *
     * @param string $id Order ID or transaction ID
     *
     * @return mixed[]
     */
    public static function status($id)
    {
        $url = Config::getBaseUrl() . "/$id/status";

        return ApiRequestor::get($url, Config::$serverKey, false);
    }

    /**
     * Appove challenge transaction
     *
     * @param string $id Order ID or transaction ID
     *
     * @return string
     */
    public static function approve($id)
    {
        $url = Config::getBaseUrl() . "/$id/approve";

        return ApiRequestor::post($url, Config::$serverKey, false)->status_code;
    }

    /**
     * Cancel transaction before it's settled
     *
     * @param string $id Order ID or transaction ID
     *
     * @return string
     */
    public static function cancel($id)
    {
        $url = Config::getBaseUrl() . "/$id/cancel";

        return ApiRequestor::post($url, Config::$serverKey, false)->status_code;
    }
}
