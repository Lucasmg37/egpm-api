<?php


namespace App\Controller\Api;

use App\Business\Usuario;
use App\Controller\Controller;
use App\Integrations\ReCAPTCHA;
use App\Model\Response;
use App\Util\JWT;
use App\Util\Token;
use Exception;

class LoginController extends Controller
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
        parent::__construct();
    }

    public function postAction()
    {
        try {
            $st_email = $this->getRequest()->getParameter("st_login");
            $st_senha = $this->getRequest()->getParameter("st_senha");
            $recaptchatoken = $this->getRequest()->getParameter("recaptchatoken");

            if (!ReCAPTCHA::siteVerify($recaptchatoken)) {
                throw new Exception("Ocorreu um erro na verificação do ReCAPTCHA!");
            }

            if (empty($st_email)) {
                throw new Exception("Usuário não informado!");
            }

            if (empty($st_senha)) {
                throw new Exception("Senha não informada!");
            }

            //Verifica dados do usuário
            $this->usuario = $this->usuario->login($st_email, $st_senha);

            $jwt = new JWT();
            $jwt->addInfoPayload("userid", $this->usuario->getIdUsuario());
            $retorno["st_token"] = $jwt->generateCode([
                "id_usuario" => $this->usuario->getIdUsuario(),
                "st_nome" => $this->usuario->getStNome(),
                "st_login" => $this->usuario->getStLogin(),
                "st_email" => $this->usuario->getStEmail()
            ]);

            $retorno["id_usuario"] = $this->usuario->getIdUsuario();
            return $retorno;

        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return false;
        }
    }

    /**
     * @return array
     * @throws Exception]
     */
    public function getStatusSessaoAction()
    {
        $jwt = new JWT();
        return $jwt->getDataToken(Token::getTokenByAuthorizationHeader());
    }
}