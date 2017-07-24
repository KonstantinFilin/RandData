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
        parent::__construct();
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
        $sql3 = substr($sql2, 0, $brace2pos);
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
        $matches = [];
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

        $fabric = new SqlCreateParserFabric();
        $result = $fabric->create($fieldDefinition);
        
        if ($result) {
            return [ $fieldName, $result ];
        }
        
        throw new \InvalidArgumentException("Can't parse the string: " . $fieldDefinition);
    }
}
