<?php


namespace App\Business;


use App\Model\Validate;
use Exception;

class Apoio
{

    /**
     * @param $parametros
     * @return \App\Model\Entity\Apoio
     * @throws Exception
     */
    public function insert($parametros)
    {
        $apoioEntity = new \App\Model\Entity\Apoio();

        $apoioEntity->validate(Validate::APOIO, [], $parametros, false);
        $apoioEntity->setStEmail($parametros["st_email"]);
        $apoioEntity->mount($apoioEntity->getFirst($apoioEntity->find()));

        if ($apoioEntity->getIdApoio()) {
            throw new Exception("E-mail já se encontra cadastrado!");
        }

        $apoioEntity->mount($parametros);
        $apoioEntity->setBlAtivo(1);
        $apoioEntity->setBlAnalisado(0);
        return $apoioEntity->insert();
    }

}