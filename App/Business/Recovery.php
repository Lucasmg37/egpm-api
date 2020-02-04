<?php


namespace App\Business;


use App\Model\Model;
use App\Util\Helper;
use Exception;

class Recovery
{

    /**
     * @return false|string
     * @throws Exception
     */
    public function gerarCodigoRecovery()
    {
        $st_codigo = "";

        while (true) {

            $hash = Helper::criptografaWithDate();
            $st_codigo = substr($hash, 0, 6);

            //Verificar se o código já existe
            $recovery = $this->verificaCodigo($st_codigo);

            if ($recovery->getIdUsuario()) {
                continue;
            }

            break;
        }

        return $st_codigo;
    }

    /**
     * @param $id_usuario integer
     * @return \App\Model\Entity\Recovery
     * @throws Exception
     */
    public function salvarSolicitacaoRecovery($id_usuario)
    {

        $this->deleteRecoveryUsuario($id_usuario);

        $recovery = new \App\Model\Entity\Recovery();
        $recovery->setDtGeracao(Model::nowTime());
        $recovery->setStCodigo($this->gerarCodigoRecovery());
        $recovery->setIdUsuario($id_usuario);
        $recovery->insert();
        return $recovery;
    }

    /**
     * @param $id_usuario
     * @return bool
     * @throws Exception
     */
    public function deleteRecoveryUsuario($id_usuario)
    {

        $recovery = new \App\Model\Entity\Recovery();
        $recovery->setIdUsuario($id_usuario);
        $recoverys = $recovery->find();

        foreach ($recoverys as $item) {
            $recoveryDelete = new \App\Model\Entity\Recovery($item);
            $recoveryDelete->delete();
        }

        return true;

    }

    /**
     * @param $st_codigo
     * @return \App\Model\Entity\Recovery
     * @throws Exception
     */
    public function verificaCodigo($st_codigo)
    {
        $recovery = new \App\Model\Entity\Recovery();
        $recovery->setStCodigo($st_codigo);
        $recovery->mount($recovery->getFirst($recovery->find()));

        return $recovery;
    }

}
