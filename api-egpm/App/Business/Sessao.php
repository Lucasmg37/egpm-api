<?php


namespace App\Business;

use App\Model\Model;
use App\Util\Helper;
use App\Util\Token;
use Exception;

class Sessao
{

    private $sessaoEnt;

    public function __construct()
    {
        $this->sessaoEnt = new \App\Model\Entity\Sessao();
    }

    /**
     * Cria sessão para um usuário
     * @param $id_usuario
     * @return \App\Model\Entity\Sessao|mixed
     * @throws Exception
     */
    public function insert($id_usuario)
    {

        //Apagar todas as sessões de um usuário
        $this->clearAllSessions($id_usuario);

        $this->sessaoEnt->setIdUsuario($id_usuario);
        $this->sessaoEnt->setDtSessao(Model::nowTime());
        $this->sessaoEnt->setStToken(Helper::criptografaWithDate($id_usuario));
        $this->sessaoEnt->insert();

        return $this->sessaoEnt;
    }

    /**
     * @param $st_token
     * @return bool|mixed
     * @throws Exception
     */
    public function delete($st_token)
    {
        $this->sessaoEnt->clearObject();
        $this->sessaoEnt->setStToken($st_token);
        $this->sessaoEnt->mount($this->sessaoEnt->getFirst($this->sessaoEnt->find()));
        $this->sessaoEnt->delete();

        return true;
    }

    /**
     * Limpa todas as sessões do usuário
     * Usuário sempre terá somente uma sessão ativa
     * @param $id_usuario
     * @return bool
     * @throws Exception
     */
    public function clearAllSessions($id_usuario)
    {
        $this->sessaoEnt->setIdUsuario($id_usuario);
        $sessoesUsuario = $this->sessaoEnt->find();

        $sessaoDelete = new \App\Model\Entity\Sessao();

        foreach ($sessoesUsuario as $sessao) {
            $sessaoDelete->mount($sessao);
            $sessaoDelete->delete();
        }

        $this->sessaoEnt->clearObject();
        return true;
    }

    /**
     * @param null $st_token
     * @return \App\Model\Entity\Sessao
     * @throws Exception
     */
    public function getSessaoByToken($st_token = null)
    {
        if (!$st_token) {
            $st_token = Token::getTokenByAuthorizationHeader();
        }

        $this->sessaoEnt->clearObject();
        $this->sessaoEnt->setStToken($st_token);
        $this->sessaoEnt->mount($this->sessaoEnt->getFirst($this->sessaoEnt->find()));
        return $this->sessaoEnt;

    }

}