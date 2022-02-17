<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Fotogaleriaimagem
 * @package App\Model\Entity
 * @table tb_fotogaleriaimagem
 */
class Fotogaleriaimagem extends BdAction
{

    /**
     * Fotogaleriaimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_fotogaleriaimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_fotogaleriaimagem;


    /**
     * @var $id_fotogaleria
     * @required
     * @foreign_key_table tb_fotogaleria
     * @foreign_key_column id_fotogaleria
     */
    public $id_fotogaleria;


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
    public function getIdFotogaleriaimagem()
    {
        return $this->id_fotogaleriaimagem;
    }


    /**
     * @return int|Fotogaleria
     */
    public function getIdFotogaleria()
    {
        return $this->id_fotogaleria;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }



    /**
     * @param int $id_fotogaleriaimagem
     */
    public function setIdFotogaleriaimagem($id_fotogaleriaimagem)
    {
        $this->id_fotogaleriaimagem = $id_fotogaleriaimagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_fotogaleria
     */
    public function setIdFotogaleria($id_fotogaleria)
    {
        $this->id_fotogaleria = $id_fotogaleria;
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