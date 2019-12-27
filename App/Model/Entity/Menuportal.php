<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Menuportal
 * @package App\Model\Entity
 * @table tb_menuportal
 */
class Menuportal extends BdAction
{

    /**
     * Menuportal constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_menuportal
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_menuportal;


    /**
     * @var $st_menuportal
     * @required
     */
    public $st_menuportal;


    /**
     * @var $st_iconmenuportal
     * @required
     */
    public $st_iconmenuportal;


    /**
     * @var $st_rota
     * @required
     */
    public $st_rota;


    /**
     * @var $bl_ativo
     * @required
     * @default 0
     */
    public $bl_ativo;



    /**
     * @return int
     */
    public function getIdMenuportal()
    {
        return $this->id_menuportal;
    }


    /**
     * @return string
     */
    public function getStMenuportal()
    {
        return $this->st_menuportal;
    }


    /**
     * @return string
     */
    public function getStIconmenuportal()
    {
        return $this->st_iconmenuportal;
    }


    /**
     * @return string
     */
    public function getStRota()
    {
        return $this->st_rota;
    }


    /**
     * @return boolean
     */
    public function getBlAtivo()
    {
        return $this->bl_ativo;
    }



    /**
     * @param int $id_menuportal
     */
    public function setIdMenuportal($id_menuportal)
    {
        $this->id_menuportal = $id_menuportal;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_menuportal
     */
    public function setStMenuportal($st_menuportal)
    {
        $this->st_menuportal = $st_menuportal;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_iconmenuportal
     */
    public function setStIconmenuportal($st_iconmenuportal)
    {
        $this->st_iconmenuportal = $st_iconmenuportal;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_rota
     */
    public function setStRota($st_rota)
    {
        $this->st_rota = $st_rota;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_ativo
     */
    public function setBlAtivo($bl_ativo)
    {
        $this->bl_ativo = $bl_ativo;
        $this->atualizaAtributos($this);
    }



}