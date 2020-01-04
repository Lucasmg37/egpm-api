<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Business\Secao;
use Exception;

class SecaoController extends Controller
{
    /**
     * @param $st_rota
     * @return \App\Model\Entity\Secao|\App\Model\Entity\Secao[]
     * @throws Exception
     */
    public function getAction($st_rota)
    {

        $secao = new Secao();

        if (!empty($st_rota)) {
            return $secao->getOneByRota($st_rota);
        }

        return $secao->getAll();
    }

}