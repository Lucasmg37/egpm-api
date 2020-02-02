<?php


namespace App\Business;


use App\Model\Entity\Notificacaousuario;
use App\Model\Model;
use App\Model\Validate;
use Exception;

class Notificacao
{

    /**
     * @param $parametros
     * @return \App\Model\Entity\Notificacao|array
     * @throws Exception
     */
    public function insert($parametros)
    {
        $notificacaoEntity = new \App\Model\Entity\Notificacao();
        $parametros["dt_notificacao"] = Model::nowTime();
        $notificacaoEntity->validate(Validate::NOTIFICACAO, [], $parametros);
        $notificacaoEntity->mount($parametros)->insert();
        return $notificacaoEntity;
    }

    /**
     * @param $st_titulo
     * @param $st_texto
     * @return \App\Model\Entity\Notificacao
     * @throws Exception
     */
    public static function newNotification($st_titulo, $st_texto)
    {
        $notificacaoEntity = new \App\Model\Entity\Notificacao();
        $notificacaoEntity->setStTitulo($st_titulo);
        $notificacaoEntity->setStDescricao($st_texto);
        $notificacaoEntity->setDtNotificacao(Model::nowTime());
        $notificacaoEntity->insert();
        return $notificacaoEntity;
    }

    /**
     * @param $id_notificao
     * @param $id_usuario
     * @return Notificacaousuario
     * @throws Exception
     */
    public static function sendNotification($id_notificao, $id_usuario)
    {
        $notificaoUsuario = new Notificacaousuario();
        $notificaoUsuario->setBlVizualizado(0);
        $notificaoUsuario->setIdUsuario($id_usuario);
        $notificaoUsuario->setIdNotificacao($id_notificao);
        $notificaoUsuario->insert();
        return $notificaoUsuario;
    }

    /**
     * @param $id_notificao
     * @return bool
     * @throws Exception
     */
    public static function sendNotificationAllUsers($id_notificao)
    {
        $usuarioObj = new Usuario();
        $usuarios = $usuarioObj->getAll();

        foreach ($usuarios as $usuario) {
            self::sendNotification($id_notificao, $usuario->getIdUsuario());
        }

        return true;
    }


}