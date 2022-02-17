<?php

namespace App\Model;

use App\Util\JWT;
use App\Util\Token;
use Bootstrap\Config;
use Bootstrap\Router;
use Exception;

Class Autentication extends Model
{
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

            self::aplicaRegraSessao();
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
     * @return bool
     * @throws Exception
     */
    public static function aplicaRegraSessao()
    {
        $jwt = new JWT();
        try {
            $jwt->getDataToken(Token::getTokenByAuthorizationHeader());
        } catch (Exception $exception) {
            if ($exception->getCode() === \App\Constants\Response::SESSSAO_EXPIRADA) {
                Response::failResponse("Sessão expirada!", null, 1001);
            }
            throw $exception;
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
