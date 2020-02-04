<?php


namespace App\Controller\Api;

use App\Business\Recovery;
use App\Business\Usuario;
use App\Constants\TipoArquivo;
use App\Controller\Controller;
use App\Model\Entity\Imagem;
use App\Model\Response;
use App\Model\Entity\VwUsuarioimagem;
use App\Model\Entity\Usuarios;
use App\Model\SendMail;
use Exception;

class UsuarioController extends Controller
{

    private $usuario;

    /**
     * UsuarioController constructor.
     */
    public function __construct()
    {
        $this->usuario = new Usuario();
        parent::__construct();
    }

    /**
     * @param $id_usuario
     * @return VwUsuarioimagem|array|void
     * @throws Exception
     */
    public function getAction($id_usuario)
    {
        $usuario = new Usuario();
        if ($id_usuario) {
            return $usuario->getOne($id_usuario);
        }

        return $usuario->getAll();
    }

    /**
     * @return Usuarios
     * @throws Exception
     */
    public function postAction()
    {
        if (!empty($this->request->getParameter("id_usuario"))) {
            return $this->putAction();
        }

        try {
            $this->getModel()->beginTransaction();

            //Somente administradores podem adicionar um novo usuário
            Usuario::isAdministrator(null, true);
            $input = $this->request->getAllParameters();
            $arquivo = $this->request->getFile("st_file", false);

            $usuario = $this->usuario->insert($input);

            if ($arquivo) {
                $file = $this->getFile()->upload("Imagens/Perfil", $arquivo, TipoArquivo::TIPO_IMAGEM_DEFAULT);
                $imagem = new Imagem();
                $imagem->setStUrl($file->getUrlAcesso());
                $imagem->setStNome($usuario->getStNome());
                $imagem->save();

                $usuario->setIdImagem($imagem->getIdImagem());
                $usuario->update();
            }

            $this->getModel()->commit();
            return $usuario;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @return Usuarios|void
     * @throws Exception
     */
    public function putAction()
    {
        try {
            $this->getModel()->beginTransaction();
            $input = $this->request->getAllParameters();

            //Somente o usuário logado pode se editar, ou um administrador
            if (!Usuario::isUserLogged((int)$input["id_usuario"])) {
                Usuario::isAdministrator(null, true);
            }

            $arquivo = $this->request->getFile("st_file", false);

            $usuarioImg = new Usuarios();
            $usuarioImg->mount($input)->findOne();

            unset($input["id_imagem"]);

            if (($input["removeimagem"] || $arquivo) && $usuarioImg->getIdImagem()) {
                \App\Business\Imagem::deleteImage($usuarioImg->getIdImagem());
                $input["id_imagem"] = NULL;
            }

            if ($arquivo) {
                $file = $this->getFile()->upload("Imagens/Perfil", $arquivo, TipoArquivo::TIPO_IMAGEM_DEFAULT);
                $imagem = new Imagem();
                $imagem->setStUrl($file->getUrlAcesso());
                $imagem->setStNome($usuarioImg->getStNome());
                $imagem->save();
                $input["id_imagem"] = $imagem->getIdImagem();
            }

            $usuario = $this->usuario->update($input);

            $this->getModel()->commit();
            return $usuario;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @param $id_usuario
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id_usuario)
    {
        //Somente o usuário logado pode se editar, ou um administrador
        if (!Usuario::isUserLogged((int)$id_usuario)) {
            Usuario::isAdministrator(null, true);
        }
        return $this->usuario->delete($id_usuario);
    }

    /**
     * @throws Exception
     */
    public function logoutAction()
    {
        $this->usuario->logout();
        Response::succesResponse("Usuário deslogado!");
    }

    /**
     * @return VwUsuarioimagem|bool
     * @throws \PHPMailer\PHPMailer\Exception|Exception
     */
    public function recoveryAction()
    {
        $st_codigo = $this->request->getParameter("st_codigo");

        if ($st_codigo) {
            return $this->recoveryConfirmationCode();
        }

        $sendMail = new SendMail();
        $email = $this->request->getParameter("st_email", true, "O e-mail deve ser informado.");


        $usuario = new Usuarios();
        $usuario->setStEmail($email);
        $usuario->mount($usuario->getFirst($usuario->find()));

        if (!$usuario->getIdUsuario()) {
            throw new Exception("O e-mail informado não se encontra na base de dados!");
        }

        $recovery = new Recovery();
        $recoveryEntity = $recovery->salvarSolicitacaoRecovery($usuario->getIdUsuario());

        return $sendMail->sendEmailSystem($usuario->getStEmail(), "Teste", $recoveryEntity->getStCodigo());

    }

    /**
     * @return VwUsuarioimagem
     * @throws Exception
     */
    public function recoveryConfirmationCode()
    {
        $st_codigo = $this->request->getParameter("st_codigo", true, "O código de verificação é obrigatório.");
        $st_email = $this->request->getParameter("st_email", true, "O email deve ser enviado!");

        $recovery = new Recovery();
        $recoveryEntity = $recovery->verificaCodigo($st_codigo);

        if (!$recoveryEntity->getIdUsuario()) {
            throw new Exception("Código informado inválido!");
        }

        $usuario = new Usuario();
        $usuarioEntity = $usuario->getOne($recoveryEntity->getIdUsuario());

        if ($usuarioEntity->getStEmail() === $st_email) {
            return $usuarioEntity;
        }

        throw new Exception("O código informado não foi gerado para o email informado.");

    }

    /**
     * @return VwUsuarioimagem
     * @throws Exception
     */
    public function resetaSenha()
    {
        $usuarioEntity = $this->recoveryConfirmationCode();
        $st_senha = $this->request->getParameter("st_senha", true, "A senha não foi enviada.");
        $usuario = new Usuario();
        $usuario->alterarSenha($usuarioEntity->getIdUsuario(), $st_senha);
        return $usuarioEntity;

    }

}
