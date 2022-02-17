<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Log
 * @package App\Model\Entity
 * @table tb_log
 */
class Log extends BdAction
{

    /**
     * Log constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_log
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_log;


    /**
     * @var $st_rota
     * @required
     */
    public $st_rota;


    /**
     * @var $st_descricao
     * @required
     */
    public $st_descricao;


    /**
     * @var $id_usuario
     * @required
     */
    public $id_usuario;


    /**
     * @var $dt_log
     * @required
     * @default CURRENT_TIMESTAMP
     */
    public $dt_log;



    /**
     * @return int
     */
    public function getIdLog()
    {
        return $this->id_log;
    }


    /**
     * @return string
     */
    public function getStRota()
    {
        return $this->st_rota;
    }


    /**
     * @return string
     */
    public function getStDescricao()
    {
        return $this->st_descricao;
    }


    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }


    /**
     * @return timestamp
     */
    public function getDtLog()
    {
        return $this->dt_log;
    }



    /**
     * @param int $id_log
     */
    public function setIdLog($id_log)
    {
        $this->id_log = $id_log;
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
     * @param string $st_descricao
     */
    public function setStDescricao($st_descricao)
    {
        $this->st_descricao = $st_descricao;
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
     * @param timestamp $dt_log
     */
    public function setDtLog($dt_log)
    {
        $this->dt_log = $dt_log;
        $this->atualizaAtributos($this);
    }



}