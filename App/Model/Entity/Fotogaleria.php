<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Fotogaleria
 * @package App\Model\Entity
 * @table tb_fotogaleria
 */
class Fotogaleria extends BdAction
{

    /**
     * Fotogaleria constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_fotogaleria
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_fotogaleria;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_legenda
     */
    public $st_legenda;


    /**
     * @var $bl_visivel
     * @required
     * @default 1
     */
    public $bl_visivel;


    /**
     * @var $bl_horizontal
     */
    public $bl_horizontal;


    /**
     * @var $nu_height
     */
    public $nu_height;


    /**
     * @var $nu_widht
     */
    public $nu_widht;



    /**
     * @return int
     */
    public function getIdFotogaleria()
    {
        return $this->id_fotogaleria;
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
    public function getStLegenda()
    {
        return $this->st_legenda;
    }


    /**
     * @return boolean
     */
    public function getBlVisivel()
    {
        return $this->bl_visivel;
    }


    /**
     * @return boolean
     */
    public function getBlHorizontal()
    {
        return $this->bl_horizontal;
    }


    /**
     * @return float
     */
    public function getNuHeight()
    {
        return $this->nu_height;
    }


    /**
     * @return float
     */
    public function getNuWidht()
    {
        return $this->nu_widht;
    }



    /**
     * @param int $id_fotogaleria
     */
    public function setIdFotogaleria($id_fotogaleria)
    {
        $this->id_fotogaleria = $id_fotogaleria;
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
     * @param string $st_legenda
     */
    public function setStLegenda($st_legenda)
    {
        $this->st_legenda = $st_legenda;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_visivel
     */
    public function setBlVisivel($bl_visivel)
    {
        $this->bl_visivel = $bl_visivel;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_horizontal
     */
    public function setBlHorizontal($bl_horizontal)
    {
        $this->bl_horizontal = $bl_horizontal;
        $this->atualizaAtributos($this);
    }


    /**
     * @param float $nu_height
     */
    public function setNuHeight($nu_height)
    {
        $this->nu_height = $nu_height;
        $this->atualizaAtributos($this);
    }


    /**
     * @param float $nu_widht
     */
    public function setNuWidht($nu_widht)
    {
        $this->nu_widht = $nu_widht;
        $this->atualizaAtributos($this);
    }



}