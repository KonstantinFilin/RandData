<?php

namespace RandData\Fabric\Tuple;

/**
 * Tuple that creates datasets from sql CREATE TABLE command
 */
class SqlCreateTuple extends \RandData\Tuple
{
    /**
     * CREATE TABLE sql command
     * @var string
     */
    protected $sql;
    
    /**
     * SQL definitions of fields
     * @var array
     */
    protected $fieldsAsSql;
    
    /**
     * Datasets array
     * @var array
     */
    protected $datasets;
    
    /**
     * Field NULL probability array
     * @var array
     */
    protected $nullProbability;

    /**
     * Class constructor
     * @param string $sql SQL CREATE TABLE command
     */
    public function __construct($sql)
    {
        $this->sql = "";
        $this->fieldsAsSql = [];
        $this->datasets = $this->getDataSetsDefinitionList($sql);
    }
    
    /**
     * @inherit
     */
    public function getDataSets()
    {
        return $this->datasets;
    }

    /**
     * Parses table fields definition
     * @param string $sql SQL CREATE TABLE command
     * @return array Array of fields definition
     */
    public function getFieldsAsSql($sql)
    {
        $brace1pos = strpos($sql, "(");
        $sql2 = substr($sql, $brace1pos + 1);
        $brace2pos = strrpos($sql2, ")");
        $sql3 = substr($sql2, 0, $brace2pos - 1);
        $lines = explode("," . PHP_EOL, $sql3);

        foreach ($lines as $line) {
            if (!preg_match("/^\s*(PRIMARY|UNIQUE)?\s*KEY /i", $line)) {
                $ret[] = trim($line);
            }
        }

        return $ret;
    }
    
    /**
     * Parses sql and creates datasets
     * @param string $sql SQL CREATE TABLE command
     * @return array Datasets definitions
     */
    public function getDataSetsDefinitionList($sql)
    {
        $lines = $this->getFieldsAsSql($sql);
        $ret = [];

        foreach ($lines as $fieldDefinition) {
            list($fieldName, $dataSetDefinition) = $this->parseSqlFieldDefinition($fieldDefinition);
            
            if ($this->parseSqlCanBeNull($fieldDefinition)) {
                $this->nullProbability[$fieldName] = 50;
            }
            
            if ($fieldName && $dataSetDefinition) {
                $ret[$fieldName] = $dataSetDefinition;
            }
        }

        return $ret;
    }
    
    /**
     * Returns fields probability (50% of null for NULL field and 0 for NOT NULL field)
     * @return array Null probability list
     */
    protected function getNullProbability()
    {
        return $this->nullProbability;
    }
    
    /**
     * Checks if field can be null
     * @param string $fieldDefinition Field sql definition
     * @return boolean True - field can be NULL, False - field cannot be NULL
     */
    protected function parseSqlCanBeNull($fieldDefinition)
    {
        return !preg_match("/NOT NULL/i", $fieldDefinition);
    }
    
    /**
     * Parses sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
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

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionIntUnsigned($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionInt($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionDecimal($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionDt($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionChar($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }

        if (!empty($fieldRules = $this->parseSqlFieldDefinitionString($fieldDefinition))) {
            return [ $fieldName, $fieldRules ];
        }
        
        throw new \InvalidArgumentException("Can't parse the string: " . $fieldDefinition);
    }
    
    /**
     * Parses unsigned integer sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */

    protected function parseSqlFieldDefinitionIntUnsigned($fieldDefinition)
    {
        if (preg_match("/tinyint\(1\) unsigned/i", $fieldDefinition)) {
            return "boolean:valTrue=1;valFalse=0";
        }
        
        if (preg_match("/tinyint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=255";
        }
        
        if (preg_match("/smallint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=65535";
        }
        
        if (preg_match("/mediumint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=16777215";
        }
        
        if (preg_match("/int\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=" . mt_getrandmax();
        }
        
        if (preg_match("/bigint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=" . mt_getrandmax();
        }

        return null;
    }

    /**
     * Parses integer sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
    protected function parseSqlFieldDefinitionInt($fieldDefinition)
    {
        if (preg_match("/tinyint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-128;max=127";
        }
        
        if (preg_match("/smallint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-32768;max=32767";
        }
        
        if (preg_match("/mediumint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-8388608;max=8388607";
        }
        
        if (preg_match("/int\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=" . (floor((mt_getrandmax()-1)/2)*-1) . ";max=" . floor(mt_getrandmax()/2);
        }
        
        if (preg_match("/bigint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=" . (floor((mt_getrandmax()-1)/2)*-1) . ";max=" . floor(mt_getrandmax()/2);
        }
        
        return null;
    }

    /**
     * Parses decimal sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
    protected function parseSqlFieldDefinitionDecimal($fieldDefinition)
    {
        if (preg_match("/decimal\(([\d]+),([\d]+)\)/i", $fieldDefinition, $matches)) {
            $range1 = intval($matches[1]);
            $range2 = intval($matches[2]);
            $max = pow(10, ($range1 - $range2))-1;
            $min = -1*$max;

            return "decimal:min=" . $min . ";max=" . $max . ";minFractionDigits=0;maxFractionDigits=" . $range2;
        }
        
        if (preg_match("/decimal\(([\d]+)\)/i", $fieldDefinition, $matches)) {
            $range1 = intval($matches[1]);
            $max = pow(10, ($range1))-1;
            $min = -1*$max;
            return "decimal:min=" . $min . ";max=" . $max . ";minFractionDigits=0;maxFractionDigits=0";
        }
        
        if (preg_match("/decimal/i", $fieldDefinition)) {
            $max = pow(10, (10))-1;
            $min = -1*$max;
            return "decimal:min=" . $min . ";max=" . $max. ";minFractionDigits=0;maxFractionDigits=0";
        }
    }

    /**
     * Parses character sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
    protected function parseSqlFieldDefinitionChar($fieldDefinition)
    {
        if (preg_match("/varchar\(([\d]+)\)/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=" . $matches[1];
        }
        
        if (preg_match("/enum\(([^\)]+)\)/i", $fieldDefinition, $matches)) {
            return "string_list:values=" . str_replace("'", "", $matches[1]);
        }
        
        if (preg_match("/set\(([^\)]+)\)/i", $fieldDefinition, $matches)) {
            return "string_list:values=" . str_replace("'", "", $matches[1]);
        }
    }

    /**
     * Parses text sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
    protected function parseSqlFieldDefinitionString($fieldDefinition)
    {
        if (preg_match("/tinytext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=256";
        }
        
        if (preg_match("/mediumtext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=16777216";
        }
        
        if (preg_match("/longtext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=16777216";
        }
        
        if (preg_match("/text/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=65536";
        }
    }
    
    /**
     * Parses datetime sql field definition and returns Dataset
     * @param string $fieldDefinition Sql field definition
     * @return array [0] element with field name and [1] element with string dataset definition
     * @throws \InvalidArgumentException
     */
    protected function parseSqlFieldDefinitionDt($fieldDefinition)
    {
        if (preg_match("/datetime/i", $fieldDefinition)) {
            return "datetime:date_min=1900-01-01;date_max=2099-12-31";
        }

        if (preg_match("/time/i", $fieldDefinition)) {
            return "time";
        }

        if (preg_match("/date/i", $fieldDefinition)) {
            return "date:min=1900-01-01;max=2099-12-31";
        }

        if (preg_match("/year\(4\)/i", $fieldDefinition)) {
            return "integer:min=1901;max=2155";
        }

        if (preg_match("/year\(2\)/i", $fieldDefinition)) {
            return "integer:min=0;max=99";
        }

        if (preg_match("/year/i", $fieldDefinition)) {
            return "integer:min=1901;max=2155";
        }

        return null;
    }
}
