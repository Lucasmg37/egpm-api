<?php

namespace Bootstrap;

use Exception;

class Config
{
    private $configs;
    private $bancos;
    private $personConfig;

    /**
     * Config constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $texto = file_get_contents("../config/config");
        $texto = str_replace(" ", "", $texto);
        $texto = explode(";", $texto);

        $linhas = [];

        foreach ($texto as $linha) {
            $linha = preg_replace('/[\n|\r|\n\r|\r\n]{2,}/', '', $linha);
            $linhas[] = $linha;
        }

        $sectionAtual = "config";
        $banco = 0;
        $data = [];

        foreach ($linhas as $linha) {

            $hasTwoPoints = strstr($linha, ":");
            $hasOpenColchete = strstr($linha, "[");
            $hasCloseColchete = strstr($linha, "]");

            if (empty($linha)) {
                continue;
            }

            if ($hasCloseColchete && $hasOpenColchete) {
                $sectionAtual = str_replace("[", "", $linha);
                $sectionAtual = str_replace("]", "", $sectionAtual);

                if ($sectionAtual === "bd") {
                    $banco++;
                }

            }

            if ($hasTwoPoints) {

                $item = explode(":", $linha);

                if ($sectionAtual === "bd") {
                    $data[$sectionAtual][$banco][] = ["atributo" => $item[0], "valor" => $item[1]];
                    continue;
                }

                $data[$sectionAtual][] = ["atributo" => $item[0], "valor" => $item[1]];
                continue;
            }

            if (!$hasTwoPoints && !$hasCloseColchete && !$hasOpenColchete) {
                throw new Exception("Configuração incorreta!");
            }

        }


        //Tratar configs
        $save = [];
        foreach ($data["config"] as $value) {
            $save[$value["atributo"]] = $value["valor"];
        }

        $this->setConfigs($save);

        //Tratar bancos
        $save = [];
        foreach ($data["bd"] as $bancos) {

            $dataBd = [];
            foreach ($bancos as $banco) {
                $dataBd[$banco["atributo"]] = $banco["valor"];
            }

            if (array_key_exists($dataBd["st_name"], $save)) {
                throw new Exception("1 ou mais bancos possuem o mesmo nome!");
            }

            $save[$dataBd["st_name"]] = $dataBd;

        }

        $this->setBancos($save);

        //Tratar outros
        $save = [];
        foreach ($data as $indice => $itens) {
            if ($indice !== "config" && $indice !== "bd") {
                foreach ($itens as $item) {
                    $save[$indice][$item["atributo"]] = $item["valor"];
                }
            }
        }

        $this->setPersonConfig($save);

    }

    /**
     * @param mixed $personConfig
     * @return $this
     */
    public function setPersonConfig($personConfig)
    {
        $this->personConfig = $personConfig;
        return $this;
    }

    /**
     * @param mixed $bancos
     * @return $this
     */
    public function setBancos($bancos)
    {
        $this->bancos = $bancos;
        return $this;
    }

    /**
     * @param mixed $configs
     * @return $this
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;
        return $this;
    }


    /**
     * @param $nameConfig
     * @return |null
     * @throws Exception
     */
    public function getConfig($nameConfig)
    {
        return $this->configs[$nameConfig] ? $this->configs[$nameConfig] : null;
    }


    /**
     * @return mixed
     */
    public function getAllConfig()
    {
        return $this->configs;
    }

    /**
     * @param $categoria
     * @param null $name
     * @return array|null
     */
    public function getCustomConfig($categoria, $name = null)
    {
        if (empty($name)) {
            return sizeof($this->personConfig[$categoria]) > 0 ? $this->personConfig[$categoria] : array();
        }

        return $this->personConfig[$categoria][$name] ? $this->personConfig[$categoria][$name] : null;

    }


    /**
     * @return bool
     */
    public function getFirstBd()
    {
        foreach ($this->bancos as $banco) {
            return $banco;
        }

        return false;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getBd($name)
    {
        return $this->bancos[$name];
    }

    /**
     * @param $bdName
     * @param $atribute
     * @return null
     */
    public function getBdAtribute($bdName, $atribute)
    {
        return $this->bancos[$bdName][$atribute] ? $this->bancos[$bdName][$atribute] : null;
    }

}
