<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class VwNotificacao
 * @package App\Model\Entity
 * @table vw_notificacao
 */
class VwNotificacao extends BdAction
{

    /**
     * VwNotificacao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $vw_primary_id_notificacaousuario
     * @required
     * @default 0
     */
    public $vw_primary_id_notificacaousuario;


    /**
     * @var $id_notificacaousuario
     * @required
     * @default 0
     */
    public $id_notificacaousuario;


    /**
     * @var $st_titulo
     * @required
     */
    public $st_titulo;


    /**
     * @var $st_descricao
     * @required
     */
    public $st_descricao;


    /**
     * @var $dt_vizualizado
     */
    public $dt_vizualizado;


    /**
     * @var $dt_notificacao
     * @required
     */
    public $dt_notificacao;


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
     * @return int
     */
    public function getVwPrimaryIdNotificacaousuario()
    {
        return $this->vw_primary_id_notificacaousuario;
    }


    /**
     * @return int
     */
    public function getIdNotificacaousuario()
    {
        return $this->id_notificacaousuario;
    }


    /**
     * @return string
     */
    public function getStTitulo()
    {
        return $this->st_titulo;
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
    public function getDtVizualizado()
    {
        return $this->dt_vizualizado;
    }


    /**
     * @return string
     */
    public function getDtNotificacao()
    {
        return $this->dt_notificacao;
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
     * @param int $vw_primary_id_notificacaousuario
     */
    public function setVwPrimaryIdNotificacaousuario($vw_primary_id_notificacaousuario)
    {
        $this->vw_primary_id_notificacaousuario = $vw_primary_id_notificacaousuario;
        $this->atualizaAtributos($this);
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
     * @param string $st_titulo
     */
    public function setStTitulo($st_titulo)
    {
        $this->st_titulo = $st_titulo;
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
     * @param string $dt_vizualizado
     */
    public function setDtVizualizado($dt_vizualizado)
    {
        $this->dt_vizualizado = $dt_vizualizado;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_notificacao
     */
    public function setDtNotificacao($dt_notificacao)
    {
        $this->dt_notificacao = $dt_notificacao;
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



}