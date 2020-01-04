<?php


namespace App\Controller\Api;


use App\Business\Comentario;

class ComentarioController
{

    public function getAction($id_comentario)
    {
        $comentario = new Comentario();

        if (!empty($id_comentario)) {
            return $comentario->getOne($id_comentario);
        }

        return $comentario->getAll();
    }

}