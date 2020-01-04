<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Datahorariocampeonato;

class DataHorarioController extends Controller
{

    public function postAction()
    {
        $input = $this->request->getAllParameters();
        foreach ($input["datahorario"] as $dataHorario) {
            $dataHorarioEntity = new Datahorariocampeonato();
            $dataHorarioEntity->mount($dataHorario);
            $dataHorarioEntity->setIdJogo($input["id_jogo"]);
            $dataHorarioEntity->save();
        }

        foreach ($input["datahorariocampeonatoremover"] as $id) {
            $dataHorarioEntity = new Datahorariocampeonato();
            $dataHorarioEntity->delete($id);
        }

    }
}