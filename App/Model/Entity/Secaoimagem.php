<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Secaoimagem
 * @package App\Model\Entity
 * @table tb_secaoimagem
 */
class Secaoimagem extends BdAction
{

    /**
     * Secaoimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_secaoimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_secaoimagem;


    /**
     * @var $id_secao
     * @required
     * @foreign_key_table tb_secao
     * @foreign_key_column id_secao
     */
    public $id_secao;


    /**
     * @var $id_imagem
     * @required
     * @foreign_key_table tb_imagem
     * @foreign_key_column id_imagem
     */
    public $id_imagem;



    /**
     * @return int
     */
    public function getIdSecaoimagem()
    {
        return $this->id_secaoimagem;
    }


    /**
     * @return int|Secao
     */
    public function getIdSecao()
    {
        return $this->id_secao;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }



    /**
     * @param int $id_secaoimagem
     */
    public function setIdSecaoimagem($id_secaoimagem)
    {
        $this->id_secaoimagem = $id_secaoimagem;
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
     * @param int $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
        $this->atualizaAtributos($this);
    }



}