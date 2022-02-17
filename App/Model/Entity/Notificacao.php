<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Notificacao
 * @package App\Model\Entity
 * @table tb_notificacao
 */
class Notificacao extends BdAction
{

    /**
     * Notificacao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_notificacao
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_notificacao;


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
     * @var $dt_notificacao
     * @required
     */
    public $dt_notificacao;



    /**
     * @return int
     */
    public function getIdNotificacao()
    {
        return $this->id_notificacao;
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
    public function getDtNotificacao()
    {
        return $this->dt_notificacao;
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
     * @param string $dt_notificacao
     */
    public function setDtNotificacao($dt_notificacao)
    {
        $this->dt_notificacao = $dt_notificacao;
        $this->atualizaAtributos($this);
    }



}