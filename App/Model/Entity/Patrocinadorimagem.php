<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Patrocinadorimagem
 * @package App\Model\Entity
 * @table tb_patrocinadorimagem
 */
class Patrocinadorimagem extends BdAction
{

    /**
     * Patrocinadorimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_patrocinadorimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_patrocinadorimagem;


    /**
     * @var $id_imagem
     * @required
     */
    public $id_imagem;


    /**
     * @var $id_patrocinador
     * @required
     */
    public $id_patrocinador;



    /**
     * @return int
     */
    public function getIdPatrocinadorimagem()
    {
        return $this->id_patrocinadorimagem;
    }


    /**
     * @return int
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }


    /**
     * @return int
     */
    public function getIdPatrocinador()
    {
        return $this->id_patrocinador;
    }



    /**
     * @param int $id_patrocinadorimagem
     */
    public function setIdPatrocinadorimagem($id_patrocinadorimagem)
    {
        $this->id_patrocinadorimagem = $id_patrocinadorimagem;
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


    /**
     * @param int $id_patrocinador
     */
    public function setIdPatrocinador($id_patrocinador)
    {
        $this->id_patrocinador = $id_patrocinador;
        $this->atualizaAtributos($this);
    }



}