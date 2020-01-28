<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Diahorario;
use Exception;

class DiaHorarioController extends Controller
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

    /**
     * @return array|mixed|void
     * @throws Exception
     */
    public function postAction()
    {
        $input = $this->request->getAllParameters();

        $deletes = $input["delete"];
        $inserts = $input["insert"];

        $diaHorarioEntity = new Diahorario();

        foreach ($deletes as $delete) {
            $diaHorarioEntity->delete($delete);
        }

        foreach ($inserts as $insert) {
            $diaHorarioEntity->clearObject();
            $diaHorarioEntity->mount($insert)->save();
        }

        return $this->getAction(null);

    }


}