<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Comentarioimagem
 * @package App\Model\Entity
 * @table tb_comentarioimagem
 */
class Comentarioimagem extends BdAction
{

    /**
     * Comentarioimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_comentarioimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_comentarioimagem;


    /**
     * @var $id_comentario
     * @required
     * @foreign_key_table tb_comentario
     * @foreign_key_column id_comentario
     */
    public $id_comentario;


    /**
     * @var $id_imagem
     * @required
     * @foreign_key_table tb_imagem
     * @foreign_key_column id_imagem
     */
    public $id_imagem;



    /**
     * @return int
     */
    public function getIdComentarioimagem()
    {
        return $this->id_comentarioimagem;
    }


    /**
     * @return int|Comentario
     */
    public function getIdComentario()
    {
        return $this->id_comentario;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }



    /**
     * @param int $id_comentarioimagem
     */
    public function setIdComentarioimagem($id_comentarioimagem)
    {
        $this->id_comentarioimagem = $id_comentarioimagem;
        $this->atualizaAtributos($this);
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
     * @param int $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
        $this->atualizaAtributos($this);
    }



}