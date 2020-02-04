<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class VwUsuarioimagem
 * @package App\Model\Entity
 * @table vw_usuarioimagem
 */
class VwUsuarioimagem extends BdAction
{

    /**
     * VwUsuarioimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $vw_primary_id_usuario
     * @required
     * @default 0
     */
    public $vw_primary_id_usuario;


    /**
     * @var $id_usuario
     * @required
     * @default 0
     */
    public $id_usuario;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_login
     * @required
     */
    public $st_login;


    /**
     * @var $st_email
     * @required
     */
    public $st_email;


    /**
     * @var $id_imagem
     * @default 0
     */
    public $id_imagem;


    /**
     * @var $st_nomeimagem
     */
    public $st_nomeimagem;


    /**
     * @var $st_url
     */
    public $st_url;


    /**
     * @var $st_alt
     */
    public $st_alt;


    /**
     * @var $id_tipousuario
     * @required
     * @default 2
     */
    public $id_tipousuario;


    /**
     * @var $st_prefixotamanho
     * @default ori
     */
    public $st_prefixotamanho;



    /**
     * @return int
     */
    public function getVwPrimaryIdUsuario()
    {
        return $this->vw_primary_id_usuario;
    }


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
    public function getStLogin()
    {
        return $this->st_login;
    }


    /**
     * @return string
     */
    public function getStEmail()
    {
        return $this->st_email;
    }


    /**
     * @return int
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }


    /**
     * @return string
     */
    public function getStNomeimagem()
    {
        return $this->st_nomeimagem;
    }


    /**
     * @return string
     */
    public function getStUrl()
    {
        return $this->st_url;
    }


    /**
     * @return string
     */
    public function getStAlt()
    {
        return $this->st_alt;
    }


    /**
     * @return int
     */
    public function getIdTipousuario()
    {
        return $this->id_tipousuario;
    }


    /**
     * @return string
     */
    public function getStPrefixotamanho()
    {
        return $this->st_prefixotamanho;
    }



    /**
     * @param int $vw_primary_id_usuario
     */
    public function setVwPrimaryIdUsuario($vw_primary_id_usuario)
    {
        $this->vw_primary_id_usuario = $vw_primary_id_usuario;
        $this->atualizaAtributos($this);
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
     * @param string $st_login
     */
    public function setStLogin($st_login)
    {
        $this->st_login = $st_login;
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
     * @param int $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_nomeimagem
     */
    public function setStNomeimagem($st_nomeimagem)
    {
        $this->st_nomeimagem = $st_nomeimagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_url
     */
    public function setStUrl($st_url)
    {
        $this->st_url = $st_url;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_alt
     */
    public function setStAlt($st_alt)
    {
        $this->st_alt = $st_alt;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_tipousuario
     */
    public function setIdTipousuario($id_tipousuario)
    {
        $this->id_tipousuario = $id_tipousuario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_prefixotamanho
     */
    public function setStPrefixotamanho($st_prefixotamanho)
    {
        $this->st_prefixotamanho = $st_prefixotamanho;
        $this->atualizaAtributos($this);
    }



}