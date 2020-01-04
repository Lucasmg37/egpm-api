<?php


namespace App\Controller\Api;


use App\Model\Entity\Botao;
use Exception;

class IngressoController
{

    /**
     * @return mixed|null
     * @throws Exception
     */
    public function getAction()
    {
        $botao = new Botao();
        return $botao->getFirst($botao->findAll());
    }

}