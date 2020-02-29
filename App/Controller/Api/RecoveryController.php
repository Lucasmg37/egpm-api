<?php


namespace App\Controller\Api;


use App\Business\Usuario;
use App\Controller\Controller;
use App\Model\Entity\Usuarios;
use App\Model\Entity\VwUsuarioimagem;
use App\Model\Model;
use App\Model\Render;
use App\Model\SendMail;
use Exception;
use App\Business\Recovery;

class RecoveryController extends Controller
{

    /**
     * @return VwUsuarioimagem|bool
     * @throws \PHPMailer\PHPMailer\Exception|Exception
     */
    public function postAction()
    {
        $st_codigo = $this->request->getParameter("st_codigo");

        if ($st_codigo) {
            return $this->recoveryConfirmationCodeAction();
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

        //Verificar se usuário já solicitou um código
        $recoveryEntity = new \App\Model\Entity\Recovery();
        $recoveryEntity->setIdUsuario($usuario->getIdUsuario());
        $recoveryEntity->findAndMount();

        if ($recoveryEntity->getIdUsuario()) {
            $tempoDuracao = 60 * 30; //30 Minutos
            $fimsessao = strtotime($recoveryEntity->getDtGeracao()) + (int)$tempoDuracao;

            $now = strtotime(Model::nowTime());

            if ($now < $fimsessao) {
                throw new Exception("Códido de recuperação já solicitado!");
            }
        }

        $recoveryEntity = $recovery->salvarSolicitacaoRecovery($usuario->getIdUsuario());

        $parametrosRender = [
            "st_nome" => $usuario->getStNome(),
            "st_codigo" => $recoveryEntity->getStCodigo()
        ];

        $render = new Render();
        $render->setCaminho("Mail/Recovery");
        $stringEmail = $render->renderBeta($parametrosRender);

        return $sendMail->sendEmailSystem($usuario->getStEmail(), "Recuperação de Senha EGPM.", $stringEmail);

    }

    /**
     * @return VwUsuarioimagem
     * @throws Exception
     */
    public function recoveryConfirmationCodeAction()
    {
        $st_codigo = $this->request->getParameter("st_codigo", true, "O código de verificação é obrigatório.");
        $st_email = $this->request->getParameter("st_email", true, "O email deve ser enviado!");

        $recovery = new Recovery();
        $recoveryEntity = $recovery->verificaCodigo($st_codigo);
        $recovery->verificaRegraRecovery($recoveryEntity);

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
    public function resetaSenhaAction()
    {
        $usuarioEntity = $this->recoveryConfirmationCodeAction();
        $st_senha = $this->request->getParameter("st_senha", true, "A senha não foi enviada.");
        $usuario = new Usuario();
        $usuario->alterarSenha($usuarioEntity->getIdUsuario(), $st_senha);
        return $usuarioEntity;

    }

}
