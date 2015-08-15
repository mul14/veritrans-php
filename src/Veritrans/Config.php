<?php

namespace Veritrans;

/**
 * Veritrans Configuration
 */
class Config
{
    /**
     * Your merchant's server key
     *
     * @static
     */
    public static $serverKey;

    /**
     * Your merchant's client key
     *
     * @static
     */
    public static $clientKey;

    /**
     * true for production
     * false for sandbox mode
     *
     * @static
     */
    public static $isProduction = false;

    /**
     * Set it true to enable 3D Secure by default
     *
     * @static
     */
    public static $is3ds = false;

    /**
     * Enable request params sanitizer (validate and modify charge request params).
     * See Veritrans\Sanitizer for more details
     *
     * @static
     */
    public static $isSanitized = false;

    /**
     * Default options for every request
     *
     * @static
     */
    public static $curlOptions = array();

    const SANDBOX_BASE_URL = 'https://api.sandbox.veritrans.co.id/v2';
    const PRODUCTION_BASE_URL = 'https://api.veritrans.co.id/v2';

    /**
     * @return string Veritrans API URL, depends on $isProduction
     */
    public static function getBaseUrl()
    {
        $url = Config::$isProduction
            ? Config::PRODUCTION_BASE_URL
            : Config::SANDBOX_BASE_URL;

        return $url;
    }
}
