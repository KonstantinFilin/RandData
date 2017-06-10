<?php

namespace RandData\Formatter;

class Sql extends \RandData\Formatter
{
    protected $tableName;
    protected $incrementField;
    protected $incrementStart;
    
    function __construct($tableName) {
        $this->tableName = $tableName;
        $this->incrementField = null;
        $this->incrementStart = 1;
    }

    public function build($data)
    {
        return implode(";". PHP_EOL, $data);
    }
    
    public function buildOne($counter, $data)
    {
        foreach ($data as $idx => $value) {
            $data[$idx] = is_null($value) ? "NULL" : "'" . $value . "'";
        }

        $headers = $this->incrementField 
            ? [ $this->incrementField ] + $this->headers 
            : $this->headers;
        
        $values = $this->incrementField 
            ? [ $counter + $this->incrementStart - 1 ] + $data 
            : $data;
        
        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode(",", $headers),
            implode(",", $values)
        );
    }
    
    public function setIncrementField($name)
    {
        $this->incrementField = $name;
    }

    function setIncrementStart($incrementStart) {
        $this->incrementStart = $incrementStart;
    }

    protected function getPattern()
    {
        return "INSERT INTO `%s` (%s) VALUES (%s)";
    }
    
    public function getNullAs() {
        return "NULL";
    }
}
