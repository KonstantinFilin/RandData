<?php

namespace RandData\Formatter;

class Sql extends \RandData\Formatter
{
    protected $tableName;
    
    function __construct(\RandData\Generator $generator, $tableName) {
        parent::__construct($generator);
        
        $this->tableName = $tableName;
    }

    public function build()
    {
        $data = parent::build();
        return implode(";". PHP_EOL, $data);
    }
    
    protected function buildOne($counter, $data)
    {
        foreach ($data as $fldName => $fldValue) {
            $data[$fldName] = is_null($fldValue) ? "NULL" : "'" . $fldValue . "'";
        }

        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode("`,`", array_keys($data)),
            implode(",", $data)
        );
    }

    protected function getPattern()
    {
        return "INSERT INTO `%s` (`%s`) VALUES (%s)";
    }
}
