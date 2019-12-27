<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Notificacaousuario
 * @package App\Model\Entity
 * @table tb_notificacaousuario
 */
class Notificacaousuario extends BdAction
{

    /**
     * Notificacaousuario constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_notificacaousuario
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_notificacaousuario;


    /**
     * @var $id_notificacao
     * @required
     */
    public $id_notificacao;


    /**
     * @var $id_usuario
     * @required
     */
    public $id_usuario;


    /**
     * @var $bl_vizualizado
     * @required
     * @default 0
     */
    public $bl_vizualizado;


    /**
     * @var $dt_vizualizado
     */
    public $dt_vizualizado;



    /**
     * @return int
     */
    public function getIdNotificacaousuario()
    {
        return $this->id_notificacaousuario;
    }


    /**
     * @return int
     */
    public function getIdNotificacao()
    {
        return $this->id_notificacao;
    }


    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }


    /**
     * @return boolean
     */
    public function getBlVizualizado()
    {
        return $this->bl_vizualizado;
    }


    /**
     * @return string
     */
    public function getDtVizualizado()
    {
        return $this->dt_vizualizado;
    }



    /**
     * @param int $id_notificacaousuario
     */
    public function setIdNotificacaousuario($id_notificacaousuario)
    {
        $this->id_notificacaousuario = $id_notificacaousuario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_notificacao
     */
    public function setIdNotificacao($id_notificacao)
    {
        $this->id_notificacao = $id_notificacao;
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
     * @param boolean $bl_vizualizado
     */
    public function setBlVizualizado($bl_vizualizado)
    {
        $this->bl_vizualizado = $bl_vizualizado;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_vizualizado
     */
    public function setDtVizualizado($dt_vizualizado)
    {
        $this->dt_vizualizado = $dt_vizualizado;
        $this->atualizaAtributos($this);
    }



}