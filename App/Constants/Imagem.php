<?php


namespace App\Constants;


class Imagem
{
    const PREFIXO_ORIGINAL = "ori";
    const PREFIXO_DEFAULT = "default";
    const PREFIXO_SMALL = "sm";
    const PREFIXO_MEDIUM = "md";
    const PREFIXO_LARGE = "lg";

    const RESIZE = [
        self::PREFIXO_DEFAULT => 576,
        self::PREFIXO_SMALL => 768,
        self::PREFIXO_MEDIUM => 992,
        self::PREFIXO_LARGE => 1200
    ];
}