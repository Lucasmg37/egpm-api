<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Patrocinador
 * @package App\Model\Entity
 * @table tb_patrocinador
 */
class Patrocinador extends BdAction
{

    /**
     * Patrocinador constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_patrocinador
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_patrocinador;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_website
     */
    public $st_website;


    /**
     * @var $st_email
     */
    public $st_email;


    /**
     * @var $st_imagem
     */
    public $st_imagem;


    /**
     * @var $id_tipo
     * @required
     * @default 2
     */
    public $id_tipo;



    /**
     * @return int
     */
    public function getIdPatrocinador()
    {
        return $this->id_patrocinador;
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
    public function getStWebsite()
    {
        return $this->st_website;
    }


    /**
     * @return string
     */
    public function getStEmail()
    {
        return $this->st_email;
    }


    /**
     * @return string
     */
    public function getStImagem()
    {
        return $this->st_imagem;
    }


    /**
     * @return int
     */
    public function getIdTipo()
    {
        return $this->id_tipo;
    }



    /**
     * @param int $id_patrocinador
     */
    public function setIdPatrocinador($id_patrocinador)
    {
        $this->id_patrocinador = $id_patrocinador;
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
     * @param string $st_website
     */
    public function setStWebsite($st_website)
    {
        $this->st_website = $st_website;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_email
     */
    public function setStEmail($st_email)
    {
        $this->st_email = $st_email;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_imagem
     */
    public function setStImagem($st_imagem)
    {
        $this->st_imagem = $st_imagem;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $id_tipo
     */
    public function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
        $this->atualizaAtributos($this);
    }



}