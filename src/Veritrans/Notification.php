<?php namespace Veritrans;

class Notification
{
    private $response;

    public function __construct()
    {
        $this->response = json_decode(file_get_contents('php://input'), true);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->response)) {
            return $this->response[$name];
        }
    }
}
