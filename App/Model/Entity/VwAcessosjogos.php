<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class VwAcessosjogos
 * @package App\Model\Entity
 * @table vw_acessosjogos
 */
class VwAcessosjogos extends BdAction
{

    /**
     * VwAcessosjogos constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $vw_primary_id_jogo
     * @required
     * @default 0
     */
    public $vw_primary_id_jogo;


    /**
     * @var $id_jogo
     * @required
     * @default 0
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
     * @var $st_regra
     */
    public $st_regra;


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
     */
    public $nu_quantidadejogadores;


    /**
     * @var $nu_acessos
     * @required
     * @default 0
     */
    public $nu_acessos;



    /**
     * @return int
     */
    public function getVwPrimaryIdJogo()
    {
        return $this->vw_primary_id_jogo;
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
    public function getStNome()
    {
        return $this->st_nome;
    }


    /**
     * @return string
     */
    public function getStDescricao()
    {
        return $this->st_descricao;
    }


    /**
     * @return string
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
     * @return string
     */
    public function getStVideo()
    {
        return $this->st_video;
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
     * @return string
     */
    public function getStRegra()
    {
        return $this->st_regra;
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
    public function getNuAcessos()
    {
        return $this->nu_acessos;
    }



    /**
     * @param int $vw_primary_id_jogo
     */
    public function setVwPrimaryIdJogo($vw_primary_id_jogo)
    {
        $this->vw_primary_id_jogo = $vw_primary_id_jogo;
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
     * @param string $st_nome
     */
    public function setStNome($st_nome)
    {
        $this->st_nome = $st_nome;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $st_descricao
     */
    public function setStDescricao($st_descricao)
    {
        $this->st_descricao = $st_descricao;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $dt_lancamento
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
     * @param string $st_video
     */
    public function setStVideo($st_video)
    {
        $this->st_video = $st_video;
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
     * @param string $st_regra
     */
    public function setStRegra($st_regra)
    {
        $this->st_regra = $st_regra;
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
     * @param int $nu_acessos
     */
    public function setNuAcessos($nu_acessos)
    {
        $this->nu_acessos = $nu_acessos;
        $this->atualizaAtributos($this);
    }



}