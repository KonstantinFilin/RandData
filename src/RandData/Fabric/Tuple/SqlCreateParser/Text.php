<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE text field definition
 */
class Text extends \RandData\Fabric\Tuple\SqlCreateParser 
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition) {
        if (preg_match("/tinytext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=256";
        }
        
        if (preg_match("/mediumtext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=16777216";
        }
        
        if (preg_match("/longtext/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=16777216";
        }
        
        if (preg_match("/text/i", $fieldDefinition, $matches)) {
            return "string:length_min=1;length_max=65536";
        }
        
        return null;
    }
}
