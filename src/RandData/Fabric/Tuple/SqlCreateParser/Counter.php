<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE AUTO_INCREMENT field definition
 */
class Counter extends \RandData\Fabric\Tuple\SqlCreateParser
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition)
    {
        if (strpos($fieldDefinition, "AUTO_INCREMENT") !== false) {
            return "counter";
        }

        return null;
    }
}
