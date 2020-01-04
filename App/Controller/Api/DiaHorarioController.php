<?php


namespace App\Controller\Api;


use App\Model\Entity\Diahorario;
use Exception;

class DiaHorarioController
{

    /**
     * @param $id_diahorario
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_diahorario)
    {
        $diaHorario = new Diahorario();

        if (!empty($id_diahorario)) {
            return $diaHorario->findOne($id_diahorario);
        }

        return $diaHorario->findAll();
    }

}