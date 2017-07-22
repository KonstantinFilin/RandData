<?php

namespace RandData\Fabric\Tuple;

/**
 * Parser of Sql CREATE TABLE field definition
 */
abstract class SqlCreateParser
{
    
    /**
     * Parses sql field definition
     * @param string $fieldDefinition Sql create table field definition
     * @return string Dataset definition
     */
    abstract public function parse($fieldDefinition);
}
