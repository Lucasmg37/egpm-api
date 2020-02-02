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
        return isset($_SERVER['HTTPS']);
    }

    /**
     * @return string
     */
    public static function getProtocol(){
        return self::isHttps() ? self::HTTPS : self::HTTP;
    }
}