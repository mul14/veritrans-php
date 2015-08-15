<?php

namespace Veritrans;

/**
 * Class VtDirect.
 */
class VtDirect
{
    /**
     * @param $params
     *
     * @return mixed
     */
    public static function charge($params)
    {
        $payloads = array(
            'payment_type' => 'credit_card',
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

        return $result;
    }
}
