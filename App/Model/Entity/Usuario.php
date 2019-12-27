<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Usuario
 * @package App\Model\Entity
 * @table tb_usuario
 */
class Usuario extends BdAction
{

    /**
     * Usuario constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_usuario
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_usuario;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_email
     * @required
     */
    public $st_email;


    /**
     * @var $st_senha
     * @required
     */
    public $st_senha;


    /**
     * @var $bl_ativo
     * @required
     * @default 0
     */
    public $bl_ativo;


    /**
     * @var $dt_criacao
     * @required
     * @default current_timestamp()
     */
    public $dt_criacao;


    /**
     * @var $id_entidade
     * @required
     * @foreign_key_table tb_entidade
     * @foreign_key_column id_entidade
     */
    public $id_entidade;



    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
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
    public function getStEmail()
    {
        return $this->st_email;
    }


    /**
     * @return string
     */
    public function getStSenha()
    {
        return $this->st_senha;
    }


    /**
     * @return boolean
     */
    public function getBlAtivo()
    {
        return $this->bl_ativo;
    }


    /**
     * @return string
     */
    public function getDtCriacao()
    {
        return $this->dt_criacao;
    }


    /**
     * @return int|Entidade
     */
    public function getIdEntidade()
    {
        return $this->id_entidade;
    }



    /**
     * @param int $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
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
     * @param string $st_email
     */
    public function setStEmail($st_email)
    {
        $this->st_email = $st_email;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_senha
     */
    public function setStSenha($st_senha)
    {
        $this->st_senha = $st_senha;
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
     * @param string $dt_criacao
     */
    public function setDtCriacao($dt_criacao)
    {
        $this->dt_criacao = $dt_criacao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_entidade
     */
    public function setIdEntidade($id_entidade)
    {
        $this->id_entidade = $id_entidade;
        $this->atualizaAtributos($this);
    }



}