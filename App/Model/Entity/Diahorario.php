<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Diahorario
 * @package App\Model\Entity
 * @table tb_diahorario
 */
class Diahorario extends BdAction
{

    /**
     * Diahorario constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_diahorario
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_diahorario;


    /**
     * @var $st_diahorario
     * @required
     */
    public $st_diahorario;



    /**
     * @return int
     */
    public function getIdDiahorario()
    {
        return $this->id_diahorario;
    }


    /**
     * @return string
     */
    public function getStDiahorario()
    {
        return $this->st_diahorario;
    }



    /**
     * @param int $id_diahorario
     */
    public function setIdDiahorario($id_diahorario)
    {
        $this->id_diahorario = $id_diahorario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_diahorario
     */
    public function setStDiahorario($st_diahorario)
    {
        $this->st_diahorario = $st_diahorario;
        $this->atualizaAtributos($this);
    }



}