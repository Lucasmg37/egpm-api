<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Jogoimagem
 * @package App\Model\Entity
 * @table tb_jogoimagem
 */
class Jogoimagem extends BdAction
{

    /**
     * Jogoimagem constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_jogoimagem
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_jogoimagem;


    /**
     * @var $id_jogo
     * @required
     * @foreign_key_table tb_jogo
     * @foreign_key_column id_jogo
     */
    public $id_jogo;


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
    public function getIdJogoimagem()
    {
        return $this->id_jogoimagem;
    }


    /**
     * @return int|Jogo
     */
    public function getIdJogo()
    {
        return $this->id_jogo;
    }


    /**
     * @return int|Imagem
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }



    /**
     * @param int $id_jogoimagem
     */
    public function setIdJogoimagem($id_jogoimagem)
    {
        $this->id_jogoimagem = $id_jogoimagem;
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
     * @param int $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
        $this->atualizaAtributos($this);
    }



}