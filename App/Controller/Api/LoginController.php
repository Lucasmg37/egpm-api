<?php


namespace App\Controller\Api;

use App\Business\Sessao;
use App\Business\Usuario;
use App\Controller\Controller;
use App\Model\Response;
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
            $st_email = $this->getRequest()->getParameter("st_email");
            $st_senha = $this->getRequest()->getParameter("st_senha");

            if (empty($st_email)) {
                throw new Exception("E-mail não informado!");
            }

            if (empty($st_senha)) {
                throw new Exception("Senha não informada!");
            }

            //Verifica dados do usuário
            $this->usuario = $this->usuario->login($st_email, $st_senha);

            //Cria sessao para o usuário
            $this->sessao->insert($this->usuario->id_usuario);

            //Retorna o token
            return $this->sessao->objectToArray();

        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return false;
        }
    }
}