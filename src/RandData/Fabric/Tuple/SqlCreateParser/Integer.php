<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE int field definition
 */
class Integer extends \RandData\Fabric\Tuple\SqlCreateParser
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition)
    {
        if (preg_match("/tinyint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-128;max=127";
        }
        
        if (preg_match("/smallint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-32768;max=32767";
        }
        
        if (preg_match("/mediumint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=-8388608;max=8388607";
        }
        
        if (preg_match("/\sint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=" . (floor((mt_getrandmax()-1)/2)*-1) . ";max=" . floor(mt_getrandmax()/2);
        }
        
        if (preg_match("/bigint\([\d]+\)/i", $fieldDefinition)) {
            return "integer:min=" . (floor((mt_getrandmax()-1)/2)*-1) . ";max=" . floor(mt_getrandmax()/2);
        }
        
        return null;
    }
}
