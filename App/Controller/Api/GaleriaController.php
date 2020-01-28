<?php

namespace App\Controller\Api;

use App\Business\Galeria;
use App\Controller\Controller;
use App\Model\Entity\Fotogaleria;
use App\Model\Entity\Fotogaleriaimagem;
use App\Business\Imagem;
use Exception;

Class GaleriaController extends Controller
{

    /**
     * @return Fotogaleria
     * @throws Exception
     */
    public function postAction()
    {
        try {

            $this->getModel()->beginTransaction();

            $file = $this->request->getFile("file");
            $fotoGaleria = new Fotogaleria();
            $galeria = new Galeria();

            $fotoGaleria->setStNome($file["name"]);
            $fotoGaleria->save();

            Imagem::vinculaImagemWithResize($file, "Galeria", new Fotogaleriaimagem(), "setIdFotogaleria", $fotoGaleria->getIdFotogaleria());

            $this->getModel()->commit();
            return $galeria->getOne($fotoGaleria->getIdFotogaleria());

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id)
    {
        try {
            $fotoGaleria = new Fotogaleria();

            if ($id) {
                $this->getModel()->beginTransaction();
                Imagem::desvinculaImagensWithResize(new Fotogaleriaimagem(), "setIdFotogaleria", $id);
                $fotoGaleria->delete($id);
                $this->getModel()->commit();
                return true;
            }

            $this->getModel()->beginTransaction();
            $fotos = $fotoGaleria->findAll();

            foreach ($fotos as $foto) {
                $fotoGaleria->clearObject();
                $fotoGaleria->mount($foto);
                Imagem::desvinculaImagensWithResize(new Fotogaleriaimagem(), "setIdFotogaleria", $fotoGaleria->getIdFotogaleria());
                $fotoGaleria->delete();
            }

            $this->getModel()->commit();
            return true;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @param $id
     * @return Fotogaleria|array|void
     * @throws Exception
     */
    public function getAction($id)
    {
        $galeria = new Galeria();

        if ($id) {
            return $galeria->getOne($id);
        }
        return $galeria->getAll();
    }

}