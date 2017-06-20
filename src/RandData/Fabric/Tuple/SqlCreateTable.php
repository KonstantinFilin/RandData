<?php

namespace RandData\Fabric\Tuple;

class SqlCreateTable 
{
    protected $sql;
    protected $fieldsAsSql;

    public function __construct() {
        $this->sql = "";
        $this->fieldsAsSql = [];
    }

    public function getFieldsAsSql($sql)
    {
        $brace1pos = strpos($sql, "(");
        $sql2 = substr($sql, $brace1pos + 1);
        $brace2pos = strrpos($sql2, ")");
        $sql3 = substr($sql2, 0, $brace2pos - 1);
        $lines = explode("," . PHP_EOL, $sql3);

        foreach ($lines as $line) {
            if (!preg_match("/^\s+PRIMARY KEY /i", $line) && !preg_match("/^\s+KEY /i", $line)) {
                $ret[] = trim($line);
            }
        }

        return $ret;
    }
    
    public function getDataSetsDefinitionList($sql)
    {
        $lines = $this->getFieldsAsSql($sql);
        $ret = [];

        foreach ($lines as $fieldDefinition) {
            list($fieldName, $dataSetDefinition) = $this->parseSqlFieldDefinition($fieldDefinition);
            
            if ($fieldName && $dataSetDefinition) {
                $ret[$fieldName] = $dataSetDefinition;
            }
        }

        return $ret;
    }
    
    protected function parseSqlFieldDefinition($fieldDefinition)
    {
        $pattern = "/^\s*`([a-z0-9_]+)`.+$/";
        preg_match($pattern, $fieldDefinition, $matches);
        
        if (empty($matches[1])) {
            throw new \InvalidArgumentException(
                "Wrong sql field definition: " 
                    . $fieldDefinition 
                    . " (must be field name enclosed with ``)"
            );
        }
        
        $fieldName = $matches[1];

        if (strpos($fieldDefinition, "AUTO_INCREMENT") !== false) {
            return [ $fieldName, "counter" ];
        }
        
        if (preg_match("/tinyint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return [ $fieldName, "integer:min=0;max=255" ];
        }
        
        if (preg_match("/tinyint\([\d]+\)/i", $fieldDefinition)) {
            return [ $fieldName, "integer:min=-128;max=127" ];
        }
        
        return [ $fieldName, "null" ];
    }
}
