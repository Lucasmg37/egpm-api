<?php


namespace App\Util;


use App\Model\Model;

class Helper
{

    /**
     * Criptografa informação (Sem chave)
     * @param $data
     * @return string
     */
    public static function criptografaWithDate($data)
    {
        return hash("sha256", Model::nowTime() . $data);
    }

}