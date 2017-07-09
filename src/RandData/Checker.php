<?php

namespace RandData;

/**
 * Helper to check and clean dataset values
 */
class Checker 
{
    /**
     * Check time value
     * @param string $value Time value
     * @param string $attribute Field name
     * @return string Cleaned time value
     * @throws \InvalidArgumentException
     */
    public static function time($value, $attribute)
    {
        $value2 = $value ?: "00:00";
        $pattern = "/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/";
        
        if (!preg_match($pattern, $value2)) {
            $mes = sprintf(
                "Wrong time value [%s] in the attribute [%s]",
                (string) $value2,
                (string) $attribute 
            );
            throw new \InvalidArgumentException($mes);
        }
        
        return $value2;
    }
    
    /**
     * Checks integer value
     * @param integer $value Calue to check
     * @param integer $min Minimum possible value
     * @param integer $max Maximum possible value
     * @param string $attribute Field name
     * @return integer Cleaned value
     * @throws \InvalidArgumentException
     */
    public static function int($value, $min, $max, $attribute)
    {
        $valueClean = intval($value);

        if ($valueClean < $min || $valueClean > $max) {
            $mes = sprintf(
                "Wrong argument %s with value %s: must be integer from %d to %d",
                $attribute,
                (string) $value,
                $min,
                $max
            );
            throw new \InvalidArgumentException($mes);
        }
        
        return $valueClean;
    }
}
