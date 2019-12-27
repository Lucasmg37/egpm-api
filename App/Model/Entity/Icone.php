<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Icone
 * @package App\Model\Entity
 * @table tb_icone
 */
class Icone extends BdAction
{

    /**
     * Icone constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_icone
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_icone;


    /**
     * @var $id_secao
     */
    public $id_secao;


    /**
     * @var $st_tabela
     * @required
     */
    public $st_tabela;


    /**
     * @var $st_icone
     * @required
     */
    public $st_icone;


    /**
     * @var $st_label
     */
    public $st_label;


    /**
     * @var $st_valor
     */
    public $st_valor;



    /**
     * @return int
     */
    public function getIdIcone()
    {
        return $this->id_icone;
    }


    /**
     * @return int
     */
    public function getIdSecao()
    {
        return $this->id_secao;
    }


    /**
     * @return string
     */
    public function getStTabela()
    {
        return $this->st_tabela;
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
    public function getStLabel()
    {
        return $this->st_label;
    }


    /**
     * @return string
     */
    public function getStValor()
    {
        return $this->st_valor;
    }



    /**
     * @param int $id_icone
     */
    public function setIdIcone($id_icone)
    {
        $this->id_icone = $id_icone;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_secao
     */
    public function setIdSecao($id_secao)
    {
        $this->id_secao = $id_secao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_tabela
     */
    public function setStTabela($st_tabela)
    {
        $this->st_tabela = $st_tabela;
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
     * @param string $st_label
     */
    public function setStLabel($st_label)
    {
        $this->st_label = $st_label;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_valor
     */
    public function setStValor($st_valor)
    {
        $this->st_valor = $st_valor;
        $this->atualizaAtributos($this);
    }



}