<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Secao
 * @package App\Model\Entity
 * @table tb_secao
 */
class Secao extends BdAction
{

    /**
     * Secao constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_secao
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_secao;


    /**
     * @var $st_titulo
     * @required
     */
    public $st_titulo;


    /**
     * @var $st_texto
     * @required
     */
    public $st_texto;


    /**
     * @var $st_rota
     * @required
     */
    public $st_rota;


    /**
     * @var $st_video
     */
    public $st_video;


    /**
     * @var $bl_hasvideo
     * @required
     * @default 0
     */
    public $bl_hasvideo;


    /**
     * @var $bl_hasimagem
     * @required
     * @default 0
     */
    public $bl_hasimagem;


    /**
     * @var $bl_hasicone
     * @required
     * @default 0
     */
    public $bl_hasicone;



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
    public function getStTitulo()
    {
        return $this->st_titulo;
    }


    /**
     * @return string
     */
    public function getStTexto()
    {
        return $this->st_texto;
    }


    /**
     * @return string
     */
    public function getStRota()
    {
        return $this->st_rota;
    }


    /**
     * @return string
     */
    public function getStVideo()
    {
        return $this->st_video;
    }


    /**
     * @return int
     */
    public function getBlHasvideo()
    {
        return $this->bl_hasvideo;
    }


    /**
     * @return int
     */
    public function getBlHasimagem()
    {
        return $this->bl_hasimagem;
    }


    /**
     * @return boolean
     */
    public function getBlHasicone()
    {
        return $this->bl_hasicone;
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
     * @param string $st_titulo
     */
    public function setStTitulo($st_titulo)
    {
        $this->st_titulo = $st_titulo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_texto
     */
    public function setStTexto($st_texto)
    {
        $this->st_texto = $st_texto;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_rota
     */
    public function setStRota($st_rota)
    {
        $this->st_rota = $st_rota;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_video
     */
    public function setStVideo($st_video)
    {
        $this->st_video = $st_video;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $bl_hasvideo
     */
    public function setBlHasvideo($bl_hasvideo)
    {
        $this->bl_hasvideo = $bl_hasvideo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $bl_hasimagem
     */
    public function setBlHasimagem($bl_hasimagem)
    {
        $this->bl_hasimagem = $bl_hasimagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_hasicone
     */
    public function setBlHasicone($bl_hasicone)
    {
        $this->bl_hasicone = $bl_hasicone;
        $this->atualizaAtributos($this);
    }



}