<?php


namespace App\Business;


use App\Model\Entity\Comentarioimagem;
use Exception;

class Comentario
{

    /**
     * @param $id_comentario
     * @return \App\Model\Entity\Comentario
     * @throws Exception
     */
    public function getOne($id_comentario)
    {
        $comentario = new \App\Model\Entity\Comentario();
        $comentario->findOne($id_comentario);
        $comentario->imagens = $this->getImagens($id_comentario);
        return $comentario;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {

        $comentario = new \App\Model\Entity\Comentario();
        $comentarios = $comentario->findAll();

        foreach ($comentarios as &$comentario) {
            $comentario = $this->getOne($comentario["id_comentario"]);
        }

        return $comentarios;

    }

    /**
     * @param $id_comentario
     * @return array
     * @throws Exception
     */
    public function getImagens($id_comentario)
    {

        $comentarioImagem = new Comentarioimagem();
        $comentarioImagem->setIdComentario($id_comentario);
        $imagens = $comentarioImagem->find();

        $imagem = new \App\Model\Entity\Imagem();

        foreach ($imagens as &$item) {
            $imagem->clearObject();
            $imagem->mount($item);
            $item = $imagem->findOne();
        }

        return Imagem::mapeiaPorPrefixo($imagens);
    }

}