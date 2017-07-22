<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE UNSIGNED INT field definition
 */
class IntUnsigned extends \RandData\Fabric\Tuple\SqlCreateParser
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition)
    {
        if (preg_match("/tinyint\(1\) unsigned/i", $fieldDefinition)) {
            return "boolean:valTrue=1;valFalse=0";
        }
        
        if (preg_match("/tinyint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=255";
        }
        
        if (preg_match("/smallint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=65535";
        }
        
        if (preg_match("/mediumint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=16777215";
        }
        
        if (preg_match("/int\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=" . mt_getrandmax();
        }
        
        if (preg_match("/bigint\([\d]+\) unsigned/i", $fieldDefinition)) {
            return "integer:min=0;max=" . mt_getrandmax();
        }

        return null;
    }
}
