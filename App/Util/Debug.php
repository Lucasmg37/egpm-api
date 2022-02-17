<?php

namespace App\Util;

use App\Model\Response;

class Debug
{

    public static function debug($data, $exit = true)
    {
        echo "<pre>";
        var_dump($data);

        if ($exit) {
            exit;
        }

    }

    public static function debugResponse($data, $message = "Debugger")
    {
        Response::succesResponse($message, $data);
    }
}