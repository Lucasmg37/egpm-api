<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Botao
 * @package App\Model\Entity
 * @table tb_botao
 */
class Botao extends BdAction
{

    /**
     * Botao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_botao
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_botao;


    /**
     * @var $st_texto
     * @required
     */
    public $st_texto;


    /**
     * @var $st_icone
     * @required
     */
    public $st_icone;


    /**
     * @var $st_cor
     * @required
     */
    public $st_cor;


    /**
     * @var $st_link
     * @required
     */
    public $st_link;


    /**
     * @var $bl_ativo
     * @required
     */
    public $bl_ativo;



    /**
     * @return int
     */
    public function getIdBotao()
    {
        return $this->id_botao;
    }


    /**
     * @return string
     */
    public function getStTexto()
    {
        return $this->st_texto;
    }


    /**
     * @return string
     */
    public function getStIcone()
    {
        return $this->st_icone;
    }


    /**
     * @return string
     */
    public function getStCor()
    {
        return $this->st_cor;
    }


    /**
     * @return string
     */
    public function getStLink()
    {
        return $this->st_link;
    }


    /**
     * @return boolean
     */
    public function getBlAtivo()
    {
        return $this->bl_ativo;
    }



    /**
     * @param int $id_botao
     */
    public function setIdBotao($id_botao)
    {
        $this->id_botao = $id_botao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_texto
     */
    public function setStTexto($st_texto)
    {
        $this->st_texto = $st_texto;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_icone
     */
    public function setStIcone($st_icone)
    {
        $this->st_icone = $st_icone;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_cor
     */
    public function setStCor($st_cor)
    {
        $this->st_cor = $st_cor;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_link
     */
    public function setStLink($st_link)
    {
        $this->st_link = $st_link;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_ativo
     */
    public function setBlAtivo($bl_ativo)
    {
        $this->bl_ativo = $bl_ativo;
        $this->atualizaAtributos($this);
    }



}