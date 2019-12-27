<?php

namespace App\Business;

use App\Model\Model;
use App\Model\Request;
use App\Util\Token;
use Exception;

class Usuario
{

    private $usuarioEnt;
    private $request;

    public function __construct()
    {
        $this->usuarioEnt = new \App\Model\Entity\Usuario();
        $this->request = new Request();
    }

    /**
     * @param $id_usuario
     * @return \App\Model\Entity\Usuario
     * @throws Exception
     */
    public function getUser($id_usuario)
    {
        $this->usuarioEnt->clearObject();
        $this->usuarioEnt->findOne($id_usuario);
        $this->usuarioEnt->setStSenha("");
        return $this->usuarioEnt;
    }

    /**
     * @param $st_nome
     * @param $st_email
     * @param $st_senha
     * @param $id_entidade
     * @param bool $bl_ativo
     * @return \App\Model\Entity\Usuario
     * @throws Exception
     */
    public function insert($st_nome, $st_email, $st_senha, $id_entidade, $bl_ativo = false)
    {
        $this->usuarioEnt->clearObject();
        $this->usuarioEnt->setStNome($st_nome);
        $this->usuarioEnt->setStSenha($st_senha);
        $this->usuarioEnt->setStEmail($st_email);
        $this->usuarioEnt->setIdEntidade($id_entidade);
        $this->usuarioEnt->setBlAtivo($bl_ativo);
        $this->usuarioEnt->setDtCriacao(Model::nowTime());

        if (empty($this->usuarioEnt->getStNome())) {
            throw new Exception("Nome não foi informado!");
        }

        if (empty($this->usuarioEnt->getStEmail())) {
            throw new Exception("Email não foi informado!");
        }

        if (empty($this->usuarioEnt->getStSenha())) {
            throw new Exception("Senha não foi informada!");
        }

        //Verificar se email já foi cadastrado
        $usuarioCheckEmail = new \App\Model\Entity\Usuario();
        $usuarioCheckEmail->setStEmail($this->usuarioEnt->getStEmail());
        $usuarios = $usuarioCheckEmail->find();

        if (sizeof($usuarios) > 0) {
            throw new Exception("E-mail já está cadastrado!", 1002);
        }

        return $this->usuarioEnt->insert();
    }

    /**
     * Verifica parâmetros de login e retorna o usuário
     * @param $st_email
     * @param $st_senha
     * @return \App\Model\Entity\Usuario
     * @throws Exception
     */
    public function login($st_email, $st_senha)
    {

        $this->usuarioEnt->setStEmail($st_email);
        $retorno = $this->usuarioEnt->find();

        if (!sizeof($retorno) > 0) {
            throw new Exception("Usuário não encontrado!");
        }

        $this->usuarioEnt->setStSenha($st_senha);
        $this->usuarioEnt->mount($this->usuarioEnt->getFirst($this->usuarioEnt->find()));

        if (!$this->usuarioEnt->getIdUsuario()) {
            throw new Exception("Senha incorreta!");
        }

        if (!$this->usuarioEnt->getBlAtivo()) {
            throw new Exception("Usuário não está ativado no sistema!", 1001);
        }

        $this->usuarioEnt->setStSenha("");
        return $this->usuarioEnt;
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    public function logout()
    {
        $sessao = new Sessao();
        return $sessao->delete(Token::getTokenByAuthorizationHeader());
    }

    /**
     * @return Usuario|\App\Model\Entity\Usuario
     * @throws Exception
     */
    public static function getLoggedUser()
    {
        $sessao = new Sessao();
        $sessao = $sessao->getSessaoByToken();

        $usuario = new Usuario();
        $usuario = $usuario->getUser($sessao->getIdUsuario());
        return $usuario;
    }


}