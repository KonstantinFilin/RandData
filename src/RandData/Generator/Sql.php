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
            "INSERT INTO `%s` (%s) VALUES ('%s');",
            $this->tableName,
            implode(",", $headersArr),
            implode("','", $valuesArr)
        );
    }
    
    abstract protected function getHeaders();
}
