<?php

namespace App\Business;

use App\Model\Entity\Usuarios;
use App\Model\Entity\VwUsuarioimagem;
use App\Model\Request;
use App\Model\Response;
use App\Model\Validate;
use App\Util\Helper;
use App\Util\JWT;
use App\Util\Token;
use App\Constants\TipoUsuario;
use Bootstrap\Config;
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

        if (!$this->verificaEmail($usuario->st_email)) {
            throw new Exception("E-mail já está em uso!");
        }

        $usuarioCheckLogin = new Usuarios();
        $usuarioCheckLogin->setStLogin($usuario->getStLogin());
        $usuarioCheckLogin->mount($usuarioCheckLogin->getFirst($usuarioCheckLogin->find()));
        if ($usuarioCheckLogin->getIdUsuario()) {
            throw new Exception("O nome de login informado já está sendo utilizado.");
        }

        $usuario->setStSenha($this->geraSenhaCriptografada($usuario->getStSenha()));
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

        $isAdministrador = Usuario::isAdministrator($usuario->getIdUsuario());
        $tipoAtual = (int)$usuario->getIdTipousuario();

        $usuario->mount($parameters);
        $newTipo = (int)$usuario->getIdTipousuario();

        if ($tipoAtual !== $newTipo && !$isAdministrador) {
            self::isAdministrator(null, true);
        }

        $usuarioCheckLogin = new Usuarios();
        $usuarioCheckLogin->setStLogin($usuario->getStLogin());
        $usuarioCheckLogin->mount($usuarioCheckLogin->getFirst($usuarioCheckLogin->find()));
        if ($usuarioCheckLogin->getIdUsuario() !== $usuario->getIdUsuario()) {
            throw new Exception("O nome de login informado já está sendo utilizado.");
        }

        if (!empty($parameters["st_senha"])) {
            $usuario->setStSenha($this->geraSenhaCriptografada($parameters["st_senha"]));
        }

        if (!$this->verificaEmail($usuario->st_email, $usuario->getIdUsuario())) {
            throw new Exception("E-mail já está em uso!");
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
            $this->usuarioEnt->clearObject();
            $this->usuarioEnt->setStEmail($st_email);
            $retorno = $this->usuarioEnt->find();

            if (!sizeof($retorno) > 0) {
                throw new Exception("Usuário não encontrado!");
            }

        }

        $this->usuarioEnt->mount($this->usuarioEnt->getFirst($retorno));
        if (!$this->verificaSenhaCriptografada($st_senha, $this->usuarioEnt->getStSenha())) {
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
        //Todo VERIFICAR COMO DESATIVAR UM TOKEN JWT
        return true;
    }

    /**
     * @return Usuarios
     * @throws Exception
     */
    public static function getLoggedUser()
    {
        $jwt = new JWT();
        $data = $jwt->getDataToken(Token::getTokenByAuthorizationHeader());
        $usuario = new Usuarios();
        $usuario->findOne($data["userid"]);
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
        $vwUsuario->setStUrl(Imagem::generateLinkAccess($vwUsuario->getStUrl()));
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

    /**
     * @param null $id_usuario
     * @param bool $lancaErro
     * @param null $erroMessage
     * @return bool
     * @throws Exception
     */
    public static function isAdministrator($id_usuario = null, $lancaErro = false, $erroMessage = null)
    {

        try {
            $usuario = new Usuarios();
            if (!$id_usuario) {
                $usuario = Usuario::getLoggedUser();
            } else {
                $usuario->findOne($id_usuario);
            }

            if ((int)$usuario->getIdTipousuario() !== TipoUsuario::ADMINISTRADOR) {
                throw new Exception("Ação permitida somente para usuários administradores!");
            }

            return true;
        } catch (Exception $exception) {
            if ($lancaErro) {

                if ($erroMessage) {
                    throw new Exception($erroMessage);
                }

                throw $exception;

            }

            return false;
        }

    }

    /**
     * @param $id_usuario
     * @return bool
     * @throws Exception
     */
    public static function isUserLogged($id_usuario)
    {

        $usuarioLogged = Usuario::getLoggedUser();
        return (int)$usuarioLogged->getIdUsuario() === $id_usuario;

    }

    /**
     * @param $senha
     * @return string
     * @throws Exception
     */
    public function geraSenhaCriptografada($senha)
    {
        $config = new Config();
        $key = $config->getConfig("st_key");
        return Helper::criptografaWithKey($key, $senha);
    }

    /**
     * @param $senha
     * @param $hash
     * @return bool
     * @throws Exception
     */
    public function verificaSenhaCriptografada($senha, $hash)
    {
        $config = new Config();
        $key = $config->getConfig("st_key");
        return Helper::isValidHash($hash, $key, $senha);
    }

    /**
     * @param $id_usuario
     * @param $st_senha
     * @return Usuarios
     * @throws Exception
     */
    public function alterarSenha($id_usuario, $st_senha)
    {

        $usuario = new Usuarios();
        $usuario->findOne($id_usuario);
        $usuario->setStSenha($this->geraSenhaCriptografada($st_senha));
        $usuario->save();
        return $usuario;

    }

    /**
     * @param $st_email
     * @param null $id_usuario
     * @return bool
     * @throws Exception
     */
    public function verificaEmail($st_email, $id_usuario = null)
    {
        $usuario = new Usuarios();
        $usuario->setStEmail($st_email);
        $usuario->findAndMount();

        if (!$usuario->getIdUsuario()) {
            return true;
        }

        if ($id_usuario && (int)$usuario->getIdUsuario() !== (int)$id_usuario) {
            return false;
        } else if ($id_usuario) {
            return true;
        }

        return false;

    }

}
