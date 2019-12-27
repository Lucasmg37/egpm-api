<?php

namespace App\Business;

use App\Model\Autentication;
use App\Model\Espelhos\tb_usuarioDAO;
use App\Model\Model;
use App\Model\Response;
use App\Util\HeaderTools;
use App\Util\Token;

class Usuario extends tb_usuarioDAO
{

    /**
     * Insere um novo usuário
     * @return mixed
     */
    public function insert()
    {
        $this->mount($this->request->getAllParameters());
        $this->bl_ativo = "0";
        $this->dt_criacao = self::nowTime();
        return parent::insert();
    }

    /**
     * Verifica parâmetros de login e retorna o usuário
     * @param $st_email
     * @param $st_senha
     * @return $this
     * @throws \Exception
     */
    public function login($st_email, $st_senha)
    {
        $this->st_email = $st_email;
        if (!self::exists($this->find(null, true))) {
            throw new \Exception("Usuário não encontrado!");
        }

        $this->st_senha = $st_senha;
        $retorno = $this->find(null, true);

        if (!self::exists($retorno)) {
            throw new \Exception("Senha incorreta!");
        }

        $this->mount($this->getFirstData($retorno));

        if (!$this->bl_ativo) {
            throw new \Exception("Usuário não está ativado no sistema!", 1001);
        }

        return $this;
    }

    public function logout()
    {
        $sessao = new Sessao();
        return $sessao->delete(Token::getTokenByAuthorizationHeader());
    }

    /**
     * @return Usuario
     */
    public static function getLoggedUser()
    {
        $sessao = new Sessao();
        $sessao = $sessao->getSessaoByToken();

        $usuario = new Usuario();
        $usuario->id_usuario = $sessao->id_usuario;
        $usuario->findOne();
        return $usuario;
    }
    /**
     * @return Usuario
     */
//    public static function getLoggedUserStToken()
//    {
//        $st_token = Autentication::getBearerToken();
//
//        $sessao = new Sessao(null);
//
//        $usuario = new Usuario(null);
//        $usuario->setPrimary($sessao->getUserStTokenSession($st_token));
//        $usuario->findOne();
//
//        if (empty($usuario->id_usuario)){
//            Response::failResponse("Usuário não se encontra logado!");
//        }
//
//        return $usuario;
//    }

}