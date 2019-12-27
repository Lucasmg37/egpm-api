<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Jogo
 * @package App\Model\Entity
 * @table tb_jogo
 */
class Jogo extends BdAction
{

    /**
     * Jogo constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id_jogo
     * @primary_key
     * @required
     * @auto_increment
     */
    public $id_jogo;


    /**
     * @var $st_nome
     * @required
     */
    public $st_nome;


    /**
     * @var $st_descricao
     * @required
     */
    public $st_descricao;


    /**
     * @var $dt_lancamento
     */
    public $dt_lancamento;


    /**
     * @var $st_estilo
     */
    public $st_estilo;


    /**
     * @var $st_video
     */
    public $st_video;


    /**
     * @var $st_imagem
     */
    public $st_imagem;


    /**
     * @var $st_ingresso
     */
    public $st_ingresso;


    /**
     * @var $nu_vaga
     */
    public $nu_vaga;


    /**
     * @var $st_plataforma
     */
    public $st_plataforma;


    /**
     * @var $dt_jogo
     */
    public $dt_jogo;


    /**
     * @var $hr_jogo
     */
    public $hr_jogo;


    /**
     * @var $st_regra
     */
    public $st_regra;


    /**
     * @var $st_observacao
     */
    public $st_observacao;


    /**
     * @var $bl_campeonato
     * @default 0
     */
    public $bl_campeonato;


    /**
     * @var $st_classificacaoindicativa
     */
    public $st_classificacaoindicativa;


    /**
     * @var $st_plataformacampeonato
     */
    public $st_plataformacampeonato;


    /**
     * @var $nu_quantidadejogadores
     * @required
     */
    public $nu_quantidadejogadores;


    /**
     * @var $id_imagem
     */
    public $id_imagem;



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
    public function getStNome()
    {
        return $this->st_nome;
    }


    /**
     * @return text
     */
    public function getStDescricao()
    {
        return $this->st_descricao;
    }


    /**
     * @return date
     */
    public function getDtLancamento()
    {
        return $this->dt_lancamento;
    }


    /**
     * @return string
     */
    public function getStEstilo()
    {
        return $this->st_estilo;
    }


    /**
     * @return text
     */
    public function getStVideo()
    {
        return $this->st_video;
    }


    /**
     * @return string
     */
    public function getStImagem()
    {
        return $this->st_imagem;
    }


    /**
     * @return string
     */
    public function getStIngresso()
    {
        return $this->st_ingresso;
    }


    /**
     * @return int
     */
    public function getNuVaga()
    {
        return $this->nu_vaga;
    }


    /**
     * @return string
     */
    public function getStPlataforma()
    {
        return $this->st_plataforma;
    }


    /**
     * @return date
     */
    public function getDtJogo()
    {
        return $this->dt_jogo;
    }


    /**
     * @return string
     */
    public function getHrJogo()
    {
        return $this->hr_jogo;
    }


    /**
     * @return text
     */
    public function getStRegra()
    {
        return $this->st_regra;
    }


    /**
     * @return text
     */
    public function getStObservacao()
    {
        return $this->st_observacao;
    }


    /**
     * @return boolean
     */
    public function getBlCampeonato()
    {
        return $this->bl_campeonato;
    }


    /**
     * @return string
     */
    public function getStClassificacaoindicativa()
    {
        return $this->st_classificacaoindicativa;
    }


    /**
     * @return string
     */
    public function getStPlataformacampeonato()
    {
        return $this->st_plataformacampeonato;
    }


    /**
     * @return int
     */
    public function getNuQuantidadejogadores()
    {
        return $this->nu_quantidadejogadores;
    }


    /**
     * @return int
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
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
     * @param string $st_nome
     */
    public function setStNome($st_nome)
    {
        $this->st_nome = $st_nome;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_descricao
     */
    public function setStDescricao($st_descricao)
    {
        $this->st_descricao = $st_descricao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param date $dt_lancamento
     */
    public function setDtLancamento($dt_lancamento)
    {
        $this->dt_lancamento = $dt_lancamento;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_estilo
     */
    public function setStEstilo($st_estilo)
    {
        $this->st_estilo = $st_estilo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_video
     */
    public function setStVideo($st_video)
    {
        $this->st_video = $st_video;
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
     * @param string $st_ingresso
     */
    public function setStIngresso($st_ingresso)
    {
        $this->st_ingresso = $st_ingresso;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $nu_vaga
     */
    public function setNuVaga($nu_vaga)
    {
        $this->nu_vaga = $nu_vaga;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_plataforma
     */
    public function setStPlataforma($st_plataforma)
    {
        $this->st_plataforma = $st_plataforma;
        $this->atualizaAtributos($this);
    }


    /**
     * @param date $dt_jogo
     */
    public function setDtJogo($dt_jogo)
    {
        $this->dt_jogo = $dt_jogo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $hr_jogo
     */
    public function setHrJogo($hr_jogo)
    {
        $this->hr_jogo = $hr_jogo;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_regra
     */
    public function setStRegra($st_regra)
    {
        $this->st_regra = $st_regra;
        $this->atualizaAtributos($this);
    }


    /**
     * @param text $st_observacao
     */
    public function setStObservacao($st_observacao)
    {
        $this->st_observacao = $st_observacao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $bl_campeonato
     */
    public function setBlCampeonato($bl_campeonato)
    {
        $this->bl_campeonato = $bl_campeonato;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_classificacaoindicativa
     */
    public function setStClassificacaoindicativa($st_classificacaoindicativa)
    {
        $this->st_classificacaoindicativa = $st_classificacaoindicativa;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_plataformacampeonato
     */
    public function setStPlataformacampeonato($st_plataformacampeonato)
    {
        $this->st_plataformacampeonato = $st_plataformacampeonato;
        $this->atualizaAtributos($this);
    }


    /**
     * @param int $nu_quantidadejogadores
     */
    public function setNuQuantidadejogadores($nu_quantidadejogadores)
    {
        $this->nu_quantidadejogadores = $nu_quantidadejogadores;
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