<?php

namespace App\Model;


class Render
{

    public $caminho;
    private $end;

    /**
     * @param mixed $end
     * @return $this
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }


    public function setCaminho($caminho)
    {
        $this->caminho = "../App/View/$caminho.html";
    }


    function after($isto, $inthat)
    {
        if (!is_bool(strpos($inthat, $isto)))
            return substr($inthat, strpos($inthat, $isto) + strlen($isto));
    }

    function before($isto, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $isto));
    }

    function between($isto, $that, $inthat)
    {
        return $this->before($that, $this->after($isto, $inthat));
    }

    function renderScreen($variaveis = array())
    {
        header('Content-Type: text/html');
        echo $this->renderBeta($variaveis);
        exit;
    }

    function renderBeta($variaveis = array())
    {

        $textoPrincipal = file_get_contents($this->caminho);

        if (!empty($this->end)) {
            $textoPrincipal .= $this->end;
        }

        $controlle = true;
        while ($controlle) {
            $substitute = $this->between('{{', '}}', $textoPrincipal);
            $substituteFormat = "{{" . $substitute . "}}";
            $textoPrincipal = str_replace($substituteFormat, $this->buscaSubstitute($substitute), $textoPrincipal);

            $controlle = empty($substitute) ? false : true;

        }

        $controlle = true;

        while ($controlle) {
            $substitute = $this->between('[[', ']]', $textoPrincipal);
            $substituteFormat = "[[" . $substitute . "]]";

            if (isset($variaveis[$substitute]) && !empty($variaveis[$substitute])) {
                $textoPrincipal = str_replace($substituteFormat, $variaveis[$substitute], $textoPrincipal);
            } else {
                $textoPrincipal = str_replace($substituteFormat, $substitute, $textoPrincipal);
            }

            $controlle = empty($substitute) ? false : true;

        }

        return $textoPrincipal;
    }

    public function renderString($string, $variaveis = array())
    {

        $textoPrincipal = $string;

        if (!empty($this->end)) {
            $textoPrincipal .= $this->end;
        }

        $controlle = true;
        while ($controlle) {
            $substitute = $this->between('{{', '}}', $textoPrincipal);
            $substituteFormat = "{{" . $substitute . "}}";
            $textoPrincipal = str_replace($substituteFormat, $this->buscaSubstitute($substitute), $textoPrincipal);

            $controlle = empty($substitute) ? false : true;

        }

        $controlle = true;

        while ($controlle) {
            $substitute = $this->between('[[', ']]', $textoPrincipal);
            $substituteFormat = "[[" . $substitute . "]]";

            if (isset($variaveis[$substitute]) && !empty($variaveis[$substitute])) {
                $textoPrincipal = str_replace($substituteFormat, $variaveis[$substitute], $textoPrincipal);
            } else {
                $textoPrincipal = str_replace($substituteFormat, $substitute, $textoPrincipal);
            }

            $controlle = empty($substitute) ? false : true;

        }

        return $textoPrincipal;
    }


    function buscaSubstitute($param)
    {

        if (empty($param)) {
            return "";
        }

        $text = file_get_contents("..App/View/Componentes/$param.html");
        return $text;
    }

    function renderEmail($pathEmail, $datamailing)
    {
        $this->caminho = $pathEmail;
        $this->setEnd("{{RodapeEmail}}");
        return $this->renderBeta($datamailing)["html"];
    }


}
