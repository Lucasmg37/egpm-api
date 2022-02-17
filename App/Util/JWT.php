<?php


namespace App\Util;


use App\Model\Model;
use Bootstrap\Config;
use Exception;
use Firebase\JWT\ExpiredException;

class JWT
{
    private $key;
    private $payload = [];
    private $algoritimo = "HS256";
    private $timeSession = 1;

    /**
     * JWT constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $config = new Config();
        $this->key = $config->getConfig("st_key");
        $this->timeSession = 60 * (int)$config->getConfig("nu_minutossessao");

        $nowTime = Model::nowTime();

        $this->payload = [
            "iat" => strtotime($nowTime),
            "exp" => strtotime($nowTime) + ((int)$this->timeSession)
        ];
    }

    /**
     * @param $name
     * @param $value
     */
    public function addInfoPayload($name, $value)
    {
        $this->payload[$name] = $value;
    }

    /**
     * @param null $head
     * @return string
     */
    public function generateCode($head = null)
    {
        return \Firebase\JWT\JWT::encode($this->payload, $this->key, $this->algoritimo, null, $head);
    }

    /**
     * @param $token
     * @return array
     * @throws Exception
     */
    public function getDataToken($token)
    {
        try {
            return (array)\Firebase\JWT\JWT::decode($token, $this->key, array($this->algoritimo));
        } catch (ExpiredException $e) {
            throw new Exception("Sessão expirada!", 1001);
        }
    }
}