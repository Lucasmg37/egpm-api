<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Social;
use Exception;

class SocialController extends Controller
{

    /**
     * @param $id_social
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_social)
    {
        $social = new Social();

        if (!empty($id_social)) {
            return $social->findOne($id_social);
        }
        return $social->findAll();
    }

    /**
     * @return mixed|void
     * @throws Exception
     */
    public function putAction()
    {
        $socials = $this->request->getParameter("socials");
        $social = new Social();

        foreach ($socials as $item) {
            $social->clearObject();
            $social->mount($item);
            $social->save();
        }

        return $social->findAll();
    }

}