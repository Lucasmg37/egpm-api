<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Tipousuario
 * @package App\Model\Entity
 * @table tb_tipousuario
 */
class Tipousuario extends BdAction
{

    /**
     * Tipousuario constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_tipousuario
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_tipousuario;


    /**
     * @var $st_tipousuario
     * @required
     */
    public $st_tipousuario;



    /**
     * @return int
     */
    public function getIdTipousuario()
    {
        return $this->id_tipousuario;
    }


    /**
     * @return string
     */
    public function getStTipousuario()
    {
        return $this->st_tipousuario;
    }



    /**
     * @param int $id_tipousuario
     */
    public function setIdTipousuario($id_tipousuario)
    {
        $this->id_tipousuario = $id_tipousuario;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_tipousuario
     */
    public function setStTipousuario($st_tipousuario)
    {
        $this->st_tipousuario = $st_tipousuario;
        $this->atualizaAtributos($this);
    }



}