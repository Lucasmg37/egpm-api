<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Agenda
 * @package App\Model\Entity
 * @table tb_agenda
 */
class Agenda extends BdAction
{

    /**
     * Agenda constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_agenda
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_agenda;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_descricao
     */
    public $st_descricao;


    /**
     * @var $st_local
     */
    public $st_local;


    /**
     * @var $dt_data
     * @required
     */
    public $dt_data;


    /**
     * @var $nu_horario
     * @required
     */
    public $nu_horario;


    /**
     * @var $st_observacao
     */
    public $st_observacao;


    /**
     * @var $bl_ativo
     * @required
     * @default 1
     */
    public $bl_ativo;


    /**
     * @var $bl_jogo
     * @required
     * @default 0
     */
    public $bl_jogo;


    /**
     * @var $id_jogo
     */
    public $id_jogo;



    /**
     * @return int
     */
    public function getIdAgenda()
    {
        return $this->id_agenda;
    }


    /**
     * @return string
     */
    public function getStNome()
    {
        return $this->st_nome;
    }


    /**
     * @return string
     */
    public function getStDescricao()
    {
        return $this->st_descricao;
    }


    /**
     * @return string
     */
    public function getStLocal()
    {
        return $this->st_local;
    }


    /**
     * @return string
     */
    public function getDtData()
    {
        return $this->dt_data;
    }


    /**
     * @return string
     */
    public function getNuHorario()
    {
        return $this->nu_horario;
    }


    /**
     * @return string
     */
    public function getStObservacao()
    {
        return $this->st_observacao;
    }


    /**
     * @return boolean
     */
    public function getBlAtivo()
    {
        return $this->bl_ativo;
    }


    /**
     * @return boolean
     */
    public function getBlJogo()
    {
        return $this->bl_jogo;
    }


    /**
     * @return int
     */
    public function getIdJogo()
    {
        return $this->id_jogo;
    }



    /**
     * @param int $id_agenda
     */
    public function setIdAgenda($id_agenda)
    {
        $this->id_agenda = $id_agenda;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_nome
     */
    public function setStNome($st_nome)
    {
        $this->st_nome = $st_nome;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_descricao
     */
    public function setStDescricao($st_descricao)
    {
        $this->st_descricao = $st_descricao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_local
     */
    public function setStLocal($st_local)
    {
        $this->st_local = $st_local;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_data
     */
    public function setDtData($dt_data)
    {
        $this->dt_data = $dt_data;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $nu_horario
     */
    public function setNuHorario($nu_horario)
    {
        $this->nu_horario = $nu_horario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_observacao
     */
    public function setStObservacao($st_observacao)
    {
        $this->st_observacao = $st_observacao;
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


    /**
     * @param boolean $bl_jogo
     */
    public function setBlJogo($bl_jogo)
    {
        $this->bl_jogo = $bl_jogo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_jogo
     */
    public function setIdJogo($id_jogo)
    {
        $this->id_jogo = $id_jogo;
        $this->atualizaAtributos($this);
    }



}