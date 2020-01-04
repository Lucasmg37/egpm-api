<?php


namespace App\Controller\Api;


use App\Model\Entity\Localizacao;
use Exception;

class LocalizacaoController
{

    /**
     * @param $id_localizacao
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_localizacao)
    {
        $localizacao = new Localizacao();

        if (!empty($id_localizacao)) {
            return $localizacao->findOne($id_localizacao);
        }

        return $localizacao->findAll();

    }

}