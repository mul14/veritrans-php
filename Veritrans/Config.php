<?php namespace Veritrans;

use Veritrans\Config;
use Veritrans\ApiRequestor;

class Config
{
    public static $serverKey;
    public static $apiVersion   = 2;
    public static $isProduction = false;
    public static $is3ds        = false;
    public static $isSanitized  = false;

    const SANDBOX_BASE_URL    = 'https://api.sandbox.veritrans.co.id/v2';
    const PRODUCTION_BASE_URL = 'https://api.veritrans.co.id/v2';

    /**
     * @return string
     */
    public static function getBaseUrl()
    {
        return Config::$isProduction
            ? Config::PRODUCTION_BASE_URL
            : Config::SANDBOX_BASE_URL;
    }
}
