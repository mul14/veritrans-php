<?php namespace Veritrans;

use Veritrans\Config;
use Veritrans\ApiRequestor;

/**
 * Class Transaction
 *
 * @package Veritrans
 */
class Transaction
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public static function status($id)
    {
        $url = Config::getBaseUrl() . '/' . $id . '/status';

        return ApiRequestor::get($url, Config::$serverKey, false);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function approve($id)
    {
        $url = Config::getBaseUrl() . '/' . $id . '/approve';

        return ApiRequestor::post($url, Config::$serverKey, false)->status_code;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function cancel($id)
    {
        $url = Config::getBaseUrl() . '/' . $id . '/cancel';

        return ApiRequestor::post($url, Config::$serverKey, false)->status_code;
    }
}
