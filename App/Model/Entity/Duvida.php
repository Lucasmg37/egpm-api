<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Duvida
 * @package App\Model\Entity
 * @table tb_duvida
 */
class Duvida extends BdAction
{

    /**
     * Duvida constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_duvida
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_duvida;


    /**
     * @var $st_duvida
     * @required
     */
    public $st_duvida;


    /**
     * @var $st_resposta
     * @required
     */
    public $st_resposta;


    /**
     * @var $nu_order
     */
    public $nu_order;



    /**
     * @return int
     */
    public function getIdDuvida()
    {
        return $this->id_duvida;
    }


    /**
     * @return text
     */
    public function getStDuvida()
    {
        return $this->st_duvida;
    }


    /**
     * @return text
     */
    public function getStResposta()
    {
        return $this->st_resposta;
    }


    /**
     * @return int
     */
    public function getNuOrder()
    {
        return $this->nu_order;
    }



    /**
     * @param int $id_duvida
     */
    public function setIdDuvida($id_duvida)
    {
        $this->id_duvida = $id_duvida;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_duvida
     */
    public function setStDuvida($st_duvida)
    {
        $this->st_duvida = $st_duvida;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_resposta
     */
    public function setStResposta($st_resposta)
    {
        $this->st_resposta = $st_resposta;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $nu_order
     */
    public function setNuOrder($nu_order)
    {
        $this->nu_order = $nu_order;
        $this->atualizaAtributos($this);
    }



}