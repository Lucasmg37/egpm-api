<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Localizacao
 * @package App\Model\Entity
 * @table tb_localizacao
 */
class Localizacao extends BdAction
{

    /**
     * Localizacao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_localizacao
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_localizacao;


    /**
     * @var $st_local
     * @required
     */
    public $st_local;


    /**
     * @var $st_cep
     * @required
     */
    public $st_cep;


    /**
     * @var $st_endereco
     * @required
     */
    public $st_endereco;


    /**
     * @var $st_mapa
     */
    public $st_mapa;



    /**
     * @return int
     */
    public function getIdLocalizacao()
    {
        return $this->id_localizacao;
    }


    /**
     * @return string
     */
    public function getStLocal()
    {
        return $this->st_local;
    }


    /**
     * @return string
     */
    public function getStCep()
    {
        return $this->st_cep;
    }


    /**
     * @return string
     */
    public function getStEndereco()
    {
        return $this->st_endereco;
    }


    /**
     * @return string
     */
    public function getStMapa()
    {
        return $this->st_mapa;
    }



    /**
     * @param int $id_localizacao
     */
    public function setIdLocalizacao($id_localizacao)
    {
        $this->id_localizacao = $id_localizacao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_local
     */
    public function setStLocal($st_local)
    {
        $this->st_local = $st_local;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_cep
     */
    public function setStCep($st_cep)
    {
        $this->st_cep = $st_cep;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_endereco
     */
    public function setStEndereco($st_endereco)
    {
        $this->st_endereco = $st_endereco;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_mapa
     */
    public function setStMapa($st_mapa)
    {
        $this->st_mapa = $st_mapa;
        $this->atualizaAtributos($this);
    }



}