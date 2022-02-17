<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Integracaosympla
 * @package App\Model\Entity
 * @table tb_integracaosympla
 */
class Integracaosympla extends BdAction
{

    /**
     * Integracaosympla constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_integracaosympla
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_integracaosympla;


    /**
     * @var $st_chave
     * @required
     */
    public $st_chave;


    /**
     * @var $id_evento
     * @required
     */
    public $id_evento;


    /**
     * @var $bl_sincronizariniciar
     * @required
     * @default 1
     */
    public $bl_sincronizariniciar;



    /**
     * @return int
     */
    public function getIdIntegracaosympla()
    {
        return $this->id_integracaosympla;
    }


    /**
     * @return string
     */
    public function getStChave()
    {
        return $this->st_chave;
    }


    /**
     * @return int
     */
    public function getIdEvento()
    {
        return $this->id_evento;
    }


    /**
     * @return boolean
     */
    public function getBlSincronizariniciar()
    {
        return $this->bl_sincronizariniciar;
    }



    /**
     * @param int $id_integracaosympla
     */
    public function setIdIntegracaosympla($id_integracaosympla)
    {
        $this->id_integracaosympla = $id_integracaosympla;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_chave
     */
    public function setStChave($st_chave)
    {
        $this->st_chave = $st_chave;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_evento
     */
    public function setIdEvento($id_evento)
    {
        $this->id_evento = $id_evento;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_sincronizariniciar
     */
    public function setBlSincronizariniciar($bl_sincronizariniciar)
    {
        $this->bl_sincronizariniciar = $bl_sincronizariniciar;
        $this->atualizaAtributos($this);
    }



}