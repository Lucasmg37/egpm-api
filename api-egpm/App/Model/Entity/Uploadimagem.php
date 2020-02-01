<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Uploadimagem
 * @package App\Model\Entity
 * @table tb_uploadimagem
 */
class Uploadimagem extends BdAction
{

    /**
     * Uploadimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_uploadimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_uploadimagem;


    /**
     * @var $id_imagem
     * @required
     * @foreign_key_table tb_imagem
     * @foreign_key_column id_imagem
     */
    public $id_imagem;


    /**
     * @var $st_alt
     */
    public $st_alt;


    /**
     * @var $dt_criacao
     * @required
     * @default current_timestamp()
     */
    public $dt_criacao;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;



    /**
     * @return int
     */
    public function getIdUploadimagem()
    {
        return $this->id_uploadimagem;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
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
    public function getDtCriacao()
    {
        return $this->dt_criacao;
    }


    /**
     * @return string
     */
    public function getStNome()
    {
        return $this->st_nome;
    }



    /**
     * @param int $id_uploadimagem
     */
    public function setIdUploadimagem($id_uploadimagem)
    {
        $this->id_uploadimagem = $id_uploadimagem;
        $this->atualizaAtributos($this);
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
     * @param string $st_alt
     */
    public function setStAlt($st_alt)
    {
        $this->st_alt = $st_alt;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_criacao
     */
    public function setDtCriacao($dt_criacao)
    {
        $this->dt_criacao = $dt_criacao;
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



}