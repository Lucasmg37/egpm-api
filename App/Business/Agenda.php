<?php


namespace App\Business;

use App\Constants\System\BdAction;
use Exception;

class Agenda
{
    /**
     * @param $id_agenda
     * @return \App\Model\Entity\Agenda
     * @throws Exception
     */
    public function getOne($id_agenda)
    {
        $agenda = new \App\Model\Entity\Agenda();
        $agenda->findOne($id_agenda);

        if ($agenda->getIdJogo()) {
            $jogo = new Jogo();
            $agenda->jogo = $jogo->getOne($agenda->getIdJogo());
        }

        return $agenda;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll()
    {
        $agenda = new \App\Model\Entity\Agenda();

        $agendamentos = $agenda->findCustom("*", null, false, ["nu_horario" => "ASC", "dt_data" => "ASC",]);
        $retorno = [];
        foreach ($agendamentos as $agendamento) {
            $agenda->clearObject();
            $agenda->mount($agendamento);
            $retorno[] = $this->getOne($agenda->getIdAgenda());
        }

        return $retorno;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAtivos()
    {
        $agenda = new \App\Model\Entity\Agenda();
        $agenda->bl_ativo = 1;
        $agendamentos = $agenda->findCustom("*", ["bl_ativo" => BdAction::WHERE_EQUAL], false, ["nu_horario" => "ASC", "dt_data" => "ASC",]);

        $retorno = [];
        foreach ($agendamentos as $agendamento) {
            $agenda->clearObject();
            $agenda->mount($agendamento);
            $retorno[] = $this->getOne($agenda->getIdAgenda());
        }

        return $retorno;
    }

}