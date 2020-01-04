<?php


namespace App\Controller\Api;


use App\Model\Entity\Duvida;
use Exception;

class DuvidaController
{

    /**
     * @param $id_duvida
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_duvida)
    {
        $duvida = new Duvida();

        if (!empty($id_duvida)) {
            return $duvida->findOne($id_duvida);
        }

        return $duvida->findAll();
    }

}