<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Apoio
 * @package App\Model\Entity
 * @table tb_apoio
 */
class Apoio extends BdAction
{

    /**
     * Apoio constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_apoio
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_apoio;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_empresa
     * @required
     */
    public $st_empresa;


    /**
     * @var $st_email
     * @required
     */
    public $st_email;


    /**
     * @var $st_telefone
     * @required
     */
    public $st_telefone;


    /**
     * @var $bl_analisado
     * @default 0
     */
    public $bl_analisado;


    /**
     * @var $bl_ativo
     * @required
     * @default 1
     */
    public $bl_ativo;



    /**
     * @return int
     */
    public function getIdApoio()
    {
        return $this->id_apoio;
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
    public function getStEmpresa()
    {
        return $this->st_empresa;
    }


    /**
     * @return string
     */
    public function getStEmail()
    {
        return $this->st_email;
    }


    /**
     * @return string
     */
    public function getStTelefone()
    {
        return $this->st_telefone;
    }


    /**
     * @return boolean
     */
    public function getBlAnalisado()
    {
        return $this->bl_analisado;
    }


    /**
     * @return boolean
     */
    public function getBlAtivo()
    {
        return $this->bl_ativo;
    }



    /**
     * @param int $id_apoio
     */
    public function setIdApoio($id_apoio)
    {
        $this->id_apoio = $id_apoio;
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
     * @param string $st_empresa
     */
    public function setStEmpresa($st_empresa)
    {
        $this->st_empresa = $st_empresa;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_email
     */
    public function setStEmail($st_email)
    {
        $this->st_email = $st_email;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_telefone
     */
    public function setStTelefone($st_telefone)
    {
        $this->st_telefone = $st_telefone;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_analisado
     */
    public function setBlAnalisado($bl_analisado)
    {
        $this->bl_analisado = $bl_analisado;
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