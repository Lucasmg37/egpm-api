<?php


namespace App\Controller\Api;


use App\Business\Usuario;
use App\Controller\Controller;
use App\Model\Response;

class UsuarioController extends Controller
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
        parent::__construct();
    }

    public function getAction()
    {

    }

    public function postAction()
    {
        return $this->usuario->insert();
    }

    public function logoutAction()
    {
        $this->usuario->logout();
        Response::succesResponse("Usuário deslogado!");
    }

}