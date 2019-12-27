<?php


namespace App\Business;

use App\Model\Espelhos\tb_sessaoDAO;
use App\Util\Debug;
use App\Util\Token;

class Sessao extends tb_sessaoDAO
{

    /**
     * Cria sessão para um usuário
     * @param $id_usuario
     * @return $this|mixed
     */
    public function insert($id_usuario)
    {
        //Apagar todas as sessões de um usuário
        $this->clearAllSessions($id_usuario);

        $this->id_usuario = $id_usuario;
        $this->st_token =  $this->criptografa($id_usuario);
        $this->dt_sessao = self::nowTime();

        parent::insert();
        return $this;
    }

    public function delete($st_token)
    {
        $this->mount(null);
        $this->st_token = $st_token;
        $this->mount($this->getFirstData($this->find(null, true)));
        return parent::delete();
    }

    /**
     * Limpa todas as sessões do usuário
     * Usuário sempre terá somente uma sessão ativa
     * @param $id_usuario
     * @return bool
     */
    public function clearAllSessions($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        $sessoesUsuario = $this->getData($this->find(null, true));

        $sessaoDelete = new Sessao();

        foreach ($sessoesUsuario as $sessao) {
            $sessaoDelete->mount($sessao);
            $sessaoDelete->delete();
        }

        return true;
    }

    /**
     * @param string $st_token
     * @return Sessao
     */
    public function getSessaoByToken($st_token = null) {

        if (!$st_token) {
            $st_token = Token::getTokenByAuthorizationHeader();
        }

        $this->mount(null);

        $this->st_token = $st_token;
        $this->mount($this->getFirstData($this->find(null, true)));
        $sessao = clone $this;
        $this->mount(null);

        return $sessao;
    }

//    public function create($id_usuario, $tipo_usuario = null) {
//        $this->id_usuario = $id_usuario;
//        $this->mount($this->getFirstData($this->find(null, true)));
//
//        if ($this->st_token) {
//            $this->delete();
//        }
//
//        $this->id_sessao = null;
//        $this->st_token = $this->criptografa($id_usuario);
//        $this->dt_sessao = $this->nowTime();
//        $this->id_usuario = $id_usuario;
//        $this->id_tipousuario = $tipo_usuario;
//        return $this->getFirstData($this->save());
//    }

//    public function remove($id_usuario) {
//        $this->id_usuario = $id_usuario;
//        $this->mount($this->getFirstData($this->find(null, true)));
//
//        if ($this->st_token) {
//            $this->delete();
//        } else {
//            return $this->fail("Usuário sem sessões ativas.");
//        }
//
//        return $this->success("Usuário deslogado.");
//    }

//    public function getUserStTokenSession($st_token) {
//        $this->st_token = $st_token;
//        return $this->getFirstData($this->find(null, true))["id_usuario"];
//    }

}