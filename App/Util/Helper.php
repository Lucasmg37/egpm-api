<?php


namespace App\Util;


use App\Model\Model;

class Helper
{

    /**
     * Criptografa informação (Sem chave)
     * @param $data string|int
     * @return string
     */
    public static function criptografaWithDate($data = "")
    {
        return hash("sha256", Model::nowTime() . $data);
    }

    /**
     * @param $key
     * @param $data
     * @return string
     */
    public static function criptografaWithKey($key, $data)
    {
        return hash("sha256", $key . $data);
    }

    /**
     * @param $hash
     * @param $key
     * @param $data
     * @return bool
     */
    public static function isValidHash($hash, $key, $data)
    {
        return self::criptografaWithKey($key, $data) === $hash;
    }

}