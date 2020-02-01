<?php


namespace App\Util;


class Server
{

    const HTTP = "http";
    const HTTPS = "https";

    /**
     * @return bool
     */
    public static function isHttps()
    {
        return $_SERVER['HTTPS'] ? true : false;
    }

    /**
     * @return string
     */
    public static function getProtocol(){
        return self::isHttps() ? self::HTTPS : self::HTTP;
    }
}