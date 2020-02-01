<?php

namespace App\Controller;

use App\Model\Response;

Class FileController
{
    public static function show($st_imagem)
    {

        if (empty($st_imagem)) {
            Response::failResponse("Nome da imagem não enviado!");
        }


        $caminho_imagem = "../files/" . $st_imagem;

        $mime = mime_content_type($caminho_imagem);
        $tamanho = filesize($caminho_imagem);

        if (!$mime) {
            Response::failResponse("Arquivo não encontrado!");
        }

        header("Content-Type: " . $mime);
        header("Content-Length: " . $tamanho);

        echo file_get_contents($caminho_imagem);
        exit;

    }

}