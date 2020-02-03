<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Usuarios
 * @package App\Model\Entity
 * @table tb_usuarios
 */
class Usuarios extends BdAction
{

    /**
     * Usuarios constructor.
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
     * @var $st_senha
     * @required
     */
    public $st_senha;


    /**
     * @var $id_imagem
     * @foreign_key_table tb_imagem
     * @foreign_key_column id_imagem
     */
    public $id_imagem;


    /**
     * @var $id_tipousuario
     * @required
     * @default 2
     */
    public $id_tipousuario;



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
     * @return string
     */
    public function getStSenha()
    {
        return $this->st_senha;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }


    /**
     * @return int
     */
    public function getIdTipousuario()
    {
        return $this->id_tipousuario;
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
     * @param string $st_senha
     */
    public function setStSenha($st_senha)
    {
        $this->st_senha = $st_senha;
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
     * @param int $id_tipousuario
     */
    public function setIdTipousuario($id_tipousuario)
    {
        $this->id_tipousuario = $id_tipousuario;
        $this->atualizaAtributos($this);
    }



}