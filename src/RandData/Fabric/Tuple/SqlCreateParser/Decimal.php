<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE decimal field definition
 */
class Decimal extends \RandData\Fabric\Tuple\SqlCreateParser
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition)
    {
        if (preg_match("/decimal\(([\d]+),([\d]+)\)/i", $fieldDefinition, $matches)) {
            $range1 = intval($matches[1]);
            $range2 = intval($matches[2]);
            $max = pow(10, ($range1 - $range2))-1;
            $min = -1*$max;

            return "decimal:min=" . $min . ";max=" . $max . ";minFractionDigits=0;maxFractionDigits=" . $range2;
        }
        
        if (preg_match("/decimal\(([\d]+)\)/i", $fieldDefinition, $matches)) {
            $range1 = intval($matches[1]);
            $max = pow(10, ($range1))-1;
            $min = -1*$max;
            
            return "decimal:min=" . $min . ";max=" . $max . ";minFractionDigits=0;maxFractionDigits=0";
        }
        
        if (preg_match("/decimal/i", $fieldDefinition)) {
            $max = pow(10, (10))-1;
            $min = -1*$max;
            
            return "decimal:min=" . $min . ";max=" . $max. ";minFractionDigits=0;maxFractionDigits=0";
        }
        
        return null;
    }
}
