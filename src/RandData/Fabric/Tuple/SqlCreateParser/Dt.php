<?php

namespace RandData\Fabric\Tuple\SqlCreateParser;

/**
 * Parser of Sql CREATE TABLE date/time field definition
 */
class Dt extends \RandData\Fabric\Tuple\SqlCreateParser
{
    /**
     * @inherit
     */
    public function parse($fieldDefinition)
    {
        if (preg_match("/datetime/i", $fieldDefinition)) {
            return "datetime:date_min=1900-01-01;date_max=2099-12-31";
        }

        if (preg_match("/date/i", $fieldDefinition)) {
            return "date:min=1900-01-01;max=2099-12-31";
        }

        if (preg_match("/time/i", $fieldDefinition)) {
            return "time";
        }

        if (preg_match("/year\(2\)/i", $fieldDefinition)) {
            return "integer:min=0;max=99";
        }

        if (preg_match("/year(\(4\))?/i", $fieldDefinition)) {
            return "integer:min=1901;max=2155";
        }

        return null;
    }
}
