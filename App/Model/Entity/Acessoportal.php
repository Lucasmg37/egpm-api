<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Acessoportal
 * @package App\Model\Entity
 * @table tb_acessoportal
 */
class Acessoportal extends BdAction
{

    /**
     * Acessoportal constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_acessoportal
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_acessoportal;


    /**
     * @var $bl_abrepaginalogin
     * @required
     */
    public $bl_abrepaginalogin;


    /**
     * @var $bl_participanteacessa
     * @required
     * @default 0
     */
    public $bl_participanteacessa;


    /**
     * @var $bl_recuperasenha
     * @required
     * @default 0
     */
    public $bl_recuperasenha;


    /**
     * @var $dt_acessousuarioinicio
     */
    public $dt_acessousuarioinicio;


    /**
     * @var $dt_acessousuariofim
     */
    public $dt_acessousuariofim;


    /**
     * @var $bl_acessoprogramado
     * @required
     * @default 0
     */
    public $bl_acessoprogramado;


    /**
     * @var $st_messagewelcome
     */
    public $st_messagewelcome;



    /**
     * @return int
     */
    public function getIdAcessoportal()
    {
        return $this->id_acessoportal;
    }


    /**
     * @return boolean
     */
    public function getBlAbrepaginalogin()
    {
        return $this->bl_abrepaginalogin;
    }


    /**
     * @return boolean
     */
    public function getBlParticipanteacessa()
    {
        return $this->bl_participanteacessa;
    }


    /**
     * @return boolean
     */
    public function getBlRecuperasenha()
    {
        return $this->bl_recuperasenha;
    }


    /**
     * @return date
     */
    public function getDtAcessousuarioinicio()
    {
        return $this->dt_acessousuarioinicio;
    }


    /**
     * @return date
     */
    public function getDtAcessousuariofim()
    {
        return $this->dt_acessousuariofim;
    }


    /**
     * @return boolean
     */
    public function getBlAcessoprogramado()
    {
        return $this->bl_acessoprogramado;
    }


    /**
     * @return string
     */
    public function getStMessagewelcome()
    {
        return $this->st_messagewelcome;
    }



    /**
     * @param int $id_acessoportal
     */
    public function setIdAcessoportal($id_acessoportal)
    {
        $this->id_acessoportal = $id_acessoportal;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_abrepaginalogin
     */
    public function setBlAbrepaginalogin($bl_abrepaginalogin)
    {
        $this->bl_abrepaginalogin = $bl_abrepaginalogin;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_participanteacessa
     */
    public function setBlParticipanteacessa($bl_participanteacessa)
    {
        $this->bl_participanteacessa = $bl_participanteacessa;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_recuperasenha
     */
    public function setBlRecuperasenha($bl_recuperasenha)
    {
        $this->bl_recuperasenha = $bl_recuperasenha;
        $this->atualizaAtributos($this);
    }


    /**
     * @param date $dt_acessousuarioinicio
     */
    public function setDtAcessousuarioinicio($dt_acessousuarioinicio)
    {
        $this->dt_acessousuarioinicio = $dt_acessousuarioinicio;
        $this->atualizaAtributos($this);
    }


    /**
     * @param date $dt_acessousuariofim
     */
    public function setDtAcessousuariofim($dt_acessousuariofim)
    {
        $this->dt_acessousuariofim = $dt_acessousuariofim;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_acessoprogramado
     */
    public function setBlAcessoprogramado($bl_acessoprogramado)
    {
        $this->bl_acessoprogramado = $bl_acessoprogramado;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_messagewelcome
     */
    public function setStMessagewelcome($st_messagewelcome)
    {
        $this->st_messagewelcome = $st_messagewelcome;
        $this->atualizaAtributos($this);
    }



}