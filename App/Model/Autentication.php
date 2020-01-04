<?php

namespace App\Model;

use App\Business\Sessao;
use App\Util\Token;
use Bootstrap\Config;
use Bootstrap\Router;
use Exception;

Class Autentication extends Model
{
    /**
     * @var Sessao
     */
    private $sessao;
    private $autenticado = false;
    private $config;

    /**
     * @return mixed
     */
    public function getAutenticado()
    {
        return $this->autenticado;
    }

    /**
     * @param mixed $autenticado
     * @return $this
     */
    public function setAutenticado($autenticado)
    {
        $this->autenticado = $autenticado;
        return $this;
    }

    /**
     * Autentication constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->sessao = new Sessao();
        $this->setAutenticado($this->verificarAutenticacao());
        $this->config = new Config();
    }

    /**
     * Verifica se usuário tem sessão válida
     * @param bool $lancaErro
     * @return bool
     * @throws Exception
     */
    public function verificarAutenticacao($lancaErro = true)
    {
        try {
            $st_token = Token::getTokenByAuthorizationHeader();
            if (!$st_token) {
                throw new Exception("Token não foi encontrado!");
            }

            $this->sessao = $this->sessao->getSessaoByToken($st_token);

            self::aplicaRegraSessao($this->sessao);
            return true;

        } catch (Exception $e) {
            if ($lancaErro) {
                throw new Exception($e->getMessage());
            } else {
                return false;
            }
        }
    }

    /**
     * @param $sessao
     * @return bool
     * @throws Exception
     */
    public static function aplicaRegraSessao($sessao)
    {
        $config = new Config();

        $tempoSessao = $config->getConfig("nu_minutossessao");
        $fimsessao = strtotime($sessao->dt_sessao) + ((int)$tempoSessao * 60);
        $now = strtotime(self::nowTime());

        if ($now > $fimsessao) {
            throw new Exception("Sessão expirada!");
        }

        return true;
    }

    /**
     * Método chamado antes de realizar as ações da Controller
     * Se o seu retorno é false, a ação não será chamda resultando em um erro
     * @param $router Router
     * @return bool
     */
    public function validateController($router)
    {
        return true;
    }

}
