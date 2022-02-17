<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Acessojogo
 * @package App\Model\Entity
 * @table tb_acessojogo
 */
class Acessojogo extends BdAction
{

    /**
     * Acessojogo constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_acessojogo
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_acessojogo;


    /**
     * @var $id_jogo
     * @required
     */
    public $id_jogo;


    /**
     * @var $dt_acessojogo
     * @required
     */
    public $dt_acessojogo;


    /**
     * @var $dt_acesso
     * @required
     */
    public $dt_acesso;



    /**
     * @return int
     */
    public function getIdAcessojogo()
    {
        return $this->id_acessojogo;
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
    public function getDtAcessojogo()
    {
        return $this->dt_acessojogo;
    }


    /**
     * @return string
     */
    public function getDtAcesso()
    {
        return $this->dt_acesso;
    }



    /**
     * @param int $id_acessojogo
     */
    public function setIdAcessojogo($id_acessojogo)
    {
        $this->id_acessojogo = $id_acessojogo;
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
     * @param string $dt_acessojogo
     */
    public function setDtAcessojogo($dt_acessojogo)
    {
        $this->dt_acessojogo = $dt_acessojogo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_acesso
     */
    public function setDtAcesso($dt_acesso)
    {
        $this->dt_acesso = $dt_acesso;
        $this->atualizaAtributos($this);
    }



}