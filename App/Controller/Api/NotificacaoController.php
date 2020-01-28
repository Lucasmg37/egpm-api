<?php


namespace App\Controller\Api;


use App\Business\Notificacao;
use App\Business\Usuario;
use App\Controller\Controller;
use App\Model\Entity\Notificacaousuario;
use App\Model\Entity\VwNotificacao;
use App\Model\Model;
use Exception;

class NotificacaoController extends Controller
{

    /**
     * @return bool|void
     * @throws Exception
     */
    public function postAction()
    {
        try {
            $this->getModel()->beginTransaction();
            $input = $this->request->getAllParameters();

            $notificao = new Notificacao();
            $notificacaoEntity = $notificao->insert($input);
            $notificao->sendNotificationAllUsers($notificacaoEntity->getIdNotificacao());

            $this->getModel()->commit();
            return true;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getNaoVisualizadasAction()
    {
        $usuario = Usuario::getLoggedUser();

        $notificacaoEntity = new VwNotificacao();
        $notificacaoEntity->setBlVizualizado(0);
        $notificacaoEntity->setIdUsuario($usuario->id_usuario);
        return $notificacaoEntity->find();

    }

    /**
     * @param $id
     * @return Notificacaousuario|array
     * @throws Exception
     */
    public function visualizarAction($id)
    {
        $usuario = Usuario::getLoggedUser();

        $notificacaoUsuario = new Notificacaousuario();
        $notificacaoUsuario->setIdUsuario($usuario->getIdUsuario());
        $notificacaoUsuario->setIdNotificacaousuario($id);

        $notificacaoUsuario->mount($notificacaoUsuario->getFirst($notificacaoUsuario->find()));
        $notificacaoUsuario->setBlVizualizado(1);
        $notificacaoUsuario->setDtVizualizado(Model::nowTime());
        return $notificacaoUsuario->save();

    }

}