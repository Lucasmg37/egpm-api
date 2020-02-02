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
     * @foreign_key_table tb_secao
     * @foreign_key_column id_secao
     */
    public $id_secao;


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
     * @required
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
     * @return int|Secao
     */
    public function getIdSecao()
    {
        return $this->id_secao;
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