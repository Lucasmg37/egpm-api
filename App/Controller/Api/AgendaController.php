<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Agenda;
use App\Model\Validate;
use Exception;

class AgendaController extends Controller
{

    /**
     * @return Agenda
     * @throws Exception
     */
    public function postAction()
    {
        $input = $this->request->getAllParameters();
        $agenda = new Agenda();
        $agenda->validate(Validate::AGENDA, null, $input, false);
        $agenda->mount($input);
        $agenda->insert();
        return $agenda;
    }

    /**
     * @return Agenda
     * @throws Exception
     */
    public function putAction()
    {
        $input = $this->request->getAllParameters();
        $agenda = new Agenda();
        $agenda->validate(Validate::AGENDA, "UPDATE", $input, true);
        $agenda->mount($input);
        $agenda->update();
        return $agenda;
    }

    /**
     * @param $id_agenda
     * @return Agenda|array
     * @throws Exception
     */
    public function getAction($id_agenda)
    {
        $agenda = new \App\Business\Agenda();

        if ($id_agenda) {
            return $agenda->getOne($id_agenda);
        }

        return $agenda->getAll();
    }

    /**
     * @param $id_agenda
     * @throws Exception
     */
    public function deleteAction($id_agenda)
    {
        $agenda = new Agenda();
        $agenda->delete($id_agenda);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAtivosAction()
    {
        $agenda = new \App\Business\Agenda();
        return $agenda->getAtivos();
    }

}