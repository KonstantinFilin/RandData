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
        foreach ($data as $idx => $value) {
            $data[$idx] = is_null($value) ? "NULL" : "'" . $value . "'";
        }

        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode("`,`", $this->generator->getTuple()->getHeaders()),
            implode(",", $data)
        );
    }

    protected function getPattern()
    {
        return "INSERT INTO `%s` (`%s`) VALUES (%s)";
    }
}
