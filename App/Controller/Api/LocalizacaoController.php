<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Localizacao;
use App\Model\Validate;
use Exception;

class LocalizacaoController extends Controller
{

    /**
     * @param $id_localizacao
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_localizacao)
    {
        $localizacao = new Localizacao();

        if (!empty($id_localizacao)) {
            return $localizacao->findOne($id_localizacao);
        }

        return $localizacao->findAll();

    }

    /**
     * @return Localizacao|array|void
     * @throws Exception
     */
    public function postAction()
    {
        $input = $this->request->getAllParameters();

        $localizacaoEntity = new Localizacao();
        $localizacaoEntity->validate(Validate::LOCALIZACAO, [], $input, false);
        return $localizacaoEntity->mount($input)->save();
    }

}