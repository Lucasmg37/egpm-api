<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Datahorariocampeonato
 * @package App\Model\Entity
 * @table tb_datahorariocampeonato
 */
class Datahorariocampeonato extends BdAction
{

    /**
     * Datahorariocampeonato constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_datahorariocampeonato
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_datahorariocampeonato;


    /**
     * @var $id_jogo
     * @required
     */
    public $id_jogo;


    /**
     * @var $st_diasemana
     * @required
     */
    public $st_diasemana;


    /**
     * @var $st_hora
     * @required
     */
    public $st_hora;



    /**
     * @return int
     */
    public function getIdDatahorariocampeonato()
    {
        return $this->id_datahorariocampeonato;
    }


    /**
     * @return int
     */
    public function getIdJogo()
    {
        return $this->id_jogo;
    }


    /**
     * @return string
     */
    public function getStDiasemana()
    {
        return $this->st_diasemana;
    }


    /**
     * @return string
     */
    public function getStHora()
    {
        return $this->st_hora;
    }



    /**
     * @param int $id_datahorariocampeonato
     */
    public function setIdDatahorariocampeonato($id_datahorariocampeonato)
    {
        $this->id_datahorariocampeonato = $id_datahorariocampeonato;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_jogo
     */
    public function setIdJogo($id_jogo)
    {
        $this->id_jogo = $id_jogo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_diasemana
     */
    public function setStDiasemana($st_diasemana)
    {
        $this->st_diasemana = $st_diasemana;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_hora
     */
    public function setStHora($st_hora)
    {
        $this->st_hora = $st_hora;
        $this->atualizaAtributos($this);
    }



}