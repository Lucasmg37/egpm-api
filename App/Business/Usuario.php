<?php

namespace App\Business;

use App\Model\Entity\Usuarios;
use App\Model\Entity\VwUsuarioimagem;
use App\Model\Request;
use App\Model\Response;
use App\Model\Validate;
use App\Util\Token;
use Exception;

class Usuario
{

    private $usuarioEnt;
    private $request;

    public function __construct()
    {
        $this->usuarioEnt = new Usuarios();
        $this->request = new Request();
    }

    /**
     * @param $id_usuario
     * @return Usuarios
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
     * @param $parameters
     * @return Usuarios
     * @throws Exception
     */
    public function insert($parameters)
    {
        $usuario = new Usuarios();
        $usuario->validate(Validate::USUARIO, ["INSERT"], $parameters, false);
        $usuario->mount($parameters);

        $usuarioCheckLogin = new Usuarios();
        $usuarioCheckLogin->setStLogin($usuario->getStLogin());
        $usuarioCheckLogin->mount($usuarioCheckLogin->getFirst($usuarioCheckLogin->find()));
        if ($usuarioCheckLogin->getIdUsuario()) {
            throw new Exception("O nome de login informado já está sendo utilizado.");
        }

        $usuario->insert();
        return $usuario;
    }

    /**
     * @param $parameters
     * @return Usuarios
     * @throws Exception
     */
    public function update($parameters)
    {
        $usuario = new Usuarios();
        $usuario->validate(Validate::USUARIO, ["UPDATE"], $parameters, true);
        $usuario->findOne($parameters["id_usuario"]);
        $usuario->mount($parameters);

        $usuarioCheckLogin = new Usuarios();
        $usuarioCheckLogin->setStLogin($usuario->getStLogin());
        $usuarioCheckLogin->mount($usuarioCheckLogin->getFirst($usuarioCheckLogin->find()));
        if ($usuarioCheckLogin->getIdUsuario() !== $usuario->getIdUsuario()) {
            throw new Exception("O nome de login informado já está sendo utilizado.");
        }

        $usuario->update();
        $usuario->setStSenha("");
        return $usuario;
    }

    /**
     * Verifica parâmetros de login e retorna o usuário
     * @param $st_email
     * @param $st_senha
     * @return Usuarios
     * @throws Exception
     */
    public function login($st_email, $st_senha)
    {

        $this->usuarioEnt->setStLogin($st_email);
        $retorno = $this->usuarioEnt->find();

        if (!sizeof($retorno) > 0) {
            throw new Exception("Usuário não encontrado!");
        }

        $this->usuarioEnt->setStSenha($st_senha);
        $this->usuarioEnt->mount($this->usuarioEnt->getFirst($this->usuarioEnt->find()));

        if (!$this->usuarioEnt->getIdUsuario()) {
            throw new Exception("Senha incorreta!");
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
     * @return Usuarios
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

    /**
     * @param $id_usuario
     * @return VwUsuarioimagem
     * @throws Exception
     */
    public function getOne($id_usuario)
    {
        $vwUsuario = new VwUsuarioimagem();
        $vwUsuario->setIdUsuario($id_usuario);
        $vwUsuario->mount($vwUsuario->getFirst($vwUsuario->find()));
        return $vwUsuario;
    }

    /**
     * @return Usuarios[]
     * @throws Exception
     */
    public function getAll()
    {
        $usuario = new VwUsuarioimagem();
        $usuarios = $usuario->findAll();

        $retorno = [];
        foreach ($usuarios as $user) {
            $usuario->clearObject();
            $usuario->mount($user);
            $retorno[] = $this->getOne($usuario->getIdUsuario());
        }

        return $retorno;

    }

    /**
     * @param $id_usuario int
     * @return bool
     * @throws Exception
     */
    public function delete($id_usuario)
    {
        if (empty($id_usuario)) {
            Response::failResponse("O identificador do usuário não foi enviado!");
        }

        $usuario = new Usuarios();
        $usuario->findOne($id_usuario);

        if ($usuario->getIdImagem()) {
            Imagem::deleteImage($usuario->getIdImagem());
        }

        $usuario->delete($id_usuario);
        return true;
    }

}