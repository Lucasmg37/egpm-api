<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Imagem
 * @package App\Model\Entity
 * @table tb_imagem
 */
class Imagem extends BdAction
{

    /**
     * Imagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_imagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_imagem;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_url
     * @required
     */
    public $st_url;


    /**
     * @var $st_alt
     */
    public $st_alt;


    /**
     * @var $st_prefixotamanho
     * @default ori
     */
    public $st_prefixotamanho;



    /**
     * @return int
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
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
    public function getStUrl()
    {
        return $this->st_url;
    }


    /**
     * @return string
     */
    public function getStAlt()
    {
        return $this->st_alt;
    }


    /**
     * @return string
     */
    public function getStPrefixotamanho()
    {
        return $this->st_prefixotamanho;
    }



    /**
     * @param int $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
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
     * @param string $st_url
     */
    public function setStUrl($st_url)
    {
        $this->st_url = $st_url;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_alt
     */
    public function setStAlt($st_alt)
    {
        $this->st_alt = $st_alt;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_prefixotamanho
     */
    public function setStPrefixotamanho($st_prefixotamanho)
    {
        $this->st_prefixotamanho = $st_prefixotamanho;
        $this->atualizaAtributos($this);
    }



}