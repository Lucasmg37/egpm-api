<?php


namespace App\Model\Entity;

use App\Model\Banco;
use App\Model\Model;
use Exception;

class EntityGenerate
{

    private $bd;

    public function __construct()
    {
        $this->bd = new Banco();
    }

    /**
     * @param null $tabela
     * @return array
     * @throws Exception
     */
    public function generateEntity($tabela = null)
    {
        //Buscar tabelas
        $tabelas = $this->getDataTabelas($tabela);

        //Gerar informações por tabela
        $genereted = [];
        $php[] = "<?php";
        $abre[] = "{";
        $fecha[] = "}";
        $quebra[] = "";

        foreach ($tabelas as $table) {
            $atributes = $this->generateAtributes($table);
            $sets = $this->generateSets($table);
            $gets = $this->generateGets($table);
            $contructor = $this->generateContructor($this->getNameClasse($table));
            $classe = $this->generateClass($this->getNameClasse($table), $table["name"]);

            //Montar arquivo
            $final = array_merge(
                $php,
                $quebra,
                $classe,
                $abre,
                $quebra,
                $contructor,
                $quebra,
                $atributes,
                $quebra,
                $gets,
                $quebra,
                $sets,
                $quebra,
                $fecha
            );

            //Realizar identação
            $numberIdent = 0;

            foreach ($final as &$linha) {

                $tab = "";

                if (strstr($linha, "}")) {
                    $numberIdent--;
                }

                for ($i = 0; $i < $numberIdent; $i++) {
                    $tab = $tab . "    ";
                }

                if (strstr($linha, "{")) {
                    $numberIdent++;
                }

                if (!empty($linha) || $linha !== "") {
                    $linha = $tab . $linha;
                }

            }

            $final = implode("\n", $final);
            $genereted[] = $this->generateFile($this->getNameClasse($table), $final, "../App/Model/Entity/");

        }

        return $genereted;
    }

    /**
     * @param $nomeFile
     * @param $text
     * @param $path
     * @return string
     */
    private function generateFile($nomeFile, $text, $path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }

        $file = $path . $nomeFile . ".php";
        $fileEdit = fopen($file, 'w');
        fwrite($fileEdit, $text);
        fclose($fileEdit);
        return $file;
    }

    /**
     * @param $classe
     * @param $table
     * @return array
     */
    private function generateClass($classe, $table)
    {
        $text = [];
        $text[] = "namespace App\Model\Entity;";
        $text[] = "";
        $text[] = "use App\Model\BdAction;";
        $text[] = "use Exception;";
        $text[] = "";
        $text[] = "/**";
        $text[] = " * Class $classe";
        $text[] = " * @package App\Model\Entity";
        $text[] = " * @table $table";
        $text[] = " */";
        $text[] = "class $classe extends BdAction";

        return $text;
    }

    /**
     * @param $nameClass
     * @return array
     */
    private function generateContructor($nameClass)
    {

        $text = [];
        $text[] = "/**";
        $text[] = " * $nameClass constructor.";
        $text[] = ' * @param null $parameters';
        $text[] = " * @throws Exception";
        $text[] = " */";
        $text[] = 'public function __construct($parameters = null)';
        $text[] = "{";
        $text[] = 'parent::__construct($this, $parameters);';
        $text[] = "}";

        return $text;
    }

    /**
     * @param $table
     * @return bool|string
     */
    private function getNameClasse($table)
    {
        $name = substr($table["name"], 3);
        $name = ucfirst($name);
        return $name;
    }

    /**
     * @param $table
     * @return array
     */
    private function generateGets($table)
    {
        $text = [];
        foreach ($table["atributes"] as $atribute) {
            $text[] = "/**";

            if (isset($atribute["relations"])) {
                $classe = $this->getNameClasse(["name" => $atribute["relations"][0]["REFERENCED_TABLE_NAME"]]);
                $text[] = " * @return " . $atribute["dataType"]["typePhp"] . "|" . $classe;
            } else {
                $text[] = " * @return " . $atribute["dataType"]["typePhp"];
            }

            $text[] = " */";

            $field = $atribute["Field"];

            $nameSet = $field;
            $nameSet = explode("_", $nameSet);

            foreach ($nameSet as &$name) {
                $name = ucfirst($name);
            }

            $nameGet = "get" . implode("", $nameSet);

            $text[] = "public function $nameGet()";
            $text[] = "{";
            $text[] = 'return $this->' . $field . ";";
            $text[] = "}";
            $text[] = "";
            $text[] = "";

        }

        return $text;
    }

    /**
     * @param $table
     * @return array
     */
    private function generateSets($table)
    {
        $text = [];
        foreach ($table["atributes"] as $atribute) {
            $text[] = "/**";
            $text[] = " * @param " . $atribute["dataType"]["typePhp"] . " $" . $atribute["Field"];
            $text[] = " */";

            $field = $atribute["Field"];

            $nameSet = $field;
            $nameSet = explode("_", $nameSet);

            foreach ($nameSet as &$name) {
                $name = ucfirst($name);
            }

            $nameSet = "set" . implode("", $nameSet);

            $text[] = "public function $nameSet($" . $field . ")";
            $text[] = "{";
            $text[] = '$this->' . $field . " = $" . $field . ";";
            $text[] = '$this->atualizaAtributos($this);';
            $text[] = "}";
            $text[] = "";
            $text[] = "";

        }

        return $text;

    }

    /**
     * @param $table
     * @return array
     */
    private function generateAtributes($table)
    {
        $text = [];
        foreach ($table["atributes"] as $atribute) {
            $text[] = "/**";
            $text[] = " * @var $" . $atribute["Field"];

            //Gerar data a ser consultada
            if ($atribute["Key"] === "PRI") {
                $text[] = " * @primary_key";
            }


            if ($atribute["Null"] === "NO") {
                $text[] = " * @required";
            }
            
            if ($atribute["Extra"] === "auto_increment") {
                $text[] = " * @auto_increment";
            }

            if (isset($atribute["Default"])) {
                $text[] = " * @default " . $atribute["Default"];
            }

            if (isset($atribute["relations"])) {
                $text[] = " * @foreign_key_table " . $atribute["relations"][0]["REFERENCED_TABLE_NAME"];
                $text[] = " * @foreign_key_column " . $atribute["relations"][0]["REFERENCED_COLUMN_NAME"];
            }

            $text[] = " */";
            $text[] = "public $" . $atribute["Field"] . ";";
            $text[] = "";
            $text[] = "";
        }

        return $text;

    }

    /**
     * @param null $tabela
     * @return mixed
     * @throws Exception
     */
    private function getDataTabelas($tabela = null)
    {
        $banco = $this->bd->getBd();

        $tablesBd["Tables_in_" . $banco] = $tabela;

        if (!$tabela) {
            $tablesBd = Model::executeSource($this->bd->conexao, "SHOW TABLES");
        }

        $fullDataTable = [];

        foreach ($tablesBd as $tab) {
            $tableName = $tab["Tables_in_" . $banco];
            $fullDataTable[$tableName]["name"] = $tableName;
            $fullDataTable[$tableName]["atributes"] = $this->getDataTable($tableName);


            foreach ($fullDataTable[$tableName]["atributes"] as &$fields) {

                if ($fields["Key"] === "MUL") {
                    $fields["relations"] = $this->getRelation($tableName, $fields["Field"]);
                }

                $fields["dataType"] = $this->getDataType($fields);

            }

        }

        return $fullDataTable;
    }

    private function getDataType($field)
    {

        $arrayType = explode("(", str_replace(")", "", $field["Type"]));

        $typeBanco = $arrayType[0];

        switch ($typeBanco) {
            case "varchar":
            case "text":
                $typePhp = "string";
                break;
            case "tinyint":
                $typePhp = "boolean";
                break;
            case "datetime":
                $typePhp = "string";
                break;
            case "bigint":
                $typePhp = "int";
                break;
            default:
                $typePhp = $typeBanco;
        }

        return [
            "lenght" => isset($arrayType[1]) ? (int)$arrayType[1] : null,
            "type" => $typeBanco,
            "typePhp" => $typePhp
        ];

    }

    /**
     * @param $table
     * @return mixed
     * @throws Exception
     */
    private function getDataTable($table)
    {
        $sql = "SHOW COLUMNS FROM $table";
        return $data = Model::executeSource($this->bd->conexao, $sql);
    }

    /**
     * @param null $table
     * @param null $campo
     * @param null $banco
     * @return mixed
     * @throws Exception
     */
    private function getRelation($table = null, $campo = null, $banco = null)
    {
        try {
            if (!$banco) {
                $banco = $this->bd->getBd();
            }

            $sql = " SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME ";
            $sql .= " FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE ";
            $sql .= " WHERE TABLE_SCHEMA = '" . $banco . "' AND REFERENCED_TABLE_NAME IS NOT NULL";

            if ($table) {
                $sql .= " AND TABLE_NAME = '$table'";
            }

            if ($campo) {
                $sql .= " AND COLUMN_NAME = '$campo'";
            }

            return Model::executeSource($this->bd->conexao, $sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
