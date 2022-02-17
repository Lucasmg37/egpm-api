<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Recovery
 * @package App\Model\Entity
 * @table tb_recovery
 */
class Recovery extends BdAction
{

    /**
     * Recovery constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_recovery
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_recovery;


    /**
     * @var $st_codigo
     * @required
     */
    public $st_codigo;


    /**
     * @var $dt_geracao
     * @required
     */
    public $dt_geracao;


    /**
     * @var $id_usuario
     * @required
     * @foreign_key_table tb_usuarios
     * @foreign_key_column id_usuario
     */
    public $id_usuario;



    /**
     * @return int
     */
    public function getIdRecovery()
    {
        return $this->id_recovery;
    }


    /**
     * @return string
     */
    public function getStCodigo()
    {
        return $this->st_codigo;
    }


    /**
     * @return string
     */
    public function getDtGeracao()
    {
        return $this->dt_geracao;
    }


    /**
     * @return int|Usuarios
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }



    /**
     * @param int $id_recovery
     */
    public function setIdRecovery($id_recovery)
    {
        $this->id_recovery = $id_recovery;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_codigo
     */
    public function setStCodigo($st_codigo)
    {
        $this->st_codigo = $st_codigo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_geracao
     */
    public function setDtGeracao($dt_geracao)
    {
        $this->dt_geracao = $dt_geracao;
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



}