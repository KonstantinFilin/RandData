<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

class Counter extends \RandData\Fabric\Tuple\SqlCreateParser 
{
    public function parse($fieldDefinition) {
        if (strpos($fieldDefinition, "AUTO_INCREMENT") !== false) {
            return "counter";
        }

        return null;
    }
}
