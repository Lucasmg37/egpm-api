<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Social
 * @package App\Model\Entity
 * @table tb_social
 */
class Social extends BdAction
{

    /**
     * Social constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_social
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_social;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_link
     * @required
     */
    public $st_link;


    /**
     * @var $st_icone
     */
    public $st_icone;


    /**
     * @var $st_cor
     */
    public $st_cor;



    /**
     * @return int
     */
    public function getIdSocial()
    {
        return $this->id_social;
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
    public function getStLink()
    {
        return $this->st_link;
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
     * @param int $id_social
     */
    public function setIdSocial($id_social)
    {
        $this->id_social = $id_social;
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
     * @param string $st_link
     */
    public function setStLink($st_link)
    {
        $this->st_link = $st_link;
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



}