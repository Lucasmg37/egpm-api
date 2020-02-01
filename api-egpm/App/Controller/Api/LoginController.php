<?php


namespace App\Controller\Api;

use App\Business\Sessao;
use App\Business\Usuario;
use App\Controller\Controller;
use App\Integrations\ReCAPTCHA;
use App\Model\Autentication;
use App\Model\Response;
use App\Util\Token;
use Exception;

class LoginController extends Controller
{

    private $usuario;
    private $sessao;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->sessao = new Sessao();
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

            //Cria sessao para o usuário
            return $this->sessao->insert($this->usuario->id_usuario);

        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return false;
        }
    }

    /**
     * @return \App\Model\Entity\Sessao
     * @throws Exception
     */
    public function getStatusSessaoAction()
    {
        $sessao = new Sessao();
        $sessaoAtual = $sessao->getSessaoByToken(Token::getTokenByAuthorizationHeader());
        Autentication::aplicaRegraSessao($sessaoAtual);
        return $sessaoAtual;
    }
}