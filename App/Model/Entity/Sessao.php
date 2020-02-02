<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Sessao
 * @package App\Model\Entity
 * @table tb_sessao
 */
class Sessao extends BdAction
{

    /**
     * Sessao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_sessao
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_sessao;


    /**
     * @var $id_usuario
     * @required
     */
    public $id_usuario;


    /**
     * @var $st_token
     * @required
     */
    public $st_token;


    /**
     * @var $dt_sessao
     * @required
     * @default current_timestamp()
     */
    public $dt_sessao;


    /**
     * @var $id_tipousuario
     * @required
     */
    public $id_tipousuario;



    /**
     * @return int
     */
    public function getIdSessao()
    {
        return $this->id_sessao;
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
    public function getStToken()
    {
        return $this->st_token;
    }


    /**
     * @return string
     */
    public function getDtSessao()
    {
        return $this->dt_sessao;
    }


    /**
     * @return int
     */
    public function getIdTipousuario()
    {
        return $this->id_tipousuario;
    }



    /**
     * @param int $id_sessao
     */
    public function setIdSessao($id_sessao)
    {
        $this->id_sessao = $id_sessao;
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
     * @param string $st_token
     */
    public function setStToken($st_token)
    {
        $this->st_token = $st_token;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_sessao
     */
    public function setDtSessao($dt_sessao)
    {
        $this->dt_sessao = $dt_sessao;
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