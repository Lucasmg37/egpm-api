<?php


namespace App\Controller\Api;


use App\Business\Patrocinador;

class PatrocinadorController
{

    public function getPatrocinadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::PATROCINADOR);
    }

    public function getRealizadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::REALIZADOR);
    }

    public function getApoiadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::APOIADOR);
    }

    public function getAction($id_patrocinador)
    {
        $patrocinador = new Patrocinador();

        if (!empty($id_patrocinador)) {
            return $patrocinador->getOne($id_patrocinador);
        }

        return $patrocinador->getAll();

    }

}
