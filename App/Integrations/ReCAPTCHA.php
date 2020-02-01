<?php


namespace App\Integrations;


use Bootstrap\Config;
use Exception;

class ReCAPTCHA
{

    const RECAPTCHA_URL = "https://www.google.com/recaptcha/api/";

    /**
     * @param $recaptchatoken
     * @return mixed
     * @throws Exception
     */
    public static function siteVerify($recaptchatoken)
    {
        $config = new Config();
        $secret = $config->getConfig("st_senhacapcha");

        $verify = file_get_contents(self::RECAPTCHA_URL . "siteverify?secret=$secret&response=$recaptchatoken");
        $captcha_success = json_decode($verify, false);

        return $captcha_success->success;
    }
}