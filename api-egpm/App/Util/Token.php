<?php


namespace App\Util;


class Token
{

    /**
     * @param string $authorizationHeader
     * @return bool|mixed
     */
    public static function getTokenByAuthorizationHeader($authorizationHeader = null) {

        if (!$authorizationHeader) {
            $authorizationHeader = HeaderTools::getAuthorizationHeader();
        }

        // HEADER: Get the access token from the header
        if (!empty($authorizationHeader)) {
            if (preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
                $token = $matches[1];
                if ($token !== "null") {
                    return $token;
                }

                return false;
            }
        }
        return false;
    }

}