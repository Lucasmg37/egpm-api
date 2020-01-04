<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Comentario
 * @package App\Model\Entity
 * @table tb_comentario
 */
class Comentario extends BdAction
{

    /**
     * Comentario constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_comentario
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_comentario;


    /**
     * @var $st_imagem
     */
    public $st_imagem;


    /**
     * @var $st_autor
     * @required
     */
    public $st_autor;


    /**
     * @var $st_comentario
     * @required
     */
    public $st_comentario;



    /**
     * @return int
     */
    public function getIdComentario()
    {
        return $this->id_comentario;
    }


    /**
     * @return string
     */
    public function getStImagem()
    {
        return $this->st_imagem;
    }


    /**
     * @return string
     */
    public function getStAutor()
    {
        return $this->st_autor;
    }


    /**
     * @return string
     */
    public function getStComentario()
    {
        return $this->st_comentario;
    }



    /**
     * @param int $id_comentario
     */
    public function setIdComentario($id_comentario)
    {
        $this->id_comentario = $id_comentario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_imagem
     */
    public function setStImagem($st_imagem)
    {
        $this->st_imagem = $st_imagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_autor
     */
    public function setStAutor($st_autor)
    {
        $this->st_autor = $st_autor;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_comentario
     */
    public function setStComentario($st_comentario)
    {
        $this->st_comentario = $st_comentario;
        $this->atualizaAtributos($this);
    }



}