<?php

namespace Veritrans;

/**
 * Class VtWeb.
 */
class VtWeb
{
    /**
     * @param $params
     *
     * @return string
     */
    public static function getRedirectionUrl($params)
    {
        $payloads = array(
            'payment_type' => 'vtweb',
            'vtweb' => array(
                // 'enabled_payments' => array('credit_card'),
                'credit_card_3d_secure' => Config::$is3ds,
            ),
        );

        if (array_key_exists('item_details', $params)) {
            $gross_amount = 0;

            foreach ($params['item_details'] as $item) {
                $gross_amount += $item['quantity'] * $item['price'];
            }

            $payloads['transaction_details']['gross_amount'] = $gross_amount;
        }

        $payloads = array_replace_recursive($payloads, $params);

        if (Config::$isSanitized) {
            Sanitizer::jsonRequest($payloads);
        }

        $url = Config::getBaseUrl().'/charge';

        $result = ApiRequestor::post($url, Config::$serverKey, $payloads);

        return $result->redirect_url;
    }
}
