<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Response;

class FileController extends Controller
{

    /**
     * @param $caminhoArquivo
     */
    public function getAction($caminhoArquivo)
    {

        $caminhoArquivo = "upload/" . $caminhoArquivo;

        $mime = mime_content_type($caminhoArquivo);
        $tamanho = filesize($caminhoArquivo);

        if (!$mime) {
            Response::failResponse("Arquivo não encontrado!");
        }

        header("Content-Type: " . $mime);
        header("Content-Length: " . $tamanho);

        echo file_get_contents($caminhoArquivo);
        exit;

    }

}