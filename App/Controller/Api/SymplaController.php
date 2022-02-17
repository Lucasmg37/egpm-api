<?php


namespace App\Controller\Api;


use App\Business\Notificacao;
use App\Controller\Controller;
use App\Integrations\Sympla;
use App\Model\Entity\Integracaosympla;
use App\Model\Entity\Participantessympla;
use App\Model\Validate;
use Exception;

class SymplaController extends Controller
{

    /**
     * @param $id
     * @return Integracaosympla
     * @throws Exception
     */
    public function getIntegracaoAction($id)
    {
        $integracao = new Integracaosympla();
        $integracao->findOne($id);
        return $integracao;
    }

    /**
     * @return Integracaosympla|void
     * @throws Exception
     */
    public function putAction()
    {
        $input = $this->request->getAllParameters();
        $integracao = new Integracaosympla();
        $integracao->mount($integracao->getFirst($integracao->findAll()));

        if ($integracao->getIdIntegracaosympla()) {
            $integracao->validate(Validate::INTEGRACAO, ["UPDATE"], $input, false);
            $integracao->mount($input);
            $integracao->save();
            return $integracao;
        }

        $integracao->validate(Validate::INTEGRACAO, [], $input, false);
        $integracao->mount($input)->setIdIntegracaosympla(1);
        $integracao->insert();
        return $integracao;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function sincronizarParticiantesAction($id)
    {
        $integracao = new Integracaosympla();
        $integracao->findOne($id);

        $sympla = new Sympla();
        $participantes = $sympla->eventsSympla($integracao->getIdEvento(), $integracao->getStChave(), Sympla::ROUTE_PARTICIPANTS);

        foreach ($participantes->data as $participante) {
            $participantesSympla = new Participantessympla();
            $participantesSympla->mount((array)$participante);

            $participantesSympla->setCheckIn($participante->checkin[0]->check_in ? "1" : "0");

            $verificaParticipante = new Participantessympla();
            $verificaParticipante->findOne($participantesSympla->getId());

            if ($verificaParticipante->getId()) {
                $participantesSympla->update();
            } else {
                $participantesSympla->insert();
                $notificacao = Notificacao::newNotification("Novo Participante", "O participante " . $participantesSympla->getFirstName() . " realizou sua inscrição.");
                Notificacao::sendNotificationAllUsers($notificacao->getIdNotificacao());
            }

        }

        return true;

    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deleteAllParticipantesAction()
    {
        $participantes = new Participantessympla();
        $participantes->deleteAllData();
        return true;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getParticipantesAction()
    {
        $participantes = new Participantessympla();
        return $participantes->findAll();
    }

}