<?php

namespace RandData\Formatter;

class Sql extends \RandData\Formatter
{
    protected $tableName;
    protected $incrementField;
    protected $incrementStart;
    
    function __construct(\RandData\Generator $generator, $tableName) {
        parent::__construct($generator);
        
        $this->tableName = $tableName;
        $this->incrementField = null;
        $this->incrementStart = 1;
    }

    public function build()
    {
        $data = parent::build();
        return implode(";". PHP_EOL, $data);
    }
    
    protected function buildOne($counter, $data)
    {
        foreach ($data as $idx => $value) {
            $data[$idx] = is_null($value) ? "NULL" : "'" . $value . "'";
        }

        $headers = $this->incrementField 
            ? array_merge([ $this->incrementField ], $this->generator->getHeaders()) 
            : $this->generator->getHeaders();
        
        $values = $this->incrementField 
            ? array_merge([ $counter + $this->incrementStart - 1 ], $data) 
            : $data;
        
        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode("`,`", $headers),
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
        return "INSERT INTO `%s` (`%s`) VALUES (%s)";
    }
}
