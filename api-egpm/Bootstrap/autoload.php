<?php

function __autoload($class)
{

    $class = "../" . str_replace('\\', '/', $class) . ".php";

    if (!file_exists($class)) {
        throw new Exception("Arquivo '{$class}' não encontrado!");
    }

    require_once($class);

}



