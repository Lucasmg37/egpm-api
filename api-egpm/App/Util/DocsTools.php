<?php


namespace App\Util;


class DocsTools
{
    /**
     * @param string $docs
     * @return array
     */
    public static function docsToArray($docs)
    {
        //Remover *
        $docs = str_replace("/**", "", $docs);
        $docs = str_replace("*/", "", $docs);
        $docs = str_replace("**/", "", $docs);
        $docs = str_replace("/*", "", $docs);
        $docs = str_replace("*", "", $docs);

        //Separar linhas em array
        $docs = explode("\n", $docs);

        //Limpa Array
        foreach ($docs as &$doc) {
            $doc = str_replace("  ", "", $doc);
        }

        foreach ($docs as $key => $value) {
            if (empty($value) || $value === " ") {
                unset($docs[$key]);
            }
        }

        return $docs;
    }

    /**
     * @param $parameter
     * @param $array
     * @return bool
     */
    public static function getSimpleParameterDocs($parameter, $array)
    {
        foreach ($array as $lines) {
            $arrayLinen = explode(" ", $lines);
            if (!empty($arrayLinen[0] === "@$parameter")) {
                return $arrayLinen[1];
            }
        }

        return false;

    }

    /**
     * @param $parameter
     * @param $array
     * @return bool
     */
    public static function isExistsParameter($parameter, $array)
    {
        foreach ($array as $lines) {
            $arrayLinen = explode(" ", $lines);
            if (!empty($arrayLinen[0] === "@$parameter")) {
                return true;
            }
        }

        return false;

    }

}