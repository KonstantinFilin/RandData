<?php

namespace RandData\Generator;

abstract class Sql extends \RandData\Generator
{
    protected $tableName;
    
    function __construct(\RandData\Tuple $tuple, $tableName) {
        parent::__construct($tuple);
        $this->tableName = $tableName;
    }

    protected function runOne()
    {
        $headersArr = $this->getHeaders();
        $valuesArr = $this->tuple->get();

        return sprintf(
            $this->getPattern(),
            $this->tableName,
            implode(",", $headersArr),
            implode("','", $valuesArr)
        );
    }
    
    protected function getPattern()
    {
        return "INSERT INTO `%s` (%s) VALUES ('%s');";
    }
    
    abstract protected function getHeaders();
}
