<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

class String extends \RandData\Fabric\Tuple\SqlCreateParser 
{
    public function parse($fieldDefinition) {
        if (preg_match("/varchar\(([\d]+)\)/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=" . $matches[1];
        }
        
        if (preg_match("/enum\(([^\)]+)\)/i", $fieldDefinition, $matches)) {
            return "string_list:values=" . str_replace("'", "", $matches[1]);
        }
        
        if (preg_match("/set\(([^\)]+)\)/i", $fieldDefinition, $matches)) {
            return "string_list:values=" . str_replace("'", "", $matches[1]);
        }

        return null;
    }
}
