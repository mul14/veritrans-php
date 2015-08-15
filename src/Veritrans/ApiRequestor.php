<?php

namespace Veritrans;

use Exception;

/**
 * Class ApiRequestor.
 */
class ApiRequestor
{
    /**
     * @param string $url
     * @param string $server_key
     * @param string $data_hash
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function get($url, $server_key, $data_hash)
    {
        return self::remoteCall($url, $server_key, $data_hash, false);
    }

    /**
     * @param string $url
     * @param string $server_key
     * @param string $data_hash
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function post($url, $server_key, $data_hash)
    {
        return self::remoteCall($url, $server_key, $data_hash, true);
    }

    /**
     * @param string $url
     * @param string $server_key
     * @param string $data_hash
     * @param bool   $post
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function remoteCall($url, $server_key, $data_hash, $post = true)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic '.base64_encode($server_key.':'),
        ));

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);

            if ($data_hash) {
                $body = json_encode($data_hash);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            }
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, __DIR__.'/../data/cacert.pem');

        $result = curl_exec($ch);
        // curl_close($ch);

        if ($result === false) {
            throw new Exception('CURL Error: '.curl_error($ch), curl_errno($ch));
        } else {
            $result_array = json_decode($result);

            if (!in_array($result_array->status_code, array(200, 201, 202))) {
                $message = 'Veritrans Error ('.$result_array->status_code.'): '
                    .$result_array->status_message;

                throw new Exception($message, $result_array->status_code);
            } else {
                return $result_array;
            }
        }
    }
}
